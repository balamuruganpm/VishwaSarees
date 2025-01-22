
<?php
// Database connection
$servername = "localhost";
$username = "u268110092_yugapriya";
$password = "Srini@001";
$dbname = "u268110092_Yuginii";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>