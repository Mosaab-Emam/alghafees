<?php

namespace App\Services;

use App\Exceptions\WhatsAppRateLimitException;
use App\Exceptions\WhatsAppSendException;
use App\Jobs\SendLeadWhatsAppBatch;
use App\Models\Lead;
use App\Models\User;
use App\Support\FilamentDashboardAccess;
use App\Support\LeadContactData;
use DomainException;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Cache\Repository;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Throwable;

class LeadWhatsAppBatchService
{
    public function limit(): int
    {
        return max(1, (int) config('services.wasender.lead_batch_limit', 100));
    }

    /** E.164 numbers or recognizable Saudi mobiles; never guess another country's local prefix. */
    public function phone(string $value): ?string
    {
        $value = LeadContactData::phone($value);
        if (str_starts_with($value, '00')) {
            $value = '+'.substr($value, 2);
        } elseif (preg_match('/^05[0-9]{8}$/D', $value)) {
            $value = '+966'.substr($value, 1);
        } elseif (preg_match('/^5[0-9]{8}$/D', $value)) {
            $value = '+966'.$value;
        } elseif (! str_starts_with($value, '+') && preg_match('/^[1-9][0-9]{9,14}$/D', $value)) {
            $value = '+'.$value;
        }

        return preg_match('/^\+[1-9][0-9]{7,14}$/D', $value) ? $value : null;
    }

    public function phoneOptions(Lead $lead): array
    {
        $options = [];
        foreach ($lead->phones ?? [] as $phone) {
            if ($normalized = $this->phone($phone)) {
                $options[$normalized] = $normalized;
            }
        }

        return $options;
    }

    public function prepare(Collection $leads, ?string $chosenPhone = null): array
    {
        if ($leads->count() > $this->limit()) {
            throw new DomainException(__('leads.wa_limit', ['max' => $this->limit()]));
        }
        $recipients = [];
        $skipped = [];
        $seen = [];
        foreach ($leads as $lead) {
            $options = $this->phoneOptions($lead);
            $phone = $chosenPhone ?? array_key_first($options);
            if ($phone === null || ! isset($options[$phone])) {
                $skipped[] = ['name' => $lead->name, 'reason' => 'no_phone'];

                continue;
            }
            if (isset($seen[$phone])) {
                $skipped[] = ['name' => $lead->name, 'reason' => 'duplicate'];

                continue;
            }
            $seen[$phone] = true;
            $recipients[] = ['lead_id' => $lead->id, 'name' => $lead->name, 'phone' => $phone, 'status' => 'pending', 'reason' => null];
        }

        return ['recipients' => $recipients, 'skipped' => $skipped];
    }

    public function start(array $plan, string $message, User $user): string
    {
        Gate::forUser($user)->authorize('sendWhatsApp', Lead::class);
        abort_unless(FilamentDashboardAccess::userHasFullAccess($user), 403);
        $message = LeadContactData::trim($message);
        Validator::make(['message' => $message], ['message' => ['required', 'string', 'max:4000']])->validate();
        if (blank(config('services.wasender.api_key'))) {
            throw new DomainException(__('leads.wa_reason_not_configured'));
        }
        if (($plan['recipients'] ?? []) === []) {
            throw new DomainException(__('leads.wa_no_recipients'));
        }
        if (count($plan['recipients']) > $this->limit()) {
            throw new DomainException(__('leads.wa_limit', ['max' => $this->limit()]));
        }

        $userKey = 'lead-whatsapp:user:'.$user->id;
        $startLock = $this->cache()->lock($userKey.':lock', 15);
        if (! $startLock->get()) {
            throw new DomainException(__('leads.wa_already_active'));
        }
        try {
            $activeId = $this->cache()->get($userKey);
            $active = $activeId ? $this->owned($activeId, $user->id) : null;
            if ($active !== null && ! $this->finished($active)) {
                throw new DomainException(__('leads.wa_already_active'));
            }

            $id = (string) Str::uuid();
            $state = $plan + [
                'owner_id' => $user->id,
                'locale' => app()->getLocale(),
                'status' => 'queued',
                'encrypted_text' => Crypt::encryptString($message),
                'deadline' => time() + 172800,
                'next_attempt_at' => time(),
                'interval' => 1,
                'rate_limits' => 0,
            ];
            $this->save($id, $state);
            $this->cache()->put($userKey, $id, 172800);
            $this->cache()->put($userKey.':latest', $id, 172860);
            try {
                SendLeadWhatsAppBatch::dispatch($id, $user->id);
            } catch (Throwable $exception) {
                $this->cache()->forget($this->key($id));
                $this->cache()->forget($userKey);
                $this->cache()->forget($userKey.':latest');
                throw $exception;
            }

            return $id;
        } finally {
            $startLock->release();
        }
    }

    public function latestId(int $ownerId): ?string
    {
        return $this->cache()->get('lead-whatsapp:user:'.$ownerId.':latest');
    }

