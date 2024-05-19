const catElements = document.querySelectorAll('.cat');
const balls = document.querySelector('.points-count').querySelector('.price-text');
catElements.forEach(catElement => {
    catElement.addEventListener('click', () => {
        let catClicks = parseInt(localStorage.getItem('catClicks')) || 0;
        catClicks++;

        if (catClicks > 2) {
            catClicks = 0;
            axios.post('/add-point').then((response) => {
                change_price();
                console.log(response);
            }).catch((response)=>console.log(response));
        }

        localStorage.setItem('catClicks', catClicks);
        console.log(`Текущее значение счетчика: ${catClicks}`);

        // удаляем элемент
        catElement.remove();
    });
});

function change_price(){
    balls.innerHTML = parseInt(balls.innerHTML) + 1;
}