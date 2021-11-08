<?php
header('Content-Type: application/json');
include "../resources/calc_time.php";
$conn = mysqli_connect("localhost","root","","cyber_security");
$user_id=isset($_GET['user_id']) ? $_GET['user_id'] :'';

$sqlQuery = "UPDATE `messages` SET user_seen='seen' WHERE sender_id ='".$user_id."' or receiver_id ='".$user_id."'";

$result=mysqli_query($conn,$sqlQuery);
if ($result) {
    $data='done';
} else {
    $data='error';
}

mysqli_close($conn);

echo json_encode($data);
?>