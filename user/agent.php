<?php 
ob_start();
session_start(); 
?>
<?php require_once '../includes/dbconnect.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<?php require_once '../includes/confirm.php'; ?>

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
 ?>

<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Agent Activities</title>
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
                                      <a href="agent.php">
                                          <i class="icon-user"></i> My Profile </a>
                                  </li>
                                  <li>
                                      <a href="app_calendar.html">
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
                        <div class="page-title">
                            <h1>Agent
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
                            <a href="index.html">Dashboard</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Agent Activities</span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <?php


                          $getewallet = "SELECT * FROM e_wallet WHERE User_ID='$profile_ID'";
                                  $getewalletResult = mysqli_query($connection, $getewallet) or die(myqli_error($connection));

                                  while($getewalletRow = mysqli_fetch_array($getewalletResult))
                                  {
                                      $ewalletAmount = $getewalletRow['Amount'];
                                      $ewalletBalance = $getewalletRow['Book_Balance'];
                                  }

                     ?>
                    
                    <div class="row">
                        <div class="col-md-6">
                        <div class="mt-element-list">

                                            <div class="row">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-red-haze">
                                            <span data-counter="counterup" data-value="<?php echo $ewalletAmount ?>">0</span>
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
                                        <div class="status-title"> TRANSFER FUNDS <a href="funds_transfer.php">CLICK HERE</a> </div>
                                        <div class="status-number"><a href=""><i class="icon-plus"></i></a></div>
                                    </div>
                                </div>
                            </div>
                                            </div>
                        </div></div>
                        <div class="col-md-6">
                        <div class="mt-element-list">
                                            <div class="row">
                    <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-green-sharp">
                                            <span data-counter="counterup" data-value="<?php echo $ewalletBalance ?>">0</span>
                                            <small class="font-green-sharp">₦</small>
                                        </h3>
                                        <small>BOOK BALANCE</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-wallet"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 76%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">76% progress</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-title"> </div>
                                        <div class="status-number"> </div>
                                    </div>
                                </div>
                            </div>
                                            </div>
                        </div>
                        </div>
                    </div>
                    
                    
                    
                    <div class="row">
                    
   
                                <div class="portlet-body">
                                    <div class="tabbable-custom nav-justified">
                                        <ul class="nav nav-tabs nav-justified">
                                            <li class="active">
                                                <a href="#tab_1_1_1" data-toggle="tab"> Pending Approvals </a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_1_2" data-toggle="tab"> Approval History </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1_1_1">
                                                <div class="row">
                        <div class="col-md-12">
                            <!-- Begin: Demo Datatable 1 -->
                            <div class="portlet light portlet-fit portlet-datatable bordered">
                                <div class="portlet-body">
                                    <div class="table-container">
  
                                        <table class="table table-striped table-bordered table-hover table-checkable">
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <th width="2%">
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                            <span></span>
                                                        </label>
                                                    </th>
                                                    <th width="5%"> User Level </th>
                                                    <th width="200"> Full Name </th>
                                                    <th width="10%"> Email </th>
                                                    <th width="10%"> Mobile</th>
                                                    <th width="10%"> Amount Paid</th>
                                                    <th width="10%"> Status</th>
                                                    <th width="10%"> </th>
                                                    <th width="10%"> </th>
                                                </tr>
                                                <tr role="row" class="filter">
                                                <?php
                                                    $pendingApproval = "SELECT * FROM cds WHERE Agent_ID='$profile_ID' AND paid=0 AND Completed=0";
                                                    $pendingApprovalResult = mysqli_query($connection, $pendingApproval) or die(mysqli_error($connection));

                                                    while ($pendingAppRow = mysqli_fetch_array($pendingApprovalResult))
                                                    {
                                                        $pendingUser = $pendingAppRow['User_ID'];
                                                        $pendingAmount = $pendingAppRow['Amount'];
                                                        $pendingStatus = $pendingAppRow['paid'];
                                                        $img = $pendingAppRow['Evidence'];
                                                        $bank = $pendingAppRow['Bank_Name'];
                                                        $payment_type = $pendingAppRow['Payment_type'];
                                                        $depositor_name = $pendingAppRow['Depositor_name'];
                                                        $rec = $pendingAppRow['Rec_Acc'];
                                                        $teller = $pendingAppRow['Teller_number'];

                                                        $getUser = "SELECT * FROM user WHERE User_ID='$pendingUser'";
                                                        $getUserResult = mysqli_query($connection, $getUser) or die(mysqli_error($connection));

                                                        while($getUserRow = mysqli_fetch_array($getUserResult))
                                                        {
                                                            $getFirstName = $getUserRow['First_Name'];
                                                            $getLastName = $getUserRow['Last_Name'];
                                                            $getEmail = $getUserRow['Email'];
                                                            $getPhone = $getUserRow['Phone_1'];
                                                            $getLevel = $getUserRow['Level'];
                                                            $getAux = $getUserRow['Aux_Level'];
                                                ?>
                                                <td> </td>
                                                    <td>
                                                        <?php echo $getLevel; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $getFirstName." ".$getLastName; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $getEmail; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $getPhone; ?>
                                                    </td>
                                                    <td>
                                                        <div class="margin-bottom-5">N
                                                           <?php echo $pendingAmount; ?>
                                                         </td>
                                                    
                                                    <td>
                                                        <?php
                                                            if($pendingStatus == 0)
                                                            {
                                                                echo "not paid";
                                                            }
                                                            else
                                                            {
                                                                echo "PAID";
                                                            }
                                                        ?> 
                                                    </td>
                                                    <td>
                                                        <?php
                                                            if($pendingStatus == 0)
                                                            {
                                                        ?>
                                                        <div class="margin-bottom-5">
                                                        <form action="" method="post">
                                                            <input type="hidden" name="userCds" value="<?php echo $pendingUser?>" class="form-control">
                                                            <input type="hidden" name="agentCds" value="<?php echo $profile_ID?>" class="form-control">
                                                            <input type="hidden" name="userLevel" value="<?php echo $getAux?>" class="form-control">
                                                            <input type="hidden" name="amountagent" value="<?php echo $pendingAmount?>" class="form-control">
                                                            <button class="btn btn-sm green btn-outline filter-submit margin-bottom" type="submit" name="agentUpdate">
                                                                <i class="fa fa-check"></i> Confirm</button>
                                                        </form>
                                                        </div>
                                                        <?php
                                                            } 
                                                         ?>
                                                    </td>
                                                    <td>
                                                        <a class="btn purple btn-outline sbold" data-toggle="modal" href="#<?php echo $pendingUser; ?>"> More Info </a>
                                                        
                                                        
                                                        <div class="modal fade" id="<?php echo $pendingUser; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title"><?php echo $getFirstName." ".$getLastName; ?></h4>
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
                                                    <h4><strong>Payment Type</strong></h4>
                                                     </td>
                                                     <td>
                                                      <h4><?php echo $payment_type ?></h4>
                                                     </td>
                                                    </tr> 
                                                 <tr>
                                                     <td>
                                                    <h4><strong>Bank</strong></h4>
                                                     </td>
                                                     <td>
                                                     <h4><?php echo $bank; ?></h4>
                                                     </td>
                                                    </tr> 
                                                 <tr>
                                                     <td>
                                                    <h4><strong>Depositor's Name</strong></h4>
                                                     </td>
                                                     <td>
                                                     <h4><?php echo $depositor_name; ?></h4>
                                                     </td>
                                                    </tr> 
                                                 <tr>
                                                     <td>
                                                    <h4><strong>Agent Account No.</strong></h4>
                                                     </td>
                                                     <td>
                                                     <h4><?php echo $rec; ?></h4>
                                                     </td>
                                                    </tr> 
                                                 <tr>
                                                     <td>
                                                    <h4><strong>Amount</strong></h4>
                                                     </td>
                                                     <td>
                                                     <h4><?php echo $pendingAmount ?></h4>
                                                     </td>
                                                    </tr> 
                                                 <tr>
                                                     <td>
                                                    <h4><strong>Teller Number </strong></h4>
                                                     </td>
                                                     <td>
                                                     <h4><?php echo $teller; ?></h4>
                                                     </td>
                                                    </tr> 
                                                 <tr>
                                                     <td>
                                                    <h4><strong>Member Level</strong></h4>
                                                     </td>
                                                     <td>
                                                     <h4><?php echo $getLevel; ?></h4>
                                                     </td>
                                                    </tr>
                                                 <tr>
                                                     <td>
                                                    <h4><strong>Member Mobile</strong></h4>
                                                     </td>
                                                     <td>
                                                     <h4><?php echo $getPhone; ?></h4>
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
                                                    if($pendingApproval && mysqli_affected_rows($connection) == 0)
                                                        {
                                                        echo '<p class="alert alert-warning co">No Records</p>';
                                                        }
                                                 ?>
                                                
                                            </thead>
                                            <tbody> </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- End: Demo Datatable 1 -->
                            <!-- Begin: Demo Datatable 2 -->
                            
                        </div>
                    </div>
                                            </div>
                                            <div class="tab-pane" id="tab_1_1_2">
                                               <div class="row">
                        <div class="col-md-12">
                            <!-- Begin: Demo Datatable 1 -->
                            <div class="portlet light portlet-fit portlet-datatable bordered">
                                <div class="portlet-body">
                                    <div class="table-container">
  
                                        <table class="table table-striped table-bordered table-hover table-checkable">
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <th width="2%">
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                            <span></span>
                                                        </label>
                                                    </th>
                                                    <th width="5%"> User Level </th>
                                                    <th width="200"> Full Name </th>
                                                    <th width="10%"> Email </th>
                                                    <th width="10%"> Mobile</th>
                                                    <th width="10%"> Amount Paid</th>
                                                    <th width="10%"> Status</th>
                                                </tr>
                                                <tr role="row" class="filter">
                                                <?php
                                                    $completed_Approval = "SELECT * FROM cds_history WHERE Agent_ID='$profile_ID' AND paid=1 AND Completed=1";
                                                    $completed_ApprovalResult = mysqli_query($connection, $completed_Approval) or die(mysqli_error($connection));

                                                    while ($completed_AppRow = mysqli_fetch_array($completed_ApprovalResult))
                                                    {
                                                        $completed_User = $completed_AppRow['User_ID'];
                                                        $completed_Amount = $completed_AppRow['Amount'];
                                                        $completed_Status = $completed_AppRow['paid'];

                                                        $get_complete_User = "SELECT * FROM user WHERE User_ID='$completed_User'";
                                                        $get_complete_UserResult = mysqli_query($connection, $get_complete_User) or die(mysqli_error($connection));

                                                        while($get_complete_UserRow = mysqli_fetch_array($get_complete_UserResult))
                                                        {
                                                            $get_complete_FirstName = $get_complete_UserRow['First_Name'];
                                                            $get_complete_LastName = $get_complete_UserRow['Last_Name'];
                                                            $get_complete_Email = $get_complete_UserRow['Email'];
                                                            $get_complete_Phone = $get_complete_UserRow['Phone_1'];
                                                            $get_complete_Level = $get_complete_UserRow['Level'];
                                                ?>
                                                    <td> </td>
                                                    <td>
                                                        <?php echo $get_complete_Level; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $get_complete_FirstName." ".$get_complete_LastName; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $get_complete_Email ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $get_complete_Phone ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $completed_Amount ?>
                                                    </td>
                                                    
                                                    <td>
                                                        <?php
                                                            if($completed_Status == 1)
                                                            {
                                                                echo "PAID";
                                                            }
                                                        ?> 
                                                    </td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    }
                                                    if($completed_Approval && mysqli_affected_rows($connection) == 0)
                                                        {
                                                        echo '<p class="alert alert-warning co">No Records</p>';
                                                        } 
                                                 ?>
                                                
                                            </thead>
                                            <tbody> </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- End: Demo Datatable 1 -->
                            <!-- Begin: Demo Datatable 2 -->
                            
                        </div>
                    </div>
                                    
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
        <!-- BEGIN FOOTER -->
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
        <script src="../assets/global/scripts/jquery.counterup.min.js" type="text/javascript"></script>
        <script src="../assets/global/scripts/jquery.waypoints.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="../assets/pages/scripts/table-datatables-ajax.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="../assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <script src="../assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->

        <!-- copy input -->
        <script type="text/javascript">
            document.getElementById("copyButton").addEventListener("click", function() {
                copyToClipboard(document.getElementById("copyTarget"));
            });

            function copyToClipboard(elem) {
                  // create hidden text element, if it doesn't already exist
                var targetId = "_hiddenCopyText_";
                var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
                var origSelectionStart, origSelectionEnd;
                if (isInput) {
                    // can just use the original source element for the selection and copy
                    target = elem;
                    origSelectionStart = elem.selectionStart;
                    origSelectionEnd = elem.selectionEnd;
                } else {
                    // must use a temporary form element for the selection and copy
                    target = document.getElementById(targetId);
                    if (!target) {
                        var target = document.createElement("textarea");
                        target.style.position = "absolute";
                        target.style.left = "-9999px";
                        target.style.top = "0";
                        target.id = targetId;
                        document.body.appendChild(target);
                    }
                    target.textContent = elem.textContent;
                }
                // select the content
                var currentFocus = document.activeElement;
                target.focus();
                target.setSelectionRange(0, target.value.length);
                
                // copy the selection
                var succeed;
                try {
                      succeed = document.execCommand("copy");
                } catch(e) {
                    succeed = false;
                }
                // restore original focus
                if (currentFocus && typeof currentFocus.focus === "function") {
                    currentFocus.focus();
                }
                
                if (isInput) {
                    // restore prior selection
                    elem.setSelectionRange(origSelectionStart, origSelectionEnd);
                } else {
                    // clear temporary content
                    target.textContent = "";
                }
                return succeed;
            }document.getElementById("copyButton").addEventListener("click", function() {
                copyToClipboard(document.getElementById("copyTarget"));
            });

            function copyToClipboard(elem) {
                  // create hidden text element, if it doesn't already exist
                var targetId = "_hiddenCopyText_";
                var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
                var origSelectionStart, origSelectionEnd;
                if (isInput) {
                    // can just use the original source element for the selection and copy
                    target = elem;
                    origSelectionStart = elem.selectionStart;
                    origSelectionEnd = elem.selectionEnd;
                } else {
                    // must use a temporary form element for the selection and copy
                    target = document.getElementById(targetId);
                    if (!target) {
                        var target = document.createElement("textarea");
                        target.style.position = "absolute";
                        target.style.left = "-9999px";
                        target.style.top = "0";
                        target.id = targetId;
                        document.body.appendChild(target);
                    }
                    target.textContent = elem.textContent;
                }
                // select the content
                var currentFocus = document.activeElement;
                target.focus();
                target.setSelectionRange(0, target.value.length);
                
                // copy the selection
                var succeed;
                try {
                      succeed = document.execCommand("copy");
                } catch(e) {
                    succeed = false;
                }
                // restore original focus
                if (currentFocus && typeof currentFocus.focus === "function") {
                    currentFocus.focus();
                }
                
                if (isInput) {
                    // restore prior selection
                    elem.setSelectionRange(origSelectionStart, origSelectionEnd);
                } else {
                    // clear temporary content
                    target.textContent = "";
                }
                return succeed;
            }
        </script>
        <!-- copy input -->
    </body>

</html>
<?php } ?>