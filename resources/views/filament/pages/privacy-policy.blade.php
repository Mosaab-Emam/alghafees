<x-filament-panels::page>
    <div>
        <form wire:submit="update">
            {{ $this->form }}

            <x-filament::button type="submit">
                {{ __('تحديث') }}
            </x-filament::button>
        </form>

        <x-filament-actions::modals />
    </div>
</x-filament-panels::page>
