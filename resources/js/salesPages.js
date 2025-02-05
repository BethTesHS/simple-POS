document.addEventListener("DOMContentLoaded", function() {

    let filterDateInput = document.getElementById("filterDate");
    let filteredRows = Array.from(document.querySelectorAll(".row"));
    
    let currentPage = 1;
    const rowsPerPage = 8;

    const prevBtnS = document.getElementById("prevPage");
    const nextBtnS = document.getElementById("nextPage");
    const pageIndicatorS = document.getElementById("pageIndicator");


    // ------- Filter ------- //
    
    function filterByDate(selectedDate) {
        document.querySelectorAll('.row').forEach(row => {
            let saleDate = row.getAttribute('data-date');
            row.style.display = selectedDate === "All Dates" || selectedDate === "" ? "" : (saleDate === selectedDate ? "" : "none");
        });
        filteredRows = Array.from(document.querySelectorAll(".row"))
            .filter(row => row.style.display !== "none");
        
        currentPage = 1;
        updatePagination(currentPage);
    }

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

    updatePagination(currentPage);

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

        // document.getElementById("pageInput").value = page;
        // document.getElementById("maxPage").textContent = `of ${getMaxPages()}`;
        pageIndicatorS.textContent = `Page ${page} of ${getMaxPages()}`;
        prevBtnS.disabled = page === 1;
        nextBtnS.disabled = page >= getMaxPages();
    }

    nextBtnS.addEventListener("click", function () {
        if (currentPage < getMaxPages()) {
            currentPage++;
            updatePagination(currentPage);
        }
    });

    prevBtnS.addEventListener("click", function () {
        if (currentPage > 1) {
            currentPage--;
            updatePagination(currentPage);
        }
    });


});