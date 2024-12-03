<?php
$host="localhost";
$username="root";
$password="";
$dbname="hms";
$port=3307;

$connect=mysqli_connect($host, $username, $password, $dbname, $port);


if($_SERVER["REQUEST_METHOD"]==="POST"){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$gender=$_POST['gender'];
	$division=$_POST['division'];
	$district=$_POST['district'];
	$department=$_POST['department'];
	$doctor=$_POST['doctor'];
	$date=$_POST['date'];
	$time=$_POST['time'];

	$check_query="SELECT * FROM appointment WHERE email='$email'";
	$check_result = mysqli_query($connect, $check_query);
	if(mysqli_num_rows($check_result)>0){
		echo '<script>alert ("You have already make appointment with this email.");</script>';
	}
	else{
		$insert = mysqli_query($connect, "INSERT INTO appointment (name,email,phone,gender,division,district,department,doctor,date,time,date_reg,status) VALUES ('$name','$email','$phone','$gender','$division','$district','$department','$doctor','$date','$time',NOW(),'pending')");

		if ($insert) {
    echo '<script>alert("Appointment Successful.");</script>';
} else {
    echo '<script>alert("Appointment failed: ' . mysqli_error($connect) . '");</script>';
}

	}
}
?>

