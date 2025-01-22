<?php
session_start();
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];

    // Update order status
    $update_query = "UPDATE orders SET status = 'paid' WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();

    header("Location: order_confirmation.php?order_id=" . $order_id);
    exit();
}

