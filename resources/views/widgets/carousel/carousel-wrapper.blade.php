<!-- resources/views/carousel.blade.php -->
<div class="carousel {{ $orientation }}">
    <div class="carousel-inner">
        @foreach($items as $item)
            <x-carousel-item :image="$item['image']">
                <h3>{{ $item['title'] }}</h3>
                <p>{{ $item['description'] }}</p>
                <!-- Add any other content here -->
            </x-carousel-item>
        @endforeach
    </div>
    <button class="carousel-control prev" onclick="prevSlide()">❮</button>
    <button class="carousel-control next" onclick="nextSlide()">❯</button>
</div>

<style>
    .carousel {
        position: relative;
        width: 100%;
        overflow: hidden;
    }
    .carousel-inner.horizontal {
        display: flex;
        transition: transform 0.5s ease;
    }
    .carousel-inner.vertical {
        display: block;
        transition: transform 0.5s ease;
    }
    .carousel-item {
        min-width: 100%;
        box-sizing: border-box;
        padding: 20px;
    }
    .carousel-image {
        width: 100%;
        height: auto;
    }
    .carousel-content {
        text-align: center;
    }
    .carousel-control {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0,0,0,0.5);
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
    }
    .carousel-control.prev {
        left: 10px;
    }
    .carousel-control.next {
        right: 10px;
    }
    .carousel.vertical .carousel-control {
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
    }
    .carousel.vertical .carousel-control.prev {
        top: 10px;
    }
    .carousel.vertical .carousel-control.next {
        top: calc(100% - 40px);
    }
</style>

<script>
    let currentIndex = 0;

    function showSlide(index, orientation) {
        const carouselInner = document.querySelector('.carousel-inner');
        const totalItems = document.querySelectorAll('.carousel-item').length;
        if (index >= totalItems) {
            currentIndex = 0;
        } else if (index < 0) {
            currentIndex = totalItems - 1;
        } else {
            currentIndex = index;
        }
        if (orientation === 'horizontal') {
            carouselInner.style.transform = `translateX(-${currentIndex * 100}%)`;
        } else {
            carouselInner.style.transform = `translateY(-${currentIndex * 100}%)`;
        }
    }

    function nextSlide() {
        const orientation = document.querySelector('.carousel').classList.contains('vertical') ? 'vertical' : 'horizontal';
        showSlide(currentIndex + 1, orientation);
    }

    function prevSlide() {
        const orientation = document.querySelector('.carousel').classList.contains('vertical') ? 'vertical' : 'horizontal';
        showSlide(currentIndex - 1, orientation);
    }
</script>
