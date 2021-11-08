<?php
session_start();
if (!isset($_SESSION['user_login']) || $_SESSION['user_login'] !== true) {
  header("location: ./login.php");
}
require '../resources/db_connect.php';
require '../resources/fetch.php';
$reports=$conn->query("SELECT * FROM `report` WHERE user_id='$id'");
$countReports=$reports->num_rows;
$page='home';
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
    <script type="text/javascript">
    function updateScroll(){
      var element = document.getElementById("messages");
      element.scrollTop = element.scrollHeight;
    }
    function checkForNewMsgs() {
      
      var msgCount=document.getElementById("countMsgs").value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              response=JSON.parse(this.response);
              console.log(response.count);
              document.getElementById("countMsgs").value=response.count;
                console.log(response);
                if (response.refresh==='true') {
                  loadDoc();
                }
                markmessages();
           }
        };
        xhttp.open("GET", `countMsgs.php?msgCount=${msgCount}&&user_id=<?php echo $id ?>`, true);
        xhttp.send();
    }
    function loadDoc() {
      var xmlhttp = new XMLHttpRequest();

      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data=JSON.parse(this.response);
            console.log(data);
            document.getElementById("countMsgs").value=data[0].countMsgs;

            var content = '';
            if (data.length===0) {
              content += " ";
            } else {
              for (var i = 0; i < data.length; i++) {

              if (data[i].sender_type==='admin') {
                content += `<div class="d-flex justify-content-start mb-4">
                  <div class="img_cont_msg">
                    <img src="/cyber_security/images/Admin.svg" style="background:#fff" class="rounded-circle user_img_msg">
                  </div>
                  <div class="msg_cotainer">
                    ${data[i].msg}
                    <span class="msg_time">${data[i].time}</span>
                  </div>
                </div>`;
              } else {
                content += `<div class="d-flex justify-content-end mb-4">
                  <div class="msg_cotainer_send">
                    ${data[i].msg}
                    <span class="msg_time_send">${data[i].time}</span>
                  </div>
                  <div class="img_cont_msg">
                <img src="img/user.jpg" class="rounded-circle user_img_msg">
                  </div>
                </div>`;
              }
            }
            }
            document.getElementById("messages").innerHTML = content;
            updateScroll()
       }
      }

      xmlhttp.open("get","getMsgs.php?user_id=<?php echo $id ?>",true);
      xmlhttp.setRequestHeader("Content-type", "application/json");
      xmlhttp.send();
    }
    function sendMessage(event) {
      event.preventDefault();
    var message = document.getElementById("message").value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("message").value='';
            loadDoc();
       }
    };
    xhttp.open("GET", `sendMessage.php?message=${message}&&user_id=<?php echo $id ?>`, true);
    xhttp.send();

}
function markmessages() {
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "seenMsgs.php?user_id=<?php echo $id ?>", true);
  xhttp.send();
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
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Dashboard</h2>
          </div>
        </div>
        <section class="no-padding-top no-padding-bottom">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 col-sm-6">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-user-1"></i></div><strong>Status</strong>
                    </div>
                    <div class="number dashtext-1">Active</div>
                  </div>
                  <div class="progress progress-template">
                    <div role="progressbar" style="width: 100%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-1"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-contract"></i></div><strong>Reports</strong>
                    </div>
                    <div class="number dashtext-2"><?php echo $countReports ?></div>
                  </div>
                  <div class="progress progress-template">
                    <div role="progressbar" style="width: 0%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section class="no-padding-bottom">
          <div class="container-fluid">
            <div class="row">

              <div class="col-lg-12">
                <div class="container-fluid h-100">
      <div class="row justify-content-center h-100">


        <div class="col-md-12 col-xl-12 chat">
          <div class="card">
            <div class="card-header msg_head">
              <div class="d-flex bd-highlight">
                <div class="img_cont">
                  <img src="/cyber_security/images/Admin.svg" style="background:#fff" class="rounded-circle user_img">
                  <span class="online_icon"></span>
                </div>
                <div class="user_info">
                  <span>Chat with Admin</span>
                  <p>...</p>
                </div>
                <div class="video_cam">
                  <span><i class="fas fa-video"></i></span>
                  <span><i class="fas fa-phone"></i></span>
                </div>
              </div>
              <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
              <div class="action_menu">
                <ul>
                  <li><i class="fas fa-user-circle"></i> View profile</li>
                  <li><i class="fas fa-users"></i> Add to close friends</li>
                  <li><i class="fas fa-plus"></i> Add to group</li>
                  <li><i class="fas fa-ban"></i> Block</li>
                </ul>
              </div>
            </div>
            <div class="card-body msg_card_body" id="messages">

            </div>
            <div class="card-footer">
              <form onsubmit="sendMessage(event)">
                <div class="input-group">
                  <div class="input-group-append">
                    <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                  </div>
                  <textarea id="message" class="form-control type_msg" placeholder="Type your message..." required></textarea>
                  <div class="input-group-append">
                    <button class="input-group-text send_btn" type="submit"><i class="fas fa-location-arrow"></i></button>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
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
    <script type="text/javascript">
      loadDoc();
      setInterval(checkForNewMsgs, 3000);
    </script>
  </body>
</html>
