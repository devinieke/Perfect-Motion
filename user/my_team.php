<?php 
ob_start();
session_start(); 
?>
<?php require_once '../includes/dbconnect.php'; ?>
<?php require_once '../includes/functions.php'; ?>

<?php


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
  $dets = "SELECT * FROM user WHERE User_ID='$profile_ID' AND (Bank_Name='' OR Acc_No='' OR Account_Name='' OR Kin_Name='' OR Kin_Rel='' OR Kin_Num='')";
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
    $stars = $dashRow['Stars'];
    $my_salt = $dashRow['Salt'];
  }
 ?>

 <?php
  if(array_key_exists('removeUser', $_POST))
  {
    $mainUser = $_POST['mainUserID'];
    $mainBen = $_POST['removeUserSalt'];

    $checkben = "SELECT * FROM user WHERE Salt='$mainBen'";
    $checkBenResult = mysqli_query($connection, $checkben) or die(mysqli_error($connection));

    while($checkRow = mysqli_fetch_array($checkBenResult))
    {
      $checkLevel = $checkRow['Level'];

      if($level != $checkLevel)
      {
        $deleteMatch = "DELETE FROM merge_tree WHERE ref_ID='$mainUser' AND Ben_ID='$mainBen'";
        $deleteMatchResult = mysqli_query($connection, $deleteMatch) or die(mysqli_error($connection));

        $standby = "UPDATE referral set standby=1 WHERE Ben_ID='$mainBen'";
        $standbyresult = mysqli_query($connection, $standby) or die(mysqli_error($connection));
      }
    }
  }
  ?>

   <?php
  if(array_key_exists('LockUser', $_POST))
  {
    $LockUser = $_POST['mainUserID'];
    $LockBen = $_POST['removeUserSalt'];

    $LockMatch = "UPDATE merge_tree SET Locked=1 WHERE ref_ID=$LockUser AND Ben_ID=$LockBen";
    $LockMatchResult = mysqli_query($connection, $LockMatch) or die(mysqli_error($connection));
  }
  ?>

  <?php
  if(array_key_exists('UnlockUser', $_POST))
  {
    $UnlockUser = $_POST['mainUserID'];
    $UnlockBen = $_POST['removeUserSalt'];

    $UnlockMatch = "UPDATE merge_tree SET Locked=0 WHERE ref_ID=$UnlockUser AND Ben_ID=$UnlockBen";
    $UnlockMatchResult = mysqli_query($connection, $UnlockMatch) or die(mysqli_error($connection));
  }
  ?>

