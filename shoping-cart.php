<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
    <style>
        /* Custom styles for the cart items hover effect */
        .cart-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center mb-5">Your Checkout</h1>

        <div id="empty-cart-msg" class="text-center text-xl text-muted mb-5" style="display:none;">
            <p>Your cart is empty. Add some items to your cart to proceed!</p>
        </div>

        <div class="row">
            <!-- Cart Items Section -->
            <div class="col-md-8">
                <div class="list-group" id="cart-items">
                    <!-- Cart items will be dynamically added here -->
                </div>
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <h4 id="cart-total">Total: ₹0.00</h4>
                </div>
            </div>

            <!-- Billing Information -->
            <div class="col-md-4">
                <h3 class="h4 mb-4">Billing Information</h3>
                <form id="billing-form">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" id="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea id="address" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact Number</label>
                        <input type="text" id="contact" class="form-control" required>
                    </div>

                    <!-- Payment Options -->
                    <div class="mb-4">
                        <label class="form-label">Payment Method</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="COD" checked>
                            <label class="form-check-label" for="cod">Cash on Delivery</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="upi" value="UPI">
                            <label class="form-check-label" for="upi">UPI Payment</label>
                        </div>
                    </div>

                    <!-- UPI QR Code Section -->
                    <div id="upi-qr" class="d-none">
                        <canvas id="qr-container" class="mx-auto my-4"></canvas>
                        <p class="text-center text-muted">Scan the QR code to pay via UPI</p>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">Place Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

            function saveCartToLocalStorage(cart) {
                localStorage.setItem('cart', JSON.stringify(cart));
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
                        let cartContainer = $('#cart-items');
                        cartContainer.empty();

                        if (data.items && data.items.length > 0) {
                            let cartHtml = data.items.map(item => `
                                <div class="list-group-item d-flex justify-content-between align-items-center cart-item">
                                    <div class="d-flex align-items-center">
                                        <img src="${item.image}" alt="${item.name}" class="img-thumbnail" style="width: 60px; height: 60px;">
                                        <div class="ms-3">
                                            <h6 class="mb-1">${item.name}</h6>
                                            <span class="text-muted">₹${item.price.toFixed(2)}</span>
                                        </div>
                                    </div>
                                    <button class="btn btn-danger btn-sm" onclick="removeItem(${item.id})">✖</button>
                                </div>
                            `).join('');

                            cartContainer.html(cartHtml);

                            // Recalculate total
                            let total = data.items.reduce((sum, item) => sum + (item.quantity * item.price), 0);
                            $('#cart-total').text('Total: ₹' + total.toFixed(2));
                            $('#empty-cart-msg').hide();
                        } else {
                            cartContainer.html('');
                            $('#cart-total').text('Total: ₹0.00');
                            $('#empty-cart-msg').show();
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching cart data:", error);
                    }
                });
            }

            window.removeItem = function (itemId) {
                let cart = getCartFromLocalStorage();
                cart = cart.filter(item => item.id !== itemId);
                saveCartToLocalStorage(cart);
                updateCart();
            };

            // Handle Payment Method Change
            $("input[name='payment_method']").change(function () {
                if ($(this).val() === "UPI") {
                    let totalAmount = parseFloat($('#cart-total').text().replace('Total: ₹', ''));
                    let upiUrl = `upi://pay?pa=balamuruganedsty@oksbi&pn=bala&mc=0000&tid=1234567890&amt=${totalAmount}&cu=INR&url=balamurugan.rf.gd`;

                    $('#upi-qr').removeClass('d-none');
                    console.log('Generating QR for UPI URL:', upiUrl);
                    QRCode.toCanvas(document.getElementById('qr-container'), upiUrl, function (error) {
                        if (error) {
                            console.error(error);
                        } else {
                            console.log('QR code generated successfully!');
                        }
                    });
                } else {
                    $('#upi-qr').addClass('d-none');
                }
            });

            // Handle Form Submission to Place Order
            $('#billing-form').submit(function (e) {
                e.preventDefault();

                let name = $('#name').val();
                let address = $('#address').val();
                let contact = $('#contact').val();
                let paymentMethod = $("input[name='payment_method']:checked").val();
                let totalAmount = parseFloat($('#cart-total').text().replace('Total: ₹', ''));

                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                let productIds = cart.map(item => item.id);

                if (!name || !address || !contact || !paymentMethod || isNaN(totalAmount)) {
                    alert('Please fill in all the fields correctly.');
                    return;
                }

                $.ajax({
                    url: 'place-order.php',
                    type: 'POST',
                    data: {
                        name: name,
                        address: address,
                        contact: contact,
                        payment_method: paymentMethod,
                        total_amount: totalAmount,
                        product_ids: JSON.stringify(productIds)
                    },
                    success: function (response) {
                        alert('Order placed successfully!');
                        window.location.href = 'index.php';

                        localStorage.removeItem('cart');
                        document.cookie = 'cart=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/';
                    },
                    error: function (xhr, status, error) {
                        console.error('Error placing order:', error);
                    }
                });
            });

            updateCart();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
