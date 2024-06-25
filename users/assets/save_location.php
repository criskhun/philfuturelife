<?php
session_start();
include '../../dbconn.php'; // Ensure correct path to your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $creator = "Crispin Jose Uriarte";

    if ($name && $lat && $lng) {
        $stmt = $conn->prepare("INSERT INTO branch_location (name, lat, lng, creator) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdds", $name, $lat, $lng, $creator);

        if ($stmt->execute()) {
            $_SESSION['success4'] = "Location ".$name." added successfully!";
            echo 'success'; // Only output 'success'
        } else {
            $_SESSION['error4'] = "Failed to add location.";
            echo 'error';
        }
        $stmt->close();
    } else {
        $_SESSION['error4'] = "All fields are required.";
        echo 'error';
    }
} else {
    echo 'invalid_request';
}
$conn->close();
?>
