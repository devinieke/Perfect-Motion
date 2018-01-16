<?php
ob_start();
session_start();

//secure session timeout
// if(!isset($_SESSION['CREATED']))
// {
//     $_SESSION['CREATED'] = time();
// }
// elseif(time() - $_SESSION['CREATED'] > 30)// 300 == time in seconds
// {
//     session_regenerate_id(true);
//     header("Location: login.php?session_expired=yes");
//     exit;

//     $_SESSION['CREATED'] = time();
// }
//secure session timeout

?>

<?php require_once '../includes/dbconnect.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<?php require_once '../includes/profileUpdate.php'; ?>

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
      $dets = "SELECT * FROM user WHERE User_ID='$profile_ID' AND (Bank_Name='' OR Acc_No='' OR Account_Name='')";
      $detsResult = mysqli_query($connection, $dets) or die(mysqli_error($connection));

      if($detsResult && mysqli_affected_rows($connection) == 1)
      {
         $switchtab_on = 'active';
         $switchtab_off = '';
         $switchtab_a = 'active';
         $switchtab_p = '';
          
      }else
      {
          
      $dets_1 = "SELECT * FROM user WHERE User_ID='$profile_ID' AND (Kin_Name='' OR Kin_Rel='' OR Kin_Num='')";
      $detsResult_1 = mysqli_query($connection, $dets_1) or die(mysqli_error($connection));

      if($detsResult_1 && mysqli_affected_rows($connection) == 1)
      {
         $switchtab_off = '';
         $switchtab_p = 'active';
         $switchtab_a = 'active';
         $switchtab_on = '';
         
      }else
      {
          $switchtab_off = 'active';
          $switchtab_on = '';
          $switchtab_a = '';
          $switchtab_p = '';
      }
          

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
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<!--Get Info-->
<?php
  $dashQuery = "SELECT * FROM user WHERE UserName='$profile'";
  $dashResult = mysqli_query($connection, $dashQuery);

  while($dashRow = mysqli_fetch_array($dashResult))
  {
    $fname = $dashRow['First_Name'];
    $lname = $dashRow['Last_Name'];
    $email = $dashRow['Email'];
    $gen = $dashRow['Gender'];
    $tel = $dashRow['Phone_1'];
    $tel2 = $dashRow['Phone_2'];
    $img = $dashRow['Image'];
    $add = $dashRow['Address'];
    $city = $dashRow['City'];
    $bankName = $dashRow['Bank_Name'];
    $acc_Name = $dashRow['Account_Name'];
    $acc_Num = $dashRow['Acc_No'];
    $twitter = $dashRow['Twitter_Url'];
    $fbook = $dashRow['Facebook_Url'];
    $level = $dashRow['Level'];
    $a_level = $dashRow['Aux_Level'];
    $stars = $dashRow['Stars'];
    $alt = $dashRow['Salt'];
  }
 ?>
<!--Get Info-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>User Profile</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Perfect motion 4 life user profile" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="../assets/pages/css/profile-2.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
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
                          $dets = "SELECT * FROM user WHERE User_ID='$profile_ID' AND (Bank_Name='' OR Acc_No='' OR Account_Name='' OR Kin_Name='' OR Kin_Rel='' OR Kin_Num='')";
                          $detsResult = mysqli_query($connection, $dets) or die(mysqli_error($connection));

                          if($detsResult && mysqli_affected_rows($connection) == 1)
                          {
                        ?>
                        <p class="alert alert-danger">Please Update Your Bank Details and Your Profile</p>
                        <?php
                          }
                         ?>
                         <?php if(isset($error['upError'])){echo $error['upError'];} ?>
                        <div class="page-title">
                            <h1>User Profile
                            </h1>
                        </div>
                        <!-- END PAGE TITLE -->
                        <!-- BEGIN PAGE TOOLBAR -->

                        <!-- END PAGE TOOLBAR -->
                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">User</span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="profile">
                        <div class="tabbable-line tabbable-full-width">

                            <ul class="nav nav-tabs">
                                <li class="<?php echo $switchtab_off; ?>">
                                    <a href="#tab_1_1" data-toggle="tab"> Overview </a>
                                </li >
                                <li class="<?php echo $switchtab_a; ?>">
                                    <a href="#tab_1_3" data-toggle="tab"> Account </a>
                                </li>
                                <li>
                                    <a href="#tab_1_6" data-toggle="tab"> Help </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane <?php echo $switchtab_off; ?>" id="tab_1_1">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <ul class="list-unstyled profile-nav">
                                                <li>
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
                                                </li>
                                                
                                                <li>
                                                  <a href="javascript:;">
                                                    Level
                                                    <span> <?php echo $level; ?> </span>
                                                  </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-8 profile-info">
                                                    <h1 class="font-green sbold uppercase"><?php echo $fname; ?>  <?php echo $lname; ?></h1>

                                                </div>
                                                <!--end col-md-8-->
                                                <div class="col-md-4">
                                                    <div class="portlet sale-summary">
                                                        <div class="portlet-title">
                                                            <div class="caption font-red sbold"> Account Summary </div>
                                                            <div class="tools">
                                                                <a class="reload" href="javascript:;"> </a>
                                                            </div>
                                                        </div>
                                                        <div class="portlet-body">
                                                            <ul class="list-unstyled">
                                                              <?php
						                                                      $refQuery = "SELECT * FROM referral WHERE ref_ID = '$profile_ID'";
			                                                            $refResult = mysqli_query($connection, $refQuery) or die(mysql_error());
				                                                          $refCount = mysqli_num_rows($refResult);

                                                                          $income = "SELECT sum(Amount) FROM merge WHERE Spons_ID='$profile_ID' AND Spons_Con='1'";
                                                                          $incomeResult = mysqli_query($connection, $income) or die(mysqli_error($connection));

                                                                          while($incomeRow = mysqli_fetch_array($incomeResult))
                                                                          {
                                                                            $incomeTotal = $incomeRow['sum(Amount)'];
                                                                          }

                                                                          $bonusQuery = "SELECT * FROM user WHERE User_ID='$profile_ID'";
                                                                          $bonusResult = mysqli_query($connection, $bonusQuery) or die(mysqli_error($connection));

                                                                          while($bonusRow = mysqli_fetch_array($bonusResult))
                                                                          {
                                                                            $userSalt = $bonusRow['Salt'];

                                                                            $getewallet = "SELECT * FROM e_wallet WHERE User_ID='$profile_ID'";
                                                                            $getewalletResult = mysqli_query($connection, $getewallet) or die(mysqli_error($connection));

                                                                            while($getewalletRow = mysqli_fetch_array($getewalletResult))
                                                                            {
                                                                                $ewalletamount = $getewalletRow['Amount'];
                                                                            }
                                                                          }
						                                        ?>
                                                                <li>
                                                                    <span class="sale-info"> TOTAL REFERRALS
                                                                        <i class="fa fa-img-up"></i>
                                                                    </span>
                                                                    <span class="sale-num"> <?php echo $refCount; ?> </span>
                                                                </li>
                                                                <li>
                                                                    <span class="sale-info"> TOTAL INCOME
                                                                        <i class="fa fa-img-down"></i>
                                                                    </span>
                                                                    <span class="sale-num"> ₦<?php echo $incomeTotal; ?> </span>
                                                                </li>
                                                                <li>
                                                                    <span class="sale-info"> eWallet Balance </span>
                                                                    <span class="sale-num"> ₦<?php echo $ewalletamount ?></span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end col-md-4-->
                                            </div>
                                            <!--end row-->
                                            <div class="tabbable-line tabbable-custom-profile">
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a href="#tab_1_11" data-toggle="tab"> Transaction History </a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_1_22" data-toggle="tab"> My Referrals </a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_1_33" data-toggle="tab"> CDS History </a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_1_44" data-toggle="tab"> e-Wallet Transfer</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab_1_11">
                                                        <div class="portlet-body">
                                                            <table class="table table-striped table-bordered table-advance table-hover">
                                                                <thead>
                                                                    <tr>

                                                                        <th>
                                                                            <i class="fa fa-calendar"></i> Date </th>
                                                                        <th>
                                                                            <i class="fa fa-briefcase"></i> Sponsor </th>
                                                                        <th class="hidden-xs">
                                                                            <i class="fa fa-question"></i> Beneficiary </th>
                                                                        <th>
                                                                            <i class="fa fa-bookmark"></i> Amount </th>
                                                                        <th> </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                  <!-- transaction history based on sponsid, benid and spons con -->
                                                                  <?php
                                                                        $transaction = "SELECT * FROM merge WHERE Ben_ID='$profile_ID' OR Spons_ID='$profile_ID'";
                                                                        $transactionResult = mysqli_query($connection, $transaction) or die(mysqli_error($connection));

                                                                        while($tRow = mysqli_fetch_array($transactionResult))
                                                                        {
                                                                            $Spons_Con = $tRow['Spons_Con'];
                                                                            $Sponsor = $tRow['Spons_ID'];
                                                                            $Beneficiary = $tRow['Ben_ID'];
                                                                            $tDate = $tRow['Created'];
                                                                            $tAmount = $tRow['Amount'];
                                                                            $merge_id = $tRow['id'];
                                                                            $pay_type = $tRow['Trans_Type'];

                                                                            if($Spons_Con==1)
                                                                            {
                                                                                $Spons_Con= '<span class="label label-success label-sm"> Paid </span>';
                                                                            }
                                                                            else
                                                                            {
                                                                                $Spons_Con= '<span class="label label-danger label-sm"> Not Paid </span>';
                                                                            }

                                                                            $getSponsor = "SELECT * FROM user WHERE User_ID='$Sponsor'";
                                                                            $getSponsorResult = mysqli_query($connection, $getSponsor) or die(mysqli_error($connection));

                                                                            while($getSponsorRow = mysqli_fetch_array($getSponsorResult))
                                                                            {
                                                                                $get_f_Name = $getSponsorRow['First_Name'];
                                                                                $get_l_Name = $getSponsorRow['Last_Name'];

                                                                                $getBenficiary = "SELECT * FROM user WHERE User_ID='$Beneficiary'";
                                                                                $getBenficiaryResult = mysqli_query($connection, $getBenficiary) or die(mysqli_error($connection));

                                                                                while($getBenRow = mysqli_fetch_array($getBenficiaryResult))
                                                                                {
                                                                                    $ben_f_name = $getBenRow['First_Name'];
                                                                                    $ben_l_name = $getBenRow['Last_Name'];
                                                                    ?>
                                                                    <tr>
                                                                        <td>
                                                                            <a> <?php echo $tDate ?> </a>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $get_f_Name ?>  <?php echo $get_l_Name ?>
                                                                        </td>
                                                                        <td ><?php echo $ben_f_name ?>  <?php echo $ben_l_name ?></td>
                                                                        <td> <?php echo $tAmount; ?>
                                                                            <?php echo $Spons_Con ?>
                                                                        </td>
                                                                        <td>
                                                                            <a class="btn btn-sm grey-salsa btn-outline" data-toggle="modal" href="#<?php echo $merge_id; ?>"> View </a>
                                                                            
                                                                            
                                                                        <div class="modal fade" id="<?php echo $merge_id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title"><?php echo $ben_f_name." ".$ben_l_name." will pay  ".$get_f_Name." ".$get_l_Name; ?></h4>
                                                </div>
                                                <div class="modal-body">
                                                <table class="table table-striped table-bordered table-hover table-checkable">
                                                    <thead>
                                                    <tr>
                                                    <th width="50%"></th>
                                                    <th width="50%"></th>
                                                    </tr>
                                                 <tr>
                                                     <td>
                                                    <h4><strong>Sponsor</strong></h4>
                                                     </td>
                                                     <td>
                                                      <h4><?php echo $get_f_Name ?>  <?php echo $get_l_Name ?></h4>
                                                     </td>
                                                    </tr>
                                                 <tr>
                                                     <td>
                                                    <h4><strong>Benefactor</strong></h4>
                                                     </td>
                                                     <td>
                                                      <h4><?php echo $ben_f_name ?>  <?php echo $ben_l_name ?></h4>
                                                     </td>
                                                    </tr>
                                                 <tr>
                                                     <td>
                                                    <h4><strong>Amount</strong></h4>
                                                     </td>
                                                     <td>
                                                      <h4><?php echo $tAmount; ?></h4>
                                                     </td>
                                                    </tr>
                                                 <tr>
                                                     <td>
                                                    <h4><strong>Status</strong></h4>
                                                     </td>
                                                     <td>
                                                      <h4><?php echo $tAmount; ?></h4>
                                                     </td>
                                                    </tr>   
                                                 <tr>
                                                     <td>
                                                    <h4><strong>Method of Transaction</strong></h4>
                                                     </td>
                                                     <td>
                                                      <h4><?php echo $pay_type; ?></h4>
                                                     </td>
                                                    </tr>     
                                                    </thead>
                                                </table>
                                                
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                    
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                                }
                                                                            }
                                                                        }
                                                                     ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!--tab-pane-->
                                                    <div class="tab-pane" id="tab_1_22">
                                                        <div class="portlet-body">
                                                            <table class="table table-striped table-bordered table-advance table-hover">
                                                                <thead>
                                                                    <tr>

                                                                        <th>
                                                                            <i class="fa fa-user"></i> Full Name </th>
                                                                        <th>
                                                                            <i class="fa fa-envelop"></i> Email  </th>
                                                                        <th class="hidden-xs">
                                                                            <i class="fa fa-certificate"></i> Status </th>
                                                                        <th>
                                                                            <i class="fa fa-money"></i> Expected Income </th>

                                                                        <th><i class="fa fa-mobile"></i> Mobile Number </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                    $ref = "SELECT * FROM referral WHERE ref_ID ='$profile_ID'";
                                                                    $refResult = mysqli_query($connection, $ref) or die(mysqli_error($connection));

                                                                    while ($refRow = mysqli_fetch_array($refResult))
                                                                    {
                                                                        $benID = $refRow['Ben_ID'];
                                                                        $status = $refRow['Status'];
                                                                        $interest = $refRow['Interest'];

                                                                        if($status==1)
                                                                              {
                                                                                  $status= '<span class="label label-success label-sm"> Paid </span>';
                                                                              }
                                                                              elseif($status == 0 && $interest == 0)
                                                                              {
                                                                                  $status= '<span class="label label-success label-sm"> Paid </span>';
                                                                              }else
                                                                              {
                                                                                  $status= '<span class="label label-danger label-sm"> Not Upgraded </span>';
                                                                              }

                                                                                 if($interest == 500)
                                                                              {
                                                                                  $interest= 'N500';
                                                                              }
                                                                              else
                                                                              {
                                                                                  $interest = 'Used';
                                                                              }

                                                                      $benTest = "SELECT * FROM user WHERE Salt ='$benID'";
                                                                      $benResult = mysqli_query($connection, $benTest) or die(mysqli_error($connection));

                                                                      while($benRow = mysqli_fetch_array($benResult))
                                                                      {
                                                                        $fn = $benRow['First_Name'];
                                                                        $ln = $benRow['Last_Name'];
                                                                        $e = $benRow['Email'];
                                                                        $m = $benRow['Phone_1'];
                                                                        $d = $benRow['Created'];
                                                                ?>
                                                                    <tr>
                                                                        <td>
                                                                            <?php echo $fn; ?>  <?php echo $ln; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $e; ?>
                                                                        </td>
                                                                        <td> <?php echo $interest; ?><?php echo $status ?></td>
                                                                        <td>
                                                                            N500
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $m; ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                        }
                                                                    }
                                                                    if($ref && mysqli_affected_rows($connection) == 0)
                                                              				{
                                                              				echo '<p class="alert alert-warning co">No Referrals</p>';
                                                              				}
                                                                ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!--tab-pane-->
                                                    <!--tab-pane-->
                                                    <div class="tab-pane" id="tab_1_33">
                                                        <div class="portlet-body">
                                                            <table class="table table-striped table-bordered table-advance table-hover">
                                                                <thead>
                                                                    <tr>

                                                                        <th>
                                                                            <i class="fa fa-user"></i> Payment Method </th>
                                                                        <th>
                                                                            <i class="fa fa-envelop"></i> Agent  </th>
                                                                        <th class="hidden-xs">
                                                                            <i class="fa fa-certificate"></i> Amount </th>

                                                                        <th><i class="fa fa-mobile"></i> Date </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                    $cds = "SELECT * FROM cds_history WHERE User_ID ='$profile_ID'";
                                                                    $cdsResult = mysqli_query($connection, $cds) or die(mysqli_error($connection));

                                                                    while ($cdsRow = mysqli_fetch_array($cdsResult))
                                                                    {
                                                                        $cdsID = $cdsRow['Agent_ID'];
                                                                        $p_type = $cdsRow['Pay_Method'];
                                                                        $amount = $cdsRow['Amount'];
                                                                        $date = $cdsRow['Created'];

                                                                        if($status==1)
                                                                        {
                                                                            $status= '<span class="label label-success label-sm"> Paid </span>';
                                                                        }
                                                                        else
                                                                        {
                                                                            $status= '<span class="label label-danger label-sm"> Not Paid </span>';
                                                                        }


                                                                ?>
                                                                    <tr>
                                                                        <td>
                                                                            <?php echo $p_type ?>
                                                                        </td>

                                                                        <td>
                                                                        <?php
                                                                            $cds_hTest = "SELECT * FROM user WHERE User_ID ='$cdsID'";
                                                                      $cds_hResult = mysqli_query($connection, $cds_hTest) or die(mysqli_error($connection));

                                                                      while($cds_hRow = mysqli_fetch_array($cds_hResult))
                                                                      {
                                                                        $cfn = $cds_hRow['First_Name'];
                                                                        $cln = $cds_hRow['Last_Name'];
                                                                        $ce = $cds_hRow['Email'];
                                                                        $cm = $cds_hRow['Phone_1'];
                                                                        $cd = $cds_hRow['Created'];
                                                                         ?>
                                                                            <?php echo $cfn; ?>  <?php echo $cln. '('.$cm.')'; ?>
                                                                        <?php
                                                                        }
                                                                         ?>
                                                                        </td>
                                                                        <td> <?php echo $amount; ?></td>
                                                                        <td>
                                                                            <?php echo $date; ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php

                                                                    }
                                                                  //   if($cds && mysqli_affected_rows($connection) == 0)
                                                              				// {
                                                              				// echo '<p class="alert alert-warning co">No CDS History</p>';
                                                              				// }
                                                                ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab_1_44">
                                                        <div class="portlet-body">
                                                            <table class="table table-striped table-bordered table-advance table-hover">
                                                                <thead>
                                                                    <tr>

                                                                        <th>
                                                                            <i class="fa fa-user"></i> Transaction Type </th>
                                                                        <th>
                                                                            <i class="fa fa-envelop"></i> Sender</th>
                                                                        <th class="hidden-xs">
                                                                            <i class="fa fa-certificate"></i> Benefactor</th>

                                                                        <th class="hidden-xs">
                                                                            <i class="fa fa-certificate"></i> Amount</th>

                                                                        <th><i class="fa fa-mobile"></i> Date </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                    $ewallet = "SELECT * FROM e_wallet_history WHERE Sender_ID='$profile_ID' OR Receiver_ID='$profile_ID' ";
                                                                    $ewalletResult = mysqli_query($connection, $ewallet) or die(mysqli_error($connection));

                                                                    while ($ewalletRow = mysqli_fetch_array($ewalletResult))
                                                                    {
                                                                        $senderID = $ewalletRow['Sender_ID'];
                                                                        $receiverID = $ewalletRow['Receiver_ID'];
                                                                        $p_type = $ewalletRow['Transaction_Type'];
                                                                        $amount = $ewalletRow['Amount'];
                                                                        $date = $ewalletRow['Created'];



                                                                ?>
                                                                    <tr>
                                                                        <td>
                                                                            <?php echo $p_type ?>
                                                                        </td>

                                                                        <td>
                                                                        <?php
                                                                            $ewallet_hTest = "SELECT * FROM user WHERE User_ID ='$senderID'";
                                                                      $ewallet_hResult = mysqli_query($connection, $ewallet_hTest) or die(mysqli_error($connection));

                                                                      while($ewallet_hRow = mysqli_fetch_array($ewallet_hResult))
                                                                      {
                                                                        $sfn = $ewallet_hRow['First_Name'];
                                                                        $sln = $ewallet_hRow['Last_Name'];

                                                                         ?>
                                                                            <?php echo $sfn; ?>  <?php echo $sln; ?>
                                                                        <?php
                                                                        }
                                                                         ?>
                                                                        </td>
                                                                        <td>
                                                                         <?php
                                                                            $ewallet_rTest = "SELECT * FROM user WHERE User_ID ='$receiverID'";
                                                                      $ewallet_rResult = mysqli_query($connection, $ewallet_rTest) or die(mysqli_error($connection));

                                                                      while($ewallet_rRow = mysqli_fetch_array($ewallet_rResult))
                                                                      {
                                                                        $cfn = $ewallet_rRow['First_Name'];
                                                                        $cln = $ewallet_rRow['Last_Name'];

                                                                         ?>
                                                                            <?php echo $cfn; ?>  <?php echo $cln; ?>
                                                                        <?php
                                                                        }
                                                                         ?>
                                                                        </td>
                                                                        <td> <?php echo $amount; ?></td>
                                                                        <td>
                                                                            <?php echo $date; ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php

                                                                    }
                                                                  //   if($cds && mysqli_affected_rows($connection) == 0)
                                                              				// {
                                                              				// echo '<p class="alert alert-warning co">No CDS History</p>';
                                                              				// }
                                                                ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!--tab-pane-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--tab_1_2-->
                                <div class="tab-pane <?php echo $switchtab_a; ?>"  id="tab_1_3">
                                    <div class="row profile-account">
                                        <div class="col-md-3">
                                            <ul class="ver-inline-menu tabbable margin-bottom-10">
                                                <li class="<?php echo $switchtab_off; ?><?php echo $switchtab_p; ?>">
                                                    <a data-toggle="tab" href="#tab_1-1">
                                                        <i class="fa fa-cog"></i> Personal info </a>
                                                    <span class="after"> </span>
                                                </li>
                                                <li>
                                                    <a data-toggle="tab" href="#tab_2-2">
                                                        <i class="fa fa-picture-o"></i> Change Avatar </a>
                                                </li>
                                                <li>
                                                    <a data-toggle="tab" href="#tab_3-3">
                                                        <i class="fa fa-lock"></i> Change Password </a>
                                                </li>
                                                <li class="<?php echo $switchtab_on; ?>">
                                                    <a data-toggle="tab" href="#tab_4-4">
                                                        <i class="fa fa-eye"></i>Bank Details</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="tab-content">
                                                <div id="tab_1-1" class="tab-pane <?php echo $switchtab_off; ?><?php echo $switchtab_p; ?>">
                                                    <form role="form" method="post" action="">
                                                        <div class="form-group">
                                                            <label class="control-label">First Name</label>
                                                            <input type="text" placeholder="" value="<?php echo $fname; ?>" class="form-control" name="firstName"/ readonly>
                                                            <input type="hidden" name="bUpdate" value="<?php echo $profile_ID?>" class="form-control">
                                                       </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Last Name</label>
                                                            <input type="text" placeholder="" value="<?php echo $lname; ?>" class="form-control" name="lastName"/ readonly> </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Mobile Number</label>
                                                            <input type="text" placeholder=""  value="<?php echo $tel;?>" class="form-control" name="tel"/> </div>

                                                            <div class="form-group">
                                                                <label class="control-label">Mobile Number 2</label>
                                                                <input type="text" placeholder=""  value="<?php echo $tel2;?>" class="form-control" name="tel2"/> </div>

                                                        <div class="form-group">
                                                            <label class="control-label">Email</label>
                                                            <input type="text" placeholder="" value="<?php echo $email; ?>" class="form-control" name="email"/> </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Address</label>
                                                            <input type="text" placeholder="" value="<?php echo $add?>" class="form-control" name="address"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">City</label>
                                                            <input type="text" placeholder="" value="<?php echo $city?>" class="form-control" name="city"/>
                                                         </div>
                                                         <!--<div class="form-group">
                                                            <label class="control-label">Country</label>
                                                            <input type="text" placeholder="" class="form-control" name="country"/>
                                                        </div> -->
                                                        <div class="form-group">
                                                            <label class="control-label">Twitter Account</label>
                                                            <input type="text" placeholder="" value="<?php echo $twitter; ?>" class="form-control" name="twitterurl"/> </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Facebook URL</label>
                                                            <input type="text" placeholder="" value="<?php echo $fbook; ?>" class="form-control" name="facebookurl" /> </div>
                                                        <strong>Next Of Kin Details</strong>
                                                        <hr>
                                                        <div class="form-group">
                                                            <label class="control-label">Full Name</label>
                                                            <input type="text" placeholder="" name="kin_Name" class="form-control" value="" required/> </div>
                                                            <div class="form-group">
                                                            <label class="control-label">Relationship</label>
                                                            <input type="text" placeholder="" name="kin_rel" class="form-control" value="" required/> </div>
                                                            <div class="form-group">
                                                            <label class="control-label">Phone Number</label>
                                                            <input type="text" placeholder="" name="kin_num" class="form-control" value="" required/> </div>
                                                        <div class="margiv-top-10">
                                                            <button type="submit" id="register-submit-btn" class="btn green uppercase" name="info">Update</button>
                                                            <a href="javascript:;" class="btn default"> Cancel </a>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div id="tab_2-2" class="tab-pane">
                                                    <form action="" role="form" method="post" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                    <img src="../images/assets/<?php echo $img; ?>" alt="" /> </div>
                                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                                <div>
                                                                    <span class="btn default btn-file">
                                                                        <span class="fileinput-new"> Select image </span>
                                                                        <span class="fileinput-exists"> Change </span>
                                                                        <input type="file" name="profileImg">
                                                                      <input type="hidden" name="bUpdate" value="<?php echo $profile_ID?>" class="form-control"> </span>
                                                                    <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix margin-top-10">
                                                                <span class="label label-danger"> NOTE! </span>
                                                                <span>    Inaccurate images will be blocked! </span>
                                                            </div>
                                                        </div>
                                                        <div class="margin-top-10">
                                                            <button type="submit" id="register-submit-btn" class="btn green uppercase" name="chngImg">Update</button>
                                                            <a href="javascript:;" class="btn default"> Cancel </a>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div id="tab_3-3" class="tab-pane">
                                                    <form action="" role="form" method="post">
                                                        <div class="form-group">
                                                            <label class="control-label">Current Password</label>
                                                            <input type="password" class="form-control" name="current" />
                                                            <input type="hidden" name="bUpdate" value="<?php echo $profile_ID?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">New Password</label>
                                                            <input type="password" class="form-control" name="newPass"/> </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Re-type New Password</label>
                                                            <input type="password" class="form-control" name="conPass"/> </div>
                                                            <?php if(isset($error['upError'])){echo $error['upError'];} ?>
                                                        <div class="margin-top-10">
                                                            <button type="submit" id="register-submit-btn" class="btn green uppercase" name="chngPass">Update</button>
                                                            <a href="javascript:;" class="btn default"> Cancel </a>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div id="tab_4-4" class="tab-pane <?php echo $switchtab_on; ?>">
                                                    <form role="form" action="" method="post">
                                                        <div class="form-group">
                                                            <label class="control-label">Account Name</label>
                                                            <input type="text" placeholder="" name="AccName" class="form-control" value="<?php echo $acc_Name; ?> "/>
                                                            <input type="hidden" name="bUpdate" value="<?php echo $profile_ID?>" class="form-control"><!--update key--></div>
                                                        <div class="form-group">
                                                            <label class="control-label">Bank</label>
                                                        <select class="bs-select form-control" name="BnkName">

                                                            <?php
                    $Showbank = "SELECT * FROM user WHERE User_ID='$profile_ID' and Bank_Name=''";
                    $ShowbankResult= mysqli_query($connection, $Showbank) or die(mysqli_error($connection));
                    if(mysqli_affected_rows($connection) == 0)
                    {
                        ?>
                        <option value="<?php echo $bankName; ?>"><?php echo $bankName; ?></option>
                        <?php
                      } else {
                    ?><option value="">Please Select</option><?php

                    }
                                                              ?>


                                                        <option value="First Bank">First Bank</option>
                                                        <option value="UBA">UBA</option>
                                                        <option value="Enterprise Bank">Enterprise Bank</option>
                                                        <option value="Access Bank">Access Bank</option>
                                                        <option value="Zenith Bank">Zenith Bank</option>
                                                        <option value="Diamond Bank">Diamond Bank</option>
                                                        <option value="EcoBank">EcoBank</option>
                                                        <option value="skye Bank">skye Bank</option>
                                                        <option value="FCMB">FCMB</option>
                                                        <option value="Fidelity">Fidelity</option>
                                                        <option value="Guaranty Trust Bank">Guaranty Trust Bank</option>
                                                        <option value="Keystone Bank">Keystone Bank</option>
                                                        <option value="Unity Bank">Unity Bank</option>
                                                        <option value="Wema Bank">Wema Bank</option>
                                                        <option value="SunTrust Bank">SunTrust Bank</option>
                                                        <option value="Sterling Bank">Sterling Bank</option>
                                                        <option value="Standard Chartered Bank">Standard Chartered Bank</option>
                                                        <option value="StanbicIBTC">StanbicIBTC</option>
                                                        <option value="MainStreet Bank">MainStreet Bank</option>
                                                        <option value="Jaiz Bank">Jaiz Bank</option>
                                                        <option value="Heritage Bank">Heritage Bank</option>
                                                    </select>



                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Account Number</label>
                                                            <input type="text" placeholder="" name="AccNum" class="form-control" value="<?php echo $acc_Num; ?>"/> </div>

                                                            <strong>Perfect Money Account Details</strong>
                                                            <hr>
                                                            <div class="form-group">
                                                            <label class="control-label">Perfect Money Account Name</label>
                                                            <input type="text" placeholder="" name="perf_AccName" class="form-control" value=""/> </div>
                                                            <div class="form-group">
                                                            <label class="control-label">Perfect Money Account Number</label>
                                                            <input type="text" placeholder="" name="perf_AccNum" class="form-control" value=""/> </div>
                                                            <strong>Bitcoin Account Details</strong>
                                                            <hr>
                                                            
                                                            <div class="form-group">
                                                            <label class="control-label">Bitcoin Address</label>
                                                            <input type="text" placeholder="" name="bit_AccNum" class="form-control" value=""/> </div>
                                                            <strong>PayZa Account Details</strong>
                                                            <hr>
                                                            <div class="form-group">
                                                            <label class="control-label">PayZa Account Name</label>
                                                            <input type="text" placeholder="" name="payza_AccName" class="form-control" value=""/> </div>
                                                            <div class="form-group">
                                                            <label class="control-label">PayZa Account Number</label>
                                                            <input type="text" placeholder="" name="payza_AccNum" class="form-control" value=""/> </div>
                                                        <div class="margiv-top-10">
                                                          <button type="submit" id="register-submit-btn" class="btn green uppercase" name="bnkDetails">Update</button>
                                                            <a href="javascript:;" class="btn default"> Cancel </a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-md-9-->
                                    </div>
                                </div>
                                <!--end tab-pane-->
                                <div class="tab-pane" id="tab_1_6">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <ul class="ver-inline-menu tabbable margin-bottom-10">
                                                <li class="active">
                                                    <a data-toggle="tab" href="#tab_1">
                                                    <i class="fa fa-briefcase"></i> Frequently Ask Questions </a>
                                                    <span class="after"> </span>
                                                </li>
                                                <li>
                                                    <a data-toggle="tab" href="#tab_3">
                                                    <i class="fa fa-leaf"></i>Compensation Plan </a>
                                                </li>
                                                <li>
                                                    <a data-toggle="tab" href="#tab_2">
                                                    <i class="fa fa-tint"></i> Payment Rules </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="tab-content">
                                                <div id="tab_1" class="tab-pane active">
                                                    <div id="accordion1" class="panel-group">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_1"> 1. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                                                                </h4>
                                                            </div>
                                                            <div id="accordion1_1" class="panel-collapse collapse in">
                                                                <div class="panel-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                                    laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes
                                                                    anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't
                                                                    heard of them accusamus labore sustainable VHS. </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_2"> 2. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                                                                </h4>
                                                            </div>
                                                            <div id="accordion1_2" class="panel-collapse collapse">
                                                                <div class="panel-body"> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit,
                                                                    enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                                    moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                                                    ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable
                                                                    VHS. </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-success">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_3"> 3. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor ? </a>
                                                                </h4>
                                                            </div>
                                                            <div id="accordion1_3" class="panel-collapse collapse">
                                                                <div class="panel-body"> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit,
                                                                    enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                                    moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                                                    ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable
                                                                    VHS. </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-warning">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_4"> 4. Wolf moon officia aute, non cupidatat skateboard dolor brunch ? </a>
                                                                </h4>
                                                            </div>
                                                            <div id="accordion1_4" class="panel-collapse collapse">
                                                                <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                                    nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                                    craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-danger">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_5"> 5. Leggings occaecat craft beer farm-to-table, raw denim aesthetic ? </a>
                                                                </h4>
                                                            </div>
                                                            <div id="accordion1_5" class="panel-collapse collapse">
                                                                <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                                    nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                                    craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                                    wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_6"> 6. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth ? </a>
                                                                </h4>
                                                            </div>
                                                            <div id="accordion1_6" class="panel-collapse collapse">
                                                                <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                                    nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                                    craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                                    wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_7"> 7. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft ? </a>
                                                                </h4>
                                                            </div>
                                                            <div id="accordion1_7" class="panel-collapse collapse">
                                                                <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                                    nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                                    craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                                    wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="tab_2" class="tab-pane">
                                                    <div id="accordion2" class="panel-group">
                                                        <div class="panel panel-warning">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_1"> 1. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                                                                </h4>
                                                            </div>
                                                            <div id="accordion2_1" class="panel-collapse collapse in">
                                                                <div class="panel-body">
                                                                    <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                                        laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore
                                                                        wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably
                                                                        haven't heard of them accusamus labore sustainable VHS. </p>
                                                                    <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                                        laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore
                                                                        wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably
                                                                        haven't heard of them accusamus labore sustainable VHS. </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-danger">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_2"> 2. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                                                                </h4>
                                                            </div>
                                                            <div id="accordion2_2" class="panel-collapse collapse">
                                                                <div class="panel-body"> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit,
                                                                    enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                                    moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                                                    ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable
                                                                    VHS. </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-success">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_3"> 3. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor ? </a>
                                                                </h4>
                                                            </div>
                                                            <div id="accordion2_3" class="panel-collapse collapse">
                                                                <div class="panel-body"> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit,
                                                                    enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                                    moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                                                    ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable
                                                                    VHS. </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_4"> 4. Wolf moon officia aute, non cupidatat skateboard dolor brunch ? </a>
                                                                </h4>
                                                            </div>
                                                            <div id="accordion2_4" class="panel-collapse collapse">
                                                                <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                                    nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                                    craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_5"> 5. Leggings occaecat craft beer farm-to-table, raw denim aesthetic ? </a>
                                                                </h4>
                                                            </div>
                                                            <div id="accordion2_5" class="panel-collapse collapse">
                                                                <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                                    nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                                    craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                                    wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_6"> 6. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth ? </a>
                                                                </h4>
                                                            </div>
                                                            <div id="accordion2_6" class="panel-collapse collapse">
                                                                <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                                    nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                                    craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                                    wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_7"> 7. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft ? </a>
                                                                </h4>
                                                            </div>
                                                            <div id="accordion2_7" class="panel-collapse collapse">
                                                                <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                                    nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                                    craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                                    wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="tab_3" class="tab-pane">
                                                    <div id="accordion3" class="panel-group">
                                                        <div class="panel panel-danger">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_1"> 1. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                                                                </h4>
                                                            </div>
                                                            <div id="accordion3_1" class="panel-collapse collapse in">
                                                                <div class="panel-body">
                                                                    <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                                        laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. </p>
                                                                    <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                                        laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. </p>
                                                                    <p> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica,
                                                                        craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt
                                                                        you probably haven't heard of them accusamus labore sustainable VHS. </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-success">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_2"> 2. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                                                                </h4>
                                                            </div>
                                                            <div id="accordion3_2" class="panel-collapse collapse">
                                                                <div class="panel-body"> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit,
                                                                    enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                                    moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                                                    ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable
                                                                    VHS. </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_3"> 3. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor ? </a>
                                                                </h4>
                                                            </div>
                                                            <div id="accordion3_3" class="panel-collapse collapse">
                                                                <div class="panel-body"> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit,
                                                                    enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                                    moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                                                    ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable
                                                                    VHS. </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_4"> 4. Wolf moon officia aute, non cupidatat skateboard dolor brunch ? </a>
                                                                </h4>
                                                            </div>
                                                            <div id="accordion3_4" class="panel-collapse collapse">
                                                                <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                                    nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                                    craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_5"> 5. Leggings occaecat craft beer farm-to-table, raw denim aesthetic ? </a>
                                                                </h4>
                                                            </div>
                                                            <div id="accordion3_5" class="panel-collapse collapse">
                                                                <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                                    nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                                    craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                                    wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_6"> 6. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth ? </a>
                                                                </h4>
                                                            </div>
                                                            <div id="accordion3_6" class="panel-collapse collapse">
                                                                <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                                    nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                                    craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                                    wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_7"> 7. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft ? </a>
                                                                </h4>
                                                            </div>
                                                            <div id="accordion3_7" class="panel-collapse collapse">
                                                                <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                                    nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                                    craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                                    wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end tab-pane-->
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->

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
        <script src="../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
        <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
        <script src="../assets/global/plugins/gmaps/gmaps.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="../assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <script src="../assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>
<?php } ?>
