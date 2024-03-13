<form wire:submit.prevent="create">
    <input type="file" wire:model="files" multiple>

    @error('files.*') <span class="error">{{ $message }}</span> @enderror

    <button type="submit">Save</button>
</form>
