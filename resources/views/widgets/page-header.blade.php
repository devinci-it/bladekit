@php
    $scalingFactors = [
        'small' => 0.8,
        'medium' => 1,
        'large' => 1.2,
    ];

    $scale = $scalingFactors[$size] ?? 1;

    $preTextSize = $scale * 0.9;
    $sectionHeaderSize = $scale * 2.2;
    $sectionSubHeaderSize = $scale * 1.0;
@endphp

<div class="pb-5 mb-20">
    <!-- Render optional icon -->
    @if($icon)
        <img src="{{ Vite::asset('resources/icons/' . $icon) }}" alt="Icon" class="header-icon">
    @endif

    @if($preText)
        <p class="py0 round btn mb-10 font-400" style="font-size: {{ $preTextSize }}rem;">{{ $preText }}</p>
    @endif

    <h1 class="title-large-text mb-2" style="border-bottom: solid 1px var(--border-color); font-size: {{ $sectionHeaderSize }}rem;">{{ $sectionHeader }}</h1>

    @if($sectionSubHeader)
        <h2 class="subtitle-text mb-2" style="font-size: {{ $sectionSubHeaderSize }}rem;">{{ $sectionSubHeader }}</h2>
    @endif

    @if(count($breadCrumb) > 0)
        <ul class="mb-3 border-t border-color flex">
            @foreach($breadCrumb as $item)
                <li class="inline-block mr-10">
                    <a href="{{ $item['path'] }}" class="caption-text gray no-underline" style="transition: none;">{{ $item['label'] . ' /' }}</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>


@push('styles')
    <style>
        .header-icon {
            width: 24px; /* Adjust size as needed */
            height: 24px;
            margin-right: 10px; /* Add spacing between icon and text */
        }

        .header-container {
            padding-bottom: 0.5rem; /* Add some space below the header */
            margin-bottom: 1.25rem; /* Add margin below the header */
            border-bottom: 1px solid var(--border-color); /* Add a bottom border */
        }

        .pre-text {
            margin-bottom: 0.625rem; /* Add margin below pre-text */
            font-weight: 400; /* Ensure pre-text has regular font weight */
        }

        .title-large-text {
            margin-bottom: 0.25rem; /* Add margin below section header */
        }

        .subtitle-text {
            margin-bottom: 0.25rem; /* Add margin below sub-header */
        }

        .breadcrumb {
            margin-bottom: 0.375rem; /* Add margin below breadcrumb */
            border-top: 1px solid var(--border-color); /* Add a top border to breadcrumb */
            display: flex;
        }

        .breadcrumb-item {
            margin-right: 0.625rem; /* Add margin between breadcrumb items */
        }

        .breadcrumb-item:last-child {
            margin-right: 0; /* Remove margin from last breadcrumb item */
        }

        .breadcrumb-item a {
            color: var(--text-color); /* Ensure breadcrumb links have the text color */
            text-decoration: none; /* Remove underline from breadcrumb links */
        }

        .breadcrumb-item a:hover {
            text-decoration: underline; /* Add underline on hover for breadcrumb links */
        }
    </style>

@endpush