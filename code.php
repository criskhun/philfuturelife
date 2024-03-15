<?php 
session_start();
include('dbconn.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function sendemail_verify($name, $email, $verify_token)
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

    $mail->setFrom("crispark30@gmail.com",$name);
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = "Email Verification from Ninja Cris";

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

 if(isset($_POST["register_btn"])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $verify_token = md5(rand());

    $check_email_query = "SELECT email FROM users WHERE email='$email' LIMIT 1";
    $check_email_query_run = mysqli_query($conn, $check_email_query);

    if(mysqli_num_rows($check_email_query_run) > 0)
    {
        $_SESSION['status'] = "Email Id already Exist";
        header("Location: register.php");
    }
    else
    {
        //Insert user or rigester users
        $query = "INSERT INTO users (name, phone, email, password, verify_token) VALUES ('$name', '$phone', '$email', '$password', '$verify_token')";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            sendemail_verify("$name", "$email", "$verify_token");
            $_SESSION['status'] = "Registration Successfully! Pleae verify your email address.";
            header("Location: register.php");
        }
        else
        {
            $_SESSION['status'] = "Registration Failed";
            header("Location: register.php");
        }
    }
 }

?>