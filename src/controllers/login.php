<?php
require 'vendor/autoload.php';
use \Firebase\JWT\JWT;
require 'db_connection.php';

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

$username = $data['username'];
$email = $data['email'];
$password = $data['password'];

// Changes: Added query that uses both username and email to find user
$query = $conn->prepare("SELECT * FROM users WHERE (username = ? OR email = ?)");
$query->bind_param('ss', $username, $email);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid username or email']);
    exit();
}

$user = $result->fetch_assoc();

if (password_verify($password, $user['password'])) {
    $key = "abcd123";
    $payload = [
        'iss' => 'localhost',
        'aud' => 'localhost',
        'iat' => time(),
        'exp' => time() + (60 * 60),
        'sub' => $user['id'],
        'role' => $user['role'] // Include the role in the JWT payload
    ];

    $jwt = JWT::encode($payload, $key, 'HS256');
    echo json_encode(['success' => true, 'token' => $jwt, 'role' => $user['role']]); 
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
}
?>
