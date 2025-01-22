<?php
require('razorpay-php/Razorpay.php');
require('keys.php');  // Ensure this file contains your API keys

use Razorpay\Api\Api;

$api = new Api(RAZORPAY_KEY, RAZORPAY_SECRET);

$total_amount = isset($_POST['total_amount']) ? $_POST['total_amount'] : 0;

$order = $api->order->create([
    'amount' => $total_amount, // amount in paise
    'currency' => 'INR',
    'receipt' => 'order_receipt_' . uniqid()
]);

$order_id = $order->id;

echo json_encode(['order_id' => $order_id]);
?>
