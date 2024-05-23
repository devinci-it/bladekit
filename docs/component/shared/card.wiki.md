

# Blade Component 
### `resources/views/components/card.blade.php`

```blade
<div class="card">
    @isset($header)
        <div class="card-header">
            {{ $header }}
        </div>
    @endisset

    <div class="card-body">
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endisset
</div>
```

### Usage Example

You can use this component in your Blade views as follows:

```blade
<x-card>
    <x-slot name="header">
        <h2>Card Header</h2>
    </x-slot>

    <p>This is the main content of the card.</p>

    <x-slot name="footer">
        <button>Click me</button>
    </x-slot>
</x-card>
```

### Explanation

- **@isset($header)**: Checks if the `header` slot is set and renders its content if it exists.
- **{{ $header }}**: Outputs the content of the `header` slot.
- **{{ $slot }}**: Outputs the default slot content, which is the main body of the card.
- **@isset($footer)**: Checks if the `footer` slot is set and renders its content if it exists.
- **{{ $footer }}**: Outputs the content of the `footer` slot.
