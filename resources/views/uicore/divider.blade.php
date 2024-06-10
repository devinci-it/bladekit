 
@php
    $orientationClass = $orientation === 'vertical' ? 'vertical-line' : 'horizontal-line';
@endphp

<div class="line {{ $orientationClass }}" style="height: {{ $orientation === 'vertical' ? $length : $thickness }}; width: {{ $orientation === 'horizontal' ? $length : $thickness }}; margin-bottom: {{ $spacing ?? '10px' }};"></div>
