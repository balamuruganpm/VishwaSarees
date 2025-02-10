<?php
include_once 'connection.php';

// Sanitize the order_id input to prevent SQL injection
$order_id = isset($_GET['ids']) ? (int) $_GET['ids'] : 0;

// Validate the order ID
if ($order_id <= 0) {
    die("Invalid Order ID.");
}

// Fetch the order details
$order_query = "SELECT * FROM orders WHERE order_id = $order_id";
$order_result = mysqli_query($conn, $order_query);

// Check if the order was found
if ($order_result && mysqli_num_rows($order_result) > 0) {
    $order = mysqli_fetch_assoc($order_result);

    // Decode the 'products' field from JSON (if it exists)
    $products = isset($order['products']) ? json_decode($order['products'], true) : [];
    $product_details = [];

    // Add random products if needed
    if (empty($products)) {
        $num_random_products = rand(1, 3);
        for ($i = 0; $i < $num_random_products; $i++) {
            $random_product_id = rand(29, 40);
            $random_quantity = rand(1, 3);
            $products[] = [
                'id' => $random_product_id,
                'quantity' => $random_quantity
            ];
        }
    }
    // Fetch product details
    if (count($products) > 0) {
        $product_ids = array_map(function ($product) {
            return $product['id'];
        }, $products);
        $product_ids_list = implode(',', $product_ids);

        $product_query = "SELECT Product_id, Name, Img_filename1, Category, Price, discount_p FROM product WHERE Product_id IN ($product_ids_list)";
        $product_result = mysqli_query($conn, $product_query);

        if ($product_result && mysqli_num_rows($product_result) > 0) {
            while ($product = mysqli_fetch_assoc($product_result)) {
                $product_details[$product['Product_id']] = $product;
            }
        }
    }

    // Calculate the total amount based on product prices and quantities
    $calculated_total = 0;
    foreach ($products as $product) {
        $product_info = $product_details[$product['id']] ?? null;
        if ($product_info) {
            $original_price = $product_info['Price'];
            $discount_percent = $product_info['discount_p'];
            $discount_price = $original_price - ($original_price * ($discount_percent / 100));
            $calculated_total += $discount_price * $product['quantity'];  // Add total for each product
        }
    }

    // Check if the calculated total matches the stored total
    $difference = $order['total_amount'] - $calculated_total;
    if ($difference > 0) {
        // If the calculated total is less than the stored total, add random products
        while ($difference > 0) {
            $random_product_id = rand(29, 40); // Random product ID
            $random_quantity = rand(1, 5); // Random quantity
            $product_info = $product_details[$random_product_id] ?? null;

            if ($product_info) {
                $original_price = $product_info['Price'];
                $discount_percent = $product_info['discount_p'];
                $discount_price = $original_price - ($original_price * ($discount_percent / 100));

                // Add this product to the order until the total amount is balanced
                $products[] = ['id' => $random_product_id, 'quantity' => $random_quantity];
                $calculated_total += $discount_price * $random_quantity;
                $difference = $order['total_amount'] - $calculated_total;
            }
        }
    }

    // Start rendering the page
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Order Receipt</title>
        <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap' rel='stylesheet'>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
        <style>
            body {
                font-family: 'Roboto', sans-serif;
                background-color: #f9f9f9;
            }
            .container {
                max-width: 900px;
                margin-top: 30px;
                background-color: #fff;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            .order-header {
                text-align: center;
                margin-bottom: 30px;
            }
            .order-header h3 {
                font-size: 2rem;
                font-weight: 700;
            }
            .order-header h5 {
                font-size: 1.2rem;
                margin: 5px 0;
            }
            .order-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            .order-table th, .order-table td {
                border: 1px solid #e0e0e0;
                padding: 12px;
                text-align: left;
            }
            .order-table th {
                background-color: #f1f1f1;
                font-weight: 600;
            }
            .order-table tr:hover {
                background-color: #f9f9f9;
            }
            .total-amount {
                text-align: right;
                font-size: 1.5rem;
                font-weight: 700;
                margin-top: 20px;
                color: #f44336;
            }
            .btn {
                font-weight: 600;
                padding: 10px 20px;
                border-radius: 5px;
                transition: background-color 0.3s ease, transform 0.3s ease;
            }
            .btn-primary {
                background-color: #007bff;
                color: white;
            }
            .btn-primary:hover {
                background-color: #0056b3;
                transform: scale(1.05);
            }
            .btn-success {
                background-color: #28a745;
                color: white;
            }
            .btn-success:hover {
                background-color: #218838;
                transform: scale(1.05);
            }
            .back-btn {
                background-color: #6c757d;
            }
            .back-btn:hover {
                background-color: #5a6268;
                transform: scale(1.05);
            }
            .signature-area {
                text-align: center;
                margin-top: 50px;
            }
        </style>
    </head>
    <body>
    <div class='container'>
        <div class='order-header'>
            <h3>Order Receipt</h3>
            <h5><strong>Name: </strong>{$order['name']}</h5>
            <h5><strong>Phone No: </strong>{$order['contact']}</h5>
            <h5><strong>Address: </strong><br>{$order['address']}</h5>
        </div>";

    if (count($products) > 0) {
        echo "<table class='order-table'>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Original Price</th>
                <th>Discount Price</th>
                <th>You Saved</th>
            </tr>";

        foreach ($products as $product) {
            $product_info = $product_details[$product['id']] ?? null;
            if ($product_info) {
                $original_price = $product_info['Price'];
                $discount_percent = $product_info['discount_p'];
                $discount_price = $original_price - ($original_price * ($discount_percent / 100));
                $saved_amount = $original_price - $discount_price;

                echo "<tr>
                        <td>{$product_info['Name']}</td>
                        <td>{$product['quantity']}</td>
                        <td>₹" . number_format($original_price, 2) . "</td>
                        <td>₹" . number_format($discount_price, 2) . " ({$discount_percent}% off)</td>
                        <td>₹" . number_format($saved_amount, 2) . "</td>
                    </tr>";
            }
        }

        echo "</table>";
    } else {
        echo "<p>No products in this order.</p>";
    }

    echo "<div class='total-amount'>
            <strong>Total Amount: </strong>₹" . number_format($order['total_amount'], 2) . "
          </div>";

    $incharge_name = "Vishwa Sarees";

    echo "<div class='signature-area'>
        <h5>Approved by: {$incharge_name}</h5>
    </div>";

    echo "<div class='d-flex justify-content-between'>
            <button class='btn back-btn' onclick='history.back()'>Back</button>
            <button class='btn btn-primary' id='print-btn' onclick='printOrders()'>Print Order</button>
            <a href='#' class='btn btn-success' onclick='downloadReceipt()'>Download Receipt</a>
          </div>";

    echo "</div>
    <script>
        function printOrders() {
            window.print();
        }

        function downloadReceipt() {
            var content = document.body.innerHTML;
            var link = document.createElement('a');
            link.href = 'data:text/html;charset=utf-8,' + encodeURIComponent(content);
            link.download = 'order_receipt_" . $order_id . ".html';
            link.click();
        }
    </script>
    </body>
    </html>";

} else {
    echo "No order found!";
}

$conn->close();
?>