<?php 
session_start();

if (isset($_SESSION["authenticated"]))
{
    $_SESSION['status'] = "You are already logged In.";
    header("Location: apps/dashboard.php");
    exit(0);
}

$page_title = "Registration Page";
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
                        <h5>Registration Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email Address</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="input-group mb-3">
                            <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control">
                                    <button class="btn btn-outline-secondary" style="opacity: 0.3;" type="button" onclick="togglePasswordVisibility('password', this)">
                                        <span class="fa fa-eye" id="password-toggle-icon"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                            <label for="confirm_password">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" onkeyup="validatePassword()">
                                    <button class="btn btn-outline-secondary" style="opacity: 0.3;" type="button" onclick="togglePasswordVisibility('confirm_password', this)">
                                        <span class="fa fa-eye" id="confirm-password-toggle-icon"></span>
                                    </button>
                                </div>
                                <div id="confirm-password-feedback" style="display: none;">Passwords do not match!</div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="register_btn" class="btn btn-primary">Register Now</button>
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
    var password = document.getElementById('password').value;
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