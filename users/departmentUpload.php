<?php
session_start();
include_once("../dbconn.php");

if (isset($_POST["InsertDepartment"])) {
    $department = $_POST["newDepartment"];
    $creator = "Crispin Jose Uriarte";

    $sqlCheck = "SELECT COUNT(*) FROM department WHERE departmentName = ?";
    if ($stmtCheck = $conn->prepare($sqlCheck)) {
        $stmtCheck->bind_param("s", $department);
        $stmtCheck->execute();
        $stmtCheck->bind_result($count);
        $stmtCheck->fetch();
        $stmtCheck->close();

        if ($count > 0) {
            $_SESSION['error'] = "The department name already exists.";
            header("Location: ../users/humanResource/recruitment.php");
            exit();
        } else {
            // Insert the new department
            $sql = "INSERT INTO department (departmentName, creator) VALUES (?, ?)";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("ss", $department, $creator);

                if ($stmt->execute()) {
                    $_SESSION['success'] = "New department added successfully.";
                    header("Location: ../users/humanResource/recruitment.php");
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Error: " . $conn->error;
            }
        }
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}

if (isset($_POST['updateDept'])) {
    $deptID = $_POST['deptID'];
    $deptName = $_POST['deptName'];

    // Debugging output
    echo "Updating department with ID: $deptID and name: $deptName<br>";

    $sql = "UPDATE department SET departmentName = ? WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("si", $deptName, $deptID);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $_SESSION['success'] = "Department updated successfully.";
            } else {
                $_SESSION['error'] = "Failed! No rows were updated.";
            }
            header("Location: ../users/humanResource/recruitment.php");
            exit();
        } else {
            $_SESSION['error'] = "Error executing SQL: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = "Error preparing SQL: " . $conn->error;
    }
} 

if (isset($_POST['deptDelete'])) {
    $deptID = $_POST['deptID'];

    $sql = "DELETE FROM department WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $deptID);
        
        if ($stmt->execute()) {
            $_SESSION['success'] = "Department deleted successfully.";
            header("Location: ../users/humanResource/recruitment.php");
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

if (isset($_POST["InsertJobTitle"])) {
    $department = $_POST["deptlist"];
    $jobTitle = $_POST["newJobTitle"];
    $creator = "Crispin Jose Uriarte";

    $sqlCheck = "SELECT COUNT(*) FROM job_title WHERE job_name = ?";
    if ($stmtCheck = $conn->prepare($sqlCheck)) {
        $stmtCheck->bind_param("s", $jobTitle);
        $stmtCheck->execute();
        $stmtCheck->bind_result($count);
        $stmtCheck->fetch();
        $stmtCheck->close();

        if ($count > 0) {
            $_SESSION['error1'] = "The job title name already exists.";
            header("Location: ../users/humanResource/recruitment.php");
            exit();
        } else {
            // Insert the new department
            $sql = "INSERT INTO job_title (department, job_name, creator) VALUES (?, ?, ?)";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("sss", $department, $jobTitle, $creator);

                if ($stmt->execute()) {
                    $_SESSION['success1'] = "New Job Title added successfully.";
                    header("Location: ../users/humanResource/recruitment.php");
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Error: " . $conn->error;
            }
        }
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}

if (isset($_POST['updateJob'])) {
    $jobID = $_POST['jobID'];
    $jobName = $_POST['jobName'];
    $department = $_POST['deptlist'];

    // Debugging output
    echo "Updating jobtitle with ID: $jobID, name: $jobName and depatment: $department<br>";

    $sql = "UPDATE job_title SET department = ?, job_name = ? WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssi", $department, $jobName, $jobID);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $_SESSION['success1'] = "Job Title updated successfully.";
            } else {
                $_SESSION['error1'] = "Failed! No rows were updated.";
            }
            header("Location: ../users/humanResource/recruitment.php");
            exit();
        } else {
            $_SESSION['error1'] = "Error executing SQL: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['error1'] = "Error preparing SQL: " . $conn->error;
    }
} 

if (isset($_POST['jobDelete'])) {
    $jobID = $_POST['jobID'];

    $sql = "DELETE FROM job_title WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $jobID);
        
        if ($stmt->execute()) {
            $_SESSION['success1'] = "Job Title deleted successfully.";
            header("Location: ../users/humanResource/recruitment.php");
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
