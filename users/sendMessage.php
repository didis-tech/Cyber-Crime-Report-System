<?php
header('Content-Type: application/json');
include "../resources/calc_time.php";
$user_id=isset($_GET['user_id']) ? $_GET['user_id'] :'';
$message=isset($_GET['message']) ? $_GET['message'] :'';

$conn = mysqli_connect("localhost","root","","cyber_security");
$sqlQuery = "INSERT INTO `messages`(`sender_type`, `sender_id`, `msg`, `user_seen`) VALUES ('user','$user_id','$message','seen')";
mysqli_query($conn,$sqlQuery);

?>