<?php
// google_callback.php
session_start();
include('config.php');
include('../include/connection.php');

if (isset($_GET['code'])) {
    $token = $googleClient->fetchAccessTokenWithAuthCode($_GET['code']);
    
    if (!isset($token['error'])) {
        $googleClient->setAccessToken($token['access_token']);
        $googleOauth = new Google_Service_Oauth2($googleClient);
        $userData = $googleOauth->userinfo->get();
        
        $email = $userData->email;
        $name = $userData->name;
        
        // Check if user exists
        $checkUser = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($checkUser);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 0) {
            // Redirect to username/password creation
            $_SESSION['google_email'] = $email;
            $_SESSION['google_name'] = $name;
            header('Location: create_username.php');
            exit();
        } else {
            // User already exists, log them in
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['id'];
            header('Location: ../patient/dashboard.php');
            exit();
        }
    }
}
?>