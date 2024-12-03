<?php
session_start();
if (!isset($_SESSION['doctor'])) {
    http_response_code(403);
    exit('Unauthorized');
}

include '../include/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointment_id = $_POST['appointment_id'];
    $status = $_POST['status'];
    $doctor_username = $_SESSION['doctor'];

    // Validate status
    if (!in_array($status, ['confirmed', 'cancelled'])) {
        http_response_code(400);
        exit('Invalid status');
    }

    try {
        // Verify the appointment belongs to this doctor
        $stmt = $connect->prepare("SELECT * FROM appointments WHERE id = ? AND doctor_username = ?");
        $stmt->bind_param("is", $appointment_id, $doctor_username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Appointment not found or unauthorized");
        }

        // Update the appointment status
        $update_stmt = $connect->prepare("UPDATE appointments SET status = ? WHERE id = ?");
        $update_stmt->bind_param("si", $status, $appointment_id);
        
        if (!$update_stmt->execute()) {
            throw new Exception("Error updating appointment");
        }

        echo "Success";

    } catch (Exception $e) {
        http_response_code(500);
        exit($e->getMessage());
    }
}
?>