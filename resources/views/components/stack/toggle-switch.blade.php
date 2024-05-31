<!-- resources/views/components/toggle-switch.blade.php -->
<div class="toggle-switch p2 {{ $classes }}">

    <label for="{{ $id }}" class="toggle-label text-color" style="font-weight: 570;">
        @if($icon)

            <img src="@bladekitIcon($icon)" alt="Icon" class="toggle-icon">        @endif
            &nbsp; {{ $label }}</label>
    <div class="toggle-container">

        <input type="checkbox" id="{{ $id }}" name="{{ $name }}" class="toggle-input" {{ $default ? 'checked' : '' }}>
        <label for="{{ $id }}" class="toggle-slider"></label>
    </div>
</div>

<style>

    .toggle-switch {
        justify-content: space-between;
        display: flex;
        align-items: center;
        border-radius: 8px;
        background-color: rgba(255, 255, 255, 0.1);
        transition: background-color 0.3s ease, transform 0.3s ease;
        box-shadow: 0 4px 16px rgba(31, 38, 135, 0.17);
    }
    .toggle-label {
        margin-right: 10px;
        color: var(--text-color);
        display: flex;
        align-items: center;
        align-content: center;
        justify-content: space-evenly;
        flex-direction: row;
    }
    .toggle-container {
        display: flex;
        align-items: center;
        position: relative;
    }
    .toggle-icon {
        width: 20px; /* Adjust size as needed */
        height: 20px;
        margin-right: 5px;
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
