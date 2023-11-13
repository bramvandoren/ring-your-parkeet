// //EVENT LISTENERS
// Voeg een click event listener toe aan het cartToggle-element
document.getElementById("cartToggle").addEventListener("click", function () {
    const isCartVisible = cartDropdown.classList.contains("show");

    if (isCartVisible) {
        cartDropdown.classList.remove("show");
        cartDropdown.style.display = "none";
    } else {
        cartDropdown.classList.add("show");
        cartDropdown.style.display = "block";
    }

