<?php

namespace App\Filament\Resources\LeadResource\Pages\Concerns;

use App\Models\Lead;
use App\Services\LeadWhatsAppBatchService;
use DomainException;
use Filament\Notifications\Notification;
use Filament\Support\Exceptions\Halt;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Locked;
use Throwable;

trait InteractsWithLeadWhatsApp
{
    #[Locked]
    public array $whatsAppPlan = [];

    #[Locked]
    public ?string $whatsAppBatchId = null;

    #[Locked]
    public array $whatsAppStatus = [];

    #[Locked]
    public bool $whatsAppToastShown = false;

    public function mount(): void
    {
        parent::mount();
        $service = app(LeadWhatsAppBatchService::class);
        $this->whatsAppBatchId = $service->latestId(auth()->id());
        if ($this->whatsAppBatchId !== null) {
            $this->whatsAppStatus = $service->status($this->whatsAppBatchId, auth()->id()) ?? [];
            $this->whatsAppToastShown = in_array($this->whatsAppStatus['status'] ?? null, ['completed', 'cancelled', 'failed'], true);
        }
    }

    public function prepareWhatsApp(Collection $leads): void
    {
        Gate::authorize('sendWhatsApp', Lead::class);
        try {
            $this->whatsAppPlan = app(LeadWhatsAppBatchService::class)->prepare($leads);
            if ($this->whatsAppPlan['recipients'] === []) {
                throw new DomainException(__('leads.wa_no_recipients'));
            }
        } catch (DomainException $exception) {
            Notification::make()->title(__('leads.wa_cannot_send'))->body($exception->getMessage())->warning()->send();
            throw new Halt;
        }
    }

    public function queuePreparedWhatsApp(string $message, ?string $chosenPhone = null): void
    {
        Gate::authorize('sendWhatsApp', Lead::class);
        try {
            $service = app(LeadWhatsAppBatchService::class);
            $plan = $this->whatsAppPlan;
            if ($chosenPhone !== null) {
                abort_unless(count($plan['recipients'] ?? []) === 1, 422);
                $lead = Lead::findOrFail($plan['recipients'][0]['lead_id']);
                $plan = $service->prepare(collect([$lead]), $chosenPhone);
            }
            $this->whatsAppBatchId = $service->start($plan, $message, auth()->user());
            $this->whatsAppStatus = $service->status($this->whatsAppBatchId, auth()->id()) ?? [];
            $this->whatsAppToastShown = false;
            $this->whatsAppPlan = [];
            Notification::make()->title(__('leads.wa_queued'))->body(__('leads.wa_queued_help'))->success()->send();
        } catch (DomainException $exception) {
            Notification::make()->title(__('leads.wa_cannot_send'))->body($exception->getMessage())->danger()->send();
            throw new Halt;
        } catch (Throwable $exception) {
            report($exception);
            Notification::make()->title(__('leads.wa_cannot_send'))->body(__('leads.wa_queue_failed'))->danger()->send();
            throw new Halt;
        }
    }

    public function refreshWhatsAppStatus(): void
    {
        if ($this->whatsAppBatchId === null) {
            return;
        }
        $status = app(LeadWhatsAppBatchService::class)->status($this->whatsAppBatchId, auth()->id());
        if ($status === null) {
            $this->whatsAppBatchId = null;
            $this->whatsAppStatus = [];

            return;
        }
        $this->whatsAppStatus = $status;
        if (in_array($status['status'], ['completed', 'cancelled', 'failed'], true) && ! $this->whatsAppToastShown) {
            $this->whatsAppToastShown = true;
            $notification = Notification::make()->title(__('leads.wa_complete'))
                ->body(__('leads.wa_summary', ['sent' => $status['sent'], 'failed' => $status['failed'], 'skipped' => count($status['skipped'])]));
            $status['failed'] > 0 ? $notification->warning() : $notification->success();
            $notification->send();
        }
    }

    public function cancelWhatsAppBatch(): void
    {
        Gate::authorize('sendWhatsApp', Lead::class);
        if ($this->whatsAppBatchId !== null) {
            app(LeadWhatsAppBatchService::class)->cancel($this->whatsAppBatchId, auth()->id());
            $this->refreshWhatsAppStatus();
        }
    }

    public function getFooter(): ?View
    {
        return view('filament.leads.whatsapp-progress');
    }
}
