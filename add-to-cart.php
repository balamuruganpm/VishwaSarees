<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Fetch product details
    $query = "SELECT * FROM product WHERE Product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($product = $result->fetch_assoc()) {
        // Initialize the cart if it doesn't exist
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Check if the product is already in the cart
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $product_id) {
                $item['quantity']++;
                $found = true;
                break;
            }
        }

        // If the product is not in the cart, add it
        if (!$found) {
            $_SESSION['cart'][] = array(
                'id' => $product_id,
                'name' => $product['Name'],
                'price' => $product['Price'],
                'quantity' => 1
            );
        }

        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Product not found'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request'));
}

