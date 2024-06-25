<?php
$page_title = "Mandatory Benefits";
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
            $activeTab = isset($_GET['activeTab']) ? $_GET['activeTab'] : 'sss';
            ?>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($activeTab == 'sss') ? 'active' : ''; ?> " data-bs-toggle="tab" href="#sss">SSS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($activeTab == 'hdmf_phic') ? 'active' : ''; ?> " data-bs-toggle="tab" href="#hdmf_phic">HDMF & PHIC</a>
                </li>                
            </ul>

            <div class="tab-content">
                <div class="tab-pane <?php echo ($activeTab == 'sss') ? 'active' : 'fade'; ?>" id="sss">
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
                                    <h5>SSS Table</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th colspan="2" class="text-center">Compensation Range</th>
                                                <th colspan="2" class="text-center">Regular SS</th>
                                                <th colspan="1" class="text-center">EC</th>
                                                <th colspan="3" class="text-center">WISP</th>
                                                <th colspan="3" class="text-center">Total</th>
                                                <th colspan="2" class="text-center">Options</th>

                                            </tr>
                                            <tr>
                                                <th class="text-center">Range 1</th>
                                                <th class="text-center">Range 2</th>
                                                <th class="text-center">ER</th>
                                                <th class="text-center">EE</th>
                                                <th class="text-center">ER</th>
                                                <th class="text-center">ER</th>
                                                <th class="text-center">EE</th>
                                                <th class="text-center">TOTAL</th>
                                                <th class="text-center">ER</th>
                                                <th class="text-center">EE</th>
                                                <th class="text-center">TOTAL</th>
                                                <th class="text-center">
                                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#sssModal">
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
                                            $query = "SELECT * FROM sss_table ORDER BY id ASC";
                                            $result = mysqli_query($conn, $query);
                                            if ($result->num_rows > 0) {
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $sssID = $row['id'];
                                                    $range1 = $row['range1'];
                                                    $range2 = $row['range2'];
                                                    $er = $row['er'];
                                                    $ee = $row['ee'];
                                                    $ec = $row['ec'];
                                                    $wispER = $row['wispER'];
                                                    $wispEE = $row['wispEE'];
                                                    $wispTotal = $row['wispTotal'];
                                                    $t_er = $row['t_er'];
                                                    $t_ee = $row['t_ee'];
                                                    $total = $row['total'];


                                            ?>

                                                    <tr data-id="<?php echo $sssID ?>" data-range1="<?php echo $range1 ?>" data-range2="<?php echo $range2 ?>" data-er="<?php echo $er ?>" data-ee="<?php echo $ee ?>" data-ec="<?php echo $ec ?>" data-wisper="<?php echo $wispER ?>" data-wispee="<?php echo $wispEE ?>" data-wisptotal="<?php echo $wispTotal ?>" data-ter="<?php echo $t_er ?>" data-tee="<?php echo $t_ee ?>" data-total="<?php echo $total ?>">
                                                        <td hidden><?php echo $sssID ?></td>
                                                        <td><?php echo '₱' . number_format($range1, 2); ?></td>
                                                        <td><?php echo '₱' . number_format($range2, 2); ?></td>
                                                        <td><?php echo '₱' . number_format($er, 2); ?></td>
                                                        <td><?php echo '₱' . number_format($ee, 2); ?></td>
                                                        <td><?php echo '₱' . number_format($ec, 2); ?></td>
                                                        <td><?php echo '₱' . number_format($wispER, 2); ?></td>
                                                        <td><?php echo '₱' . number_format($wispEE, 2); ?></td>
                                                        <td><?php echo '₱' . number_format($wispTotal, 2); ?></td>
                                                        <td><?php echo '₱' . number_format($t_er, 2); ?></td>
                                                        <td><?php echo '₱' . number_format($t_ee, 2); ?></td>
                                                        <td><?php echo '₱' . number_format($total, 2); ?></td>
                                                <?php
                                                    echo '
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-outline-success update-button" data-bs-toggle="modal" data-bs-target="#sssUpModal">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </button>
                                                            <form action="../assets/mandatoryBen_server.php" method="POST" style="display:inline;">
                                                                <input type="hidden" name="delete_id" value= ' . $sssID . '>
                                                                <button type="submit" name="deleteRecord" class="btn btn-outline-danger">
                                                                    <i class="fa-regular fa-square-minus"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    ';
                                                }
                                            }
                                                ?>
                                                    </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane <?php echo ($activeTab == 'hdmf_phic') ? 'active' : 'fade'; ?>" id="hdmf_phic">
                    <div class="col-sm-12 mb-2 mt-2">
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
                            <div class="card-header">
                                <h5>HDMF Table</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th colspan="1" class="text-center">Fund Salary</th>
                                            <th colspan="2" class="text-center">Range</th>
                                            <th colspan="2" class="text-center">Percent Share</th>
                                            <th colspan="2" class="text-center">Total</th>
                                            <th colspan="1" class="text-center">Total</th>
                                            <th colspan="2" class="text-center">Options</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Maximum</th>
                                            <th class="text-center">Range 1</th>
                                            <th class="text-center">Range 2</th>
                                            <th class="text-center">ER</th>
                                            <th class="text-center">EE</th>
                                            <th class="text-center">ER</th>
                                            <th class="text-center">EE</th>
                                            <th class="text-center">TOTAL</th>
                                            <th class="text-center">
                                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#hdmfModal">
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
                                        $query = "SELECT * FROM hdmf_table ORDER BY id ASC";
                                        $result = mysqli_query($conn, $query);
                                        if ($result->num_rows > 0) {
                                            while ($row = mysqli_fetch_array($result)) {
                                                $hdmfID = $row['id'];
                                                $maxFund = $row['max_fund'];
                                                $range1 = $row['range1'];
                                                $range2 = $row['range2'];
                                                $er = $row['ps_er'];
                                                $ee = $row['ps_ee'];
                                                $t_er = $row['t_er'];
                                                $t_ee = $row['t_ee'];
                                                $total = $row['total'];
                                        ?>
                                                <tr data-id="<?php echo $hdmfID ?>" data-max="<?php echo $maxFund ?>" data-range1="<?php echo $range1 ?>" data-range2="<?php echo $range2 ?>" data-er="<?php echo $er ?>" data-ee="<?php echo $ee ?>" data-ter="<?php echo $t_er ?>" data-tee="<?php echo $t_ee ?>">                                                    
                                                    <td><?php echo '₱' . number_format($maxFund, 2); ?></td>
                                                    <td><?php echo '₱' . number_format($range1, 2); ?></td>
                                                    <td><?php echo '₱' . number_format($range2, 2); ?></td>
                                                    <td><?php echo '₱' . number_format($er, 2); ?></td>
                                                    <td><?php echo '₱' . number_format($ee, 2); ?></td>
                                                    <td><?php echo '₱' . number_format($t_er, 2); ?></td>
                                                    <td><?php echo '₱' . number_format($t_ee, 2); ?></td>
                                                    <td><?php echo '₱' . number_format($total, 2); ?></td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-outline-success update-buttonHDMF" data-bs-toggle="modal" data-bs-target="#hdmfUpModal">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                        <form action="../assets/mandatoryBen_server.php" method="POST" style="display:inline;">
                                                            <input type="hidden" name="delete_idHMDF" value="<?php echo $hdmfID ?>">
                                                            <button type="submit" name="deleteHMDF" class="btn btn-outline-danger">
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
                    <br>
                    <div class="col-sm-12 mb-2 mt-2">
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
                            <div class="card-header">
                                <h5>PHIC Table</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th colspan="2" class="text-center">Salary Bracket</th>
                                            <th colspan="3" class="text-center">Percent</th>                                  
                                            <th colspan="2" class="text-center">Range EE</th>
                                            <th colspan="2" class="text-center">Range ER</th>
                                            <th colspan="2" class="text-center">Options</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Range 1</th>
                                            <th class="text-center">Range 2</th>
                                            <th class="text-center">ER</th>
                                            <th class="text-center">EE</th>
                                            <th class="text-center">Total</th>

                                            <th class="text-center">MIN</th>
                                            <th class="text-center">MAX</th>
                                            <th class="text-center">MIN</th>
                                            <th class="text-center">MAX</th>
                                            
                                            <th class="text-center">
                                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#phicModal">
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
                                        $query = "SELECT * FROM phic_table ORDER BY id ASC";
                                        $result = mysqli_query($conn, $query);
                                        if ($result->num_rows > 0) {
                                            while ($row = mysqli_fetch_array($result)) {
                                                $phicID = $row['id'];
                                                $range1 = $row['range1'];
                                                $range2 = $row['range2'];
                                                $er = $row['er'];
                                                $ee = $row['ee'];
                                                $total = $row['total'];
                                                $minee = $row['min_ee'];
                                                $maxee = $row['max_ee'];
                                                $miner = $row['min_er'];
                                                $maxer = $row['max_er'];
                                                
                                        ?>
                                                <tr data-id="<?php echo $phicID ?>" data-range1="<?php echo $range1 ?>" data-range2="<?php echo $range2 ?>" data-er="<?php echo $er ?>" data-ee="<?php echo $ee ?>" data-minee="<?php echo $minee?>" data-maxee="<?php echo $maxee?>" data-miner="<?php echo $miner?>" data-maxer="<?php echo $maxer?>">                                                                                                        
                                                    <td><?php echo '₱' . number_format($range1, 2); ?></td>
                                                    <td><?php echo '₱' . number_format($range2, 2); ?></td>
                                                    <td><?php echo '%' . number_format($er, 2); ?></td>
                                                    <td><?php echo '%' . number_format($ee, 2); ?></td>
                                                    <td><?php echo '%' . number_format($total, 2); ?></td>
                                                    
                                                    <td><?php echo '₱' . number_format($minee, 2); ?></td>
                                                    <td><?php echo '₱' . number_format($maxee, 2); ?></td>
                                                    <td><?php echo '₱' . number_format($miner, 2); ?></td>
                                                    <td><?php echo '₱' . number_format($maxer, 2); ?></td>
                                                    
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-outline-success update-buttonPHIC" data-bs-toggle="modal" data-bs-target="#phicUpModal">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                        <form action="../assets/mandatoryBen_server.php" method="POST" style="display:inline;">
                                                            <input type="hidden" name="delete_idPHIC" value="<?php echo $phicID ?>">
                                                            <button type="submit" name="deletePHIC" class="btn btn-outline-danger">
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
        </main>
    </div>
</div>

<!-- The Add SSS data -->
<div class="modal" id="sssModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../assets/mandatoryBen_server.php" method="POST">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add SSS data Table </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <h6>Compensation Range</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="compRange1" placeholder="Range 1" name="compRange1" step="0.01" required>
                                <label for="compRange1">Range 1</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="compRange2" placeholder="Range 2" name="compRange2" step="0.01" required>
                                <label for="compRange2">Range 2</label>
                            </div>
                        </div>
                    </div>
                    <h6>Regular SS</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="rSER" placeholder="ER" name="rSER" step="0.01" required>
                                <label for="rSER">ER</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="rSEE" placeholder="EE" name="rSEE" step="0.01" required>
                                <label for="rSEE">EE</label>
                            </div>
                        </div>
                    </div>
                    <h6>EC</h6>
                    <div class="form-floating mb-3 mt-3">
                        <input type="number" class="form-control" id="EC" placeholder="EC" name="EC" step="0.01" required>
                        <label for="EC">EC</label>
                    </div>
                    <hr>
                    <h6>WISP</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="wispER" placeholder="ER" name="wispER" step="0.01">
                                <label for="wispER">ER</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="wispEE" placeholder="EE" name="wispEE" step="0.01">
                                <label for="wispER">EE</label>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" name="ssstableInsert" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- The Update SSS data -->
<div class="modal" id="sssUpModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../assets/mandatoryBen_server.php" method="POST">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Update SSS data Table </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <h6>Compensation Range</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="compRange1up" placeholder="Range 1" name="compRange1up" step="0.01" required>
                                <label for="compRange1up">Range 1</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="compRange2up" placeholder="Range 2" name="compRange2up" step="0.01" required>
                                <label for="compRange2up">Range 2</label>
                            </div>
                        </div>
                    </div>
                    <h6>Regular SS</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="rSERup" placeholder="ER" name="rSERup" step="0.01" required>
                                <label for="rSERup">ER</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="rSEEup" placeholder="EE" name="rSEEup" step="0.01" required>
                                <label for="rSEEup">EE</label>
                            </div>
                        </div>
                    </div>
                    <h6>EC</h6>
                    <div class="form-floating mb-3 mt-3">
                        <input type="number" class="form-control" id="ECup" placeholder="EC" name="ECup" step="0.01" required>
                        <label for="ECup">EC</label>
                    </div>
                    <hr>
                    <h6>WISP</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="wispERup" placeholder="ER" name="wispERup" step="0.01">
                                <label for="wispERup">ER</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="wispEEup" placeholder="EE" name="wispEEup" step="0.01">
                                <label for="wispERup">EE</label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="idUp" placeholder="ID" name="idUp" step="0.01">


                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" name="ssstableUpdate" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SSS Update Modal Call Value -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const updateButtons = document.querySelectorAll('.update-button');

        updateButtons.forEach(button => {
            button.addEventListener('click', function() {
                const row = button.closest('tr');
                const sssID = row.getAttribute('data-id');
                const range1 = row.getAttribute('data-range1');
                const range2 = row.getAttribute('data-range2');
                const er = row.getAttribute('data-er');
                const ee = row.getAttribute('data-ee');
                const ec = row.getAttribute('data-ec');
                const wisper = row.getAttribute('data-wisper');
                const wispee = row.getAttribute('data-wispee');
                const wisptotal = row.getAttribute('data-wisptotal');
                const ter = row.getAttribute('data-ter');
                const tee = row.getAttribute('data-tee');
                const total = row.getAttribute('data-total');

                document.getElementById('idUp').value = sssID;
                document.getElementById('compRange1up').value = range1;
                document.getElementById('compRange2up').value = range2;
                document.getElementById('rSERup').value = er;
                document.getElementById('rSEEup').value = ee;
                document.getElementById('ECup').value = ec;
                document.getElementById('wispERup').value = wisper;
                document.getElementById('wispEEup').value = wispee;
            });
        });
    });
</script>

<!-- The Add HMDF data -->
<div class="modal" id="hdmfModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../assets/mandatoryBen_server.php" method="POST">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add HDMF data Table </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <h6>Max Fund Salary</h6>
                    <div class="form-floating mb-3 mt-3">
                        <input type="number" class="form-control" id="max" placeholder="Max" name="max" step="0.01" required>
                        <label for="EC">Max</label>
                    </div>
                    <h6>Fund Range</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="fundRange1" placeholder="Range 1" name="fundRange1" step="0.01" required>
                                <label for="fundRange1">Range 1</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="fundRange2" placeholder="Range 2" name="fundRange2" step="0.01" required>
                                <label for="fundRange2">Range 2</label>
                            </div>
                        </div>
                    </div>
                    <h6>Percent Share</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="pER" placeholder="ER" name="pER" step="0.01" required>
                                <label for="pER">ER</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="pEE" placeholder="EE" name="pEE" step="0.01" required>
                                <label for="pEE">EE</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" name="hdmftableInsert" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- The Update HDMF Modal -->
<div class="modal" id="hdmfUpModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../assets/mandatoryBen_server.php" method="POST">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Update HDMF Data Table</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <input type="hidden" id="idhdmfUp" name="idhdmfUp">
                    <h6>Max Fund Salary</h6>
                    <div class="form-floating mb-3 mt-3">
                        <input type="number" class="form-control" id="maxUp" placeholder="Max" name="maxUp" step="0.01" required>
                        <label for="maxUp">Max</label>
                    </div>
                    <h6>Fund Range</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="fundRange1up" placeholder="Range 1" name="fundRange1up" step="0.01" required>
                                <label for="fundRange1up">Range 1</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="fundRange2up" placeholder="Range 2" name="fundRange2up" step="0.01" required>
                                <label for="fundRange2up">Range 2</label>
                            </div>
                        </div>
                    </div>
                    <h6>Percent Share</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="pERup" placeholder="ER" name="pERup" step="0.01" required>
                                <label for="pERup">ER</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="pEEup" placeholder="EE" name="pEEup" step="0.01" required>
                                <label for="pEEup">EE</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" name="hdmftableUpdate" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- HDMF Update Modal Call Value -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const updateButtons = document.querySelectorAll('.update-buttonHDMF');

        updateButtons.forEach(button => {
            button.addEventListener('click', function() {
                const row = button.closest('tr');
                const hdmfID = row.getAttribute('data-id');
                const max = row.getAttribute('data-max');
                const range1 = row.getAttribute('data-range1');
                const range2 = row.getAttribute('data-range2');
                const er = row.getAttribute('data-er');
                const ee = row.getAttribute('data-ee');

                document.getElementById('idhdmfUp').value = hdmfID;
                document.getElementById('maxUp').value = max;
                document.getElementById('fundRange1up').value = range1;
                document.getElementById('fundRange2up').value = range2;
                document.getElementById('pERup').value = er;
                document.getElementById('pEEup').value = ee;
            });
        });
    });
