<x-layout>
    @push('styles')
     <link rel="stylesheet" href="{{ asset('css/authorization.css') }}">
    @endpush
    <main class="content">
        <p class="form-header normal-title">Забыли пароль?</p>
        <form id="login-form" method="POST" action="/forgot-password">
            @csrf
            <div class="input-container">
                <input type="email" id="email" name="email" placeholder="Email" required>
                @error('email')
                    <p class="error-text nav-text">{{ $message }}</p>
                @enderror
            </div>
            <button class="button-text" type="submit">Отправить письмо</button>
        </form>
    </main>
</x-layout>