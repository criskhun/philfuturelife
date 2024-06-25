<?php
$page_title = "Attendance";
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
            $activeTab = isset($_GET['activeTab']) ? $_GET['activeTab'] : 'timeSheet';
            ?>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($activeTab == 'timeSheet') ? 'active' : ''; ?> " data-bs-toggle="tab" href="#timeSheet">Time Sheet</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($activeTab == 'dtr') ? 'active' : ''; ?> " data-bs-toggle="tab" href="#dtr">Daily Time Records</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane <?php echo ($activeTab == 'timeSheet') ? 'active' : 'fade'; ?>" id="timeSheet">
                    <div class="row">
                        <div class="col-sm-6 d-flex align-items-center ">
                            <div class="form-floating mt-2 mb-2 mx-2">
                                <select class="form-select" id="yearChoose" style="display: flex; justify-content: flex-end; width: 250px;" name="year"></select>
                                <label for="yearChoose" class="form-label">Select Year (select one):</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col d-flex align-items-center justify-content-center">
                                    <div class="form-floating mb-2 mt-2" style="width: 100%;">
                                        <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                                        <label for="email">Search...</label>
                                    </div>
                                </div>
                                <div class="col d-flex align-items-center">
                                    <button type="button" class="btn btn-outline-primary btn-lg mb-2 mt-2" data-bs-toggle="modal" data-bs-target="#addTSModal"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-stretch">
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
                                    <h5>Time Sheet Table</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Is Locked</th>
                                                <th class="text-center">Month</th>
                                                <th class="text-center">Year</th>
                                                <th class="text-center">Payroll Period</th>
                                                <th class="text-center">Payroll Frequency</th>
                                                <th class="text-center">Report</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include_once("../../dbconn.php");
                                            $query = "SELECT * FROM time_sheet ORDER BY id ASC";
                                            $result = mysqli_query($conn, $query);
                                            if ($result->num_rows > 0) {
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $tsID = $row['id'];
                                                    $isLocked = $row['IsLocked'];
                                                    $Month = $row['Month'];
                                                    $Year = $row['Year'];
                                                    $sDate = $row['date_start'];
                                                    $eDate = $row['date_end'];
                                                    $Payroll_period = $row['Payroll_period'];
                                                    $Payroll_fq = $row['Payroll_fq'];

                                                    $monthNames = [
                                                        1 => "January",
                                                        2 => "February",
                                                        3 => "March",
                                                        4 => "April",
                                                        5 => "May",
                                                        6 => "June",
                                                        7 => "July",
                                                        8 => "August",
                                                        9 => "September",
                                                        10 => "October",
                                                        11 => "November",
                                                        12 => "December"
                                                    ];

                                                    $monthName = $monthNames[$Month];

                                                    $iconClass = $isLocked ? "fa-solid fa-lock-open" : "fa-solid fa-lock";
                                            ?>
                                                    <tr data-id="<?php echo $tsID ?>" data-sdate="<?php echo $sDate ?>" data-edate="<?php echo $eDate ?>" data-lock="<?php echo $isLocked ?>" data-month="<?php echo $Month ?>" data-year="<?php echo $Year ?>" data-pp="<?php echo $Payroll_period ?>" data-pq="<?php echo $Payroll_fq ?>">
                                                        <td hidden><?php echo $tsID ?></td>
                                                        <td hidden><?php echo $sDate ?></td>
                                                        <td hidden><?php echo $eDate ?></td>
                                                        <td><i class="<?php echo $iconClass ?>"></i></td>
                                                        <td><?php echo $monthName ?></td>
                                                        <td><?php echo $Year ?></td>
                                                        <td><?php echo $Payroll_period ?></td>
                                                        <td><?php echo $Payroll_fq ?></td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-outline-success update-buttonTS" data-id="<?php echo $tsID ?>" data-bs-toggle="modal" data-bs-target="#TSdataModal">
                                                                <i class="fa-solid fa-list-ul"></i>
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
                </div>
                <div class="tab-pane <?php echo ($activeTab == 'dtr') ? 'active' : 'fade'; ?>" id="dtr">
                    <div class="row">
                        <div class="col-sm-6 mt-3 mb-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="optDTRFilter" name="optDTRFilter" value="yes" checked>
                                <label class="form-check-label" for="optDTRFilter">
                                    <p style="font-size: 10px; color: gray;">Filter</p>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-2 mb-2">
                            <div class="d-flex align-items-center mb-2 w-100">
                                <div class="position-relative mx-3 flex-grow-1">
                                    <div class="form-floating flex-grow-1">
                                        <input type="text" class="form-control pr-5" id="search" placeholder="Search..." name="search">
                                        <label for="search">Search...</label>
                                        <i class="fa-solid fa-filter position-absolute end-0 top-50 translate-middle-y me-3"></i>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-outline-light text-dark btn-lg" data-bs-toggle="tooltip" title="Add Attendance!">
                                    <i class="fa-solid fa-clipboard-user"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2" id="thirdCol">
                                <div class="form-floating mb-3 mt-3">
                                    <input type="date" class="form-control" id="datefromDTR" placeholder="Date From" name="datefromDTR">
                                    <label for="email">Date From</label>
                                </div>
                                <div class="form-floating mb-3 mt-3">
                                    <input type="date" class="form-control" id="datetoDTR" placeholder="Date To" name="datetoDTR">
                                    <label for="email">Date To</label>
                                </div>
                                <?php 
                                include_once('../../dbconn.php');
                                $sql = "SELECT id, name FROM branch_location";
                                $result = $conn->query($sql);
                                ?>
                                <div class="form-floating mb-3 mt-3">
                                    <select class="form-select" id="branchList" name="brancLoc">
                                        <?php
                                            if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                                    
                                                    echo '<option value="'. $row["id"]. '">'. $row["name"]. '</option>';
                                                }
                                            } else {
                                                echo '<option value="">No Branch</option>';
                                            }                                            
                                        ?>
                                    </select>
                                    <label for="branchList" class="form-label">Select Branch (select one):</label>
                                </div>
                                <div class="d-grid">
                                    <button type="button" class="btn btn-outline-secondary">Load</button>
                                </div>
                            </div>
                            <div class="col-sm-10" id="fourthCol">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Employee</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Day</th>
                                            <th class="text-center">Time In</th>
                                            <th class="text-center">Time Out</th>
                                            <th class="text-center">Total Minutes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                        </tr>
                                    </tbody>                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- The Time Sheet Data -->
