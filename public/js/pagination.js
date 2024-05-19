document.addEventListener('DOMContentLoaded', function() {
    const pageNumbers = document.querySelectorAll('.page-number');
    const pageToLeft = document.getElementById('page-to-left');
    const pageToRight = document.getElementById('page-to-right');
    const maxVisiblePages = 7;
    function updatePagination() {
        const currentPage = document.querySelector('.page-number.current-page');
        const currentIndex = Array.from(pageNumbers).indexOf(currentPage);
        const firstPage = pageNumbers[0];
        const lastPage = pageNumbers[pageNumbers.length - 1];
        pageToLeft.style.display = (currentPage === firstPage) ? 'none' : 'block';
        pageToRight.style.display = (currentPage === lastPage) ? 'none' : 'block';
        pageNumbers.forEach(page => page.style.display = 'none');
        if (pageNumbers.length > maxVisiblePages) {
            const ellipsisBefore = document.querySelector('#pagination .ellipsis-before') || document.createElement('p');
            const ellipsisAfter = document.querySelector('#pagination .ellipsis-after') || document.createElement('p');
            ellipsisBefore.classList.add('page-number', 'nav-text', 'ellipsis-before');
            ellipsisBefore.textContent = '...';
            ellipsisAfter.classList.add('page-number', 'nav-text', 'ellipsis-after');
            ellipsisAfter.textContent = '...';
            if (currentIndex <= 2) {
                for (let i = 0; i < 3; i++) {
                    pageNumbers[i].style.display = 'flex';
                }
                ellipsisAfter.style.display = 'flex';
                document.getElementById('pagination').insertBefore(ellipsisAfter, pageNumbers[pageNumbers.length - 3]);
                for (let i = pageNumbers.length - 3; i < pageNumbers.length; i++) {
                    pageNumbers[i].style.display = 'flex';
                }
            } else if (currentIndex >= pageNumbers.length - 3) {
                for (let i = 0; i < 3; i++) {
                    pageNumbers[i].style.display = 'flex';
                }
                ellipsisBefore.style.display = 'flex';
                document.getElementById('pagination').insertBefore(ellipsisBefore, pageNumbers[3]);
                for (let i = pageNumbers.length - 3; i < pageNumbers.length; i++) {
                    pageNumbers[i].style.display = 'flex';
                }
            } else {
                firstPage.style.display = 'flex';
                lastPage.style.display = 'flex';
                ellipsisBefore.style.display = 'flex';
                ellipsisAfter.style.display = 'flex';

                pageNumbers[currentIndex - 1].style.display = 'flex';
                currentPage.style.display = 'flex';
                pageNumbers[currentIndex + 1].style.display = 'flex';

                document.getElementById('pagination').insertBefore(ellipsisBefore, pageNumbers[1]);
                document.getElementById('pagination').insertBefore(ellipsisAfter, lastPage);
            }
        } else {
            pageNumbers.forEach(page => page.style.display = 'flex');
        }
    }
    updatePagination();
});