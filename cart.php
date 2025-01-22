
<style>
    .js-check-btn {
        cursor: pointer;
        background-color: darkgreen !important;
        color: white !important;
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

<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script>
    $(document).ready(function () {
        function updateCart() {
            $.ajax({
                url: 'get-cart.php',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data.items && data.total) {
                        let cartHtml = '';
                        data.items.forEach(function (item) {
                            cartHtml += `
                            <li class="header-cart-item flex-w flex-t m-b-12">
                                <div class="header-cart-item-img">
                                    <img src="${item.image}" alt="${item.name}">
                                </div>
                                <div class="header-cart-item-txt p-t-8">
                                    <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                        ${item.name}
                                    </a>
                                    <span class="header-cart-item-info">
                                        ${item.quantity} x ₹${item.price.toFixed(2)}
                                    </span>
                                </div>
                            </li>
                        `;
                        });
                        $('#cart-items').html(cartHtml);
                        $('#cart-total').text('Total: ₹' + data.total.toFixed(2));
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching cart data:", error);
                }
            });
        }

        // Update cart on page load
        updateCart();

        // Update cart when an item is added (you'll need to call this function when adding items to cart)
        window.updateCartDisplay = updateCart;
    });
</script>