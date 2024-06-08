@php
    /**
     * Blade Component: Stack Dropdown
     *
     * This component renders a toggle switch with label and optional icon inside a dropdown menu.
     *
     * @props
     * - id: ID for the toggle switch input element.
     * - name: Name for the toggle switch input element.
     * - label: Label for the toggle switch.
     * - default: Default state of the toggle switch.
     * - icon: Optional icon path for the toggle switch.
     * - classes: Optional additional classes for styling.
     */
@endphp

@props(['id', 'name', 'label', 'default', 'icon', 'classes'])

<div class="stack-dropdown {{ $classes }}">
    <div class="toggle-switch p-2">

        <label for="{{ $id }}" class="toggle-label text-color">
            @if($icon)
                <img src="{{ $icon }}" alt="Icon" class="toggle-icon">
            @endif
            {{ $label }}
        </label>

        <div class="toggle-container">
            <input type="checkbox" id="{{ $id }}" name="{{ $name }}" class="toggle-input" {{ $default ? 'checked' : '' }}>
            <label for="{{ $id }}" class="toggle-slider"></label>
        </div>

    </div>
</div>

<style>
    .stack-dropdown {
        width: 100%;
        padding: 10px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: transparent;
        border: none;
        cursor: pointer;
    }

    .stack-dropdown:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .stack-dropdown .toggle-switch {
        display: flex;
        align-items: center;
    }

    .toggle-label {
        margin-right: 10px;
        color: var(--text-color);
        display: flex;
        align-items: center;
    }

    .toggle-icon {
        width: 20px; /* Adjust size as needed */
        height: 20px;
        margin-right: 5px;
    }

    .toggle-container {
        display: flex;
        align-items: center;
        position: relative;
    }

    .toggle-input {
        display: none;
    }

    .toggle-slider {
        width: 50px;
        height: 25px;
        background-color: var(--primary-hover-color);
        border-radius: 15px;
        position: relative;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .toggle-slider:before {
        content: "";
        position: absolute;
        width: 20px;
        height: 20px;
        background-color: white;
        border-radius: 50%;
        top: 50%;
        left: 3px;
        transform: translateY(-50%);
        transition: left 0.2s;
    }

    .toggle-input:checked + .toggle-slider {
        background-color: #03324c;
    }

    .toggle-input:checked + .toggle-slider:before {
        left: calc(100% - 23px); /* Adjust position to align with slider */
    }
</style>
