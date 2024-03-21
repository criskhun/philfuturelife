<?php 
session_start();

if (isset($_SESSION["authenticated"]))
{
    $_SESSION['status'] = "You are already logged In.";
    header("Location: apps/dashboard.php");
    exit(0);
}

$page_title = "Password Change Update";
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
                        <h5>Change Password</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="password-reset-code.php" method="POST">
                            <input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])) {echo $_GET['token'];} ?>">
                            <div class="form-group mb-3">
                                <label for="">Email Address</label>
                                <input type="text" name="email" value="<?php if(isset($_GET['email'])) {echo $_GET['email'];} ?>" class="form-control" placeholder="Enter Email Address" readonly>
                            </div>
                            <div class="input-group mb-3">
                            <label for="password">New Password</label>
                                <div class="input-group">
                                    <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter New Password">
                                    <button class="btn btn-outline-secondary" style="opacity: 0.3;" type="button" onclick="togglePasswordVisibility('password', this)">
                                        <span class="fa fa-eye" id="password-toggle-icon"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                            <label for="password">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Enter Confirm Password" onkeyup="validatePassword()">
                                    <button class="btn btn-outline-secondary" style="opacity: 0.3;" type="button" onclick="togglePasswordVisibility('confirm_password', this)">
                                        <span class="fa fa-eye" id="password-toggle-icon"></span>
                                    </button>
                                </div>
                            </div>
                            <div id="confirm-password-feedback" style="display: none;">Passwords do not match!</div>
                            <div class="form-group mb-3">
                                <button type="submit" name="password_update" class="btn btn-success w-100">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePasswordVisibility(fieldId, toggleButton) {
    var input = document.getElementById(fieldId);
    var icon = toggleButton.querySelector('.fa');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}

function validatePassword() {
    var password = document.getElementById('new_password').value;
    var confirmPassword = document.getElementById('confirm_password').value;
    var feedback = document.getElementById('confirm-password-feedback');

    if (password !== confirmPassword) {
        feedback.style.display = 'block';
        feedback.style.color = 'red';
    } else {
        feedback.style.display = 'none';
    }
}
</script>

<?php include('includes/footer.php'); ?>