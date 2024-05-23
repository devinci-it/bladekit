# `form.multi-step-form` Component Documentation

The `form.multi-step-form` component simplifies the creation of multi-step forms. It provides navigation buttons and handles the steps internally, allowing developers to focus on the form content.

## Usage

To use the `form.multi-step-form` component, include it in your Blade views and wrap each step in a `div` element within the component:

```blade
<form method="POST" action="/submit-form">
    @csrf
    <x-form.multi-step-form>
        <div class="step">
            <x-shared.form-control
                label="First Name"
                name="first_name"
                placeholder="Enter your first name"
                required
            />
        </div>

        <div class="step">
            <x-shared.form-control
                label="Email"
                name="email"
                type="email"
                placeholder="Enter your email"
                required
            />
        </div>

        <div class="step">
            <x-shared.form-control
                label="Password"
                name="password"
                type="password"
                placeholder="Enter your password"
                required
            />
        </div>
    </x-form.multi-step-form>
</form>
```

## Features

- **Step Navigation:** Automatically handles showing and hiding steps.
- **Previous/Next Buttons:** Navigation buttons are included to move between steps.
- **Submit Button:** Only shown on the last step.
- **CSS and JS:** Includes styles and scripts to manage the multi-step functionality.

## CSS

The component includes basic styles for the form and navigation buttons. You can customize these styles as needed.

## JavaScript

The component includes JavaScript to handle step navigation. The current step is tracked and updated as the user navigates through the form.

## Example

```blade
<form method="POST" action="/submit-form">
    @csrf
    <x-form.multi-step-form>
        <div class="step">
            <x-shared.form-control
                label="First Name"
                name="first_name"
                placeholder="Enter your first name"
                required
            />
        </div>

        <div class="step">
            <x-shared.form-control
                label="Email"
                name="email"
                type="email"
                placeholder="Enter your email"
                required
            />
        </div>

        <div class="step">
            <x-shared.form-control
                label="Password"
                name="password"
                type="password"
                placeholder="Enter your password"
                required
            />
        </div>
    </x-form.multi-step-form>
</form>
```

This example creates a multi-step form with three steps. Each step contains a form control created with the `shared.form-control` component. The navigation buttons allow the user to move between steps, and the submit button is only shown on the last step.

## Notes

- Ensure that you include the necessary CSS and JavaScript assets in your Blade views or layout files.
- Customize the component styles and functionality as needed to fit your project's requirements.


### Explanation

1. **Component Structure:**
   - The `multi-step-form` component wraps the form steps, with each step enclosed in a `div` with the class `step`.
   - Navigation buttons (`Previous`, `Next`, `Submit`) are included at the bottom.

2. **JavaScript:**
   - The script handles step navigation by showing the current step and hiding the others.
   - The `nextStep` and `prevStep` functions are used to move between steps.
   - The `showStep` function updates the visibility of steps and navigation buttons based on the current step index.
   - The script includes checks to ensure that elements exist before attempting to manipulate their styles.
   - The `initialize` function waits for the DOM to be fully loaded before accessing the steps.

3. **CSS:**
   - Basic styles are included to hide non-active steps and style the navigation buttons.

