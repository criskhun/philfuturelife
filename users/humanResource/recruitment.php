<?php
$page_title = "Recruitment";
include("../header.php");
session_start();

?>

<div class="wrapper">
    <?php
    include("../sideNavbar.php"); //This is where you call the navbar
    ?>
    <div class="main">
        <?php
        include("../navbar.php"); // this is the navbar with profile
        ?>
        <main class="content px-3 py-4">
            <?php
            $activeTab = isset($_GET['activeTab']) ? $_GET['activeTab'] : 'dept';
            ?>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($activeTab == 'dept') ? 'active' : ''; ?> " data-bs-toggle="tab" href="#dept">Department</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($activeTab == 'jobStatus') ? 'active' : ''; ?> " data-bs-toggle="tab" href="#jobStatus">Job Status</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($activeTab == 'offices') ? 'active' : ''; ?>" data-bs-toggle="tab" href="#offices">Offices</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($activeTab == 'jobPosting') ? 'active' : ''; ?>" data-bs-toggle="tab" href="#jobPosting">Job Posting</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane <?php echo ($activeTab == 'dept') ? 'active' : 'fade'; ?>" id="dept">
                    <div class="row d-flex align-items-stretch">
                        <div class="col-sm-6 mb-2 mt-2">

                            <div class="card h-100">

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
                                    echo '<div class="alert alert-success alert-dismissible mx-2">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong>Success!</strong> ' . $_SESSION['success'] . '
                            </div>';
                                    unset($_SESSION['success']);
                                }
                                ?>
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDepartment">
                                            <i class="fa-solid fa-people-roof"></i>
                                            Add Department
                                        </button>
                                    </div>
                                    <form action="../departmentUpload.php" method="POST">
                                        <?php
                                        include_once("../../dbconn.php");
                                        $query = "SELECT * FROM department ORDER BY id DESC";
                                        $result = mysqli_query($conn, $query);
                                        if ($result->num_rows > 0) {
                                            while ($row = mysqli_fetch_array($result)) {
                                                $departmentName = $row['departmentName'];
                                                $departmentID = $row['id'];

                                                // Query to count the number of job_titles for the department
                                                $countQuery = "SELECT COUNT(*) as count FROM job_title WHERE department = '$departmentID'";
                                                $countResult = mysqli_query($conn, $countQuery);
                                                $countRow = mysqli_fetch_assoc($countResult);
                                                $departmentCount = $countRow['count'];

                                                echo '
                                                <div class="card card-sched mt-2 mt-2">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h5>' . $departmentName . '</h5>
                                                            </div>
                                                            <div class="col">
                                                                <h5><span class="badge bg-success">' . $departmentCount . '</span></h5>
                                                            </div>
                                                            <div class="col d-flex justify-content-end">
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deptModal" data-id="' . $departmentID . '" data-deptName="' . $departmentName . '"><i class="fa-solid fa-pen-to-square"></i></button>
                                                                    <form action="../departmentUpload.php" method="POST">
                                                                        <input type="hidden" name="deptID" value="' . $departmentID . '">
                                                                        <button type="submit" name="deptDelete" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                                    </form>
                                                                    <a href="?departmentID=' . urlencode($departmentID) . '" class="text-decoration-none">
                                                                        <input type="hidden" name="deptID" value="' . $departmentID . '">
                                                                        <button type="button" name="deptfilter" class="btn btn-outline-danger"><i class="fa-solid fa-forward"></i></button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            ';
                                            }
                                        }
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-2 mt-2">
                            <div class="card h-100">
                                <?php
                                if (isset($_SESSION['error1'])) {
                                    echo '<div class="container">
                            <div class="alert alert-danger alert-dismissible mt-2 mx-2">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong>Failed!</strong> ' . $_SESSION['error1'] . '
                            </div>
                            </div>';
                                    unset($_SESSION['error1']);
                                }

                                if (isset($_SESSION['success1'])) {
                                    echo '<div class="alert alert-success alert-dismissible mx-2">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong>Success!</strong> ' . $_SESSION['success1'] . '
                            </div>';
                                    unset($_SESSION['success1']);
                                }
                                ?>
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-end">
                                        <a href="recruitment.php" class="btn btn-primary me-2">
                                            <i class="fa-solid fa-spinner"></i>
                                            Load All
                                        </a>

                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addJobTitle">
                                            <i class="fa-solid fa-user-tie"></i>
                                            Add Job Title
                                        </button>
                                    </div>
                                    <form action="../departmentUpload.php" method="POST">
                                        <?php
                                        include_once("../../dbconn.php");

                                        // Get the department ID from the URL
                                        $departmentID = isset($_GET['departmentID']) ? intval($_GET['departmentID']) : 0;

                                        // Modify the query to filter by department ID if it's set
                                        $query = $departmentID > 0
                                            ? "SELECT * FROM job_title WHERE department = $departmentID ORDER BY id DESC"
                                            : "SELECT * FROM job_title ORDER BY id DESC";

                                        $result = mysqli_query($conn, $query);

                                        if ($result->num_rows > 0) {
                                            while ($row = mysqli_fetch_array($result)) {
                                                $jobname = $row['job_name'];
                                                $jobtitleID = $row['id'];
                                                $departmentID = $row['department'];

                                                $deptQuery = "SELECT departmentName FROM department WHERE id = $departmentID";
                                                $deptResult = mysqli_query($conn, $deptQuery);

                                                // Check if the department exists
                                                if ($deptResult && mysqli_num_rows($deptResult) > 0) {
                                                    $deptRow = mysqli_fetch_array($deptResult);
                                                    $departmentName = $deptRow['departmentName'];
                                                } else {
                                                    // If department is not found, set as Uncategorized
                                                    $departmentName = "Uncategorized";
                                                }

                                                echo '
                                            <div class="card card-sched mt-2 mt-2">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <h5>' . $departmentName . '</h5>
                                                        </div>
                                                        <div class="col">
                                                            <h5>' . $jobname . '</h5>
                                                        </div>
                                                        <div class="col d-flex justify-content-end">
                                                            <div class="btn-group">
                                                            <form action="../departmentUpload.php?activeTab=dept" method="POST">
                                                                <input type="hidden" id="jobID" name="jobID" value="' . $jobtitleID . '">
                                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#jobModal" data-id="' . $jobtitleID . '" data-jobName="' . $jobname . '" data-department="' . $departmentName . '"><i class="fa-solid fa-pen-to-square"></i></button>                                                            
                                                            </form>                                                        
                                                            <form action="../departmentUpload.php" method="POST">
                                                                <input type="hidden" id="jobID" name="jobID" value="' . $jobtitleID . '">
                                                                <button type="submit" name="jobDelete" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                            </form>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            ';
                                            }
                                        }
                                        $conn->close();
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane <?php echo ($activeTab == 'jobStatus') ? 'active' : 'fade'; ?>" id="jobStatus">
                    <div class="row d-flex align-items-stretch">
                        <div class="col-sm-6 mb-2 mt-2">
                            <div class="card h-100">
                                <?php
                                if (isset($_SESSION['error2'])) {
                                    echo '<div class="container">
                                <div class="alert alert-danger alert-dismissible mt-2 mx-2">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                <strong>Failed!</strong> ' . $_SESSION['error2'] . '
                                </div>
                                </div>';
                                    unset($_SESSION['error2']);
                                }

                                if (isset($_SESSION['success2'])) {
                                    echo '<div class="alert alert-success alert-dismissible mt-2 mx-2">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                <strong>Success!</strong> ' . $_SESSION['success2'] . '
                                </div>';
                                    unset($_SESSION['success2']);
                                }
                                ?>
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addJobStat">
                                            <i class="fa-solid fa-person-digging"></i>
                                            Add Job Status
                                        </button>
                                    </div>
                                    <form action="../departmentUpload.php" method="POST">
                                        <?php
                                        include("../../dbconn.php");

                                        $query = "SELECT * FROM job_status ORDER BY id DESC";

                                        $result = mysqli_query($conn, $query);
                                        if ($result->num_rows > 0) {
                                            while ($row = mysqli_fetch_array($result)) {
                                                $jobStat = $row['job_stat'];
                                                $jobStatId = $row['id'];

                                                echo '
                                            <form action="../departmentUpload.php" method="POST">
                                                <div class="card card-sched mt-2 mt-2">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h5>' . $jobStat . '</h5>
                                                            </div>
                                                            <div class="col">
                                                                <h5><span class="badge rounded-pill bg-primary">' . $jobStatId . '</span></h5>
                                                            </div>
                                                            <div class="col d-flex justify-content-end">
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#jobStatModal" data-id="' . $jobStatId . '" data-jobStat="' . $jobStat . '"><i class="fa-solid fa-pen-to-square"></i></button>
                                                                    <button type="submit" name="jobStatDelete" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="jobStatID" value="' . $jobStatId . '">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            ';
                                            }
                                        }
                                        $conn->close();
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-2 mt-2">
                            <div class="card h-100">
                                <?php
                                if (isset($_SESSION['error3'])) {
                                    echo '<div class="container">
                                <div class="alert alert-danger alert-dismissible mt-2 mx-2">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                <strong>Failed!</strong> ' . $_SESSION['error3'] . '
                                </div>
                                </div>';
                                    unset($_SESSION['error3']);
                                }

                                if (isset($_SESSION['success3'])) {
                                    echo '<div class="alert alert-success alert-dismissible mt-2 mx-2">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                <strong>Success!</strong> ' . $_SESSION['success3'] . '
                                </div>';
                                    unset($_SESSION['success3']);
                                }
                                ?>
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addtermination">
                                            <i class="fa-solid fa-user-slash"></i>
                                            Add Termination
                                        </button>
                                    </div>
                                    <form action="../departmentUpload.php" method="POST">
                                        <?php
                                        include("../../dbconn.php");

                                        $query = "SELECT * FROM termination_status ORDER BY id DESC";

                                        $result = mysqli_query($conn, $query);
                                        if ($result->num_rows > 0) {
                                            while ($row = mysqli_fetch_array($result)) {
                                                $termination = $row['termination'];
                                                $termID = $row['id'];

                                                echo '
                                            <form action="../departmentUpload.php" method="POST">
                                                <div class="card card-sched mt-2 mt-2">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h5>' . $termination . '</h5>
                                                            </div>
                                                            <div class="col">
                                                                <h5><span class="badge rounded-pill bg-primary">' . $termID . '</span></h5>
                                                            </div>
                                                            <div class="col d-flex justify-content-end">
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#termStatModal" data-id="' . $termID . '" data-termStat="' . $termination . '"><i class="fa-solid fa-pen-to-square"></i></button>
                                                                    <button type="submit" name="termStatDelete" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="termStatID" value="' . $termID . '">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            ';
                                            }
                                        }
                                        $conn->close();
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane <?php echo ($activeTab == 'offices') ? 'active' : 'fade'; ?>" id="offices">
                    <?php include("../assets/map.php"); ?>
                </div>
                <div class="tab-pane <?php echo ($activeTab == 'jobPosting') ? 'active' : 'fade'; ?>" id="jobPosting">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-auto">
                                <div style="display: flex; align-items: center;">
                                    <!--  -->
                                </div>
                            </div>
                            <div class="col-md-8 mt-2">
                                <div style="display: flex; flex-direction: column;">
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="text" class="form-control" id="searchJobPosting" placeholder="Search..." name="searchJobPosting">
                                        <label for="searchJobPosting">Search...</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-auto d-flex justify-content-end align-items-end">
                                <div class="text-right">
                                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addJobPosting"><i class="fa-solid fa-briefcase"></i> Add Job Posting</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <?php
                            if (isset($_SESSION['error4'])) {
                                echo '<div class="container">
                                <div class="alert alert-danger alert-dismissible mt-2 mx-2">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                <strong>Failed!</strong> ' . $_SESSION['error4'] . '
                                </div>
                                </div>';
                                unset($_SESSION['error4']);
                            }

                            if (isset($_SESSION['success4'])) {
                                echo '<div class="alert alert-success alert-dismissible mt-2 mx-2">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                <strong>Success!</strong> ' . $_SESSION['success4'] . '
                                </div>';
                                unset($_SESSION['success4']);
                            }
                            ?>
                            <div id="accordion">
                                <?php
                                include("../../dbconn.php");

                                $query = "SELECT * FROM job_posting ORDER BY id DESC";

                                $result = mysqli_query($conn, $query);
                                if ($result->num_rows > 0) {
                                    while ($row = mysqli_fetch_array($result)) {
                                        $jobPostId = $row['id'];
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

                                        echo '
                                            <form action="../departmentUpload.php" method="POST">
                                               <div class="card">
                                                    <div class="card-header text-light ' . ($active == 1 ? 'bg-info' : 'bg-secondary') . '"> 
                                                        <a class="btn" data-bs-toggle="collapse" href="#' . $jobPostId . '">
                                                            <div class="row">
                                                                <div class="col-sm-auto"><strong>' . $jobName . '</strong></div>
                                                                <div class="col-sm-auto">' . $department . '</div>
                                                                <div class="col-sm-auto">' . $location . '</div>
                                                            </div>
                                                            
                                                        </a>
                                                    </div>
                                                    <div id="' . $jobPostId . '" class="collapse" data-bs-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <i class="fa-solid fa-person-circle-check"></i>
                                                                    ' . $jobStatus . '
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <i class="fa-solid fa-list-ol"></i>
                                                                    ' . $item_count . ' Vacant
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <i class="fa-solid fa-sack-dollar"></i>
                                                                    ' . $salary . '
                                                                </div>
                                                            </div>
                                                            <div class="mt-4 mb-2">
                                                                <h6>About Job</h6>
                                                                <p>' . $aboutJob . '</p>
                                                            </div>
                                                            <div class="mt-2 mb-2">
                                                                <h6>Responsibilities</h6>
                                                                <p>' . $responsibilities . '</p>
                                                            </div>
                                                            <div class="mt-2 mb-2">
                                                                <h6>Educational</h6>
                                                                <p>' . $educational . '</p>
                                                            </div>
                                                            <div class="mt-2 mb-2">
                                                                <h6>Skills</h6>
                                                                <p>' . $skills . '</p>
                                                            </div>
                                                            <div class="mt-2 mb-2">
                                                                <h6>Schedule</h6>
                                                                <p>' . $working_time . '</p>
                                                            </div>
                                                            <div class="mt-2 mb-2">
                                                                <h6>Benefits</h6>
                                                                <p>' . $benefits . '</p>
                                                            </div>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input job-posting-toggle" type="checkbox" id="activeJP' . $jobPostId . '" name="activeJP" value="yes" ' . ($active == 1 ? 'checked' : '') . ' data-id="' . $jobPostId . '">
                                                                <label class="form-check-label" for="activeJP' . $jobPostId . '">Active</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </form>
                                            ';
                                    }
                                }

                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Add Job Posting -->
