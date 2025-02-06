// ----------- CALCULATOR ----------- //
window.calcOpenPopup = function() {
    calcPopup.style.display = (calcPopup.style.display === 'block') ? 'none' : 'block';
};

window.calcClosePopup = function() {
    calcPopup.style.display = 'none';
};
// ---------------------------------- //

// To update stock quantity
window.add = function(ids) {
    let currentValue = parseInt(ids.value);
    ids.value = currentValue + 1;
    let subTot = ids.closest('tr').querySelector('.subTotal');
    subTot.value = (price * (currentValue + 1)).toFixed(2);
}
window.sub = function(ids) {
    let currentValue = parseInt(ids.value)
    if(currentValue > 0) {
        ids.value = currentValue - 1;
        let subTot = ids.closest('tr').querySelector('.subTotal');
        subTot.value = (price * (currentValue - 1)).toFixed(2);
    }
}
window.change = function(ids){
    let currentValue = parseInt(ids.value)
    if(currentValue < 0 || !currentValue){
        currentValue = 0;
    }
    ids.value = currentValue
    let subTot = ids.closest('tr').querySelector('.subTotal');
    subTot.value = (price * currentValue).toFixed(2);
}

// // To adjust input textarea side based on content
// function adjustWidth(input) {
//     const span = document.createElement("span");
//     span.style.visibility = "hidden";
//     span.style.position = "absolute"; 
//     span.style.font = getComputedStyle(input).font; 
//     span.textContent = input.value || input.placeholder;

//     document.body.appendChild(span);
//     input.style.width = span.offsetWidth + "px";
//     document.body.removeChild(span);
// }
//     const input = document.getElementById("subTot");
//     window.onload = () => adjustWidth(input);