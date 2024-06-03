<!-- resources/views/components/customizable-navbar.blade.php -->

<div id="navbar-component">
    <img src="{{ $logoPath }}" alt="Logo">
    <button id="nightModeToggle">Toggle Night Mode</button>
</div>

@push('styles')
    <style>
        /* Navbar styles */
        #navbar-component {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            background-color: var(--navbar-background-color, #333);
            color: var(--navbar-color, #fff);
            height: 95px;
            padding: 0 20px;
            align-content: stretch;
        }

        #navbar-component > img {
            width: var(--logo-width, 155px);
            height: var(--logo-height, 41px);
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const navbarComponent = document.getElementById('navbar-component');
            const toggleButton = document.getElementById('nightModeToggle');

            toggleButton.addEventListener('click', function () {
                const isNightMode = navbarComponent.classList.toggle('night-mode');
                toggleButton.textContent = isNightMode ? 'Day Mode' : 'Night Mode';

                // Change colors based on night mode
                if (isNightMode) {
                    document.documentElement.style.setProperty('--navbar-background-color', '#333');
                    document.documentElement.style.setProperty('--navbar-color', '#fff');
                } else {
                    // Revert to default colors
                    document.documentElement.style.removeProperty('--navbar-background-color');
                    document.documentElement.style.removeProperty('--navbar-color');
                }
            });
        });
    </script>
@endpush
