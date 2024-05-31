<div class="{{ $containerClass }} p3 my2">
    @for ($i = 1; $i <= ($gridTemplate ? substr_count($gridTemplate, ' ') + 1 : $columns); $i++)
        <div class="col col-{{ $i }} {{ $columnClass }} my3">
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
        .{{ $containerClass }} {
            display: grid;
            grid-template-columns: {{ $gridTemplate ?? 'repeat(' . $columns . ', 1fr)' }};
            gap: {{ $gap }};
        }

        @media (max-width: 1200px) {
            .{{ $containerClass }} {
                grid-template-columns: {{ $gridTemplate ?? 'repeat(' . min($columns, 2) . ', 1fr)' }}; /* Default to 2 equal columns */
            }
        }

        @media (max-width: 768px) {
            .{{ $containerClass }} {
                grid-template-columns: 1fr; /* Single column on small screens */
            }
        }

        .{{ $columnClass }} {
            /* Ensure content takes up available space */
            width: 100%;
        }
    </style>
@endpush
