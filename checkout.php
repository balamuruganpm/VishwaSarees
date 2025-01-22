<?php
session_start();
include 'connection.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch cart items from the session
$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Calculate total amount
$total_amount = 0;
foreach ($cart_items as $item) {
    $total_amount += $item['price'] * $item['quantity'];
}

// Handle form submission
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
    foreach ($cart_items as $item) {
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
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
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
    </style>
</head>

<body>
    <?php include_once 'header.php'; ?>

    <div class="checkout-container">
        <h1 class="mb-4">Checkout</h1>

        <h2>Order Summary</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart_items as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>₹<?php echo number_format($item['price'], 2); ?></td>
                        <td>₹<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Total: ₹<?php echo number_format($total_amount, 2); ?></h3>

        <form method="POST" action="checkout.php">
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

    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>