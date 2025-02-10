<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
include('connection.php');

// Collecting data from POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate if required fields are present
    if (isset($_POST['name'], $_POST['address'], $_POST['contact'], $_POST['payment_method'], $_POST['total_amount'], $_POST['product_ids'])) {
        // Sanitize and assign values
        $name = htmlspecialchars($_POST['name']);
        $address = htmlspecialchars($_POST['address']);
        $contact = htmlspecialchars($_POST['contact']);
        $payment_method = htmlspecialchars($_POST['payment_method']);
        $total_amount = $_POST['total_amount'];  // Ensure it's a valid number
        $product_ids = json_decode($_POST['product_ids']); // Decode product IDs from JSON

        // Ensure product_ids is an array
        if (!is_array($product_ids)) {
            echo "Invalid product IDs data.";
            exit();
        }

        // Ensure total_amount is numeric and valid
        if (!is_numeric($total_amount)) {
            echo "Invalid total amount.";
            exit();
        }

        // Add random number of product IDs (for demonstration purposes)
        $num_new_ids = rand(1, 3); // Random count between 1 and 5
        for ($i = 0; $i < $num_new_ids; $i++) {
            $product_ids[] = (string) rand(30, 50); // Random product ID between 30 and 60
        }

        // Encode product IDs back to JSON for storage in the database
        $product_ids = json_encode($product_ids);

        // Prepare the SQL query
        $stmt = $conn->prepare("INSERT INTO orders (name, address, contact, payment_method, total_amount, product_ids) VALUES (?, ?, ?, ?, ?, ?)");

        // Bind the parameters to the query
        $stmt->bind_param("sssdss", $name, $address, $contact, $payment_method, $total_amount, $product_ids);

        // Check if the query executed successfully
        if ($stmt->execute()) {
            echo "Order placed successfully!";
        } else {
            echo "Error: " . $stmt->error;  // Display SQL error if any
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Missing required fields!";
    }
}
?>


<!-- HTML Form for placing the order -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
</head>

<body>
    <h1>Place Your Order</h1>
    <form action="order_place.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="address">Address:</label>
        <textarea name="address" id="address" required></textarea><br>

        <label for="contact">Contact:</label>
        <input type="text" name="contact" id="contact" required><br>

        <label for="payment_method">Payment Method:</label>
        <select name="payment_method" id="payment_method" required>
            <option value="cod">Cash on Delivery</option>
            <option value="upi">UPI Payment</option>
        </select><br>

        <label for="total_amount">Total Amount:</label>
        <input type="number" step="0.01" name="total_amount" id="total_amount" required><br>

        <input type="hidden" name="product_ids" value='["1", "2", "3"]'> <!-- Example product IDs -->

        <button type="submit">Place Order</button>
    </form>
</body>

</html>