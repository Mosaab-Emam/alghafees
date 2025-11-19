<div style="padding: 8px; min-width: 200px;">
    <strong style="font-size: 14px; display: block; margin-bottom: 6px;">{{ $title }}</strong>
    <div style="font-size: 12px; color: #666; line-height: 1.6;">
        <div><strong>ID:</strong> {{ $id }}</div>
        <div><strong>Coordinates:</strong> {{ $lat }}, {{ $lng }}</div>
        @if(isset($description))
            <div style="margin-top: 4px;">{{ $description }}</div>
        @endif
    </div>
</div>

