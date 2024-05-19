<x-layout> 
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/authorization.css') }}">
    @endpush
    <main class="content">
        <p class="form-header normal-title">Войдите</p>
    <form id="login-form" method="POST" action="/login">
            @csrf
            <div class="input-container">
                <input class="{{ $errors->any() ? 'error-input' : '' }}" type="email" id="email" name="email" placeholder="Email" required>
                @error('email')
                    <p class="error-text nav-text">{{ $message }}</p>
                @enderror
            </div>
            <div class="input-container">
                <input type="password" id="password" class="password" name="password" placeholder="Пароль" required>
                <button class="toggle-button">
                    <img src="{{ asset('/img/closed.svg') }}">
                </button>
            </div>
            <a href="/forgot-password" class="forgot-password input-text">Забыли пароль?<img src="{{ asset('/img/right-arrow.svg') }}."></a>
            <button class="button-text" type="submit">Войти</button>
            <p class="to-signup-title normal-title">Нет учетной записи?</p>
            <div class="to-signup">
                <p class="input-text">Создайте учетную запись чтобы следить за посылками</p>
                <a href="/register" class="input-text">Зарегистрироваться<img src="{{ asset('/img/right-arrow.svg') }}."></a>
            </div>
        </form>
    </main>

    @push('scripts')
    <script>
        document.querySelectorAll('.input-container').forEach(function(container) {
            const passwordInput = container.querySelector('.password');
            const toggleButton = container.querySelector('.toggle-button');

            if (passwordInput && toggleButton) {
                const icon = toggleButton.querySelector('img');

                toggleButton.addEventListener('click', function(event) {
                    event.preventDefault();
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        icon.src = '/img/opened.svg';
                    } else {
                        passwordInput.type = 'password';
                        icon.src = '/img/closed.svg';
                    }
                });
            }
        });

    </script>
    @endpush
</x-layout>