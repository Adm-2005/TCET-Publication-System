<?php
require 'vendor/autoload.php';
use \Firebase\JWT\JWT;
require 'db_connection.php';

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

$firstName = $data['firstName'];
$lastName = $data['lastName'];
$email = $data['email'];
$branch = $data['branch'];
$username = $data['username'];
$password = $data['password'];
$confirmPassword = $data['confirmPassword'];

//Changes: Added checks for duplicated email and password integrity

// Check if password and confirmPassword are the same
if ($password !== $confirmPassword) {
    echo json_encode(['success' => false, 'message' => 'Passwords do not match']);
    exit();
}

// Check for duplicate usernames
$query = $conn->prepare("SELECT * FROM users WHERE username = ?");
$query->bind_param('s', $username);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Username already exists']);
    exit();
}

// Check for duplicate emails
$query = $conn->prepare("SELECT * FROM users WHERE email = ?");
$query->bind_param('s', $email);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Email already exists']);
    exit();
}

// Hash the password 
// Note: We'll need a better hashing function during production
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

$query = $conn->prepare("INSERT INTO users (first_name, last_name, email, branch, username, password) VALUES (?, ?, ?, ?, ?, ?)");
$query->bind_param('ssssss', $firstName, $lastName, $email, $branch, $username, $hashedPassword);

if ($query->execute()) {
    echo json_encode(['success' => true, 'message' => 'Signup successful']);
} else {
    echo json_encode(['success' => false, 'message' => 'Signup failed']);
}

$query->close();
$conn->close();
?>