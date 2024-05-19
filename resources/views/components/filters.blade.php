<div id="filters-container" class="button-text">
    <div class="filter-container">
        <div class="filter-header">
            <p class="filter-title" id="category-title">Категория</p>
            <img src="img/bottom-arrow.svg" width="6px" height="6px">
        </div>
        <ul class="filter-options description-text filter-with-second">
            <li class="filter-option"><p>Новинки</p></li>
            @foreach ($categories as $category)
                <li class="li-categories filter-option">
                    <p>{{ $category->name }}</p>
                    <img src="img/right-arrow-tr.svg" width="5px" class="arrow-img">
                    <ul class="filter-options-second">
                        @foreach ($category->subcategories as $sub)
                            <li>{{ $sub->name }}</li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
            
        </ul>
    </div>
    <div class="filter-container">
        <div class="filter-header">
            <p class="filter-title" id="price-title">Цена</p>
            <img src="img/bottom-arrow.svg" width="6px" height="6px">
        </div>
        <ul class="filter-options description-text">
            <li class="price-options">
                <div class="price-container">
                    <input type="radio" id="price-1" name="price" value="750" class="radio-input">
                    <img src="img/radio-false.svg" alt="unchecked" class="radio-img">
                </div>
                <label for="price-1">До 750</label>
            </li>
            <li class="price-options">
                <div class="price-container">
                    <input type="radio" id="price-2" name="price" value="2000" class="radio-input">
                    <img src="img/radio-false.svg" alt="unchecked" class="radio-img">
                </div>
                <label for="price-2">750 - 2000</label>
            </li>
            <li class="price-options">
                <div class="price-container">
                    <input type="radio" id="price-3" name="price" value="7500" class="radio-input">
                    <img src="img/radio-false.svg" alt="unchecked" class="radio-img">
                </div>
                <label for="price-3">2000 - 7500</label>
            </li>
            <li class="price-options">
                <div class="price-container">
                    <input type="radio" id="price-4" name="price" value="10000000" class="radio-input">
                    <img src="img/radio-false.svg" alt="unchecked" class="radio-img">
                </div>
                <label for="price-4">7500 и дороже</label>
            </li>
            <li class="price-options">
                <div class="price-container">
                    <input type="radio" id="price-5" name="price" value="" class="radio-input">
                    <img src="img/radio-false.svg" alt="unchecked" class="radio-img">
                </div>
                <label for="price-5">Неважно</label>
            </li>
        </ul>
    </div>
    <a class="blue-button button-text filters-button" href="#" onclick="filter();">Применить</a>
</div>