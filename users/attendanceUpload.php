<?php 
include("../dbconn.php");

if(isset($_FILES["webcam"]["tmp_name"])){ // Corrected array key
    $tmpName = $_FILES["webcam"]["tmp_name"]; // Corrected array key
    $imageName = date("m.d.Y") . " - " . date("h.i.sa") . '.jpeg'; // Removed space before '.jpeg'
    move_uploaded_file($tmpName, '../users/attendanceImages/' . $imageName);

    $date = date("m/d/Y");
    $time = date("h:i:sa");
    $query = "INSERT INTO attendance (date, time, name, employee_id, image) VALUES ('$date', '$time', 'name', 'employeeID', '$imageName')";
    mysqli_query($conn, $query);
}
?>