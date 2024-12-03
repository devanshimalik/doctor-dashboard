<?php
include("include/connection.php");
if(isset($_POST['register'])){
	$full_name=$_POST['full_name'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$gender=$_POST['gender'];
	$username=$_POST['username'];
	$password=$_POST['password'];

	$errors=array();
	if(empty($full_name)){
		$errors['register']='Enter you full name';
	}
	else if(empty($phone)){
		$errors['register']='Enter you phone number';
	}
	else if(empty($email)){
		$errors['register']='Enter you email';
	}
	else if(empty($gender)){
		$errors['register']='Enter you gender';
	}
	else if(empty($username)){
		$errors['register']='Enter you username';
	}
	else if(empty($password)){
		$errors['register']='Enter you password';
	}
	if(count($errors)==0){
		$hashed_password=password_hash($password, PASSWORD_DEFAULT);
		$query="INSERT INTO `users` (`full_name`, `phone`, `email`, `gender`, `username`, `password`)
		VALUES (?,?,?,''?,?)";
		$stm=mysqli_prepare($connect, $query);
		mysqli_stm_bind_param($stm, "ssssss", $full_name, $phone, $email, $gender, $username, $password);
		$result=mysqli_stm_execute($stm);
		if($result){
			echo"<script> alert('Patient Registered Successfully');
			window.location.href='login.php';
			</script>";
			exit;
		}
		else{
			echo "<script> alert('failed to register')</script>";
		}
	}
}

if(isset($errors['register'])){
	$error_message=$errors['register'];
	$show_error="<h5 class='text-center alert alert-danger'>$error_message</h5>";
}
else{
	$show_error="";
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<title>Admin Registration form</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<div class="form-container">
			<form action="" method="post">
				<h4 style="text-align: center;"></h4>
				<div class="form-row">
					<div class="form-group">
						<input type="text" name="full_name" class="form-control" placeholder="Enter your full name" required>
					</div>
					<div class="form-group">
						<input type="text" name="phone" class="form-control" placeholder="Enter your phone number" required>
					</div>
					<div class="form-group">
						<input type="email" name="email" class="form-control" placeholder="Enter your email" required>
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<input type="text" name="username" class="form-control" placeholder="Enter your username" required>
					</div>
					<div class="form-group">
						<select name="gender" class="form-control" required>
							<option value="male">Male</option>
							<option value="female">Female</option>
							<option value="others">Others</option>
						</select>
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Enter your password" required>
					</div>
					<div class="form-group">
						<button type="submit" name="register" class="btn btn-primary">Register</button>
					</div>
				</div>
			</form>
		</div>
	</div>

</body>
</html>