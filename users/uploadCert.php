<?php

use Google\Service\CloudDeploy\Target;

include_once("../dbconn.php");

if (isset($_POST["submitCert"])) {
    $CertTitle = $_POST["CertTitle"];
    $CertDesc = $_POST["CertDesc"];
    $CertIssued = $_POST["CertIssued"];
    $CertExpire = $_POST["CertExpire"];
    $CertImage = $_FILES["CertImage"]["name"];

    $ext = pathinfo($CertImage, PATHINFO_EXTENSION);
    $allowedTypes = array("jpg", "png", "jpeg", "gif", "pdf");
    $tempName = $_FILES["CertImage"]["tmp_name"];
    $targetPath = "../users/certificatesImages/".$CertImage;

    if(in_array($ext, $allowedTypes)){
        if(move_uploaded_file($tempName, $targetPath)){
            $query = "INSERT INTO certificate (cert_title, cert_desc, issued, expire, file_name, Owner) VALUES ('$CertTitle', '$CertDesc', '$CertIssued', '$CertExpire', '$CertImage', 'Owner')";
            if(mysqli_query($conn, $query)){
                echo "Your image is inserted";
                header("Location: ../users/employee/profile.php?activeTab=cande");
                exit();
            } else {
                echo "Error: ".mysqli_error($conn);
            }
        } else {
            echo "File not uploaded";
        }
    } else {
        echo "File type not allowed";
    }
}

if(isset($_POST['updateCert'])) {
    $CertID = $_POST['CertID'];
    $CertTitle = $_POST['CertTitle'];
    $CertDesc = $_POST['CertDesc'];
    $CertIssued = $_POST['CertIssued'];
    $CertExpire = $_POST['CertExpire'];

    // File upload handling
    $targetDir = "../users/certificatesImages/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    if(!empty($fileName)) {
        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','gif','pdf');
        if(in_array($fileType, $allowTypes)){
            // Upload file to server
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                // Update certificate with image
                $query = "UPDATE certificate SET cert_title='$CertTitle', cert_desc='$CertDesc', issued='$CertIssued', expire='$CertExpire', file_name='$fileName' WHERE id='$CertID'";
                if(mysqli_query($conn, $query)){
                    echo "Certificate updated successfully.";
                    header("Location: ../users/employee/profile.php?activeTab=cande");
                exit();
                } else{
                    echo "Error updating certificate.";
                }
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo 'Only JPG, JPEG, PNG, GIF, and PDF files are allowed.';
        }
    } else {
        // Update certificate without changing the image
        $query = "UPDATE certificate SET cert_title='$CertTitle', cert_desc='$CertDesc', issued='$CertIssued', expire='$CertExpire' WHERE id='$CertID'";
        if(mysqli_query($conn, $query)){
            echo "Certificate updated successfully.";
            header("Location: ../users/employee/profile.php?activeTab=cande");
            exit();
        } else{
            echo "Error updating certificate.";
        }
    }
}

if(isset($_POST['deleteCert'])) {
    $CertID = $_POST['CertID'];

    // Delete certificate
    $query = "DELETE FROM certificate WHERE id='$CertID'";
    if(mysqli_query($conn, $query)){
        echo "Certificate deleted successfully.";
        header("Location: ../users/employee/profile.php?activeTab=cande");
        exit();
    } else{
        echo "Error deleting certificate.";
    }
}
?>

<a href="../users/employee/profile.php">redirection</a>