<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>My Team</title>
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
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="../assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="../assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
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
                  <!-- END SIDEBAR MENU -->
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
                        <p class="alert alert-danger">Please Update Your Bank Details</p>
                        <?php
                          }
                         ?>
                        
                        <!-- END PAGE TITLE -->
                        <!-- BEGIN PAGE TOOLBAR -->
                        
                        <!-- END PAGE TOOLBAR -->
                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <h3>My Benefactors Business card</h3>
                    <hr>
                    <div class="row">
                    <?php
                      $benCheck = "SELECT * FROM merge_tree WHERE ref_ID='$profile_ID'";
                      $benCheckResult = mysqli_query($connection, $benCheck) or die(mysqli_error($connection));

                      while($benRow = mysqli_fetch_array($benCheckResult))
                      {
                        $ben = $benRow['Ben_ID'];
      
                        $benGet = "SELECT * FROM user WHERE Salt='$ben'";
                        $benGetResult = mysqli_query($connection, $benGet) or die(mysqli_error($connection));

                        while($benGetRow = mysqli_fetch_array($benGetResult))
                        {
                          $benFirst = $benGetRow['First_Name'];
                          $benLast = $benGetRow['Last_Name'];
                          $benEmail = $benGetRow['Email'];
                          $benPhone = $benGetRow['Phone_1'];
                          $benTwitter = $benGetRow['Twitter_Url'];
                          $benFacebook = $benGetRow['Facebook_Url'];
                          $benImage = $benGetRow['Image'];
                          $benSalt = $benGetRow['Salt'];
                          $select_s = $benGetRow['Status'];
                          $benImg = $benGetRow['Image'];
                          $benGen = $benGetRow['Gender'];

                    ?>
                      
                          <div class="col-md-4">
                              <div class="well row">
                                  <div class="col-md-7">
                                      <address>
                                          <strong><?php echo $benFirst." ".$benLast ?></strong><br>
                                          <strong><?php echo $benEmail ?></strong><br>
                                          <strong><?php echo $benPhone ?></strong><br>         
                                      </address>
                                  </div>
                                  <div class="col-md-5">
                                      <div class="profile-userpic">
                                          <?php
                                    if($benImg)
                                    {
                                   ?>
                                   <img src="../assets/images/profile/<?php echo $benImg; ?>" class="img-responsive pic-bordered" alt="" />
                                   <?php
                                    }
                                    elseif($benGen == "Male")
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
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-7">
                                          <a href="javascript:;" class="btn btn-sm green">Twitter</a>
                                          <a href="javascript:;" class="btn btn-sm blue">Facebook</a>
                                      </div>
                                      <div class="col-md-5">
                                      <form action="" method="post">
                                        <input type="hidden" name="removeUserSalt" value="<?php echo $benSalt?>" class="form-control">
                                        <input type="hidden" name="mainUserID" value="<?php echo $profile_ID?>" class="form-control">
                                        <button style="width:100%; text-align: center; margin-bottom:4px; color: #fff; background-color: #e7505a;" class="btn btn-sm red btn-outline filter-submit margin-bottom" name="removeUser" type="submit">
                                            <i class="fa fa-times"></i> Remove
                                        </button>
                                      </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      
                    <?php
                        }
                      }
                      if($benCheck && mysqli_affected_rows($connection) == 0)
                      {
                      echo '<p class="alert alert-warning co">No Benefactors</p>';
                      }
                    ?></div>

                    
                    <h3>My Sponsor(s) Business card</h3>
                    <hr>
                    
                    <div class="row">
                    <?php
                      $sponCheck = "SELECT * FROM merge_tree WHERE Ben_ID='$my_salt'";
                      $sponCheckResult = mysqli_query($connection, $sponCheck) or die(mysqli_error($connection));

                      while($sponRow = mysqli_fetch_array($sponCheckResult))
                      {
                        $spon = $sponRow['ref_ID'];

                        $sponGet = "SELECT * FROM user WHERE User_ID='$spon'";
                        $sponGetResult = mysqli_query($connection, $sponGet) or die(mysqli_error($connection));

                        while($sponGetRow = mysqli_fetch_array($sponGetResult))
                        {
                          $sponFirst = $sponGetRow['First_Name'];
                          $sponLast = $sponGetRow['Last_Name'];
                          $sponEmail = $sponGetRow['Email'];
                          $sponPhone = $sponGetRow['Phone_1'];
                          $sponTwitter = $sponGetRow['Twitter_Url'];
                          $sponFacebook = $sponGetRow['Facebook_Url'];
                          $sponImage = $sponGetRow['Image'];
                          $sponGen =    $sponGetRow['Gender'];
                    ?>
                          <div class="col-md-4">
                              <div class="well row">
                                  <div class="col-md-7">
                                      <address>
                                          Full Name: <br> <strong><?php echo $sponFirst." ".$sponLast ?></strong><br>
                                          Email : <br> <strong><?php echo $sponEmail ?></strong><br>
                                          Phone : <br> <strong><?php echo $sponPhone ?></strong><br>          
                                      </address>
                                  </div>
                                  <div class="col-md-5">
                                      <div class="profile-userpic">
                                          <?php
                                    if($sponImage)
                                    {
                                   ?>
                                   <img src="../assets/images/profile/<?php echo $sponImage; ?>" class="img-responsive pic-bordered" alt="" />
                                   <?php
                                    }
                                    elseif($sponGen == "Male")
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
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-7">
                                          <a href="javascript:;" class="btn btn-sm green">Twitter</a>
                                          <a href="javascript:;" class="btn btn-sm blue">Facebook</a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      
                    <?php
                        }
                      }
                      if($sponCheck && mysqli_affected_rows($connection) == 0)
                      {
                      echo '<p class="alert alert-warning co">No Sponsor</p>';
                      }
                    ?>
</div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            
        </div>
        <!-- END CONTAINER -->
          <?php include '../includes/footer.php'; ?>

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
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="../assets/pages/scripts/table-datatables-ajax.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="../assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>
<?php } ?>
