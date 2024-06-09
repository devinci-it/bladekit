@props(['label', 'options'])

<label class="dropdown">
    {{ $label }}
    <select>
        @foreach($options as $option)
            <option value="{{ $option }}">{{ $option }}</option>
        @endforeach
    </select>
</label>
