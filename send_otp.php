<?php
require_once 'vendor/autoload.php'; // Update the path to your autoload.php
use Twilio\Rest\Client;

header('Content-Type: application/json');

$sid = "AC0dc8aa874b285cea49343a369643799e";
$token = "b37163cea35c6bcc65748e13c6a39f9c";
$twilio = new Client($sid, $token);

$data = json_decode(file_get_contents('php://input'), true);
$phone = $data['phone'];

try {
    $verification = $twilio->verify->v2->services("VA254a19ea6e7131c88116450e1a0f0560")
                                       ->verifications
                                       ->create("+91" . $phone, "sms");

    echo json_encode(['success' => true, 'message' => 'OTP sent successfully']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
