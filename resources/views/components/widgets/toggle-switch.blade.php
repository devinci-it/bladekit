<!-- resources/views/components/toggle-switch.blade.php -->
<div class="toggle-switch {{ $classes }}">
    <label for="{{ $id }}" class="toggle-label">{{ $label }}</label>
    <input type="checkbox" id="{{ $id }}" name="{{ $name }}" class="toggle-input" {{ $default ? 'checked' : '' }}>
    <label for="{{ $id }}" class="toggle-slider"></label>
</div>

<style>
    .toggle-switch {
        display: flex;
        align-items: center;
    }
    .toggle-label {
        margin-right: 10px;
        color: white;
    }
    .toggle-input {
        display: none;
    }
    .toggle-slider {
        width: 50px;
        height: 25px;
        background-color: #ccc;
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
        background-color: #4CAF50;
    }
    .toggle-input:checked + .toggle-slider:before {
        left: 27px;
    }
</style>
