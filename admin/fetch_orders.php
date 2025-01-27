<?php
// Include the database connection
include('connection.php');

// Check if a delete request is made
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_order'])) {
    $order_id_to_delete = $_POST['order_id_to_delete'];

    // Delete the order from the database
    $delete_query = "DELETE FROM orders WHERE id = $order_id_to_delete";
    if ($conn->query($delete_query) === TRUE) {
        echo "<div class='alert alert-success'>Order ID: $order_id_to_delete has been deleted successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error deleting order: " . $conn->error . "</div>";
    }
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
            <th>Action</th>
        </tr>
    </thead>
    <tbody>";

// Check if there are any results
if ($result->num_rows > 0) {
    // Loop through each row and display in the table
    while ($row = $result->fetch_assoc()) {
        // Decode product IDs from JSON and prepare clickable links
        $product_ids = json_decode($row['product_ids'], true);
        $product_links = "";
        foreach ($product_ids as $product_id) {
            $product_links .= "<a href='http://localhost/VishwaSarees/single_product_view.php?product_id=$product_id' class='text-info'>Product $product_id</a>, ";
        }
        $product_links = rtrim($product_links, ', '); // Remove trailing comma

        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['contact']}</td>
            <td>{$row['address']}</td>
            <td>{$row['payment_method']}</td>
            <td>₹{$row['total_amount']}</td>
            <td>$product_links</td>
            <td>
                <form method='POST' style='display: inline;'>
                    <input type='hidden' name='order_id_to_delete' value='{$row['id']}'>
                    <input type='hidden' name='delete_order' value='1'>
                    <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this order?\")'>
                        Delete
                    </button>
                </form>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='8' class='text-center'>No orders found</td></tr>";
}

// Close the table
echo "</tbody></table>";

// Close the database connection
$conn->close();
?>