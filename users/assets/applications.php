<?php
session_start();
include("../../dbconn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $jobId = $_POST['jobId'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $experience = $_POST['yearExp'];

    // Age validation
    if ($age < 18) {
        $_SESSION['error'] = "You must be at least 18 years old to apply.";
        header("Location: ../public/careers.php?jobId=" . $jobId);
        exit;
    }

    // Check if the user has already applied for the same job
    $checkQuery = "SELECT COUNT(*) FROM candidate_table WHERE email = ? AND job_position = (SELECT job_name FROM job_posting WHERE id = ?)";
    if ($checkStmt = $conn->prepare($checkQuery)) {
        $checkStmt->bind_param("si", $email, $jobId);
        $checkStmt->execute();
        $checkStmt->bind_result($count);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($count > 0) {
            $_SESSION['error'] = "You have already applied for this job. Wait for the HR to contact you!";
            header("Location: ../public/careers.php?jobId=" . $jobId);
            exit;
        }
    } else {
        $_SESSION['error'] = "Error preparing check query: " . $conn->error;
        header("Location: ../public/careers.php?jobId=" . $jobId);
        exit;
    }

    // Handle file uploads and rename files
    $targetDir = "uploadsFile/";
    $resumeFileName = "resume" . time() . "_" . uniqid() . ".pdf"; // Rename resume file
    $coverLetterFileName = "coverletter" . time() . "_" . uniqid() . ".pdf"; // Rename cover letter file

    $resumeFilePath = $targetDir . $resumeFileName;
    $coverLetterFilePath = $targetDir . $coverLetterFileName;

    // Check if the resume file is a valid file
    if (!move_uploaded_file($_FILES["resume"]["tmp_name"], $resumeFilePath)) {
        $_SESSION['error'] = "Sorry, there was an error uploading your resume file.";
        header("Location: ../public/careers.php?jobId=" . $jobId);
        exit;
    }

    // Check if the cover letter file is a valid file
    if (!move_uploaded_file($_FILES["coverLetter"]["tmp_name"], $coverLetterFilePath)) {
        $_SESSION['error'] = "Sorry, there was an error uploading your cover letter file.";
        header("Location: ../public/careers.php?jobId=" . $jobId);
        exit;
    }

    // Insert data into database
    $query = "INSERT INTO candidate_table (job_position, branch, department, job_status, email, name, phone, address, age, experience, resume, cover_letter) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($query)) {
        // Fetch job details based on jobId
        $jobDetailsQuery = "SELECT job_name, location, department, job_status FROM job_posting WHERE id = ?";
        if ($jobStmt = $conn->prepare($jobDetailsQuery)) {
            $jobStmt->bind_param("i", $jobId);
            $jobStmt->execute();
            $jobResult = $jobStmt->get_result();

            if ($jobResult->num_rows > 0) {
                $jobRow = $jobResult->fetch_assoc();
                $jobPosition = $jobRow['job_name'];
                $branch = $jobRow['location'];
                $department = $jobRow['department'];
                $jobStatus = $jobRow['job_status'];

                $stmt->bind_param("ssssssssisss", $jobPosition, $branch, $department, $jobStatus, $email, $name, $phone, $address, $age, $experience, $resumeFilePath, $coverLetterFilePath);
                if ($stmt->execute()) {
                    $_SESSION['success'] = "Application submitted successfully.";
                    header("Location: ../public/careers.php?jobId=" . $jobId);
                } else {
                    $_SESSION['error'] = "Error: " . $stmt->error;
                    header("Location: ../public/careers.php?jobId=" . $jobId);
                }
            } else {
                $_SESSION['error'] = "No job found with the given ID.";
                header("Location: ../public/careers.php?jobId=" . $jobId);
            }

            $jobStmt->close();
        } else {
            $_SESSION['error'] = "Error preparing job details query: " . $conn->error;
            header("Location: ../public/careers.php?jobId=" . $jobId);
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = "Error preparing insert query: " . $conn->error;
        header("Location: ../public/careers.php?jobId=" . $jobId);
    }

    $conn->close();
} else {
    $_SESSION['error'] = "Invalid request method.";
    header("Location: ../public/careers.php?jobId=" . $jobId);
}
?>
