<?php
session_start();
include 'connection.php';

// Handle the form submission (same as before)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_method = $_POST['payment_method'];
    $user_id = $_SESSION['user_id'];

    // Insert order into database
    $order_query = "INSERT INTO orders (user_id, total_amount, payment_method, status) VALUES (?, ?, ?, 'pending')";
    $stmt = $conn->prepare($order_query);
    $stmt->bind_param("ids", $user_id, $total_amount, $payment_method);
    $stmt->execute();
    $order_id = $stmt->insert_id;

    // Insert order items
    $item_query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($item_query);
    foreach ($_POST['cart_items'] as $item) {
        $stmt->bind_param("iiid", $order_id, $item['id'], $item['quantity'], $item['price']);
        $stmt->execute();
    }

    // Clear the cart
    unset($_SESSION['cart']);

    // Redirect based on payment method
    if ($payment_method === 'cod') {
        header("Location: order-confirmation.php?order_id=" . $order_id);
    } elseif ($payment_method === 'upi') {
        header("Location: upi-payment.php?order_id=" . $order_id);
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Vishwa Sarees</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .checkout-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .payment-options {
            margin-top: 20px;
        }

        .payment-option {
            margin-bottom: 10px;
        }

        .cart-item-img img {
            max-width: 50px;
        }

        .cart-item-details h5 {
            margin: 0;
        }

        .cart-item-details .d-flex {
            justify-content: space-between;
        }
    </style>
</head>

<body>

    <div class="checkout-container">
        <h1 class="mb-4">Checkout</h1>

        <h2>Order Summary</h2>
        <ul class="list-group" id="cart-items">
            <!-- Cart items will be injected here via JS -->
        </ul>

        <h3 id="cart-total">Total: ₹0.00</h3>

        <form method="POST" action="checkout.php">
            <input type="hidden" name="cart_items" id="cart-items-input">
            <div class="payment-options">
                <h2>Payment Method</h2>
                <div class="payment-option">
                    <input type="radio" id="cod" name="payment_method" value="cod" required>
                    <label for="cod">Cash on Delivery</label>
                </div>
                <div class="payment-option">
                    <input type="radio" id="upi" name="payment_method" value="upi" required>
                    <label for="upi">UPI QR Code</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Place Order</button>
        </form>
    </div>

    <?php include_once 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        console.log("Cart items:", cart); // Debugging - Check what's in the cart

        let cartContainer = $('#cart-items');
        cartContainer.empty();

        if (cart.length > 0) {
            let cartHtml = cart.map(item => `
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
            let total = cart.reduce((sum, item) => sum + (item.quantity * item.price), 0);
            $('#cart-total').text('Total: ₹' + total.toFixed(2));
            $('#cart-items-input').val(JSON.stringify(cart));
        } else {
            cartContainer.html('');
            $('#cart-total').text('Total: ₹0.00');
        }
    }

    window.removeItem = function (itemId) {
        let cart = getCartFromLocalStorage();
        cart = cart.filter(item => item.id !== itemId);
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCart();
    };

    updateCart();
});

   </script>
</body>

</html>