<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>WARPOINT</title>
</head>
<body>
    <x-header/>
    <div id="page-preloader" class="preloader">
        <div class="loader">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    {{ $slot }}
    <x-footer/>
</body>
@stack('scripts')
<script src="{{ asset('js/preloader.js') }}"></script>
<script src="{{ asset('js/cats-count.js') }}"></script>
<script>
    const openSearchInput = document.getElementById('open-search-input');
    const searchProducts = document.getElementById('search-products');
    openSearchInput.addEventListener('click', () => {
        searchProducts.style.display = 'flex';
    });
    document.addEventListener('click', (event) => {
        const isClickInsideSearchProducts = searchProducts.contains(event.target);
        const isClickInsideOpenSearchInput = openSearchInput.contains(event.target);
        if (!isClickInsideSearchProducts && !isClickInsideOpenSearchInput) {
            searchProducts.style.display = 'none';
        }
    });
</script>
</html>