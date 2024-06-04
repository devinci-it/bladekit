<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('vendor/pagination/pagination.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/icons/favicon.svg') }}">
    <title>@yield('title', config('bladekit.package_name'))</title>

    @bladekitStyles

        @if(app()->environment('local'))
            <!-- Vite's development server provides assets in development -->

        @vite(['resources/js/bladekit.js', 'resources/css/index.css','resources/scss/index.scss'])


</head>
