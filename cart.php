<style>
    .js-check-btn {
        cursor: pointer;
        background-color: darkgreen !important;
        color: white !important;
    }
    .header-cart-item-img{
        width: 100px;
        height: 100px;

    }
    .header-cart-item-img img{
        width: 100%;
        height: 100%;
    }
</style>

<!-- HTML for the Cart -->
<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
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
                <div class="header-cart-total w-full p-tb-40" id="cart-total">
                    Total: ₹0.00
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
<!-- mark -->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script>
 $(document).ready(function () {
    function getCartFromLocalStorage() {
        let cart = [];

        for (let i = 0; i < localStorage.length; i++) {
            try {
                let value = JSON.parse(localStorage.getItem(localStorage.key(i)));
                if (Array.isArray(value)) {
                    cart = value;
                    break;
                }
            } catch (e) {
                console.warn("Skipping invalid JSON:", localStorage.key(i));
            }
        }

        return cart;
    }
    function updateCart() {
    let cart = getCartFromLocalStorage();

    $.ajax({
        url: 'get-cart.php',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ cart: cart }),
        dataType: 'json',
        success: function (data) {
            console.log("Cart Data Received:", data); // Debugging

            let cartContainer = $('#cart-items');
            cartContainer.empty(); // Clear old cart data

            if (data.items && data.items.length > 0) {
                let cartHtml = data.items.map(item => `
                    <li class="cart-item">
                        <img src="${item.image}" alt="${item.name}" onerror="this.onerror=null; this.src='fallback.jpg';">
                        <div class="cart-item-info">
                            <span class="cart-item-name">${item.name}</span>
                            <span class="cart-item-quantity">${item.quantity} x ₹${item.price.toFixed(2)}</span>
                        </div>
                    </li>
                `).join('');

                console.log("Generated HTML:", cartHtml); // Debugging

                cartContainer.html(cartHtml);
                $('#cart-total').text('Total: ₹' + data.total.toFixed(2));
            } else {
                cartContainer.html('<p>Your cart is empty.</p>');
            }
        },
        error: function (xhr, status, error) {
            console.error("Error fetching cart data:", error);
            console.error("Status:", status);
            console.error("Response:", xhr.responseText);
        }
    });
    }


    // Update cart on page load
    updateCart();

    // Update cart when an item is added
    window.updateCartDisplay = updateCart;
});

</script>