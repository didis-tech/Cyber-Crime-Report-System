<?php
header('Content-Type: application/json');

$conn = mysqli_connect("localhost","root","","cyber_security");
$user_id=isset($_GET['user_id']) ? $_GET['user_id'] :'';
$msgCount=isset($_GET['msgCount']) ? $_GET['msgCount'] :'';

$sqlQuery = "SELECT * FROM `messages` WHERE sender_id ='".$user_id."' or receiver_id ='".$user_id."'";

$result = mysqli_query($conn,$sqlQuery);
$newCount=(int)($result->num_rows);
$preCount=(int)($msgCount);
if ($preCount == $newCount) {
    $responses = array(
        'preCount' => $preCount,
        'refresh' => 'false',
        'count' => $newCount
      );
  }else {
    $responses = array(
        'preCount' => $preCount,
        'refresh' => 'true',
        'count' => $newCount
    );
  }

mysqli_close($conn);

echo json_encode($responses);
?>