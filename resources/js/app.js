// const cartItemCount = document.getElementById("cartItemCount");
// const cartItemsList = document.getElementsByClassName("cart-items-list");
// const cartIcon = document.getElementById("cartIcon");
// const cartDropdown = document.getElementById("cartDropdown");
// const cartContainer = document.querySelector(".cart-container");
// let cart = JSON.parse(localStorage.getItem("cart")) || [];
// const aantalInputs = document.querySelectorAll(".aantal-input");
// const totaalprijsElement = document.getElementById("totaalprijs");
// const verzendKosten = parseFloat(
//     document.getElementById("verzendKosten").textContent.replace("€ ", "")
// );
// const checkoutBtn = document.getElementById("checkoutBtn");

// // Function to calculate the total quantity of items in the cart
// function getCartItemCount() {
//     let itemCount = 0;
//     cart.forEach(function (order) {
//         order.products.forEach(function (product) {
//             itemCount += product.aantal;
//         });
//     });
//     return itemCount;
// }

// // Function to render the cart items in the dropdown
// function renderCartItems() {
//     for (let i = 0; i < cartItemsList.length; i++) {
//         const list = cartItemsList[i];
//         list.innerHTML = "";

//         cart.forEach(function (order, orderIndex) {
//             order.products.forEach(function (product, productIndex) {
//                 const listItem = document.createElement("div");
//                 listItem.classList.add("cartItem");
//                 const listTitel = document.createElement("p");
//                 listTitel.classList.add("cartItem-title");
//                 const listAantal = document.createElement("p");
//                 listAantal.classList.add("cartItem-aantal");
//                 listTitel.textContent = product.naam;
//                 console.log(product);
//                 listAantal.textContent =
//                     product.aantal + " x € " + product.prijs.toFixed(2);
//                 const removeBtn = document.createElement("button");
//                 removeBtn.textContent = "Verwijder";
//                 removeBtn.classList.add("btn", "btn-danger", "remove-btn");
//                 removeBtn.addEventListener("click", function () {
//                     removeCartItem(orderIndex, productIndex);
//                 });

//                 list.appendChild(listItem);
//                 listItem.appendChild(listTitel);
//                 listItem.appendChild(listAantal);
//                 listItem.appendChild(removeBtn);
//             });
//         });
//     }

//     if (cart.length > 0) {
//         cartContainer.classList.add("show");
//     } else {
//         cartContainer.classList.remove("show");
//     }
// }

// // Function to remove a cart item
// function removeCartItem(orderIndex, productIndex) {
//     cart[orderIndex].products.splice(productIndex, 1);

//     if (cart[orderIndex].products.length === 0) {
//         cart.splice(orderIndex, 1);
//     }

//     localStorage.setItem("cart", JSON.stringify(cart));
//     updateCart();
// }

// // Function to update the cart icon and item count
// function updateCart() {
//     cartItemCount.textContent = getCartItemCount();
//     renderCartItems();
// }

// aantalInputs.forEach(function (input) {
//     input.addEventListener("input", function () {
//         calculateTotalPrice();
//     });
// });

// function calculateTotalPrice() {
//     let totaalprijs = 0;
//     let totalQuantity = 0;

//     aantalInputs.forEach(function (input) {
//         let aantal = parseInt(input.value);
//         const prijs = parseFloat(input.getAttribute("data-prijs"));
//         if (!isNaN(aantal) && aantal > 0) {
//             totalQuantity += aantal;
//             const subTotaal = prijs * aantal;
//             const rij = input.parentNode.parentNode;
//             rij.querySelector(".totaalprijs").textContent =
//                 subTotaal.toFixed(2);
//             totaalprijs += subTotaal;
//         }
//     });

//     // if (totalQuantity > 0) {
//     //     totaalprijs += verzendKosten;
//     // }

//     totaalprijsElement.textContent = "€ " + totaalprijs.toFixed(2);
// }

// function addToCart() {
//     const order = {
//         products: [],
//     };

//     aantalInputs.forEach(function (input) {
//         const aantal = parseInt(input.value);
//         const prijs = parseFloat(input.getAttribute("data-prijs"));
//         const naam = input.getAttribute("data-naam");

//         if (aantal > 0) {
//             const product = {
//                 naam: naam,
//                 aantal: aantal,
//                 prijs: prijs,
//             };
//             order.products.push(product);
//         }
//     });

//     cart.push(order);
//     localStorage.setItem("cart", JSON.stringify(cart));
//     updateCart();
//     cartDropdown.classList.add("show");
//     cartDropdown.style.display = "block";
//     alert("Bestelling toegevoegd aan winkelmandje!");

//     // Reset input values to zero
//     aantalInputs.forEach(function (input) {
//         input.value = "0";
//     });
// }

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
});

// // Voeg de event listener toe aan checkoutBtn
// checkoutBtn.addEventListener("click", function () {
//     // Redirect naar de order checkout-pagina of voer de gewenste actie uit
//     window.location.href = "/cart";
// });

// //Cart js
// // Function to remove a cart item
// // function removeCartItem(productId) {
// //     if (confirm('Weet je zeker dat je dit product wilt verwijderen?')) {
// //         const removeForm = document.getElementById('removeForm' + productId);
// //         removeForm.submit();
// //     }
// // }
// const addToCartBtn = document.querySelector("#addToCartBtn");

// if (addToCartBtn) {
//     addToCartBtn.addEventListener("click", function () {
//         addToCart();
//     });
// }

// renderCartItems();
// updateCart();
