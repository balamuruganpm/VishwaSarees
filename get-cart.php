<?php
session_start();
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "u268110092_Yuginii";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
}

// Read JSON input
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Validate received cart data
if (!isset($data['cart']) || !is_array($data['cart'])) {
    echo json_encode(['error' => 'Invalid cart data']);
    exit;
}

// Store cart in session
$_SESSION['cart'] = $data['cart'];

// Get all product IDs from the cart
$productIds = array_column($_SESSION['cart'], 'id');
if (empty($productIds)) {
    echo json_encode(['items' => [], 'total' => 0]);
    exit;
}

// Create placeholders (?,?,?) dynamically
$placeholders = implode(',', array_fill(0, count($productIds), '?'));

// Fetch product details from database
$query = "SELECT `Product_id`, `Name`, `Price`, `discount_p`, `Img_filename1` FROM `product` WHERE `Product_id` IN ($placeholders)";
$stmt = $conn->prepare($query);

// Dynamically bind parameters
$stmt->bind_param(str_repeat('i', count($productIds)), ...$productIds);
$stmt->execute();
$result = $stmt->get_result();

// Store product details in an associative array
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[$row['Product_id']] = $row;
}
$stmt->close();

// Calculate total and prepare response
$total = 0;
$cartItems = [];

foreach ($_SESSION['cart'] as $item) {
    $id = $item['id'];
    $quantity = $item['quantity'];

    if (isset($products[$id])) {
        $product = $products[$id];

        // Apply discount if available
        $price = $product['Price'];
        if ($product['discount_p'] > 0) {
            $price -= $price * ($product['discount_p'] / 100);
        }

        $subtotal = $price * $quantity;
        $total += $subtotal;

        $cartItems[] = [
            'id' => $id,
            'name' => $product['Name'],
            'price' => $price,
            'quantity' => $quantity,
            'subtotal' => $subtotal,
            'image' => 'images/product/' . $product['Img_filename1']
        ];
    }
}

// Close database connection
$conn->close();

// Return JSON response
echo json_encode([
    'items' => $cartItems,
    'total' => $total
]);
?>
