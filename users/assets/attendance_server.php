<?php
session_start();
include '../../dbconn.php';

if (isset($_POST["newTimeSheet"])) {

    $Month = $_POST["monthModal"];
    $Year = $_POST["yearModal"];
    $Payroll_period = $_POST["ppModal"];
    $Payroll_fq = $_POST["pfModal"];
    $sdate = $_POST["sdateModal"];
    $edate = $_POST["edateModal"];

    $creator = "Crispin Jose Uriarte";

    $sql = "INSERT INTO time_sheet (Month, Year, Payroll_period, Payroll_fq, date_start, date_end, creator) VALUES (?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssss", $Month, $Year, $Payroll_period, $Payroll_fq, $sdate, $edate, $creator);

        if ($stmt->execute()) {
            $_SESSION['success'] = "New row added successfully.";
            header("Location: ../humanResource/attendance.php?activeTab=timeSheet");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}

mysqli_close($conn);
?>