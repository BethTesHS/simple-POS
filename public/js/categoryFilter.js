// Function to fetch products based on category
function fetchProductsByCategory(categoryId) {
    var urlQuery = '';

    if (categoryId) {
        urlQuery = '{{ route("products.filter") }}';
    } else if (categoryId == 0) {
        urlQuery = '{{ route("products.all") }}';
    }

    $.ajax({
        url: urlQuery,
        method: 'GET',
        data: { category_id: categoryId },
        success: function (data) {
            updateItemsView(data);
        },
    });
}

// Function to update items view dynamically
function updateItemsView(data) {
    var html = '';

    if (data.length > 0) {
        data.forEach(function (product) {
            html += `
                <button onclick='addRow(${JSON.stringify(product)})' class="items" id="items-button" value="${product.id}">
                    <div class="items-pics"></div>
                    <text class="item-text"> ${product.productName} </text>
                </button>
            `;
        });
    } else {
        html = '<p>No Items.</p>';
    }

    $('#items-view').html(html);
}


