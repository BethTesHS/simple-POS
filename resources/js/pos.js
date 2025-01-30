window.updateTotals() = function(){
    let totalQuantity = 0;
    let totalAmount = 0;

    document.querySelectorAll('#tableBody tr').forEach(row => {
        const quantity = parseInt(row.querySelector('.quantity input').value);
        const subtotal = parseFloat(row.querySelector('.subTotal').value);

        totalQuantity += quantity;
        totalAmount += subtotal;
    });

    document.querySelector('.total-items').innerHTML = `<input type="hidden" name="totalQuantity" value="${totalQuantity}"> Items: ${totalQuantity}`;
    document.querySelector('.total-amount').innerHTML = `<input type="hidden" name="totalPrice" value="${totalAmount.toFixed(2)}"> Total: ${totalAmount.toFixed(2)} ksh`;
};

window.add(price, ids) = function(){
    let currentValue = parseInt(ids.value);
    ids.value = currentValue + 1;
    let subTot = ids.closest('tr').querySelector('.subTotal');
    subTot.value = (price * (currentValue + 1)).toFixed(2);
    updateTotals();
};
window.sub(price, ids) = function(){
    let currentValue = parseInt(ids.value)
    if(currentValue > 1) {
        ids.value = currentValue - 1;
        let subTot = ids.closest('tr').querySelector('.subTotal');
        subTot.value = (price * (currentValue - 1)).toFixed(2);
        updateTotals();
    }
};
window.change(price, ids)= function(){
    let currentValue = parseInt(ids.value)
    if(currentValue < 1 || !currentValue){
        currentValue = 1;
    }
    ids.value = currentValue
    let subTot = ids.closest('tr').querySelector('.subTotal');
    subTot.value = (price * currentValue).toFixed(2);
    updateTotals();
};

window.addRow(productDetail) = function(){
    const table = document.getElementById('tableBody');

    // Check if the product already exists in the table
    const existingRow = Array.from(table.children).find(row => row.dataset.productId == productDetail.id);
    if (!existingRow) {
        // alert('This product is already in the table.');
        // return;

    const newRow = document.createElement('tr');
    newRow.dataset.productId = productDetail.id; // Add a custom attribute to track the product ID

    newRow.innerHTML = `
        <td class="thd">
            ${productDetail['productName']}
            <input type="hidden" name="products[${productDetail['id']}][productName]" value="${productDetail['productName']}">
        </td>

        <td class="thd quantity">
            <button type="button" onclick="sub(${productDetail['price']}, this.closest('tr').querySelector('.quantity input'))" class="button"> - </button>
            <input oninput="change(${productDetail['price']}, this.closest('tr').querySelector('.quantity input'))" type="text" class="display" value="1" name="products[${productDetail['id']}][quantity]">
            <button type="button" onclick="add(${productDetail['price']}, this.closest('tr').querySelector('.quantity input'))" class="button"> + </button>
        </td>

        <td class="thd price">
            ${productDetail['price']} ksh
            <input type="hidden" name="products[${productDetail['id']}][price]" value="${productDetail['price']}">
        </td>
        </td>

        <td class="thd price">
            <input id="subTot" class="subTotal" value="${productDetail['price']}" readonly name="products[${productDetail['id']}][subtotal]"> ksh
        </td>

        <td class="thd" style="width:20px">
            <button class="removeButton" onclick="removeRow(this)">
                <i style="padding: 0 10px" class="fa fa-trash-o"></i> Remove
            </button>
        </td>`;
        table.appendChild(newRow);
        updateTotals();
    }
};

window.removeRow(button) = function(){
    const row = button.closest('tr');
    row.remove();
    updateTotals();
};

window.cancelPayment() = function(){
    // Clear all rows in the table
    const table = document.getElementById('tableBody');
    table.innerHTML = ''; // Remove all rows

    // Reset totals
    document.querySelector('.total-items').innerHTML = `<input type="hidden" name="totalQuantity" value="0"> Items: 0`;
    document.querySelector('.total-amount').innerHTML = `<input type="hidden" name="totalPrice" value="0"> Total: 0.00 ksh`;
};
