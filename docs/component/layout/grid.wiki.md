## Grid Layout Blade Component

The `grid.blade.php` component is a versatile Blade component designed for rendering customizable grid layouts in Laravel applications. This component allows for easy creation of responsive grid structures with a specified number of columns or custom column templates.

### Usage

To use the `grid.blade.php` component, include it in your Blade view with the `x-grid` directive:

```blade
<x-grid 
    name="my-grid" 
    :columns="3" 
    :grid-template="'1fr 2fr 1fr'" 
    gap="20px"
>
    <!-- Content for grid columns goes here -->
</x-grid>
```

### Parameters

- `name`: (Required) The base name used to generate dynamic class names for the grid container and columns.
- `columns`: (Optional) The number of equal-sized columns to render if a custom grid template is not provided. Default is `3` columns.
- `gridTemplate`: (Optional) A custom `grid-template-columns` value. If not provided, an equal column layout will be used based on the `columns` parameter.
- `gap`: (Optional) The gap between columns. Default is `'20px'`.
- `containerClass`: (Optional) Additional classes for the grid container. Automatically includes a dynamically generated class based on the `name` parameter.
- `columnClass`: (Optional) Additional classes for each grid column. Automatically includes a dynamically generated class based on the `name` parameter.

### Features

- **Customizable Layout**: Specify the number of columns or provide a custom grid template for complete layout control.
- **Responsive Design**: Automatically adjusts the number of columns based on screen size for optimal viewing experience.
- **Dynamic Class Naming**: Automatically generates class names based on the provided `name` parameter for easy styling and customization.
- **Flexible Content**: Supports any type of content within grid columns, allowing for diverse use cases.

### Example

```blade
<x-grid name="example-grid" :columns="4" gap="30px">
    <div class="grid-item">Item 1</div>
    <div class="grid-item">Item 2</div>
    <!-- Add more grid items here -->
</x-grid>
```

### Notes

#### Caveats

---
- Ensure to provide a unique name parameter to avoid conflicts with other components.
- Custom styling can be applied by targeting the generated classes using CSS or Sass.
- Complex grid layouts may require additional customization beyond the capabilities of this component.