<div class="modal" id="addJobPosting">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="../departmentUpload.php" method="POST">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">New Job Posting</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <?php
                    include_once("../../dbconn.php");
                    $sql = "SELECT id, departmentName FROM department";
                    $result = $conn->query($sql);

                    $sql2 = "SELECT id, job_name FROM job_title";
                    $result2 = $conn->query($sql2);

                    $sql3 = "SELECT id, job_stat FROM job_status";
                    $result3 = $conn->query($sql3);

                    $sql4 = "SELECT id, name FROM branch_location";
                    $result4 = $conn->query($sql4);

                    $sql5 = "SELECT id, schedName, timeIn, timeOut FROM schedule";
                    $result5 = $conn->query($sql5);
                    ?>
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <div class="form-floating">
                                <select class="form-select" id="deptsel" name="deptlist" onchange="filterJobTitles()">
                                    <option class="" value="">Please select</option>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["id"] . '">' . $row["departmentName"] . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">No departments available</option>';
                                    }
                                    ?>
                                </select>
                                <label for="deptsel" class="form-label">Select Department:</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating">
                                <select class="form-select" id="jobsel" name="joblist">
                                    
                                </select>
                                <label for="jobsel" class="form-label">Select Job Title:</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <div class="form-floating">
                                <select class="form-select" id="jobStatsel" name="jobStatlist">
                                    <?php
                                    if ($result3->num_rows > 0) {
                                        while ($row3 = $result3->fetch_assoc()) {
                                            echo '<option value="' . $row3["id"] . '">' . $row3["job_stat"] . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">No Job Status available</option>';
                                    }

                                    ?>
                                </select>
                                <label for="jobStatsel" class="form-label">Select Job Status:</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating">
                                <select class="form-select" id="branchsel" name="branchlist">
                                    
                                    <?php
                                    if ($result4->num_rows > 0) {
                                        while ($row4 = $result4->fetch_assoc()) {
                                            echo '<option value="' . $row4["id"] . '">' . $row4["name"] . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">No Branch Location available</option>';
                                    }
                                    ?>
                                </select>
                                <label for="branchsel" class="form-label">Select Branch Location:</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="itemCount" placeholder="Vacant" name="itemCount" required>
                                <label for="itemCount" class="form-label">Vacant:</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="pay" placeholder="Pay" name="pay" required>
                                <label for="pay" class="form-label">Pay:</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-floating mb-2">
                        <textarea class="form-control" id="aboutJob" name="aboutJob" placeholder="About Job"></textarea>
                        <label for="aboutJob">About Job</label>
                    </div>
                    <div class="form-floating mb-2">
                        <textarea class="form-control" id="responsibility" name="responsibility" placeholder="Responsibility"></textarea>
                        <label for="responsibility">Responsibility</label>
                    </div>
                    <div class="form-floating mb-2">
                        <textarea class="form-control" id="educational" name="educational" placeholder="Educational"></textarea>
                        <label for="educational">Educational</label>
                    </div>
                    <div class="form-floating mb-2">
                        <textarea class="form-control" id="skills" name="skills" placeholder="Skills"></textarea>
                        <label for="skills">Skills</label>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <div class="form-floating">
                                <select class="form-select" id="schedsel" name="schedlist">
                                    <?php
                                    if ($result5->num_rows > 0) {
                                        while ($row5 = $result5->fetch_assoc()) {
                                            echo '<option value="' . $row5["id"] . '">' . $row5["schedName"] . " " . $row5["timeIn"] . " - " . $row5["timeOut"] . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">No Schedule available</option>';
                                    }
                                    $conn->close();
                                    ?>
                                </select>
                                <label for="schedsel" class="form-label">Select Schedule:</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-2">
                                <textarea class="form-control" id="benefits" name="benefits" placeholder="Benefits"></textarea>
                                <label for="benefits">Benefits</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="InsertJobPosting"><i class="fa-solid fa-thumbtack"></i> Post</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add department -->
<div class="modal" id="addDepartment">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../departmentUpload.php" method="POST">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">New Department</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="newDepartment" placeholder="Department" name="newDepartment" required>
                        <label for="newDepartment">Department</label>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="InsertDepartment">Add</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Department -->
<div class="modal fade" id="deptModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="updateForm" action="../departmentUpload.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="departmentModalLabel">Department Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-2">
                        <input class="form-control mt-1" type="text" id="modalDeptName" name="deptName" placeholder="Department">
                        <label for="deptName">Department</label>
                    </div>
                    <input type="hidden" id="modalDeptID" name="deptID">
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" type="submit" value="Update" name="updateDept">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add JobTitles -->
<div class="modal" id="addJobTitle">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../departmentUpload.php" method="POST">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">New Job Title</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <?php
                include("../../dbconn.php");

                ?>
                <!-- Modal body -->
                <div class="modal-body">
                    <?php
                    include_once("../../dbconn.php");
                    $sql = "SELECT id, departmentName FROM department";
                    $result = $conn->query($sql);
                    ?>
                    <div class="form-floating">
                        <select class="form-select" id="deptsel" name="deptlist">
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row["id"] . '">' . $row["departmentName"] . '</option>';
                                }
                            } else {
                                echo '<option value="">No departments available</option>';
                            }
                            $conn->close();
                            ?>
                        </select>
                        <label for="deptsel" class="form-label">Select Department (select one):</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="newJobTitle" placeholder="Department" name="newJobTitle" required>
                        <label for="newJobTitle">Job Title</label>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="InsertJobTitle">Add</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update JobTitles -->
<div class="modal fade" id="jobModal" tabindex="-1" aria-labelledby="jobTitleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="updateForm" action="../departmentUpload.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="departmentModalLabel">Job Title Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?php
                include("../../dbconn.php");

                ?>
                <div class="modal-body">
                    <?php
                    include_once("../../dbconn.php");
                    $sql = "SELECT id, departmentName FROM department";
                    $result = $conn->query($sql);
                    ?>
                    <div class="form-floating">
                        <select class="form-select" id="deptsel" name="deptlist">
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row["departmentName"] . '">' . $row["departmentName"] . '</option>';
                                }
                            } else {
                                echo '<option value="">No departments available</option>';
                            }
                            $conn->close();
                            ?>
                        </select>
                        <label for="deptsel" class="form-label">Select Department (select one):</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input class="form-control mt-1" type="text" id="modalJobName" name="jobName" placeholder="Job Title">
                        <label for="jobName">Job Title</label>
                    </div>
                    <input type="hidden" id="modalJobID" name="jobID">
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" type="submit" value="Update" name="updateJob">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add JobStatus -->
<div class="modal" id="addJobStat">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../departmentUpload.php" method="POST">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">New Job Status</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="newJobStat" placeholder="New Job Status" name="newJobStat" required>
                        <label for="newJobStat">New Job Status</label>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="InsertJobStat">Add</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update JobStatus -->
