<!-- resources/views/components/form-group.blade.php -->
<div class="form-group">
    <label for="{{ $name }}">{{ $label }}:</label>
    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ $value }}" {{ $required ? 'required' : '' }}>
</div>
