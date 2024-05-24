<?php 
$page_title = "Dashboard";  
include("../bodyCamera.php");

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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card card-height">
                            <div class="card-body center-all" style="flex: 1;">
                                <div id="my_camera">

                                </div>
                                <div id="results" style="visibility: hidden; position: absolute;">
                                </div>
                                <br>
                                <button type="button" class="btn btn-primary" onclick="saveSnap();">Attendance</button><br>  
                            </div>
                        </div>
                                              
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-height">
                            <div class="card-body" style="flex: 1;">
                                <div class="form-floating">
                                <select class="form-select" id="sel1" name="sellist">
                                    <option>Time In</option>
                                    <option>Break Time Out</option>
                                    <option>Break Time In</option>
                                    <option>Time Out</option>
                                    <option>Overtime Time In</option>
                                    <option>Overtime Out</option>
                                </select>
                                <label for="sel1" class="form-label">Select list (select one):</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </main>
        <?php 
        include("../usersFooter.php")
        ?>
    </div>
</div>



<?php 

include("../footer.php");

?>