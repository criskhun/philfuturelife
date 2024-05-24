<?php 

$conn = mysqli_connect("localhost", "root", "", "philfuturelife_db");
$connection_status = mysqli_connect_errno() ? 'red' : 'green';
?>
<i class="fa-solid fa-circle-dot" style="color: <?php echo $connection_status; ?>"></i>