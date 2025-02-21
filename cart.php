<style>
    .js-check-btn {
        cursor: pointer;
        background-color: darkgreen !important;
        color: white !important;
    }
    .header-cart-item-img {
        width: 100px;
        height: 100px;
    }
    .header-cart-item-img img {
        width: 100%;
        height: 100%;
    }

    .cart-item {
        display: flex;
        flex-direction: row;
        gap: 10px;
        justify-content: center;
        margin-bottom: 10px;
    }

    /* Initially hide the cart */
    .js-panel-cart {
        display: none;
    }
</style>

<!-- HTML for the Cart -->
<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-25 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                Your Cart
            </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full" id="cart-items">
                <!-- Cart items will be appended here dynamically -->
            </ul>

            <div class="w-full">
                <!-- <div class="header-cart-total w-full p-tb-40" id="cart-total">
                    Total: ₹0.00
                </div> -->
                <div class="w-full p-tb-40">
                    by checkout you agree to our <a href="terms&condition.php">terms and conditions</a>
                    </div>
                <div class="header-cart-buttons flex-w w-full">
                    <a href="shoping-cart.php"
                        class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10 js-check-btn">
                        Check Out 
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script>
$(document).ready(function () {
    // Function to get the cart from localStorage
    function getCartFromLocalStorage() {
        try {
            return JSON.parse(localStorage.getItem('cart')) || [];
        } catch (e) {
            console.warn("Invalid cart data in localStorage:", e);
            return [];
        }
    }

    // Function to save the cart to localStorage
    function saveCartToLocalStorage(cart) {
        localStorage.setItem('cart', JSON.stringify(cart));
    }

    // Function to update the cart display
    function updateCart() {
        let cart = getCartFromLocalStorage(); // Fetch the cart data

        // Check if the cart has any items
        if (cart.length === 0) {
            $('#cart-items').html('<li>Your cart is empty</li>');
            $('#cart-total').text('Total: ₹0.00');
            return;
        }

        // Fetch product data for each item in the cart
        $.ajax({
            url: 'get-cart.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ cart: cart }),
            dataType: 'json',
            success: function (data) {
                let cartContainer = $('#cart-items');
                cartContainer.empty(); // Clear any previous cart data

                if (data.items && data.items.length > 0) {
                    let cartHtml = data.items.map(item => `
                        <li class="cart-item" data-id="${item.id}">
                            <img src="${item.image}" alt="${item.name}" onerror="this.onerror=null; this.src='fallback.jpg';">
                            <div class="cart-item-info">
                                <span class="cart-item-name">${item.name}</span>
                                <span class="cart-item-quantity">
                                    <button class="quantity-btn decrease" onclick="updateQuantity(${item.id}, -1)">&#8722;</button>
                                    ${item.quantity} x ₹${item.price.toFixed(2)}
                                    
                                </span>
                            </div>
                        </li>
                    `).join('');

                    cartContainer.html(cartHtml);
                    $('#cart-total').text('Total: ₹' + data.total.toFixed(2));
                } else {
                    cartContainer.html('<p>Your cart is empty.</p>');
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching cart data:", error);
            }
        });
    }

    // Function to update the quantity of an item
    window.updateQuantity = function(itemId, change) {
        let cart = getCartFromLocalStorage();
        let item = cart.find(item => item.id === itemId);
        
        if (item) {
            item.quantity += change;

            // Prevent the quantity from going below 1
            if (item.quantity <= 0) {
                item.quantity = 1;
            }

            saveCartToLocalStorage(cart);
            updateCart(); // Refresh the cart display
        }
    };

    // Function to remove an item from the cart
    window.removeItem = function(itemId) {
        let cart = getCartFromLocalStorage();
        // Remove the item with the given itemId
        cart = cart.filter(item => item.id !== itemId);
        
        saveCartToLocalStorage(cart);
        updateCart(); // Refresh the cart display
    };

    // Open Cart Button - Show Cart
    $(".js-show-cart").on("click", function () {
        $(".js-panel-cart").fadeIn();
        updateCart(); // Ensure the cart data is updated when opened
    });

    // Close Cart Button - Hide Cart
    $(".js-hide-cart").on("click", function () {
        $(".js-panel-cart").fadeOut();
    });

    // Initial cart update when the page loads
    updateCart(); // Load cart data initially when the page is loaded

});

</script>