<div class="modal fade" id="jobStatModal" tabindex="-1" aria-labelledby="jobStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="updateForm" action="../departmentUpload.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="departmentModalLabel">Job Status Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?php
                include("../../dbconn.php");

                ?>
                <div class="modal-body">
                    <div class="form-floating mb-2">
                        <input class="form-control mt-1" type="text" id="modalJobStat" name="jobStat" placeholder="Job Status">
                        <label for="jobStat">Job Status</label>
                    </div>
                    <input type="hidden" id="modalJobStatID" name="jobStatID">
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" type="submit" value="Update" name="updateJobStat">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Termination Status -->
<div class="modal" id="addtermination">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../departmentUpload.php" method="POST">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">New Termination Status</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="newTermStat" placeholder="New Job Status" name="newTermStat" required>
                        <label for="newTermStat">New Termination Status</label>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="InsertTermStat">Add</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update TerminationStatus -->
<div class="modal fade" id="termStatModal" tabindex="-1" aria-labelledby="termStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="updateForm" action="../departmentUpload.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="terminationModalLabel">Termination Status Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?php
                include("../../dbconn.php");

                ?>
                <div class="modal-body">
                    <div class="form-floating mb-2">
                        <input class="form-control mt-1" type="text" id="modalTermStat" name="termStat" placeholder="Termination Status">
                        <label for="termStat">Termination Status</label>
                    </div>
                    <input type="hidden" id="modalTermStatID" name="termStatID">
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" type="submit" value="Update" name="updateTermStat">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

