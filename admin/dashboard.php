<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("location:../login/login.php");
    exit();
}

include '../include/connection.php';

$adminCount = $connect->query("SELECT COUNT(*) AS count FROM admin")->fetch_assoc()['count'];
$doctorCount = $connect->query("SELECT COUNT(*) AS count FROM doctors")->fetch_assoc()['count'];
$patientCount = $connect->query("SELECT COUNT(*) AS count FROM patient")->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
        .navbar {
            z-index: 1;
        }
        .sidebar {
            width: 200px;
            position: fixed;
            top: 56px; /* height of navbar */
            left: 0;
            bottom: 0;
            background-color: #2b9eb3;
            padding-top: 20px;
            color: white;
        }
        .sidebar a {
            display: block;
            color: white;
            padding: 10px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #1a6f7e;
        }
        .main-content {
            margin-left: 220px;
            padding: 20px;
            flex: 1;
        }
        .card {
            margin: 10px;
        }
    </style>
</head>
<body>
    <!-- Navbar with Logout option -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Hospital Management System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo $_SESSION['admin']; ?> (Admin)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#">Dashboard</a>
        <a href="#">Administration</a>
        <a href="#">Doctors</a>
        <a href="#">Patients</a>
        <a href="#">Add Staff</a>
        <a href="#">Send Notice</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Admin Dashboard</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Total Admins</h5>
                        <p id="total-admin" class="card-text"><?php echo $adminCount; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Doctors</h5>
                        <p id="total-doctor" class="card-text"><?php echo $doctorCount; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Total Patients</h5>
                        <p id="total-patient" class="card-text"><?php echo $patientCount; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <h5 class="card-title">Total Complaints</h5>
                        <p id="total-complaint" class="card-text">0</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row">
            <div class="col-md-6">
                <canvas id="doctor-chart"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="patient-chart"></canvas>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="dashboard.js"></script>
</body>
</html>
