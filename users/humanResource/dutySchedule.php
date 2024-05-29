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
            
        <div class="container">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSched">
                    <i class="fa-regular fa-calendar-plus"></i> Schedule
                </button>
            </div>
            <?php 
            include_once("../../dbconn.php");
            $query = "SELECT * FROM schedule ORDER BY id DESC";
            $result = mysqli_query($conn, $query);
            if ($result->num_rows>0) {
                while($row = mysqli_fetch_array($result)){
                    $schedName = $row['schedName'];
                    $TimeIn = $row['timeIn'];
                    $BreakIn = $row['breakIn'];
                    $BreakOut = $row['breakOut'];
                    $TimeOut = $row['timeOut'];
                    $schedID = $row['id'];

                    $cardBodyClass = (empty($BreakIn) && empty($BreakOut)) ? 'bg-time' : 'bg-timeW';

                    echo '
                    <div class="card card-sched mt-2 mt-2" data-bs-toggle="modal" data-bs-target="#scheduleModal" data-id="'.$schedID.'" data-schedname="'.$schedName.'" data-timein="'.$TimeIn.'" data-breakin="'.$BreakIn.'" data-breakout="'.$BreakOut.'" data-timeout="'.$TimeOut.'">
                        <div class="card-body '. $cardBodyClass .'">
                            <div class="row">
                                <div class="col">
                                    <h5>'.$schedName.'</h5>
                                </div>
                                <div class="col">
                                    <h5>Time in: <span class="badge bg-success">'.$TimeIn.'</span></h5>
                                </div>
                                <div class="col">
                                    <h5>Break in: <span class="badge bg-success">'.$BreakIn.'</span></h5>
                                </div>
                                <div class="col">
                                    <h5>Break out: <span class="badge bg-danger">'.$BreakOut.'</span></h5>
                                </div>
                                <div class="col">
                                    <h5>Time out: <span class="badge bg-danger">'.$TimeOut.'</span></h5>
                                </div>
                                <div class="hidden">'.$schedID.'</div>
                            </div>
                        </div>
                    </div>
                    ';
                }
            }
            ?>
            
            
        </div>

        <!-- The AddSchedule -->
        <div class="modal" id="addSched">
            <div class="modal-dialog">
                <div class="modal-content">
                <form action="../scheduleUpload.php" method="POST">
                    
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">New Schedule</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="mb-3 mt-3">
                        <label for="schedName" class="form-label">Schedule:</label>
                        <input type="text" class="form-control" id="schedName" placeholder="Enter Schedule Name" name="schedName" required>
                    </div>
                    <hr>
                    <div class="mb-3 mt-3">
                        <label for="timeIn" class="form-label">Time-in:</label>
                        <input type="time" class="form-control" id="timeIn" placeholder="Enter Time-in" name="timeIn" required>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="breakime" name="breaktime" value="yes" checked>
                        <label class="form-check-label" for="breaktime">Break Time</label>
                    </div>
                    <div id="breakTimeFields">
                        <div class="mb-3 mt-3">
                            <label for="BreakIn" class="form-label">Break-in:</label>
                            <input type="time" class="form-control" id="BreakIn" name="BreakIn" required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="BreakOut" class="form-label">Break-out:</label>
                            <input type="time" class="form-control" id="BreakOut" name="BreakOut" required>
                        </div>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="timeOut" class="form-label">Time-out:</label>
                        <input type="time" class="form-control" id="timeOut" placeholder="Enter Time-out" name="timeOut" required>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" name="newAttendance" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
                </div>
            </div>
        </div>

        <!-- Update Sched -->
        <div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="updateForm" action="../scheduleUpload.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="scheduleModalLabel">Schedule Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-floating mb-2">
                                <input class="form-control mt-1" type="text" id="modalSchedName" name="schedName" placeholder="Schedule">
                                <label for="schedName">Schedule</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input class="form-control mt-1" type="time" id="modalTimeIn" name="timeIn" placeholder="Time In">
                                <label for="timeIn">Time In</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input class="form-control mt-1" type="time" id="modalBreakIn" name="breakIn" placeholder="Break In">
                                <label for="breakIn">Break In</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input class="form-control mt-1" type="time" id="modalBreakOut" name="breakOut" placeholder="Break Out">
                                <label for="breakOut">Break Out</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input class="form-control mt-1" type="time" id="modalTimeOut" name="timeOut" placeholder="Time Out">
                                <label for="timeOut">Time Out</label>
                            </div>
                            <input type="hidden" id="modalSchedID" name="schedID">
                        </div>
                        <div class="modal-footer">
                            <input class="btn btn-primary" type="submit" value="Update" name="updateSched">
                            <input class="btn btn-danger" type="submit" value="Delete" name="deleteSched">
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Add click event listener to each card
        document.querySelectorAll('.card-sched').forEach(card => {
            card.addEventListener('click', function() {
                const schedName = this.getAttribute('data-schedname');
                const timeIn = this.getAttribute('data-timein');
                const breakIn = this.getAttribute('data-breakin');
                const breakOut = this.getAttribute('data-breakout');
                const timeOut = this.getAttribute('data-timeout');
                const schedID = this.getAttribute('data-id');

                // Set the data to the modal
                document.getElementById('modalSchedName').value = schedName;
                document.getElementById('modalTimeIn').value = timeIn;
                document.getElementById('modalBreakIn').value = breakIn;
                document.getElementById('modalBreakOut').value = breakOut;
                document.getElementById('modalTimeOut').value = timeOut;
                document.getElementById('modalSchedID').value = schedID;
            });
        });
    });
</script>

<?php 

include("../footer.php");

?>