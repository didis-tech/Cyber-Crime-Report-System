<?php
header('Content-Type: application/json');
include "../resources/calc_time.php";
$conn = mysqli_connect("localhost","root","","cyber_security");

$sqlQuery = "SELECT * FROM `messages` where admin_seen='not seen'";

$result = mysqli_query($conn,$sqlQuery);
$newCount=$result->num_rows;


mysqli_close($conn);

echo json_encode($newCount);
?>