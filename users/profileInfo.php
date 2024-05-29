<div class="profile-content">
    <div class="row" style="display: flex;">
        <div class="col-sm-3 mb-3" style="flex-grow: 1;"> <!-- 1st profile Card -->
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
                        <button type="button" class="btn btn-light mb-1 btn-block">Branch<span class="badge bg-info">GSS</span></button>
                        <button type="button" class="btn btn-light mb-1 btn-block">Useable Leaves<span class="badge bg-info">10</span></button>
                        <button type="button" class="btn btn-light mb-1 btn-block">Performance Rating <span class="badge bg-info">89%</span></button>
                        
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
        <?php
                        $activeTab = isset($_GET['activeTab']) ? $_GET['activeTab'] : 'basicInfo';
                    ?>
        <div class="col-sm-9" style="flex-grow: 1; ">
            <div class="card profile-boxes2" style="height: 100%; width: 100%;">
                <div class="card-body" style="height: 100%; width: 100%;">
                    <ul class="nav nav-tabs"> <!-- tabs menu -->
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($activeTab == 'basicInfo' ? 'active' : ''); ?>" data-bs-toggle="tab" href="#basicInfo">Basic Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($activeTab == 'govInfo' ? 'active' : ''); ?>" data-bs-toggle="tab" href="#govInfo">Goverment Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($activeTab == 'emergencyCon' ? 'active' : ''); ?>" data-bs-toggle="tab" href="#emergencyCon">Emergency Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($activeTab == 'socialacc' ? 'active' : ''); ?>" data-bs-toggle="tab" href="#socialacc">Socials</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($activeTab == 'cande' ? 'active' : ''); ?>" data-bs-toggle="tab" href="#cande">Certificate & Eligibility</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane container <?php echo ($activeTab == 'basicInfo' ? 'active' : 'fade'); ?>" id="basicInfo">
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
                                    </div>
                                    <div class="col-sm-6 mt-3 mb-3 d-flex flex-column">
                                        <div class="form-floating mb-3 mt-3 overflow-hidden">
                                            <textarea class="form-control" id="paddress" name="paddress" placeholder="Present Address" oninput="autoResize(this)"></textarea>
                                            <label for="paddress">Present Address</label>
                                        </div>
                                        <div class="form-floating mb-3 mt-2 overflow-hidden">
                                            <textarea class="form-control" id="raddress" name="raddress" placeholder="Residential Address" oninput="autoResize(this)"></textarea>
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
                                                    <option>No</option>
                                                    <option>Yes</option>                                                      
                                                </select>
                                                <label for="pdisable" class="form-label">Select Physical Disability?</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3 mt-2 overflow-hidden">
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
                                        <div class="mt-auto mb-4 justify-content-center d-flex">
                                            <button type="submit" class="btn btn-primary w-100 text-center btn-lg mt-2">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane container <?php echo ($activeTab == 'govInfo' ? 'active' : 'fade'); ?>" id="govInfo">
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col-sm-6 mt-3 mb-3">
                                        <div class="form-floating mb-1 mt-3 overflow-hidden">
                                            <input type="text" class="form-control" id="tin" placeholder="TIN Number" name="tin">
                                            <label for="tin">TIN Number</label>
                                        </div>                                        
                                        <div class="form-floating mb-3 mt-3 overflow-hidden">
                                            <input type="text" class="form-control" id="sss" placeholder="SSS Number" name="sss">
                                            <label for="sss">SSS Number</label>
                                        </div>
                                        <div class="form-floating mb-3 mt-3 overflow-hidden">
                                            <input type="text" class="form-control" id="phic" placeholder="PhilHealth Number" name="phic">
                                            <label for="phic">PhilHealth Number</label>
                                        </div>
                                        <div class="form-floating mb-3 mt-3 overflow-hidden">
                                            <input type="text" class="form-control" id="pagibig" placeholder="Pag-ibig Number" name="pagibig">
                                            <label for="pagibig">Pag-ibig Number</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mt-3 mb-3 d-flex flex-column">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-floating mb-2 mt-3 overflow-hidden">
                                                    <input type="text" class="form-control" id="tax" placeholder="Income Tax" name="tax">
                                                    <label for="tax">Income Tax</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-floating mb-2 mt-3 overflow-hidden">
                                                    <select class="form-select" id="taxable" name="taxable">
                                                        <option>No</option>
                                                        <option>Yes</option>
                                                    </select>
                                                    <label for="taxable" class="form-label">Tax Status:</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-0">
                                            <div class="col-sm-6">
                                                <div class="form-floating mb-1 mt-2 overflow-hidden">
                                                    <input type="text" class="form-control" id="sssee" placeholder="SSS Contribution" name="sssee">
                                                    <label for="sssee">EE SSS Contribution</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-floating mb-2 mt-2 overflow-hidden">
                                                    <input type="text" class="form-control" id="ssser" placeholder="SSS Contribution" name="ssser">
                                                    <label for="ssser">ER SSS Contribution</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-0">
                                            <div class="col-sm-6">
                                                <div class="form-floating mb-2 mt-2 overflow-hidden">
                                                    <input type="text" class="form-control" id="phicrate" placeholder="Premium Rate" name="phicrate">
                                                    <label for="phicrate">Premium Rate</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-floating mb-1 mt-2 overflow-hidden">
                                                    <input type="text" class="form-control" id="phicmon" placeholder="Monthly Premium" name="phicmon">
                                                    <label for="phicmon">Monthly Premium</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-0">
                                            <div class="col-sm-6">
                                                <div class="form-floating mb-2 mt-2 overflow-hidden">
                                                    <input type="text" class="form-control" id="hmdfee" placeholder="EE HMDF 2%" name="hmdfee">
                                                    <label for="hmdfee">EE HMDF 2%</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-floating mb-4 mt-2 overflow-hidden">
                                                    <input type="text" class="form-control" id="hmdfer" placeholder="ER HMDF 2%" name="hmdfer">
                                                    <label for="hmdfer">ER HMDF 2%</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-auto mb-4 justify-content-center d-flex">
                                            <button type="submit" class="btn btn-primary w-100 text-center btn-lg">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane container <?php echo ($activeTab == 'emergencyCon' ? 'active' : 'fade'); ?>" id="emergencyCon">
                            <h6 class="mt-2">Contact Person</h6>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-floating mb-2 mt-3 overflow-hidden">
                                        <input type="text" class="form-control" id="emgname1" placeholder="Name" name="emgname1">
                                        <label for="emgname1">Name</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-floating mb-2 mt-3 overflow-hidden">
                                        <select class="form-select" id="emgrel1" name="emgrel1">
                                            <option>Parent</option>
                                            <option>Spouse</option>
                                            <option>Brother/Sister</option>
                                            <option>Relative</option>
                                            <option>Guardian</option>
                                            <option>Son/Daugther</option>
                                            <option>Other</option>
                                        </select>
                                        <label for="emgrel1" class="form-label">Relationship</label>
                                    </div>                                    
                                </div>
                                <div class="form-floating mb-2 mt-2 overflow-hidden">
                                    <textarea class="form-control" id="emgadd1" name="emgadd1" placeholder="Home Address" oninput="autoResize(this)"></textarea>
                                    <label for="emgadd1">Home Address</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-floating mb-2 mt-2 overflow-hidden">
                                        <input type="text" class="form-control" id="emgcity1" placeholder="City" name="emgcity1">
                                        <label for="emgcity1">City</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-floating mb-2 mt-2 overflow-hidden">
                                        <input type="text" class="form-control" id="emgstate1" placeholder="Name" name="emgstate1">
                                        <label for="emgstate1">State</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-floating mb-2 mt-2 overflow-hidden">
                                        <input type="text" class="form-control" id="emgzip1" placeholder="Zip" name="emgzip1">
                                        <label for="emgzip1">Zip</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-floating mb-2 mt-3 overflow-hidden">
                                        <input type="text" class="form-control" id="emgtel1" placeholder="Telephone Number" name="emgtel1">
                                        <label for="emgtel1">Telephone Number</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-floating mb-2 mt-3 overflow-hidden">
                                        <input type="text" class="form-control" id="emgmob1" placeholder="Mobile Number" name="emgmob1">
                                        <label for="emgmob1">Mobile Number</label>
                                    </div>
                                </div>
                            </div>
                            <!-- seprate of the 2 emergency contact -->
                            <!-- <hr> 
                            <h6 class="mt-2">Medical Contact</h6>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-floating mb-2 mt-3 overflow-hidden">
                                        <input type="text" class="form-control" id="emgname2" placeholder="Name" name="emgname2">
                                        <label for="emgname2">Name</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-floating mb-2 mt-3 overflow-hidden">
                                        <select class="form-select" id="emgrel2" name="emgrel2">
                                            <option>Parent</option>
                                            <option>Spouse</option>
                                            <option>Brother/Sister</option>
                                            <option>Relative</option>
                                            <option>Guardian</option>
                                            <option>Son/Daugther</option>
                                            <option>Other</option>
                                        </select>
                                        <label for="emgrel2" class="form-label">Relationship</label>
                                    </div>                                    
                                </div>
                                <div class="form-floating mb-2 mt-2 overflow-hidden">
                                    <textarea class="form-control" id="emgadd2" name="emgadd2" placeholder="Home Address" oninput="autoResize(this)"></textarea>
                                    <label for="emgadd2">Home Address</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-floating mb-2 mt-2 overflow-hidden">
                                        <input type="text" class="form-control" id="emgcity2" placeholder="City" name="emgcity2">
                                        <label for="emgcity2">City</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-floating mb-2 mt-2 overflow-hidden">
                                        <input type="text" class="form-control" id="emgstate2" placeholder="Name" name="emgstate2">
                                        <label for="emgstate2">State</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-floating mb-2 mt-2 overflow-hidden">
                                        <input type="text" class="form-control" id="emgzip2" placeholder="Zip" name="emgzip2">
                                        <label for="emgzip2">Zip</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-floating mb-2 mt-3 overflow-hidden">
                                        <input type="text" class="form-control" id="emgtel1" placeholder="Telephone Number" name="emgtel1">
                                        <label for="emgtel1">Telephone Number</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-floating mb-2 mt-3 overflow-hidden">
                                        <input type="text" class="form-control" id="emgmob1" placeholder="Mobile Number" name="emgmob1">
                                        <label for="emgmob1">Mobile Number</label>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-6">
                                    <div class="mt-auto mb-4 justify-content-center d-flex">
                                        <button type="submit" class="btn btn-primary w-100 text-center btn-lg mt-3">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>            
                        <div class="tab-pane container <?php echo ($activeTab == 'socialacc' ? 'active' : 'fade'); ?>" id="socialacc">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="input-group mb-3 mt-4">
                                        <input type="text" class="form-control" placeholder="https://www.facebook.com/name" id="facebook">
                                        <button class="btn btn-primary uniform-btn" type="button" onclick="navigateTo('facebook')">
                                            <i class="fa-brands fa-facebook"></i>
                                        </button>
                                    </div>
                                    <div class="input-group mb-3 mt-4">
                                        <input type="text" class="form-control" placeholder="https://www.linkedin.com/in/name/" id="linkedin">
                                        <button class="btn btn-primary uniform-btn" type="button" onclick="navigateTo('linkedin')">
                                            <i class="fa-brands fa-linkedin"></i>
                                        </button>
                                    </div>
                                    <div class="input-group mb-3 mt-4">
                                        <input type="text" class="form-control" placeholder="https://x.com/name" id="twitter">
                                        <button class="btn btn-primary uniform-btn" type="button" onclick="navigateTo('twitter')">
                                            <i class="fa-brands fa-twitter"></i>
                                        </button>
                                    </div>
                                    <div class="input-group mb-3 mt-4">
                                        <input type="text" class="form-control" placeholder="https://www.instagram.com/name/" id="instagram">
                                        <button class="btn btn-primary uniform-btn" type="button" onclick="navigateTo('instagram')">
                                            <i class="fa-brands fa-instagram"></i>
                                        </button>
                                    </div>
                                    <div class="input-group mb-3 mt-4">
                                        <input type="text" class="form-control" placeholder="https://www.tiktok.com/@name" id="tiktok">
                                        <button class="btn btn-primary uniform-btn" type="button" onclick="navigateTo('tiktok')">
                                            <i class="fa-brands fa-tiktok"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group mb-3 mt-4">
                                        <input type="text" class="form-control" placeholder="https://github.com/name" id="github">
                                        <button class="btn btn-primary uniform-btn" type="button" onclick="navigateTo('github')">
                                            <i class="fa-brands fa-github"></i>
                                        </button>
                                    </div>
                                    <div class="input-group mb-3 mt-4">
                                        <input type="text" class="form-control" placeholder="username" id="discord">
                                        <button class="btn btn-primary uniform-btn" type="button" onclick="navigateTo('discord')">
                                            <i class="fa-brands fa-discord"></i>
                                        </button>
                                    </div>
                                    <div class="input-group mb-3 mt-4">
                                        <input type="text" class="form-control" placeholder="+63 900 000 0000" id="viber">
                                        <button class="btn btn-primary uniform-btn" type="button" onclick="navigateTo('viber')">
                                            <i class="fa-brands fa-viber"></i>
                                        </button>
                                    </div>
                                    <div class="input-group mb-3 mt-4">
                                        <input type="text" class="form-control" placeholder="name@email.com" id="trello">
                                        <button class="btn btn-primary uniform-btn" type="button" onclick="navigateTo('trello')">
                                            <i class="fa-brands fa-trello"></i>
                                        </button>
                                    </div>
                                    <div class="input-group mb-3 mt-4">
                                        <input type="text" class="form-control" placeholder="https://pin.it/idcode" id="pinterest">
                                        <button class="btn btn-primary uniform-btn" type="button" onclick="navigateTo('pinterest')">
                                            <i class="fa-brands fa-pinterest-p"></i>
                                        </button>
                                    </div>
                                    <div class="mt-auto mb-4 justify-content-center d-flex">
                                        <button type="submit" class="btn btn-primary w-100 text-center btn-lg mt-3">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane container <?php echo ($activeTab == 'cande' ? 'active' : 'fade'); ?> scrollable-tab" id="cande">
                            <div class="col d-flex mt-4 justify-content-end">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#certModal">Add Certificate <i class="fa-solid fa-plus"></i></button>
                            </div>
                            <?php 
                            include_once("../../dbconn.php");
                            $query = "SELECT * FROM certificate";
                            $result = mysqli_query($conn, $query);
                            if ($result->num_rows>0) {
                                while($row = mysqli_fetch_array($result)){
                                    $CertTitle = $row['cert_title'];
                                    $CertDesc = $row['cert_desc'];
                                    $CertIssued = $row['issued'];
                                    $CertExpire = $row['expire'];
                                    $CertImage = $row['file_name'];
                                    $CertID = $row['id'];

                                    $imageURL = "../certificatesImages/".$CertImage;

                                    echo '
                                    <div class="card mt-2 mb-2">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-4 mt-1">
                                                    <a href="#" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#CertUp" 
                                                    data-title="' . htmlspecialchars($CertTitle, ENT_QUOTES, 'UTF-8') . '" 
                                                    data-desc="' . htmlspecialchars($CertDesc, ENT_QUOTES, 'UTF-8') . '" 
                                                    data-issued="' . htmlspecialchars($CertIssued, ENT_QUOTES, 'UTF-8') . '" 
                                                    data-expire="' . htmlspecialchars($CertExpire, ENT_QUOTES, 'UTF-8') . '" 
                                                    data-image="' . $imageURL . '"
                                                    data-id="' . $CertID . '">
                                                        <img src="' . $imageURL . '" class="cert-image" alt="Certificate" style="max-width: 100%; max-height: 130px;">
                                                    </a>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-floating mb-2 mt-2">
                                                        <input type="text" class="form-control" value="' . htmlspecialchars($CertTitle, ENT_QUOTES, 'UTF-8') . '" readonly>
                                                        <label for="certTitle">Certificate Title</label>
                                                    </div>
                                                    <div class="form-floating mb-2">
                                                        <input type="text" class="form-control" value="' . htmlspecialchars($CertIssued, ENT_QUOTES, 'UTF-8') . '" readonly>
                                                        <label for="certIssued">Issued on</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-floating mb-2 mt-2">
                                                        <input type="text" class="form-control" value="' . htmlspecialchars($CertDesc, ENT_QUOTES, 'UTF-8') . '" readonly>
                                                        <label for="certDesc">Certificate Description</label>
                                                    </div>
                                                    <div class="form-floating mb-2">
                                                        <input type="text" class="form-control" value="' . htmlspecialchars($CertExpire, ENT_QUOTES, 'UTF-8') . '" readonly>
                                                        <label for="certExpiry">Expire on</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    ';
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="certModal">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="../uploadCert.php" method="post" enctype="multipart/form-data">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Certificate/Eligibility</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
            <input class="form-control mt-4" type="text" name="CertTitle" id="" placeholder="Certificate Title">
            <input class="form-control mt-4" type="text" name="CertDesc" id="" placeholder="Certificate Description">
            <input class="form-control mt-4" type="text" name="CertIssued" id="" placeholder="Issued on">
            <input class="form-control mt-4" type="text" name="CertExpire" id="" placeholder="Expire on">
            <input class="form-control mt-4" type="file" name="CertImage" id="">
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <input class="btn btn-primary" type="submit" value="UploadCert" name="submitCert">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Modal Structure -->
<div class="modal" id="CertUp">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="updateForm" action="../uploadCert.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Certificate Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="preview" src="" class="img-fluid mb-3" alt="Certificate">                
                    <div class="form-floating mb-2">
                        <input class="form-control mt-1" type="file" id="file" name="file" accept="image/*" onchange="previewImage(event)">
                        <label for="certExpiry">Choose Image to update</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input class="form-control mt-1" type="text" name="CertTitle" placeholder="Certificate Title">
                        <label for="CertTitle">Certificate Title</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input class="form-control mt-1" type="text" name="CertDesc" placeholder="Certificate Description">
                        <label for="CertDesc">Certificate Description</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input class="form-control mt-1" type="text" name="CertIssued" placeholder="Issued on">
                        <label for="CertIssued">Issued on</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input class="form-control mt-1" type="text" name="CertExpire" placeholder="Expire on">
                        <label for="CertExpire">Expire on</label>
                    </div>
                    <input type="hidden" name="CertID" value="">
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" type="submit" value="Update" name="updateCert">
                    <input class="btn btn-danger" type="submit" value="Delete" name="deleteCert">
                </div>
            </form>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('CertUp');
    modal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var title = button.getAttribute('data-title');
        var desc = button.getAttribute('data-desc');
        var issued = button.getAttribute('data-issued');
        var expire = button.getAttribute('data-expire');
        var image = button.getAttribute('data-image');
        var certID = button.getAttribute('data-id'); // Added line to get CertID

        // Update the modal's content
        modal.querySelector('.modal-body img').src = image;
        modal.querySelector('.modal-body input[name="CertTitle"]').value = title;
        modal.querySelector('.modal-body input[name="CertDesc"]').value = desc;
        modal.querySelector('.modal-body input[name="CertIssued"]').value = issued;
        modal.querySelector('.modal-body input[name="CertExpire"]').value = expire;
        modal.querySelector('.modal-body input[name="CertID"]').value = certID; // Set CertID value
    });
});
</script>
<script>
function previewImage(event) {
    var input = event.target;
    var preview = document.getElementById('preview');
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }

        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = "";
        preview.style.display = 'none';
    }
}
</script>