</main>
<?php
include("../usersFooter.php")
?>
</div>
</div>

<!-- fetch job titles from department -->
<script>
    function filterJobTitles() {
        var departmentId = document.getElementById("deptsel").value;

        $.ajax({
            url: '../departmentUpload.php', // PHP script to fetch job titles
            type: 'POST',
            data: {
                departmentId: departmentId
            },
            success: function(response) {
                // Update the job titles select box with the response
                $('#jobsel').html(response);
            },
            error: function(xhr, status, error) {
                console.error(error); // Handle any errors
            }
        });
    }
</script>

<!-- toggle to active inactive job posting -->
<script>
    $(document).ready(function() {
        $('.job-posting-toggle').change(function() {
            var jobPostId = $(this).data('id'); // Get the job post ID from the data-id attribute
            var isActive = $(this).is(':checked') ? 1 : 0; // Determine the new active status
            var cardHeader = $(this).closest('.card').find('.card-header'); // Get the card header

            // Update the background color based on the active status
            if (isActive) {
                cardHeader.removeClass('bg-secondary').addClass('bg-info');
            } else {
                cardHeader.removeClass('bg-info').addClass('bg-secondary');
            }

            $.ajax({
                url: '../assets/update_jobPosting_active.php', // The PHP script to handle the update
                type: 'POST',
                data: {
                    id: jobPostId,
                    active: isActive
                },
                success: function(response) {
                    console.log(response); // Optional: handle the response
                },
                error: function(xhr, status, error) {
                    console.error(error); // Optional: handle errors
                }
            });
        });
    });
