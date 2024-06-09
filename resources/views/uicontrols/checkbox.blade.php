@props(['label', 'checked' => false])

<label class="checkmark">
    <input 
        type="checkbox" 
        {{ $checked ? 'checked' : '' }}
        readonly
    />
    {{ $label }}
</label>
