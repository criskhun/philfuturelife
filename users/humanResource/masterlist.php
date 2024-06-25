<?php
$page_title = "Dashboard";
include("../header.php");

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
            $activeTab = isset($_GET['activeTab']) ? $_GET['activeTab'] : 'Candidate';
            ?>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($activeTab == 'Candidate') ? 'active' : ''; ?> " data-bs-toggle="tab" href="#Candidate">Candidate</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($activeTab == 'Masterlist') ? 'active' : ''; ?> " data-bs-toggle="tab" href="#Masterlist">Masterlist</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane <?php echo ($activeTab == 'Candidate') ? 'active' : 'fade'; ?>" id="Candidate">
                    <div class="col-sm-12 mb-2 mt-2">
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
                                echo '<div class="alert alert-success alert-dismissible mt-2 mx-2">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <strong>Success!</strong> ' . $_SESSION['success'] . '
                                        </div>';
                                unset($_SESSION['success']);
                            }
                            ?>
                            <div class="card-header">
                                <h5>Candidate Table</h5>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3 mt-3">
                                                <input type="text" class="form-control" id="search" placeholder="Search" name="search">
                                                <label for="search">Search...</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input custom-checkboxPending" type="checkbox" id="pending" name="pending" value="yes" checked>
                                                <label class="form-check-label" for="pending">Pending</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input custom-checkbox" type="checkbox" id="approved" name="approved" value="yes" checked>
                                                <label class="form-check-label" for="approved">Approved</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input custom-checkboxDrop" type="checkbox" id="drop" name="drop" value="yes" checked>
                                                <label class="form-check-label" for="drop">Drop</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-bordered table-hover">
                                    <thead class="table-primary">
                                        <tr>
                                            <th class="text-center">Job Position</th>
                                            <th class="text-center">Branch</th>
                                            <th class="text-center">Department</th>
                                            <th class="text-center">Job Status</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Phone</th>
                                            <th class="text-center">Address</th>
                                            <th class="text-center">Age</th>
                                            <th class="text-center">Experience</th>
                                            <th class="text-center">Resume</th>
                                            <th class="text-center">Cover Letter</th>
                                            <th class="text-center">Application Status</th>
                                            <th class="text-center">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include_once("../../dbconn.php");
                                        $query = "SELECT * FROM candidate_table ORDER BY id ASC";
                                        $result = mysqli_query($conn, $query);
                                        if ($result->num_rows > 0) {
                                            while ($row = mysqli_fetch_array($result)) {
                                                $candID = $row['id'];
                                                $jobPost = $row['job_position'];
                                                $branch = $row['branch'];
                                                $departmentId = $row['department'];
                                                $job_statusId = $row['job_status'];
                                                $email = $row['email'];
                                                $name = $row['name'];
                                                $phone = $row['phone'];
                                                $address = $row['address'];
                                                $age = $row['age'];
                                                $experience = $row['experience'];
                                                $resume = $row['resume'];
                                                $cover_letter = $row['cover_letter'];
                                                $application_status = $row['application_status'];

                                                // Fetch job name
                                                $queryJobName = "SELECT job_name FROM job_title WHERE id = '$jobPost'";
                                                $resultJobName = mysqli_query($conn, $queryJobName);
                                                if ($resultJobName && $resultJobName->num_rows > 0) {
                                                    $rowJobName = mysqli_fetch_array($resultJobName);
                                                    $jobName = $rowJobName['job_name'];
                                                } else {
                                                    $jobName = "Unknown Job Name";
                                                }

                                                // Fetch location
                                                $queryLocation = "SELECT name FROM branch_location WHERE id = '$branch'";
                                                $resultLocation = mysqli_query($conn, $queryLocation);
                                                if ($resultLocation && $resultLocation->num_rows > 0) {
                                                    $rowLocation = mysqli_fetch_array($resultLocation);
                                                    $location = $rowLocation['name'];
                                                } else {
                                                    $location = "Unknown Location";
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
                                                $queryJobStatus = "SELECT job_stat FROM job_status WHERE id = '$job_statusId'";
                                                $resultJobStatus = mysqli_query($conn, $queryJobStatus);
                                                if ($resultJobStatus && $resultJobStatus->num_rows > 0) {
                                                    $rowJobStatus = mysqli_fetch_array($resultJobStatus);
                                                    $jobStatus = $rowJobStatus['job_stat'];
                                                } else {
                                                    $jobStatus = "Unknown Job Status";
                                                }

                                                //badge changer
                                                $badge_class = 'bg-warning'; // default

                                                if ($application_status == 'accept') {
                                                    $badge_class = 'bg-success';
                                                } elseif ($application_status == 'drop') {
                                                    $badge_class = 'bg-secondary';
                                                }
                                        ?>
                                                <tr data-id="<?php echo $candID ?>" data-jobpost="<?php echo $jobName ?>" data-branch="<?php echo $location ?>" data-department="<?php echo $department ?>" data-jobstat="<?php echo $jobStatus ?>" data-email="<?php echo $email ?>" data-name="<?php echo $name ?>" data-phone="<?php echo $phone ?>" data-address="<?php echo $address ?>" data-age="<?php echo $age ?>" data-experience="<?php echo $experience ?>" data-resume="<?php echo $resume ?>" data-cover="<?php echo $cover_letter ?>" data-appstat="<?php echo $application_status ?>">
                                                    <td hidden><?php echo $candID ?></td>
                                                    <td><?php echo $jobName ?></td>
                                                    <td><?php echo $location ?></td>
                                                    <td><?php echo $department ?></td>
                                                    <td><?php echo $jobStatus ?></td>
                                                    <td><?php echo $email ?></td>
                                                    <td><?php echo $name ?></td>
                                                    <td><?php echo $phone ?></td>
                                                    <td><?php echo $address ?></td>
                                                    <td><?php echo $age ?></td>
                                                    <td><?php echo $experience ?></td>
                                                    <td>
                                                        <?php if (!empty($resume)) { ?>
                                                            <a href="#" data-document-url="<?php echo $resume; ?>" class="document-link" data-bs-toggle="modal" data-bs-target="#documentViewer">
                                                                <i class="fas fa-file-alt" style="font-size: 2em;"></i>
                                                            </a>
                                                        <?php } else { ?>
                                                            <i class="fas fa-times-circle" style="font-size: 2em;"></i>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if (!empty($cover_letter)) { ?>
                                                            <a href="#" data-document-url="<?php echo $cover_letter; ?>" class="document-link" data-bs-toggle="modal" data-bs-target="#documentViewer">
                                                                <i class="fas fa-file-alt" style="font-size: 2em; color: red;"></i>
                                                            </a>
                                                        <?php } else { ?>
                                                            <i class="fas fa-times-circle" style="font-size: 2em;"></i>
                                                        <?php } ?>
                                                    </td>
                                                    <td><span class="badge rounded-pill <?php echo $badge_class ?>"><?php echo $application_status ?></span></td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-outline-success open-modal" data-bs-toggle="modal" data-bs-target="#applicantUpdater">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="tab-pane <?php echo ($activeTab == 'Masterlist') ? 'active' : 'fade'; ?>" id="Masterlist">
                    <div class="row mb-4">
                        <div class="col-sm-8 mt-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">

                                            <input type="text" class="form-control" id="mlSearch" placeholder="Search..." name="mlSearch">
                                        </div>
                                        <div class="col">
                                            <?php
                                            include_once("../../dbconn.php");
                                            $sql = "SELECT id, departmentName FROM department";
                                            $result = $conn->query($sql);

                                            $sql3 = "SELECT id, job_stat FROM job_status";
                                            $result3 = $conn->query($sql3);
                                            ?>
                                            <select class="form-select" id="deptsel" name="deptlist">
                                                <option class="" value="">Filter Department</option>
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

                                        </div>
                                        <div class="col">
                                            <select class="form-select" id="jobStatsel" name="jobStatlist">
                                                <option class="" value="">Filter Job Status</option>
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

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 mt-2">
                            <div class="card">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="highlight">
                                    <th scope="col">Name</th>
                                    <th scope="col">Email/Account</th>
                                    <th scope="col">Employee ID</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Job Title</th>
                                    <th scope="col">Job Status</th>
                                    <th scope="col">Basic Salary</th>
                                    <th scope="col">Allowance</th>
                                    <th scope="col">Date Hired</th>
                                    <th scope="col" class="sticky-col">Active/Inactive</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include_once("../../dbconn.php");
                                $query = "SELECT * FROM masterlist_table ORDER BY id ASC";
                                $result = mysqli_query($conn, $query);
                                if ($result->num_rows > 0) {
                                    while ($row = mysqli_fetch_array($result)) {
                                        $id = $row['id'];
                                        $name = $row['emp_full_name'];
                                        $image = $row['emp_picture'];
                                        $email = $row['emp_email'];
                                        $empId = $row['emp_id'];
                                        $department = $row['emp_department'];
                                        $jobTitle = $row['emp_position'];
                                        $jobStat = $row['emp_status'];
                                        $basicSalary = $row['emp_salary'];
                                        $allowance = $row['emp_allowance'];
                                        $dateHired = $row['emp_date_hired'];
                                        $active = $row['active'];

                                        // Create DateTime objects for the current date and the hiring date
                                        $hiringDate = new DateTime($dateHired);
                                        $currentDate = new DateTime();

                                        // Calculate the difference
                                        $interval = $currentDate->diff($hiringDate);

                                        // Get the total years, months, and days
                                        $years = $interval->y;
                                        $months = $interval->m;
                                        $days = $interval->d;

                                        // Format the output string
                                        $totalHiredDuration = '';
                                        if ($years > 0) {
                                            $totalHiredDuration .= $years . ' Year' . ($years > 1 ? 's' : '');
                                        }
                                        if ($months > 0) {
                                            if (!empty($totalHiredDuration)) $totalHiredDuration .= ', ';
                                            $totalHiredDuration .= $months . ' Month' . ($months > 1 ? 's' : '');
                                        }
                                        if ($days > 0) {
                                            if (!empty($totalHiredDuration)) $totalHiredDuration .= ', ';
                                            $totalHiredDuration .= $days . ' Day' . ($days > 1 ? 's' : '');
                                        }

                                ?>
                                        <tr>
                                            <td class="goto-task">
                                                <a href="" data-bs-toggle="modal" data-bs-target="#employeeModal" 
                                                data-name="<?php echo $name ?>" 
                                                data-email="<?php echo $email ?>" 
                                                data-empid="<?php echo $empId ?>" 
                                                data-department="<?php echo $department ?>" 
                                                data-jobtitle="<?php echo $jobTitle ?>" 
                                                data-jobstat="<?php echo $jobStat ?>" 
                                                data-basicsalary="<?php echo $basicSalary ?>" 
                                                data-allowance="<?php echo $allowance ?>" 
                                                data-datehired="<?php echo $dateHired ?>" 
                                                data-active="<?php echo $active ?>">
                                                    <img src="../assets/profile_cover/<?php echo $image ?>" alt="" class="small-profile">
                                                    <span class="profile-name"><?php echo $name ?></span>
                                                </a>
                                            </td>
                                            <td><?php echo $email ?></td>
                                            <td><?php echo $empId ?></td>
                                            <td><?php echo $department ?></td>
                                            <td><?php echo $jobTitle ?></td>
                                            <td><?php echo $jobStat ?></td>
                                            <td><?php echo $basicSalary ?></td>
                                            <td><?php echo $allowance ?></td>
                                            <td><?php echo $dateHired ?> <span class="badge bg-primary"><?php echo $totalHiredDuration; ?></span></td>
                                            <td class="sticky-col"><span class="badge bg-success"><?php echo $active == 1 ? "active" : "inactive"; ?></span></td>
                                        </tr>

                            </tbody>
                    <?php
                                    }
                                }
                    ?>
                        </table>
                    </div>
                </div>

            </div>


        </main>
        <?php
        include("../usersFooter.php")
        ?>
    </div>
</div>

<!-- Calling the masterlist employee -->
<div class="modal fade" id="employeeModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Employee Basic Details</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

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
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-floating mb-3 mt-3">
                            <input type="text" class="form-control" id="empname" placeholder="Name" name="empname" readonly>
                            <label for="empname">Name</label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-floating mb-3 mt-3">
                            <input type="text" class="form-control" id="empemail" placeholder="Email" name="empemail" readonly>
                            <label for="empemail">Email</label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-floating mb-3 mt-3">
                            <input type="text" class="form-control" id="empid" placeholder="Employee ID" name="empid" readonly>
                            <label for="empid">Employee ID</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-floating">                            
                            <select class="form-select" id="empdeptsel" name="empdeptlist" onchange="empfilterJobTitles()">
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
                                <label for="empdeptsel" class="form-label">Select Department:</label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-floating">
                            <select class="form-select" id="empjobsel" name="empjoblist">
                                <!-- Populate this dynamically -->
                            </select>
                            <label for="empjobsel" class="form-label">Select Job Title:</label>                            
                        </div>
                    </div>
                    <div class="col-sm-4">
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
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-floating mb-3 mt-3">
                            <input type="text" class="form-control" id="empbasic" placeholder="Employee Basic Salary" name="empbasic">
                            <label for="empbasic">Basic Salary</label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-floating mb-3 mt-3">
                            <input type="text" class="form-control" id="empallowance" placeholder="Employee Allowance" name="empallowance">
                            <label for="empallowance">Employee Allowance</label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-floating mb-3 mt-3">
                            <input type="date" class="form-control" id="empdate" placeholder="Date Hired" name="empdate">
                            <label for="empdate">Date Hired</label>
                        </div>
                    </div>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="empactive" name="empactive" value="yes" checked>
                    <label class="form-check-label" for="empactive">Active?</label>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- The Applicant Updater -->
<div class="modal fade" id="applicantUpdater">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="../assets/candidate_masterlist.php" method="POST" enctype="multipart/form-data" style="display:inline;">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Applicant Review</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="modalId" placeholder="Name" name="candID" readonly>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-2 mt-2">
                                <input type="text" class="form-control" id="modalName" placeholder="Name" name="name" readonly>
                                <label for="modalName">Name</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-2 mt-2">
                                <input type="text" class="form-control" id="modalEmail" placeholder="Email" name="email" readonly>
                                <label for="modalEmail">Email</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-2 mt-2">
                                <input type="text" class="form-control" id="modalJobPost" placeholder="Job Position" name="jobPost" readonly>
                                <label for="modalJobPost">Job Position</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-2 mt-2">
                                <input type="text" class="form-control" id="modalDepartment" placeholder="Department" name="department" readonly>
                                <label for="modalDepartment">Department</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-2 mt-2">
                                <input type="text" class="form-control" id="modalJobStat" placeholder="Job Status" name="jobStat" readonly>
                                <label for="modalJobStat">Job Status</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-2 mt-2">
                                <input type="text" class="form-control" id="modalBranch" placeholder="Branch" name="branch" readonly>
                                <label for="modalBranch">Branch</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-2 mt-2">
                                <input type="text" class="form-control" id="modalPhone" placeholder="Phone" name="phone" readonly>
                                <label for="modalPhone">Phone</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-2 mt-2">
                                <input type="text" class="form-control" id="modalAddress" placeholder="Address" name="address" readonly>
                                <label for="modalAddress">Address</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-2 mt-2">
                                <input type="number" class="form-control" id="modalAge" placeholder="Age" name="age" readonly>
                                <label for="modalAge">Age</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-2 mt-2">
                                <input type="text" class="form-control" id="modalExperience" placeholder="Experience" name="experience" readonly>
                                <label for="modalExperience">Experience</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <iframe id="modalResume" src="" frameborder="0" style="width:100%; height:500px;"></iframe>
                        </div>
                        <div class="col-sm-6">
                            <iframe id="modalCoverLetter" src="" frameborder="0" style="width:100%; height:500px;"></iframe>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="approved">Approve</button>
                    <button type="submit" class="btn btn-secondary" name="dropped">Drop</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- The Document Viewer -->
<div class="modal fade" id="documentViewer">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Document Viewer</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div id="documentContent"></div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<style>
    .custom-checkbox:checked {
        background-color: #00C430;
        /* Change this to your desired color */
        border-color: #00C430;
        /* Change this to your desired color */
    }

    .custom-checkboxPending:checked {
        background-color: #FAC614;
        /* Change this to your desired color */
        border-color: #FAC614;
        /* Change this to your desired color */
    }

    .custom-checkboxDrop:checked {
        background-color: #D8D8D8;
        /* Change this to your desired color */
        border-color: #D8D8D8;
        /* Change this to your desired color */
    }
</style>

<!-- masterlist data to modal -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var employeeModal = document.getElementById('employeeModal');
        employeeModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var name = button.getAttribute('data-name');
            var email = button.getAttribute('data-email');
            var empId = button.getAttribute('data-empid');
            var department = button.getAttribute('data-department');
            var jobTitle = button.getAttribute('data-jobtitle');
            var jobStat = button.getAttribute('data-jobstat');
            var basicSalary = button.getAttribute('data-basicsalary');
            var allowance = button.getAttribute('data-allowance');
            var dateHired = button.getAttribute('data-datehired');
            var active = button.getAttribute('data-active');

            // Update the modal's content with the data
            document.getElementById('empname').value = name;
            document.getElementById('empemail').value = email;
            document.getElementById('empid').value = empId;
            document.getElementById('empbasic').value = basicSalary;
            document.getElementById('empallowance').value = allowance;
            document.getElementById('empdate').value = dateHired;
            document.getElementById('empactive').checked = (active === '1');
            
            // Set department and job title selects
            document.getElementById('empdeptsel').value = department;
            document.getElementById('empjobsel').value = jobTitle;
            document.getElementById('jobStatsel').value = jobStat;
        });
    });
