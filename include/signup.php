<?php
include("../include/connection.php");

if (isset($_POST['register'])) {
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $errors = array();
    if (empty($full_name)) {
        $errors['register'] = 'Enter your full name';
    } else if (empty($phone)) {
        $errors['register'] = 'Enter your phone number';
    } else if (empty($email)) {
        $errors['register'] = 'Enter your email';
    } else if (empty($gender)) {
        $errors['register'] = 'Enter your gender';
    } else if (empty($username)) {
        $errors['register'] = 'Enter your username';
    } else if (empty($password)) {
        $errors['register'] = 'Enter your password';
    }

    if (count($errors) == 0) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO `admin` (`full_name`, `phone`, `email`, `gender`, `username`, `password`, `status`)
                  VALUES (?, ?, ?, ?, ?, ?, 'active')";
        $stmt = mysqli_prepare($connect, $query);
        mysqli_stmt_bind_param($stmt, "ssssss", $full_name, $phone, $email, $gender, $username, $hashed_password);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "<script>alert('Admin Registered Successfully'); window.location.href='login.php';</script>";
            exit;
        } else {
            echo "<script>alert('Failed to register');</script>";
        }
    }
}

if (isset($errors['register'])) {
    $error_message = $errors['register'];
    $show_error = "<h5 class='text-center alert alert-danger'>$error_message</h5>";
} else {
    $show_error = "";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Admin Registration Form</title>
    <style>
        .container {
            max-width: 500px;
            margin-top: 50px;
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <h4 class="text-center">Admin Registration Form</h4>
        <?php echo $show_error; ?>
        <form action="signup.php" method="post">
            <div class="form-group">
                <input type="text" name="full_name" class="form-control" placeholder="Full Name" required>
            </div>
            <div class="form-group">
                <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="form-group">
                <select name="gender" class="form-control" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="others">Others</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group text-center">
                <button type="submit" name="register" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>
</body>
</html>
