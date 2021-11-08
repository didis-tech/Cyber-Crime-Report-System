<?php
session_start();
if (!isset($_SESSION['user_login']) || $_SESSION['user_login'] !== true) {
  header("location: ./login.php");
}
require '../resources/db_connect.php';
require '../resources/fetch.php';
$page='profile';
if (isset($_POST['new_password'])) {
  $old_password=$_POST['old_password'];
  $new_password=$_POST['new_password'];
  $hash_password=password_hash($new_password, PASSWORD_BCRYPT);
  if (password_verify($old_password,$stored_password)) {
    $conn->query("UPDATE users set user_password='$hash_password' where user_id='$id'");
    echo "<script>window.location='./profile.php'</script>";
      }else{
        echo "<script>alert('Sorry! - Invalid old password. '); window.location='./profile.php'</script>";
      }
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cyber security - User </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="css/font.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/chatbox.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <style media="screen">
    @import url(../web-fonts-with-css/css/all.css);
    @import url(../web-fonts-with-css/css/brands.css);
    @import url(../web-fonts-with-css/css/fontawesome.css);
    @import url(../web-fonts-with-css/css/svg-with-js.css);
    @import url(../web-fonts-with-css/css/regular.css);
    @import url(../web-fonts-with-css/css/solid.css);
    @import url(../web-fonts-with-css/css/v4-shims.css);
    </style>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script>
      function verifyPassword(){
          console.log('typing...');
        if ($("#new_password").val().length < 8) {
          $("#sub_pw").prop('disabled',true);
          $("#msg").html("Password must be 8 or more characters.");
        } else {
          $("#sub_pw").prop('disabled',false);
          $("#msg").html("");
        }
      }
      function verifyPassword1(){
        
          var pass =$("#new_password").val();
          var con =$("#c_password").val();
          
          console.log(pass);
          console.log(con);
          if (pass !== con) {
          $("#sub_pw").prop('disabled',true);
          $("#msg").html("Password not matching");
        } else {
          $("#sub_pw").prop('disabled',false);
          $("#msg").html("");
        }
      }
    </script>
  </head>
  <body>
    
  <?php require 'header.php'; ?>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <?php require 'navigation.php'; ?>
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <!-- Page Header-->
        <div class="page-header no-margin-bottom">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Profile</h2>
          </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Profile           </li>
          </ul>
        </div>
        <section class="no-padding-top">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-4">                           
                <div class="block">
                  <div class="title"><strong>Avatar</strong></div>
                  <div class="block-body">
                    <center>
                      <img src="img/user.jpg" alt="user" class="img-thumbnail">
                    </center>
                  </div>
                </div>
              </div>
              <!-- Modal Form-->
              <div class="col-lg-8">
                <div class="block">
                  <div class="title"><strong>Change Password</strong></div>
                  <div class="block-body text-center">
                    <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Change Password </button>
                    <!-- Modal-->
                    <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                      <div role="document" class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header"><strong id="exampleModalLabel" class="modal-title">Change Password</strong>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                          </div>
                          <div class="modal-body">
                            
                            <form action="./profile.php" method="post">
                              <div class="form-group">
                                <label>Old password:</label>
                                <input type="password" placeholder="Old password" class="form-control" name="old_password" id="old_password" required>
                              </div>
                              <div class="form-group">       
                                <label>New Password</label>
                                <input type="password" placeholder="New Password" class="form-control" onkeypress="verifyPassword()" name="new_password" id="new_password" required>
                              </div>
                              
                              <div class="form-group">       
                                <label>Confirm Password</label>
                                <input type="password" placeholder="New Password" onkeypress="verifyPassword1()" class="form-control" name="c_password" id="c_password" required>
                              </div>
                              <div class="form-group">       
                                <input type="submit" value="changePassword" class="btn btn-primary" id="sub_pw">
                              </div>
                              <div id="msg"  class="text-danger"></div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Form Elements -->
              <div class="col-lg-12">
                <div class="block">
                  <div class="title"><strong>Profile</strong></div>
                  <div class="block-body">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Firstname</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" value="<?=$firstname?>" readonly>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Lastname</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control"  value="<?=$lastname?>" readonly>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Email</label>
                        <div class="col-sm-9">
                          <input type="text" name="password" class="form-control"  value="<?=$email?>" readonly>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Gender</label>
                        <div class="col-sm-9">
                          <input type="text" placeholder="" class="form-control"  value="<?=$gender?>" readonly>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Occupation</label>
                        <div class="col-sm-9">
                          <input type="text" value="<?=$occupation?>" readonly placeholder="" class="form-control">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="js/front.js"></script>
  </body>
</html>