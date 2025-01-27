<?php
$order_id = $_GET['order_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container text-center mt-5">
        <h2 class="mb-4">Your Payment was Successful!</h2>
        <p>Thank you for your purchase. Your order ID is <strong><?php echo $order_id; ?></strong>.</p>
        <a href="order-confirmation.php?order_id=<?php echo $order_id; ?>" class="btn btn-primary">Go to Order
            Confirmation</a>
    </div>

</body>

</html>