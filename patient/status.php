<?php
	include("../include/header.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta content="Free HTML Templates" name="keywords">
	<meta content="Free HTML Templates" name="description">
	<title>Check Appointment Status</title>

	<!--Favicon-->
	<link href="img/favicon.png" rel="icon">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<!--Google Web Fonts-->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

	<!--Icon Font Stylesheet-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icon@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

	<!--Libraries stylesheet-->
	<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
	<link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

	<!--Customized Bootstrap stylesheet-->
	<link href="../css/bootstrap.min.css" rel="stylesheet">

	<!--Template Stylesheet-->
	<link href="../css/style.css" rel="stylesheet">
	<style>
		footer {
            background: black;
            color: white;
            padding: 20px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .social-links {
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }
        .icon {
            display: block;
            text-align: center;
            text-decoration: none;
            color: white;
        }
        .icon i {
            display: block;
            font-size: 40px;
            margin-bottom: 8px;
        }


        footer a {
            color: white;
            margin-left: 10px;
            font-size: 20px;
        }
	</style>
</head>
<body>
	<div class="main" style="min-height: 90vh; display: flex; flex-direction: column; justify-content: space-between;">
	<div class="container" style=" margin-left: 90px; margin-top: 20px;">
		<div class="search-form">
			<h5 class="mb-4" style="text-align: center;">Check Appointment Status</h5>
			<form method="post">
				<div class="form-group">
					<label for="searchPhone">Enter Phone Number</label>
					<input type="text" class="form-control" id="searchPhone" name="searchPhone" required>
				</div>
				<button type="submit" name="searchSubmit" class="btn btn-primary">Check Status</button>
			</form>
			<?php
				include("../include/connection.php");
				if(isset($_POST['searchSubmit'])){
					$searchPhone = mysqli_real_escape_string($connect, $_POST['searchPhone']);

					// Debugging: Check all statuses for this phone number
					$debugQuery = "SELECT * FROM appointment WHERE phone='$searchPhone'";
					$debugResult = mysqli_query($connect, $debugQuery);

					// Check the total number of appointments
					$totalAppointments = mysqli_num_rows($debugResult);
					echo "<div class='alert alert-info'>Total appointments found: $totalAppointments</div>";

					// Print out all appointments for debugging
					if($totalAppointments > 0){
						echo "<div class='result'>";
						echo "<table class='table' style='width:900px;'>
							<tr>
								<th>Name</th>
								<th>District</th>
								<th>Department</th>
								<th>Doctor</th>
								<th>Consultation Date</th>
								<th>Status</th>
							</tr>";
						while($row = mysqli_fetch_assoc($debugResult)){
							$rowClass = $row['status'] == 'approved' ? 'bg-success' : 'bg-warning';
							echo "<tr class='$rowClass'>";
							echo "<td>".$row['name']."</td>";
							echo "<td>".$row['district']."</td>";
							echo "<td>".$row['department']."</td>";
							echo "<td>".$row['doctor']."</td>";
							echo "<td>".$row['date']."</td>";
							echo "<td>".$row['status']."</td>";
							echo "</tr>";
						}
						echo "</table>";
						echo "</div>";
					} else {
						echo "<div class='alert alert-warning mt-3'>
								No appointments found for the given phone number.
							  </div>";
					}
					mysqli_close($connect);
				}
		    ?>
		</div>
	    </div>

	    <footer id="contact">
        <div style="margin: 20px 0 20px 100px;">
            <p><strong>Contact Us:</strong></p>
            <p>Phone: +123456789</p>
            <p>Email: info@hospital.com</p>
        </div>
        <div class="social-links">
            <a class="icon" href="https://google.com" target="_blank"><i class="fab fa-google"></i>Google</a>
            <a class="icon" href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i>Twitter</a>
            <a class="icon" href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i>Instagram</a>
            <a class="icon" href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i>Facebook</a>
        </div>
        </footer>
    </div>
	
		
</body>
</html>
