<?php
session_start();
include 'connection.php';
include 'phpqrcode/qrlib.php'; // Include QR code library

if (!isset($_GET['order_id']) || !isset($_GET['amount'])) {
    die("Invalid request.");
}

$order_id = $_GET['order_id'];
$amount = $_GET['amount'];

// Generate QR Code
$upi_link = "upi://pay?pa=your-upi-id@bank&pn=VishwaSarees&mc=0000&tid=$order_id&tr=$order_id&am=$amount&cu=INR";
QRcode::png($upi_link, 'upi-qr.png', QR_ECLEVEL_L, 5);

// Handle payment confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $update_query = "UPDATE orders SET status = 'paid' WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();

    header("Location: order-confirmation.php?order_id=" . $order_id);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPI Payment</title>
</head>

<body>
    <h1>UPI Payment</h1>
    <p>Scan the QR code below to pay ₹<?php echo number_format($amount, 2); ?></p>
    <img src="upi-qr.png" alt="UPI QR Code">
    <form method="POST">
        <button type="submit">Confirm Payment</button>
    </form>
</body>

</html>