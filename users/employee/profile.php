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
            <div class="container-fluid"> <!-- About profile background -->
                <div class="mb-3">
                    <div class="container-fluid profile-background">
                        <div class="cover-profile">
                            <img src="../../images/skill3cover.jpg" alt="">
                        </div>
                        <div class="button-position">
                            <button type="button" class="btn btn-outline-secondary upload-btn"><i class="fa-solid fa-camera"></i> Change Cover</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid last-content">
                <div class="mb-3">
                    <div class="profile-content">
                        <div class="row" style="display: flex;">
                            <div class="col-sm-3 mb-3" style="flex-grow: 1;">
                                <div class="card profile-boxes1" style="height: 100%; width: 100%;">
                                    <div class="card-body centered-content" style="height: 100%; width: 100%;">
                                        <div class="profile-image">
                                            <img src="../../images/motorcyclist.png" alt="">
                                            <i class="fa-solid fa-camera-retro upload-camera"></i>
                                        </div>
                                        <br>
                                        <div class="name-position">
                                            <strong>Crispin Jose M. Uriarte</strong><br>
                                            <span>ISA Manager</span>
                                        </div>
                                        <hr>
                                        <div class="additional-button">
                                            <button type="button" class="btn btn-light mb-1 btn-block">Useable Leaves<span class="badge bg-info">10</span></button>
                                            <button type="button" class="btn btn-light mb-1 btn-block">Performance Rating <span class="badge bg-info">89%</span></button>
                                            <button type="button" class="btn btn-light mb-1 btn-block">Assigned Assets <span class="badge bg-info">1</span></button>
                                            <div class="line"></div>
                                            <button type="button" class="btn btn-outline-secondary mb-1 btn-block">Export Profile</button>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="Employee ID">
                                                <button class="btn btn-secondary" type="submit"><i class="fa-regular fa-copy"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9" style="flex-grow: 1; ">
                                <div class="card profile-boxes2" style="height: 100%; width: 100%;">
                                    <div class="card-body" style="height: 100%; width: 100%;">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#basicInfo">Basic Information</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#govInfo">Goverment Information</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#emergencyCon">Emergency Contact</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#socialacc">Social Media</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#cande">Certificate & Eligibility</a>
                                            </li>
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane container active" id="basicInfo">
                                                <form action="" method="POST">
                                                    <div class="row">
                                                        <div class="col-sm-6 mt-3 mb-3">
                                                            <div class="form-floating mb-1 mt-3 overflow-hidden">
                                                                <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                                                                <label for="email">Email</label>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div class="form-floating mb-3 mt-3 overflow-hidden">
                                                                        <input type="text" class="form-control" id="fname" placeholder="First Name" name="fname">
                                                                        <label for="fname">First Name</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-floating mb-3 mt-3 overflow-hidden">
                                                                        <input type="text" class="form-control" id="mname" placeholder="Middle Name" name="mname">
                                                                        <label for="mname">Middle Name</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-floating mb-3 mt-3 overflow-hidden">
                                                                        <input type="text" class="form-control" id="sname" placeholder="Surname" name="sname">
                                                                        <label for="sname">Surname</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-8">
                                                                    <div class="form-floating mb-3 mt-2 overflow-hidden">
                                                                        <input type="text" class="form-control" id="datepicker" placeholder="Select date">
                                                                        <label for="datepicker">Date of birth</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-floating mb-3 mt-2 overflow-hidden">
                                                                        <input type="text" class="form-control" id="age" placeholder="Age" name="age">
                                                                        <label for="age">Age</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-floating mb-3 mt-2 overflow-hidden">
                                                                <input type="text" class="form-control" id="mnumber" placeholder="Mobile Number" name="mnumber">
                                                                <label for="mnumber">Mobile Number</label>
                                                            </div>
                                                            <div class="form-floating mb-3 mt-4 overflow-hidden">
                                                                <input type="text" class="form-control" id="tnumber" placeholder="Telephone Number" name="tnumber">
                                                                <label for="tnumber">Telephone Number</label>
                                                            </div>
                                                            <div class="form-floating mb-4 mt-4 overflow-hidden">
                                                                <select class="form-select" id="education" name="education">
                                                                    <option>Elementary</option>
                                                                    <option>Highschool</option>
                                                                    <option>Senior High</option>
                                                                    <option>Vocational</option>
                                                                    <option>College</option>
                                                                    <option>Masters</option>
                                                                    <option>PhD</option>
                                                                </select>
                                                                <label for="education" class="form-label">Select Education:</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 mt-3 mb-3">
                                                            <div class="form-floating mb-3 mt-3 overflow-hidden">
                                                                <textarea class="form-control" id="paddress" name="paddress" placeholder="Present Address"></textarea>
                                                                <label for="paddress">Present Address</label>
                                                            </div>
                                                            <div class="form-floating mb-3 mt-4 overflow-hidden">
                                                                <textarea class="form-control" id="raddress" name="raddress" placeholder="Residential Address"></textarea>
                                                                <label for="paddress">Residential Address</label>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-floating mb-2 mt-2 overflow-hidden">
                                                                        <select class="form-select" id="gend" name="gend">
                                                                            <option>Male</option>
                                                                            <option>Female</option>
                                                                            <option>Rather not to say</option>
                                                                        </select>
                                                                        <label for="gend" class="form-label">Select Gender:</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-floating mb-2 mt-2 overflow-hidden">
                                                                        <select class="form-select" id="mstatus" name="mstatus">
                                                                            <option>Single</option>
                                                                            <option>Marriage</option>
                                                                            <option>Widowed</option>
                                                                            <option>Divorced</option>
                                                                            <option>Separated</option>
                                                                            <option>Others</option>
                                                                        </select>
                                                                        <label for="mstatus" class="form-label">Select Marital Status:</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-floating mb-3 mt-3 overflow-hidden">
                                                                        <input type="text" class="form-control" id="religion" placeholder="Religion" name="religion">
                                                                        <label for="religion">Religion</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                <div class="form-floating mb-3 mt-3 overflow-hidden">
                                                                    <select class="form-select" id="pdisable" name="pdisable">
                                                                        <option>None</option>
                                                                        <option>Marriage</option>
                                                                        <option>Widowed</option>
                                                                        <option>Divorced</option>
                                                                        <option>Separated</option>
                                                                        <option>Others</option>
                                                                    </select>
                                                                    <label for="pdisable" class="form-label">Select Physical Disability:</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="update-btn" style="position: absolute; bottom: 30px; right: 30px;">
                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane container fade" id="govInfo">...</div>
                                            <div class="tab-pane container fade" id="emergencyCon">...</div>
                                            <div class="tab-pane container fade" id="socialacc">...</div>
                                            <div class="tab-pane container fade" id="cande">...</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="div" style="color: white;">
                c
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