<?php
include("../../dbconn.php");

if (isset($_POST['id']) && isset($_POST['active'])) {
    $id = $_POST['id'];
    $active = $_POST['active'];

    $query = "UPDATE job_posting SET active = ? WHERE id = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ii", $active, $id);

        if ($stmt->execute()) {
            echo "Job post status updated successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>