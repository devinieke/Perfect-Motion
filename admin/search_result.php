<?php
    session_start();
    ob_start();
 ?>

<?php require_once '../includes/dbconnect.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<?php require_once '../includes/superadmin.php'; ?>
<?php require_once '../includes/ticket_logic.php'; ?>

<?php

    error_reporting(0);

    if(!isset($_SESSION['username']))
    {
        redirect_to("../login.php");
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
        <title>Search Results</title>
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

    <?php
        if(array_key_exists('deep', $_POST))
        {
            $s_level = mysql_prep($_POST['search_level']);
            $s_username = mysql_prep($_POST['search_username']);
            $move = 'superadmin';

            if($s_level == 1)
            {
                $_SESSION['username'] = $s_username;
                $_SESSION['admin'] = $move; 
                header("Location: ../user/dashboard_1.php");
                exit;
            }
            if($s_level == 2)
            {
                $_SESSION['username'] = $s_username;
                $_SESSION['admin'] = $move;
                header("Location: ../user/dashboard_2.php");
                exit;
            }
            if($s_level == 4)
            {
                $_SESSION['username'] = $s_username;
                $_SESSION['admin'] = $move;
                header("Location: ../user/dashboard_4.php");
                exit;
            }
            if($s_level == 5)
            {
                $_SESSION['username'] = $s_username;
                $_SESSION['admin'] = $move;
                header("Location: ../user/dashboard_5.php");
                exit;
            }
            if($s_level == 6)
            {
                $_SESSION['username'] = $s_username;
                $_SESSION['admin'] = $move;
                header("Location: ../user/dashboard_6.php");
                exit;
            } 
            if($s_level == 7)
            {
                $_SESSION['username'] = $s_username;
                $_SESSION['admin'] = $move;
                header("Location: ../user/dashboard_7.php");
                exit;
            }
            if($s_level == 3)
            {
                $_SESSION['username'] = $s_username;
                $_SESSION['admin'] = $move;
                header("Location: ../user/dashboard_3.php");
                exit;
            }
            else
            {
                $_SESSION['username'] = $s_username;
                $_SESSION['admin'] = $move;
                header("Location: ../user/dashboard.php");
                exit;
            }
        }
     ?>

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
                            <h1>Search Results
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
                            <span class="active">Manage Users</span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Begin: Demo Datatable 1 -->
                            <div class="portlet light portlet-fit portlet-datatable bordered">
                                <div class="portlet-body">
                                    <div class="table-container">
                                        <h4>Seacrh Result</h4>
                                        <table class="table table-striped table-bordered table-hover table-checkable">
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <th width="15%"></th>
                                                 
                                                    <th width="8%"> </th>
                                                    <th> </th>
                                                    <th> </th>
                                                    <th> </th>
                                                    <th> </th>
                                                </tr>

                                                <?php
                                                    if(isset($_GET['go']))
                                                    {
                                                        $query = $_GET['search_query'];

                                                        $search = "SELECT * FROM user WHERE UserName LIKE '%$query%' OR Email LIKE '%$query%' OR Phone_1 LIKE '%$query%'";
                                                        $search_result = mysqli_query($connection, $search) or die(mysqli_error($connection));

                                                        while($search_row = mysqli_fetch_array($search_result))
                                                        {
                                                            $search_name = $search_row['First_Name'];
                                                            $search_lname = $search_row['Last_Name'];
                                                            $search_username = $search_row['UserName'];
                                                            $search_level = $search_row['Level'];
                                                            $search_id = $search_row['User_ID'];
                                                            $search_phone = $search_row['Phone_1'];
                                                ?>
                                                <tr role="row" class="filter">
                                                    <td>
                                                        <!-- username -->
                                                        <?php echo $search_name.' '.$search_lname; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $search_phone; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $search_level; ?>
                                                    </td>
                                                    <td>
                                                        <div class="margin-bottom-5">
                                                          <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="btn-group">
                                                                    <form action="" method="post" >
                                                                        <input type="hidden" name="search_level" value="<?php echo $search_level?>" class="form-control"/>
                                                                        <input type="hidden" name="search_username" value="<?php echo $search_username?>" class="form-control"/>
                                                                        <button id="sample_editable_1_new" class="btn sbold green" data-toggle="modal" name="deep" type="submit"> Login as User
                                                                        <i class="fa fa-user"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>

                                                    </td>
                                                    <td>
                                                        <?php
                                                            $get_sus = "SELECT * FROM suspension WHERE User_ID='$search_id'";
                                                            $get_sus_result = mysqli_query($connection, $get_sus) or die(mysqli_error($connection));

                                                            if(mysqli_num_rows($get_sus_result) > 0)
                                                            {
                                                        ?>
                                                        <div class="margin-bottom-5">
                                                          <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="btn-group">
                                                                    <form action="" method="post" >
                                                                        <input type="hidden" name="disableID" value="<?php echo $search_id ?>" class="form-control"/>
                                                                        <button id="sample_editable_1_new" class="btn-outline btn sbold" data-toggle="modal" name="disableUser" type="submit"> User Suspended
                                                                        <i class="fa fa-close"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <?php
                                                            }
                                                            else
                                                            {
                                                        ?>
                                                        <div class="margin-bottom-5">
                                                          <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="btn-group">
                                                                    <form action="" method="post" >
                                                                        <input type="hidden" name="disableID" value="<?php echo $search_id ?>" class="form-control"/>
                                                                        <button id="sample_editable_1_new" class="btn-outline btn sbold red" data-toggle="modal" name="disableUser" type="submit"> Suspend  User
                                                                        <i class="fa fa-close"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <?php
                                                            }
                                                         ?>

                                                    </td>
                                                    <td>
                                                        <div class="margin-bottom-5">
                                                          <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="btn-group">
                                                                    <form action="" method="post" >
                                                                        <input type="hidden" name="disableID" value="<?php echo $search_id ?>" class="form-control"/>
                                                                        <button id="sample_editable_1_new" class="btn-outline btn sbold red" data-toggle="modal" name="enableUser" type="submit"> Lift Suspension
                                                                        <i class="fa fa-close"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>

                                                    </td>
                                                </tr>
                                                <?php
                                                        }
                                                    }
                                                    if (mysqli_affected_rows($connection) == 0)
                                                    {
                                                      echo '<p class="alert alert-danger">no results</p>';
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