    /** Public status excludes even encrypted message text. Only the initiating user can read it. */
    public function status(string $id, int $ownerId): ?array
    {
        $state = $this->owned($id, $ownerId);
        if ($state !== null) {
            unset($state['encrypted_text']);
            $state['sent'] = count(array_filter($state['recipients'], fn (array $recipient) => $recipient['status'] === 'sent'));
            $state['failed'] = count(array_filter($state['recipients'], fn (array $recipient) => $recipient['status'] === 'failed'));
            $state['pending'] = count(array_filter($state['recipients'], fn (array $recipient) => in_array($recipient['status'], ['pending', 'sending'], true)));
        }

        return $state;
    }

    /** One API request per job execution; a delay releases the job instead of sleeping a worker. */
    public function process(string $id, int $ownerId): ?int
    {
        $lock = $this->cache()->lock($this->key($id).':lock', 60);
        if (! $lock->get()) {
            return 2;
        }
        $senderLock = null;
        try {
            $state = $this->owned($id, $ownerId);
            if ($state === null) {
                return null;
            }
            if ($this->finished($state)) {
                $this->notify($id, $state);

                return null;
            }
            if ($this->cache()->has($this->key($id).':cancel')) {
                $this->finish($id, $state, 'cancelled', 'cancelled');

                return null;
            }
            if (time() >= $state['deadline']) {
                $this->finish($id, $state, 'failed', 'expired');

                return null;
            }
            $user = User::find($ownerId);
            if (! $user || ! FilamentDashboardAccess::userHasFullAccess($user) || ! Gate::forUser($user)->allows('sendWhatsApp', Lead::class)) {
                $this->finish($id, $state, 'failed', 'permission');

                return null;
            }

            $senderKey = 'lead-whatsapp:sender:'.hash('sha256', (string) config('services.wasender.api_key'));
            $waitUntil = max($state['next_attempt_at'], (int) $this->cache()->get($senderKey.':next', 0));
            if ($waitUntil > time()) {
                $state['status'] = 'waiting';
                $state['next_attempt_at'] = $waitUntil;
                $this->save($id, $state);

                return min($waitUntil - time(), max(1, $state['deadline'] - time()));
            }
            $senderLock = $this->cache()->lock($senderKey.':lock', 60);
            if (! $senderLock->get()) {
                $senderLock = null;

                return 2;
            }
            // Another batch may have updated the cooldown between our first check and lock acquisition.
            $waitUntil = (int) $this->cache()->get($senderKey.':next', 0);
            if ($waitUntil > time()) {
                $state['status'] = 'waiting';
                $state['next_attempt_at'] = $waitUntil;
                $this->save($id, $state);

                return min($waitUntil - time(), max(1, $state['deadline'] - time()));
            }

            $index = null;
            foreach ($state['recipients'] as $key => $recipient) {
                if ($recipient['status'] === 'sending') {
                    // A killed worker may already have submitted it. Do not automatically send it twice.
                    $state['recipients'][$key]['status'] = 'failed';
                    $state['recipients'][$key]['reason'] = 'unconfirmed';
                } elseif ($recipient['status'] === 'pending' && $index === null) {
                    $index = $key;
                }
            }
            if ($index === null) {
                $this->finish($id, $state, 'completed');

                return null;
            }

            $recipient = $state['recipients'][$index];
            $lead = Lead::find($recipient['lead_id']);
            if (! $lead || ! isset($this->phoneOptions($lead)[$recipient['phone']])) {
                $state['recipients'][$index]['status'] = 'failed';
                $state['recipients'][$index]['reason'] = 'contact_changed';
            } else {
                $state['status'] = 'sending';
                $state['recipients'][$index]['status'] = 'sending';
                $this->save($id, $state);
                try {
                    app(WhatsAppService::class)->sendMessage($recipient['phone'], Crypt::decryptString($state['encrypted_text']), false);
                    $state['recipients'][$index]['status'] = 'sent';
                    $this->cache()->put($senderKey.':next', time() + $state['interval'], $state['interval'] + 60);
                } catch (WhatsAppRateLimitException $exception) {
                    $state['recipients'][$index]['status'] = 'pending';
                    if ($this->cache()->has($this->key($id).':cancel')) {
                        $this->finish($id, $state, 'cancelled', 'cancelled');

                        return null;
                    }
                    $state['status'] = 'waiting';
                    $state['rate_limits']++;
                    $state['interval'] = max($state['interval'], min(61, $exception->retryAfter));
                    $state['next_attempt_at'] = time() + $exception->retryAfter;
                    $this->cache()->put($senderKey.':next', $state['next_attempt_at'], $exception->retryAfter + 60);
                    $this->save($id, $state);

                    return min($exception->retryAfter, max(1, $state['deadline'] - time()));
                } catch (WhatsAppSendException $exception) {
                    $state['recipients'][$index]['status'] = 'failed';
                    $state['recipients'][$index]['reason'] = $exception->reason;
                    if ($exception->stopBatch) {
                        $this->finish($id, $state, 'failed', 'stopped');

                        return null;
                    }
                } catch (ConnectionException $exception) {
                    $state['recipients'][$index]['status'] = 'failed';
                    $state['recipients'][$index]['reason'] = 'unconfirmed';
                    $this->finish($id, $state, 'failed', 'stopped');

                    return null;
                }
            }

            if ($this->cache()->has($this->key($id).':cancel')) {
                $this->finish($id, $state, 'cancelled', 'cancelled');

                return null;
            }
            if (! array_filter($state['recipients'], fn (array $recipient) => $recipient['status'] === 'pending')) {
                $this->finish($id, $state, 'completed');

                return null;
            }
            $state['status'] = 'queued';
            $state['next_attempt_at'] = time() + $state['interval'];
            $this->cache()->put($senderKey.':next', $state['next_attempt_at'], $state['interval'] + 60);
            $this->save($id, $state);

            return $state['interval'];
        } finally {
            $senderLock?->release();
            $lock->release();
        }
    }

