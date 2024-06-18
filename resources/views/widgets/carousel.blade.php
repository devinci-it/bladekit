<!-- bladekit/resources/views/widgets/carousel.blade.php -->

@props(['orientation' => 'horizontal', 'theme' => 'light', 'rowOrCol' => 'one-row', 'size' => 'large', 'autoScroll' => false])

<div class="carousel-wrapper {{ $theme }}">
    <div class="carousel {{ $orientation }} {{ $rowOrCol }} {{ $size }}">
        @foreach ($slots as $key => $slot)
            <div class="carousel-slide">
                {!! $slot !!} 
                <div class="card">
                    <div class="card-body">
                        {{ $slides[$key]['content'] }}
                        @foreach($slides[$key]['slots'] as $subSlot)
                            {!! $subSlot !!}
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@once
@push('scripts')
<script>
    (function () {
        var carousel = document.querySelector('.carousel.{{ $orientation }}');
        var slides = carousel.querySelectorAll('.carousel-slide');
        var slideWidth = slides[0].offsetWidth;
        var currentSlide = 0;
        var slideCount = slides.length;
        var isAutoScroll = {{ $autoScroll ? 'true' : 'false' }};
        var autoScrollInterval = {{ $autoScrollInterval ?? 5000 }}; // Default interval is 5000ms

        // Adjust carousel based on orientation
        if ('{{ $orientation }}' === 'horizontal') {
            carousel.style.width = slideWidth * slideCount + 'px';
        }

        // Auto scroll
        function autoScroll() {
            if (isAutoScroll) {
                setInterval(function () {
                    currentSlide = (currentSlide + 1) % slideCount;
                    moveCarousel();
                }, autoScrollInterval);
            }
        }

        // Move carousel
        function moveCarousel() {
            var translateValue = -currentSlide * slideWidth;
            carousel.style.transform = 'translateX(' + translateValue + 'px)';
        }

        // Initializations
        moveCarousel();
        autoScroll();
    })();
</script>
@endpush
@endonce

@push('styles')
<style>
    .carousel-wrapper {
        position: relative;
        overflow: hidden;
        margin: 20px 0;
    }
    .carousel {
        display: flex;
        transition: transform 0.5s ease;
        /* Basic carousel styles */
    }
    .carousel.horizontal {
        flex-direction: row;
    }
    .carousel.vertical {
        flex-direction: column;
    }
    .carousel.light {
        /* Light theme styles */
        background-color: #f5f5f5;
        color: #333;
    }
    .carousel.dark {
        /* Dark theme styles */
        background-color: #333;
        color: #f5f5f5;
    }
    .carousel.large {
        /* Large size styles */
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
    }
    .carousel.medium {
        /* Medium size styles */
        width: 80%;
        max-width: 800px;
        margin: 0 auto;
    }
    .carousel.small {
        /* Small size styles */
        width: 60%;
        max-width: 600px;
        margin: 0 auto;
    }
    .carousel-slide {
        /* Slide styles */
        min-width: 200px;
        box-sizing: border-box;
        flex: 0 0 auto;
    }
    .card {
        /* Card styles */
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 10px;
    }
</style>
@endpush
