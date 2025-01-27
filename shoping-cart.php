<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .cart-item {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .cart-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .cart-item-img img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }

        .cart-item-details {
            flex-grow: 1;
            margin-left: 15px;
        }

        .remove-btn {
            background-color: transparent;
            border: none;
            color: #e74c3c;
            font-size: 20px;
            cursor: pointer;
        }

        .remove-btn:hover {
            color: #c0392b;
        }

        .cart-total {
            font-weight: bold;
            font-size: 18px;
        }

        .checkout-btn {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .checkout-btn:hover {
            background-color: #218838;
        }

        .cart-empty {
            text-align: center;
            color: #7f8c8d;
            font-size: 18px;
        }

        .empty-cart-message {
            text-align: center;
            margin-top: 20px;
        }

        .checkout-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        #upi-qr {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container mt-5 p-5">
        <h1 class="mb-4">Your Checkout</h1>
        <div class="row">
            <div class="col-12">
                <div class="list-group" id="cart-items">
                    <!-- Cart items will be dynamically added here -->
                </div>
                <div class="checkout-section">
                    <div id="cart-total" class="cart-total">Total: ₹0.00</div>
                </div>

                <!-- Billing Form -->
                <h3>Billing Information</h3>
                <form id="billing-form">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" id="contact" required>
                    </div>

                    <!-- Payment Options -->
                    <div class="mb-3">
                        <label class="form-label">Payment Method</label><br>
                        <input type="radio" name="payment_method" value="COD" checked> Cash on Delivery
                        <input type="radio" name="payment_method" value="UPI"> UPI Payment
                    </div>

                    <div id="upi-qr" style="display:none;">
                        <canvas id="qr-container"></canvas>

                        <p>Scan the QR code to pay via UPI</p>
                    </div>

                    <button type="submit" class="btn btn-success">Place Order</button>
                </form>

                <div id="empty-cart-msg" class="empty-cart-message" style="display:none;">
                    <p>Your cart is empty. Add some items to your cart to proceed!</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
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
                                <li class="list-group-item d-flex align-items-center cart-item" data-id="${item.id}">
                                    <div class="cart-item-img">
                                        <img src="${item.image}" alt="${item.name}" onerror="this.onerror=null; this.src='fallback.jpg';">
                                    </div>
                                    <div class="cart-item-details">
                                        <h5 class="mb-2">${item.name}</h5>
                                        <div class="d-flex align-items-center">
                                           <span class="mx-3">₹${item.price.toFixed(2)}</span>
                                        </div>
                                    </div>
                                    <button class="remove-btn" onclick="removeItem(${item.id})">&#10005;</button>
                                </li>
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

                    $('#upi-qr').show();
                    console.log('Generating QR for UPI URL:', upiUrl);
                    QRCode.toCanvas(document.getElementById('qr-container'), upiUrl, function (error) {
                        if (error) {
                            console.error(error);
                        } else {
                            console.log('QR code generated successfully!');
                        }
                    });

                } else {
                    $('#upi-qr').hide();
                }
            });

            // Handle Form Submission to Place Order
            $('#billing-form').submit(function (e) {
                e.preventDefault();

                // Get form data
                let name = $('#name').val();
                let address = $('#address').val();
                let contact = $('#contact').val();
                let paymentMethod = $("input[name='payment_method']:checked").val();
                let totalAmount = parseFloat($('#cart-total').text().replace('Total: ₹', ''));

                 console.log('Name:', name);
    console.log('Address:', address);
    console.log('Contact:', contact);
    console.log('Payment Method:', paymentMethod);
    console.log('Total Amount:', totalAmount)

                // Get product IDs from localStorage
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                let productIds = cart.map(item => item.id); // Assuming each cart item has an 'id' property

                console.log('Product IDs:', productIds); // Check the product IDs

                // Check if all fields are filled
                if (!name || !address || !contact || !paymentMethod || isNaN(totalAmount)) {
                    alert('Please fill in all the fields correctly.');
                    return;
                }

                // Save order to database (using AJAX request)
                $.ajax({
                    url: 'place-order.php',
                    type: 'POST',
                    data: {
                        name: name,
                        address: address,
                        contact: contact,
                        payment_method: paymentMethod,
                        total_amount: totalAmount,
                        product_ids: JSON.stringify(productIds)  // Send product IDs as JSON string
                    },
                    success: function (response) {
                        // Show success popup
                        alert('Order placed successfully!');

                        // Redirect to home page
                        window.location.href = 'index.php'; // or wherever your home page is

                        // Clear the cart from localStorage and cookies
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
</body>

</html>