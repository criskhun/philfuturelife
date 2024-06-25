<?php
session_start();
include '../../dbconn.php'; // Make sure to include your database connection

if (isset($_POST['locStatDelete'])) {

    $locID = $_POST['locStatID'];
    echo $locID;

    $sql = "DELETE FROM branch_location WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $locID);
        
        if ($stmt->execute()) {
            $_SESSION['success4'] = "Branch location ".$locID." deleted successfully.";
            header("Location: ../humanResource/recruitment.php?activeTab=offices");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}



?>