    public function cancel(string $id, int $ownerId): void
    {
        $state = $this->owned($id, $ownerId);
        if ($state === null || $this->finished($state)) {
            return;
        }
        $this->cache()->put($this->key($id).':cancel', true, 172800);
        $lock = $this->cache()->lock($this->key($id).':lock', 60);
        if ($lock->get()) {
            try {
                $state = $this->owned($id, $ownerId);
                if ($state !== null && ! $this->finished($state)) {
                    $this->finish($id, $state, 'cancelled', 'cancelled');
                }
            } finally {
                $lock->release();
            }
        }
    }

    public function fail(string $id, int $ownerId): void
    {
        $state = $this->owned($id, $ownerId);
        if ($state !== null && ! $this->finished($state)) {
            foreach ($state['recipients'] as &$recipient) {
                if ($recipient['status'] === 'sending') {
                    $recipient['status'] = 'failed';
                    $recipient['reason'] = 'unconfirmed';
                }
            }
            unset($recipient);
            $this->finish($id, $state, 'failed', 'stopped');
        }
    }

    private function finish(string $id, array $state, string $status, ?string $reason = null): void
    {
        foreach ($state['recipients'] as &$recipient) {
            if (in_array($recipient['status'], ['pending', 'sending'], true)) {
                $recipient['status'] = 'failed';
                $recipient['reason'] = $reason ?? 'unconfirmed';
            }
        }
        unset($recipient, $state['encrypted_text']);
        $state['status'] = $status;
        $state['notification_pending'] = true;
        $this->save($id, $state, 3600);
        $this->cache()->forget($this->key($id).':cancel');
        $userKey = 'lead-whatsapp:user:'.$state['owner_id'];
        if ($this->cache()->get($userKey) === $id) {
            $this->cache()->forget($userKey);
        }
        if ($this->cache()->get($userKey.':latest') === $id) {
            $this->cache()->put($userKey.':latest', $id, 3600);
        }

        $this->notify($id, $state);
    }

    private function notify(string $id, array $state): void
    {
        if (! ($state['notification_pending'] ?? false)) {
            return;
        }
        if ($user = User::find($state['owner_id'])) {
            $sent = count(array_filter($state['recipients'], fn (array $recipient) => $recipient['status'] === 'sent'));
            $failed = count($state['recipients']) - $sent;
            $notification = Notification::make()
                ->title(trans($sent === 1 && count($state['recipients']) === 1 ? 'leads.wa_sent' : 'leads.wa_complete', [], $state['locale']))
                ->body(trans('leads.wa_summary', ['sent' => $sent, 'failed' => $failed, 'skipped' => count($state['skipped'])], $state['locale']))
                ->actions([Action::make('view')->label(trans('leads.plural', [], $state['locale']))->url(url('/dashboard/leads'))]);
            $failed > 0 ? $notification->warning() : $notification->success();
            // A deterministic ID makes retrying notification storage safe without repeating any sends.
            // Only result counts are stored, never outgoing message text.
            $user->notifications()->firstOrCreate(['id' => $id], [
                'type' => \Filament\Notifications\DatabaseNotification::class,
                'data' => $notification->getDatabaseMessage(),
                'read_at' => null,
            ]);
        }
        $state['notification_pending'] = false;
        $this->save($id, $state, 3600);
    }

    private function owned(string $id, int $ownerId): ?array
    {
        $state = $this->cache()->get($this->key($id));
        if ($state !== null && (int) $state['owner_id'] !== $ownerId) {
            abort(403);
        }

        return $state;
    }

    private function finished(array $state): bool
    {
        return in_array($state['status'], ['completed', 'cancelled', 'failed'], true);
    }

    private function save(string $id, array $state, int $ttl = 3600): void
    {
        // Active state expires after its fixed 48-hour deadline; finished status contains no message.
        $this->cache()->put($this->key($id), $state, isset($state['encrypted_text']) ? max(1, $state['deadline'] - time() + 60) : $ttl);
    }

    private function key(string $id): string
    {
        return 'lead-whatsapp:batch:'.$id;
    }

    private function cache(): Repository
    {
        return Cache::store(config('services.wasender.lead_cache_store', 'file'));
    }
}