</script>

<!-- The Add PHIC data -->
<div class="modal" id="phicModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../assets/mandatoryBen_server.php" method="POST">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add PHIC data Table </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">                    
                    <h6>Salary Bracket</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="fundRange1" placeholder="Range 1" name="fundRange1" step="0.01" required>
                                <label for="fundRange1">Range 1</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="fundRange2" placeholder="Range 2" name="fundRange2" step="0.01" required>
                                <label for="fundRange2">Range 2</label>
                            </div>
                        </div>
                    </div>
                    <h6>Percent</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="pER" placeholder="ER" name="pER" step="0.01" required>
                                <label for="pER">ER</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="pEE" placeholder="EE" name="pEE" step="0.01" required>
                                <label for="pEE">EE</label>
                            </div>
                        </div>
                    </div>
                    <h6>Range EE</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="minEE" placeholder="MIN" name="minEE" step="0.01" required>
                                <label for="minEE">MIN</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="maxEE" placeholder="MAX" name="maxEE" step="0.01" required>
                                <label for="maxEE">MAX</label>
                            </div>
                        </div>
                    </div>
                    <h6>Range ER</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="minER" placeholder="MIN" name="minER" step="0.01" required>
                                <label for="minER">MIN</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="maxER" placeholder="MAX" name="maxER" step="0.01" required>
                                <label for="maxER">MAX</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" name="phictableInsert" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- The Update PHIC Modal -->
