<?php
$page_title = "BIR and Loan";
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
            $activeTab = isset($_GET['activeTab']) ? $_GET['activeTab'] : 'bir';
            ?>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($activeTab == 'bir') ? 'active' : ''; ?> " data-bs-toggle="tab" href="#bir">BIR</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($activeTab == 'loan') ? 'active' : ''; ?> " data-bs-toggle="tab" href="#loan">Loan</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane <?php echo ($activeTab == 'bir') ? 'active' : 'fade'; ?>" id="bir">
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
                                    <h5>BIR Table</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" class="text-center">Payroll Frequency</th>
                                                <th colspan="2" class="text-center">Bracket</th>
                                                <th rowspan="2" class="text-center">Fix</th>
                                                <th rowspan="2" class="text-center">Rate</th>
                                                <th colspan="2" class="text-center">Options</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Range 1</th>
                                                <th class="text-center">Range 2</th>
                                                <th class="text-center">
                                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#birModal">
                                                        <i class="fa-regular fa-square-plus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-danger">
                                                        <i class="fa-regular fa-square-minus"></i>
                                                    </button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include_once("../../dbconn.php");
                                            $query = "SELECT * FROM bir_table ORDER BY id ASC";
                                            $result = mysqli_query($conn, $query);
                                            if ($result->num_rows > 0) {
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $birID = $row['id'];
                                                    $frq = $row['payroll_fq'];
                                                    $range1 = $row['range1'];
                                                    $range2 = $row['range2'];
                                                    $fix = $row['fix'];
                                                    $rate = $row['rate'];
                                            ?>
                                                    <tr data-id="<?php echo $birID ?>" data-frq="<?php echo $frq ?>" data-range1="<?php echo $range1 ?>" data-range2="<?php echo $range2 ?>" data-fix="<?php echo $fix ?>" data-rate="<?php echo $rate ?>">
                                                        <td hidden><?php echo $birID ?></td>
                                                        <td><?php echo $frq ?></td>
                                                        <td><?php echo '₱' . number_format($range1, 2); ?></td>
                                                        <td><?php echo '₱' . number_format($range2, 2); ?></td>
                                                        <td><?php echo '₱' . number_format($fix, 2); ?></td>
                                                        <td><?php echo number_format($rate, 2); ?></td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-outline-success update-buttonBIR" data-bs-toggle="modal" data-bs-target="#birUpModal">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </button>
                                                            <form action="../assets/mandatoryBen_server.php" method="POST" style="display:inline;">
                                                                <input type="hidden" name="delete_idBIR" value="<?php echo $birID ?>">
                                                                <button type="submit" name="deleteBIR" class="btn btn-outline-danger">
                                                                    <i class="fa-regular fa-square-minus"></i>
                                                                </button>
                                                            </form>
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
                <div class="tab-pane <?php echo ($activeTab == 'loan') ? 'active' : 'fade'; ?>" id="loan">

                </div>
            </div>
        </main>
    </div>
</div>

<!-- The Add bir data -->
<div class="modal" id="birModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../assets/mandatoryBen_server.php" method="POST">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add BIR data Table </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <h6>Compensation Range</h6>
                    <div class="form-floating mb-3 mt-3">
                        <select class="form-select" id="sel1" name="sellist">
                            <option>Daily</option>
                            <option>Weekly</option>
                            <option>Semi-Monthly</option>
                            <option>Monthly</option>
                        </select>
                        <label for="sel1" class="form-label">Select list (select one):</label>
                    </div>
                    <h6>Bracket</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="birRange1" placeholder="Range 1" name="birRange1" step="0.01" required>
                                <label for="birRange1">Range 1</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="birRange2" placeholder="Range 2" name="birRange2" step="0.01" required>
                                <label for="birRange2">Range 2</label>
                            </div>
                        </div>
                    </div>
                    <h6>Fix & Rate</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="birFix" placeholder="Fix" name="birFix" step="0.01">
                                <label for="birFix">Fix</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="birRate" placeholder="Rate" name="birRate" step="0.01">
                                <label for="birRate">Rate</label>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" name="birtableInsert" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- The update BIR data modal -->
<div class="modal" id="birUpModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../assets/mandatoryBen_server.php" method="POST">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Update BIR Data Table</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <input type="hidden" id="idUpBIR" name="idUpBIR">
                    <h6>Compensation Range</h6>
                    <div class="form-floating mb-3 mt-3">
                        <select class="form-select" id="sel1up" name="sellistup">
                            <option>Daily</option>
                            <option>Weekly</option>
                            <option>Semi-Monthly</option>
                            <option>Monthly</option>
                        </select>
                        <label for="sel1up" class="form-label">Select list (select one):</label>
                    </div>
                    <h6>Bracket</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="birRange1up" placeholder="Range 1" name="birRange1up" step="0.01" required>
                                <label for="birRange1up">Range 1</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="birRange2up" placeholder="Range 2" name="birRange2up" step="0.01" required>
                                <label for="birRange2up">Range 2</label>
                            </div>
                        </div>
                    </div>
                    <h6>Fix & Rate</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="birFixup" placeholder="Fix" name="birFixup" step="0.01">
                                <label for="birFixup">Fix</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="birRateup" placeholder="Rate" name="birRateup" step="0.01">
                                <label for="birRateup">Rate</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" name="birtableUpdate" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- BIR Update Modal Call Value -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const updateButtons = document.querySelectorAll('.update-buttonBIR');

        updateButtons.forEach(button => {
            button.addEventListener('click', function() {
                const row = button.closest('tr');
                const birID = row.getAttribute('data-id');
                const range1 = row.getAttribute('data-range1');
                const range2 = row.getAttribute('data-range2');
                const frq = row.getAttribute('data-frq');
                const fix = row.getAttribute('data-fix');
                const rate = row.getAttribute('data-rate');

                document.getElementById('idUpBIR').value = birID;
                document.getElementById('birRange1up').value = range1;
                document.getElementById('birRange2up').value = range2;
                document.getElementById('sel1up').value = frq;
                document.getElementById('birFixup').value = fix;
                document.getElementById('birRateup').value = rate;
            });
        });
    });
</script>

<?php

include("../footer.php");

?>