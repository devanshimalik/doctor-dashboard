<?php
session_start();
if (!isset($_SESSION['patient'])) {
    header("location:../login/login.php");
    exit();
}

include '../include/connection.php';

$patientName = $_SESSION['patient'];
?>

<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php 
        echo $_SESSION['error'];
        unset($_SESSION['error']);
        ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Patient Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .main-content {
            margin: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
        .feedback-section, .complaint-section {
            margin-top: 20px;
        }

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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Patient Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo $patientName; ?> (Patient)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content container">
        <div class="row">
            <div class="col-md-6">
                <!-- Check Appointment Status -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Check Appointment Status</h5>
                        <p class="card-text">View the status of your current appointments.</p>
                        <a href="status.php" class="btn btn-primary">Appointment Status</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Book Appointment -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Book Appointment</h5>
                        <p class="card-text">Book a new appointment with a doctor.</p>
                        <a href="appointment.php" class="btn btn-primary">Book Appointment</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Complaint Section -->
        <div class="complaint-section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Register a Complaint</h5>
            <form action="submit_complaint.php" method="POST">
                <div class="form-group">
                    <label for="doctor">Select Doctor:</label>
                    <select class="form-control" id="doctor" name="doctor" required>
                        <option value="" disabled selected>Select a doctor</option>
                        <option value="Dr. Smith">Dr. Smith</option>
                        <option value="Dr. Johnson">Dr. Johnson</option>
                        <option value="Dr. Taylor">Dr. Taylor</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="complaint" rows="3" placeholder="Describe your complaint" required></textarea>
                </div>
                <button type="submit" class="btn btn-danger">Submit Complaint</button>
            </form>
        </div>
    </div>
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

        <!-- Feedback Section 
        <div class="feedback-section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Feedback on Doctor</h5>
                    <form action="submit_feedback.php" method="POST">
                        <div class="form-group">
                            <textarea class="form-control" name="feedback" rows="3" placeholder="Provide your feedback about the doctor"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Submit Feedback</button>
                    </form>
                </div>
            </div>
        </div>
    </div>-->

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script>
    // Example list of doctors (this can come from an API or database)
    const doctors = ['Dr. Amit Chaudhary',
        'Dr. Rahul Garg',
        'Dr. Robin Yadav',
        'Dr. Shruti Mehta',
        'Dr. Arif',
        'Dr. Saloni Sharma',
        'Dr. Anushka Singh',
        'Dr. Anish Aggarwal'];

    // Function to populate the doctor dropdown
    function populateDoctorDropdown() {
        const doctorDropdown = document.getElementById("doctor");

        // Loop through the list of doctors and add them as options
        doctors.forEach(doctor => {
            const option = document.createElement("option");
            option.value = doctor;
            option.textContent = doctor;
            doctorDropdown.appendChild(option);
        });
    }

    // Call the function to populate the dropdown when the page loads
    document.addEventListener("DOMContentLoaded", populateDoctorDropdown);
    </script>


</body>
</html>
