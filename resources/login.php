<?php
session_start();
require "db_connect.php";
$email = isset($_POST['loginUsername']) ? $_POST['loginUsername'] : "";
$password = isset($_POST['loginPassword']) ? $_POST['loginPassword'] : "";

 if(!isset($message)) {
	$query = "SELECT * FROM `users` where user_email  = '$email'";
  $resultLogin = mysqli_query($conn, $query);

  if ($resultLogin->num_rows === 0) {
    
      echo "<script>alert('Email is invalid please check your credentials.'); window.location='../users/'</script>";
  }else {
    $value = $resultLogin->fetch_assoc();
    $stored_password = $value['user_password'];
			if (password_verify($password,$stored_password)) {
					 $_SESSION['user_login'] = true;
					 $_SESSION['user_id'] = $value['user_id'];
           echo "<script>window.location='../users/'</script>";
  				   }else{
               echo "<script>alert('Sorry! - Invalid password. '); window.location='../users/'</script>";
  				   }
    }


  }


?>
