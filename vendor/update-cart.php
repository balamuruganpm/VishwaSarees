<?php
session_start();
include_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['user_id'];
    $inputData = json_decode(file_get_contents('php://input'), true);
    $cartData = json_encode($inputData['cart_data']);

    // Check if a cart already exists for the user
    $checkSql = "SELECT * FROM cart WHERE user_id = '$userId'";
    $result = mysqli_query($conn, $checkSql);

    if (mysqli_num_rows($result) > 0) {
        // Update existing cart data
        $updateSql = "UPDATE cart SET cart_data = '$cartData' WHERE user_id = '$userId'";
        if (mysqli_query($conn, $updateSql)) {
            // Update session cart data
            $_SESSION['cart'] = $cartData;

            // Respond with success message
            echo json_encode(["success" => true, "message" => "Cart updated successfully"]);
        } else {
            // Respond with error message
            echo json_encode(["success" => false, "message" => "Failed to update cart"]);
        }
    } else {
        // Insert new cart data
        $insertSql = "INSERT INTO cart (user_id, cart_data) VALUES ('$userId', '$cartData')";
        if (mysqli_query($conn, $insertSql)) {
            // Update session cart data
            $_SESSION['cart'] = $cartData;

            // Respond with success message
            echo json_encode(["success" => true, "message" => "Cart inserted successfully"]);
        } else {
            // Respond with error message
            echo json_encode(["success" => false, "message" => "Failed to insert cart"]);
        }
    }
} else {
    // Invalid request method
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}
?>
