<?php
header('Content-Type: application/json');
include "../resources/calc_time.php";
$conn = mysqli_connect("localhost","root","","cyber_security");
$user_id=isset($_GET['user_id']) ? $_GET['user_id'] :'';

$sqlQuery = "SELECT * FROM `messages` WHERE sender_id ='".$user_id."' or receiver_id ='".$user_id."'";

$result = mysqli_query($conn,$sqlQuery);
$newCount=$result->num_rows;
$data = array();
foreach ($result as $row) {
    $row+=['countMsgs' => $newCount , 'time' => get_time_ago(strtotime($row['msg_time']))];
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>