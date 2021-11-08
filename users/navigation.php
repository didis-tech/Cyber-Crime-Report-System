<?php 
$home=$page==='home' ? 'active' : '';
$profile=$page==='profile' ? 'active' : '';
$reports=$page==='reports' ? 'active' : '';
$report=$page==='report' ? 'active' : '';
?>
<!-- Sidebar Navigation-->
<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
      <div class="avatar"><img src="img/user.jpg" alt="..." class="img-fluid rounded-circle"></div>
      <div class="title">
        <h1 class="h5"> <?php echo $firstname." ".$lastname; ?> </h1>
        <p>Reporter</p>
      </div>
    </div>
    <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">
            <li class="<?php echo $home;?>"><a href="index.php"> <i class="icon-home"></i>Home </a></li>
            <li class="<?php echo $profile;?>"><a href="profile.php"> <i class="icon-user"></i>Profile </a></li>
            <li class="<?php echo $reports;?>"><a href="reports.php"> <i class="icon-list"></i>Reports </a></li>
            <li class="<?php echo $report;?>"><a href="report.php"> <i class="icon-padnote"></i>Report </a></li>
    </ul>
  </nav>
  <!-- Sidebar Navigation end-->