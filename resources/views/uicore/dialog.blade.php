<!-- resources/views/components/dialog.blade.php -->
@props(['size' => 'medium', 'maxHeight' => ''])

@php
    switch ($size) {
        case 'small':
            $width = '320px';
            break;
        case 'large':
            $width = '640px';
            break;
        case 'xlarge':
            $width = '960px';
            break;
        default: // Medium
            $width = '480px';
            break;
    }
@endphp

@push('styles')
    <style>
        .dialog {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            border-radius: 8px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            z-index: 1000;
            display: none; /* Initially hidden */
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(70, 73, 78, 0.5);
            z-index: 999;
            display: none;
        }
    </style>
@endpush

<div class="dialog dialog-{{ $size }}" style="width: {{ $width }}; max-height: {{ $maxHeight }};">
    <button onclick="closeDialog('{{ $size }}Dialog')">Close</button>
    {{ $slot }}
</div>
