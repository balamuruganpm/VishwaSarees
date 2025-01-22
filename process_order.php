<?php
session_start();
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_method = $_POST['payment_method'];
    $user_id = $_SESSION['user_id']; // Assuming you store user_id in session after login
    $total_amount = 0;

    // Calculate total amount from cart
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total_amount += $item['price'] * $item['quantity'];
        }
    }

    // Insert order into database
    $order_query = "INSERT INTO orders (user_id, total_amount, payment_method, status) VALUES (?, ?, ?, 'pending')";
    $stmt = $conn->prepare($order_query);
    $stmt->bind_param("ids", $user_id, $total_amount, $payment_method);
    $stmt->execute();
    $order_id = $stmt->insert_id;

    // Insert order items
    $item_query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($item_query);
    foreach ($_SESSION['cart'] as $item) {
        $stmt->bind_param("iiid", $order_id, $item['id'], $item['quantity'], $item['price']);
        $stmt->execute();
    }

    // Clear the cart
    unset($_SESSION['cart']);

    // Redirect based on payment method
    if ($payment_method === 'cod') {
        header("Location: order_confirmation.php?order_id=" . $order_id);
    } elseif ($payment_method === 'upi') {
        header("Location: upi_payment.php?order_id=" . $order_id);
    }
    exit();
}

