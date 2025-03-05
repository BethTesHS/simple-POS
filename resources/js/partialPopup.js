// ------ Product ------ //

window.check = function() {
    let price = document.getElementById('toPay');
    let payNow = document.getElementById('payNow');

    // payNow.value = parseFloat(payNow.value).toFixed(2);
    if (payNow.toString().split('.').length === 2) {
        payNow.value = parseFloat(payNow.value).toFixed(2);
    // } else {
    //     payNow.value = parseFloat(payNow.value).toFixed(0);
    }

    if (parseFloat(price.value) < parseFloat(payNow.value)) {  // Convert to numbers to compare
        payNow.value = price.value;
    }
}


document.querySelectorAll('.detailView-btn').forEach(button => {
    button.addEventListener('click', function() {
        const partial = JSON.parse(button.getAttribute('data-id'));

        totPrice.value = partial['total'];
        totPaid.value = partial['paid'];
        toPay.value = partial['toPay'];

        pid.value = partial['id'];
        sid.value = partial['sale_id'];
        cid.value = partial['customer_id'];

        // id.value='P_'+String(product['id']).padStart(6,'0');
        // pn.value=product['productName'];
        // // sq.value=product['stockQuantity'];
        // pr.value=product['price'];
        // cid.value=product['category_id'];

        document.getElementById('popupPayment').style.display = 'flex';
    });
});

window.closePopup = function() {
    popupPayment.style.display = 'none'; // Hide the popup
};

