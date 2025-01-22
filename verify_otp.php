<?php
require_once 'vendor/autoload.php'; // Update the path to your autoload.php
use Twilio\Rest\Client;

header('Content-Type: application/json');

$sid = "AC0dc8aa874b285cea49343a369643799e";
$token = "b37163cea35c6bcc65748e13c6a39f9c";
$twilio = new Client($sid, $token);

$data = json_decode(file_get_contents('php://input'), true);
$phone = $data['phone'];
$otp = $data['otp'];
$name = $data['name'];
$password = $data['password'];

try {
    $verification_check = $twilio->verify->v2->services("VA254a19ea6e7131c88116450e1a0f0560")
                                             ->verificationChecks
                                             ->create(["to" => "+91" . $phone, "code" => $otp]);

    if ($verification_check->status == "approved") {
        // Save the user to the database
        // Assuming you have a database connection file called db.php
        require 'db.php'; // Update the path to your db.php

        $stmt = $pdo->prepare("INSERT INTO users (name, phone, password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $phone, password_hash($password, PASSWORD_BCRYPT)]);

        echo json_encode(['success' => true, 'message' => 'OTP verified and user registered successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid OTP']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
