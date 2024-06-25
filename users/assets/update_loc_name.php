<?php 
session_start();
include("../../dbconn.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $locId = mysqli_real_escape_string($conn, $_POST['locId']);
    $locationName = mysqli_real_escape_string($conn, $_POST['locationName']);

    echo $locId;
    echo $locationName;

    $query = "UPDATE branch_location SET name = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $locationName, $locId);

    if ($stmt->execute()) {
        $_SESSION['success4'] = "Location ".$locationName." updated successfully!";
        echo "Record updated successfully";
    } else {
        $_SESSION['error4'] = "Location ".$locationName." updated successfully!";
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: ../humanResource/recruitment.php?activeTab=offices");
    exit();
} else {
    echo "Invalid request.";
}

?>