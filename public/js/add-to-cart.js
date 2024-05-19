let amount = document.querySelector('.cart-amount');

document.querySelectorAll('.product-to-cart').forEach( (e) => {
    e.addEventListener('click', (event) => {
        if (amount.innerHTML == ''){
            amount.innerHTML = 1;
        } else {
            amount.innerHTML = parseInt(amount.innerHTML) + 1;
        }
        let data = {
            id: e.dataset.id
        };
        axios.post('/add-to-cart', data).then((response) => console.log(response)).catch((response) => console.log(response));
    })
});


document.querySelectorAll('#add-to-cart').forEach( (e) => {
    e.addEventListener('click', (event) => {
        if (amount.innerHTML == ''){
            amount.innerHTML = 1;
        } else {
            amount.innerHTML = parseInt(amount.innerHTML) + 1;
        }
        let data = {
            id: e.dataset.id
        };
        axios.post('/add-to-cart', data).then((response) => console.log(response)).catch((response) => console.log(response));
    })
});