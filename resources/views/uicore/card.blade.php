@php
    /**
     * Renders a rectangular sub-link card.
     *
     * @param string $title The title of the card.
     * @param string $slot The main content of the card.
     * @param string $header The header content of the card.
     * @param string $footer The footer content of the card.
     * @param string $link The URL the card links to.
     * @param string $linkText The text for the link.
     * @param string $size The size of the card: 'small', 'medium', 'large'.
     * @param string $theme The theme of the card: 'light', 'dark'.
     * @param string $customColor The custom background color of the card.
     */
@endphp

<div class="card {{ $size }} {{ $theme }}" style="background-color: {{ $customColor ?? 'transparent' }};">
    @isset($title)
        <div class="card-title">
            {{ $title }}
        </div>
    @endisset

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

    @isset($link)
        <div class="card-link">
            <a href="{{ $link }}" style="color: {{ $theme === 'light' ? '#007bff' : '#17a2b8' }};">{{ $linkText }}</a>
        </div>
    @endisset
</div>

@push('styles')
<style>
    .card {
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 15px;
        margin-bottom: 15px;
        transition: border-color 0.3s ease;
    }

    .card-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .card-header {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .card-body {
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 10px;
    }

    .card-footer {
        font-size: 14px;
        margin-top: 10px;
    }

    .card-link a {
        text-decoration: none;
    }

    .card-link a:hover {
        text-decoration: underline;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .card {
            padding: 10px;
        }
    }
</style>
@endpush
