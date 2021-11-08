<?php
header('Content-Type: application/json');
include "../resources/calc_time.php";
$conn = mysqli_connect("localhost","root","","cyber_security");
$sqlQuery = "SELECT * FROM `users`";
$result = mysqli_query($conn,$sqlQuery);
$newCount=(int)($result->num_rows);

echo json_encode($newCount);
?>