<div class="modal" id="TSdataModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Time Sheet</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="pill" href="#period">Period</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="pill" href="#details">Details</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane container fade" id="period">
                        <input type="hidden" id="idUpTS">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-floating mt-2 mb-2 mx-2">
                                    <select class="form-select" id="upmonthChooseModal" name="upmonthModal"></select>
                                    <label for="upmonthChooseModal" class="form-label">Select Month:</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating mt-2 mb-2 mx-2">
                                    <select class="form-select" id="upyearChooseModal" name="upyearModal"></select>
                                    <label for="upyearChoose" class="form-label">Select Year:</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-floating mt-2 mb-2 mx-2">
                                    <select class="form-select" id="upppChooseModal" name="upppModal"></select>
                                    <label for="upppChooseModal" class="form-label">Select Payroll Period:</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating mt-2 mb-2 mx-2">
                                    <select class="form-select" id="uppfChooseModal" name="uppfModal">
                                        <option>Daily</option>
                                        <option>Weekly</option>
                                        <option selected>Semi-Monthly</option>
                                        <option>Monthly</option>
                                    </select>
                                    <label for="uppfChoose" class="form-label">Select Payroll Frequency:</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-floating mb-3 mt-3 mx-2">
                                    <input type="date" class="form-control" id="upsdateModal" placeholder="Start Date" name="upsdateModal">
                                    <label for="upsdateModal">Start Date</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating mb-3 mt-3 mx-2">
                                    <input type="date" class="form-control" id="upedateModal" placeholder="End Date" name="upedateModal">
                                    <label for="upedateModal">End Date</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane container active" id="details" style="max-height: 500px; overflow-y: auto;">
                        <div class="row">
                            <div class="col-sm-2 mt-2" id="firstCol">
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="regularDaysSwitch" name="regularDays" value="yes" checked>
                                    <label class="form-check-label" for="regularDaysSwitch">
                                        <p style="font-size: 10px; color: gray;">Regular Days</p>
                                    </label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="leavesSwitch" name="leaves" value="no">
                                    <label class="form-check-label" for="leavesSwitch">
                                        <p style="font-size: 10px; color: gray;">Leaves</p>
                                    </label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="holidaysSwitch" name="holidays" value="no">
                                    <label class="form-check-label" for="holidaysSwitch">
                                        <p style="font-size: 10px; color: gray;">Holidays</p>
                                    </label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="restDaySwitch" name="restDay" value="no">
                                    <label class="form-check-label" for="restDaySwitch">
                                        <p style="font-size: 10px; color: gray;">Rest Day</p>
                                    </label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="specialHolidaySwitch" name="specialHoliday" value="no">
                                    <label class="form-check-label" for="specialHolidaySwitch">
                                        <p style="font-size: 10px; color: gray;">Special Holiday</p>
                                    </label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="legalHolidaySwitch" name="legalHoliday" value="no">
                                    <label class="form-check-label" for="legalHolidaySwitch">
                                        <p style="font-size: 10px; color: gray;">Legal Holiday</p>
                                    </label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="legalHolidayRestDaysSwitch" name="legalHolidayRestDays" value="no">
                                    <label class="form-check-label" for="legalHolidayRestDaysSwitch">
                                        <p style="font-size: 10px; color: gray;">Legal Holiday on Rest Days</p>
                                    </label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="specialHolidayRestDaysSwitch" name="specialHolidayRestDays" value="no">
                                    <label class="form-check-label" for="specialHolidayRestDaysSwitch">
                                        <p style="font-size: 10px; color: gray;">Special Holiday on Rest Days</p>
                                    </label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="nightDifferentialSwitch" name="nightDifferential" value="no">
                                    <label class="form-check-label" for="nightDifferentialSwitch">
                                        <p style="font-size: 10px; color: gray;">Night Differential</p>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-10 mt-2" id="secondCol">
                                <div class="d-flex align-items-center mb-2 w-100">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="optFilter" name="optFilter" value="yes" checked>
                                        <label class="form-check-label" for="optFilter">
                                            <p style="font-size: 10px; color: gray;">Filter</p>
                                        </label>
                                    </div>

                                    <div class="position-relative mx-3 flex-grow-1">
                                        <div class="form-floating flex-grow-1">
                                            <input type="text" class="form-control pr-5" id="search" placeholder="Search..." name="search">
                                            <label for="search">Search...</label>
                                            <i class="fa-solid fa-filter position-absolute end-0 top-50 translate-middle-y me-3"></i>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-outline-light text-dark btn-lg">
                                        <i class="fa-solid fa-user-plus"></i>
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th colspan="2" class="text-center" style="position: sticky; left: 0; z-index: 1; background: white;"></th>
                                                <th colspan="5" class="text-center table-primary regular-days-col">Regular Days</th>
                                                <th colspan="4" class="text-center table-danger leaves-col">Leaves (days)</th>
                                                <th colspan="2" class="text-center table-info holidays-col">Paid Unworked Holidays (days)</th>
                                                <th colspan="2" class="text-center table-warning rest-day-col">Rest Day</th>
                                                <th colspan="2" class="text-center table-active special-holiday-col">Special Holiday</th>
                                                <th colspan="2" class="text-center table-secondary legal-holiday-col">Legal Holiday</th>
                                                <th colspan="2" class="text-center table-light legal-holiday-rest-day-col">Legal Holiday on Rest Day</th>
                                                <th colspan="2" class="text-center special-holiday-rest-day-col">Special Holiday on Rest Day</th>
                                                <th colspan="1" class="text-center table-dark night-differential-col">Night Differential</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center" style="position: sticky; left: 0; z-index: 1; background: white; white-space: nowrap;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="selectAll" name="selectAll" value="0">
                                                        <label class="form-check-label">Employee</label>
                                                    </div>
                                                </th>
                                                <th class="text-center" style="position: sticky; left: 200px; z-index: 1; background: white;">Payment Type</th>
                                                <!-- Regular Days -->
                                                <th class="text-center regular-days-col">Absent (day)</th>
                                                <th class="text-center regular-days-col">Tardy (min)</th>
                                                <th class="text-center regular-days-col">UT (min)</th>
                                                <th class="text-center regular-days-col">Basic</th>
                                                <th class="text-center regular-days-col">OT</th>
                                                <!-- Leaves -->
                                                <th class="text-center leaves-col">SL</th>
                                                <th class="text-center leaves-col">VL</th>
                                                <th class="text-center leaves-col">SIL</th>
                                                <th class="text-center leaves-col">ML</th>
                                                <!-- Paid Unworked Holidays -->
                                                <th class="text-center holidays-col">LH</th>
                                                <th class="text-center holidays-col">SH</th>
                                                <!-- Rest Day -->
                                                <th class="text-center rest-day-col">Basic</th>
                                                <th class="text-center rest-day-col">OT</th>
                                                <!-- Special Holiday -->
                                                <th class="text-center special-holiday-col">Basic</th>
                                                <th class="text-center special-holiday-col">OT</th>
                                                <!-- Legal Holiday -->
                                                <th class="text-center legal-holiday-col">Basic</th>
                                                <th class="text-center legal-holiday-col">OT</th>
                                                <!-- Legal Holiday on Rest Day -->
                                                <th class="text-center legal-holiday-rest-day-col">Basic</th>
                                                <th class="text-center legal-holiday-rest-day-col">OT</th>
                                                <!-- Special Holiday on Rest Day -->
                                                <th class="text-center special-holiday-rest-day-col">Basic</th>
                                                <th class="text-center special-holiday-rest-day-col">OT</th>
                                                <!-- Night Differential -->
                                                <th class="text-center night-differential-col">Hours</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include_once("../../dbconn.php");
                                            $query = "SELECT * FROM time_sheet_record ORDER BY id ASC";
                                            $result = mysqli_query($conn, $query);
                                            if ($result->num_rows > 0) {
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $tsrID = $row['id'];
                                                    $employee = $row['employee'];
                                                    $payment_type = $row['payment_type'];
                                                    $absent = $row['absent'];
                                                    $tardy = $row['tardy'];
                                                    $ut = $row['ut'];
                                                    $basic = $row['basic'];
                                                    $ot = $row['ot'];
                                                    $sl = $row['sl'];
                                                    $vl = $row['vl'];
                                                    $sil = $row['sil'];
                                                    $ml = $row['ml'];
                                                    $lh = $row['lh'];
                                                    $sh = $row['sh'];
                                                    $rd_basic = $row['rd_basic'];
                                                    $rd_ot = $row['rd_ot'];
                                                    $sh_basic = $row['sh_basic'];
                                                    $sh_ot = $row['sh_ot'];
                                                    $lh_basic = $row['lh_basic'];
                                                    $lh_ot = $row['lh_ot'];
                                                    $lhrd_basic = $row['lhrd_basic'];
                                                    $lhrd_ot = $row['lhrd_ot'];
                                                    $shrd_basic = $row['shrd_basic'];
                                                    $shrd_ot = $row['shrd_ot'];
                                                    $nd = $row['nd'];
                                                    $creator = 'Crispin Jose M. Uriarte';

                                            ?>
                                                    <tr data-id="<?php echo $tsrID ?>">
                                                        <td style="position: sticky; left: 0; z-index: 1; background: white; white-space: nowrap;">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="selectAll" name="selectAll" value="0">
                                                                <label class="form-check-label"><?php echo $employee ?></label>
                                                            </div>
                                                        </td>
                                                        <td style="position: sticky; left: 200px; z-index: 1; background: white;"><?php echo $payment_type ?></td>
                                                        <td class="regular-days-col"><?php echo $absent ?></td>
                                                        <td class="regular-days-col"><?php echo $tardy ?></td>
                                                        <td class="regular-days-col"><?php echo $ut ?></td>
                                                        <td class="regular-days-col"><?php echo $basic ?></td>
                                                        <td class="regular-days-col"><?php echo $ot ?></td>

                                                        <td class="leaves-col"><?php echo $sl ?></td>
                                                        <td class="leaves-col"><?php echo $vl ?></td>
                                                        <td class="leaves-col"><?php echo $sil ?></td>
                                                        <td class="leaves-col"><?php echo $ml ?></td>

                                                        <td class="holidays-col"><?php echo $lh ?></td>
                                                        <td class="holidays-col"><?php echo $sh ?></td>

                                                        <td class="rest-day-col"><?php echo $rd_basic ?></td>
                                                        <td class="rest-day-col"><?php echo $rd_ot ?></td>

                                                        <td class="special-holiday-col"><?php echo $sh_basic ?></td>
                                                        <td class="special-holiday-col"><?php echo $sh_ot ?></td>

                                                        <td class="legal-holiday-col"><?php echo $lh_basic ?></td>
                                                        <td class="legal-holiday-col"><?php echo $lh_ot ?></td>

                                                        <td class="legal-holiday-rest-day-col"><?php echo $lhrd_basic ?></td>
                                                        <td class="legal-holiday-rest-day-col"><?php echo $lhrd_ot ?></td>

                                                        <td class="special-holiday-rest-day-col"><?php echo $shrd_basic ?></td>
                                                        <td class="special-holiday-rest-day-col"><?php echo $shrd_ot ?></td>

                                                        <td class="night-differential-col"><?php echo $nd ?></td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center" style="position: sticky; left: 0; z-index: 1; background: white; white-space: nowrap;"></th>
                                                <th class="text-center" style="position: sticky; left: 200px; z-index: 1; background: white;"></th>
                                                <!-- Regular Days -->
                                                <th class="text-center table-primary regular-days-col"></th>
                                                <th class="text-center table-primary regular-days-col"></th>
                                                <th class="text-center table-primary regular-days-col"></th>
                                                <th class="text-center table-primary regular-days-col"></th>
                                                <th class="text-center table-primary regular-days-col"></th>
                                                <!-- Leaves -->
                                                <th class="text-center table-danger leaves-col"></th>
                                                <th class="text-center table-danger leaves-col"></th>
                                                <th class="text-center table-danger leaves-col"></th>
                                                <th class="text-center table-danger leaves-col"></th>
                                                <!-- Paid Unworked Holidays -->
                                                <th class="text-center table-info holidays-col"></th>
                                                <th class="text-center table-info holidays-col"></th>
                                                <!-- Rest Day -->
                                                <th class="text-center table-warning rest-day-col"></th>
                                                <th class="text-center table-warning rest-day-col"></th>
                                                <!-- Special Holiday -->
                                                <th class="text-center table-active special-holiday-col"></th>
                                                <th class="text-center table-active special-holiday-col"></th>
                                                <!-- Legal Holiday -->
                                                <th class="text-center table-secondary legal-holiday-col"></th>
                                                <th class="text-center table-secondary legal-holiday-col"></th>
                                                <!-- Legal Holiday on Rest Day -->
                                                <th class="text-center table-light legal-holiday-rest-day-col"></th>
                                                <th class="text-center table-light legal-holiday-rest-day-col"></th>
                                                <!-- Special Holiday on Rest Day -->
                                                <th class="text-center special-holiday-rest-day-col"></th>
                                                <th class="text-center special-holiday-rest-day-col"></th>
                                                <!-- Night Differential -->
                                                <th class="text-center table-dark night-differential-col"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- The Add TS -->
<div class="modal" id="addTSModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="../assets/attendance_server.php" method="post">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Time Sheet</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mt-2 mb-2 mx-2">
                                <select class="form-select" id="monthChooseModal" name="monthModal"></select>
                                <label for="monthChooseModal" class="form-label">Select Month:</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mt-2 mb-2 mx-2">
                                <select class="form-select" id="yearChooseModal" name="yearModal"></select>
                                <label for="yearChoose" class="form-label">Select Year:</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mt-2 mb-2 mx-2">
                                <select class="form-select" id="ppChooseModal" name="ppModal"></select>
                                <label for="ppChooseModal" class="form-label">Select Payroll Period:</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mt-2 mb-2 mx-2">
                                <select class="form-select" id="pfChooseModal" name="pfModal">
                                    <option>Daily</option>
                                    <option>Weekly</option>
                                    <option selected>Semi-Monthly</option>
                                    <option>Monthly</option>
                                </select>
                                <label for="pfChoose" class="form-label">Select Payroll Frequency:</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3 mx-2">
                                <input type="date" class="form-control" id="sdateModal" placeholder="Start Date" name="sdateModal" required>
                                <label for="sdateModal">Start Date</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3 mx-2">
                                <input type="date" class="form-control" id="edateModal" placeholder="End Date" name="edateModal" required>
                                <label for="edateModal">End Date</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" name="newTimeSheet" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Table Visibility -->
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const toggleColumnVisibility = (checkboxId, columnClass) => {
            const checkbox = document.getElementById(checkboxId);
            const columns = document.querySelectorAll(`.${columnClass}`);

            const updateVisibility = () => {
                columns.forEach(col => {
                    col.style.display = checkbox.checked ? '' : 'none';
                });
            };

            checkbox.addEventListener('change', updateVisibility);
            updateVisibility(); // Set initial state
        };

        toggleColumnVisibility('regularDaysSwitch', 'regular-days-col');
        toggleColumnVisibility('leavesSwitch', 'leaves-col');
        toggleColumnVisibility('holidaysSwitch', 'holidays-col');
        toggleColumnVisibility('restDaySwitch', 'rest-day-col');
        toggleColumnVisibility('specialHolidaySwitch', 'special-holiday-col');
        toggleColumnVisibility('legalHolidaySwitch', 'legal-holiday-col');
        toggleColumnVisibility('legalHolidayRestDaysSwitch', 'legal-holiday-rest-day-col');
        toggleColumnVisibility('specialHolidayRestDaysSwitch', 'special-holiday-rest-day-col');
        toggleColumnVisibility('nightDifferentialSwitch', 'night-differential-col');
    });
