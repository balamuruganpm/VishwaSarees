<?php
session_start();
$total_amount = 0;
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total_amount += $item['price'] * $item['quantity'];
    }
}
include('connection.php');

// Fetch cart items from the session
$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Calculate total amount
//This section is now redundant because we calculate the total amount earlier.
//$total_amount = 0;
//foreach ($cart_items as $item) {
//    $total_amount += $item['price'] * $item['quantity'];
//}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_method = $_POST['payment_method'];
    $user_id = $_SESSION['user_id']; // Assuming you store user_id in session after login

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
    <title>Shopping Cart</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Shopping Cart</h1>
        <?php if (empty($cart_items)): ?>
            <p>Your cart is empty.</p>
        <?php else: ?>
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
            <form method="POST" action="process_order.php">
                <div class="form-group">
                    <label>Payment Method:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" required>
                        <label class="form-check-label" for="cod">Cash on Delivery</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="upi" value="upi" required>
                        <label class="form-check-label" for="upi">UPI QR Code</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Place Order</button>
            </form>
        <?php endif; ?>
    </div>
</body>

</html>