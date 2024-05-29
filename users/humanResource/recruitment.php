<?php 
$page_title = "Dashboard";  
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
            
        <div class="row d-flex align-items-stretch">
            <div class="col-sm-6 mb-2 mt-2">
                <div class="card h-100">
                
                <?php
                if (isset($_SESSION['error'])) {
                    echo '<div class="container">
                    <div class="alert alert-danger alert-dismissible mt-2 mx-2">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Failed!</strong> '.$_SESSION['error'].'
                    </div>
                    </div>';
                    unset($_SESSION['error']);
                }

                if (isset($_SESSION['success'])) {
                    echo '<div class="alert alert-success alert-dismissible mx-2">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Success!</strong> '.$_SESSION['success'].'
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
                        if ($result->num_rows>0) {
                            while($row = mysqli_fetch_array($result)){
                                $departmentName = $row['departmentName'];
                                $departmentID = $row['id'];
            
                                echo '
                                <a href="?departmentName='.urlencode($departmentName).'" class="text-decoration-none">
                                    <div class="card card-sched mt-2 mt-2">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5>'.$departmentName.'</h5>
                                                </div>
                                                <div class="col">
                                                    <h5><span class="badge bg-success">'.$departmentName.'</span></h5>
                                                </div>
                                                <div class="col d-flex justify-content-end">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deptModal" data-id="'.$departmentID.'" data-deptName="'.$departmentName.'"><i class="fa-solid fa-pen-to-square"></i></button>
                                                        <button type="submit" name="deptDelete" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="deptID" name="deptID" value="'.$departmentID.'">
                                            </div>
                                        </div>
                                    </div>
                                </a>
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
                    <strong>Failed!</strong> '.$_SESSION['error1'].'
                    </div>
                    </div>';
                    unset($_SESSION['error1']);
                }

                if (isset($_SESSION['success1'])) {
                    echo '<div class="alert alert-success alert-dismissible mx-2">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Success!</strong> '.$_SESSION['success1'].'
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
                        
                        // Get the departmentName from the query parameters
                        $departmentName = isset($_GET['departmentName']) ? mysqli_real_escape_string($conn, $_GET['departmentName']) : '';

                        // Modify the query to filter by departmentName if it exists
                        if ($departmentName) {
                            $query = "SELECT * FROM job_title WHERE department = '$departmentName' ORDER BY id DESC";
                        } else {
                            $query = "SELECT * FROM job_title ORDER BY id DESC";
                        }

                        $result = mysqli_query($conn, $query);
                        if ($result->num_rows > 0) {
                            while($row = mysqli_fetch_array($result)){
                                $departmentlist = $row['department'];
                                $jobname = $row['job_name'];
                                $jobtitleID = $row['id'];

                                echo '
                                <div class="card card-sched mt-2 mt-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5>'.$departmentlist.'</h5>
                                            </div>
                                            <div class="col">
                                                <h5>'.$jobname.'</h5>
                                            </div>
                                            <div class="col d-flex justify-content-end">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#jobModal" data-id="'.$jobtitleID.'" data-jobName="'.$jobname.'" data-department="'.$departmentlist.'"><i class="fa-solid fa-pen-to-square"></i></button>
                                                    <button type="submit" name="jobDelete" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                </div>
                                            </div>
                                            <input type="hidden" id="jobID" name="jobID" value="'.$jobtitleID.'">
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
                                    while($row = $result->fetch_assoc()) {
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
                                    while($row = $result->fetch_assoc()) {
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

        </main>
        <?php 
        include("../usersFooter.php")
        ?>
    </div>
</div>

<!-- Department Modal Call Value -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Select all update buttons with data attributes
        var updateButtons = document.querySelectorAll('[data-bs-toggle="modal"][data-id]');

        // Loop through each update button and attach event listener
        updateButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                // Extract department name and ID from data attributes
                var departmentName = button.getAttribute('data-deptName');
                var departmentID = button.getAttribute('data-id');

                // Populate modal fields with department data
                document.getElementById('modalDeptName').value = departmentName;
                document.getElementById('modalDeptID').value = departmentID;
            });
        });

        updateButtons.forEach(function (button) {
            button.addEventListener('click', function () {
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


<?php 

include("../footer.php");

?>