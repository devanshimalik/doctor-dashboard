<?php
session_start();
$host="localhost";
$username="root";
$password="";
$dbname="hms";
$port=3307;

$connect=new mysqli($host, $username, $password, $dbname, $port);

if($_SERVER['REQUEST_METHOD']=="POST"){
	$role=$_POST['role'];
	$username=$_POST['username'];
	$password=$_POST['password'];

	switch($role){
		case 'admin':
		$query=$connect->prepare("SELECT * FROM admin WHERE username=? AND password=?");
		$query->bind_param("ss", $username, $password);
		$query->execute();
		$result=$query->get_result();
		if($result->num_rows==1){
			$_SESSION['admin']=$username;
			header("location:../admin/dashboard.php");
			exit();
		}
		else{
			$errors="Invalid Admin Login Details";
			echo '<div class="alert alert-danger" style="text-align:center;">' . $errors . '</div>';
		}
		break;

		case 'doctor':
		$query=$connect->prepare("SELECT * FROM doctors WHERE username=? AND password=?");
		$query->bind_param("ss", $username, $password);
		$query->execute();
		$result=$query->get_result();
		$row=$result->fetch_assoc();


		if($row['status']=='pending'){
			$error="please wait for admin approval";
		}
		else if($row['status']=="Rejected"){
			$error="please try again later";
		}
		else if($result->num_rows==1){
			$_SESSION['doctor']=$username;
			header("location:../doctor/dashboard.php");
			exit();
		}
		else{
			$error="Wait for admin approval";
		}
		break;

		case 'patient':
		$query=$connect->prepare("SELECT * FROM patient WHERE username=? AND password=?");
		$query->bind_param("ss", $username, $password);
		$query->execute();
		$result=$query->get_result();
		if($result->num_rows==1){
			$_SESSION['patient']=$username;
			header("location:../patient/dashboard.php");
			exit();
		}
		else{
			$errors="Invalid Admin Login Details";
			echo '<div class="alert alert-danger" style="text-align:center;">' . $error . '</div>';
		}
		break;
		default:
		$error="Invalid Role Selected";
		echo '<div class="alert alert-danger" style="text-align:center;">' . $error .'</div>';
		break;

	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Login form</title>
	<style>
		.hidden-content{
			display: none;
		}
	</style>
</head>
<body>

<div class="container" id="container">
		<div class="form-container sign-in">
			<form id="loginForm" method="post">
				<h4>Sign In</h4>
				<select id="role" name="role">
					<option value="admin">Admin</option>
					<option value="doctor">Doctor</option>
					<option value="patient">Patient</option>
				</select>
				<input type="text" name="username" id="username" placeholder="Enter your username" required>
				<input type="password" name="password" placeholder="Enter your password" required>
				<button type="submit" class="btn btn-primary">Sign In</button>
			</form>
		</div>
		<div class="toggle-container">
			<select id="role" name="role">
					<option value="patient">Patient</option>
				</select>
			<h4>Don't have an account?</h4>
			<button class="btn btn-link" data-toggle="modal" data-target="#signupModal">Sign Up</button>
		</div>
	</div>

	<!-- Sign Up Modal -->
	<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="signupModalLabel">Patient Registration Form</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!-- Sign Up Form -->
					<form action="register.php" method="post">
						<div class="form-group">
							<input type="text" name="full_name" class="form-control" placeholder="Enter your full name" required>
						</div>
						<div class="form-group">
							<input type="text" name="phone" class="form-control" placeholder="Enter your phone number" required>
						</div>
						<div class="form-group">
							<input type="email" name="email" class="form-control" placeholder="Enter your email" required>
						</div>
						<div class="form-group">
							<select name="gender" class="form-control" required>
								<option value="male">Male</option>
								<option value="female">Female</option>
								<option value="others">Others</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" name="username" class="form-control" placeholder="Enter your username" required>
						</div>
						<div class="form-group">
							<input type="password" name="password" class="form-control" placeholder="Enter your password" required>
						</div>
						<div class="form-group">
							<button type="submit" name="register" class="btn btn-primary">Register</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- JavaScript for Bootstrap Modals -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script src='script.js'></script>
</body>
</html>