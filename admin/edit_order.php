<?php
// Include the database connection
include('connection.php');

// Fetch the order data from the database if an order_id is provided in the URL
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Prepare and execute the SQL query to fetch the order details
    $sql = "SELECT * FROM orders WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the order exists
    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
    } else {
        // If the order is not found, display an error message
        echo "Order not found!";
        exit();
    }
}

// Handle form submission to update the order
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and get the form data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $payment_method = $_POST['payment_method'];
    $total_amount = $_POST['total_amount'];
    $product_ids = json_encode(explode(',', $_POST['product_ids'])); // Assuming product_ids are provided as comma-separated values

    // Prepare the SQL query to update the order
    $update_query = "UPDATE orders SET name = ?, address = ?, contact = ?, payment_method = ?, total_amount = ?, product_ids = ? WHERE order_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("sssdssi", $name, $address, $contact, $payment_method, $total_amount, $product_ids, $order_id);

    // Execute the update query
    if ($stmt->execute()) {
        // If the update is successful, redirect back to the dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        // If there is an error, display the error message
        echo "Error updating order: " . $conn->error;
    }
}

// Close the prepared statement and connection
$stmt->close();
$conn->close();
?>

<!-- HTML Form for Editing Order -->
<form method="POST" action="">
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($order['name']); ?>" required>

    <label for="address">Address:</label>
    <input type="text" name="address" value="<?php echo htmlspecialchars($order['address']); ?>" required>

    <label for="contact">Contact:</label>
    <input type="text" name="contact" value="<?php echo htmlspecialchars($order['contact']); ?>" required>

    <label for="payment_method">Payment Method:</label>
    <select name="payment_method" required>
        <option value="cod" <?php if ($order['payment_method'] === 'cod')
            echo 'selected'; ?>>Cash on Delivery</option>
        <option value="upi" <?php if ($order['payment_method'] === 'upi')
            echo 'selected'; ?>>UPI</option>
    </select>

    <label for="total_amount">Total Amount:</label>
    <input type="number" name="total_amount" value="<?php echo htmlspecialchars($order['total_amount']); ?>" required>

    <!-- Submit Button -->
    <button type="submit">Update Order</button>
</form>
<style>
    form {
        margin: 20px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        width: 300px;
    }
    label {
        display: block;
        margin: 10px 0 5px;
    }
    input, select, button {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
    }
    button {
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }
    button:hover {
        background-color: #45a049;
    }
</style>
