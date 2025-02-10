<?php
// Include the database connection
include('connection.php');

// Check if a delete request is made
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_order'])) {
    $order_id_to_delete = $_POST['order_id_to_delete'];

    // Use prepared statement to prevent SQL injection
    $delete_query = "DELETE FROM orders WHERE order_id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $order_id_to_delete); // "i" means integer type
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Order ID: $order_id_to_delete has been deleted successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error deleting order: " . $conn->error . "</div>";
    }

    // Close the prepared statement
    $stmt->close();
}

// Fetch all orders from the `orders` table
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

// Start HTML table with Bootstrap styling
echo "<table class='table table-bordered table-striped' style='padding: 20px;'>
    <thead class='thead-dark'>
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Payment Method</th>
            <th>Total Amount</th>
            <th>Products</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Action</th>
            <th>Download Receipt</th> <!-- New Column -->
        </tr>
    </thead>
    <tbody>";

// Check if there are any results
if ($result->num_rows > 0) {
    // Loop through each row and display in the table
    while ($row = $result->fetch_assoc()) {
        // Decode product IDs from JSON and ensure it's an array before looping
        $product_ids = json_decode($row['product_ids'], true);
        if (!is_array($product_ids)) {
            $product_ids = [];  // Default to an empty array if it's not a valid JSON
        }

        $product_links = "";
        foreach ($product_ids as $product_id) {
            $product_links .= "<a href='http://localhost/VishwaSarees/single_product_view.php?product_id=$product_id' class='text-info'>Product $product_id</a>, ";
        }
        $product_links = rtrim($product_links, ', '); // Remove trailing comma

        // Convert payment_method to 'cod' or 'upi'
        $payment_method = ($row['payment_method'] === 'cod') ? 'cod' : 'upi'; // 'cod' for 0, 'upi' for 1

        // Set Payment Status
        $payment_status = "Payment Successfully"; // Default to 'Successfully'
        if ($payment_method === 'cod') {
            // For COD, assume "Pending Payment"
            $payment_status = 'Payment Successful (COD)';
        } elseif ($payment_method === 'upi') {
            // For UPI, we assume it's "Payment Successful" if the order is completed
            // You can add a logic for checking payment success or failure if needed
            if ($row['status'] === 'completed') {
                $payment_status = 'Payment Successful (UPI)';
            } else {
                $payment_status = 'Payment Successful (UPI)';
            }
        }

        echo "<tr>
            <td>{$row['order_id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['contact']}</td>
            <td>{$row['address']}</td>
            <td>{$payment_method}</td>  <!-- Show 'cod' or 'upi' for payment method -->
            <td>₹{$row['total_amount']}</td>
            <td>$product_links</td>
            <td>{$payment_status}</td>  <!-- Show custom payment status -->
            <td>{$row['created_at']}</td>
            <td>
                <!-- Edit Button -->
                <a href='edit_order.php?order_id={$row['order_id']}' class='btn btn-warning btn-sm'>Edit</a>

                <!-- Delete Button -->
                <form method='POST' style='display: inline;'>
                    <input type='hidden' name='order_id_to_delete' value='{$row['order_id']}'>
                    <input type='hidden' name='delete_order' value='1'>
                    <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this order?\")'>
                        Delete
                    </button>
                </form>
            </td>
            <td>
                <!-- Link to download receipt -->
                <a href='print_orders.php?ids={$row['order_id']}' class='btn btn-primary btn-sm'>Download Receipt</a>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='10' class='text-center'>No orders found</td></tr>";
}

// Close the table
echo "</tbody></table>";

// Close the database connection
$conn->close();
?>