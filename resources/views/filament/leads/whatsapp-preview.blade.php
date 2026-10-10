<div class="space-y-3 text-sm">
    <p>{{ __('leads.wa_preview', ['count' => count($plan['recipients'] ?? []), 'skipped' => count($plan['skipped'] ?? [])]) }}</p>
    <p>{{ __('leads.wa_bulk_help') }}</p>
    <div class="max-h-64 overflow-auto rounded-lg border border-gray-200 dark:border-gray-700">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="p-3 text-start">{{ __('leads.name') }}</th>
                    <th class="p-3 text-start">{{ __('leads.phone') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($plan['recipients'] ?? [] as $recipient)
                    <tr>
                        <td class="p-3">{{ $recipient['name'] }}</td>
                        <td class="p-3" dir="ltr">{{ $recipient['phone'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if (($plan['skipped'] ?? []) !== [])
        <details>
            <summary class="cursor-pointer">{{ __('leads.wa_skipped') }}</summary>
            <ul class="mt-2 space-y-1">
                @foreach ($plan['skipped'] as $skipped)
                    <li>{{ $skipped['name'] }} — {{ __('leads.wa_reason_'.$skipped['reason']) }}</li>
                @endforeach
            </ul>
        </details>
    @endif
</div>
