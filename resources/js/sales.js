
document.addEventListener("DOMContentLoaded", function() {

    let filterDateInput = document.getElementById("filterDate");

    let currentPage = 1;
    const rowsPerPage = 9;
    let filteredRows = Array.from(document.querySelectorAll(".sale-row"));
        
    function getMaxPages() {
        return Math.ceil(filteredRows.length / rowsPerPage) || 1; // Ensure at least 1 page
    }

    function showPage(page) {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        filteredRows.forEach((row, index) => {
            row.style.display = index >= start && index < end ? "" : "none";
        });

        // document.getElementById("pageInput").value = page;
        // document.getElementById("maxPage").textContent = `of ${getMaxPages()}`;
        document.getElementById("pageIndicator").textContent = `Page ${page} of ${getMaxPages()}`;
        document.getElementById("prevPage").disabled = page === 1;
        document.getElementById("nextPage").disabled = page >= getMaxPages();
    }

    function updatePagination() {
        filteredRows = Array.from(document.querySelectorAll(".sale-row"))
            .filter(row => row.style.display !== "none");
        currentPage = 1;
        showPage(currentPage);
    }

    document.getElementById("nextPage").addEventListener("click", function () {
        if (currentPage < getMaxPages()) {
            currentPage++;
            showPage(currentPage);
        }
    });

    document.getElementById("prevPage").addEventListener("click", function () {
        if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
        }
    });

    // document.getElementById("pageInput").addEventListener("change", function () {
    //     inputPage = document.getElementById("pageInput").value;
    //     if (inputPage > 1 && inputPage <= getMaxPages()) {
    //         currentPage = inputPage;
    //     } else if (inputPage < 1 ) {
    //         currentPage = 1;
    //     } else {
    //         currentPage = getMaxPages();
    //     }
    //     showPage(currentPage);
    // });
    
    flatpickr("#filterDate", {
        dateFormat: "Y-m-d",
        allowInput: true,
        enableTime: false,
        defaultDate: null,
        onReady: function(selectedDates, dateStr, instance) {
            let clearButton = document.createElement("button");
            clearButton.innerHTML = "All Dates";
            clearButton.classList.add("flatpickr-clear");
            clearButton.addEventListener("click", function() {
                instance.clear();
            });

            instance.calendarContainer.appendChild(clearButton);
        },
        onChange: function(selectedDates, dateStr, instance) {
            if (selectedDates == 0) {
                filterByDate("All Dates");
                filterDateInput.value = "All Dates";
            } else {
                filterByDate(dateStr);
                filterDateInput.value = dateStr;
            }
        },
        onClose: function (selectedDates, dateStr, instance) {
            if (!filterDateInput.value) {
                filterDateInput.value = "All Dates";
            }
        }
    });

    function filterByDate(selectedDate) {
        document.querySelectorAll('.sale-row').forEach(row => {
            let saleDate = row.getAttribute('data-date');
            row.style.display = selectedDate === "All Dates" || selectedDate === "" ? "" : (saleDate === selectedDate ? "" : "none");
        });
        updatePagination();
    }

    showPage(currentPage);

});