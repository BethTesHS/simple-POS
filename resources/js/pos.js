// ----------- CALCULATOR ----------- //
window.calcOpenPopup = function() {
    calcPopup.style.display = (calcPopup.style.display === 'block') ? 'none' : 'block';
};

window.calcClosePopup = function() {
    calcPopup.style.display = 'none';
};
// ---------------------------------- //


// To check if a product and payment method is selected
window.validateForm = function() {
    let totalQuantity = document.getElementById("totalQuantity").value;
    let totalPrice = document.getElementById("totalPrice").value;
    let payMethod = document.getElementById("payMethod").value;

    if (parseInt(totalQuantity) <= 0 || parseInt(totalPrice) <= 0) {
        alert("Please add at least one product before proceeding.");
        return false; 
    }else if (payMethod == "" ) {
        alert("Please select a payment method before completing payment.");
        return false;
    }
    return true;
};

// To update the total quantity and cost based on subtotal and quantity of selected items
window.updateTotals = function() {
    let totalQuantity = 0;
    let totalAmount = 0;

    document.querySelectorAll('#tableBody tr').forEach(row => {
        const quantity = parseInt(row.querySelector('.quantity input').value);
        const subtotal = parseFloat(row.querySelector('.subTotal').value);

        totalQuantity += quantity;
        totalAmount += subtotal;
    });

    document.querySelector('.total-items').innerHTML = `<input type="hidden" id="totalQuantity" name="totalQuantity" value="${totalQuantity}"> Items: ${totalQuantity}`;
    document.querySelector('.total-amount').innerHTML = `<input type="hidden" id="totalPrice" name="totalPrice" value="${totalAmount.toFixed(2)}"> Total: ${totalAmount.toFixed(2)} ksh`;
}

// To update subtotal based on the amount in quantity
window.add = function(price, stock, ids) {
    let currentValue = parseInt(ids.value);
    if(currentValue >= parseInt(stock) || !currentValue){
        currentValue = parseInt(stock);
    } else {

        ids.value = currentValue + 1;
        let subTot = ids.closest('tr').querySelector('.subTotal');
        subTot.value = (price * (currentValue + 1)).toFixed(2);
        updateTotals();
    }
}
window.sub = function(price, stock, ids) {
    let currentValue = parseInt(ids.value)
    if(currentValue > 1) {
        ids.value = currentValue - 1;
        let subTot = ids.closest('tr').querySelector('.subTotal');
        subTot.value = (price * (currentValue - 1)).toFixed(2);
        updateTotals();
    }
}
window.change = function(price, stock, ids) {
    let currentValue = parseInt(ids.value)
    if(currentValue < 0 || !currentValue){
        currentValue = 0;
    }
    else if(currentValue > parseInt(stock) || !currentValue){
        currentValue = parseInt(stock);
    }

    ids.value = currentValue
    let subTot = ids.closest('tr').querySelector('.subTotal');
    subTot.value = (price * currentValue).toFixed(2);
    updateTotals();

    ids.addEventListener('blur', function() {
        if (currentValue == 0) {
            currentValue = 1;
        }
        ids.value = currentValue;
        let subTot = ids.closest('tr').querySelector('.subTotal');
        subTot.value = (price * currentValue).toFixed(2);
        updateTotals();
    });
}

// To add row of selected product
window.addRow = function(productDetail) {
    const table = document.getElementById('tableBody');
    const existingRow = Array.from(table.children).find(row => row.dataset.productId == productDetail.id);
    
    if (!existingRow) {
        const newRow = document.createElement('tr');
        newRow.dataset.productId = productDetail.id; 
        newRow.innerHTML = `
            <td class="thd">
                ${productDetail['productName']}
                <input type="hidden" name="products[${productDetail['id']}][productName]" value="${productDetail['productName']}">
            </td>

            <td class="thd quantity">
                <button type="button" onclick="sub(${productDetail['price']}, ${productDetail['stockQuantity']}, this.closest('tr').querySelector('.quantity input'))" class="button"> - </button>
                <input
                    autocomplete="off"
                    oninput="change(
                        ${productDetail['price']},
                        ${productDetail['stockQuantity']},
                        this.closest('tr').querySelector('.quantity input')
                        )"
                    type="text" class="display" value="1" name="products[${productDetail['id']}][quantity]"
                    >
                <button type="button" onclick="add(${productDetail['price']}, ${productDetail['stockQuantity']}, this.closest('tr').querySelector('.quantity input'))" class="button"> + </button>
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
}

// To remove row from selected products
window.removeRow = function(button) {
    const row = button.closest('tr');
    row.remove();
    updateTotals();
}

// To cancel payment session and reset everything
window.cancelPayment = function() {
    document.getElementById('tableBody').innerHTML = '';

    document.querySelector('.total-items').innerHTML = `
        <input type="hidden" name="totalQuantity" value="0"> Items: 0
    `;
    document.querySelector('.total-amount').innerHTML = `
        <input type="hidden" name="totalPrice" value="0"> Total: 0.00 ksh
    `;
}

// Closes popup for Receipt 
window.closeReceiptPopupBtn = function() {
    document.getElementById('popupReceipt').style.display = 'none'; // Hide the popup
}

// // To adjust input textarea side based on content
// function adjustWidth(input) {
//     const span = document.createElement("span");
//     span.style.visibility = "hidden";
//     span.style.position = "absolute"
//     span.style.font = getComputedStyle(input).font;
//     span.textContent = input.value || input.placeholder;

//     document.body.appendChild(span);
//     input.style.width = span.offsetWidth + "px";
//     document.body.removeChild(span);
// }
//     const input = document.getElementById("subTot");
//     window.onload = () => adjustWidth(input);
    