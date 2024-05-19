<x-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    @endpush
    <main class="content">
        <p class="normal-title cart-title">Мои покупки</p>
        <section class="main-content">
            <section id="cart-list">
                {{-- <h1>Похоже ничего нет, самое время прикупить чего-нибудь!</h1> --}}
                @if ($products->count() == 0)
                    <x-empty/>
                @endif
                @foreach ($products as $product)
                    <div class="cart-product-card" data-id="{{ $product->pivot->id }}">
                        @if (random_int(1, 11) === 1)
                        <div class="cat version1"></div>
                        @else
                            @if (random_int(1, 12) === 7)
                            <div class="cat version2"></div>
                            @endif
                        @endif
                        <div class="card-img-container">
                            <img src="/img/empty.png">
                        </div>
                        <div class="cart-product-info">
                            <p class="product-category description-text">{{ $product->category->name }}</p>
                            <p class="card-text product-name">{{ $product->name }}</p>
                            <div class="product-price">
                                <p class="price-text">{{ $product->price }}</p><p class="price-symbol">₽</p>
                            </div>
                            <div class="sizes-list">
                                <p class="input-text">XS</p>
                                <p class="input-text">S</p>
                                <p class="input-text chosen-size">M</p>
                                <p class="input-text">L</p>
                                <p class="input-text">XL</p>
                            </div>
                        </div>
                        <form action="/remove" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <button class="remove-product"><img src="/img/remove.svg"></button>
                        </form>
                        <div class="change-amount-container normal-title">
                            <button class="change-amount decrease-amount"><span>-</span></button>
                            <span class="amount">1</span>
                            <button class="change-amount increase-amount"><span>+</span></button>
                        </div>
                    </div>
                @endforeach
            </section>
            <section id="cart-info">
                <div class="address-info">
                    <p class="normal-title">Ваш адрес доставки</p>
                    <p class="card-text" id="current-address">
                        почтовое отделение (г. екатеринбург ул. ленина д. 12)
                    </p>
                    <button class="change-address card-text" id="change-address-button">Изменить</button>
                    <form id="address-form" style="display: none;">
                        <div class="adress-input">
                            <input type="text" id="address" class="error-input" required>
                            <p class="error-text nav-text">Неверный адрес</p>
                        </div>
                        <button type="submit" class="change-address card-text">Сохранить</button>
                    </form>
                </div>
                <div class="delivery-info">
                    <p class="normal-title">Доставка:</p>
                    <p class="normal-title">Мы доставляем с помощью Cdek</p>
                    <div class="delivery-city">
                        <p class="card-text">В ваш город:</p>
                        <div class="product-price">
                            <p class="price-text">150</p><p class="price-symbol">₽</p>
                        </div>
                    </div>
                </div>
                <div class="pay-info">
                    <div class="total-amount">
                        <p class="normal-title">Итого:</p>
                        <p id="total-amount" class="card-title">{{ $totalPrice }} ₽</p><p class="card-title">+ 150 ₽</p>
                    </div>
                    
                    @if ($products->count() > 0)
                        <button id="use-points" class="default">
                            Применить <span id="points-amount">{{ auth()->user()->personal_points }}</span> баллов 
                        </button>
                        <button class="to-payment button-text" onclick="pay();">Перейти к оплате</button>
                        @else
                        <button id="use-points" class="default" disabled>
                            Применить <span id="points-amount">{{ auth()->user()->personal_points }}</span> баллов 
                        </button>
                        <button class="to-payment button-text" onclick="pay();" disabled>Перейти к оплате</button>
                    @endif
                </div>
            </section>
        </section>
    </main>

    @push('scripts')
    <script>
        let use_points = false;
        class Cart{
            constructor(id){
                this.id = id;
                this.amount = 1;
                this.size = 46;
            }
        }
        let carts_ids = [
            @foreach ($products as $product)
            new Cart({{ $product->pivot->id }}) ,
            @endforeach
        ];
        function pay(){
            let data = {
                ids: carts_ids,
                points: use_points,
                address: document.getElementById('current-address').innerHTML
            }
            axios.post('/pay', data)
                .then((response) => {
                    console.log(response);
                    location.reload();
                })
                .catch((response) => console.log(response));
        }
    </script>
    <script>
        const totalAmountElement = document.getElementById('total-amount');
        const changeAmountContainers = document.querySelectorAll('.change-amount-container');
        changeAmountContainers.forEach((container) => {
            const decreaseButton = container.querySelector('.decrease-amount');
            let card = container.closest('.cart-product-card');
            let price = card.querySelector('.price-text').innerHTML;
            const increaseButton = container.querySelector('.increase-amount');
            const amountSpan = container.querySelector('.amount');
            let amount = parseInt(amountSpan.textContent);
            let totalAmount;
            card.querySelector('.sizes-list').querySelectorAll('.input-text').forEach( (el) => {
                el.addEventListener('click', (event) => {
                    let activeElement = card.querySelector('.chosen-size').classList.remove('chosen-size');
                    el.classList.add('chosen-size');
                    let size;
                    
                    switch(el.innerHTML){
                        case 'XS':
                            size = 42
                            break;
                        case 'S':
                            size = 44;
                            break;
                        case 'M':
                            size = 46;
                            break;
                        case 'L':
                            size = 48;
                            break;
                        case 'XL':
                            size = 50;
                            break;
                    }

                    carts_ids.forEach( (cart) => {
                        if (cart.id == card.dataset.id)
                            cart.size = size;
                    });
                });
            });


            decreaseButton.addEventListener('click', () => {
                carts_ids.forEach( (cart) => {
                        if (cart.id == card.dataset.id)
                        {
                            cart.amount--;
                            if (cart.amount < 1) {
                                cart.amount = 1;
                        }
                }
                    });
                totalAmount = parseInt(totalAmountElement.textContent.replace(' ₽', ''), 10);
                amount--;
                if (amount < 1) {
                    amount = 1
                }
                amountSpan.textContent = amount;
                totalAmount -= price;
                totalAmountElement.textContent = `${totalAmount} ₽`;
            });


            increaseButton.addEventListener('click', () => {
                carts_ids.forEach( (cart) => {
                        if (cart.id == card.dataset.id)
                        {
                            cart.amount++;
                            if (cart.amount > 10) {
                                cart.amount = 10;
                            }
                        }
                });
                totalAmount = parseInt(totalAmountElement.textContent.replace(' ₽', ''), 10);
                amount++;
                if (amount > 10) {
                    amount = 10;
                };
                amountSpan.textContent = amount;
                totalAmount += parseInt(price);
                totalAmountElement.textContent = `${totalAmount} ₽`;
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const changeAddressButton = document.getElementById('change-address-button');
            const currentAddress = document.getElementById('current-address');
            const addressForm = document.getElementById('address-form');

            changeAddressButton.addEventListener('click', function() {
                currentAddress.style.display = 'none';
                changeAddressButton.style.display = 'none';
                addressForm.style.display = 'block';
            });

            addressForm.addEventListener('submit', function(event) {
                event.preventDefault();
                const newAddress = document.getElementById('address').value;

                if (newAddress.trim() !== '') {
                    currentAddress.textContent = newAddress;
                }

                currentAddress.style.display = 'block';
                changeAddressButton.style.display = 'block';
                addressForm.style.display = 'none';
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const usePointsButton = document.getElementById('use-points');
            const pointsAmount = document.getElementById('points-amount').textContent;
            const totalAmountElement = document.getElementById('total-amount');
            const points = parseInt(pointsAmount, 10);

            usePointsButton.addEventListener('click', function() {
                let totalAmount = parseInt(totalAmountElement.textContent.replace(' ₽', ''), 10);
                use_points = !use_points;
                if (usePointsButton.classList.contains('default')) {
                    if (points/ totalAmount > 0.3){
                        totalAmount *= 0.7;
                    } else {
                        totalAmount -= points;
                    }
                    totalAmount = totalAmount.toFixed(0);
                    usePointsButton.classList.remove('default');
                    usePointsButton.classList.add('inactive');
                } else {
                    if (points / totalAmount > 0.3){
                        totalAmount /= 0.7;
                    } else {
                        totalAmount += points;
                    };
                    totalAmount = totalAmount.toFixed(0);
                    usePointsButton.classList.remove('inactive');
                    usePointsButton.classList.add('default');
                }

                totalAmountElement.textContent = `${totalAmount} ₽`;
            });
        });
    </script>
    @endpush
</x-layout>