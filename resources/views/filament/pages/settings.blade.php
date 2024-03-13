
<x-filament-panels::page>
    <form wire:submit="update">
        {{ $this->form }}

        <x-filament::button type="submit" class="mt-2">
            {{ __('admin.Edit')  }}
        </x-filament::button>
    </form>
</x-filament-panels::page>

