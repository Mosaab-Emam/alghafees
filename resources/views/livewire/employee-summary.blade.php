@php
$record = json_decode($record);

if ($record) {
if ($type == 'previewer')$employee = $record->previewer;
else if ($type == 'income') $employee = $record->income;
else if ($type == 'review') $employee = $record->review;
else $employee = null;
} else {
$employee = null;
}
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
