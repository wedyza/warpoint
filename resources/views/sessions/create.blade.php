<x-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/authorization.css') }}">
    @endpush
    <main class="content">
        <p class="form-header normal-title">Зарегистрируйтесь</p>
        <form id="login-form" method="POST" actoin="/register">
            @csrf
            <div class="input-container">
                <input type="email" id="email" name="email" placeholder="Email" required value="{{ old('email') }}">
                @error('email')
                    <p class="error-text nav-text">{{ $message }}</p>
                @enderror
            </div>
            <div class="input-container">
                <input type="password" id="password1" class="password" name="password" placeholder="Пароль" required value="{{ old('password') }}">
                @error('password')
                    <p class="error-text nav-text">{{ $message }}</p>
                @enderror
                <button class="toggle-button">
                    <img src="{{ asset('/img/closed.svg') }}">
                </button>
            </div>
            <div class="input-container">
                <input type="password" id="password2" class="password" name="second_password" placeholder="Пароль еще раз" required>
                <button class="toggle-button">
                    <img src="{{ asset('/img/closed.svg') }}">
                </button>
            </div>
            <div class="input-container">
                <input type="text" id="name" name="name" placeholder="Имя" required value="{{ old('name') }}">
            </div>
            <div class="checkbox-agreements">
                <input type="checkbox" class="checkbox" id="checkbox-agree" required>
                <img src="/img/chekbox-false.svg" alt="unchecked">
                <label for="checkbox-agree" class="description-text checkbox-text">Создавая личный кабинет, 
                    вы соглашаетесь с <a href="#" class="agreements-links">условиями 
                    обработки</a> персональных данных и <a href="#" class="agreements-links">политикой 
                    конфиденциальности</a></label for="">
            </div>
            <button class="button-text" type="submit">Зарегистрироваться</button>
            <div class="to-signup">
                <p class="normal-title">есть учетная запись?</p>
                <a href="/login" class="input-text">Войдите<img src="{{ asset('/img/right-arrow.svg') }}""></a>
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
                        icon.src = "{{ asset('/img/opened.svg') }}";
                    } else {
                        passwordInput.type = 'password';
                        icon.src = "{{ asset('/img/closed.svg') }}";
                    }
                });
            }
        });
    </script>
    <script src="js/checkbox.js"></script>
    @endpush
</x-layout>