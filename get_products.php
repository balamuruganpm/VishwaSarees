<?php 
include_once 'connection.php';

$searchQuery = isset($_POST['search']) ? $_POST['search'] : '';

if ($searchQuery) {
    $sql = "SELECT * FROM product WHERE Name LIKE '%$searchQuery%' OR Category LIKE '%$searchQuery%'";
} else {
    $sql = "SELECT * FROM product";
}

$result = mysqli_query($conn, $sql);

$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

echo json_encode($products);
?>