</script>
<!-- Show filter TS -->
<script>
    $(document).ready(function() {
        $('#optDTRFilter').change(function() {
            if ($(this).is(':checked')) {
                $('#thirdCol').slideDown('slow', function() {
                    $('#fourthCol').removeClass('col-sm-12').addClass('col-sm-10');
                });
            } else {
                $('#thirdCol').slideUp('slow', function() {
                    $('#fourthCol').removeClass('col-sm-10').addClass('col-sm-12');
                });
            }
        });

        // Trigger change event to set the initial state correctly
        $('#optFilter').trigger('change');
    });
</script>
<!-- Show filter TS -->
<script>
    $(document).ready(function() {
        $('#optFilter').change(function() {
            if ($(this).is(':checked')) {
                $('#firstCol').slideDown('slow', function() {
                    $('#secondCol').removeClass('col-sm-12').addClass('col-sm-10');
                });
            } else {
                $('#firstCol').slideUp('slow', function() {
                    $('#secondCol').removeClass('col-sm-10').addClass('col-sm-12');
                });
            }
        });

        // Trigger change event to set the initial state correctly
        $('#optFilter').trigger('change');
    });
</script>
<!-- tip box -->
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
<!-- Year Generator -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const yearSelect = document.getElementById('yearChoose');
        const currentYear = new Date().getFullYear();
        const startYear = currentYear - 4; // Adjust the start year as needed
        const endYear = currentYear + 4; // Adjust the range as needed

        for (let year = startYear; year <= endYear; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            if (year === currentYear) {
                option.selected = true;
            }
            yearSelect.appendChild(option);
        }
    });
