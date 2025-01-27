<?php
session_start();
include('connection.php');  // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Check if a valid login token exists
    if (isset($_COOKIE['login_token'])) {
        $token = $_COOKIE['login_token'];

        // Query to verify the token
        $query = "SELECT * FROM users WHERE login_token = '$token'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            // Set session variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['phone'] = $row['phone'];
        } else {
            // Invalid token, redirect to login
            header("Location: login.php");
            exit();
        }
    } else {
        // No session or token, redirect to login
        header("Location: login.php");
        exit();
    }
}

// Fetch user data for display
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>
</head>

<body>
    <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h1>
    <p>Your phone: <?php echo htmlspecialchars($user['phone']); ?></p>
    <a href="logout.php">Logout</a>
</body>

</html>