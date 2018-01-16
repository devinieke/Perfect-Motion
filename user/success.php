<?php
ob_start();
session_start();
?>
<?php require_once '../includes/dbconnect.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<?php require_once '../includes/profileUpdate.php'; ?>
<?php require_once '../includes/PMlogic.php'; ?>
<?php require_once '../includes/evidence.php'; ?>

<?php
  error_reporting(0);

  if(!isset($_SESSION['username']))
  {
    redirect_to("../login.php");
  }
  else
  {
    $profile = $_SESSION['username'];
    $confirm = "SELECT * FROM user WHERE UserName='$profile'";
    $confirmResult = mysqli_query($connection, $confirm) or die(mysqli_error($connection));

    while($confirmRow = mysqli_fetch_array($confirmResult))
    {
      $profile_ID = $confirmRow['User_ID'];
    }
 ?>
<!DOCTYPE html>
<!--

-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->

<?php
  $dashQuery = "SELECT * FROM user WHERE UserName='$profile'";
  $dashResult = mysqli_query($connection, $dashQuery);

  while($dashRow = mysqli_fetch_array($dashResult))
  {
    $fname = $dashRow['First_Name'];
    $lname = $dashRow['Last_Name'];
    $userName = $dashRow['UserName'];
    $email = $dashRow['Email'];
    $gen = $dashRow['Gender'];
    $tel = $dashRow['Phone_1'];
    $img = $dashRow['Image'];
    $add = $dashRow['Address'];
    $city = $dashRow['City'];
    $bankName = $dashRow['Bank_Name'];
    $acc_Name = $dashRow['Account_Name'];
    $acc_Num = $dashRow['Acc_No'];
    $twitter = $dashRow['Twitter_Url'];
    $fbook = $dashRow['Facebook_Url'];
    $level = $dashRow['Level'];
    $stars = $dashRow['Stars'];
  }

  if($level)
 ?>

 <?php

    $levelChk = "SELECT * FROM merge as m INNER JOIN user as u ON m.Spons_ID=u.User_ID WHERE m.Ben_ID = '$profile_ID' and u.Level=2";
    $levelChkResult = mysqli_query($connection, $levelChk) or die(mysqli_error($connection));

    while($levelChkRow = mysqli_fetch_array($levelChkResult))
    {
        $lvl_id  = $levelChkRow['id'];
      $lvl_chk = $levelChkRow['Spons_ID'];
      $lvl_con = $levelChkRow['Spons_Con'];

      //if($lvl_con == 0)
      //{
            $match = "SELECT * FROM user WHERE User_ID='$lvl_chk'";
            $matchResult = mysqli_query($connection, $match) or die(mysqli_error($connection));

            while($matchRow = mysqli_fetch_array($matchResult))
            {
                $M_ID = $matchRow['User_ID'];
                $Mfirstname = $matchRow['First_Name'];
                $Mlastname = $matchRow['Last_Name'];
                $MbankName = $matchRow['Bank_Name'];
                $Macc_Name = $matchRow['Account_Name'];
                $M_gen = $matchRow['Gender'];
                $M_img = $matchRow['Image'];
                $Macc_Num = $matchRow['Acc_No'];
                $M_phone = $matchRow['Phone_1'];
                $Mtwitter = $matchRow['Twitter_Url'];
                $Mfbook = $matchRow['Facebook_Url'];
                $Mlevel = $matchRow['Level'];
            }
      //}

    }

  ?>

  <?php
                                $show="SELECT * FROM merge WHERE id='$lvl_id'";
                                $result = mysqli_query($connection, $show) or die(mysqli_error($connection));
                                while ($array = mysqli_fetch_array($result))
                                {
                                  $timeStop = $array['Created'];
                                  //$evitimer = $array['Amount'];
                                  // $timer = date("Y-m-d H:i:s",time()+(24*3600));
                                  //match timer
                                  $timer = date("Y-m-d H:i:s",time());
                                  $delta = strtotime($timeStop) - strtotime($timer);

                                  //evidence timer
                                  //$eviDelta = strtotime($evitimer) - strtotime($timer);
                                }
    ?>

<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Success</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #4 for basic datatable samples" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="../assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
          <link href="../assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="../assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="../assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />

        <!-- countdown js -->
        <script type="text/javascript">
          var initialTime = <?php echo $delta; ?>;
          var seconds = initialTime;
          function timer() {
              var days        = Math.floor(seconds/24/60/60);
              var hoursLeft   = Math.floor((seconds) - (days*86400));
              var hours       = Math.floor(hoursLeft/3600);
              var minutesLeft = Math.floor((hoursLeft) - (hours*3600));
              var minutes     = Math.floor(minutesLeft/60);
              var remainingSeconds = seconds % 60;
              if (remainingSeconds < 10) {
                  remainingSeconds = "0" + remainingSeconds;
              }
              document.getElementById('countdown').innerHTML = hours + "H : " + minutes + "M : " + remainingSeconds+ "s";
              if (seconds == 0) {
                  clearInterval(countdownTimer);
                  document.getElementById('countdown').innerHTML = "Completed";
              } else {
                  seconds++;
              }
          }
          var countdownTimer = setInterval('timer()', 1000);
        </script>
        <!-- countdown js -->


        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed">
      <!-- BEGIN HEADER -->
      <div class="page-header navbar navbar-fixed-top">
          <!-- BEGIN HEADER INNER -->
          <div class="page-header-inner ">
              <!-- BEGIN LOGO -->
              <div class="page-logo">
                  <a href="index.html">
                      <img src="../assets/layouts/layout4/img/logo-light.png" alt="logo" class="logo-default" /> </a>
                  <div class="menu-toggler sidebar-toggler">
                      <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                  </div>
              </div>
              <!-- END LOGO -->
              <!-- BEGIN RESPONSIVE MENU TOGGLER -->
              <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
              <!-- END RESPONSIVE MENU TOGGLER -->
              <!-- BEGIN PAGE ACTIONS -->
              <!-- DOC: Remove "hide" class to enable the page header actions -->

              <!-- END PAGE ACTIONS -->
              <!-- BEGIN PAGE TOP -->
              <div class="page-top">
                  <!-- BEGIN HEADER SEARCH BOX -->
                  <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->

                  <!-- END HEADER SEARCH BOX -->
                  <!-- BEGIN TOP NAVIGATION MENU -->
                  <div class="top-menu">
                      <ul class="nav navbar-nav pull-right">
                          <li class="separator hide"> </li>
                          <!-- BEGIN NOTIFICATION DROPDOWN -->
                          <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                          <!-- DOC: Apply "dropdown-hoverable" class after "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                          <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->

                          <!-- BEGIN TODO DROPDOWN -->
                          <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

                          <!-- END TODO DROPDOWN -->
                          <!-- BEGIN USER LOGIN DROPDOWN -->
                          <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                          <li class="dropdown dropdown-user dropdown-dark">
                              <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                  <span class="username username-hide-on-mobile"> <?php echo $fname; ?> </span>
                                  <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                                  <!--image logic-->
                                  <?php
                                    if($img)
                                    {
                                   ?>
                                   <img src="../assets/images/profile/<?php echo $img; ?>" class="img-responsive pic-bordered" alt="" />
                                   <?php
                                    }
                                    elseif($gen == "Male")
                                    {
                                   ?>
                                   <img src="../assets/images/male_avatar.jpg" class="img-responsive pic-bordered" alt="" />
                                   <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <img src="../assets/images/female_avatar.jpg" class="img-responsive pic-bordered" alt="" />
                                    <?php
                                    }
                                    ?>
                                  <!--image logic-->
                                   </a>
                              <ul class="dropdown-menu dropdown-menu-default">
                                  <li>
                                      <a href="profile.php">
                                          <i class="icon-user"></i> My Profile </a>
                                  </li>
                                  <li>
                                      <a href="tickets.php">
                                          <i class="icon-calendar"></i> My Tickets </a>
                                  </li>
                                  <li>
                                      <a href="app_todo_2.html">
                                          <i class="icon-rocket"></i> Call Center
                                      </a>
                                  </li>
                                  <li class="divider"> </li>
                                  <li>
                                      <a href="logout.php">
                                          <i class="icon-key"></i> Log Out </a>
                                  </li>
                              </ul>
                          </li>
                          <!-- END USER LOGIN DROPDOWN -->
                          <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                          <!-- END QUICK SIDEBAR TOGGLER -->
                      </ul>
                  </div>
                  <!-- END TOP NAVIGATION MENU -->
              </div>
              <!-- END PAGE TOP -->
          </div>
          <!-- END HEADER INNER -->
      </div>
      <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
          <!-- BEGIN SIDEBAR -->
          <div class="page-sidebar-wrapper">
              <!-- BEGIN SIDEBAR -->
              <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
              <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
              <div class="page-sidebar navbar-collapse collapse">
                  <!-- BEGIN SIDEBAR MENU -->
                  <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                  <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                  <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                  <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                  <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                  <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                  <?php include '../includes/sidebar.php'; ?>
              </div>
              <!-- END SIDEBAR -->
          </div>
          <!-- END SIDEBAR -->
          
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    
                    <?php
        $checklevel = "SELECT * FROM user WHERE User_ID='$profile_ID'";
        $checklevel_result = mysqli_query($connection, $checklevel) or die(mysqli_error($connection));
        
      while($checklevel_row = mysqli_fetch_array($checklevel_result))
      {
          $userlevel = $checklevel_row['Level'];          
      }
      
      if($userlevel == 0)
      {
          $url = 'dashboard.php';
      }elseif($userlevel == 1)
      {
          $url = 'dashboard_1.php';
      }elseif($userlevel == 2)
      {
          $url = 'dashboard_2.php';
      }elseif($userlevel == 3)
      {
          $url = 'dashboard_3.php';
      }elseif($userlevel == 4)
      {
          $url = 'dashboard_4.php';
      }elseif($userlevel == 5)
      {
          $url = 'dashboard_5.php';
      }elseif($userlevel == 6)
      {
          $url = 'dashboard_6.php';
      }
        
        ?>
                    <!-- BEGIN PAGE HEAD-->

   <div class="row">
                    
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
        <div class="alert alert-success" style="font-size:30px;">
<strong>Success! </strong> Transaction Completed </div>
                    <div> You will be redirected to your profile page in 5 seconds.</div>

                    </div>
                    <div class="col-md-2"></div>
                    
                    
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->

        </div>
        <!-- END CONTAINER -->
        <?php include '../includes/footer.php'; ?>
        <!-- BEGIN QUICK NAV -->

        <div class="quick-nav-overlay"></div>
        <!-- END QUICK NAV -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script>
<script src="../assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="../assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <link href="../assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <script src="../assets/global/scripts/jquery.counterup.min.js" type="text/javascript"></script>
        <script src="../assets/global/scripts/jquery.waypoints.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="../assets/pages/scripts/table-datatables-ajax.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="../assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>




        <!-- evidence countdown js -->
        <script type="text/javascript">
          var evi_initialTime = <?php echo $eviDelta; ?>;
          var seconds = evi_initialTime;
          function timer() {
              var days        = Math.floor(seconds/24/60/60);
              var hoursLeft   = Math.floor((seconds) - (days*86400));
              var hours       = Math.floor(hoursLeft/3600);
              var minutesLeft = Math.floor((hoursLeft) - (hours*3600));
              var minutes     = Math.floor(minutesLeft/60);
              var remainingSeconds = seconds % 60;
              if (remainingSeconds < 10) {
                  remainingSeconds = "0" + remainingSeconds;
              }
              document.getElementById('eviCountdown').innerHTML = hours + "H:" + minutes + "M:" + remainingSeconds+ "s";
              if (seconds == 0) {
                  clearInterval(countdownTimer);
                  document.getElementById('eviCountdown').innerHTML = "Completed";
              } else {
                  seconds++;
              }
          }
          var countdownTimer = setInterval('timer()', 1000);
        </script>
        <!-- evidence countdown js -->

        <!-- countdown js -->
        <script type="text/javascript">
          var initialTime = <?php echo $delta; ?>;
          var seconds = initialTime;
          function timer() {
              var days        = Math.floor(seconds/24/60/60);
              var hoursLeft   = Math.floor((seconds) - (days*86400));
              var hours       = Math.floor(hoursLeft/3600);
              var minutesLeft = Math.floor((hoursLeft) - (hours*3600));
              var minutes     = Math.floor(minutesLeft/60);
              var remainingSeconds = seconds % 60;
              if (remainingSeconds < 10) {
                  remainingSeconds = "0" + remainingSeconds;
              }
              document.getElementById('countdown').innerHTML = hours + "H : " + minutes + "M : " + remainingSeconds+ "s";
              if (seconds == 0) {
                  clearInterval(countdownTimer);
                  document.getElementById('countdown').innerHTML = "Completed";
              } else {
                  seconds++;
              }
          }
          var countdownTimer = setInterval('timer()', 1000);
        </script>
        <!-- countdown js -->
 
        
        <!--timeout-->
          <script type="text/JavaScript">
            setTimeout("location.href = '<?php echo $url?>';",5000);
          </script>
        <!--timeout-->
        <!-- END THEME LAYOUT SCRIPTS -->
        
    </body>

</html>

<?php } ?>
