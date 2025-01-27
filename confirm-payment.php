<?php
$order_id = $_GET['order_id'];

// Assuming you have a function `updateOrderStatus($order_id, $status)` to update the order in the database
// The "paid" status will be set here.

if ($order_id) {
    // Example function to update the order status
    updateOrderStatus($order_id, 'paid');

    // Redirect to a success page after the payment is confirmed
    header("Location: payment-success.php?order_id={$order_id}");
    exit();
} else {
    // Redirect to an error page if the order_id is not valid
    header("Location: payment-failed.php");
    exit();
}
?>