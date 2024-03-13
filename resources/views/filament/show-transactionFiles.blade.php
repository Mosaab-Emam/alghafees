
@if( count($files))
    <h2 class="font-bold">{{ __('admin.files') }}</h2>
    @foreach($files as $file)
        <div class="flex  my-2">
            <a href="{{ asset($file->path) }}" target="_blank" class="text-blue-600 break-words">
                {{$file->path}}
            </a>
        </div>
    @endforeach

@endif
