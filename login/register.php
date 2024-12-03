<?php
include("../include/connection.php");

if (isset($_POST['register'])) {
	$full_name = $_POST['full_name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$gender = $_POST['gender'];
	$username = $_POST['username'];
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashed password for security

	$query = "INSERT INTO users (full_name, phone, email, gender, username, password)
			  VALUES (?, ?, ?, ?, ?, ?)";
	$stmt = mysqli_prepare($connect, $query);
	mysqli_stmt_bind_param($stmt, "ssssss", $full_name, $phone, $email, $gender, $username, $password);

	if (mysqli_stmt_execute($stmt)) {
		echo "<script>alert('Patient Registered Successfully'); window.location.href='login.php';</script>";
	} else {
		echo "<script>alert('Failed to Register');</script>";
	}
}
?>