</script>
<!-- Year Generator to Modal -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const yearSelectModal = document.getElementById('yearChooseModal');
        const currentYear = new Date().getFullYear();
        const startYear = currentYear - 4; // Adjust the start year as needed
        const endYear = currentYear + 4; // Adjust the range as needed

        for (let year = startYear; year <= endYear; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            if (year === currentYear) {
                option.selected = true;
            }
            yearSelectModal.appendChild(option);
        }
    });
</script>
<!-- UpYear Generator to Modal -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const yearSelectModal = document.getElementById('upyearChooseModal');
        const currentYear = new Date().getFullYear();
        const startYear = currentYear - 4; // Adjust the start year as needed
        const endYear = currentYear + 4; // Adjust the range as needed

        for (let year = startYear; year <= endYear; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            if (year === currentYear) {
                option.selected = true;
            }
            yearSelectModal.appendChild(option);
        }
    });
</script>
<!-- Month Option to Modal -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const monthSelect = document.getElementById('monthChooseModal');
        const currentMonth = new Date().getMonth(); // getMonth() returns 0-11
        const months = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        months.forEach((month, index) => {
            const option = document.createElement('option');
            option.value = index + 1; // Months are 1-12
            option.textContent = month;
            if (index === currentMonth) {
                option.selected = true;
            }
            monthSelect.appendChild(option);
        });
    });
