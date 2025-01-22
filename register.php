<?php
include('connection.php');  // Include your database connection

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Check if user already exists
    $query = "SELECT * FROM users WHERE phone = '$phone'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // User already exists
        echo "<script>alert('User already exists'); window.location.href='login.php';</script>";
        exit();
    }

    // Insert new user into the database
    $query = "INSERT INTO users (name, phone, password) VALUES ('$name', '$phone', '$password')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Registration successful'); window.location.href='login.php';</script>";
        exit();
    } else {
        echo "<script>alert('Registration failed'); window.location.href='login.php';</script>";
        exit();
    }
}
?>