@if ($this->whatsAppBatchId !== null && $this->whatsAppStatus !== [])
    @php
        $status = $this->whatsAppStatus;
        $active = in_array($status['status'], ['queued', 'waiting', 'sending'], true);
    @endphp
    <section
        @if ($active) wire:poll.3s="refreshWhatsAppStatus" @endif
        class="space-y-4 rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10"
        aria-live="polite"
    >
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h2 class="font-semibold">{{ __('leads.wa_progress') }} — {{ __('leads.wa_status_'.$status['status']) }}</h2>
            @if ($active)
                <x-filament::button color="danger" size="sm" wire:click="cancelWhatsAppBatch" wire:loading.attr="disabled" wire:target="cancelWhatsAppBatch">
                    {{ __('leads.wa_cancel') }}
                </x-filament::button>
            @endif
        </div>
        <p class="text-sm">{{ __('leads.wa_progress_summary', ['sent' => $status['sent'], 'failed' => $status['failed'], 'pending' => $status['pending'], 'skipped' => count($status['skipped'])]) }}</p>
        @if ($status['status'] === 'waiting')
            <p class="text-sm">{{ __('leads.wa_waiting', ['seconds' => max(0, $status['next_attempt_at'] - time())]) }}</p>
        @endif
        <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('leads.wa_background_help') }}</p>
        @if ($status['failed'] > 0)
            <div class="max-h-64 overflow-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr>
                            <th class="p-2 text-start">{{ __('leads.name') }}</th>
                            <th class="p-2 text-start">{{ __('leads.phone') }}</th>
                            <th class="p-2 text-start">{{ __('leads.error_message') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($status['recipients'] as $recipient)
                            @if ($recipient['status'] === 'failed')
                                <tr>
                                    <td class="p-2">{{ $recipient['name'] }}</td>
                                    <td class="p-2" dir="ltr">{{ $recipient['phone'] }}</td>
                                    <td class="p-2">{{ __('leads.wa_reason_'.$recipient['reason']) }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
@endif