</script>
<!-- UpMonth Option to Modal -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const monthSelect = document.getElementById('upmonthChooseModal');
        const currentMonth = new Date().getMonth(); // getMonth() returns 0-11
        const months = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        months.forEach((month, index) => {
            const option = document.createElement('option');
            option.value = index + 1; // Months are 1-12
            option.textContent = month;
            if (index === currentMonth) {
                option.selected = true;
            }
            monthSelect.appendChild(option);
        });
    });
</script>
<!-- Payroll Period to Modal -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ppSelect = document.getElementById('ppChooseModal');
        const currentDay = new Date().getDate(); // Get the current day of the month
        const periods = [{
                value: '1st Period',
                text: '1st Period'
            },
            {
                value: '2nd Period',
                text: '2nd Period'
            },
            {
                value: 'Special Period',
                text: 'Special Period'
            }
        ];

        periods.forEach(period => {
            const option = document.createElement('option');
            option.value = period.value;
            option.textContent = period.text;
            if ((currentDay >= 1 && currentDay <= 15 && period.value === '1st Period') ||
                (currentDay >= 16 && period.value === '2nd Period')) {
                option.selected = true;
            }
            ppSelect.appendChild(option);
        });
    });
</script>
<!-- Payroll Period to Modal -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ppSelect = document.getElementById('upppChooseModal');
        const currentDay = new Date().getDate(); // Get the current day of the month
        const periods = [{
                value: '1st Period',
                text: '1st Period'
            },
            {
                value: '2nd Period',
                text: '2nd Period'
            },
            {
                value: 'Special Period',
                text: 'Special Period'
            }
        ];

        periods.forEach(period => {
            const option = document.createElement('option');
            option.value = period.value;
            option.textContent = period.text;
            if ((currentDay >= 1 && currentDay <= 15 && period.value === '1st Period') ||
                (currentDay >= 16 && period.value === '2nd Period')) {
                option.selected = true;
            }
            ppSelect.appendChild(option);
        });
    });
</script>
<!-- TS id Call Value -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const updateButtons = document.querySelectorAll('.update-buttonTS');

        updateButtons.forEach(button => {
            button.addEventListener('click', function() {
                const row = button.closest('tr');
                const tsID = row.getAttribute('data-id');
                const is_locked = row.getAttribute('data-lock');
                const month = row.getAttribute('data-month');
                const year = row.getAttribute('data-year');
                const pp = row.getAttribute('data-pp');
                const pq = row.getAttribute('data-pq');
                const sd = row.getAttribute('data-sdate');
                const ed = row.getAttribute('data-edate');

                document.getElementById('idUpTS').value = tsID;
                document.getElementById('upmonthChooseModal').value = month;
                document.getElementById('upyearChooseModal').value = year;
                document.getElementById('upppChooseModal').value = pp;
                document.getElementById('uppfChooseModal').value = pq;
                document.getElementById('upsdateModal').value = sd;
                document.getElementById('upedateModal').value = ed;
            });
        });
    });
</script>

<?php

include("../footer.php");

?>