<?php
// Include the database connection file
include('connection.php');

session_start(); // Start session

// Check if the user is authenticated
if (!isset($_SESSION['login']) || $_SESSION['login'] !== "Success") {
    // Redirect to login page with an error message
    $_SESSION['error_message'] = "Please log in to access this page.";
    header("Location: login.php");
    exit();
}

// Get the order ID from the GET method
$order_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($order_id) {
    // Fetch the order details from the database
    $order_query = "SELECT name, phone_no, products , address FROM orders WHERE id = '$order_id'";
    $order_result = mysqli_query($conn, $order_query);

    if (mysqli_num_rows($order_result) > 0) {
        $order = mysqli_fetch_assoc($order_result);
        $products = json_decode($order['products'], true);
        $product_details = [];

        foreach ($products as $product) {
            $product_id = $product['id'];
            // Fetch product details including discount percentage
            $product_query = "SELECT Name, Img_filename1, Category, Price, discount_p FROM product WHERE Product_id = '$product_id'";
            $product_result = mysqli_query($conn, $product_query);

            if (mysqli_num_rows($product_result) > 0) {
                $product_info = mysqli_fetch_assoc($product_result);
                $product_info['quantity'] = $product['quantity'];
                
                // Calculate discount price and saved amount
                $original_price = $product_info['Price'];
                $discount_percentage = $product_info['discount_p'];
                $discounted_price = $original_price - ($original_price * ($discount_percentage / 100));
                $saved_amount = $original_price - $discounted_price;
                
                // Store additional details
                $product_info['discounted_price'] = $discounted_price;
                $product_info['saved_amount'] = $saved_amount;

                $product_details[] = $product_info;
            }
        }
    } else {
        echo "Order not found!";
        exit;
    }
} else {
    echo "Invalid Order ID!";
    exit;
}

// Define the URL for the QR code (your e-commerce site URL)
$ecommerce_url = "https://yuginiistores.com/"; // Change this to your actual URL
$qr_code_url = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($ecommerce_url);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="./cssadmin/single_order_view.css" rel="stylesheet">
    <style>
        @media print {
            body {
                background-color: white;
            }
            #order-header {
                text-align: center;
                margin-bottom: 20px;
            }
            #order-header img {
                width: 100px;
                height: auto;
            }
            .order-container {
                border: 1px solid #ccc;
                padding: 20px;
                margin: 0;
            }
            .order-details, .customer-details {
                border: 1px solid #000;
                padding: 10px;
                margin: 10px 0;
            }
            .table {
                border-collapse: collapse;
                width: 100%;
            }
            .table th, .table td {
                border: 1px solid #000;
                padding: 8px;
                text-align: left;
            }
            .signature-area {
                margin-top: 20px;
                text-align: center;
                border-top: 1px solid #000;
                padding-top: 10px;
                margin-bottom: 10px;
            }
            .qr-code {
                margin-top: 20px; /* Space between QR code and other elements */
            }
        }
    </style>
</head>

<body>


    <div class="container mt-5">
        <h1 class="text-center">Order Details</h1>

        <div id="order-container">
            <!-- Company Header -->
            <div id="order-header">
                <img src="../images/icons/logo.png"  alt="Company Logo" style="width: 4rem;">  <!-- Company Logo -->
                <h3>Yuginii Stores</h3>
                <p>9/55 sakthi nagar, Gurusamipalayam,Rasipuram (tk), Namakkal(dt)</p>
                <p>Call us on (+91) 8012111178</p>
            </div>

            <!-- Back Button -->
            <div class="mb-3">
                <button class="btn btn-danger" onclick="goBack()">
                    <i class="fas fa-arrow-left"></i> Back
                </button>
                <button class="btn btn-primary" onclick="printOrder()">
                    <i class="fas fa-print"></i> Print
                </button>
            </div>

            <div class="order-details">
                <!-- Display products in a table format -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Original Price</th>
                            <th>Discounted Price</th>
                            <th>You Saved</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($product_details as $product) : ?>
                            <tr>
                                <td>
                                    <img src="../images/product/<?php echo $product['Img_filename1']; ?>" alt="<?php echo $product['Name']; ?>" style="width: 50px; height: 50px;"> 
                                    <?php echo $product['Name']; ?>
                                </td>
                                <td><?php echo $product['quantity']; ?></td>
                                <td>₹<?php echo number_format($product['Price'], 2); ?></td>
                                <td>₹<?php echo number_format($product['discounted_price'], 2); ?></td>
                                <td>₹<?php echo number_format($product['saved_amount'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Display QR Code -->
                <div class="text-center mt-4 qr-code">
                    <h5>Scan for More Details:</h5>
                    <img src="<?php echo $qr_code_url; ?>" alt="QR Code" />
                </div>

                <!-- Display customer details -->
                <div class="customer-details mt-4">
                    <h5><strong>Name: </strong><?php echo $order['name']; ?></h5>
                    <h5><strong>Phone No: </strong><?php echo $order['phone_no']; ?></h5>
                    <h5><strong>Address: </strong><?php echo $order['address']; ?></h5>
                </div>
            </div>

            <!-- Signature Area -->
            <div class="signature-area">
                <h5 style="margin-top: 3rem;">Signature of Incharge: _______________________</h5>
            </div>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        function printOrder() {
            var printContents = document.getElementById('order-container').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            window.location.reload();  // Reload the page to restore the original content and scripts
        }

        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
