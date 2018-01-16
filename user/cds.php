<?php
ob_start();
session_start();
?>
<?php require_once '../includes/dbconnect.php'; ?>
<?php require_once '../includes/functions.php'; ?>
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
  $dashResult = mysqli_query($connection, $dashQuery) or die(mysqli_error($connection));

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
        <title>My Wallet</title>
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
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> 
    
    <style type="text/css">
        
       .option1form, .option2form {
           display: none;
        
       }
        </style>
    </head>
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
        <?php
          if(isset($_GET['amount']))
          {
            $amount = $_GET['amount'];
            $type = $_GET['type'];
            $book_agent = $_GET['agent_ID'];
            
          }
         ?>
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
                        <?php if(isset($success['upSuccess'])){echo $success['upSuccess'];}else{echo $error['upError'];} ?>
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>CDS Payment
                            </h1>
                        </div>
                        <!-- END PAGE TITLE -->
                        <!-- BEGIN PAGE TOOLBAR -->

                        <!-- END PAGE TOOLBAR -->
                    </div>

                    <div class="row">
                    <div class="col-md-6">
                        <div class="portlet box red">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                           Please Upload your payment details here </div>
                                                    </div>
                                                    <div class="portlet-body form">
                                                        <!-- BEGIN FORM-->
                                                        <form action="" role="form" method="post" enctype="multipart/form-data" class="form-horizontal form-row-seperated">

                                                            <div class="form-body">
                                                                <div class="form-group">
                                                <label class="control-label col-md-3">Agent Name </label>
                                                <div class="col-md-8">
                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-user"></i>
                                                                        </span>
                                                                        <?php
                                                                            $pick = "SELECT * FROM user WHERE User_ID='$book_agent'";
                                                                            $pickResult = mysqli_query($connection ,$pick) or die(mysqli_error($connection));

                                                                            while($pickRow = mysqli_fetch_array($pickResult))
                                                                            {
                                                                                $name = $pickRow['First_Name'];
                                                                                $sname = $pickRow['Last_Name'];
                                                                        ?>
                                                                        <input type="text" name="agentName" value="<?php echo $name." ".$sname; ?>" class="form-control" readonly>
                                                                        <?php
                                                                            }
                                                                         ?>
                                                                         </div>
                                                </div>
                                            </div>
                                                                <div class="form-group">
                                                <label class="control-label col-md-3">Transaction Type</label>
                                                <div class="col-md-8">
                                                    <select class="bs-select form-control" name="transType" id="callType" required>
                                                        <option value="">Please Select</option>
                                                        <option value="Bank_Deposit">Bank Deposit</option>
                                                        <option value="Cash">Cash</option>
                                                        <option value="ATM">Internet/Mobile Transfer</option>
                                                        <option value="ATM">ATM Transfer</option>
                                                    </select>
                                                </div>
                                            </div>

                                               <div class="form-group">
                                                <label class="control-label col-md-3">Amount</label>
                                                <div class="col-md-8">
                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-money"></i>
                                                                        </span>
                                                                        <input type="text" name="amount" value="<?php echo $amount; ?>" class="form-control" placeholder="How much did you pay?" readonly> </div>
                                                </div>
                                            </div>
                                                    <div class="form-group option1form">
                                                <label class="control-label col-md-3">Paid to which bank?</label>
                                                <div class="col-md-8">
                                                    <select class="bs-select form-control" name="BankName">
                                                         <option value="">Please Select</option>
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
                                            </div>
                                                    <div class="form-group option3form">
                                                <label class="control-label col-md-3">Paid to which bank?</label>
                                                <div class="col-md-8">
                                                    <select class="bs-select form-control" name="BankName">
                                                         <option value="">Please Select</option>
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
                                            </div>
                                            <div class="form-group option1form">
                                                <label class="control-label col-md-3">Other Details</label>
                                                <div class="col-md-8">
                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-circle"></i>
                                                                        </span>
                                                                        <input type="text" name="other" class="form-control" placeholder="What name are you paying with/from?"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group option3form">
                                                <label class="control-label col-md-3">Other Details</label>
                                                <div class="col-md-8">
                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-circle"></i>
                                                                        </span>
                                                                        <input type="text" name="other" class="form-control" placeholder="What name are you paying with/from?"> </div>
                                                </div>
                                            </div>
                                                                <div class="form-group option1form">
                                                <label class="control-label col-md-3">Receiver Account Number</label>
                                                <div class="col-md-8">
                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-circle"></i>
                                                                        </span>
                                                                        <input type="text" name="rec_acc" class="form-control" placeholder="What is the account you are paying to?"> </div>
                                                </div>
                                            </div>
                                                        <div class="form-group option3form">
                                                <label class="control-label col-md-3">Receiver Account Number</label>
                                                <div class="col-md-8">
                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-circle"></i>
                                                                        </span>
                                                                        <input type="text" name="rec_acc" class="form-control" placeholder="What is the account you are paying to?"> </div>
                                                </div>
                                            </div>

                                                                <div class="form-group option1form">
                                                <label class="control-label col-md-3">Teller Number</label>
                                                <div class="col-md-8">
                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-circle"></i>
                                                                        </span>
                                                                        <input type="text" name="teller"  class="form-control" placeholder="Enter the teller Number"> </div>
                                                </div>
                                            </div>
                                                                <h3>Or Better Still:</h3>

                                           <div class="form-group">
                                                <label for="exampleInputFile1" class="control-label col-md-3">File input</label><div class="col-md-8">
                                                <input id="exampleInputFile1" type="file" name="cdsImg">
                                                <input type="hidden" name="userID" value="<?php echo $profile_ID?>" class="form-control">
                                                <input type="hidden" name="cdsLevel4" value="<?php echo $lvl4;?>" class="form-control">
                                                <input type="hidden" name="agentid" value="<?php echo $book_agent;?>" class="form-control">
                                                <input type="hidden" name="payType" value="<?php echo $type;?>" class="form-control">

                                                <p class="help-block"> some help text here. </p>
                                            </div></div>


                                                            </div>
                                                            <div class="form-actions">
                                                                <button type="submit" class="btn green" name="cdsPay">Submit</button>
                                                                <button type="button" class="btn default">Cancel</button>
                                                            </div>
                                                        </form>
                                                        <!-- END FORM-->
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
    
          <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        
 <script>

                $("#callType").change(function(){
          if ($(this).val() == "Cash") {
                $('.option1form').hide('');
                $('.option3form').hide('');
                $('.option2form').show('');
          }});
         </script>
                 <script>
             $("#callType").change(function(){
         if ($(this).val() == "Bank_Deposit") {
                $('.option1form').show('');
                $('.option3form').hide('');
                $('.option2form').hide('');}});

</script>
                         <script>
             $("#callType").change(function(){
         if ($(this).val() == "ATM") {
                $('.option3form').show('');
                $('.option1form').hide('');
                $('.option2form').hide('');}});

</script>
    </body>

</html>

<?php } ?>
