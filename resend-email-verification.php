<?php 
session_start();

if (isset($_SESSION["authenticated"]))
{
    $_SESSION['status'] = "You are already logged In.";
    header("Location: apps/dashboard.php");
    exit(0);
}

$page_title = "Resend Verification";
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                    if (isset($_SESSION['status']))
                    {
                ?>
                    <div class="alert alert-success">
                        <h5><?= $_SESSION['status'] ?></h5>
                    </div>
                <?php 
                    unset($_SESSION['status']);
                    }
                ?>
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Resend Email Verification</h5>
                    </div>
                    <div class="card-body">
                        <form action="resend-code.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="">Email Address</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="resend_email_verification_btn" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>