<div class="modal" id="phicUpModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../assets/mandatoryBen_server.php" method="POST">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Update PHIC Data Table</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <input type="hidden" id="idUpph" name="idUpph">
                    <h6>Salary Bracket</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="phicRange1up" placeholder="Range 1" name="phicRange1up" step="0.01" required>
                                <label for="phicRange1up">Range 1</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="phicRange2up" placeholder="Range 2" name="phicRange2up" step="0.01" required>
                                <label for="phicRange2up">Range 2</label>
                            </div>
                        </div>
                    </div>
                    <h6>Percent</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="phERup" placeholder="ER" name="phERup" step="0.01" required>
                                <label for="phERup">ER</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="phEEup" placeholder="EE" name="phEEup" step="0.01" required>
                                <label for="phEEup">EE</label>
                            </div>
                        </div>
                    </div>
                    <h6>Range EE</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="minEEup" placeholder="MIN" name="minEEup" step="0.01" required>
                                <label for="minEEup">MIN</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="maxEEup" placeholder="MAX" name="maxEEup" step="0.01" required>
                                <label for="maxEEup">MAX</label>
                            </div>
                        </div>
                    </div>
                    <h6>Range ER</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="minERup" placeholder="MIN" name="minERup" step="0.01" required>
                                <label for="minERup">MIN</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" id="maxERup" placeholder="MAX" name="maxERup" step="0.01" required>
                                <label for="maxERup">MAX</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" name="phictableUpdate" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- PHIC Update Modal Call Value -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const updateButtons = document.querySelectorAll('.update-buttonPHIC');

        updateButtons.forEach(button => {
            button.addEventListener('click', function() {
                const row = button.closest('tr');
                const phicID = row.getAttribute('data-id');
                const range1 = row.getAttribute('data-range1');
                const range2 = row.getAttribute('data-range2');
                const er = row.getAttribute('data-er');
                const ee = row.getAttribute('data-ee');
                const minee = row.getAttribute('data-minee');
                const maxee = row.getAttribute('data-maxee');
                const miner = row.getAttribute('data-miner');
                const maxer = row.getAttribute('data-maxer');

                document.getElementById('idUpph').value = phicID;
                document.getElementById('phicRange1up').value = range1;
                document.getElementById('phicRange2up').value = range2;
                document.getElementById('phERup').value = er;
                document.getElementById('phEEup').value = ee;
                document.getElementById('minEEup').value = minee;
                document.getElementById('maxEEup').value = maxee;
                document.getElementById('minERup').value = miner;
                document.getElementById('maxERup').value = maxer;
            });
        });
    });
</script>



<?php

include("../footer.php");

?>