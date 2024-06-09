@props(['label', 'initial' => false])

<label class="toggle">
    <input 
        type="checkbox" 
        {{ $initial ? 'checked' : '' }}
    />
    {{ $label }}
</label>
