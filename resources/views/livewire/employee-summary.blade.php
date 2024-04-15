@php
$employee = json_decode($employee);
@endphp

<div class="py-4 px-10 text-center">
    @if($employee != null)
    <div class="mb-4">الموظف: {{ $employee->title }}</div>
    <div class="flex gap-x-2 mb-4">
        <div>المعاملات: {{ $employee->stats->total }} </div>
        <div>المعاينات: {{ $employee->stats->previews }} </div>
        <div>الإدخال: {{ $employee->stats->entries }}</div>
        <div>المراجعة: {{ $employee->stats->reviews }}</div>
    </div>
    @endif

    <form wire:submit="create">
        {{ $this->form }}

        <button class="mt-4" type="submit">
            تعديل
        </button>
    </form>

    <x-filament-actions::modals />
</div>
