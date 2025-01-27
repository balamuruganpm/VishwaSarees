<?php
// Assuming $order_id and $payment_method are already defined

// Cash on Delivery
if ($payment_method === 'cod') {
    header("Location: order-confirmation.php?order_id={$order_id}");
    exit();
}

// UPI QR Payment
elseif ($payment_method === 'qr_upi') {
    header("Location: upi-payment.php?order_id={$order_id}");
    exit();
}

// UPI (Standard Payment)
elseif ($payment_method === 'upi') {
    header("Location: upi-payment.php?order_id={$order_id}");
    exit();
}
?>