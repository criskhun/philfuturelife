<?php 
include('../authentication.php');
$page_title = "Home Page";
include('../includes/header.php');
include('../includes/navbar.php');

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    // You can now use the $email variable in dashboard.php
}
?>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    include('../includes/status.php');
                ?>
                <div class="card">
                    <div class="card-header">
                        <h4>User Dashboard</h4>
                    </div>
                    <div class="card-body">
                        <h2>Access when you are login</h2>
                        <h4>with email and verification</h4>
                        <hr>
                        <h5>Email: <?= $email; ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>