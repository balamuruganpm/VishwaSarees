<?php
include_once 'connection.php';

$filter = $_POST['filter'] ?? '';

$sql = "SELECT id, Amount, created_at, products, Status FROM orders";
if ($filter) {
    $sql .= " WHERE Status = '$filter'";
}
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $products = json_decode($row['products'], true);
        $product_details = [];

        foreach ($products as $product) {
            $product_id = $product['id'];

            // Fetch product details including discount percentage
            $product_query = "SELECT Name, Img_filename1, Category, Price, discount_p FROM product WHERE Product_id = '$product_id'";
            $product_result = mysqli_query($conn, $product_query);

            if (mysqli_num_rows($product_result) > 0) {
                $product_info = mysqli_fetch_assoc($product_result);
                $product_info['quantity'] = $product['quantity'];
                
                // Store product details
                $product_details[] = $product_info;
            }
        }

        echo "<tr>
        <td><input type='checkbox' class='form-check-input order-checkbox' data-id='{$row['id']}'></td>
        <td>{$row['id']}</td>
        <td>{$row['created_at']}</td>
        <td>";
        
foreach ($product_details as $product_detail) {
    echo "<img src='../images/product/{$product_detail['Img_filename1']}' alt='product-1(1)' class='imgfluid avatar-sm' style='max-width: 50px;'>";
}

echo "</td>
        <td>{$row['Amount']}</td>
        <td>
            <select class='form-select status-dropdown' onchange=\"updateStatus2({$row['id']}, this.value); window.location.reload();\">
                <option value='New'" . ($row['Status'] == 'New' ? ' selected' : '') . ">New</option>
                <option value='Shipping'" . ($row['Status'] == 'Shipping' ? ' selected' : '') . ">Shipping</option>
                <option value='Delivered'" . ($row['Status'] == 'Delivered' ? ' selected' : '') . ">Delivered</option>
                <option value='Refunded'" . ($row['Status'] == 'Refunded' ? ' selected' : '') . ">Refunded</option>
            </select>
        </td>
        <td>
            <a href='single_order_view.php?id={$row['id']}'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                    <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z'/>
                    <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0'/>
                </svg>
            </a>
        </td>
    </tr>";

    }
} else {
    echo "<tr><td colspan='6'>No orders found</td></tr>";
}

$conn->close();
?>

