<?php
function add_to_cart($product_id, $quantity = 1)
{
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }
}

function get_cart_total()
{
    global $pdo;
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $stmt = $pdo->prepare("SELECT price FROM products WHERE id = ?");
            $stmt->execute([$product_id]);
            $product = $stmt->fetch();
            $total += $product['price'] * $quantity;
        }
    }
    return $total;
}

function generate_upi_qr($amount)
{
    // In a real-world scenario, you would integrate with a UPI provider
    // For this example, we'll just return a placeholder string
    return "upi://pay?pa=merchant@upi&pn=Merchant%20Name&am=$amount&cu=INR";
}
?>