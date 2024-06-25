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
    try {
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
    $mail->Subject = "Account Created from Ninja Cris";

    $email_template = "
    <h2>You have Registered with NinjaCris</h2>
    <h5>You are now an account holder of the NinjaCris System</h5>
    <br/><br/>
    <a href='http://localhost/philfuturelife/admin_panel.php'> Click Me </a>
    ";

    $mail->Body = $email_template;
    $mail->send();
    return true;
    } catch (Exception $e) {
        error_log('Mailer Error: ' . $mail->ErrorInfo);
        return false;
    }
    echo 'Message has been sent';
}



if(isset($_POST["registerGoogle"])){
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $verify_status = "1";

    if(empty($name) || empty($phone) || empty($email) || empty($password)) {
        $_SESSION['status2'] = "All fields are required!";
        header("Location: create-password.php");
        exit(0);
    } else if($password != $confirm_password) {
        $_SESSION['status2'] = "Passwords do not match!";
        header("Location: create-password.php");
        exit(0);
    } else {
        $check_email_query = "SELECT email FROM users WHERE email=? LIMIT 1";
        $stmt = $conn->prepare($check_email_query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            $_SESSION['status3'] = "Email already exists!";
            header("Location: create-password.php");
            exit(0);
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_query = "INSERT INTO users (name, phone, email, password, verify_status) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param("sssss", $name, $phone, $email, $hashed_password, $verify_status);

            if($stmt->execute()) {
                if(sendemail_verify($name, $email, $verify_status)) {
                    $_SESSION['status'] = "Login successfully via Google account.";
                    $_SESSION['email'] = $email;
                    header("Location: apps/admin_panel.php");
                    exit(0);
                } else {
                    $_SESSION['status3'] = "Registration successful but email sending failed.";
                    $_SESSION['email'] = $email;
                }
                header("Location: apps/admin_panel.php");
                exit(0);
            } else {
                $_SESSION['status2'] = "Registration failed";
                header("Location: create-password.php");
                exit(0);
            }
        }
    }
}

?>