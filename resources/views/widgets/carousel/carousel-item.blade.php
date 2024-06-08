<!-- resources/views/components/carousel-item.blade.php -->
<div class="carousel-item">
    <img src="{{ $image }}" alt="Image" class="carousel-image">
    <div class="carousel-content">
        {{ $slot }}
    </div>
</div>
