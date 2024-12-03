<?php
include("database.php")
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
	body{
		font-family: poppins, sans-serif;
		margin: 0;
		padding: 0;
		background-image: url("../image/appointment_image.jpg");
		background-size: 100% auto;
	}
	header{
		color: #fff;
		padding: 0;
		text-align: center;
	}
	form{
		max-width: 600px;
		margin: 10px auto;
		padding: 20px;
		border-radius: 8px;
		box-shadow: 0 0 10px rgba(0, 120, 220, 150.1);
		background-color: rgba(135, 206, 250, 0.7);
	}
	label{
		display: block;
		margin-bottom: 8px;
		margin-left: 150px;
	}
	input, select{
		width: 300px;
		padding: 10px;
		margin-bottom: 12px;
		box-sizing: border-box;
		margin-left: 150px;
	}
	button{
		background-color: #333;
		color: white;
		padding: 12px;
		border: none;
		border-radius: 4px;
		cursor: pointer;
	}
</style>
<body>
	<form action="" method="post" style="margin-left: 40%; margin-top: 20px;">
		<h2 style="margin-left: 150px;">Appointment form</h2>
		<label for="name">Full name</label><br>
		<input type="text" name="name" id="name" required autocomplete="off" placeholder="Enter full name"><br>

		<label for="email">Email</label><br>
		<input type="text" name="email" id="email" required autocomplete="off" placeholder="Enter your email"><br>

		<label for="phone">Phone Number</label><br>
		<input type="phone" name="phone" id="phone" required autocomplete="off" placeholder="Enter phone number"><br>

		<label for="gender">Gender</label><br>
		<select type="text" name="gender" id="gender" required autocomplete="off" placeholder="Select gender">
			<option value="Male">Male</option>
			<option value="Female">Female</option>
			<option value="others">Others</option>
		</select>
		<br>

		<label for="location">Select location</label><br>

		<select name="division" id="division" onchange="populateDistrict()">Select division<br>
		<option value="meerut">Meerut </option>
		<option value="delhi">Delhi</option>
		<option value="ghaziabad"> Ghaziabad </option>
		<option value="noida"> Noida</option>

	    </select><br>

	    <select name="district" id="district"><br>
	    <option value="" disabled selected>Select District</option>
	    </select><br>

	    <label for="department">Select Department</label><br/>
	    <select name="department" id="department" required onchange="populateDoctors()">
	    	<option value="cardiology">Cardiology</option>
	    	<option value="dermatology">Dermatology</option>
	    </select>
	    <br>

	    <label for="doctor">Select Doctors</label><br/>
	    <select id="doctor" name="doctor" required onchange="addDoctors()">
	    	<option value=""disabled selected>Select Doctor</option>
	    </select><br>

	    <label for="date">Select Appoint Date</label><br>
	    <input type="date" name="date" id="date" required><br>

	    <label for="time">Time</label>
	    <input type="time" name="time" id="time" required><br>

	    <button type="submit">Book Appointment</button>

	</form>

	<script src='script.js'></script>

</body>
</html>


