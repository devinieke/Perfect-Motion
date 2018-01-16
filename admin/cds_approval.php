<?php
    session_start();
    ob_start();
 ?>


<?php require_once '../includes/dbconnect.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<?php require_once '../includes/superadmin.php'; ?>

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
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>CDS Approval</title>
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

    <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
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
                                    <span class="username username-hide-on-mobile"> Admin </span>
                                    <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                                    <img alt="" class="img-circle" src="../assets/layouts/layout4/img/admin.png" /> </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="../user/logout.php">
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
                    <?php include '../includes/adminSidebar.php'; ?>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
                      <?php
             $total = "SELECT Amount FROM e_wallet WHERE User_ID='$profile_ID'";
              $total_result = mysqli_query($connection, $total) or die(mysqli_error($connection));

              while($total_row = mysqli_fetch_array($total_result))
              {
                  $main = $total_row['Amount'];
              }
           ?>
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>CDS Approval
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
                            <a href="index.html">eCurrency Approval</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Member</span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
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
                                                    <th width="200"> Channel</th>
                                                    <th width="200"> Account Holder</th>
                                                    <th width="10%"> Date </th>
                                                    <th width="10%"> Mobile</th>
                                                    <th width="10%"> Amount Paid</th>
                                                </tr>
                                                <tr role="row" class="filter">
                                                <?php
                                                    $pendingApproval = "SELECT * FROM cds WHERE (Pay_Method='perfect_money' OR Pay_Method='Payza' OR Pay_Method='Bitcoin') AND paid=0 AND Completed=0";
                                                    $pendingApprovalResult = mysqli_query($connection, $pendingApproval) or die(mysqli_error($connection));

                                                    while ($pendingAppRow = mysqli_fetch_array($pendingApprovalResult))
                                                    {
                                                        $pendingUser = $pendingAppRow['User_ID'];
                                                        $pendingAmount = $pendingAppRow['Amount'];
                                                        $pendingStatus = $pendingAppRow['paid'];
                                                        $img = $pendingAppRow['Evidence'];
                                                        $depositor = $pendingAppRow['Depositor_name'];
                                                        $created = $pendingAppRow['Created'];
                                                        $method = $pendingAppRow['Pay_Method'];

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
                                                    <?php echo $method; ?>
                                                    </td>
                                                    <td><?php echo $depositor; ?></td>
                                                    <td>
                                                        <?php echo $created; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $getPhone; ?>
                                                    </td>
                                                    <td>
                                                        <div class="margin-bottom-5">
                                                           <?php echo $pendingAmount; ?>
                                                         </td>
                                                    <td>
                                                        <?php
                                                            if($pendingStatus == 0)
                                                            {
                                                        ?>
                                                        <div class="margin-bottom-5">
                                                        <form action="" method="post">
                                                            <input type="hidden" name="userCds" value="<?php echo $pendingUser?>" class="form-control">
                                                            <button class="btn btn-sm green filter-submit margin-bottom" type="submit" name="agentUpdate">
                                                                <i class="fa fa-check"></i> Confirm</button>
                                                        </form>
                                                        </div>
                                                        <?php
                                                            } 
                                                         ?>
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
                                                    <th width="200"> Account Holder </th>
                                                    <th width="10%"> Email </th>
                                                    <th width="10%"> Mobile</th>
                                                    <th width="8%"> Amount Paid</th>
                                                    <th width="5%"> Status</th>
                                                    <th width="22%"> Date</th>
                                                </tr>
                                                <tr role="row" class="filter">
                                                <?php
                                                    $completed_Approval = "SELECT * FROM cds_history WHERE Pay_Method='perfect_money' OR Pay_Method='Payza' OR Pay_Method='Bitcoin' AND paid=1 AND Completed=1";
                                                    $completed_ApprovalResult = mysqli_query($connection, $completed_Approval) or die(mysqli_error($connection));

                                                    while ($completed_AppRow = mysqli_fetch_array($completed_ApprovalResult))
                                                    {
                                                        $completed_User = $completed_AppRow['User_ID'];
                                                        $completed_Amount = $completed_AppRow['Amount'];
                                                        $completed_Status = $completed_AppRow['paid'];
                                                        $completed_depositor = $completed_AppRow['Depositor_name'];
                                                        $created = $completed_AppRow['Created'];

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
                                                    <td><?php echo $completed_depositor; ?></td>
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
                                                    <td>
                                                    <?php echo $created; ?>
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
            <!-- BEGIN QUICK SIDEBAR -->
            
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <?php include '../includes/footer.php'; ?>
        <!-- END FOOTER -->
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