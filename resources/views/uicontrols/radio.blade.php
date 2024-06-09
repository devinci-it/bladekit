@props(['label', 'options', 'name'])

<div class="radio">
    {{ $label }}
    @foreach($options as $option)
        <label>
            <input
                type="radio"
                value="{{ $option }}"
                name="{{ $name }}"
            />
            {{ $option }}
        </label>
    @endforeach
</div>
