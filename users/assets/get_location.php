<?php
include '../../dbconn.php'; // Make sure to include your database connection




$markers = [];
$select = mysqli_query($conn, "SELECT DISTINCT id, name, lat, lng FROM branch_location");
while($row = mysqli_fetch_assoc($select)) {
    $eachCord = array(
        "id" => $row['id'],
        "name" => $row['name'],
        "lat" => $row['lat'],
        "lng" => $row['lng'],
    );

    array_push($markers, $eachCord);
}

echo json_encode($markers);
?>
