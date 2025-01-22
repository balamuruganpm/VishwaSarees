<?php
include_once 'connection.php';
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $sql = "SELECT * FROM product WHERE Product_id = $product_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $product = mysqli_fetch_assoc($result);
        // Return the product details as a JSON response
        echo json_encode($product);
    } else {
        echo json_encode(['error' => 'Failed to fetch product details']);
    }
}
?>
