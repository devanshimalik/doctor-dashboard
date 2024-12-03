<?php
// create_username.php
session_start();
include('../include/connection.php');

if (!isset($_SESSION['google_email'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_SESSION['google_email'];
    
    // Check username availability
    $checkUsername = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($checkUsername);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $error = "Username already exists";
    } else {
        // Insert new user
        $insertUser = "INSERT INTO users (username, password, email, google_login) VALUES (?, ?, ?, 1)";
        $stmt = $conn->prepare($insertUser);
        $stmt->bind_param("sss", $username, $password, $email);
        
        if ($stmt->execute()) {
            $_SESSION['user_id'] = $conn->insert_id;
            unset($_SESSION['google_email']);
            header('Location: ../patient/dashboard.php');
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<body>
    <form method="post">
        <input type="text" name="username" required placeholder="Choose Username">
        <input type="password" name="password" required placeholder="Set Password">
        <button type="submit">Create Account</button>
    </form>
</body>
</html>