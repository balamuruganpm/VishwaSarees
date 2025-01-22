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
            <ul class="header-cart-wrapitem w-full">
                <!-- Cart items will be appended here dynamically -->
            </ul>
            
            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40 js-total">
                    Total: ₹0.00
                </div>

                <div class="header-cart-buttons flex-w w-full">
                    <a class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10 js-check-btn">
                        Check Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script>
    $(document).on('click', '.js-check-btn', function(e) {
        e.preventDefault();
        var total_amount_v = parseInt($('.js-total').text().replace("Total: ₹", ""));
        if(total_amount_v > 500){
            window.location.replace("shoping-cart.php");
        }
        else{
            alert("The total amount must exceed ₹500.");
        }
    });
</script>
