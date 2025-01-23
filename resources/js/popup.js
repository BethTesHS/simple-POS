
document.getElementById('popupButton').addEventListener('click', function() {
    document.getElementById('popupMessage').style.display = 'flex'; // Show the popup
});

document.getElementById('popupButton2').addEventListener('click', function() {
    document.getElementById('popupMessage2').style.display = 'flex'; // Show the popup
});

document.getElementById('closePopup').addEventListener('click', function() {
    document.getElementById('popupMessage').style.display = 'none'; // Hide the popup
});

document.getElementById('closePopup2').addEventListener('click', function() {
    document.getElementById('popupMessage2').style.display = 'none'; // Hide the popup
});