</script>


<!-- Department Modal Call Value -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select all update buttons with data attributes
        var updateButtons = document.querySelectorAll('[data-bs-toggle="modal"][data-id]');

        // Loop through each update button and attach event listener
        updateButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Extract department name and ID from data attributes
                var departmentName = button.getAttribute('data-deptName');
                var departmentID = button.getAttribute('data-id');

                // Populate modal fields with department data
                document.getElementById('modalDeptName').value = departmentName;
                document.getElementById('modalDeptID').value = departmentID;
            });
        });

        updateButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Extract department name and ID from data attributes
                var departmentName = button.getAttribute('data-jobName');
                var departmentID = button.getAttribute('data-id');

                // Populate modal fields with department data
                document.getElementById('modalJobName').value = jobTitleName;
                document.getElementById('modalJobID').value = jobTitleID;
            });
        });
    });
</script>
<!-- Job Title Modal Call Value -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var jobModal = document.getElementById('jobModal');
        jobModal.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            var button = event.relatedTarget;

            // Extract info from data-* attributes
            var jobId = button.getAttribute('data-id');
            var jobName = button.getAttribute('data-jobname');
            var department = button.getAttribute('data-department');

            // Update the modal's content
            var modalJobIDInput = jobModal.querySelector('#modalJobID');
            var modalJobNameInput = jobModal.querySelector('#modalJobName');
            var modalDepartmentSelect = jobModal.querySelector('#deptsel');

            modalJobIDInput.value = jobId;
            modalJobNameInput.value = jobName;

            // Select the appropriate department in the dropdown
            for (var i = 0; i < modalDepartmentSelect.options.length; i++) {
                if (modalDepartmentSelect.options[i].text === department) {
                    modalDepartmentSelect.selectedIndex = i;
                    break;
                }
            }
        });
    });
</script>
<!-- Job Status Modal Call Value -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var jobStatModal = document.getElementById('jobStatModal');
        jobStatModal.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            var button = event.relatedTarget;
            // Extract info from data-* attributes
            var jobStatId = button.getAttribute('data-id');
            var jobStat = button.getAttribute('data-jobStat');

            // Update the modal's content
            var modalJobStat = jobStatModal.querySelector('#modalJobStat');
            var modalJobStatID = jobStatModal.querySelector('#modalJobStatID');

            modalJobStat.value = jobStat;
            modalJobStatID.value = jobStatId;
        });
    });
</script>
<!-- Termination Status Modal Call Value -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var jobStatModal = document.getElementById('termStatModal');
        jobStatModal.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            var button = event.relatedTarget;
            // Extract info from data-* attributes
            var termStatId = button.getAttribute('data-id');
            var termStat = button.getAttribute('data-termStat');

            // Update the modal's content
            var modalTermStat = termStatModal.querySelector('#modalTermStat');
            var modalTermStatID = termStatModal.querySelector('#modalTermStatID');

            modalTermStat.value = termStat;
            modalTermStatID.value = termStatId;
        });
    });
</script>



<?php

include("../footer.php");

?>