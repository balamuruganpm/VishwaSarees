<?php
require_once 'connection.php'; // Include your database connection

$data = json_decode(file_get_contents('php://input'), true);
$name = trim($data['name'] ?? '');
$phone = trim($data['phone'] ?? '');
$password = trim($data['password'] ?? '');

// Input Validation
if (empty($name) || empty($phone) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
    echo json_encode(['success' => false, 'message' => 'Invalid name format.']);
    exit;
}

if (!preg_match('/^\d{10}$/', $phone)) {
    echo json_encode(['success' => false, 'message' => 'Phone number must be 10 digits.']);
    exit;
}

if (strlen($password) < 8) {
    echo json_encode(['success' => false, 'message' => 'Password must be at least 8 characters long.']);
    exit;
}

// Store registration data
try {
    $stmt = $pdo->prepare("INSERT INTO users (name, phone, password, status) VALUES (:name, :phone, :password, 'Approved')");
    $stmt->execute([
        'name' => $name,
        'phone' => $phone,
        'password' => password_hash($password, PASSWORD_DEFAULT) // Hash the password
    ]);

    echo json_encode(['success' => true, 'message' => 'Registration successful!']);
} catch (PDOException $e) {
    // Generic error message to avoid exposing sensitive information
    echo json_encode(['success' => false, 'message' => 'Registration failed. Please try again.']);
}
?>
