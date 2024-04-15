<x-filament-widgets::widget class="fi-account-widget">
    <x-filament::section>
        <div class="flex items-center gap-x-3">
            <div class="flex-1">
                <h2 class="grid flex-1 text-base font-semibold leading-6 text-gray-950 dark:text-white">
                    عمليات سريعة
                </h2>
            </div>

            <div class="flex flex-col gap-y-1">
                {{ $this->testAction }}

                <x-filament-actions::modals />
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
