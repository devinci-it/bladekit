@props([
    'type' => 'primary',
    'size' => 'default',
    'style' => '',
    'icon' => null,
    'iconOnly' => false,
    'disabled' => false,
    'block' => false,

    'id'=>null,
])

@php
    $typeClass = $type;
    $sizeClass = $size === 'default' ? '' : $size;
    $styleClass = $style;
    $disabledClass = $disabled ? 'disabled' : '';
    $blockClass = $block ? 'block' : '';
    $iconOnlyClass = $iconOnly ? 'icon-only' : '';
@endphp

<button
        id="{{ $id }}"
        class="y2 btn {{ $typeClass }} {{ $sizeClass }} {{ $styleClass }} {{ $disabledClass }} {{ $blockClass }} {{ $iconOnlyClass }}"
        {{ $disabled ? 'disabled' : '' }}
>
    @if($icon)
        <span class="icon">{{ $icon }}</span>
    @endif
    @if(!$iconOnly)
        <span class="text px4">{{ $slot }}</span>
    @endif
</button>
