<?php
session_start();

// If user is not logged in, redirect to the login page
if (!isset($_SESSION['phone'])) {
    header("Location: index.php");  // Redirect to the login page
    exit();
}

// Include database connection file
include('connection.php');

// Fetch user data from the database
$phone = $_SESSION['phone'];  // Get the logged-in user's phone number
$query = "SELECT * FROM users WHERE phone = '$phone'";
$result = mysqli_query($conn, $query);

// If user exists, fetch the details
if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
} else {
    // If no user found, log out and redirect to the login page
    session_destroy();
    header("Location: index.php");
    exit();
}

// Fetch user's orders
$orders_query = "SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($orders_query);
$stmt->bind_param("i", $user['id']);
$stmt->execute();
$orders_result = $stmt->get_result();
$orders = $orders_result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Profile - Vishwa Sarees</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <style>
        .profile-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-info {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .profile-info h3,
        .profile-info p {
            font-size: 18px;
            color: #333;
        }

        .profile-info .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .btn-logout {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-logout:hover {
            background-color: #d32f2f;
        }

        .container {
            max-width: 600px;
        }
    </style>
</head>

<body class="animsition">

    <?php include_once 'header.php'; ?>
    <?php include_once 'cart.php'; ?>

    <div class="container">
        <div class="profile-header">
            <img src="images/icons/logo.jpg" alt="Profile Logo" class="profile-img">
            <h2>Welcome to Your Profile</h2>
        </div>

       <h2>Order History</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Total Amount</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td>₹<?php echo number_format($order['total_amount'], 2); ?></td>
                    <td><?php echo $order['payment_method']; ?></td>
                    <td><?php echo $order['status']; ?></td>
                    <td><?php echo $order['created_at']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <form action="logout.php" method="POST">
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>

    <!-- Footer -->
    <?php include_once 'footer.php'; ?>

    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>

    <a href="https://wa.me/+919994079949" target="_blank" rel="noopener noreferrer">
        <img src="images/whatsapp_PNG20.png" class="right-whatsapp" width="50px" alt="YUGINII">
    </a>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="js/main.js"></script>
</body>

</html>