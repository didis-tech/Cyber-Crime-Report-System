<?php
session_start();
if (!isset($_SESSION['user_login']) || $_SESSION['user_login'] !== true) {
  header("location: ./login.php");
}
require '../resources/db_connect.php';
require '../resources/fetch.php';
$reports=$conn->query("SELECT * FROM `report` WHERE user_id='$id'");
$countReports=$reports->num_rows;
$page='report';
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
    $('document').ready(function(){
        
        $("#2nd-form").show();
        $('.statistic-block button').addClass('btn btn-dark');
        $('textarea').addClass('form-control');
        $('.statistic-block ul').addClass('list-group');
        $('.statistic-block ul li').addClass('list-group-item');
    })
</script>
  </head>
  <body >
    <?php require 'header.php'; ?>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <?php require 'navigation.php'; ?>
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Dashboard</h2>
          </div>
        </div>
        <section class="no-padding-top no-padding-bottom">
          <div class="container-fluid">
            <div class="row">
              
              <div class="col-md-12 col-sm-12">
                <div class="statistic-block block">
                  <form action="" method="post">
                  <div class="form-group">
    <label for="exampleInputEmail1">Report-Type</label>
    <select name="report-type" class="form-control" required>
    <small id="emailHelp" class="form-text text-muted">Choose type of report.</small>
  </div>
                     
                      <?php require "../forms/report-type.php";?>
                      </select>
                      <?php require "../forms/secondForm.php";?>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>

      </div>
    </div>
    <!-- JavaScript files-->
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="js/front.js"></script>
  </body>
</html>
