<?php
ob_start();
session_start();
?>
<?php require_once '../includes/dbconnect.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<?php require_once '../includes/profileUpdate.php'; ?>
<?php require_once '../includes/PMlogic.php'; ?>
<?php require_once '../includes/confirm.php'; ?>

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
      
  
       
      ////// Redirect if Bank details is not filled
  $dets = "SELECT * FROM user WHERE User_ID='$profile_ID' AND (Bank_Name='' OR Acc_No='' OR Account_Name='')";
  $detsResult = mysqli_query($connection, $dets) or die(mysqli_error($connection));

  if($detsResult && mysqli_affected_rows($connection) == 1)
  {
          redirect_to("profile.php");
  }

  //redirect to booking page
      $move = "SELECT * FROM book_cds WHERE User_ID='$profile_ID'";
      $move_result = mysqli_query($connection, $move) or die(mysqli_error($connection));

      while($move_row = mysqli_fetch_array($move_result))
      {
        $move_ID = $move_row['User_ID'];
        $move_amount = $move_row['Amount'];

        if($move_amount == 5000){
          $m_amount = 5250;
        }elseif($move_amount == 6000){
          $m_amount = 6300;
        }elseif($move_amount == 12000){
          $m_amount = 12400;
        }elseif($move_amount == 18000){
          $m_amount = 18600;
        }elseif($move_amount == 30000){
          $m_amount = 30800;
        }elseif($move_amount == 45000){
          $m_amount = 46000;
        }elseif($move_amount == 10000){
          $m_amount = 10250;
        }
      }

      if($move_result && mysqli_affected_rows($connection) == 1)
      {
        redirect_to("booking.php?cds_ID=$profile_ID&amount=$move_amount&agentamount=$m_amount&type=Agent");
      }
      //redirect to booking page
      
         
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
    $auxLevel = $dashRow['Aux_Level'];
    $agent = $dashRow['Agent'];
    $stars = $dashRow['Stars'];
  }
      if($level == 2)
      {
          redirect_to("dashboard_2.php");
      }
      
       ////// Redirect if Suspened
  $dets = "SELECT * FROM level_1 WHERE User_ID='$profile_ID' AND Active=0";
  $detsResult = mysqli_query($connection, $dets) or die(mysqli_error($connection));

  if($detsResult && mysqli_affected_rows($connection) == 1)
  {
          redirect_to("suspension.php");
  }
 ?>

 <?php

    $levelChk = "SELECT * FROM merge as m INNER JOIN user as u ON m.Spons_ID=u.User_ID WHERE m.Ben_ID = '$profile_ID' and u.Level=2 and m.Spons_con=0";
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
        <title>Dashboard</title>
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
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <?php
                          $dets = "SELECT * FROM user WHERE User_ID='$profile_ID' AND (Bank_Name='' AND Acc_No='' AND Account_Name='')";
                          $detsResult = mysqli_query($connection, $dets) or die(mysqli_error($connection));

                          if($detsResult && mysqli_affected_rows($connection) == 1)
                          {
                        ?>
                        <a href="profile.php"><p class="alert alert-danger">Please Update Your Bank Details</p></a>
                        <?php
                          }
                         ?>
                        <div class="page-title">
                            <h1>Dashboard
                            </h1>
                        </div>
                        <!-- END PAGE TITLE -->
                        <!-- BEGIN PAGE TOOLBAR -->

                        <!-- END PAGE TOOLBAR -->
                    </div>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-12">
                        <div class="portlet-body">
                            <div class="tiles">
                                <!--hide cds button-->
                                <?php
                                  $hide_cds = "SELECT * FROM cds WHERE User_ID='$profile_ID' AND Pay_Method=''";
                                  $hide_cds_result = mysqli_query($connection, $hide_cds) or die(mysqli_error($connection));

                                  if($hide_cds && mysqli_affected_rows($connection) > 0)
                                  {
                                ?>
                                <div class="tile bg-blue selected">
                                  <div class="corner"> </div>
                                  <div class="check"> </div>
                                  <div class="tile-body">
                                      <a href="cdsoptions.php?cds_ID=<?php echo $profile_ID; ?>&amount=5000&agentamount=5250" style="color:#fff;"> <h4 style="line-height:18px;"><strong>Community Development Service fee</strong></h4><i class="fa  fa-money" style="font-size:48px; padding-top:6px;"></i></a>

                                  </div>
                                  <div class="tile-object">
                                    <div class="name"><a href="cdsoptions.php?cds_ID=<?php echo $profile_ID; ?>&amount=5000&agentamount=5250" style="color:#fff;">Pay Now</a></div>
                                  </div>
                                </div>
                                <?php
                                  }
                                  else
                                  {

                                  }
                                 ?>
                                <!--hide cds button-->

                                <div class="tile bg-red-sunglo">
                                    <div class="tile-body">
                                        <i class="fa  fa-external-link-square"></i>
                                    </div>
                                    <div class="tile-object">
                                        <div class="name"> <a href="referral_link.php" style="color:#fff;">Invite Members </a></div>
                                        <div class="number">  </div>
                                    </div>
                                </div>
                                <div class="tile double selected pm4life">
                                    <div class="corner"> </div>
                                    <div class="check"> </div>
                                    <div class="tile-body">
                                        <h4>support@pm4life.org</h4>
                                        <p> Do you know that, you can as well</p>
                                        <p> contact us via email, if your  Benefactor is delaying your payment</p>
                                    </div>
                                    <div class="tile-object">
                                        <div class="name">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <div class="number"> </div>
                                    </div>
                                </div>
                                <div class="tile selected bg-yellow-saffron">
                                    <div class="corner"> </div>
                                    <div class="tile-body">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="tile-object">
                                        <div class="name"> Call Centers </div>
                                        <div class="number"><i class="fa fa-circle" style="color:#5bb723;"></i></div>
                                    </div>
                                </div>
                                <div class="tile double pm4life">
                                    <div class="tile-body">
                                        <?php
                                          $notify = "SELECT * FROM cds WHERE Agent_ID='$profile_ID' AND Completed=0";
                                          $notify_result = mysqli_query($connection, $notify) or die(mysqli_error($connection));
                                          $total_notify = mysqli_num_rows($notify_result);

                                          $user_notify = "SELECT * FROM level_1 WHERE User_ID='$profile_ID'";
                                          $user_notify_result = mysqli_query($connection, $user_notify) or die(mysqli_error($connection));

                                          while($user_notify_row = mysqli_fetch_array($user_notify_result))
                                          {
                                              $user_1 = $user_notify_row['Merge_1'];
                                              $user_2 = $user_notify_row['Merge_2'];
                                              $user_3 = $user_notify_row['Merge_3'];

                                              if($user_1 == 0 && $user_2 == 0 && $user_3 == 0 ){
                                                  $message = 3;
                                              }elseif($user_1 == 1 && $user_2 == 0 && $user_3 == 0){
                                                  $message = 2;
                                              }elseif($user_1 == 1 && $user_2 == 1 && $user_3 == 0){
                                                  $message = 1;
                                              }elseif($user_1 == 1 && $user_2 == 1 && $user_3 == 1){
                                                  $message = 0;
                                              }
                                          }
                                         ?>
                                        <h4>Notifications</h4>
                                        <?php
                                            if ($agent == 'yes')
                                            {
                                        ?>
                                        <p> Hello <?php echo $fname." ".$lname; ?>, You have (<?php echo $total_notify?>) pending CDS payments to confirm. </p>
                                        <?php
                                            }
                                            else
                                            {
                                        ?>
                                        <p> Hello <?php echo $fname." ".$lname; ?>, You have <?php echo $message?> match(es) left to complete this level. </p>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="tile-object">
                                        <div class="name"> <?php echo $fname." ".$lname ?> </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div></div>

                    <div class="row" style="margin-bottom:10px;">
                    <div class="col-md-3">
                        <div class="mt-element-list">
                                            <div class="row">

                                                <?php
                                $income = "SELECT sum(Amount) FROM merge WHERE Spons_ID='$profile_ID' AND Spons_Con='1'";
                                $incomeResult = mysqli_query($connection, $income) or die(mysqli_error($connection));

                                while($incomeRow = mysqli_fetch_array($incomeResult))
                                {
                                  $incomeTotal = $incomeRow['sum(Amount)'];
                                }

                                $pending = "SELECT count(Spons_Con) FROM merge WHERE Spons_ID='$profile_ID' AND Spons_Con='0'";
                                $pendingResult = mysqli_query($connection, $pending) or die(mysqli_error($connection));

                                while($pendingRow = mysqli_fetch_array($pendingResult))
                                {
                                  $pendingTotal = $pendingRow['count(Spons_Con)'];
                                }

                                $complete = "SELECT count(Spons_Con) FROM merge WHERE Spons_ID='$profile_ID' AND Spons_Con='1'";
                                $complete_Result = mysqli_query($connection, $complete) or die(mysqli_error($connection));

                                while($complete_Row = mysqli_fetch_array($complete_Result))
                                {
                                  $complete_Total = $complete_Row['count(Spons_Con)'];
                                }

                                  $getewallet = "SELECT * FROM e_wallet WHERE User_ID='$profile_ID'";
                                  $getewalletResult = mysqli_query($connection, $getewallet) or die(myqli_error($connection));

                                  while($getewalletRow = mysqli_fetch_array($getewalletResult))
                                  {
                                      $ewalletAmount = $getewalletRow['Amount'];
                                  }

                                $pending_refferal = "SELECT sum(Interest) FROM referral WHERE ref_ID='$profile_ID' AND Status=0";
                        $pendingResult = mysqli_query($connection, $pending_refferal) or die(mysqli_error($connection));

                        while($pending_row = mysqli_fetch_array($pendingResult))
                        {
                            $pending = $pending_row['sum(Interest)'];
                        }

                        $complete_refferal = "SELECT sum(Interest) FROM referral WHERE ref_ID='$profile_ID' AND Status=1";
                        $completeResult = mysqli_query($connection, $complete_refferal) or die(mysqli_error($connection));

                        while($complete_row = mysqli_fetch_array($completeResult))
                        {
                            $complete = $complete_row['sum(Interest)'];
                        }
                            ?>
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-green-sharp">
                                            <span data-counter="counterup" data-value="<?php echo $complete; ?>">0</span>
                                            <small class="font-green-sharp">₦</small>
                                        </h3>
                                        <small>REFERRAL BONUS</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-pie-chart"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 76%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">76% progress</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-title"> Pending </div>
                                        <div class="status-number">N <?php echo $pending; ?> </div>
                                    </div>
                                </div>
                            </div>
                                            </div>
                        </div></div>
                        <div class="col-md-3">
                        <div class="mt-element-list">

                                            <div class="row">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-red-haze">
                                            <span data-counter="counterup" data-value="<?php echo $ewalletAmount; ?>">0</span>
                                            <small class="font-red-haze">₦</small>
                                        </h3>
                                        <small>e-Wallet</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-like"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 76%;" class="progress-bar progress-bar-success red-haze">
                                            <span class="sr-only">76% progress</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-title"> TRANSFER FUNDS <a href="funds_transfer.php">CLICK HERE</a></div>
                                        <div class="status-number"><a href=""><i class="icon-plus"></i></a></div>
                                    </div>
                                </div>
                            </div>
                                            </div>
                        </div></div>
                    <div class="col-md-3">
                        <div class="mt-element-list">
                                            <div class="row">

                                                <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-red-haze">
                                            <span data-counter="counterup" data-value="<?php echo $incomeTotal; ?>">0</span>
                                            <small class="font-red-haze">₦</small>
                                        </h3>
                                        <small>TOTAL INCOME</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-bag"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 76%;" class="progress-bar progress-bar-success red-haze">
                                            <span class="sr-only">76% progress</span>
                                        </span>
                                    </div>
                                        <div class="status">
                                        <div class="status-title"> Completed</div>
                                        <div class="status-number"><?php echo $complete_Total ?>
                                            <span class="font-red-haze">(<?php echo $pendingTotal ?>)</span>

                                            </div>
                                    </div>
                                </div>
                            </div>
                                            </div>
                        </div></div>
                    <div class="col-md-3">
                        <div class="mt-element-list">
                        <?php
                          $totalUsers = "SELECT * FROM user";
                          $totalResult = mysqli_query($connection, $totalUsers) or die(mysqli_error($connection));
                          $total = mysqli_num_rows($totalResult) + 5000;
                         ?>
                              <div class="row">
                                  <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-black-haze">
                                            <span data-counter="counterup" data-value="<?php echo $total; ?>"></span>
                                            <small class="font-black-haze"></small>
                                        </h3>
                                        <small>NEW USERS</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 76%;" class="progress-bar progress-bar-success black-haze">
                                            <span class="sr-only">76% progress</span>
                                        </span>
                                    </div>
                                        <div class="status">
                                        <div class="status-title"> GROWTH</div>
                                        <div class="status-number"></div>
                                    </div>
                                </div>
                            </div>
                              </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-3">
                                  <!-- PORTLET MAIN -->
                                  <div class="portlet light profile-sidebar-portlet bordered">
                                      <!-- SIDEBAR USERPIC -->
                                      <div>
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
                                         </div>
                                      <!-- END SIDEBAR USERPIC -->
                                      <!-- SIDEBAR USER TITLE -->
                                      <div class="profile-usertitle">
                                          <div class="profile-usertitle-name"> <?php echo $fname; ?>  <?php echo $lname; ?> </div>
                                      </div>

                                      <div class="profile-usermenu">
                                          <ul class="nav">
                                              <li class="active">
                                                  <a href="#">
                                                      <i class="icon-envelope"></i> <?php echo $email; ?>  </a>
                                              </li>
                                              <li>
                                                  <a href="#">
                                                      <h4><i class="icon-user"></i>Level <?php echo $level; ?></h4></a>
                                              </li>

                                          </ul>
                                      </div>
                                      <!-- END MENU -->
                                  </div>
                                  <!-- END PORTLET MAIN -->
                                  <!-- PORTLET MAIN -->

                                  <!-- END PORTLET MAIN -->
                          </div>
                        <div class="col-md-6">
                          <?php
                            $mergeChk = "SELECT * FROM merge WHERE Spons_ID='$profile_ID' AND Spons_Con=0";
                            $mergeChkRslt = mysqli_query($connection, $mergeChk) or die(mysqli_error($connection));

                            while($mergeChkRow = mysqli_fetch_array($mergeChkRslt))
                            {
                              $con_ID = $mergeChkRow['id'];
                              $ben = $mergeChkRow['Ben_ID'];
                              $det = $mergeChkRow['Other_Details'];
                              $amt = $mergeChkRow['Amount'];
                              $type = $mergeChkRow['Trans_Type'];
                              $teller = $mergeChkRow['Teller_No'];
                              $img = $mergeChkRow['Image'];

                               $show="SELECT * FROM merge WHERE id='$con_ID'";
                                $result = mysqli_query($connection, $show) or die(mysqli_error($connection));
                                while ($array = mysqli_fetch_array($result))
                                {
                                  $timeStop = $array['Created'];
                                  //$evitimer = $array['Amount'];
                                  // $timer = date("Y-m-d H:i:s",time()+(24*3600));
                                  //match timer
                                  $timer = date("Y-m-d H:i:s",time());
                                  $countdown = strtotime($timer) - strtotime($timeStop);
                                  $del_0 = 86400 - $countdown;
                                  $delta_0 = gmdate("H:i:s", $del_0);

                                  //evidence timer
                                  //$eviDelta = strtotime($evitimer) - strtotime($timer);
                                }

                              $evishow="SELECT * FROM merge WHERE id='$con_ID'";
                              $eviresult = mysqli_query($connection, $evishow) or die(mysqli_error($connection));
                              while ($eviarray = mysqli_fetch_array($eviresult))
                              {
                                $evitimer = $eviarray['Evi_Date'];
                                //match timer
                                $timer = date("Y-m-d H:i:s",time());

                                //evidence timer
                                  $evi_countdown = strtotime($timer) - strtotime($evitimer);
                                  $evi_del_0 =  86400 - $evi_countdown;
                                  $evi_delta_0 = gmdate("H:i:s", $evi_del_0);
                              }



                              $getUser = "SELECT * FROM user WHERE User_ID='$ben'";
                              $getUserResult = mysqli_query($connection, $getUser) or die(mysqli_error($connection));

                              while($getRow = mysqli_fetch_array($getUserResult))
                              {
                                $get_ID = $getRow['User_ID'];
                                $get_firstname = $getRow['First_Name'];
                                $get_lastname = $getRow['Last_Name'];
                                $get_bankName = $getRow['Bank_Name'];
                                $get_acc_Name = $getRow['Account_Name'];
                                $get_acc_Num = $getRow['Acc_No'];
                                $getgen = $getRow['Gender'];
                                $getimg = $getRow['Image'];
                                $get_phone = $getRow['Phone_1'];
                                $get_phone2 = $getRow['Phone_2'];
                                $get_twitter = $getRow['Twitter_Url'];
                                $get_fbook = $getRow['Facebook_Url'];
                                $get_level = $getRow['Level'];
                          ?>
                          <!--card-->
                          <div class="row">

                              <h3>My Benefactor Information</h3><h4>
                                    <?php echo $get_firstname ?>
                                    <?php
                                        if($del_0 < 86400)
                                      {
                                        if($del_0 < 0)
                                        {
                                          echo '<span style="color:red; font-weight:bold;">is due to pay you $40(₦10,000).</span>';
                                        }
                                        else
                                        {
                                          echo 'will pay you $40(₦10,000) in <span style="color:red; font-weight:bold;">'.$delta_0.'</span> ';
                                        }
                                      }
                                      else
                                      {
                                        echo '<span style="color:red; font-weight:bold;">is due to pay you ₦10,000.</span>';
                                      }
                                     ?>

                                  </h4>
                              <div class="well row">
                                    <div class="col-md-7">
                                    <address>
                                        Full Name: <strong><?php echo $get_firstname ?>  <?php echo $get_lastname ?></strong><br><br>
                                        Added Note: <strong>Please Call me on and after payment. Dont forget to upload the details of your payment</strong><br><br>
                                        Phone 1: <strong><?php echo $get_phone ?></strong><br>
                                        Phone 2: <strong><?php echo $get_phone2 ?></strong><br>
                                        <hr>
                                    </address>
                                    </div>
                                    <div class="col-md-5">
                                    <div class="profile-userpic">
                                      <!--image logic-->
                                      <?php
                                        if($getimg)
                                        {
                                       ?>
                                       <img src="../assets/images/profile/<?php echo $getimg; ?>" class="img-responsive pic-bordered" alt="" />
                                       <?php
                                        }
                                        elseif($getgen == "Male")
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
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-7">

                                        <?php
                                        $selectMerge = "SELECT * FROM merge WHERE id='$con_ID' AND Ben_Con=1";
                                          $selectMergeResult = mysqli_query($connection, $selectMerge) or die(mysqli_error($connection));

                                          if(mysqli_num_rows($selectMergeResult) > 0)
                                          {
                                        ?>
                                        <address>

                                        Payment Details: <strong><?php echo $det; ?></strong><br>
                                        Amount Paid: <strong><?php echo $amt; ?></strong><br>
                                        Type: <strong><?php echo $type ?></strong><br>
                                        Teller No.: <strong><?php echo $teller; ?></strong><br>
                                        <a href="../assets/images/evidence/<?php echo $img; ?>" target="_blankv ">click here for evidence image</a>
                                        <hr>
                                    </address>
                                        <?php }?>

                    </div>
                                    <div class="col-md-5">
                                        <?php


                                          if(mysqli_num_rows($selectMergeResult) > 0)
                                          {
                                            if($evi_del_0 < 86400)
                                            {
                                              if($evi_del_0 < 0)
                                              {
                                                echo '<span style="color:red; font-weight:bold;">Confirmation Period Has Expired.</span>';
                                              }
                                              else
                                              {
                                                echo 'You have <span style="color:red; font-weight:bold;">'.$evi_delta_0.'</span> to confirm';
                                              }
                                            }
                                            else
                                            {
                                              echo '<span style="color:red; font-weight:bold;">Confirmation Period Has Expired.</span>';
                                            }
                                         ?>
                                        <form class="" action="" method="post">
                                          <input type="hidden" name="spons" value="<?php echo $profile_ID; ?>" class="form-control">
                                          <input type="hidden" name="ben" value="<?php echo $ben; ?>" class="form-control">
                                          <input type="hidden" name="mergeID" value="<?php echo $con_ID; ?>" class="form-control">
                                          <button class="btn red btn-large" name="conPay" type="submit"title="">Confirm Payment</button>
                                        </form>
                                        <?php
                                          }
                                         ?>

                                        </div>
                                    </div>
                                </div>
                          </div>
                          <!--card-->
                          <?php
                              }
                            }


                            if($mergeChk && mysqli_affected_rows($connection) == 0)
                            {
                              $upgradeButton = "SELECT * FROM level_1 WHERE User_ID='$profile_ID' AND completed=1";
                              $upgradeResult = mysqli_query($connection, $upgradeButton) or die(mysqli_error($connection));
                              while($row = mysqli_fetch_array($upgradeResult))
                              {
                                $total = $row['completed'];
                              }

                              if($total == 1)
                              {
                                    $startButton = "SELECT * FROM level_1 WHERE User_ID='$profile_ID' AND Merge=1";
                                    $startResult = mysqli_query($connection, $startButton) or die(mysqli_error($connection));

                                    if(mysqli_num_rows($startResult) > 0)
                                    {
                                        echo '<p class="alert alert-warning">Already Matched.</p>';

                          ?>
                          <?php
                              if($levelChk && mysqli_affected_rows($connection) == 0)
                              {
                                  echo '<p class="alert alert-warning"> No Available Sponsors, Please Try Again Soon.</p>';
                              }
                              elseif($lvl_con == 0)
                              {
                            ?>
                            <div class="row">

                                <h3>My Sponsor Information</h3><h4>
                                    <?php
                                        if($delta < -86400)
                                      {
                                        echo '<span style="color:red; font-weight:bold;">You are due to pay $80(₦20,000) to </span>';
                                      }
                                      else
                                      {
                                        echo 'You have <span id="countdown" style="color:red; font-weight:bold;"></span> to pay $80(₦20,000) to';
                                      }
                                     ?>
                                    <?php echo $Mfirstname ?>
                                  </h4>
                                                <div class="well row">
                                                    <div class="col-md-7">
                                                    <address>
                                                        Full Name: <strong><?php echo $Mfirstname ?>  <?php echo $Mlastname ?></strong><br>
                                                        Account Name: <strong><?php echo $Macc_Name ?></strong><br>
                                                        Bank Name: <strong><?php echo $MbankName ?></strong><br>
                                                        Account No.: <strong><?php echo $Macc_Num ?></strong><br>
                                                        Donation Type.: <strong>Cash or Transfer or Bank Payment</strong><br><br>
                                                        Added Note: <strong>Please Call me on and after payment. Dont forget to upload the details of your payment</strong><br><br>
                                                        Phone 1: <strong><?php echo $M_phone ?></strong><br>
                                                        <!-- Phone 2: <strong>Loop, Inc.</strong><br> -->
                                                    </address>
                                                    </div>
                                                    <div class="col-md-5">
                                                    <div class="profile-userpic">
                                                      <!--image logic-->
                                                      <?php
                                                        if($M_img)
                                                        {
                                                       ?>
                                                       <img src="../assets/images/profile/<?php echo $M_img; ?>" class="img-responsive pic-bordered" alt="" />
                                                       <?php
                                                        }
                                                        elseif($M_gen == "Male")
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
                                              </div>
                                                    </div>
                                                    <div class="row">
                                                    <div class="col-md-7">

                                    </div>
                                                    <!--dismiss upload button-->
                                                <?php
                                                  $hide = "SELECT * FROM merge WHERE Ben_ID='$profile_ID' AND Spons_ID='$M_ID' AND Ben_Con=1 AND Spons_Con=0";
                                                  $hide_result = mysqli_query($connection, $hide) or die(mysqli_error($connection));

                                                  if($hide && mysqli_affected_rows($connection) > 0)
                                                  {
                                                    echo '<span style="color:red; font-weight:bold;">Awaiting Sponsor Confirmation </span>';
                                                  }
                                                  else
                                                  {
                                                ?>
                                                  <div class="col-md-5">
                                                  <a href="payDetail.php?match_ID=<?php echo $M_ID; ?>&ID=<?php echo $lvl_id; ?>&paymentAmount=20000" class="btn btn-sm green">
                                                       <i class="fa fa-edit"></i>
                                                      Upload Payment Details
                                                  </a>
                                                  </div>
                                                <?php
                                                  }
                                                 ?>
                                                <!--dismiss upload button-->
                                                    </div>
                                                </div>
                            </div>
                            <?php
                              }
                              else
                              {
                                echo '<p class="alert alert-warning">No matches, please try again soon.</p>';
                              }
                             ?>
                          <?php
                                    }
                                    else
                                    {
                              ?>
                               <?php

                               $check_spon="SELECT * FROM merge WHERE Spons_con=0 AND Spons_ID='$profile_ID'";
                               $check_spon_result=mysqli_query($connection, $check_spon) or die(mysqli_error($connection));

                               if(mysqli_num_rows($check_spon_result) == 0)
                               {
                                                                   ?>
                              <div class="note note-warning">
                                        <h4 class="block">Hello <?php echo $fname; ?>  <?php echo $lname; ?>! </h4>
                                        <p> It's time to Upgrade to Level 2. We advice you to complete your down-line transaction before clicking the upgrade button. You might loose your pending transaction, if you click the Updrage button. <br><br> Thanks </p>

                                    </div>

                               <p>
                                 <form class="" action="" method="post">
                                   <input type="hidden" name="startID" value="<?php echo $profile_ID?>" class="form-control">
                                   <input type="hidden" name="matchID" value="<?php echo $M_ID?>" class="form-control">
                                     <button type="submit" id="register-submit-btn" class="btn btn-primary mt-ladda-btn ladda-button green" data-style="expand-right" name="upgrade"><span class="ladda-label"><i class="icon-arrow-right"></i> Upgrade Now</span></button>
                                 </form>
                               </p>
                              <?php
                               }

                                    }
                              }
                              else
                              {
                                ///notify user to pay cds
                            ///Check first if he paid cds

                            $checkcds ="SELECT * FROM cds WHERE User_ID='$profile_ID' AND paid=1";
                            $checkcds_result = mysqli_query($connection, $checkcds) or die (mysqli_error($conection));

                            

                            if(mysqli_num_rows($checkcds_result) == 0)
                            {
                                $checkmerge_1 = "SELECT * FROM level_1 WHERE User_ID ='$profile_ID' AND Merge_1=1 AND Merge_2=0 AND Merge_3=0";
                                $checkmerge_1_result = mysqli_query($connection, $checkmerge_1) or die(mysqli_error($connection));

                                  if(mysqli_num_rows($checkmerge_1_result) > 0)
                                  {
                                  ///check if the user and complete the first merge

                                $checkmerge_2 = "SELECT * FROM merge WHERE Spons_ID ='$profile_ID' AND Spons_Con =0";
                                $checkmerge_2_result = mysqli_query($connection, $checkmerge_2) or die(mysqli_error($connection));
                                      if(mysqli_num_rows($checkmerge_2_result) == 0)
                                      {
                                          ?>
                            <div class="row" style="padding: 16px">
                                <div class="note note-warning">
                                        <h4 class="block"> Hey <?php echo $fname; ?>  <?php echo $lname; ?>! </h4>
                                        <p> It's time to Pay your Community Development fee (CDS).  We advice you to pay now, else you wont be able to see to confirm your remaining 2 benefactors <br><br> Thanks </p>

                                    </div>
                                <?php
                                  if(mysqli_num_rows($hide_cds_result) > 0)
                                  {
                                ?>
                                <a href="cdsoptions.php?cds_ID=<?php echo $profile_ID; ?>&amount=5000&agentamount=5250" class="btn btn-primary mt-ladda-btn ladda-button green"> Pay Now </a>
                                <?php
                                  }
                                  else
                                  {
                                ?>
                                <a href="#" class="btn btn-primary mt-ladda-btn ladda-button green"> Awaiting Agent/Company Confirmation </a>
                                <?php
                                  }
                                 ?>
                                </div>

                            <?php
                                      }

                                  }

                            }else
                            {
                             $confmerge="SELECT * FROM level_1 WHERE User_ID ='$profile_ID' AND (Merge_1=1 AND Merge_2=1) OR (Merge_1=1 AND Merge_2=1 AND Merge_3=1)";
                             $confmerge_result = mysqli_query($connection, $confmerge) or die(mysqli_error($connection));

                                if(mysqli_num_rows($confmerge_result) == 0)
                                {
                                    ?>
                            <div class="row" style="padding: 16px">
                                <div class="note note-success">
                                        <h4 class="block"> Hey <?php echo $fname; ?>  <?php echo $lname; ?>! </h4>
                                        <p> Thank You for Paying your CDS. You can now be Merge with you remain benefactors <br><br> Thanks </p>
                                    </div>
                                </div>
                        <?php
                                }
                            }
                        if(mysqli_num_rows($hide_cds_result) == 0)
                        {
                        ?>
                        <a href="#"><img src="../assets/images/paycds.jpg" class="img-responsive pic-bordered" alt=""/></a>

                                <?php
                                  }

                              }
                            }
                            elseif($getUser && mysqli_affected_rows($connection) == 0)
                            {
                              echo '<p class="alert alert-warning">No matches, please try again soon.</p>';
                            }
                          ?>

                          <!-- pending level 4 activities -->

                          <!-- pending level 4 activities -->

                        </div>
                                           <div class="col-md-3">
                        <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-edit font-dark"></i>
                                        <span class="caption-subject font-dark bold uppercase">Notes</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-cloud-upload"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-wrench"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"> </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-trash"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="note note-success">
                                        <h4 class="block">Success! Some Header Goes Here</h4>
                                        <p> Duis mollis, est non commodo luctus, nisi erat mattis consectetur  </p>
                                    </div>
                                    <div class="note note-info">
                                        <h4 class="block">Info! Some Header Goes Here</h4>
                                        <p> Duis mollis, est non commodo luctus, nisi erat porttitor ligula,  </p>
                                    </div>
                                    <div class="note note-danger">
                                        <h4 class="block">Danger! Some Header Goes Here</h4>
                                        <p> Duis mollis, est non commodo luctus, nisi erat porttitor ligula,  </p>
                                    </div>
                                </div>
                            </div>
                        </div>

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
              if (seconds > 0) {
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
              if (seconds > 0) {
                  clearInterval(countdownTimer);
                  document.getElementById('countdown').innerHTML = "Completed";
              } else {
                  seconds++;
              }
          }
          var countdownTimer = setInterval('timer()', 1000);
        </script>
        <!-- countdown js -->


        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>

<?php } ?>
