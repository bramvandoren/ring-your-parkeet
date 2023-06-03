<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Parkiet</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-ABC123..." crossorigin="anonymous" />

        @vite([
            'resources/css/app.css', 
        ])

        @yield('styles')
    </head>
    <body>
<body>
    {{-- include header --}}
    @include('partials.header')
 
    {{-- include content --}}
    @yield('content')

    {{-- include footer --}}
    @include('partials.footer')

    @yield('scripts') 

    @vite([
        'resources/js/bootstrap.js',
        'resources/js/app.js'
    ])
    <!-- Voeg de volgende script-tags toe aan je HTML-bestand -->
    <script></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // const cartItemCount = document.getElementById('cartItemCount');
    // const cartItemsList = document.getElementById('cartItemsList');
    // const cartIcon = document.getElementById('cartIcon');
    // const cartDropdown = document.getElementById('cartDropdown');
    // const cartContainer = document.querySelector('.cart-container');
    //     let cart = JSON.parse(localStorage.getItem('cart')) || [];

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
    //     cartItemsList.innerHTML = '';

    //     cart.forEach(function (order, orderIndex) {
    //         order.products.forEach(function (product, productIndex) {
    //             const listItem = document.createElement('li');
    //             listItem.textContent = product.aantal + ' x € ' + product.prijs.toFixed(2);

    //             const removeBtn = document.createElement('button');
    //             removeBtn.textContent = 'Verwijder';
    //             removeBtn.classList.add('btn', 'btn-danger', 'remove-btn');
    //             removeBtn.addEventListener('click', function () {
    //                 removeCartItem(orderIndex, productIndex);
    //             });

    //             listItem.appendChild(removeBtn);
    //             cartItemsList.appendChild(listItem);
    //         });
    //     });

    //     if (cart.length > 0) {
    //         cartContainer.classList.add('show');
    //     } else {
    //         cartContainer.classList.remove('show');
    //     }
    // }

    // // Function to remove a cart item
    // function removeCartItem(orderIndex, productIndex) {
    //     cart[orderIndex].products.splice(productIndex, 1);

    //     if (cart[orderIndex].products.length === 0) {
    //         cart.splice(orderIndex, 1);
    //     }

    //     localStorage.setItem('cart', JSON.stringify(cart));
    //     updateCart();
    // }

    // // Function to update the cart icon and item count
    // function updateCart() {
    //     cartItemCount.textContent = getCartItemCount();
    //     renderCartItems();
    // }

    // // Event listener for the cart icon click event to toggle the dropdown
    // cartIcon.addEventListener('click', function () {
    //     cartDropdown.classList.toggle('show');
    // });


    //     renderCartItems();

    //     // Event listener for "Voeg toe aan winkelmandje" button
    //     const addToCartBtn = document.getElementById('addToCartBtn');
    //     addToCartBtn.addEventListener('click', function() {
    //         // Call the addToCart function
    //         addToCart();
    //     });

        
    </script>
    </body>
</html>