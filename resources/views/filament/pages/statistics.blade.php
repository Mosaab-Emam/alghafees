<x-filament-panels::page>
    <div class="w-full grid md:grid-cols-2 gap-2 md:gap-4" dir="rtl">
        <div class="col-span-full w-full mb-5">
                <livewire:filters/>
        </div>

        <div class="col-span-1">
                <livewire:companies-count-widget/>
        </div>
        <div class="col-span-1">
                <livewire:status-count-widget/>
        </div>

        <div class="col-span-1">
                <livewire:entry-employee-count-widget/>
        </div>
        <div class="col-span-1">
                <livewire:previewer-employee-count-widget/>
        </div>
        <div class="col-span-1">
                <livewire:reviewer-employee-count-widget/>
        </div>
    </div>
</x-filament-panels::page>
