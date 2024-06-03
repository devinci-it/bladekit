@push('styles')
    <style>
        .flex-container {
            display: flex;
        }

        .flex-container.wrap {
            flex-wrap: wrap;
        }

        .flex-container.scroll-snap {
            scroll-snap-type: x mandatory; /* Change 'x' to 'y' for vertical snapping */
        }

        .flex-container.scroll-snap > * {
            scroll-snap-align: start;
        }
    </style>
@endpush

<div class="flex-container {{ $containerClass }} {{ $scroll === 'auto' ? 'wrap' : 'scroll-snap' }}"
     style="flex-direction: {{ $direction === 'horizontal' ? 'row' : 'column' }}; 
            overflow-{{ $direction === 'horizontal' ? 'x' : 'y' }}: {{ $scroll === 'auto' ? 'auto' : 'scroll' }};">
    {{ $slot }}

</div>


