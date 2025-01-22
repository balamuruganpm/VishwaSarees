<?php
session_start();
include 'connection.php';

if (!isset($_GET['order_id'])) {
    header("Location: index.php");
    exit();
}

$order_id = $_GET['order_id'];

// Fetch order details
$order_query = "SELECT * FROM orders WHERE id = ?";
$stmt = $conn->prepare($order_query);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();

if (!$order) {
    die("Order not found");
}

// Generate UPI QR code (you'll need to implement this part based on your payment gateway)
$upi_id = "your-upi-id@upi"; // Replace with your actual UPI ID
$amount = $order['total_amount'];
$qr_code_url = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=upi://pay?pa=$upi_id&pn=VishwaSarees&am=$amount&cu=INR";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPI Payment - Vishwa Sarees</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <style>
        .upi-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        .qr-code {
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <?php include_once 'header.php'; ?>

    <div class="upi-container">
        <h1 class="mb-4">UPI Payment</h1>
        <p>Scan the QR code below to make the payment:</p>
        <div class="qr-code">
            <img src="<?php echo $qr_code_url; ?>" alt="UPI QR Code">
        </div>
        <p>Amount: ₹<?php echo number_format($amount, 2); ?></p>
        <form method="POST" action="confirm-payment.php">
            <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
            <button type="submit" class="btn btn-primary">Confirm Payment</button>
        </form>
    </div>

    <?php include_once 'footer.php'; ?>

    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>