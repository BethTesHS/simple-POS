window.calcOpenPopup = function() {
    calcPopup.style.display = (calcPopup.style.display === 'block') ? 'none' : 'block';
};

window.calcClosePopup = function() {
    calcPopup.style.display = 'none';
};

document.getElementById('popupButton').addEventListener('click', function() {
    document.getElementById('popupMessage').style.display = 'flex'; // Show the popup
});

document.getElementById('closePopup').addEventListener('click', function() {
    document.getElementById('popupMessage').style.display = 'none'; // Hide the popup
});

document.getElementById('popupButton2').addEventListener('click', function() {
    document.getElementById('popupMessage2').style.display = 'flex'; // Show the popup
});

document.getElementById('closePopup2').addEventListener('click', function() {
    document.getElementById('popupMessage2').style.display = 'none'; // Hide the popup
});


document.querySelectorAll('.editProduct').forEach(button => {
    button.addEventListener('click', function() {
        const product = JSON.parse(button.getAttribute('data-id'));

        id.value='P_'+String(product['id']).padStart(6,'0');
        pn.value=product['productName'];
        pr.value=product['price'];
        cid.value=product['category_id'];

        document.getElementById('editPopupMessage').style.display = 'flex';
    });
});

closeEditPopupBtn.onclick = function() {
    document.getElementById('editPopupMessage').style.display = 'none'; // Hide the popup
}

document.querySelectorAll('.deleteProduct').forEach(button => {
    button.addEventListener('click', function() {
        const member = JSON.parse(button.getAttribute('data-id'));

        d_id.value=member['id'];
        d_pn.value=member['productName'];

        document.getElementById('deletePopupMessage').style.display = 'flex';
    });
});

closeDeletePopupBtn.onclick = function() {
    document.getElementById('deletePopupMessage').style.display = 'none'; // Hide the popup
}
