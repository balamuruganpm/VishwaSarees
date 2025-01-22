(function ($) {
    "use strict";

    function loadCart() {
        return JSON.parse(localStorage.getItem('cart')) || [];
    }

    function saveCart(cart) {
        localStorage.setItem('cart', JSON.stringify(cart));
    }

    function removeItemFromCart2(productId) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        // Ensure that productId is a string for comparison if item.id is a string
        productId = productId.toString();
        cart = cart.filter(item => item.id.toString() !== productId);
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartDisplay();
        updateCartNotification();
    }

    function updateCartDisplay() {
        const cart = loadCart();
        let total = 0;
        // Clear previous cart items
        $('.table-shopping-cart .table_row').remove();

        // Add each item to cart table
        cart.forEach((item, index) => {
            // Send AJAX request to get product details
            $.ajax({
                url: 'get_product_details.php',
                method: 'POST',
                data: { product_id: item.id },
                success: function(response) {
                    const product = JSON.parse(response);
                    const row = `
                        <tr class="table_row" style="text-align:center">
                            <td class="column-1">
                                <div class="how-itemcart1 js-cart-item" data-productid="${item.id}">
                                    <img src="images/product/${product.Img_filename1}" class="" alt="Product Image">
                                </div>
                            </td>
                            <td class="column-2">${product.Name}</td>
                            <td class="column-3">${product.Price}</td>
                            <td class="column-4">
                                <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m js-decrease-quantity" data-productid="${item.id}">
                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                    </div>
                                    <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product${index + 1}" value="${item.quantity}" data-productid="${item.id}">
                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m js-increase-quantity" data-productid="${item.id}">
                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                    </div>
                                </div>
                            </td>
                            <td class="column-5">${product.Price * item.quantity}</td>
                            <td><button type="button" class="btn btn-danger btn-sm js-remove-item" data-productid="${item.id}">Remove</button></td>
                        </tr>`;
                    $('.table-shopping-cart').append(row);
                    total += parseInt(product.Price) * item.quantity;

                    // Update total price
                    updateTotalPrice(total);

                    $('.js-remove-item').last().on('click', function() {
                        let productId = $(this).closest('.js-remove-item').data('productid');
                        removeItemFromCart2(productId);
                    });
                },
                error: function() {
                    console.log('Failed to fetch product details');
                }
            });
        });
    }

function updateTotalPrice(cartTotal) {
        const shippingOption = $('.js-select2 option:selected');
        const shippingCost = parseInt(shippingOption.val()) || 0;
        const taxCategory = shippingOption.data('tax-category');
    
        let tax = 0;
        tax = (cartTotal + shippingCost)* 0.05; 
        if (taxCategory === 'Other') {
            $('#state').val("other");
        }
    
        const total = cartTotal + shippingCost + tax;
    
        // Update the values in the billing details
        $('.product-price').text(`₹${cartTotal}`);
        $('.shipping-cost').text(`₹${shippingCost.toFixed(2)}`);
        $('.tax-amount').text(`₹${tax.toFixed(2)}`);
        $('.total-amount').text(`₹${total.toFixed(2)}`);
    
        // Update hidden input field for Razorpay
        $('#total_amount').val(total * 100); // Convert to paise for Razorpay
    }
    
    
    // Add event listener for calculating shipping
$('select[name="delivery-category"]').change(function() {
    console.log("h");
    updateTotalPrice();
});



    function updateQuantity(productId, newQuantity) {
        const cart = loadCart();
        const product = cart.find(item => item.id == productId);
        if (product) {
            product.quantity = newQuantity;
            saveCart(cart);
            updateCartDisplay();
        }
    }

    function getCartItemCount() {
        let cart = JSON.parse(localStorage.getItem('cart'));
        if (cart) {
            return cart.length;
        }
        return 0;
    }

    // Function to update the data-notify attribute
    function updateCartNotification() {
        const cartItemCount = getCartItemCount();
        document.querySelector('.js-show-cart').setAttribute('data-notify', cartItemCount);
    }

    // Document ready function
    $(document).ready(function() {
        updateCartDisplay();

        // Handle quantity decrease
        $(document).on('click', '.js-decrease-quantity', function() {
            const productId = $(this).data('productid');
            const input = $(`input[data-productid="${productId}"]`);
            let quantity = parseInt(input.val());
            if (quantity > 1) {
                quantity -= 1;
                input.val(quantity);
                updateQuantity(productId, quantity);
            }
        });

        // Handle quantity increase
        $(document).on('click', '.js-increase-quantity', function() {
                const productId = $(this).data('productid');
                const input = $(`input[data-productid="${productId}"]`);
                let quantity = parseInt(input.val());
                quantity += 1;
                input.val(quantity);
                updateQuantity(productId, quantity);
            });

        // Handle shipping category change
        $(document).on('change', '.js-select2', function() {
            const cart = loadCart();
            let cartTotal = 0;
            cart.forEach(item => {
                $.ajax({
                    url: 'get_product_details.php',
                    method: 'POST',
                    data: { product_id: item.id },
                    success: function(response) {
                        const product = JSON.parse(response);
                        cartTotal += parseInt(product.Price) * item.quantity;
                        updateTotalPrice(cartTotal);
                    },
                    error: function() {
                        console.log('Failed to fetch product details');
                    }
                });
            });
        });

        
    });

})(jQuery);
