<?php
if (isset($_GET['admin_id'])) {
	$id = $_GET['admin_id'];
}else {
	$id = $_SESSION['admin_id'];
}
$sql = "SELECT * FROM `admins` where adm_id = '$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
  while($row = $result->fetch_assoc()) {
    $adm_username = $row['adm_username'];
    //   $phone = $row['user_tel'];
    $stored_password=$row['adm_password'];
  }
}
 ?>
