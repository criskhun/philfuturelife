<?php
include('../../authentication.php');
$page_title = "Public";
include("../header.php");
include("../../dbconn.php");


if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $name = $_SESSION['name'];
}

$queryJP = "SELECT COUNT(*) AS active_count FROM job_posting WHERE active = 1";
$result = $conn->query($queryJP);

if ($result) {
    $row = $result->fetch_assoc();
    $activeCount = $row['active_count'];
} else {
    echo "Error: " . $conn->error;
}

?>

<link rel="stylesheet" href="../../includes/publicStyle.css">



<?php
include("../public/public_navbar.php");
?>

<div class="container">
    <?php
    if (isset($_SESSION['error'])) {
        echo '<div class="container">
            <div class="alert alert-danger alert-dismissible mt-2 mx-2">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Failed!</strong> ' . $_SESSION['error'] . '
            </div>
            </div>';
        unset($_SESSION['error']);
    }

    if (isset($_SESSION['success'])) {
        echo '<div class="alert alert-success alert-dismissible mt-2 mx-2">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Success!</strong> ' . $_SESSION['success'] . '
            </div>';
        unset($_SESSION['success']);
    }
    ?>
</div>

<?php

if (isset($_GET['jobId'])) {
    $jobIdCar = $_GET['jobId'];
    // Fetch job posting details using jobId
    $query = "SELECT * FROM job_posting WHERE id = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $jobIdCar);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Fetch additional details as needed, similar to the previous code
            // For example:
            $jobNameId = $row['job_name']; // This is the ID
            $locationId = $row['location']; // This is the ID
            $departmentId = $row['department']; // This is the ID
            $jobStatusId = $row['job_status']; // This is the ID
            $item_count = $row['item_count'];
            $salary = $row['salary'];
            $aboutJob = $row['about_job'];
            $responsibilities = $row['responsibilities'];
            $educational = $row['educational'];
            $skills = $row['skills'];
            $workingTimeId = $row['working_time']; // This is the ID
            $benefits = $row['benefits'];
            $active = $row['active'];

            // Fetch other details (location, job name, department, job status, working time)
            // Fetch location
            $queryLocation = "SELECT name FROM branch_location WHERE id = '$locationId'";
            $resultLocation = mysqli_query($conn, $queryLocation);
            if ($resultLocation && $resultLocation->num_rows > 0) {
                $rowLocation = mysqli_fetch_array($resultLocation);
                $location = $rowLocation['name'];
            } else {
                $location = "Unknown Location";
            }

            // Fetch job name
            $queryJobName = "SELECT job_name FROM job_title WHERE id = '$jobNameId'";
            $resultJobName = mysqli_query($conn, $queryJobName);
            if ($resultJobName && $resultJobName->num_rows > 0) {
                $rowJobName = mysqli_fetch_array($resultJobName);
                $jobName = $rowJobName['job_name'];
            } else {
                $jobName = "Unknown Job Name";
            }

            // Fetch department
            $queryDepartment = "SELECT departmentName FROM department WHERE id = '$departmentId'";
            $resultDepartment = mysqli_query($conn, $queryDepartment);
            if ($resultDepartment && $resultDepartment->num_rows > 0) {
                $rowDepartment = mysqli_fetch_array($resultDepartment);
                $department = $rowDepartment['departmentName'];
            } else {
                $department = "Unknown Department";
            }

            // Fetch job status
            $queryJobStatus = "SELECT job_stat FROM job_status WHERE id = '$jobStatusId'";
            $resultJobStatus = mysqli_query($conn, $queryJobStatus);
            if ($resultJobStatus && $resultJobStatus->num_rows > 0) {
                $rowJobStatus = mysqli_fetch_array($resultJobStatus);
                $jobStatus = $rowJobStatus['job_stat'];
            } else {
                $jobStatus = "Unknown Job Status";
            }

            // Fetch working time
            $queryWorkingTime = "SELECT schedName, timeIn, timeOut FROM schedule WHERE id = '$workingTimeId'";
            $resultWorkingTime = mysqli_query($conn, $queryWorkingTime);
            if ($resultWorkingTime && $resultWorkingTime->num_rows > 0) {
                $rowWorkingTime = mysqli_fetch_array($resultWorkingTime);
                $working_time = $rowWorkingTime['schedName'] . ' ' . $rowWorkingTime['timeIn'] . ' - ' . $rowWorkingTime['timeOut'];
            } else {
                $working_time = "Unknown Working Time";
            }

            // Display job details
            echo '
            <div class="container">            
                <div class="card mb-2">
                <form action="../assets/applications.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6 d-flex align-items-stretch">
                            <div class="card-body flex-fill">
                            <h5 class="card-title mb-2"><strong>' . $jobName . '</strong></h5>
                            <h6><i class="fa-solid fa-location-dot"></i> ' . $location . '</h6>
                            <h6><i class="fa-solid fa-building"></i> ' . $department . '</h6>
                            <h6><i class="fa-solid fa-person-circle-check"></i> ' . $jobStatus . '</h6>
                            <h6><i class="fa-solid fa-list-ol"></i> ' . $item_count . '</h6>
                            <h6><i class="fa-solid fa-sack-dollar"></i> ' . $salary . '</h6>
                            
                            <br>
                            <div class="">
                                <h6><strong>About Job</strong></h6>
                                <p>' . $aboutJob . '</p>
                                <h6><strong>Responsibilities</strong></h6>
                                <p>' . $responsibilities . '</p>
                                <h6><strong>Educational/Experience</strong></h6>
                                <p>' . $educational . '</p>
                                <h6><strong>Skills</strong></h6>
                                <p>' . $skills . '</p>
                                <h6><strong>Working Schedule</strong></h6>
                                <p>' . $working_time . '</p>
                                <h6><strong>Benefits</strong></h6>
                                <p>' . $benefits . '</p>
                            </div>                            
                        </div>
                        </div>
                        <div class="col-sm-6 d-flex align-items-stretch">
                            <div class="card-body flex-fill">
                            <h5 class="card-title mb-2"><strong>Personal Information</strong></h5>
                                <div class="form-floating mb-2 mt-3">
                                    <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" value="' . $email . '" readonly>
                                    <label for="email">Email</label>
                                </div>
                                <div class="form-floating mb-2 mt-2">
                                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="' . $name . '" readonly>
                                    <label for="name">Name</label>
                                </div>
                                <div class="form-floating mb-2 mt-2">
                                    <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="phone" required>
                                    <label for="phone">Phone</label>
                                </div>
                                <div class="form-floating mb-2 mt-2">
                                    <input type="text" class="form-control" id="address" placeholder="Enter address" name="address" required>
                                    <label for="address">Address</label>
                                </div>
                                <div class="form-floating mb-2 mt-2">
                                    <input type="number" class="form-control" id="age" placeholder="Enter Age" name="age" required>
                                    <label for="age">Age</label>
                                </div>                               
                                <div class="form-floating mb-2 mt-2">
                                    <input type="text" class="form-control" id="yearExp" placeholder="Enter Year Experience" name="yearExp" required>
                                    <label for="yearExp">Experience</label>
                                </div>
                                <div class="form-floating mb-2 mt-2">
                                    <input type="file" class="form-control" id="resume" placeholder="Insert Resume" name="resume" required>
                                    <label for="resume">Resume</label>
                                </div>
                                <div class="form-floating mb-4 mt-2">
                                    <input type="file" class="form-control" id="coverLetter" placeholder="Insert Cover Letter" name="coverLetter" required>
                                    <label for="coverLetter">Cover Letter</label>
                                </div>
                                <input type="hidden" name="jobId" value="' . $jobIdCar . '">
                                
                                <button type="submit" class="btn btn-outline-primary">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary">Clear</button>
                                
                            </div>
                        </div>
                    </div>   
                    </form>                 
                </div>
            </div>
            ';
        } else {
            echo '<p>No job posting found for the given ID.</p>';
        }

        $stmt->close();
    } else {
        echo '<p>Error preparing the query.</p>';
    }
} else {
    echo '<p>No job ID provided in the URL.</p>';
}
?>

<?php

include("../footer.php");

?>