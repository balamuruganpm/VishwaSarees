<?php
include_once 'connection.php';
// Check if the category is set in the GET request
if (isset($_GET['category'])) {
    $category = $_GET['category'];

    // Write an SQL query to fetch products based on the category
    $sql = "SELECT Product_id, name, price, img_filename1 FROM product WHERE category = ?";
    
    // Prepare and execute the query
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category);  // Bind the category to the query
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Initialize an array to store the products
    $products = array();
    
    // Fetch products from the result
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    // Return the products as JSON
    echo json_encode($products);
    
    // Close the connection
    $stmt->close();
    $conn->close();
}
?>
