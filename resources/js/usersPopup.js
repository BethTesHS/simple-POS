


document.querySelectorAll('.editProduct').forEach(button => {
    button.addEventListener('click', function() {
        const user = JSON.parse(button.getAttribute('data-id'));

        id.value=String(user['id']).padStart(6,'0');
        // if (user['id'] == userId){
        //     fn.readOnly = false;
        //     fn.style="color:black";
        //     ln.readOnly = false;
        //     ln.style="color:black";
        // } else {
        //     fn.readOnly = true;
        //     fn.style="color:gray";
        //     ln.readOnly = true;
        //     ln.style="color:gray";
        // }
        fn.value=user['firstName'];
        ln.value=user['lastName'];

        rid.value=user['role'];
        if (user['admin']){
            aid.checked = true;
        } else {
            aid.checked = false;
        }

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
