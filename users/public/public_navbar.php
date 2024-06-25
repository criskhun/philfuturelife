<nav class="navbar navbar-expand-lg navbar-light px-4 py-3 nav-stick">
    <div class="input-group input-group-navbar">
        <a href="../public/">
            <img src="../../images/mainlogo.png" style="width: 14%;" alt="" class="me-3">
        </a>
    </div>
    <div class="d-flex align-items-center">
        <a href="#" class="me-3 text-nowrap" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" data-bs-toggle="offcanvas" data-bs-target="#career">Careers<span class="badge rounded-pill bg-danger me-2"> <?php echo $activeCount ?></span></a>
        <a href="#" class="me-3 text-nowrap" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" data-bs-toggle="offcanvas" data-bs-target="#whatsNew">What's New?</a>
        <button class="btn btn-light me-2"><i class="fa-regular fa-circle-question"></i></button>
        <button class="btn btn-light me-2"><i class="fa-brands fa-facebook"></i></button>
        <button class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#easyApplyModal">Subscribe</button>
    </div>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a href="#" class="nav-icon pe-md-0 me-3" data-bs-toggle="dropdown">
                    <img src="../../images/motorcyclist.png" class="avatar img-fluid" alt="">
                </a>
                <div class="dropdown-menu dropdown-menu-end rounded">
                    <a href="#" class="dropdown-item">
                        <i class="fa-solid fa-user"></i>
                        <span>Profile</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="fa-solid fa-gear"></i>
                        <span>Settings</span>
                    </a>
                    <div class="dropdown-diverder"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fa-solid fa-circle-question"></i>
                        <span>Help</span>
                    </a>
                    <hr>
                    <a href="../../includes/logoutSession.php" class="dropdown-item">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- offcanvass what's new -->
<div class="offcanvas offcanvas-end" id="whatsNew">
    <div class="offcanvas-header">
        <h1 class="offcanvas-title">Heading</h1>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <p>Some text lorem ipsum.</p>
        <p>Some text lorem ipsum.</p>
        <p>Some text lorem ipsum.</p>
        <button class="btn btn-secondary" type="button">A Button</button>
    </div>
</div>

<!-- offcanvass career-->
<div class="offcanvas offcanvas-end" id="career">
    <div class="offcanvas-header">
        <h1 class="offcanvas-title">Careers</h1>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <h5><strong>List of Available Careers:</strong></h5>        
        
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
                    <div class="card mb-2">
                        <div class="card-body">
                            <h5 class="card-title"><strong>'.$jobName.'</strong></h5>
                            <h6><i class="fa-solid fa-location-dot"></i> '.$location.'</h6>
                            <h6><i class="fa-solid fa-building"></i> '.$department.'</h6>
                            <h6><i class="fa-solid fa-person-circle-check"></i> '.$jobStatus.'</h6>
                            <h6><i class="fa-solid fa-list-ol"></i> '.$item_count.'</h6>
                            <h6><i class="fa-solid fa-sack-dollar"></i> '.$salary.'</h6>
                            <br>
                            <a href="careers.php?jobId='.$jobPostId.'" class="btn btn-outline-primary mb-2" type="button"><i class="fa-solid fa-bolt"></i> Easy Apply</a>
                            
                            <br>
                            <a href="#" class="toggle-more">see more <i class="fa-solid fa-angle-right"></i></a>
                            <div class="hidden">
                                <h6><strong>About Job</strong></h6>
                                <p>'.$aboutJob.'</p>
                                <h6><strong>Responsibilities</strong></h6>
                                <p>'.$responsibilities.'</p>
                                <h6><strong>Educational/Experience</strong></h6>
                                <p>'.$educational.'</p>
                                <h6><strong>Skills</strong></h6>
                                <p>'.$skills.'</p>
                                <h6><strong>Working Schedule</strong></h6>
                                <p>'.$working_time.'</p>
                                <h6><strong>Benefits</strong></h6>
                                <p>'.$benefits.'</p>
                            </div>
                            
                        </div>
                    </div>
                ';

            }
        }

        ?>
        <button class="btn btn-primary mt-4" type="button"><i class="fa-solid fa-arrow-up-right-from-square"></i> Visit Our Career Page</button>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="easyApplyModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        Modal body..
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        $('.toggle-more').on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            var $hiddenDiv = $this.next('.hidden');
            $hiddenDiv.toggleClass('hidden');

            if ($hiddenDiv.hasClass('hidden')) {
                $this.html('see more <i class="fa-solid fa-angle-right"></i>');
            } else {
                $this.html('see less <i class="fa-solid fa-angle-right" style="transform: rotate(90deg);"></i>');
            }
        });
    });
</script>