<?php
include_once 'connection.php';
session_start(); // Start session

// Check if the user is authenticated
if (!isset($_SESSION['login']) || $_SESSION['login'] !== "Success") {
    // Redirect to login page with an error message
    $_SESSION['error_message'] = "Please log in to access this page.";
    header("Location: login.php");
    exit();
}

// Get the order IDs from the GET method (passed as a comma-separated string)
$order_ids = isset($_GET['ids']) ? $_GET['ids'] : '';

if (!$order_ids) {
    echo "No orders selected!";
    exit();
}

// Convert the order IDs to an array
$order_ids_array = explode(',', $order_ids);

// Prepare the SQL query to fetch the order details
$order_ids_list = implode(',', array_map('intval', $order_ids_array)); // Sanitize the IDs
$order_query = "SELECT name, phone_no, id, products, address, Amount FROM orders WHERE id IN ($order_ids_list)";
$order_result = mysqli_query($conn, $order_query);

if (mysqli_num_rows($order_result) > 0) {
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Print Orders</title>
        <!-- Bootstrap CSS -->
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
        <!-- Font Awesome for Icons -->
        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css' rel='stylesheet'>
        <!-- Custom CSS -->
        <style>
            body {
                background-color: #f8f9fa;
                font-family: 'Montserrat', sans-serif;
                margin: 0; /* Remove body margin */
                padding: 0; /* Remove body padding */
            }
            .container {
                width: 100%; /* Full width of the page */
                padding: 0; /* Remove padding to eliminate side gaps */
                margin-top: 30px; /* Increased top margin for better aesthetics */
            }
            .company-logo {
                text-align: center;
                margin-bottom: 20px;
            }
            .order-container {
                background-color: #ffffff;
                padding: 20px; /* Padding inside the order container */
                width: 100%; /* Full width */
                box-sizing: border-box; /* Ensure padding does not affect width */
            }
            .order-table {
                width: 100%; /* Full width */
                border-collapse: collapse; /* Remove inner borders */
                margin-top: 20px;
                border: 1px solid #000; /* Add border to the table */
            }
            .order-table th, .order-table td {
                border: 1px solid #000; /* Add borders to table cells */
                text-align: left;
                padding: 8px;
            }
            .order-table th {
                background-color: #f2f2f2;
            }
            .total-amount {
                text-align: right; /* Align total amount to the right */
                font-size: 18px;
                font-weight: bold;
                margin-top: 10px;
            }
            .print-btn {
                position: fixed;
                bottom: 20px;
                right: 20px;
                background-color: #007bff;
                color: white;
                border-radius: 50%;
                width: 50px;
                height: 50px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
                transition: background-color 0.3s ease;
                z-index: 1000;
            }
            .print-btn:hover {
                background-color: #0056b3;
                cursor: pointer;
            }
            @media print {
                body {
                    margin: 0; /* Remove body margin for full page use */
                    padding: 0; /* Remove padding to use full height */
                    width: 100%; /* Full width for print */
                    height: 100%; /* Full height for print */
                }
                .container {
                    width: 100%; /* Ensure full width for the container */
                    height: 100%; /* Ensure full height for the container */
                    padding: 0; /* Remove padding */
                    box-sizing: border-box; /* Include padding and border in the element's total width and height */
                }
                .print-btn { display: none; } /* Hide print button when printing */
                .back-btn { display: none; } /* Hide back button when printing */
                @page { 
                    margin: 0; /* Remove page margin for A4 print */
                }
            }
        </style>
    </head>
    <body>
    <div class='container'>

        <div class='company-logo'>
               <img src='../images/icons/logo.png'  alt='Company Logo' style='width:  4rem;'>
            <h2> Yuginii Stores </h2>
             <p>9/55 sakthi nagar, Gurusamipalayam,Rasipuram (tk), Namakkal(dt)</p>
                <p>Call us on (+91) 8012111178</p>
        </div>

        <h1 class='text-center print-header'></h1>";

    while ($order = mysqli_fetch_assoc($order_result)) {
        $products = json_decode($order['products'], true);
        $product_details = [];

        foreach ($products as $product) {
            $product_id = $product['id'];
            $product_query = "SELECT Name, Img_filename1, Category, Price, discount_p FROM product WHERE Product_id = '$product_id'";
            $product_result = mysqli_query($conn, $product_query);

            if (mysqli_num_rows($product_result) > 0) {
                $product_info = mysqli_fetch_assoc($product_result);
                $product_info['quantity'] = $product['quantity'];
                $product_details[] = $product_info;
            }
        }

        echo "<div class='order-container mt-5'>";
        // Display customer information
        echo "<h5><strong>Name: </strong>{$order['name']}</h5>
              <h5><strong>Phone No: </strong>{$order['phone_no']}</h5>
              <h5><strong>Address: </strong><br>{$order['address']}</h5>"; // Address included here

        // Table for product details
        echo "<table class='order-table'>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Original Price</th>
                    <th>Discount Price</th>
                    <th>You Saved</th>
                </tr>";

        foreach ($product_details as $product) {
            // Calculate the discount price
            $discount_percent = $product['discount_p'];
            $original_price = $product['Price'];
            $discount_price = $original_price - ($original_price * ($discount_percent / 100));
            $saved_amount = $original_price - $discount_price;

            echo "<tr>
                    <td>{$product['Name']}</td>
                    <td>{$product['quantity']}</td>
                    <td>₹" . number_format($original_price, 2) . "</td>
                    <td>₹" . number_format($discount_price, 2) . " ({$discount_percent}% off)</td>
                    <td>₹" . number_format($saved_amount, 2) . "</td>
                  </tr>";
        }

        echo "</table>";

        // Total amount aligned to the right
        echo "<div class='total-amount'>
                <strong>Total Amount: </strong>
                <span style='color:Red;font-weight:bold'>₹" . number_format($order['Amount'], 2) . "</span>
              </div>
        
        <!-- Signature Area -->
        <div class='signature-area'>
            <h5 style='margin-top: 3rem;'>Signature of Incharge: _______________________</h5>
        </div>
        </div>"; // Closing order-container
    }
echo "<div class='d-flex'>";
    // Back button to navigate to the previous page
    echo "<button class='btn btn-secondary mt-4 back-btn' onclick='history.back()'>Back</button>";

    // Print button
    echo "<button class='btn btn-primary mt-4 mx-3' id='print-btn' onclick='printOrders()'>Print All Orders</button>";
  echo "</div>";
    echo "</div>
<script>
    function printOrders() {
        var printButton = document.getElementById('print-btn');
        printButton.style.display = 'none';  // Hide the print button
        window.print();
        setTimeout(function() {
            printButton.style.display = 'block';  // Show the print button again after printing
        }, 1000);
    }
</script>

    </body>
    </html>";
} else {
    echo "No orders found!";
}

$conn->close();
?>
