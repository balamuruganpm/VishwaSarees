<?php
session_start();
include('connection.php');

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect POST data
    $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
    $user_id = $_SESSION['user_id'];  // Assuming user_id is stored in the session
    $total_amount = $_POST['total_amount'];
    $cart_items = json_decode($_POST['cart_items']); // Cart items data passed as JSON

    // Validate if payment method is selected
    if (!$payment_method) {
        echo "Error: Payment method is required!";
        exit();
    }

    // Validate if cart items are not empty
    if (empty($cart_items)) {
        echo "Error: No items in the cart!";
        exit();
    }

    // Convert cart items to JSON string for storage in product_ids column
    $product_ids = json_encode(array_map(function ($item) {
        return $item->id; // Assuming each item in cart has 'id'
    }, $cart_items));

    // Insert order into the database
    $order_query = "INSERT INTO orders (user_id, total_amount, payment_method, status, product_ids) 
                    VALUES (?, ?, ?, 'pending', ?)";
    $stmt = $conn->prepare($order_query);
    // Correct the binding types
    $stmt->bind_param("ids", $user_id, $total_amount, $payment_method); // 'i' for integer (user_id), 'd' for decimal (total_amount), 's' for string (payment_method)
    $stmt->execute();
    $order_id = $stmt->insert_id;

    // Insert order items into the order_items table
    $item_query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($item_query);
    foreach ($cart_items as $item) {
        // Bind parameters for the order items
        $stmt->bind_param("iiid", $order_id, $item->id, $item->quantity, $item->price); // 'i' for integer, 'd' for decimal
        $stmt->execute();
    }

    // Clear the cart session
    unset($_SESSION['cart']);

    // Redirect user based on the payment method
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
        .checkout-container { max-width: 800px; margin: 0 auto; padding: 20px; }
        .payment-options { margin-top: 20px; }
        .payment-option { margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="checkout-container">
        <h1>Checkout</h1>
        <h2>Order Summary</h2>
        <ul class="list-group" id="cart-items"></ul>
        <h3 id="cart-total">Total: ₹0.00</h3>

        <form method="POST" action="checkout.php">
    <input type="hidden" name="cart_items" id="cart-items-input">
    <input type="hidden" name="total_amount" id="total-amount-input">

    <div class="payment-options">
        <h2>Payment Method</h2>
        <div class="payment-option">
            <input type="radio" id="cod" name="payment_method" value="cod" required>
            <label for="cod">Cash on Delivery</label>
        </div>
        <div class="payment-option">
            <input type="radio" id="upi" name="payment_method" value="upi" required>
            <label for="upi">UPI Payment</label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Place Order</button>
</form>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            function getCartFromLocalStorage() {
                return JSON.parse(localStorage.getItem('cart') || '[]');
            }

            function updateCart() {
                let cart = getCartFromLocalStorage();
                let cartContainer = $('#cart-items');
                cartContainer.empty();

                let totalAmount = 0;
                if (cart.length > 0) {
                    cart.forEach(item => {
                        cartContainer.append(`
                            <li class="list-group-item d-flex align-items-center">
                                <div>${item.name} - ₹${item.price} x ${item.quantity}</div>
                            </li>
                        `);
                        totalAmount += item.price * item.quantity;
                    });
                    $('#cart-total').text('Total: ₹' + totalAmount.toFixed(2));
                    $('#cart-items-input').val(JSON.stringify(cart));
                    $('#total-amount-input').val(totalAmount.toFixed(2));
                } else {
                    $('#cart-total').text('Total: ₹0.00');
                }
            }

            updateCart();
        });
    </script>
</body>
</html>
