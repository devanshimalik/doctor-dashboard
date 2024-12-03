<?php
	include("header.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta content="Free HTML Templates" name="keywords">
	<meta content="Free HTML Templates" name="description">
	<title>Check appointment status</title>


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

	<!--Libraries stylesheet-->
	<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
	<link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

	<!--Customized Bootstrap stylesheet-->
	<link href="css/bootstrap.min.css" rel="stylesheet">


	<!--Template Stylesheet-->
	<link href="css/style.css" rel="stylesheet">
	
</head>
<body>
	<div class="container" style="position: fixed; margin-left: 350px; margin-top: 20px;">
		<div class="search-form">
			<h5 class="mb-4" style="text-align: center;">Check Appointment status</h5>
			<form method="post">
				<div class="form-group">
					<label for="searchPhone">Enter Phone Number</label>
					<input type="text" class="form-control" id="searchPhone" name="searchPhone" required>
				</div>
				<button type="submit" name="searchSubmit" class="btn btn-primary">Check status</button>
			</form>
			<?php
				include("include/connection.php");
				if(isset($_POST['searchSubmit'])){
					$searchPhone=isset($_POST['searchPhone']) ? $_POST['searchPhone']:'';

					$searchQuery="SELECT * FROM general_appointment WHERE phone='$searchPhone'";
					$searchResult=mysqli_query($connect, $searchQuery);

					if(mysqli_num_rows($searchResult)>0){
						echo"<div class='result'>";
						echo"<table class='table' style='width:900px;'>
							<tr>
							<th class='bg-black'>Name</th>
							<th class='bg-black'>District</th>
							<th class='bg-black'>Department</th>
							<th class='bg-black'>Doctor</th>
							<th class='bg-black'>Cinsultation Date</th>
							<th class='bg-black'>Status</th>
						</tr>";
						while($row=mysqli_fetch_assoc($searchResult)){
							$bgcolor='';

							if($row['status']=='approved'){
								$bgcolor='success';
							}
							elseif($row['status']=='denied'){
								$bgcolor='danger';
							}
							echo"<tr class='$bgcolor'>";
							echo"<td>".$row['name']."</td>";
							echo"<td>".$row['district']."</td>";
							echo"<td>".$row['department']."</td>";
							echo"<td>".$row['doctor']."</td>";
							echo"<td>".$row['date']."</td>";
							echo"<td>".$row['status']."</td>";

						echo"</tr>";
					    echo"</table>";
				        echo"</div>";
						}
						else{
							echo"<div class='result'>";
							echo"<h2>No Result Found</h2>";
						echo"</div>";

						mysqli_close($connect);
						}
					}
				}
		    ?>
		</div>
	</div>

	<footer style="margin-top:400px; height:300px;">
		<?php
			include("include/footer.php");
		?>
	</footer>
		
</body>
</html>