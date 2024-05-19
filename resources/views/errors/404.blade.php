<x-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/error.css') }}">
    @endpush
    <main class="content">
        <p class="h1-text">Ошибка 404</p>
        <p class="big-text">Кажется что-то пошло не так! Страница, 
            которую вы запрашиваете, не существует. Возможно она устарела, 
            была удалена или был введен не верный адрес в адресной строке.</p>
        <a href="/" class="black-button card-text">Вернуться на главную</a>
    </main>
</x-layout>