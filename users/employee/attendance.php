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
                <div class="row" style="display: flex;">
                    <div class="col" style="display: flex; align-items: stretch;">
                        <div class="card" style="width:400px">
                            <img class="card-img-top" src="img_avatar1.png" alt="Card image">
                            <div class="card-body">
                                <h4 class="card-title">John Doe</h4>
                                <p class="card-text">Some example text.</p>
                                <a href="#" class="btn btn-primary">See Profile</a>
                            </div>
                        </div>
                    </div>
                    <div class="col" style="display: flex; align-items: stretch;">
                        <div class="card" style="width:400px">
                            <img class="card-img-top" src="img_avatar1.png" alt="Card image">
                            <div class="card-body">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="display: flex;">
                    <div class="col" style="display: flex; align-items: stretch;">
                        <div class="card" style="width:400px">
                            <img class="card-img-top" src="img_avatar1.png" alt="Card image">
                            <div class="card-body">
                                <h4 class="card-title">John Doe</h4>
                                <p class="card-text">Some example text.</p>
                                <a href="#" class="btn btn-primary">See Profile</a>
                            </div>
                        </div>
                    </div>
                    <div class="col" style="display: flex; align-items: stretch;">
                        <div class="card" style="width:400px">
                            <img class="card-img-top" src="img_avatar1.png" alt="Card image">
                            <div class="card-body">
                                
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </main>
        <?php 
        //include("../usersFooter.php")
        ?>
    </div>
</div>

<?php 

include("../footer.php");

?>