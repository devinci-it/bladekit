<!-- resources/views/layouts/interstitial.blade.phpInterstitial container -->

<div id="interstitial-container">
    <div id="interstitial-content">
        <!-- Optional header slot -->
        @isset($header)
            <div class="interstitial-header">
                {{ $header }}
            </div>
        @endisset

        <h1>{{ $title }}</h1>

        <!-- Slot content -->
        {{ $slot }}

        <!-- Optional footer slot -->
        @isset($footer)
            <div class="interstitial-footer">
                {{ $footer }}
            </div>
        @endisset
    </div>
</div>