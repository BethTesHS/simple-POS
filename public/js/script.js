function updateTotals() {
    let totalQuantity = 0;
    let totalAmount = 0;

    document.querySelectorAll('#tableBody tr').forEach(row => {
        const quantity = parseInt(row.querySelector('.quantity input').value);
        const subtotal = parseFloat(row.querySelector('.subTotal').value);

        totalQuantity += quantity;
        totalAmount += subtotal;
    });

    document.querySelector('.total-items').textContent = `Items: ${totalQuantity}`;
    document.querySelector('.total-amount').textContent = `Total: ${totalAmount.toFixed(2)} ksh`;
}

function add(price, ids) {
    let currentValue = parseInt(ids.value);
    ids.value = currentValue + 1;
    let subTot = ids.closest('tr').querySelector('.subTotal');
    subTot.value = (price * (currentValue + 1)).toFixed(2);
    updateTotals();
}
function sub(price, ids) {
    let currentValue = parseInt(ids.value)
    if(currentValue > 1) {
        ids.value = currentValue - 1;
        let subTot = ids.closest('tr').querySelector('.subTotal');
        subTot.value = (price * (currentValue - 1)).toFixed(2);
        updateTotals();
    }
}
function change(price, ids){
    let currentValue = parseInt(ids.value)
    if(currentValue < 1 || !currentValue){
        currentValue = 1;
    }
    ids.value = currentValue
    let subTot = ids.closest('tr').querySelector('.subTotal');
    subTot.value = (price * currentValue).toFixed(2);
    updateTotals();
}

function addRow(productDetail) {
    const table = document.getElementById('tableBody');

    // Check if the product already exists in the table
    const existingRow = Array.from(table.children).find(row => row.dataset.productId == productDetail.id);
    if (!existingRow) {
        // alert('This product is already in the table.');
        // return;

    const newRow = document.createElement('tr');
    newRow.dataset.productId = productDetail.id; // Add a custom attribute to track the product ID

    newRow.innerHTML = `
        <td class="product"> ${productDetail['productName']} </td>

        <td class="quantity">
            <button onclick="sub(${productDetail['price']}, this.closest('tr').querySelector('.quantity input'))" class="button"> - </button>
            <input oninput="change(${productDetail['price']}, this.closest('tr').querySelector('.quantity input'))" type="text" class="display" value="1">
            <button onclick="add(${productDetail['price']}, this.closest('tr').querySelector('.quantity input'))" class="button"> + </button>
        </td>

        <td class="price"> ${productDetail['price']} ksh</td>

        <td><input id="subTot" class="subTotal" value="${productDetail['price']}" readonly> ksh</td>

        <td style="width:20px">
            <button class="removeButton" onclick="removeRow(this)">
                <i style="padding: 0 10px" class="fa fa-trash-o"></i> Remove
            </button>
        </td>`;
        table.appendChild(newRow);
        updateTotals();
    }
}

function removeRow(button) {
    const row = button.closest('tr');
    row.remove();
    updateTotals();
}
