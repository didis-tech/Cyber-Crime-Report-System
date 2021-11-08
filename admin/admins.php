<?php
session_start();
if (!isset($_SESSION['admin_login']) || $_SESSION['admin_login'] !== true) {
  header("location: ./login.php");
}
require '../resources/db_connect.php';
require '../resources/admin-fetch.php';
$system_admins=$conn->query("SELECT * FROM `admins`");
$countAdmins=$system_admins->num_rows;
$page='admins';
$count=0;
if (isset($_POST['email'])) {
    $new_email=$_POST['email'];
    
  $hash_password=password_hash(12345678, PASSWORD_BCRYPT);
    $conn->query("INSERT INTO admins(adm_username, adm_password) VALUE('$new_email','$hash_password')");
    echo "<script>window.location='./admins.php'</script>";
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cyber security - Admin </title>
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

  </head>
  <body >
    <?php require 'header.php'; ?>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <?php require 'navigation.php'; ?>
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <!-- Page Header-->
        <div class="page-header no-margin-bottom">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Reports</h2>
          </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">My reports            </li>
          </ul>
        </div>
        <section class="no-padding-top">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                <div class="block">
                  <div class="title"><strong>My reports</strong></div>
                  <div class="float-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                        Add Admin
                    </button>
                  </div>
                  <!-- Modal -->
                  <div class="modal fade" id="add" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add Admin</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <form method="post">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--model-->
                  <div class="table-responsive"> 
                    <table class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Admins</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($system_admins as $key => $val): ?>
                      <?php 
                      $count =$count+1;
                       ?>
                        <tr>
                          <th scope="row"><?php echo $count;?></th>
                          <td><?php echo $val['adm_username'];?></td>
                          
                        </tr>
                      <?php endforeach; ?>
                      </tbody>
                    </table>
                    <!-- Modal -->
                    <div class="modal fade" id="view-report" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            ...
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--model-->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        </footer>
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