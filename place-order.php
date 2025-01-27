<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
include('connection.php');

// Collecting data from POST request
$name = $_POST['name'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$payment_method = $_POST['payment_method'];
$total_amount = $_POST['total_amount'];
$product_ids = json_decode($_POST['product_ids']);
// Get product IDs as JSON string

// Debugging: Check POST data
var_dump($_POST);
// Debugging: Check incoming POST data
error_log(print_r($_POST, true)); // Will write to PHP error log

// Optionally, print it to the browser for quick checks
echo "<pre>";
print_r($_POST);
echo "</pre>";

// Insert data into database
$stmt = $conn->prepare("INSERT INTO orders (name, address, contact, payment_method, total_amount, product_ids) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssdss", $name, $address, $contact, $payment_method, $total_amount, $product_ids);

// Check if the query executed successfully
if ($stmt->execute()) {
    echo "Order placed successfully!";
} else {
    echo "Error: " . $stmt->error;  // This will show any SQL-related errors
}


$stmt->close();
$conn->close();
?>