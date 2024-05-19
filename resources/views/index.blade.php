<x-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @endpush
    <main class="content">
        <section id="cover">
            <img src="{{ asset('/img/cover.png') }}" width="694px" height="465px">
            <div class="cover-text">
                <h1>
                    <span class="h1-text h1-first-line">Станьте частью</span>
                    <br>
                    <span class="h1-text line2">ВИРТУАЛЬНОГО МИРА</span>
                    <br>
                    <span class="h1-text line3">warpoint</span>
                </h1>
                <div class="big-text">
                    <span>Официальный интернет-магазин</span>                    
                    <span>/ Быстрая доставка по РФ и СНГ</span>
                </div>
            </div>
        </section>
        <section id="main-content">
            <x-filters :categories="$categories"/>
            <div id="product-list">
                @foreach ($products as $product)
                    <x-product-card :product="$product"/>
                @endforeach
            </div>

            <div id="pagination-container">
                <div id="pagination" style="justify-content: space-between">
                    <a href="{{ request('page') ? '/?page=' . ((int)request('page')-1) : '/' }}" id="page-to-left"><img src="{{ asset('img/white-left.svg') }}" alt="to left" style="margin-right: 15px;"></a>
                    <a href="{{ request('page') ? '/?page=' . ((int)request('page')+1) : '/?page=2' }}" id="page-to-right"><img src="{{ asset('img/white-right.svg') }}" alt="to right" style="margin-left: 15px;"></a>
                </div>
            </div>
        </section>
    </main>
    @push('scripts')
    <script>
        let buttonA = document.querySelector('.filters-button');
        let chosenCategory = 'all';
        let chosenPrice = 'all';
        let url = '?';
        function filter(){
            parse('category', chosenCategory);
            parse('price', chosenPrice);
            window.location.search = url;
        }
        function parse(word, filter){
            let reg = new RegExp(word+"\=.", "i");
            if (reg.test(url)){
                url.replace(reg, word + "=" + filter);
            } else {
                url += "&" + word + "=" + filter;
            }

            buttonA.href = url;
        }

        const radioButtons = document.querySelectorAll('.price-options input[type="radio"]');
            radioButtons.forEach(radioButton => {
            radioButton.addEventListener('click', () => {
                const filterTitle = document.querySelector('#price-title');
                if (radioButton.value === '') {
                    filterTitle.textContent = 'Цена';
                } else {
                    const label = document.querySelector(`label[for="price-${radioButton.id.split('-').pop()}"]`);
                    filterTitle.textContent = label.textContent;
                    chosenPrice = label.textContent;
                }
            });
            });
    </script>
    <script>
        const categoryOptions = document.querySelectorAll('.filter-option, .filter-options-second li');
        categoryOptions.forEach(categoryOption => {
            categoryOption.addEventListener('click', () => {
                const filterTitle = document.querySelector('#category-title');
                if (categoryOption.tagName === 'LI') {
                    const parentList = categoryOption.closest('.filter-options-second');
                    if (parentList) { // проверяем, что parentList не равен null
                        const parentOption = parentList.closest('.filter-option');
                        const selectedOptionText = categoryOption.textContent;
                        chosenCategory = categoryOption.textContent;
                        filterTitle.textContent = selectedOptionText;
                    }
                } 
                if (!categoryOption.querySelector('.filter-options-second')) {
                    console.log('aaaa')
                    const selectedOptionText = categoryOption.querySelector('p').textContent;
                    filterTitle.textContent = selectedOptionText;
                }
            });
        });
    </script>
    <script src="js/checkbox.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const radioInputs = document.querySelectorAll('.price-container .radio-input');
            const radioImages = document.querySelectorAll('.price-container .radio-img');
            radioInputs.forEach(function(radioInput) {
                radioInput.addEventListener('change', function() {
                    radioImages.forEach(function(img) {
                        img.src = '{{ asset('/img/radio-false.svg') }}';
                    });
                    const selectedImg = radioInput.nextElementSibling;
                    selectedImg.src = '{{ asset('/img/radio-true.svg') }}';
                });
            });
        });
    </script>
    <script src="{{ asset('js/add-to-cart.js') }}"></script>
    @endpush
</x-layout>