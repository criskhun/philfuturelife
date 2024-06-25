<?php
session_start();
include '../../dbconn.php';

$id = $_POST['id'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];

// Prepare and bind
$stmt = $conn->prepare("UPDATE branch_location SET lat = ?, lng = ? WHERE id = ?");
$stmt->bind_param("ddi", $lat, $lng, $id);

// Execute the statement
if ($stmt->execute()) {
    $_SESSION['success4'] = "Location ".$id." updated successfully!";
    echo json_encode(['status' => 'success', 'message' => 'Location updated successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update location']);
}

// Close the statement and connection
$stmt->close();
$conn->close();

?>