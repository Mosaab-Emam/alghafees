@if ($errors !== [])
    <div class="space-y-3" role="alert" aria-live="polite">
        <p class="font-semibold text-danger-600 dark:text-danger-400">{{ __('leads.nothing_imported') }}</p>
        <p class="text-sm">{{ __('leads.error_report_help', ['count' => count($errors)]) }}</p>
        <div class="max-h-96 overflow-auto rounded-lg border border-gray-200 dark:border-gray-700">
            <table class="w-full text-start text-sm">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="p-3 text-start">{{ __('leads.error_row') }}</th>
                        <th class="p-3 text-start">{{ __('leads.error_column') }}</th>
                        <th class="p-3 text-start">{{ __('leads.error_value') }}</th>
                        <th class="p-3 text-start">{{ __('leads.error_message') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach (array_slice($errors, 0, 100) as $error)
                        <tr>
                            <td class="p-3 align-top">{{ $error['row'] }}</td>
                            <td class="p-3 align-top">{{ $error['column'] }}</td>
                            <td class="max-w-xs break-all p-3 align-top">{{ $error['value'] }}</td>
                            <td class="p-3 align-top">{{ $error['message'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
