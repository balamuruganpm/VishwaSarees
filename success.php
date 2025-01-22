<?php
// Include the database connection file
include_once 'connection.php';

// Check if payment ID is set in the POST request
if (isset($_POST['razorpay_payment_id']) && isset($_POST['products']) && isset($_POST['name']) && isset($_POST['address']) && isset($_POST['email'])) {
    $payment_id = $conn->real_escape_string($_POST['razorpay_payment_id']);
    $products = $conn->real_escape_string($_POST['products']);
    $name = $conn->real_escape_string($_POST['name']);
    $address = $conn->real_escape_string($_POST['address']);
    $phoneno = $conn->real_escape_string($_POST['phoneno']);
    $email = $conn->real_escape_string($_POST['email']);
    $total_amount = $_POST['total_amount']/100;
    $state = $_POST['state'];
    $states = $_POST['states'];
    $gstno = $_POST['gstno'];
    
    // Insert data into the orders table
    $query = "INSERT INTO orders (payment_id, products, name, address, email, phone_no, Amount,state,states,status,gst_no) VALUES ('$payment_id', '$products', '$name', '$address', '$email','$phoneno','$total_amount','$state','$states','New','$gstno')";

    if (mysqli_query($conn, $query)) {
        // Successfully inserted
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Redirect to an error page or display a message if no payment ID is found
    echo "Payment details not found.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #e9f5f5;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin-top: 100px;
        }
        .thank-you-message {
            text-align: center;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }
        .thank-you-message h1 {
            color: #28a745;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        .thank-you-message p {
            font-size: 1.25rem;
            margin-bottom: 10px;
        }
        .thank-you-message .payment-id {
            font-weight: bold;
            color: #007bff;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="thank-you-message">
            <h1>Thank You for Your Purchase!</h1>
            <p>Your payment was successful.</p>
            <p class="payment-id">Payment ID: <?php echo htmlspecialchars($payment_id); ?></p>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
