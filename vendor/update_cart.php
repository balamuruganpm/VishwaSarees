<?php
session_start();
if(isset($_POST['cart'])) {
    $cart = json_decode($_POST['cart'], true);
    $phone = $_SESSION['phone'];
    // Assume you have a database connection file included
    include_once 'connection.php';

    // Update cart items in the database
    foreach($cart as $item) {
        $productId = $item['id'];
        $quantity = $item['quantity'];
        $query = "UPDATE cart SET quantity = ? WHERE phone = ? AND product_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isi", $quantity, $phone, $productId);
        $stmt->execute();
    }
    echo "Cart updated successfully";
} else {
    echo "No cart data received";
}
?>
