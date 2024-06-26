<x-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('/css/authorization.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/profile.css') }}">
    @endpush
    <main class="content">
        <div class="profile-header">
            <p class="h2-text">Здравствуйте, {{ auth()->user()->name }}!</p>
            <a href="/profile/orders-history" class="history card-text">История заказов</a>
        </div>
        <section id="profile-forms">
            <form id="user-info-form" action="/profile" method="POST">
                <p class="normal-title">Мои данные</p>
                @csrf
                <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" placeholder="Имя" required>
                <div class="input-container">
                    <input type="email" id="email" name="email" placeholder="Email" value="{{ auth()->user()->email }}" required>
                    <p class="error-text nav-text" style="display: none;">Ошибка</p>
                </div>
                {{-- <p class="normal-title">Мой адрес доставки</p>
                <div class="adress-input">
                    <input type="text" id="address" class="{{ $errors->any() ? 'error-input' : '' }}" placeholder="Адрес" required>
                    @error('address')
                        <p class="error-text nav-text">{{ $message }}</p>
                    @enderror
                </div> --}}
                <button class="button-text" type="submit">Сохранить</button>
            </form>
            <form id="password-change" action="/password-change" method="POST">
                @csrf
                @if (random_int(1, 10) === 7)
                    <div class="cat version1"></div>
                @else
                    @if (random_int(1, 10) === 5)
                    <div class="cat version2"></div>
                    @endif
                @endif
                <p class="normal-title">Сменить пароль</p>
                <div class="input-container">
                    <input id="password" class="password" type="password" name="password_old" placeholder="Старый пароль" required></div>
                <div class="input-container">
                    <input id="password1" class="password" placeholder="Новый пароль" type="password" name="password" required></div>
                <div class="input-container">
                    <input id="password2" class="password" placeholder="Новый пароль еще раз" type="password" name="password_repeat" required>
                    @error('password')
                        <p class="error-text nav-text">{{ $message }}</p>
                @enderror
                </div>
                {{-- <a href="#" class="forgot-password input-text">Забыли пароль?<img src="img/right-arrow.svg"></a> --}}
                <button class="button-text" type="submit">Сохранить</button>
            </form>
        </section>
    </main>
</x-layout>