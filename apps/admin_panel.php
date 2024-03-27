<?php 
include('../authentication.php');
$page_title = "Dashboard";
include('../includes/headerAuth.php');

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    // You can now use the $email variable in dashboard.php
}
?>

<div class="wrapper">
    <!--Side Bar -->
    <?php include('../includes/sidebar.php') ?>
    <div class="main">
        <!-- navbar -->
        <?php include('../includes/adminNavbar.php') ?>
        <main class="content px-3 py-2">
            <div class="container-fluid">
                <div class="m-3 admin-header">
                    <span><h4>Admin Dashboard |</h4></span>
                    <span><h6>Welcome back admin: <?= $email; ?></h6></span>
                </div>
            <!-- dashboard content -->
                <?php include('dashboard.php') ?>
            </div>
        </main>
        <!-- Theme toggler -->
        <?php include('../includes/themeToggler.php') ?>
        <!-- Footer -->
        <?php include('../includes/adminFooter.php') ?>
    </div>
</div>

<script src="../includes/chart.js"></script>

<?php include('../includes/footer.php'); ?>