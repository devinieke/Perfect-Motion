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
        <title>Transfers</title>
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
                        <?php if(isset($error['upError'])){echo $error['upError'];} ?>
                        <?php if(isset($error_f['upError'])){echo $error_f['upError'];} ?>
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>List of Expired Matches
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
                            <a href="index.html">Funds Transfer</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Agent</span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                        <div class="row" style="margin-bottom:5px;">
                    <div class="col-md-6">
                        <div class="mt-element-list">
                                            <div class="row">
                                                
                                                                            <div class="dashboard-stat2 bordered" style="padding: 15px 15px 35px!important;">
                                <div class="display" style="margin-bottom:2px!important;">
                                    <div class="number">
                                        <small>Available Funds</small>
                                    </div>
                                </div>
                            </div>
                                            </div>
                        </div></div>
						                    <div class="col-md-6">
                        <div class="mt-element-list">
                                            <div class="row">
                                                
                                                                            <div class="dashboard-stat2 bordered" style="padding: 15px 15px 15px!important;">
                                <div class="display" style="margin-bottom:2px!important;">
                                    <div class="number">
                                        <h3 class="font-green-sharp">
                                            <span data-counter="counterup" data-value="<?php echo $main; ?>"><?php echo $main; ?></span>
                                            <small class="font-green-sharp">₦</small>
                                        </h3>
                                        <small>e-wallet</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-pie-chart"></i>
                                    </div>
                                </div>
                            </div>
                                            </div>
                        </div></div>
                    </div>
					<div class="row" style="margin-bottom:5px;">
                    <div class="col-md-6">
                        <div class="mt-element-list">
                                            <div class="row">
                                                
                                                                            <div class="dashboard-stat2 bordered" style="padding: 15px 15px 28px!important;">
                                <div class="display" style="margin-bottom:2px!important;">
                                    <div class="number">
                                        <small>Amount</small>
                                    </div>
                                </div>
                            </div>
                                            </div>
                        </div></div>
						                    <div class="col-md-6">
                                                <form action="" role="form" method="post">
                        <div class="mt-element-list">
                                            <div class="row">
                                                
                                                                            <div class="dashboard-stat2 bordered" style="padding: 15px 15px 15px!important;">
                                <div class="display" style="margin-bottom:2px!important;">
                                    <div class="number">
									<input type="number" name="transfer_amount" class="form-control" placeholder="N2,000" required>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-pie-chart"></i>
                                    </div>
                                </div>
                            </div>
                                            </div>
                        </div></div>
                    </div>
					<div class="row">
					<div class="col-md-12">
					<div class="mt-element-list">
                                            <div class="row">
                                                
                                        <div class="dashboard-stat2 bordered" style="padding: 15px 15px 25px!important;background-color:#2ab4c0; color:#fff!important;">
                                <div class="display" style="margin-bottom:2px!important;">
                                    <div class="number">
                                        <span class="divider">Beneficiary Details</span>
                                    </div>
                                </div>
                            </div>
                                            </div>
                        </div>
					
					
					</div>
					</div>
					<div class="row" style="margin-bottom:5px;">
                                        </div>
					<div class="row" style="margin-bottom:5px;">
                    <div class="col-md-6">
                        <div class="mt-element-list">
                                            <div class="row">
                                                
                                                                            <div class="dashboard-stat2 bordered" style="padding: 15px 15px 28px!important;">
                                <div class="display" style="margin-bottom:2px!important;">
                                    <div class="number">
                                        <small>Beneficiary Email</small>
                                    </div>
                                </div>
                            </div>
                                            </div>
                        </div></div>
						                    <div class="col-md-6">
                        <div class="mt-element-list">
                                            <div class="row">
                                                
                                                                            <div class="dashboard-stat2 bordered" style="padding: 15px 15px 15px!important;">
                                <div class="display" style="margin-bottom:2px!important;">
                                    <div class="number">
									<input type="text" name="ben_email" id='txtEmail' class="form-control" placeholder="hen@email.com" required>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-pie-chart"></i>
                                    </div>
                                </div>
                            </div>
                                            </div>
                        </div></div>
                    </div>
					<div class="row" style="margin-bottom:5px;">
                    <div class="col-md-6">
                        <div class="mt-element-list">
                                            <div class="row">
                                                
                                                                            <div class="dashboard-stat2 bordered" style="padding: 15px 15px 28px!important;">
                                <div class="display" style="margin-bottom:2px!important;">
                                    <div class="number">
                                        <small>YOUR PIN</small>
                                    </div>
                                </div>
                            </div>
                                            </div>
                        </div></div>
						                    <div class="col-md-6">
                        <div class="mt-element-list">
                                            <div class="row">
                                                
                                                                            <div class="dashboard-stat2 bordered" style="padding: 15px 15px 15px!important;">
                                <div class="display" style="margin-bottom:2px!important;">
                                    <div class="number">
									<input type="password" name="user_pin" class="form-control" required>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-pie-chart"></i>
                                    </div>
                                </div>
                            </div>
                                            </div>
                        </div></div>
                    </div>
					<div class="row">
					<div class="col-md-6">
                    <input type="hidden" name="balance" value="<?php echo $main?>" class="form-control">
                    <input type="hidden" name="userID" value="<?php echo $profile_ID?>" class="form-control">
					<button class="btn btn-sm blue btn-outline filter-submit margin-bottom" onclick='Javascript:checkEmail();' name="transfer" type="submit">
                                                              Pay Now
                                                              </button>
					</div>
                        </form>
										<div class="col-md-6">
					<button class="btn btn-sm blue btn-outline filter-submit margin-bottom" name="LockUserRef" type="submit">
                                                             Cancel
                                                              </button>
					</div>
					</div>
                        
                        
                        
                        </div>
                        <div class="col-md-2"></div>
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
         <!---  Email Validation-->
        <script language="javascript">

            function checkEmail() {

            var email = document.getElementById('txtEmail');
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if (!filter.test(email.value)) {
            alert('Please provide a valid email address');
            email.focus;
            return false;
            }
            }
        </script>
        <!---  Email Validation-->
    </body>

</html>
<?php } ?>