<?php
session_start();
if (!isset($_SESSION['admin_login']) || $_SESSION['admin_login'] !== true) {
  header("location: ./login.php");
}
require '../resources/db_connect.php';
require '../resources/admin-fetch.php';
$reports = $conn->query("SELECT * FROM `report`");
$countReports = $reports->num_rows;
$page = 'home';
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
    function updateScroll(id) {
      var element = document.getElementById(id);
      element.scrollTop = element.scrollHeight;
    }

    function checkForNewMsgs(user_id, name) {
      var msgCount = document.getElementById("countMsgs").value;
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          response = JSON.parse(this.response);
          document.getElementById("countMsgs").value = response.count;
          // console.log(response);
          if (response.refresh === 'true') {
            loadUserMsgs(user_id, name);
          }
          markmessages(user_id);
          setInterval(checkForNewMsgs(user_id, name), 3000);
        }
      };
      xhttp.open("GET", `countMsgs.php?msgCount=${msgCount}&&user_id=${user_id}`, true);
      xhttp.send();
    }

    function checkForNewUser() {
      var countUsers = document.getElementById("countUsers").value;
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          response = this.response;
          // console.log(response);
          if (response !== countUsers) {
            loadDoc();
            document.getElementById("countUsers").value = response;
          }
        }
      };
      xhttp.open("GET", `countUsers.php`, true);
      xhttp.send();
    }

    function loadDoc() {
      var xmlhttp = new XMLHttpRequest();

      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.response);
          // console.log(data);
          updateScroll('contacts')
          var content='';
          for (let index = 0; index < data.length; index++) {
            const {
              user_firstname,
              user_lastname,
              user_email,
              user_id,
              msgNoti
            } = data[index];
            const name = `${user_firstname} ${user_lastname}`;
            content+= `<li id="user_${user_id}" onclick="loadUserMsgs('${user_id}','${name}')" style="cursor: pointer;">
                  <div class="d-flex bd-highlight">
                    <div class="img_cont">
                      <img src="img/user.jpg" class="rounded-circle user_img">
                      <span class="online_icon"></span>
                    </div>
                    <div class="user_info">
                      <span>${user_firstname} ${user_lastname}</span>
                      <p>${user_email} <i id='noti_${user_id}'></i></p>
                    </div>
                  </div>
                </li>`;
          
          }
          document.getElementById("contacts").innerHTML = content;
          
        }
      }

      xmlhttp.open("get", "getUsers.php", true);
      xmlhttp.setRequestHeader("Content-type", "application/json");
      xmlhttp.send();
    }

    function loadUserMsgs(user, name) {

      checkForNewMsgs(user, name);
      $(`#contacts li`).removeClass("active");
      $(`#user_${user}`).addClass("active");
      $("#msg-footer").html(`<form onsubmit="sendMessage(event,'${user}','${name}')">
        <div class="input-group">
          <div class="input-group-append">
            <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
          </div>
          <textarea id="message" class="form-control type_msg" placeholder="Type your message..." required></textarea>
          <div class="input-group-append">
            <button class="input-group-text send_btn" type="submit"><i class="fas fa-location-arrow"></i></button>
          </div>
        </div>
      </form>`);
      $("#msg-header").html(`<div class="img_cont">
        <img src="img/user.jpg" style="background:#fff" class="rounded-circle user_img">
        <span class="online_icon"></span>
      </div>
      <div class="user_info">
        <span id="username">${name}</span>
      </div>`);
      var xmlhttp = new XMLHttpRequest();

      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.response);
          // console.log(data);
          document.getElementById("countMsgs").value = data.length === 0 ? 0 : data[0].countMsgs;
          var content = '';
          updateScroll('messages')
          if (data.length === 0) {
            content += " ";
          } else {
            for (var i = 0; i < data.length; i++) {

              if (data[i].sender_type === 'user') {
                content += `<div class="d-flex justify-content-start mb-4">
                    <div class="img_cont_msg">
                      <img src="img/user.jpg"  class="rounded-circle user_img_msg">
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
                  <img src="/cyber_security/images/Admin.svg" style="background:#fff" class="rounded-circle user_img_msg">
                    </div>
                  </div>`;
              }
            }

          }

          document.getElementById("messages").innerHTML = content;
          updateScroll("messages")
        }
      }

      xmlhttp.open("get", `getMsgs.php?user_id=${user}`, true);
      xmlhttp.setRequestHeader("Content-type", "application/json");
      xmlhttp.send();
    }

    function sendMessage(event, user_id, name) {
      event.preventDefault();
      var message = document.getElementById("message").value;
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("message").value = '';
          loadUserMsgs(user_id, name);
        }
      };
      xhttp.open("GET", `sendMessage.php?message=${message}&&user_id=${user_id}`, true);
      xhttp.send();

    }

    function markmessages(user_id) {
      var xhttp = new XMLHttpRequest();
      xhttp.open("GET", `seenMsgs.php?user_id=${user_id}`, true);
      xhttp.send();
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
                  <div class="col-md-4 col-xl-3 chat">
                    <div class="card mb-sm-3 mb-md-0 contacts_card">
                      <div class="card-header">
                        <div class="input-group">
                          <input type="text" placeholder="Search..." name="" class="form-control search">
                          <div class="input-group-prepend">
                            <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                          </div>
                        </div>
                      </div>
                      <div class="card-body contacts_body">
                        <ui class="contacts" id="contacts">

                        </ui>
                      </div>
                      <div class="card-footer"></div>
                    </div>
                  </div>
                  <div class="col-md-8 col-xl-6 chat">
                    <div class="card">
                      <div class="card-header msg_head">
                        <div class="d-flex bd-highlight" id="msg-header">

                        </div>
                        <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
                        <div class="action_menu">
                          <ul>
                            <li><i class="fas fa-user-circle"></i> View profile</li>
                          </ul>
                        </div>
                      </div>
                      <div class="card-body msg_card_body" id="messages">

                      </div>
                      <div class="card-footer" id="msg-footer">

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
    setInterval(checkForNewUser, 1000);
  </script>
</body>

</html>
