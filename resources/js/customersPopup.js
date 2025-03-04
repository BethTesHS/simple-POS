// ------ Product ------ //

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('unPopupButton').addEventListener('click', function() {
        alert("This operation has been restricted. Contact your Administrator to grant you access.");
    });
});
document.getElementById('popupButton').addEventListener('click', function() {
    document.getElementById('popupMessage').style.display = 'flex'; // Show the popup
});

document.getElementById('closePopup').addEventListener('click', function() {
    document.getElementById('popupMessage').style.display = 'none'; // Hide the popup
});



document.querySelectorAll('.editProduct').forEach(button => {
    button.addEventListener('click', function() {
        const customer = JSON.parse(button.getAttribute('data-id'));

        id.value=String(customer['id']).padStart(6,'0');
        fn.value=customer['firstName'];
        ln.value=customer['lastName'];
        pno.value=customer['phoneNo'];

        document.getElementById('editPopupMessage').style.display = 'flex';
    });
});

closeEditPopupBtn.onclick = function() {
    document.getElementById('editPopupMessage').style.display = 'none'; // Hide the popup
}

document.querySelectorAll('.deleteProduct').forEach(button => {
    button.addEventListener('click', function() {
        const customer = JSON.parse(button.getAttribute('data-id'));

        d_id.value=customer['id'];
        d_fn.value=customer['firstName'] +" "+ customer['lastName'];

        document.getElementById('deletePopupMessage').style.display = 'flex';
    });
});

closeDeletePopupBtn.onclick = function() {
    document.getElementById('deletePopupMessage').style.display = 'none'; // Hide the popup
}
