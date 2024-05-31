{{-- resources/views/layouts/flex.blade.php --}}

<div class="{{ $containerClass }} p3 my2" style="display: flex; flex-wrap: {{ $wrap ?? 'wrap' }};">
    @for ($i = 1; $i <= ($gridTemplate ? substr_count($gridTemplate, ' ') + 1 : $columns); $i++)
        <div class="{{ $columnClass }} my3" style="flex: {{ isset($maxCol) ? '1 0 ' . (100 / $maxCol) . '%' : '1' }};
            @if (isset($maxRow))
                max-width: {{ isset($maxCol) ? 'calc(' . (100 / $maxCol) . '% - ' . $gap . ')' : '100%' }};
                @if ($i > $maxRow)
                    display: none;
                @endif
            @endif
            ">
            @if (isset(${'slot' . $i}))
                {{ ${'slot' . $i} }}
            @else
                <!-- Render empty state component or leave blank -->
                <x-empty-state />
            @endif
        </div>
    @endfor
</div>

@push('styles')
    <style>
        /* No additional styles needed since flexbox properties are applied inline */
    </style>
@endpush
