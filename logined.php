<?php
session_start();
include('connection.php');  // Include your database connection

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Query to check if user exists with this phone and password
    $query = "SELECT * FROM users WHERE phone = '$phone' AND password = '$password'";
    $result = mysqli_query($conn, $query);

   if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result); // Fetch user data
    $_SESSION['user_id'] = $row['id']; // Assuming 'id' is the primary key
    $_SESSION['phone'] = $phone;       // Store phone for reference
    header("Location: profile.php");
    exit();
}
}
?>