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
        <title>Support Tickets</title>
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
                            <h1>Support Request
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

                                        <table class="table table-striped table-bordered table-hover table-checkable">
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <th width="2%">
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                            <span></span>
                                                        </label>
                                                    </th>
                                                    <th width="15%"> Full Name </th>
                                                    <th width="10%"> ticket #</th>
                                                    <th width="20%"> Email </th>
                                                    <th width="10%"> Ticket Category</th>
                                                    <th width="8%"> </th>
                                                </tr>

                                                <?php
                                                    $entryUsers = "SELECT * FROM tickets";
                                                    $entryResult = mysqli_query($connection, $entryUsers) or die(mysqli_error($connection));

                                                    while($entryRow = mysqli_fetch_array($entryResult))
                                                    {
                                                        $entryID = $entryRow['ticket_id'];
                                                        $entry_code = $entryRow['ticket_code'];
                                                        $entryPost = $entryRow['post'];
                                                        $entryCat = $entryRow['category'];

                                                        $entryCheck = "SELECT * FROM user WHERE User_ID='$entryID'";
                                                        $entryCheckResult = mysqli_query($connection, $entryCheck) or die(mysqli_error($connection));

                                                        while($entryCheckRow = mysqli_fetch_array($entryCheckResult))
                                                        {
                                                            $entryUnique = $entryCheckRow['User_ID'];

                                                            $entryFirstName = $entryCheckRow['First_Name'];
                                                            $entryLastName = $entryCheckRow['Last_Name'];
                                                            $entryEmail = $entryCheckRow['Email'];
                                                            $entryMobile = $entryCheckRow['Phone_1'];

                                                ?>
                                                <tr role="row" class="filter">
                                                <td> </td>

                                                    <td>
                                                        <?php echo $entryFirstName." ".$entryLastName; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $entry_code; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $entryEmail; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $entryCat; ?>

                                                    </td>


                                                    <td>
                                                        <div class="margin-bottom-5">
                                                          <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="btn-group">
                                                                    <button id="sample_editable_1_new" class="btn sbold green" data-toggle="modal" href="#<?php echo $entry_code ?>"> View
                                                                        <i class="fa fa-plus"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <!--modal-->
                                                            <div class="modal fade" id="<?php echo $entry_code ?>" tabindex="-1" role="basic" aria-hidden="true">
                                                              <div class="modal-dialog">
                                                                  <div class="modal-content">
                                                                      <div class="modal-header">
                                                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                          <h4 class="modal-title">TICKET CATEGORY: <?php echo $entryCat?></h4>
                                                                      </div>
                                                                    <form action="" method="post" role="form">
                                                                      <div class="modal-body">

                                                                        <div class="form-group">
                                                                          <label>Name</label>
                                                                          <input class="form-control placeholder-no-fix" type="text" value="<?php echo $entryFirstName; ?>" name="name" readonly/>
                                                                        </div>
                                                                        <div class="form-group">
                                                                          <label>Category</label>
                                                                          <input class="form-control placeholder-no-fix" type="text" value="<?php echo $entryCat; ?>" readonly/>
                                                                        </div>
                                                                        <div class="form-group">
                                                                          <label>Issue</label>
                                                                          <textarea class="form-control" rows="3" placeholder="<?php echo $entryPost; ?>" readonly></textarea>
                                                                          <input name="t_ID" type="hidden" value="<?php echo $entryUnique; ?>" />
                                                                          <input name="t_code" type="hidden" value="<?php echo $entry_code; ?>" />
                                                                        </div>
                                                                        <div class="form-group">
                                                                              <label>Message Thread</label><br>
                                                                              
                                                                              <?php
                                                                                $get_stat = "SELECT * FROM ticket_comment WHERE ticket_code='$entry_code' ORDER BY created ASC";
                                                                                $get_stat_result = mysqli_query($connection, $get_stat) or die(mysqli_error($connection));

                                                                                while($get_stat_row = mysqli_fetch_array($get_stat_result))
                                                                                {
                                                                                  $get_post = $get_stat_row['post'];
                                                                                  $get_status = $get_stat_row['status'];

                                                                                  if($get_status == 'admin_reply')
                                                                                  {
                                                                                    $color = "background-color: #fff";
                                                                                    $state = "admin reply";
                                                                                    $margin = "margin-right: 200px";
                                                                                  }
                                                                                  else
                                                                                  {
                                                                                    $color = "background-color: ";
                                                                                    $state = "user reply";
                                                                                    $margin = "margin-left: 200px";
                                                                                  }
                                                                              ?>
                                                                              
                                                                              <div class="form-group" style="<?php echo $margin ?>;">
                                                                                <small><?php echo $state ?></small>
                                                                                <textarea class="form-control placeholder-no-fix" type="text" placeholder="<?php echo $get_post ?>" readonly style="<?php echo $color ?>; margin-top: 10px; margin-bottom: 10px; width: 100%;"></textarea>
                                                                              </div>
                                                                              <?php
                                                                                }
                                                                               ?>
                                                                               
                                                                            </div>
                                                                        <div class="form-group">
                                                                          <label>Response</label>
                                                                          <textarea class="form-control" rows="3" name="resp" required></textarea>
                                                                        </div>
                                                                      </div>
                                                                      <div class="modal-footer">
                                                                          <button type="submit"  name="admin_ticket" class="btn green">Respond</button>
                                                                          <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                                      </div>
                                                                    </form>
                                                                  </div>
                                                                  <!-- /.modal-content -->
                                                              </div>
                                                              <!-- /.modal-dialog -->
                                                          </div>
                                                            <!--modal-->

                                                        </div>
                                                        </div>

                                                    </td>
                                                </tr>
                                                <?php
                                                        }
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
