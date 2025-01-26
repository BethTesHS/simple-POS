
function addProduct() {
    popupMessage.style.display = 'flex'; // Show the popup
}

document.getElementById('popupButton2').addEventListener('click', function() {
    document.getElementById('popupMessage2').style.display = 'flex'; // Show the popup
});

function addCategory() {
    popupMessage2.style.display = 'flex'; // Show the popup
}

function closeAddProduct() {
    popupMessage.style.display = 'none'; // Hide the popup
}

function closeAddCategory() {
    popupMessage2.style.display = 'none'; // Hide the popup
}

// ------------------------------- //

function calcOpenPopup() {
    calcPopup.style.display = (calcPopup.style.display === 'block') ? 'none' : 'block';
}

function calcClosePopup(){
    calcPopup.style.display = 'none';
}
