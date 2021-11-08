<?php
header('Content-Type: application/json');
include "../resources/calc_time.php";
$conn = mysqli_connect("localhost", "root", "", "cyber_security");
$report_id = isset($_POST['report_id']) ? $_POST['report_id'] : '';

$sqlQuery = "SELECT * FROM `reportdetails`,`report`,`users` where reportdetails.report_id=report.report_id AND report.user_id=users.user_id AND reportdetails.report_id='$report_id'";
$data = array();
$result = mysqli_query($conn, $sqlQuery);
foreach ($result as $row) {

    $data[] = $row;
}
mysqli_close($conn);

echo json_encode($data);
