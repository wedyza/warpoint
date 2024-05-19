<header>
    <a href="/" class="logo-link">
        <img src="/img/logo.svg" alt="logo" width="233px" height="33px">
    </a>
    <nav id="nav-buttons">
        <button id="open-search-input" class="nav-button search-button"><img src="/img/search.svg" alt="search"></button>
            <form id="search-products" action="/">
                <input type="search" id="search-input" name="input">
                <button type="submit" class="nav-button search-button"><img src="/img/search.svg" alt="search"></button>
            </form>
        @auth
        <a href="/profile" class="nav-button"><img src="/img/profile.svg" alt="profile"></a>
        <a href="/cart" class="nav-button"><img src="/img/cart.svg" alt="cart"><p class="cart-amount">{{ auth()->user()->carts()->where('completed', 0)->get()->count() == 0 ? '' : auth()->user()->carts()->where('completed', 0)->get()->count() }}</p></a>
        @endauth
        @guest
        <a href="/login" class="nav-button"><img src="/img/profile.svg" alt="profile"></a>
        <a href="/cart" class="nav-button"><img src="/img/cart.svg" alt="cart"><p class="cart-amount"></p></a>
        @endguest

    </nav>
    @auth
    <div class="points-info">
        <p class="button-text">Ваши баллы:</p>
        <div class="points-count">
            <p class="price-text">{{ auth()->user()->personal_points }}</p>
            <img src="/img/points.svg" alt="points">
        </div>
        <button id="game-info"><img src="/img/info.svg" alt="info"></button>
        <div id="game-info-container" class="description-text">
            <p id="game-info-text">Помогите найти котиков! 
                На сайте спряталось несколько из них. 
                Тыкайте мышкой на обнаруженного котика и 
                зарабатывайте баллы! 5 котиков = 1 балл!</p>
        </div>
    </div>
    @endauth
    @guest
        <div class="points-info">
            <p class="button-text">Ищите котиков и получайте баллы!</p>
            <div class="points-count">
                <img src="/img/points.svg" alt="points">
            </div>
            <button class="game-info"><img src="/img/info.svg" alt="info"></button>
        </div>
    @endguest
</header>