@props(['product'])
<div class="product-card">
    <div class="card-img-container">
        <img src="https://i.pravatar.cc/?u={{ $product->id + random_int(10, 100) }}">
    </div>
    @auth
        @if (random_int(1, 15) === 2)
            <div class="cat version1"></div>
        @else
            @if (random_int(1, 20) === 3)
                <div class="cat version2"></div>
            @endif
        @endif
    @endauth
    <div class="card-product-info">
        <p class="normal-title">{{ $product->name }}</p>
        <p class="product-category input-text">{{ $product->category->name }}</p>
        <div class="description-container">
            <p class="product-description description-text">
                {{ $product->description }}
            </p>
        </div>
        <a href="/about/{{ $product->id }}" class="product-open-info">
            <p class="input-text">Подробнее</p>
            <img src="{{ asset('/img/right-arrow.svg') }}" width="10" height="11">
        </a>
        <div class="product-card-bottom">
            <button class="product-to-cart button-text" data-id="{{ $product->id }}">В корзину</button>
            <div class="product-price">
                <p class="price-text">{{ $product->price }}</p><p class="price-symbol">₽</p>
            </div>
        </div>
    </div>
</div>