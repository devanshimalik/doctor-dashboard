<?php
session_start();
if (!isset($_SESSION['doctor'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized access']);
    exit();
}

include '../include/connection.php';

// Validate input
if (!isset($_POST['appointment_id']) || !isset($_POST['status'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required parameters']);
    exit();
}

$appointmentId = $_POST['appointment_id'];
$status = $_POST['status'];

// Validate status values
$validStatuses = ['pending', 'confirmed', 'cancelled'];
if (!in_array($status, $validStatuses)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid status']);
    exit();
}

// Prepare and execute update query
$query = "UPDATE appointment SET status = ? WHERE id = ?";
$stmt = $connect->prepare($query);

if ($stmt === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Database preparation error']);
    exit();
}

$stmt->bind_param("si", $status, $appointmentId);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Appointment status updated']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to update appointment']);
}

$stmt->close();
$connect->close();
?>