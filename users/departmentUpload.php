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
                    header("Location: ../users/humanResource/recruitment.php?activeTab=dept");
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
            header("Location: ../users/humanResource/recruitment.php?activeTab=dept");
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

    echo $deptID;

    $sql = "DELETE FROM department WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $deptID);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Department deleted successfully.";
            header("Location: ../users/humanResource/recruitment.php?activeTab=dept");
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
            header("Location: ../users/humanResource/recruitment.php?activeTab=dept");
            exit();
        } else {
            // Insert the new department
            $sql = "INSERT INTO job_title (department, job_name, creator) VALUES (?, ?, ?)";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("sss", $department, $jobTitle, $creator);

                if ($stmt->execute()) {
                    $_SESSION['success1'] = "New Job Title added successfully.";
                    header("Location: ../users/humanResource/recruitment.php?activeTab=dept");
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
            header("Location: ../users/humanResource/recruitment.php?activeTab=dept");
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

if (isset($_POST["InsertJobStat"])) {
    $jobstat = $_POST["newJobStat"];
    $creator = "Crispin Jose Uriarte";

    $sqlCheck = "SELECT COUNT(*) FROM job_status WHERE job_stat = ?";
    if ($stmtCheck = $conn->prepare($sqlCheck)) {
        $stmtCheck->bind_param("s", $jobstat);
        $stmtCheck->execute();
        $stmtCheck->bind_result($count);
        $stmtCheck->fetch();
        $stmtCheck->close();

        if ($count > 0) {
            $_SESSION['error2'] = "The job status name already exists.";
            header("Location: ../users/humanResource/recruitment.php?activeTab=jobStatus");
            exit();
        } else {
            // Insert the new department
            $sql = "INSERT INTO job_status (job_stat, creator) VALUES (?, ?)";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("ss", $jobstat, $creator);

                if ($stmt->execute()) {
                    $_SESSION['success2'] = "New Job Status added successfully.";
                    header("Location: ../users/humanResource/recruitment.php?activeTab=jobStatus");
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

if (isset($_POST['updateJobStat'])) {
    $jobStatID = $_POST['jobStatID'];
    $JobStatus = $_POST['jobStat'];

    // Debugging output
    echo "Updating job_status with ID: $jobStatID and name: $JobStatus<br>";

    $sql = "UPDATE job_status SET job_stat = ? WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("si", $JobStatus, $jobStatID);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $_SESSION['success2'] = "Job Status updated successfully.";
            } else {
                $_SESSION['error2'] = "Failed! No rows were updated.";
            }
            header("Location: ../users/humanResource/recruitment.php?activeTab=jobStatus");
            exit();
        } else {
            $_SESSION['error2'] = "Error executing SQL: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['error2'] = "Error preparing SQL: " . $conn->error;
    }
}

if (isset($_POST['jobStatDelete'])) {

    $jobStatID = $_POST['jobStatID'];
    echo $jobStatID;

    $sql = "DELETE FROM job_status WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $jobStatID);

        if ($stmt->execute()) {
            $_SESSION['success2'] = "Job Status deleted successfully.";
            header("Location: ../users/humanResource/recruitment.php?activeTab=jobStatus");
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

if (isset($_POST["InsertTermStat"])) {
    $termination = $_POST["newTermStat"];
    $creator = "Crispin Jose Uriarte";

    $sqlCheck = "SELECT COUNT(*) FROM termination_status WHERE termination = ?";
    if ($stmtCheck = $conn->prepare($sqlCheck)) {
        $stmtCheck->bind_param("s", $termination);
        $stmtCheck->execute();
        $stmtCheck->bind_result($count);
        $stmtCheck->fetch();
        $stmtCheck->close();

        if ($count > 0) {
            $_SESSION['error3'] = "The termination status already exists.";
            header("Location: ../users/humanResource/recruitment.php?activeTab=jobStatus");
            exit();
        } else {
            // Insert the new department
            $sql = "INSERT INTO termination_status (termination, creator) VALUES (?, ?)";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("ss", $termination, $creator);

                if ($stmt->execute()) {
                    $_SESSION['success3'] = "New termination Status added successfully.";
                    header("Location: ../users/humanResource/recruitment.php?activeTab=jobStatus");
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

if (isset($_POST['updateTermStat'])) {
    $termID = $_POST['termStatID'];
    $termination = $_POST['termStat'];

    // Debugging output
    echo "Updating job_status with ID: $termID and name: $termination<br>";

    $sql = "UPDATE termination_status SET termination = ? WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("si", $termination, $termID);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $_SESSION['success3'] = "Job Termination " . $termination . " updated successfully.";
            } else {
                $_SESSION['error3'] = "" . $termination . "! No rows were updated.";
            }
            header("Location: ../users/humanResource/recruitment.php?activeTab=jobStatus");
            exit();
        } else {
            $_SESSION['error3'] = "Error executing SQL: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['error3'] = "Error preparing SQL: " . $conn->error;
    }
}

if (isset($_POST['termStatDelete'])) {

    $jobTermID = $_POST['termStatID'];
    echo $jobTermID;

    $sql = "DELETE FROM termination_status WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $jobTermID);

        if ($stmt->execute()) {
            $_SESSION['success3'] = "Job Status " . $jobTermID . " deleted successfully.";
            header("Location: ../users/humanResource/recruitment.php?activeTab=jobStatus");
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

if (isset($_POST["InsertJobPosting"])) {
    $department = htmlspecialchars($_POST["deptlist"]);
    $jobTitle = htmlspecialchars($_POST["joblist"]);
    $jobStatus = htmlspecialchars($_POST["jobStatlist"]);
    $branch = htmlspecialchars($_POST["branchlist"]);
    $vacant = htmlspecialchars($_POST["itemCount"]);
    $pay = htmlspecialchars($_POST["pay"]);
    $aboutJob = htmlspecialchars($_POST["aboutJob"]);
    $responsibility = htmlspecialchars($_POST["responsibility"]);
    $education = htmlspecialchars($_POST["educational"]);
    $skills = htmlspecialchars($_POST["skills"]);
    $schedule = htmlspecialchars($_POST["schedlist"]);
    $benefits = htmlspecialchars($_POST["benefits"]);

    $creator = "Crispin Jose Uriarte";

    // Format the responsibility text
    function formatText($text) {
        $lines = preg_split('/\r\n|\r|\n/', $text);
        $formattedText = "";
        foreach ($lines as $line) {
            $trimmedLine = trim($line);
            if (!empty($trimmedLine)) {
                $formattedText .= "● " . $trimmedLine . "<br>";
            }
        }
        return $formattedText;
    }

    $formattedResponsibility = formatText($responsibility);
    $formattedAboutJob = formatText($aboutJob);
    $formattedEducation = formatText($education);
    $formattedSkills = formatText($skills);
    $formattedBenefits = formatText($benefits);

    echo "Department: " . $department . "<br>";
    echo "Job Title: " . $jobTitle . "<br>";
    echo "Job Status: " . $jobStatus . "<br>";
    echo "Branch: " . $branch . "<br>";
    echo "Number of Vacancies: " . $vacant . "<br>";
    echo "Pay: " . $pay . "<br>";
    echo "About the Job: <br>" . $formattedAboutJob . "<br>";
    echo "Responsibilities: <br>" .  $formattedResponsibility . "<br>";
    echo "Educational Requirements: <br>" . $formattedEducation . "<br>";
    echo "Skills: <br>" . $formattedSkills . "<br>";
    echo "Schedule: " . $schedule . "<br>";
    echo "Benefits: <br>" . $formattedBenefits . "<br>";
    echo "Creator: " . $creator . "<br>";

    // Insert the new job posting
    $sql = "INSERT INTO job_posting (department, job_name, job_status, location, item_count, salary, about_job, responsibilities, educational, skills, working_time, benefits, active, creator) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $active = '1'; // Assuming active is a string here. If it's an integer, use $active = 1;
        $stmt->bind_param("ssssssssssssss", $department, $jobTitle, $jobStatus, $branch, $vacant, $pay, $formattedAboutJob, $formattedResponsibility, $formattedEducation, $formattedSkills, $schedule, $formattedBenefits, $active, $creator);

        if ($stmt->execute()) {
            $_SESSION['success4'] = "New Job Posted successfully.";
            header("Location: ../users/humanResource/recruitment.php?activeTab=jobPosting");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "No data to process.";
}

if (isset($_POST['departmentId'])) {
    $departmentId = $_POST['departmentId'];
    $sql = "SELECT id, job_name FROM job_title WHERE department = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $departmentId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row["id"] . '">' . $row["job_name"] . '</option>';
            }
        } else {
            echo '<option value="">No Job Title available</option>';
        }

        $stmt->close();
    } else {
        echo '<option value="">Error fetching job titles</option>';
    }
} else {
    echo '<option value="">Invalid request</option>';
}

$conn->close();
