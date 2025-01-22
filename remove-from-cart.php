<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $product_id) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }

    // Re-index the array
    $_SESSION['cart'] = array_values($_SESSION['cart']);

    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request'));
}

