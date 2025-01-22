<?php
include_once'connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$status = $_POST['status'];

$sql = "UPDATE orders SET Status='$status' WHERE id=$id";
$conn->query($sql);

$conn->close();
?>
