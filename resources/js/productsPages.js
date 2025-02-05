document.addEventListener("DOMContentLoaded", function () {
    
    let filteredRows = Array.from(document.querySelectorAll(".row"));
    
    let currentPage = 1;
    const rowsPerPage = 4;
    
    const prevBtnP = document.getElementById("prevProductPage");
    const nextBtnP = document.getElementById("nextProductPage");
    const pageIndicatorP = document.getElementById("productPageIndicator");


    // ------- Filter ------- //
    
    function filterByCategory(selectedCategory) {
        document.querySelectorAll('.row').forEach(row => {
            let productCategory = row.getAttribute('category-category');

            if (productCategory === selectedCategory || selectedCategory === '0') {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
        filteredRows = Array.from(document.querySelectorAll(".row"))
            .filter(row => row.style.display !== "none");
        
        currentPage = 1;
        updatePagination(currentPage);
    }

    // For anytime catrgory dropdown makes a change
    document.getElementById("categoryFilter").addEventListener("change", function() {
        filterByCategory($(this).val());
    }),

    // Initialize by using default category value 
    filterByCategory(
        document.getElementById("categoryFilter").value,
    );

    // ----------- //

    function getMaxPages() {
        return Math.ceil(filteredRows.length / rowsPerPage) || 1; // Ensure at least 1 page
    }

    function updatePagination(page) {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        filteredRows.forEach((row, index) => {
            row.style.display = index >= start && index < end ? "" : "none";
        });
        
        pageIndicatorP.textContent = `Page ${page} of ${getMaxPages()}`;
        prevBtnP.disabled = page === 1;
        nextBtnP.disabled = page >= getMaxPages();
    }

    nextBtnP.addEventListener("click", function () {
        if (currentPage < getMaxPages()) {
            currentPage++;
            updatePagination(currentPage);
        }
    });

    prevBtnP.addEventListener("click", function () {
        if (currentPage > 1) {
            currentPage--;
            updatePagination(currentPage);
        }
    });

});
