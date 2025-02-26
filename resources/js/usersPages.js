document.addEventListener("DOMContentLoaded", function () {

    let filteredRows = Array.from(document.querySelectorAll(".row"));

    let currentPage = 1;
    const rowsPerPage = 8;

    const prevBtnU = document.getElementById("prevUserPage");
    const nextBtnU = document.getElementById("nextUserPage");
    const pageIndicatorU = document.getElementById("userPageIndicator");



    updatePagination(currentPage);

    function getMaxPages() {
        return Math.ceil(filteredRows.length / rowsPerPage) || 1; // Ensure at least 1 page
    }

    function updatePagination(page) {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        filteredRows.forEach((row, index) => {
            row.style.display = index >= start && index < end ? "" : "none";
        });

        pageIndicatorU.textContent = `Page ${page} of ${getMaxPages()}`;
        prevBtnU.disabled = page === 1;
        nextBtnU.disabled = page >= getMaxPages();
    }

    nextBtnU.addEventListener("click", function () {
        if (currentPage < getMaxPages()) {
            currentPage++;
            updatePagination(currentPage);
        }
    });

    prevBtnU.addEventListener("click", function () {
        if (currentPage > 1) {
            currentPage--;
            updatePagination(currentPage);
        }
    });

});
