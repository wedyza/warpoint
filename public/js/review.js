document.addEventListener('DOMContentLoaded', function() {
    const reviewStarsContainers = document.querySelectorAll('.review-stars');
    reviewStarsContainers.forEach(container => {
        const stars = container.querySelectorAll('.rating-stars');
        stars.forEach((star, index) => {
            star.addEventListener('click', () => {
                document.querySelector('.rate-stars').value = index+1;
                stars.forEach((s, i) => {
                    s.src = (i <= index) ? '/img/rating.svg' : '/img/empty-rating.svg';
                });
            });
        });
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const reviewForms = document.querySelectorAll('.review-form');

    reviewForms.forEach(form => {
        const input = form.querySelector('.review-input');
        const symbolsAmount = form.querySelector('.symbols-amount');

        input.addEventListener('input', function() {
            let currentLength = input.value.length;
            if (currentLength > 288) {
                input.value = input.value.slice(0, 288);
                currentLength = 288;
            }
            symbolsAmount.textContent = `${currentLength} / 288`;
        });
    });
});