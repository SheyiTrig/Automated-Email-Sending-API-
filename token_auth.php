<?php
session_start();

// Hardcoded users (you can replace this with database validation)
$users = [
    "admin" => "password123",
    "user1" => "mypassword"
];

// Generate a token (simple example)
function generate_token($username) {
    return base64_encode($username . ':' . bin2hex(random_bytes(16)));
}

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $username = isset($data['username']) ? $data['username'] : '';
    $password = isset($data['password']) ? $data['password'] : '';

    if (isset($users[$username]) && $users[$username] === $password) {
        $token = generate_token($username);
        $_SESSION['tokens'][$token] = $username;
        echo json_encode(["message" => "Login successful", "token" => $token]);
    } else {
        http_response_code(401);
        echo json_encode(["error" => "Invalid credentials"]);
    }
}

// Function to authenticate requests using token
function authenticate_token() {
    $headers = getallheaders();
    $auth = isset($headers['Authorization']) ? $headers['Authorization'] : '';

    if (str_starts_with($auth, 'Bearer ')) {
        $token = trim(str_replace('Bearer', '', $auth));

        if (isset($_SESSION['tokens'][$token])) {
            return $_SESSION['tokens'][$token]; // Return username
        }
    }

    http_response_code(401);
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}
?>