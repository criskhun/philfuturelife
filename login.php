<?php 
session_start();
require_once 'vendor/autoload.php';

$clientID = '656033405692-h3hnlt8osglalnpi06hjnq8nii9t34jp.apps.googleusercontent.com';
$clientSecret = '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';
$redirectionUrl = 'http://localhost/philfuturelife/login.php';

//Creating Google Request
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectionUrl);
$client->addScope('profile');
$client->addScope('email');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    $oauth2 = new Google_Service_Oauth2($client);
    $userInfo = $oauth2->userinfo->get();

    // Store user information in session variables
    $_SESSION['email'] = $userInfo->email;
    $_SESSION['name'] = $userInfo->name;
    $_SESSION['authenticated'] = true;

    // Redirect to create-password.php
    header('Location: create-password.php');
    exit(0);
}

// Check if the user is already authenticated
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    $_SESSION['status'] = "You are already logged In.";
    header("Location: apps/admin_panel.php");
    exit(0);
}

$page_title = "Login Page";
include('includes/header.php');
include('includes/navbar.php');

$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';
?>

<div class="py-5" id="background-image">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php include('includes/status.php'); ?>
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Welcome to PhilFutureLife</h5>
                    </div>
                    <div class="card-body">
                        <form action="loginCode.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="">Email Address</label>
                                <input type="text" name="email" value="<?= $email ?>" class="form-control">
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
                            <div>
                                <a href="password-reset.php" class="float-start no-underline">Forget Your Password?</a>
                            </div>
                            <br>
                            <br>
                            <button type="submit" name="login_now_btn" class="btn btn-primary my-button">Sign in</button>
                            <hr>
                            <a href="<?php echo $client->createAuthUrl(); ?>" type="button" name="login_google" class="btn my-button2"><i class="fab fa-google"></i> Continue with Google</a>
                            <br><br>
                            <a type="submit" name="login_facebook" class="btn my-button2"><i class="fab fa-facebook"></i> Continue with Facebook</a>
                            <hr>
                            <p>Did not receive your Verification Email? <a href="resend-email-verification.php">Resend</a></p>
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
</script>

<?php include('includes/footer.php'); ?>
