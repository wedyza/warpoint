<x-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/product-info.css') }}">
    @endpush
<main>
    <section id="product-page">
        <div id="product-name">
            <p class="h2-text">{{ $product->name }}</p>
            <p class="description-text">{{ $product->category->name }}</p>
        </div>
        <div id="main-product-info">
            <div id="product-info-left">
                <div id="gallery">
                    <div class="image-container">
                        <img src="https://i.pravatar.cc/1000?u={{ $product->id+random_int(1, 100)  }}" class="big-image">
                    </div>
                    <div class="small-imgs">
                        {{-- потом нормальные картинки доделаю --}}  
                        <div class="small-image-container"><img src="https://i.pravatar.cc/1000?u={{ $product->id+random_int(1, 100) }}" class="small-img"></div>
                        <div class="small-image-container"><img src="https://i.pravatar.cc/1000?u={{ $product->id+random_int(1, 100) }}" class="small-img"></div>
                        <div class="small-image-container"><img src="https://i.pravatar.cc/1000?u={{ $product->id+random_int(1, 100)  }}" class="small-img"></div>
                        <div class="small-image-container"><img src="https://i.pravatar.cc/1000?u={{ $product->id+random_int(1, 100)  }}" class="small-img"></div>
                    </div>
                    <div id="img-buttons">
                        <button id="img-to-left"><img src="{{ asset('/img/img-left.svg') }}" alt="to left"></button>
                        <button id="img-to-right"><img src="{{ asset('/img/img-right.svg') }}" alt="to right"></button>
                    </div>                       
                </div>
                <div id="main-description" class="input-text">
                    <p>{{ $product->description }}</p>
                </div>
            </div>
            <div id="product-info-right">
                <div id="rating-container">
                    <span id="rating-text" class="card-text">Рейтинг товара:</span>
                    <span id="rating-value" class="input-text">5.0</span>
                    <img src="{{ asset('/img/rating.svg') }}" id="rating-img" width="18px" height="18px">
                </div>
                <p id="total-amount" class="card-title">{{ $product->price }} ₽</p>
                <p id="sizes-text" class="card-text">Размеры</p>
                <div class="sizes-list">
                    <button class="input-text">XS</button>
                    <button class="input-text">S</button>
                    <button class="input-text chosen-size">M</button>
                    <button class="input-text">L</button>
                    <button class="input-text">XL</button>
                </div>
                <p id="full-product-info" class="normal-title">О товаре</p>
                <ul id="product-characteristics">
                    <li class="product-characteristic">
                        <p class="characteristic-name">Подошва</p>
                        <p class="characteristic-value">Прочная резина</p>
                    </li>
                    <li class="product-characteristic">
                        <p class="characteristic-name">Материал верха</p>
                        <p class="characteristic-value">Натуральная кожа</p>
                    </li>
                    <li class="product-characteristic">
                        <p class="characteristic-name">Вентиляция</p>
                        <p class="characteristic-value">Есть</p>
                    </li>
                </ul>
                <button id="add-to-cart" class="button-text" data-id="{{ $product->id }}">В корзину</button>
            </div>
        </div>
    </section>
    <section id="reviews">
        <div id="reviews-header">
            <p class="h2-text">Отзывы</p>
            <div id="change-reviews-page">
                <button id="reviews-left">
                    <img src="{{ asset('/img/to-left.svg') }}" alt="to left">
                </button>
                <button id="reviews-right">
                    <img src="{{ asset('/img/to-right.svg') }}" alt="to right">
                </button>
            </div>
        </div>
        <section id="reviews-list">
            <div class="review-card">
                @if (random_int(1, 2) === 7)
                    <div class="cat version1"></div>
                @else
                    @if (random_int(1, 2) === 5)
                        <div class="cat version2"></div> 
                    @endif
                @endif
                <div class="review-header">
                    <p class="user-name normal-title">Дмитрий Точин</p>
                    <div id="rating-container">
                        <span id="rating-value" class="input-text">5.0</span>
                        <img src="{{ asset('/img/rating.svg') }}" id="rating-img" width="18px" height="18px">
                    </div>
                </div>
                <p class="review-content input-text">
                    Купил кеды здесь и очень доволен. 
                    Удобные, стильные, хорошо сидят. Качество материалов отличное, 
                    ноги не устают. Черный цвет универсальный, подходит ко всему. 
                    Отличная вентиляция и прочная шнуровка. Рекомендую!
                </p>
                <p class="review-date description-text">16.02.2024</p>
            </div>
        </section>
    </section>
</main>
@push('scripts')
<script>
    const smallImgs = document.querySelectorAll('.small-img');
    const bigImageContainer = document.querySelector('.image-container');
    const bigImage = document.querySelector('.big-image');
    smallImgs.forEach((smallImg) => {
        smallImg.addEventListener('click', () => {
            const bigImageSrc = smallImg.src;
            bigImage.src = bigImageSrc;
            bigImage.alt = smallImg.alt;
        });
    });
</script>
<script>
    const imgToLeft = document.querySelector('#img-to-left');
    const imgToRight = document.querySelector('#img-to-right');
    let currentIndex = 0;
    smallImgs.forEach((img, index) => {
        img.addEventListener('click', () => {
            currentIndex = index;
            bigImage.src = img.src;
        });
    });
    imgToLeft.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + smallImgs.length) % smallImgs.length;
        bigImage.src = smallImgs[currentIndex].src;
    });
    imgToRight.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % smallImgs.length;
        bigImage.src = smallImgs[currentIndex].src;
    });
</script>
<script src="{{ asset('js/add-to-cart.js') }}"></script>
@endpush
</x-layout>