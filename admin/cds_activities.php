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
        redirect_to("../user/login.php");
    }
    else
    {
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
        <title>Community Development Service</title>
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
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>CDS Payment
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
                            <span class="active">CDS Payment</span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                            <div class="col-md-6">             
                            <div class="portlet light portlet-fit portlet-datatable bordered">
                                <?php $now = date('Y-m-d', time()); ?>  
                                <div class="portlet-body">
                                    <div class="table-container">
                                        <table class="table table-striped table-bordered table-hover table-checkable">
                                            <thead>
                                                <span><strong>Today</strong></span>
                                                <tr role="row" class="heading">      
                                                    <th width="28%"> Full Name </th>
                                                    <th width="20%"> Email </th>
                                                    <th width="10%"> Mobile</th>
                                                    <th width="15%"> Level</th>
                                                    <th width="15%"> Amount</th>
                                                    <th width="15%"> Agent</th>

                                                </tr>
                                                <?php
                                                    $today = "SELECT * FROM cds_history WHERE str_to_date(Created, '%Y-%m-%d')='$now' LIMIT 10";
                                                    $todayResult = mysqli_query($connection, $today) or die(mysqli_error($connection));

                                                    while($todayRow = mysqli_fetch_array($todayResult))
                                                    {
                                                        $today_User = $todayRow['User_ID'];
                                                        $today_Amount = $todayRow['Amount'];
                                                        $today_Agent = $todayRow['Agent_ID'];

                                                        $todayUser = "SELECT * FROM user WHERE User_ID='$today_User'";
                                                        $todayUserResult = mysqli_query($connection, $todayUser) or die(mysqli_error($connection));

                                                        while($todayUserRow = mysqli_fetch_array($todayUserResult))
                                                        {
                                                            $t_First = $todayUserRow['First_Name'];
                                                            $t_Last = $todayUserRow['Last_Name'];
                                                            $t_email = $todayUserRow['Email'];
                                                            $t_mobile = $todayUserRow['Phone_1'];
                                                            $t_level = $todayUserRow['Level'];

                                                            $todayAgent = "SELECT * FROM user WHERE User_ID='$today_Agent'";
                                                            $todayAgentResult = mysqli_query($connection, $todayAgent) or die(mysqli_error($connection));

                                                            while($todayAgentRow = mysqli_fetch_array($todayAgentResult))
                                                            {
                                                                $t_agent_First = $todayAgentRow['First_Name'];
                                                                $t_agent_Last = $todayAgentRow['Last_Name'];
                                                ?>
                                                <tr role="row" class="filter">
                                                    <td>
                                                        <?php echo $t_First." ".$t_Last ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $t_email ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $t_mobile ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $t_level ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $today_Amount ?>                                                        
                                                    </td>
                                                    <td>
                                                        <?php echo $t_agent_First." ".$t_agent_Last ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                            }
                                                        }
                                                    } 
                                                 ?>
                                            </thead>
                                            <tbody> </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                                
                            <div class="portlet light portlet-fit portlet-datatable bordered">
                                <div class="portlet-body">
                                    <div class="table-container">
                                        <table class="table table-striped table-bordered table-hover table-checkable">
                                            <thead>
                                            <span><strong>Yesterday</strong></span>
                                                <tr role="row" class="heading">
                                                    <th width="25%"> Full Name </th>
                                                    <th width="15%"> Email </th>
                                                    <th width="10%"> Mobile</th>
                                                    <th width="15%"> Level</th>
                                                    <th width="15%"> Amount</th>
                                                    <th width="20%"> Agent</th>
                                                </tr>
                                                <?php
                                                    $today = "SELECT * FROM cds_history WHERE str_to_date(Created, '%Y-%m-%d') < '$now' LIMIT 10";
                                                    $todayResult = mysqli_query($connection, $today) or die(mysqli_error($connection));

                                                    while($todayRow = mysqli_fetch_array($todayResult))
                                                    {
                                                        $today_User = $todayRow['User_ID'];
                                                        $today_Amount = $todayRow['Amount'];
                                                        $today_Agent = $todayRow['Agent_ID'];
                                    

                                                        $todayUser = "SELECT * FROM user WHERE User_ID='$today_User'";
                                                        $todayUserResult = mysqli_query($connection, $todayUser) or die(mysqli_error($connection));

                                                        while($todayUserRow = mysqli_fetch_array($todayUserResult))
                                                        {
                                                            $t_First = $todayUserRow['First_Name'];
                                                            $t_Last = $todayUserRow['Last_Name'];
                                                            $t_email = $todayUserRow['Email'];
                                                            $t_mobile = $todayUserRow['Phone_1'];
                                                            $t_level = $todayUserRow['Level'];

                                                            $todayAgent = "SELECT * FROM user WHERE User_ID='$today_Agent'";
                                                            $todayAgentResult = mysqli_query($connection, $todayAgent) or die(mysqli_error($connection));

                                                            while($todayAgentRow = mysqli_fetch_array($todayAgentResult))
                                                            {
                                                                $t_agent_First = $todayAgentRow['First_Name'];
                                                                $t_agent_Last = $todayAgentRow['Last_Name'];
                                                ?>
                                                <tr role="row" class="filter">
                                                    <td>
                                                        <?php echo $t_First." ".$t_Last ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $t_email ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $t_mobile ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $t_level ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $today_Amount ?>                                                      
                                                    </td>
                                                    <td>
                                                        <?php echo $t_agent_First." ".$t_agent_Last ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                            }
                                                        }
                                                    } 
                                                 ?>
                                            </thead>
                                            <tbody> </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            </div>

                    </div>
                    <div class="row">
                    <div class="col-md-12">
                        
                        <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-green-sharp">
                                        <i class="icon-speech font-green-sharp"></i>
                                        <span class="caption-subject bold uppercase"> Top 50</span>
                                        <span class="caption-helper">Community Development Service</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
                                        <div class="table-container">
  
                                        <table class="table table-striped table-bordered table-hover table-checkable">
                                            <thead>
                                                <tr role="row" class="heading">
                                                    
                                                    <th width="25%"> Full Name </th>
                                                    <th width="10%"> Email </th>
                                                    <th width="10%"> Mobile</th>
                                                    <th width="10%"> Level</th>
                                                    <th width="10%"> Amount</th>
                                                    <th width="10%"> Agent</th>
                                                    <th width="25%"> Date</th>
                                                </tr>
                                                <?php
                                                    $top50 = "SELECT * FROM cds_history LIMIT 50";
                                                    $top50Result = mysqli_query($connection, $top50) or die(mysqli_error($connection));

                                                    while($top50Row = mysqli_fetch_array($top50Result))
                                                    {
                                                        $top_User = $top50Row['User_ID'];
                                                        $top_Amount = $top50Row['Amount'];
                                                        $top_Agent = $top50Row['Agent_ID'];
                                                        $top_Created = $top50Row['Created'];

                                                        $top_get_UserDetails = "SELECT * FROM user WHERE User_ID='$top_User'";
                                                        $top_get_Result = mysqli_query($connection, $top_get_UserDetails) or die(mysqli_error($connection));

                                                        while($top_get_Row = mysqli_fetch_array($top_get_Result))
                                                        {
                                                            $top_get_First_Name = $top_get_Row['First_Name'];
                                                            $top_get_Last_Name = $top_get_Row['Last_Name'];
                                                            $top_get_Email = $top_get_Row['Email'];
                                                            $top_get_Mobile = $top_get_Row['Phone_1'];
                                                            $top_get_Level = $top_get_Row['Level'];

                                                            $todayAgent = "SELECT * FROM user WHERE User_ID='$top_Agent'";
                                                            $todayAgentResult = mysqli_query($connection, $todayAgent) or die(mysqli_error($connection));

                                                            while($todayAgentRow = mysqli_fetch_array($todayAgentResult))
                                                            {
                                                                $t_agent_First = $todayAgentRow['First_Name'];
                                                                $t_agent_Last = $todayAgentRow['Last_Name'];
                                                 ?>
                                                <tr role="row" class="filter">
                                                    <td>
                                                        <?php echo $top_get_First_Name." ".$top_get_Last_Name ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $top_get_Email ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $top_get_Mobile ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $top_get_Level ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $top_Amount ?>                                                        
                                                    </td>
                                                    <td>
                                                        <?php echo $t_agent_First." ".$t_agent_Last ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $top_Created; ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                        }
                                                    }
                                                    } 
                                                 ?>
                                            </thead>
                                            <tbody> </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        
                        </div>

                    </div>
                    <div class="row">
                        Select by Agent
                            <div class="col-md-4">
                                <form action="" role="form" method="get" enctype="multipart/form-data" class="form-horizontal form-row-seperated">
                               <div class="form-group">
                                                <label class="control-label col-md-3">Agent did you paid to?</label>
                                                <div class="col-md-8">
                                                    <select class="bs-select form-control" name="agentName">
                                                    <option>choose an agent</option>
                                                    <?php
                                                        $list = "SELECT * FROM user WHERE Agent='Yes'";
                                                        $listResult = mysqli_query($connection, $list) or die(mysqli_error($connection));

                                                        while($listRow = mysqli_fetch_array($listResult))
                                                        {
                                                            $id = $listRow['User_ID'];
                                                            $name = $listRow['First_Name'];
                                                            $sName = $listRow['Last_Name'];
                                                     ?>
                                                        <option value="<?php echo $id; ?>"><?php echo $name; ?> <?php echo $sName; ?></option>
                                                    <?php
                                                        }
                                                     ?>
                                                    </select>
                                                </div>
                                            </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn green" name="search">search</button>   
                                    </div>
                            </form>
                            </div>
                            <div class="col-md-8">
                            <?php
                                if(isset($_GET['agentName']))
                                {
                                    $agent_id = $_GET['agentName'];

                                    $getAmount = "SELECT sum(Amount) FROM cds_history WHERE Agent_ID='$agent_id'";
                                    $getAmountResult = mysqli_query($connection, $getAmount) or die(mysqli_error($connection));

                                    while($getAmountRow = mysqli_fetch_array($getAmountResult))
                                    {
                                        $totalCds = $getAmountRow['sum(Amount)'];
                                    }
                                } 
                             ?>
                                
                            <div class="portlet light portlet-fit portlet-datatable bordered">
                                <div class="portlet-body">
                                    <div class="table-container">
                                    Total CDS :<?php if(isset($_GET['agentName'])){ echo $totalCds; } ?>
                                        <table class="table table-striped table-bordered table-hover table-checkable">
                                            <thead>
                                                <tr role="row" class="heading">
                                                    
                                                    <th width="28%"> Full Name </th>
                                                    <th width="25%"> Date </th>
                                                    <th width="10%"> Mobile</th>
                                                    <th width="10%"> Level</th>
                                                    <th width="15%"> Amount</th>
                                                    <!-- <th width="15%"> Agent</th> -->
                                                </tr>
                                                <?php
                                                    if(isset($_GET['agentName']))
                                                    {
                                                        $agent_id = $_GET['agentName'];

                                                        $history = "SELECT * FROM cds_history WHERE Agent_ID='$agent_id'";
                                                        $historyResult = mysqli_query($connection, $history) or die(mysqli_error($connection));

                                                        while($historyRow = mysqli_fetch_array($historyResult))
                                                        {
                                                            $payedUser = $historyRow['User_ID'];
                                                            $payedAmount = $historyRow['Amount'];
                                                            $payedDate = $historyRow['Created'];

                                                            $getUserDetails = "SELECT * FROM user WHERE User_ID='$payedUser'";
                                                            $getResult = mysqli_query($connection, $getUserDetails) or die(mysqli_error($connection));

                                                            while($getRow = mysqli_fetch_array($getResult))
                                                            {
                                                                $get_First_Name = $getRow['First_Name'];
                                                                $get_Last_Name = $getRow['Last_Name'];
                                                                $get_Email = $getRow['Email'];
                                                                $get_Mobile = $getRow['Phone_1'];
                                                                $get_Level = $getRow['Level'];
                                                ?>
                                                <tr role="row" class="filter">
                                                    <td>
                                                        <?php echo $get_First_Name." ".$get_Last_Name ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $payedDate ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $get_Mobile ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $get_Level ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $payedAmount ?>                                                      
                                                    </td>
                                                    <!-- <td>
                                                        Musa
                                                    </td> -->
                                                </tr>
                                                <?php
                                                            }
                                                        }
                                                    } 
                                                 ?>
                                            </thead>
                                            <tbody> </tbody>
                                        </table>
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
        <div class="page-footer">
            <div class="page-footer-inner"> 2016 &copy; Metronic Theme By
                <a target="_blank" href="http://keenthemes.com">Keenthemes</a> &nbsp;|&nbsp;
                <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
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