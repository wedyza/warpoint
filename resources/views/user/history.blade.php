{{-- @props(['products' => null, 'comments' => null]) --}}
<x-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/history.css') }}">
    @endpush
    <main class="content">
        <p class="h2-text">История заказов</p>
        <section id="shopping-list">
            @if ($orders->count() == 0)
                <x-empty/>
            @endif
           @foreach ($orders as $order)
           {{-- {{ ddd($order->carts) }} --}}
            @foreach ($order->carts as $cart)
                <div class="purchase-card">
                    <div class="purchase-full-info">
                        <div class="purchase-img-container">
                            <img src="https://i.pravatar.cc/1000?u={{ $cart->product->id+random_int(1, 10000)  }}">
                        </div>
                        <div class="purchase-info">
                            <p class="card-title product-name">{{ $cart->product->name }}</p>
                            <p class="product-category description-text">{{ $cart->product->category->name }}</p>
                            <p class="normal-title price">{{ $cart->product->price }} ₽</p>
                            <p class="card-text">Размер: {{ $cart->size }}</p>
                        </div>
                        <p class="date description-text">{{ $order->date }}</p>
                    </div>
                    @if($cart->product->comments->count() == 0)
                    <div class="purchase-review">
                        <form class="review-form" action="/post-comment" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $cart->product->id }}">
                            <div class="review-stars">
                                <img src="{{ asset('/img/rating.svg') }}">
                                <img src="{{ asset('/img/rating.svg') }}">
                                <img src="{{ asset('/img/rating.svg') }}">
                                <img src="{{ asset('/img/rating.svg') }}">
                                <img src="{{ asset('/img/rating.svg') }}">
                            </div>
                            <p class="symbols-amount nav-text">0 / 288</p>
                            <input class="review-input" name="body" type="text" placeholder="Начните писать Ваш отзыв" required>
                            <button class="blue-button" type="submit">Отправить отзыв</button>
                        </form>
                    </div>
                    @else
                        @if (random_int(1, 11) === 1)
                        <div class="cat version1"></div>
                        @else
                            @if (random_int(1, 12) === 7)
                            <div class="cat version2"></div>
                            @endif
                        @endif
                    <div class="purchase-review review-done">
                        <div class="review-header">
                            <p class="normal-title">
                                Ваш отзыв
                            </p>
                            <form action="/remove-comment" method="post">
                                <input type="hidden" name="id" value="{{ $cart->product->comments()->where('user_id', auth()->user()->id)->get()[0]->id }}">
                                <img src="{{ asset('/img/remove.svg') }}" class="remove-review" alt="remove">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                        <div class="review-content">
                            <div class="review-rating">
                                <p class="input-text">{{ $cart->product->comments()->where('user_id', auth()->user()->id)->get()[0]->rate }}</p>
                                <img src="{{ asset('/img/rating.svg') }}" alt="star">
                            </div>
                            <div class="review-text input-text">
                                <p>
                                    {{ $cart->product->comments()->where('user_id', auth()->user()->id)->get()[0]->body }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                @error('id')
                    :message
                @enderror
            @endforeach            
           @endforeach
        </section>
    </main>
    @push('scripts')
        <script>
            document.querySelectorAll('.remove-review').forEach( (el) => {
                let form = el.closest('form');
                el.addEventListener('click', (event) => {
                    form.submit();
                });
            })
        </script>
    @endpush
</x-layout>