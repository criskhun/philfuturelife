<?php

include_once("../dbconn.php");

if (isset($_POST["newAttendance"])) {
    $schedName = $_POST["schedName"];
    $timeIn = $_POST["timeIn"];
    $breakIn = $_POST["BreakIn"];
    $breakOut = $_POST["BreakOut"];
    $timeOut = $_POST["timeOut"];
    $creator = "Crispin Jose Uriarte"; // Assign the creator name to a variable

    // Check if schedName already exists and generate a new unique name if necessary
    $originalSchedName = $schedName;
    $counter = 1;

    $sqlCheck = "SELECT COUNT(*) FROM schedule WHERE schedName = ?";
    if ($stmtCheck = $conn->prepare($sqlCheck)) {
        $stmtCheck->bind_param("s", $schedName);

        do {
            $stmtCheck->execute();
            $stmtCheck->bind_result($count);
            $stmtCheck->fetch();

            if ($count > 0) {
                $schedName = $originalSchedName . " (" . $counter . ")";
                $counter++;
                $stmtCheck->bind_param("s", $schedName);
            }
        } while ($count > 0);

        $stmtCheck->close();
    } else {
        echo "Error: " . $conn->error;
    }

    // Insert the new schedule
    $sql = "INSERT INTO schedule (schedName, timeIn, breakIn, breakOut, timeOut, creator) VALUES (?, ?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssss", $schedName, $timeIn, $breakIn, $breakOut, $timeOut, $creator);

        if ($stmt->execute()) {
            echo "New schedule added successfully.";
            header("Location: ../users/humanResource/dutySchedule.php");
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

if (isset($_POST['updateSched'])) {
    $schedID = $_POST['schedID'];
    $schedName = $_POST['schedName'];
    $timeIn = $_POST['timeIn'];
    $breakIn = $_POST['breakIn'];
    $breakOut = $_POST['breakOut'];
    $timeOut = $_POST['timeOut'];

    $sql = "UPDATE schedule SET schedName = ?, timeIn = ?, breakIn = ?, breakOut = ?, timeOut = ? WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssi", $schedName, $timeIn, $breakIn, $breakOut, $timeOut, $schedID);
        
        if ($stmt->execute()) {
            echo "Schedule updated successfully.";
            header("Location: ../users/humanResource/dutySchedule.php");
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

if (isset($_POST['deleteSched'])) {
    $schedID = $_POST['schedID'];

    $sql = "DELETE FROM schedule WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $schedID);
        
        if ($stmt->execute()) {
            echo "Schedule deleted successfully.";
            header("Location: ../users/humanResource/dutySchedule.php");
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
