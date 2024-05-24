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
                    <?php 
                        include("../profileInfo.php");
                    ?>
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