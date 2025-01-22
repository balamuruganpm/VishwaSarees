<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['uid'], $data['displayName'], $data['email'], $data['photoURL'])) {
    // Here, you can save the user information to your database
    // Example: saveToDatabase($data['uid'], $data['displayName'], $data['email'], $data['photoURL']);

    echo json_encode(['success' => true, 'message' => 'User information received.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid data received.']);
}
?>
