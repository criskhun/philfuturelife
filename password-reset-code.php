<?php
session_start();
include("dbconn.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
function send_password_reset($get_name, $get_email, $token)
{
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.gmail.com";
    $mail->Username = "crispark30@gmail.com";
    $mail->Password = "offn ubgo juho sxbe";

    $mail->SMTPSecure = "tls";
    $mail->Port = 587;

    $mail->setFrom("crispark30@gmail.com",$get_name);
    $mail->addAddress($get_email);

    $mail->isHTML(true);
    $mail->Subject = "Reset Password Notification from Ninja Cris";

    $email_template = "
    <h2>Hello from NinjaCris</h2>
    <h5>You are receiving this email because we received a password reset request for your account</h5>
    <br/><br/>
    <a href='http://localhost/philfuturelife/password-change.php?token=$token&email=$get_email'> Click Me </a>
    ";

    $mail->Body = $email_template;
    $mail->send();
    echo 'Message has been sent';
}

if(isset($_POST["password_reset_link"]))
{
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT email FROM users WHERE email='$email' LIMIT 1";
    $check_email_run = mysqli_query($conn, $check_email);

    if(mysqli_num_rows($check_email_run) > 0)
    {
        $row = mysqli_fetch_array($check_email_run);
        $get_name = $row["name"];
        $get_email = $row["email"];

        $update_token = "UPDATE users SET verify_token='$token' WHERE email='$email' LIMIT 1 ";
        $update_token_run = mysqli_query($conn, $update_token);

        if($update_token_run)
        {
            send_password_reset($get_name, $get_email, $token);
            $_SESSION['status'] = "We e-mailed you a password reset link";
            header("Location: password-reset.php");
            exit(0);
        }
        else
        {
            $_SESSION['status2'] = "Something went wrong! #1";
            header("Location: password-reset.php");
            exit(0);
        }
    }
    else
    {
        $_SESSION['status2'] = "No Email Found";
        header("Location: password-reset.php");
        exit(0);
    }
}


if (isset($_POST["password_update"])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $new_password = $_POST['new_password']; // No need to escape passwords, they will be hashed
    $confirm_password = $_POST['confirm_password'];
    $token = mysqli_real_escape_string($conn, $_POST['password_token']);

    if (!empty($token)) {
        if (!empty($email) && !empty($new_password) && !empty($confirm_password)) {
            $check_token_query = "SELECT verify_token FROM users WHERE verify_token=? LIMIT 1";
            $stmt = mysqli_prepare($conn, $check_token_query);
            mysqli_stmt_bind_param($stmt, 's', $token);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                if ($new_password == $confirm_password) {
                    // Hash the new password
                    $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

                    $update_password_query = "UPDATE users SET password=?, verify_token=? WHERE verify_token=? LIMIT 1";
                    $stmt = mysqli_prepare($conn, $update_password_query);
                    $new_token = md5(rand()) . "Ninjutso"; // Generate a new token
                    mysqli_stmt_bind_param($stmt, 'sss', $hashed_new_password, $new_token, $token);
                    $update_password_success = mysqli_stmt_execute($stmt);

                    if ($update_password_success) {
                        $_SESSION['status'] = "New Password successfully Updated!";
                        header("Location: login.php");
                        exit(0);
                    } else {
                        $_SESSION['status2'] = "Did not update password. Something went wrong!";
                        header("Location: password-change.php?token=$token&email=$email");
                        exit(0);
                    }
                } else {
                    $_SESSION['status2'] = "New Password and Confirm Password does not match";
                    header("Location: password-change.php?token=$token&email=$email");
                    exit(0);
                }
            } else {
                $_SESSION['status2'] = "Invalid Token";
                header("Location: password-change.php?token=$token&email=$email");
                exit(0);
            }
        } else {
            $_SESSION['status2'] = "All fields are mandatory";
            header("Location: password-change.php?token=$token&email=$email");
            exit(0);
        }
    } else {
        $_SESSION['status2'] = "No Token Available";
        header("Location: password-change.php");
        exit(0);
    }
}



?>