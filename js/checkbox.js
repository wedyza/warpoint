document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.checkbox');
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const img = checkbox.nextElementSibling;
            console.log(checkbox.checked);
            if (checkbox.checked) {
                img.src = 'img/chekbox-true.svg';
            } else {
                img.src = 'img/chekbox-false.svg';
            }
        });
    });
});