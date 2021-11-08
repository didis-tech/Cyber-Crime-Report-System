<?php
session_start();
if (!isset($_SESSION['admin_login']) || $_SESSION['admin_login'] !== true) {
  header("location: ./login.php");
}
require '../resources/db_connect.php';
require '../resources/admin-fetch.php';
$myreports=$conn->query("SELECT * FROM `report`");
$countReports=$myreports->num_rows;
$page='reports';
$count=0;
if (isset($_GET['approve_id'])) {
  $r_id=$_GET['approve_id'];
  $conn->query("UPDATE report SET report_status='approved' WHERE report_id=$r_id");
  echo "<script>window.location='./reports.php'</script>";
}
if (isset($_GET['delete_id'])) {
  $r_id=$_GET['delete_id'];
  $conn->query("UPDATE report SET report_status='cancelled' WHERE report_id=$r_id");
  echo "<script>window.location='./reports.php'</script>";
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
  // $('document').ready(function(){
  //   $('#view-report').on('show.bs.modal', function (event) {
  //     var button = $(event.relatedTarget) // Button that triggered the modal
  //     var recipient = button.data('whatever') // Extract info from data-* attributes
  //     // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  //     // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  //     var modal = $(this)
  //     modal.find('.modal-title').text(recipient)
  //     modal.find('.modal-body').html(recipient)
  //   })
  // })
  function view(params) {
    const report_id=params;
    $.ajax({
      url: 'getReport.php',
      data: {report_id:report_id},
      type: "POST",
      dataType: "json",
      success: function (data) {
        var content='<ul class="list-group">';
        $('#view-report .modal-title').html(`Report from ${data[0].user_firstname} ${data[0].user_lastname}`);
        for (let index = 0; index < data.length; index++) {
          const element = data[index];
          const {report_ques, report_ans} = element;
          content +=`
          <li class="list-group-item">
          ${report_ques}<br/>Ans : ${report_ans}
          </li>`;
          
        }
        content +=`</ul>`;
        $('#view-report .modal-body').html(content);
        $('#view-report').modal('show');
      }
    });
  }
</script>
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
                  <div class="table-responsive"> 
                    <table class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Report Type</th>
                          <th>Report Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($myreports as $key => $val): ?>
                      <?php if ($val['report_status'] =='pending') {
                        $stat='secondary';
                      }elseif ($val['report_status'] =='approved') {
                        $stat='success';
                      } else {
                        $stat='danger';
                      }
                      $count =$count+1;
                       ?>
                        <tr>
                          <th scope="row"><?php echo $count;?></th>
                          <td><?php echo $val['report_type'];?></td>
                          <td><span class="badge badge-<?php echo $stat;?>"><?php echo $val['report_status'];?></span></td>
                          <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                              <button class="btn btn-light" onClick="view(<?php echo $val['report_id'];?>)"><i class="fa fa-eye"></i> </button>
                              <a class="btn btn-danger" href="?delete_id=<?php echo $val['report_id'];?>"><i class="fa fa-trash-o"></i></a>
                              <a class="btn btn-info" href="?approve_id=<?php echo $val['report_id'];?>"><i class="fa fa-check"></i></a>
                            </div>
                          </td>
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