</script>


<!-- fetch job titles from department -->
<script>
    function empfilterJobTitles() {
        var departmentId = document.getElementById("empdeptsel").value;

        $.ajax({
            url: '../departmentUpload.php', // PHP script to fetch job titles
            type: 'POST',
            data: {
                departmentId: departmentId
            },
            success: function(response) {
                // Update the job titles select box with the response
                $('#empjobsel').html(response);
            },
            error: function(xhr, status, error) {
                console.error(error); // Handle any errors
            }
        });
    }
</script>

<!-- pass the data -->
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('.open-modal').forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');

                const id = row.getAttribute('data-id');
                const name = row.getAttribute('data-name');
                const email = row.getAttribute('data-email');
                const jobPost = row.getAttribute('data-jobpost');
                const department = row.getAttribute('data-department');
                const jobStat = row.getAttribute('data-jobstat');
                const branch = row.getAttribute('data-branch');
                const phone = row.getAttribute('data-phone');
                const address = row.getAttribute('data-address');
                const age = row.getAttribute('data-age');
                const experience = row.getAttribute('data-experience');
                const resume = row.getAttribute('data-resume');
                const coverLetter = row.getAttribute('data-cover');

                document.getElementById('modalId').value = id;
                document.getElementById('modalName').value = name;
                document.getElementById('modalEmail').value = email;
                document.getElementById('modalJobPost').value = jobPost;
                document.getElementById('modalDepartment').value = department;
                document.getElementById('modalJobStat').value = jobStat;
                document.getElementById('modalBranch').value = branch;
                document.getElementById('modalPhone').value = phone;
                document.getElementById('modalAddress').value = address;
                document.getElementById('modalAge').value = age;
                document.getElementById('modalExperience').value = experience;
                document.getElementById('modalResume').src = "../assets/" + resume;
                document.getElementById('modalCoverLetter').src = "../assets/" + coverLetter;
            });
        });
    });
