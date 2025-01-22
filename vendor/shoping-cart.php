<?php
require('razorpay-php/Razorpay.php');
require('keys.php');  // Ensure this file contains your API keys
session_start();
if (isset($_SESSION['phone'])) {


} else {
    echo"<script>alert('Login first')</script>";
    header("Location: login.php");
    header("Location: login.php");
    	exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shoping Cart</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/logo.jpg">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <!--===============================================================================================-->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        /* Main Cart Section */
        .shopcart {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
            flex-wrap: wrap;
        }

        /* Button Styling */
        button[type="button"] {
            background-color: #28a745;
            color: white;
            padding: 12px 16px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            border: none;
            width: 100%;
        }

        button[type="button"]:hover {
            background-color: #218838;
        }

        button[type="button"]:active {
            background-color: #1e7e34;
        }

        /* Additional Billing Items */
        .billing-item .product-price,
        .shipping-cost,
        .gst-amount,
        .total-amount {
            color: #000;
            font-weight: bold;
        }

        /* Responsive Panels */
        .left-panel {
            width: 70%;
        }

        .right-panel {
            width: 30%;
            padding: 0 20px;
        }

        /* Responsive Billing Details */
        .billing-details-container-in {
            padding: 20px 40px;
        }

        .billing-details-container h5 {
            color: #1e7e34;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        /* Form Input Styling */
        form input[type="text"],
        form input[type="email"],
        form input[type="tel"],
        form select,
        form textarea {
            width: 100% !important;
            padding: 20px !important;
            color: black !important;
            border: 1px solid #ccc !important;
            border-radius: 5px !important;
            background-color: white !important;
            transition: border-color 0.3s ease, box-shadow 0.3s ease !important;
        }

        form select {
            width: 100% !important;
            padding: 20px !important;
            color: black !important;
            border: 1px solid #ccc !important;
            border-radius: 5px !important;
            background: transparent !important;
        }

        /* Table Shopping Cart */
        .table-shopping-cart {
            width: 100%;
        }

        .table_row {
            height: 100px !important;
        }

        .table-shopping-cart .column-1 {
            padding: 0% !important;
            padding-left: 2% !important;
        }

        .js-remove-item {
            background-color: #ff0000 !important;
            padding: 10px !important;
            cursor: pointer;
        }

        /* Responsive Design */

        /* For tablets and smaller screens */
        @media (max-width: 992px) {
            .left-panel {
                width: 100%;
                /* Make full width on tablets */
            }

            .right-panel {
                width: 100%;
                /* Stack right panel below the left */
                padding: 0;
                margin-top: 30px;
            }

            .billing-details-container-in {
                padding: 10px 20px;
            }

            .table_row {
                height: auto !important;
            }

            table {
                overflow-x: auto;
            }
        }

        /* For mobile phones */
        @media (max-width: 576px) {
            button[type="button"] {
                font-size: 14px;
                padding: 10px;
            }

            form input[type="text"],
            form input[type="email"],
            form input[type="tel"],
            form select,
            form textarea {
                padding: 15px !important;
            }

            .billing-details-container h5 {
                font-size: 1.2rem;
            }

            .table-shopping-cart .column-1 {
                padding-left: 1% !important;
            }
        }
    </style>

</head>

<body class="animsition">

    <!-- Header -->
    <header>
        <div class="marquee">
            <p>
                <img src="./images/ordernow.png" title="Yuginii" alt="ordernow" class="ordernow" />
                Welcome to our online store. We are open for business. Place your
                order now!
            </p>
        </div>
        <!-- Header desktop -->
        <div class="container-menu-desktop">
            <div class="wrap-menu-desktop" style="background: rgba(255, 255, 255, 0.69); top: 0px; position:relative;">
                <nav class="limiter-menu-desktop container">

                    <!-- Logo desktop -->
                    <a href="#" class="logo1">
                        <img src="images/icons/logo1.png" class="logo" alt="JUGINII">
                    </a>
                    <!-- Menu desktop -->
                    <div class="menu-desktop">
                        <ul class="main-menu">
                            <li class="active-menu">
                                <a href="index.php" class="active" aria-current="page">Home</a>
                            </li>

                            <li>
                                <a href="retails_shop.php">Retail Shop</a>
                            </li>

                            <li>
                                <a href="whole_shop.php">Wholesale Shop</a>
                            </li>

                            <li>
                                <a href="about.php">About US</a>
                            </li>

                            <li>
                                <a href="contact.php">Contact Us</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Icon header -->
                    <div class="wrap-icon-header flex-w flex-r-m">

                        <a href="https://wa.me/+918012111178"
                            class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 ">
                            <i class="fab fa-whatsapp"></i>
                        </a>

                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                            data-notify="0">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>

                        <a href="#productview" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                            <img src="./images/rb_5045.png" alt="sale" width="80">
                        </a>

                    </div>
                </nav>
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->
            <div class="logo-mobile">
                <img src="images/icons/logo.png" width="100px" height="100px" alt="JUGINII">
            </div>

            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m m-r-15">

                <a href="https://wa.me/+918012111178"
                    class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10" data-notify="0">
                    <i class="fab fa-whatsapp"></i>
                </a>

                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                    data-notify="0">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>


            </div>

            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>


        <!-- Menu Mobile -->
        <div class="menu-mobile">

            <ul class="main-menu-m">
                <li>
                    <a href="index.php">Home</a>
                </li>

                <li>
                    <a href="retails_shop.php">Retail Shop</a>
                </li>

                <li>
                    <a href="whole_shop.php">Wholesale Shop</a>
                </li>

                <li>
                    <a href="about.php">About</a>
                </li>

                <li>
                    <a href="contact.php">Contact</a>
                </li>
            </ul>
        </div>

        <!-- Modal Search -->
        <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
            <div class="container-search-header">
                <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                    <img src="images/icons/icon-close2.png" alt="CLOSE">
                </button>

                <form class="wrap-search-header flex-w p-l-15">
                    <button class="flex-c-m trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                    <input class="plh3" type="text" name="search" placeholder="Search...">
                </form>
            </div>
        </div>
    </header>

    <!-- Cart include -->
    <?php include_once 'cart.php';
    ?>

    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Shoping Cart
            </span>
        </div>
    </div>

    <!-- Shoping Cart -->
    <div class="container mt-5 mb-5">
        <form id="checkout-form" action="success.php" class="shopcart" method="post">
            <div class="table-responsive mb-4 left-panel">
                <h5>Your Shopping Cart</h5>

                <table class="table table-shopping-cart">
                    <thead class="thead-light">
                        <tr>
                            <th>Product</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Cart items will be dynamically inserted here -->
                    </tbody>
                </table>

                <div class="bottom-panel">
                    <div class="billing-details-container billing-details-container-in">
                        <h5>Contact Information</h5>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" placeholder="Your name" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="phoneno">Phone Number:</label>
                            <input type="tel" class="form-control" id="phoneno" name="phoneno" pattern="\d{10}"
                                placeholder="Your phone number" required>
                            <div class="invalid-feedback">Please enter a valid 10-digit phone number (without +91).
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" placeholder="Your email" class="form-control"
                                required>
                        </div>
                    </div>

                    <div class="billing-details-container billing-details-container-in">
                        <h5>Address Details</h5>
                        <div class="form-group">
                            <label for="gstno">GST Number <span class="text-muted">(Optional)</span>:</label>
                            <input type="text" id="gstno" name="gstno" class="form-control"
                                placeholder="Example: 22AAAAA0000A1Z5"
                                pattern="\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}">
                            <small class="form-text text-muted">Enter a valid GST number in the correct format.</small>
                        </div>
                        <div class="form-group">
                            <label for="state">State:</label>
                            <select id="state" name="states" aria-placeholder="Select your state" class="form-control"
                                required>
                                <option value="" disabled selected>Select your state</option>
                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                <option value="Assam">Assam</option>
                                <option value="Bihar">Bihar</option>
                                <option value="Chhattisgarh">Chhattisgarh</option>
                                <option value="Goa">Goa</option>
                                <option value="Gujarat">Gujarat</option>
                                <option value="Haryana">Haryana</option>
                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                <option value="Jharkhand">Jharkhand</option>
                                <option value="Karnataka">Karnataka</option>
                                <option value="Keralam">Keralam</option>
                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                <option value="Maharashtra">Maharashtra</option>
                                <option value="Manipur">Manipur</option>
                                <option value="Meghalaya">Meghalaya</option>
                                <option value="Mizoram">Mizoram</option>
                                <option value="Nagaland">Nagaland</option>
                                <option value="Odisha">Odisha</option>
                                <option value="Punjab">Punjab</option>
                                <option value="Rajasthan">Rajasthan</option>
                                <option value="Sikkim">Sikkim</option>
                                <option value="Tamil Nadu">Tamil Nadu</option>
                                <option value="Telangana">Telangana</option>
                                <option value="Tripura">Tripura</option>
                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                <option value="Uttarakhand">Uttarakhand</option>
                                <option value="West Bengal">West Bengal</option>
                                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                <option value="Chandigarh">Chandigarh</option>
                                <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                                <option value="Daman and Diu">Daman and Diu</option>
                                <option value="Lakshadweep">Lakshadweep</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Puducherry">Puducherry</option>
                                <option value="Ladakh">Ladakh</option>
                                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <textarea id="address" name="address"
                                placeholder="Enter your address with pincode. i.e; 123, street, salem, 636301."
                                class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="right-panel">
                <div class="billing-details-container">
                    <h5>Shipping Information</h5>
                    <div class="form-group">
                        <label for="delivery-category">Select Shipping Category</label>
                        <select class="form-control" id="delivery-category" name="delivery-category" required>
                            <option value="" disabled>Select Shipping Category</option>
                            <option value="40" selected data-tax-category="Tamilnadu">Inside Tamilnadu - ₹40</option>
                            <option value="60" data-tax-category="Other">Inside South India - ₹60</option>
                            <option value="120" data-tax-category="Other">North India - ₹120</option>
                        </select>
                    </div>
                </div>

                <div class="billing-details-container">
                    <h5>Billing Details</h5>
                    <div class="billing-item d-flex justify-content-between mb-2">
                        <span>Product Price:</span>
                        <span class="product-price" style="font-weight:bold;">₹0.0</span>
                    </div>
                    <div class="billing-item d-flex justify-content-between mb-2">
                        <span>Shipping Cost:</span>
                        <span class="shipping-cost" style="font-weight:bold;">₹0.0</span>
                    </div>
                    <div class="billing-item d-flex justify-content-between mb-2">
                        <span>Tax (GST: 2.5% & CGST: 2.5%):</span>
                        <span class="tax-amount gst-amount" style="font-weight:bold;">₹0.0</span>
                    </div>

                    <hr>

                    <div class="total-amount-container d-flex justify-content-between align-items-center">
                        <span>Total Amount:</span>
                        <span class="total-amount" style="font-weight:bold; color: red;">₹0.0</span>
                    </div>
                </div>
                <br>
                <button type="button" onclick="paynow()" class="btn btn-primary btn-block">Proceed to Checkout</button>
            </div>

        </form>
    </div>

    <!-- Footer -->
    <?php include_once 'footer.php'; ?>

    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>

    <a href="https://wa.me/+918012111178" target="_blank" rel="noopener noreferrer">
        <img src="images/whatsapp_PNG20.png" class="right-whatsapp" width="50px" alt="YUGINII">
    </a>
    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/script.js"></script>
    <script>
        $(".js-select2").each(function () {
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
    </script>
    <!--===============================================================================================-->
    <script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script>
        $('.js-pscroll').each(function () {
            $(this).css('position', 'relative');
            $(this).css('overflow', 'hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function () {
                ps.update();
            })
        });
    </script>
    <script>
        function validateForm() {
            let total_amount = $('#total_amount').val() / 100;
            let shipping = $('#delivery-category').val();
            let name = $('#name').val();
            let phoneno = $('#phoneno').val();
            let email = $('#email').val();
            let address = $('#address').val();


            // Check if shipping option is selected
            if (!shipping) {
                alert("Please select a shipping option.");
                return false;
            }

            // Check if name is entered
            if (!name) {
                alert("Please enter your name.");
                return false;
            }

            // Check if email is entered
            if (!phoneno) {
                alert("Please enter your phoneno.");
                return false;
            }


            // Check if address is entered
            if (!address) {
                alert("Please enter your address.");
                return false;
            }



            // Check if total amount exceeds ₹500
            if (total_amount < 500) {
                alert("The total amount must exceed ₹500.");
                return false;
            }

            return true;
        }

        // Function to initiate payment
        function paynow() {
            var validation = validateForm();
            if (validation == true) {
                var totalAmountInPaise = $('#total_amount').val(); // Get the final total amount in paise
                console.log(totalAmountInPaise);

                $.ajax({
                    url: 'checkout.php',
                    type: 'POST',
                    data: { total_amount: totalAmountInPaise },
                    dataType: 'json',
                    success: function (response) {
                        var options = {
                            key: '<?php echo RAZORPAY_KEY; ?>', // Your Razorpay Key ID
                            amount: totalAmountInPaise,
                            currency: 'INR',
                            name: 'Yuginii stores',
                            description: 'Payment for your order',
                            image: 'https://cdn.razorpay.com/logos/GhRQcyean79PqE_medium.png',
                            order_id: response.order_id,
                            theme: {
                                color: '#738276'
                            },
                            handler: function (response) {
                                // Handle the successful payment here
                                console.log('Payment successful!');
                                $('#checkout-form').append('<input type="hidden" name="razorpay_payment_id" value="' + response.razorpay_payment_id + '">');
                                console.log('Payment ID:', response.razorpay_payment_id); // Retrieve payment ID

                                var products_data = loadCart(); // Get product details from local storage
                                $('#checkout-form').append('<input type="hidden" name="products" value=\'' + JSON.stringify(products_data) + '\'>');

                                $('#checkout-form').submit();
                            },
                            modal: {
                                ondismiss: function () {
                                    // Handle modal dismissal if necessary
                                    console.log('Payment modal closed.');
                                }
                            }
                        };

                        var rzp = new Razorpay(options);
                        rzp.open();
                    }
                });
            }
        }


    </script>
    <!--===============================================================================================-->

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        // Function to initialize or load cart data from localStorage
        function loadCart() {
            const cartData = localStorage.getItem('cart');
            return cartData ? JSON.parse(cartData) : [];
        }

        // Function to save cart data to localStorage
        function saveCart(cart) {
            localStorage.setItem('cart', JSON.stringify(cart));
        }
        function removeItemFromCart(productId) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            // Ensure that productId is a string for comparison if item.id is a string
            productId = productId.toString();

            cart = cart.filter(item => item.id.toString() !== productId);
            localStorage.setItem('cart', JSON.stringify(cart));
            loadCart();
            updateCartNotification();
        }

        // Function to update the cart in the database
        function updateCartInDatabase(cart) {
            $.ajax({
                url: 'update_cart.php',
                method: 'POST',
                data: { cart: JSON.stringify(cart) },
                success: function (response) {
                    console.log('Cart updated successfully in the database');
                },
                error: function () {
                    console.log('Failed to update cart in the database');
                }
            });
        }

        // Add event listener for updating cart totals
        $('.flex-c-m.stext-101').click(function () {
            const cart = [];
            $('.table_row').each(function (index, row) {
                const id = $(row).find('.column-2').data('product-id');
                const quantity = $(row).find('.num-product').val();
                cart.push({ id, quantity });
            });

            // Save updated cart to localStorage and database
            saveCart(cart);
            updateCartInDatabase(cart);

            // Update cart display
            updateCartDisplay();
        });


    </script>
    <script>
        // Function to calculate delivery charges
        function calculateDeliveryCharges() {
            const deliveryCategory = $('select[name="delivery-category"]').val();
            let deliveryCharge = 0;

            switch (deliveryCategory) {
                case 'Inside Tamilnadu':
                    deliveryCharge = 40;
                    break;
                case 'Inside South India':
                    deliveryCharge = 60;
                    break;
                case 'North India':
                    deliveryCharge = 120;
                    break;
            }

            return deliveryCharge;
        }

    </script>

</body>

</html>