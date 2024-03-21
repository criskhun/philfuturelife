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
                    include('includes/status.php');
                ?>
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Reset Password</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="password-reset-code.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="">Email Address</label>
                                <input type="text" name="email" class="form-control" placeholder="Enter Email Address">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="password_reset_link" class="btn btn-primary">Send Password Reset Link</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>