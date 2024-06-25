<?php
session_start();
include '../../dbconn.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $candID = $_POST['candID'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $jobPost = $_POST['jobPost'];
    $department = $_POST['department'];
    $jobStat = $_POST['jobStat'];
    $branch = $_POST['branch'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $experience = $_POST['experience'];


    if (isset($_POST['approved'])) {
        // Update the candidate data and set application_status to approved
        $sql = "UPDATE candidate_table SET application_status='Approved' WHERE id=?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            // Error preparing statement
            die('Error preparing the statement: ' . $conn->error);
        }

        $stmt->bind_param('i', $candID);

        if ($stmt->execute()) {
            // Check if any rows were updated
            if ($stmt->affected_rows > 0) {
                echo 'Record updated successfully.';
            } else {
                echo 'No record was updated. Check if the ID exists.';
            }
        } else {
            // Error executing statement
            die('Error executing the statement: ' . $stmt->error);
        }

        $currentYear = date('Y');
        $prefix = 'PFL-' . $currentYear . '-';

        $sql = "SELECT COUNT(*) AS count FROM masterlist_table WHERE YEAR(created_at) = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $currentYear);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $count = $row['count'] + 1; // Increment count for the new employee
        $employeeNumber = str_pad($count, 5, '0', STR_PAD_LEFT);

        $newEmployeeId = $prefix . $employeeNumber;

        // Optionally, you can save the candidate data to the master list
        $sql_master = "INSERT INTO masterlist_table (emp_id, emp_email, emp_full_name, emp_branch, emp_position, emp_department, emp_status, emp_age, emp_mobile, emp_presentAdd) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt_master = $conn->prepare($sql_master);
        $stmt_master->bind_param('ssssssssss', $newEmployeeId, $email, $name, $branch, $jobPost, $department, $jobStat, $age, $phone, $address);
        $stmt_master->execute();
    } elseif (isset($_POST['dropped'])) {
        // Update the candidate data and set application_status to drop
        $sql = "UPDATE candidate_table SET application_status='drop' WHERE id=?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $candID);
        $stmt->execute();
    }

    $stmt->close();
    $conn->close();

    // Redirect back to the page
    header('Location: ../humanResource/masterlist.php?activeTab=Candidate');
    exit();
}