</script>
<!-- show the image/document from table -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const documentViewerModal = document.getElementById('documentViewer');
        const documentContent = document.getElementById('documentContent');

        document.querySelectorAll('.document-link').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const documentUrl = this.getAttribute('data-document-url');
                documentContent.innerHTML = `<iframe src="../assets/${documentUrl}" frameborder="0" style="width:100%; height:500px;"></iframe>`;
            });
        });
    });
</script>
<!-- filter my candidate -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('search');
        const pendingCheckbox = document.getElementById('pending');
        const approvedCheckbox = document.getElementById('approved');
        const dropCheckbox = document.getElementById('drop');
        const tableBody = document.querySelector('tbody');

        function filterTable() {
            const searchValue = searchInput.value.toLowerCase();
            const showPending = pendingCheckbox.checked;
            const showApproved = approvedCheckbox.checked;
            const showDrop = dropCheckbox.checked;

            Array.from(tableBody.rows).forEach(row => {
                const cells = row.getElementsByTagName('td');
                const jobName = cells[1].innerText.toLowerCase();
                const location = cells[2].innerText.toLowerCase();
                const department = cells[3].innerText.toLowerCase();
                const jobStatus = cells[4].innerText.toLowerCase();
                const email = cells[5].innerText.toLowerCase();
                const name = cells[6].innerText.toLowerCase();
                const phone = cells[7].innerText.toLowerCase();
                const address = cells[8].innerText.toLowerCase();
                const age = cells[9].innerText.toLowerCase();
                const experience = cells[10].innerText.toLowerCase();
                const applicationStatus = cells[13].innerText.toLowerCase();

                const matchesSearch = [jobName, location, department, jobStatus, email, name, phone, address, age, experience].some(text => text.includes(searchValue));
                const matchesStatus = (showPending && applicationStatus === 'pending') ||
                    (showApproved && applicationStatus === 'accept') ||
                    (showDrop && applicationStatus === 'drop');

                if (matchesSearch && matchesStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        searchInput.addEventListener('input', filterTable);
        pendingCheckbox.addEventListener('change', filterTable);
        approvedCheckbox.addEventListener('change', filterTable);
        dropCheckbox.addEventListener('change', filterTable);

        // Initial filter
        filterTable();
    });
</script>

<?php

include("../footer.php");

?>