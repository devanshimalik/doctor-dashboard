<?php
session_start();
// Ensure the patient is logged in
if (!isset($_SESSION['patient'])) {
    header("Location: ../login/login.php");
    exit();
}

// Database connection details
$host = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "hms";
$port = 3307;

try {
    // Establish database connection
    $connect = new mysqli($host, $db_username, $db_password, $dbname, $port);
    
    if ($connect->connect_error) {
        throw new Exception("Connection failed: " . $connect->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the logged-in patient's username from the session
        $patient_username = $_SESSION['patient'];
        
        // Validate and sanitize inputs
        $doctor = trim($_POST['doctor']);
        $description = trim($_POST['complaint']);
        
        if (empty($doctor) || empty($description)) {
            throw new Exception("Please fill in all required fields.");
        }

        // Start transaction
        $connect->begin_transaction();

        try {
            // Insert the complaint
            $insert_query = "INSERT INTO complaints (patient, doctor, description, submitted_at) 
                           VALUES (?, ?, ?, CURRENT_TIMESTAMP)";
            $insert_stmt = $connect->prepare($insert_query);
            
            if (!$insert_stmt) {
                throw new Exception("Error in insert query preparation: " . $connect->error);
            }

            $insert_stmt->bind_param("sss", $patient_username, $doctor, $description);
            
            if (!$insert_stmt->execute()) {
                throw new Exception("Error while registering complaint: " . $insert_stmt->error);
            }

            $insert_stmt->close();
            
            // If we got here, commit the transaction
            $connect->commit();
            
            // Redirect back to dashboard with success message
            $_SESSION['message'] = "Complaint registered successfully!";
            header("Location: dashboard.php");
            exit();

        } catch (Exception $e) {
            // Roll back the transaction on error
            $connect->rollback();
            throw $e;
        }
    }

} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    header("Location: dashboard.php");
    exit();

} finally {
    if (isset($connect)) {
        $connect->close();
    }
}
?>