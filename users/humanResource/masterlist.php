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
            <div class="row mb-4">
                <div class="col-sm-8 mt-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <label for="mlSearch" class="form-label">Search/Filter</label>
                                    <input type="text" class="form-control" id="mlSearch" placeholder="Search..." name="mlSearch">
                                </div>
                                <div class="col">
                                    <label for="email" class="form-label">Department:</label>
                                    <select class="form-select">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="email" class="form-label">Job Status:</label>
                                    <select class="form-select">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 mt-2">
                    <div class="card">
                        <div class="card-body">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 table-responsive">
                <table class="table table-hover">
                <thead>
                    <tr class="highlight">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email/Account</th>
                    <th scope="col">Employee ID</th>
                    <th scope="col">Department</th>
                    <th scope="col">Job Title</th>
                    <th scope="col">Job Status</th>
                    <th scope="col">Basic Salary</th>
                    <th scope="col">Allowance</th>
                    <th scope="col">Date Hired</th>
                    <th scope="col" class="sticky-col">Active/Inactive</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td class="goto-task">
                        <a href="">                            
                            <img src="../../images/secretary.png" alt="" class="small-profile">                            
                            <span class="profile-name">Crispin Jose Uriarte</span>                        
                        </a>
                    </td>
                    <td>crispark30@gmail.com</td>
                    <td>PFL-00001-2024</td>
                    <td>IT Department</td>
                    <td>ISA Manager</td>
                    <td>Contractor</td>
                    <td>25,000</td>
                    <td>5,000</td>
                    <td>May 01, 2024 <span class="badge bg-primary">>1 Year</span></td>
                    <td class="sticky-col"><span class="badge bg-success">Active</span></td>
                    </tr>
                    
                </tbody>
                </table>
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