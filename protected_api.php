<?php
// Include the authentication file
include_once 'token_auth.php';

// Authenticate the request
$username = authenticate_token();

// Proceed only if authenticated
echo json_encode([
    "message" => "Welcome, $username! You have accessed a protected route.",
    "status" => "success"
]);
?>