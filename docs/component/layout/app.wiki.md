## `app.blade.php` — Blade Template with Vite Integration
### Overview

This documentation provides a comprehensive guide to the structure and functionality of a Blade template integrated with Vite for managing and bundling frontend assets in a Laravel application. The template includes sections for the header, sidebar, main content, and areas for JavaScript and CSS assets.

---

### Table of Contents

1. [Template Structure](#template-structure)
2. [Header Inclusion](#header-inclusion)
3. [Body and Container](#body-and-container)
4. [Sidebar Section](#sidebar-section)
5. [Main Content Section](#main-content-section)
6. [Vite Scripts Inclusion](#vite-scripts-inclusion)
7. [Stacked Scripts and Styles](#stacked-scripts-and-styles)
8. [Adding Content to Sections](#adding-content-to-sections)
9. [Customizing Scripts and Styles](#customizing-scripts-and-styles)

---

### Template Structure

```blade
@use('Illuminate\Support\Facades\Vite')

<!DOCTYPE html>
<html lang="en">
@include('partials.header')
<body>

<div class="container">

    <aside>
        @yield('sidebar')
    </aside>

    <main class="full p3 m3">
        @yield('content')
    </main>
</div>

<!-- Add your JavaScript links here -->
@viteScripts

@stack('scripts')
@stack('styles')

</body>

</html>
```

---

### Header Inclusion

The `@include` directive is used to include the header partial.

```blade
@include('partials.header')
```

- **Purpose**: To include the content of the `partials.header` Blade file, which typically contains metadata, links to CSS files, and other head elements.
- **File Location**: `resources/views/partials/header.blade.php`

---

### Body and Container

The body of the HTML document and a container div for the main layout.

```html
<body>
<div class="container">
```

- **Class**: `container`
- **Purpose**: To provide a wrapping container for the sidebar and main content sections.

---

### Sidebar Section

The `@yield` directive defines a section named `sidebar`.

```blade
<aside>
    @yield('sidebar')
</aside>
```

- **Purpose**: Allows different views to inject content into the sidebar area.

---

### Main Content Section

The `@yield` directive defines a section named `content`.

```blade
<main class="full p3 m3">
    @yield('content')
</main>
```

- **Purpose**: To inject the main content of the page.
- **Classes**: `full`, `p3`, `m3` (presumably CSS classes for styling)

---

### Vite Scripts Inclusion

The `@viteScripts` directive includes Vite-generated JavaScript files.

```blade
@viteScripts
```

- **Purpose**: To load scripts that have been processed and bundled by Vite, a modern frontend build tool.

---

### Stacked Scripts and Styles

The `@stack` directive allows for the inclusion of scripts and styles from various parts of the application.

```blade
@stack('scripts')
@stack('styles')
```

- **Purpose**: To include additional scripts and styles that are pushed from other parts of the application.

---

### Adding Content to Sections

To add content to the defined sections (`sidebar` and `content`), create another Blade file that extends this template and defines these sections.

#### Example Usage

Create a Blade view file:

```blade
@extends('layout.master')

@section('sidebar')
    <ul>
        <li><a href="#">Link 1</a></li>
        <li><a href="#">Link 2</a></li>
    </ul>
@endsection

@section('content')
    <h1>Main Content</h1>
    <p>This is the main content area.</p>
@endsection
```

- **@extends**: Indicates the master layout file to extend.
- **@section**: Defines content for `sidebar` and `content` sections.

---

### Customizing Scripts and Styles

To add custom scripts and styles specific to a page, use the `@push` directive in the child Blade files.

#### Example Usage

```blade
@push('scripts')
    <script src="path/to/custom/script.js"></script>
@endpush

@push('styles')
    <link href="path/to/custom/style.css" rel="stylesheet">
@endpush
```

- **@push**: Adds items to the stack for `scripts` and `styles`.

---
