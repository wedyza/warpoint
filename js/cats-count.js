const catElements = document.querySelectorAll('.cat');

catElements.forEach(catElement => {
    catElement.addEventListener('click', () => {
        let catClicks = parseInt(localStorage.getItem('catClicks')) || 0;
        catClicks++;

        if (catClicks > 2) {
            catClicks = 0;
        }

        localStorage.setItem('catClicks', catClicks);
        console.log(`Текущее значение счетчика: ${catClicks}`);

        // удаляем элемент
        catElement.remove();
    });
});
