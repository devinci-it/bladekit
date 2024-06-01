<div class="anchor-row {{ $classes }}">
    <a href="{{ $href }}" class="anchor-link">
        @if($icon)
            <img src="@bladekitIcon($icon)" alt="Icon" class="anchor-icon">
        @endif
        <div class="anchor-text">
            <div class="anchor-header">{{ $header }}</div>
            @if($subtitle)
                <div class="anchor-subtitle">{{ $subtitle }}</div>
            @endif
        </div>
        <div class="anchor-arrow">
            ➔
        </div>
    </a>
</div>

<style>
    .anchor-row {

        display: flex;
        align-items: center;
        border-radius: 8px;
        background-color: rgba(255, 255, 255, 0.1);
        transition: background-color 0.3s ease, transform 0.3s ease;
        box-shadow: 0 4px 16px rgba(31, 38, 135, 0.17);
    }

    .anchor-row:hover {
        background-color: rgba(255, 255, 255, 0.2);
        transform: translateY(-3px);
    }

    .anchor-link {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: var(--text-color);
        width: 100%;
    }

    .anchor-icon {
        width: 24px;
        height: 24px;
        margin-right: 10px;
    }

    .anchor-text {
        flex-grow: 1;
    }

    .anchor-header {
        font-weight: 570;
        font-size: 1rem;
    }

    .anchor-subtitle {
        font-size: 0.8rem;
        color: lightgray;
        margin-top: 0;
        line-height: 6.5px;
        padding-bottom: 10px;
    }

    .anchor-arrow {
        font-size: 1.2rem;
        transition: transform 0.3s ease;
    }

    .anchor-row:hover .anchor-arrow {
        transform: translateX(5px);
    }
</style>
