<?php
header('Content-Type: application/json');
include "../resources/calc_time.php";
$conn = mysqli_connect("localhost","root","","cyber_security");
$user_id=isset($_GET['user_id']) ? $_GET['user_id'] :'';

$sqlQuery = "SELECT * FROM `users`";

$result = mysqli_query($conn,$sqlQuery);
$newCount=$result->num_rows;
$data = array();
foreach ($result as $row) {
    $row+=['countUsers' => $newCount ];
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>