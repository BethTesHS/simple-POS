
document.getElementById('popupButton').addEventListener('click', function() {
    document.getElementById('popupMessage').style.display = 'flex'; // Show the popup
});

document.getElementById('closePopup').addEventListener('click', function() {
    document.getElementById('popupMessage').style.display = 'none'; // Hide the popup
});
