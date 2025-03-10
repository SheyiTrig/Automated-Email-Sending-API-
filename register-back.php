<?php



$localhost="localhost";
$db_user="root";
$db_password="";
$db_name="cdlp-db";
$conn = mysqli_connect($localhost, $db_user, $db_password, $db_name);

if(isset($_POST['register'])){
    register();
}

if(isset($_POST['login'])){
    LogIn();
}

if (isset($_POST['Logout'])){
    Logout();
}
if(isset($_POST['sendmail'])){
    SendMail();
}




function register(){
  global $conn;
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $cpass = $_POST["cpassword"];
        $phone = $_POST["phone"];
        if(!$conn){
            die('could not connect'.mysqli_errno());
        }
            $sql = "INSERT INTO cdlp_register(username, email, password, cpass, phone) VALUES('$username', '$email', '$password', '$cpass', '$phone')";
            $query = mysqli_query($conn, $sql);
            if($query){
                echo "data sent succesfully";
                header("location:index.php");
    
               
            }
    
    }

}


function LogIn()
{
    global $conn;

    header('Content-Type: application/json');
    session_start();

    if (isset($_POST['email']) && isset($_POST['password'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        if (!$conn) {
            echo json_encode(["status" => "error", "message" => "Database connection failed"]);
            exit;
        }

        $data = json_decode(file_get_contents("php://input"), true);
        $email = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(["status" => "error", "message" => "Invalid email format"]);
            exit;
        }
        if (!empty($password)) {
            echo json_encode(["status" => "error", "message" => "Password is required"]);
            exit;
        }
        $sql = "SELECT * FROM cdlp_register WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['password'] === $password) {
                // session established
                $_SESSION['email'] = $row['email'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['id'] = $row['id'];

                $api_token = bin2hex(random_bytes(32));
                $update = "UPDATE cdlp_register SET api_token = '$api_token' WHERE id = {$row['id']}";
                mysqli_query($conn, $update);
                echo json_encode([
                    "status" => "success",
                    "message" => "Login successful",
                    "api_token" => $api_token
                ]);
                header("Location: home.php");
                exit();
            } else {
                echo json_encode(["status" => "error", "message" => "Incorrect password"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "User not found"]);
        }

    }
}


function Logout(){
   
    session_start();
    session_unset();  // Remove session variables
    session_destroy(); // Destroy the session
    header("Location: index.php"); // Redirect to login page
    exit;
  
}


function SendMail(){
    global $conn;
    header('Content-Type: application/json');

    if (!$conn) {
        echo json_encode(["status" => "error", "message" => "Database connection failed"]);
        exit;
    }
    
    $headers = getallheaders();
    $authHeader = $headers['Authorization'] ?? '';
    
    if (!preg_match('/Bearer\s(.*)/', $authHeader, $matches)) {
        echo json_encode(["status" => "error", "message" => "Authorization token not provided"]);
        exit;
    }
    
    $token = $matches[1];
    $userQuery = "SELECT * FROM cdlp_register WHERE api_token = '$token' LIMIT 1";
    $userResult = mysqli_query($conn, $userQuery);
    
    if (!$userResult || mysqli_num_rows($userResult) !== 1) {
        echo json_encode(["status" => "error", "message" => "Invalid or expired token"]);
        exit;
    }
    
    $user = mysqli_fetch_assoc($userResult);
    $user_id = $user['id'];


    
    $data = json_decode(file_get_contents("php://input"), true);
    $recipient_email = trim($data['recipient_email'] ?? '');
    $subject = trim($data['subject'] ?? '');
    $message = trim($data['message'] ?? '');
    // $user_id = $_POST['user_id'];
    // $recipient_email = $_POST['recipient'];
    // $subject = $_POST['subject'];
    // $message = $_POST['message'];
    
    if (!filter_var($recipient_email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Invalid recipient email format"]);
        exit;
    }
    if (empty($subject) || empty($message)) {
        echo json_encode(["status" => "error", "message" => "Subject and message cannot be empty"]);
        exit;
    }
    
    $headers = "From: noreply@yourdomain.com";
    $mail_sent =  mail($recipient_email, $subject, $message, $headers);
    
    $status = $mail_sent ? 'sent' : 'failed';
    $created_at = date("Y-m-d H:i:s");
    $updated_at = $created_at;
    
    $insert = "INSERT INTO emails (user_id, recipient_email, subject, message, status, created_at, updated_at)
               VALUES ('$user_id', '$recipient_email', '$subject', '$message', '$status', '$created_at', '$updated_at')";


      $result = mysqli_query($conn, $insert);
    
    if ($result ) {
        echo 'mail sent succefully';
        echo json_encode(["status" => "success", "message" => "Email processed", "delivery_status" => $status]);

    } else {
        echo json_encode(["status" => "error", "message" => "Failed to store email record"]);
    }
  
  }














?>