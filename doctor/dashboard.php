<?php
session_start();
if (!isset($_SESSION['doctor'])) {
    header("location:../login/login.php");
    exit();
}

include '../include/connection.php';

// Get doctor's information
$doctorUsername = $_SESSION['doctor'];
$stmt = $connect->prepare("SELECT full_name, email, phone FROM doctors WHERE username = ?");
if ($stmt === false) {
    die("Error preparing doctor info query: " . $connect->error);
}
$stmt->bind_param("s", $doctorUsername);
$stmt->execute();
$result = $stmt->get_result();
$doctorInfo = $result->fetch_assoc();
$stmt->close();

// Function to handle database errors
function handleDatabaseError($connect, $query) {
    die("Database error: " . $connect->error . "<br>Query: " . $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .main-content {
            margin-top: 20px;
        }
        .card {
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .status-pending {
            color: #ffc107;
        }
        .status-confirmed {
            color: #28a745;
        }
        .status-cancelled {
            color: #dc3545;
        }
        .doctor-info {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
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
        <a class="navbar-brand" href="#">Doctor Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-user-md"></i> <?php echo htmlspecialchars($doctorInfo['full_name']); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php"><i class="fas fa-user-cog"></i> Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container main-content">
        <!-- Doctor Info Card -->
        <div class="doctor-info">
            <h4><i class="fas fa-user-md"></i> Doctor Information</h4>
            <div class="row">
                <div class="col-md-4">
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($doctorInfo['full_name']); ?></p>
                </div>
                <div class="col-md-4">
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($doctorInfo['email']); ?></p>
                </div>
                <div class="col-md-4">
                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($doctorInfo['phone']); ?></p>
                </div>
            </div>
        </div>

        <!-- Appointment Management Section -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-calendar-check"></i> Appointment Management</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch appointments for this doctor
                            $query = "SELECT a.*, p.full_name as patient_name, p.phone as patient_phone 
                                    FROM appointment a 
                                    INNER JOIN patient p ON a.patient_reg = p.patient_id 
                                    WHERE a.doctor_reg = ? 
                                    ORDER BY a.date DESC, a.time DESC";
                            
                            $stmt = $connect->prepare($query);
                            if ($stmt === false) {
                                handleDatabaseError($connect, $query);
                            }
                            if (!$stmt->bind_param("s", $doctorUsername)) {
                                die("Error binding parameters: " . $stmt->error);
                            }
                            if (!$stmt->execute()) {
                                die("Error executing query: " . $stmt->error);
                            }
                            $appointments = $stmt->get_result();
                            $stmt->close();

                            while ($appointment = $appointments->fetch_assoc()) {
                                $statusClass = '';
                                switch($appointment['status']) {
                                    case 'pending':
                                        $statusClass = 'status-pending';
                                        break;
                                    case 'confirmed':
                                        $statusClass = 'status-confirmed';
                                        break;
                                    case 'cancelled':
                                        $statusClass = 'status-cancelled';
                                        break;
                                }
                            ?>
                                <tr>
                                    <td>
                                        <?php echo htmlspecialchars($appointment['patient_name']); ?>
                                        <br>
                                        <small class="text-muted">Phone: <?php echo htmlspecialchars($appointment['patient_phone']); ?></small>
                                    </td>
                                    <td><?php echo htmlspecialchars($appointment['date']); ?></td>
                                    <td><?php echo htmlspecialchars($appointment['time']); ?></td>
                                    <td>
                                        <span class="<?php echo $statusClass; ?>">
                                            <?php echo ucfirst(htmlspecialchars($appointment['status'])); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if($appointment['status'] == 'pending'): ?>
                                            <button class="btn btn-success btn-sm" onclick="updateAppointment(<?php echo $appointment['id']; ?>, 'confirmed')">
                                                <i class="fas fa-check"></i> Confirm
                                            </button>
                                            <button class="btn btn-danger btn-sm" onclick="updateAppointment(<?php echo $appointment['id']; ?>, 'cancelled')">
                                                <i class="fas fa-times"></i> Cancel
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Patient Information Section -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-users"></i> Patient Information</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Last Visit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch unique patients who have appointments with this doctor
                            $query = "SELECT DISTINCT p.*, 
                                     MAX(a.date) as last_visit 
                                     FROM patient p 
                                     INNER JOIN appointment a ON p.patient_id = a.patient_reg 
                                     WHERE a.doctor_reg = ? 
                                     GROUP BY p.patient_id, p.id, p.full_name, p.phone, p.gender 
                                     ORDER BY last_visit DESC";
                            
                            $stmt = $connect->prepare($query);
                            if ($stmt === false) {
                                handleDatabaseError($connect, $query);
                            }
                            if (!$stmt->bind_param("s", $doctorUsername)) {
                                die("Error binding parameters: " . $stmt->error);
                            }
                            if (!$stmt->execute()) {
                                die("Error executing query: " . $stmt->error);
                            }
                            $patients = $stmt->get_result();
                            $stmt->close();

                            while ($patient = $patients->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($patient['full_name']); ?></td>
                                    <td><?php echo htmlspecialchars($patient['email']); ?></td>
                                    <td><?php echo htmlspecialchars($patient['phone']); ?></td>
                                    <td><?php echo htmlspecialchars($patient['gender']); ?></td>
                                    <td><?php echo htmlspecialchars($patient['last_visit']); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
    function updateAppointment(appointmentId, status) {
        if (confirm('Are you sure you want to ' + status + ' this appointment?')) {
            $.ajax({
                url: 'update_appointment.php',
                type: 'POST',
                data: {
                    appointment_id: appointmentId,
                    status: status
                },
                success: function(response) {
                    alert('Appointment status updated successfully');
                    location.reload();
                },
                error: function() {
                    alert('Error updating appointment status');
                }
            });
        }
    }
    </script>
</body>
</html>