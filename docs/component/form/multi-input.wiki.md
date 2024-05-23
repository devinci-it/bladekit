# `form.multi-input` Component

The `form.multi-input` component simplifies the creation of dynamic input fields, such as adding categories or tags. Users can add multiple entries, each with a remove button. The component also includes pre-validation to trim white spaces and escape harmful HTML tags.

## Usage

To use the `form.multi-input` component, include it in your Blade views using the following syntax:

```blade
<x-form.multi-input
    label="Your Label"
    name="inputName"
    placeholder="Enter a value"
    required
/>
```

## Parameters

### `label` (required)

---
- **Description:** The text label for the input field.
- **Type:** string
- **Example:** `label="Categories"`

### `name` (required)

---
- **Description:** The name attribute for the input field, used for form submission and validation.
- **Type:** string
- **Example:** `name="categories"`

### `placeholder` (optional)

---
- **Description:** The placeholder text for the input field.
- **Type:** string
- **Default:** `''`
- **Example:** `placeholder="Enter a category"`

### `required` (optional)

---
- **Description:** Indicates whether the input field is required.
- **Type:** boolean
- **Default:** `false`
- **Example:** `required`

## CSS

The `form.multi-input` component includes basic styles for the form group, form control, and buttons. You can customize these styles as needed.

## JavaScript

The component includes JavaScript to handle adding and removing input fields dynamically. It also validates input by trimming white spaces and escaping harmful HTML tags.

## Example

```blade
<form method="POST" action="/submit-form">
    @csrf
    <x-form.multi-input
        label="Categories"
        name="categories"
        placeholder="Enter a category"
        required
    />
    <button type="submit">Submit</button>
</form>
```

This example creates a form with dynamic input fields for "Categories". Users can add multiple categories, each with an input field and a remove button. The input is sanitized before being added to the list.

## Notes

- Ensure that you include the necessary CSS and JavaScript assets in your Blade views or layout files.
- Customize the component styles and functionality as needed to fit your project's requirements.


### Explanation

1. **Input Handling:**
   - The `addInput` function takes the value from the input field, trims white spaces, and sanitizes it to escape harmful HTML tags.
   - If the input is valid, it creates a new `div` with the class `multi-input-text` containing the input value as a `span` and a hidden input field for form submission.

2. **Sanitization:**
   - The `sanitizeInput` function creates a temporary `div` element, sets its inner text to the input value, and retrieves the HTML-escaped value from the `innerHTML` property. This ensures that any HTML tags in the input are properly escaped.

3. **Removal:**
   - Each added item has a remove button that, when clicked, calls the `removeInput` function to remove the item from the DOM.

