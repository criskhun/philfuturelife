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
            <div class="container-fluid">
                <div class="mb-3">
                    <h3 class="fw-bold fs-4 mb-3">Employee Dashboard</h3>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="card cardDB border-0">
                                <div class="card-body py-4">
                                    <h5 class="mb-2 fw-bold">
                                        Monthly Net Income
                                    </h5>
                                    <p class="mb-2 fw-bold">
                                        P12,540
                                    </p>
                                    <div class="mb-0">
                                        <span class="badge text-success me-2">
                                            +2.3%
                                        </span>
                                        <span class="fw-bold">
                                            Since Last Month
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card cardDB border-0">
                                <div class="card-body py-4">
                                    <h5 class="mb-2 fw-bold">
                                        Monthly Gross Income
                                    </h5>
                                    <p class="mb-2 fw-bold">
                                        P15,890
                                    </p>
                                    <div class="mb-0">
                                        <span class="badge text-success me-2">
                                            +2.0%
                                        </span>
                                        <span class="fw-bold">
                                            Since Last Month
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card cardDB border-0">
                                <div class="card-body py-4">
                                    <h5 class="mb-2 fw-bold">
                                        Annual Total Income
                                    </h5>
                                    <p class="mb-2 fw-bold">
                                        P163,110
                                    </p>
                                    <div class="mb-0">
                                        <span class="badge text-success me-2">
                                            +9.0%
                                        </span>
                                        <span class="fw-bold">
                                            Since Last Year
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3 class="fw-bold fs-4 my-3">Top Task</h3>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-hover">
                            <thead>
                                <tr class="highlight">
                                <th scope="col">#</th>
                                <th scope="col">Task</th>
                                <th scope="col">Given by</th>
                                <th scope="col">Urgency</th>
                                <th scope="col">Status</th>
                                <th scope="col">Due Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th scope="row">1</th>
                                <td class="goto-task"><a href="#">HR Manual Encoding</a></td>
                                <td>
                                    <img src="../../images/secretary.png" alt="" class="small-profile">
                                    Princess Yap
                                </td>
                                <td><span class="badge bg-danger">High</span></td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td><i class="fa-regular fa-clock text-warning"></i> May 15, 2024</td>
                                </tr>
                                <tr>
                                <th scope="row">2</th>
                                <td class="goto-task"><a href="#">Documentation</a></td>
                                <td>
                                    <img src="../../images/manager.png" alt="" class="small-profile">
                                    Dwight Joshua Millana
                                </td>
                                <td><span class="badge bg-success">Low</span></td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td><i class="fa-regular fa-clock"></i> May 30, 2024</td>
                                </tr>
                                <tr>
                                <th scope="row">3</th>
                                <td class="goto-task"><a href="#">Record Tracking</a></td>
                                <td>
                                    <img src="../../images/man.png" alt="" class="small-profile">
                                    Sammy Sta Rosa
                                </td>
                                <td><span class="badge bg-warning">Medium</span></td>
                                <td><span class="badge bg-info">For Approval</span></td>
                                <td><i class="fa-regular fa-clock text-danger"></i> May 13, 2024</td>
                                </tr>
                            </tbody>
                            </table>
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