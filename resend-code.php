<?php
session_start();
include("dbconn.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
function resend_email_verify($name, $email, $verify_token) 
{
    $mail = new PHPMailer(true);
    //$mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.gmail.com";
    $mail->Username = "crispark30@gmail.com";
    $mail->Password = "offn ubgo juho sxbe";

    $mail->SMTPSecure = "tls";
    $mail->Port = 587;

    $mail->setFrom("crispark30@gmail.com",$name);
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = "Resent - Email Verification from Ninja Cris";

    $email_template = "
    <h2>You have Registered with NinjaCris</h2>
    <h5>Verify your email address to login with the below given link</h5>
    <br/><br/>
    <a href='http://localhost/philfuturelife/verify-email.php?token=$verify_token'> Click Me </a>
    ";

    $mail->Body = $email_template;
    $mail->send();
    echo 'Message has been sent';
}

if(isset($_POST['resend_email_verification_btn']))
{
    if(!empty(trim($_POST['email'])))
    {
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        $checkemail_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $checkemail_query_run = mysqli_query($conn, $checkemail_query);

        if(mysqli_num_rows($checkemail_query_run) > 0)
        {
            $row = mysqli_fetch_array($checkemail_query_run);
            if($row['verify_status'] == "0")
            {
                $name = $row['name'];
                $email = $row['email'];
                $verify_token = $row['verify_token'];

                resend_email_verify($name, $email, $verify_token);
                $_SESSION['status'] = "Verification email has been sent to your email address";
                header("Location: login.php");
                exit(0);
            }
            else
            {
                $_SESSION['status'] = "Email is already verify. Please login.!";
                header("Location: resend-email-verification.php");
                exit(0);
            }
        }
        else{
            $_SESSION['status2'] = "Email is not registered, please registere now!";
            header("Location: register.php");
            exit(0);
        }
    }
    else
    {
        $_SESSION['status2'] = "Please enter the email field";
        header("Location: resend-email-verification.php");
        exit(0);
    }
}

?>