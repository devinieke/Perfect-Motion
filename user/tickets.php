<?php 
ob_start();
session_start(); 
?>
<?php require_once '../includes/dbconnect.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<?php require_once '../includes/ticket_logic.php'; ?>

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
    $userSalt = $dashRow['Salt'];
  }
 ?>

 <?php
    if(array_key_exists('submit_ticket', $_POST))
    {
      $t_name = mysql_prep($_POST['name']);
      $t_number = mysql_prep($_POST['number']);
      $t_cat = mysql_prep($_POST['category']);
      $t_issue = mysql_prep($_POST['issue']);
      $ticket = mysql_prep($_POST['t_ID']);
      $rand = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $t_code = substr(str_shuffle($rand), 0, 6);

      $ticket_post = "INSERT INTO tickets(ticket_ID, ticket_code, posted_by, posted_phone, category, post)VALUES('{$ticket}', '{$t_code}', '{$t_name}', '{$t_number}', '{$t_cat}', '{$t_issue}')";
      $ticket_result = mysqli_query($connection, $ticket_post) or die(mysqli_error($connection));
    }
 ?>

<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>My Tickets</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #4 for basic datatable samples" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link rel="stylesheet" type="text/css" href="../assets/global/plugins/jstree/dist/themes/default/style.min.css">
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
        <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>

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
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Support Tickets
                                <small>main support page</small>
                                <?php
                                    $total = "SELECT * FROM ticket_comment WHERE User_ID='$profile_ID'";
                                    $total_result = mysqli_query($connection, $total) or die(mysqli_error($connection));
                                    $t = mysqli_num_rows($total_result);
                                ?>
                            </h1>
                        </div>
                        <!-- END PAGE TITLE -->
                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div>
                            <!-- BEGIN PROFILE SIDEBAR -->
                            <div class="profile-sidebar">
                                <!-- PORTLET MAIN -->
                                <div class="col-md-3">
                                  <div class="mt-element-list">
                                    <div class="row">      
                                      <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-red-haze">
                                            <span data-counter="counterup" data-value="34"><?php echo $t; ?></span>
                                            
                                        </h3>
                                        <small>TOTAL TICKETS</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-bag"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 56%;" class="progress-bar progress-bar-success red-haze">
                                            <span class="sr-only">56% progress</span>
                                        </span>
                                    </div>
                                        <div class="status">
                                        <div class="status-title"> Completed</div>
                                        <div class="status-number">6
                                            <span class="font-red-haze">(0)</span>
                                        </div>
                                        </div>
                                </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                                <!-- END PORTLET MAIN -->
                                <!-- PORTLET MAIN -->
                                <div class="portlet light bordered col-md-6">
                                    <!-- STAT -->
                                    <div class="row list-separated profile-stat">
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <div class="uppercase profile-stat-title"> 37 </div>
                                            <div class="uppercase profile-stat-text"> New </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <div class="uppercase profile-stat-title"> 51 </div>
                                            <div class="uppercase profile-stat-text"> Processed </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <div class="uppercase profile-stat-title"> 61 </div>
                                            <div class="uppercase profile-stat-text"> Completed </div>
                                        </div>
                                    </div>
                                    <!-- END STAT -->
                                </div>
                                <!-- END PORTLET MAIN -->
                                <!-- PORTLET MAIN -->
                                <div class="col-md-3">
                                  <div class="mt-element-list">
                                    <div class="row">      
                                      <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-red-haze">
                                            <span data-counter="counterup" data-value="34">0</span>
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
                                        <span style="width: 56%;" class="progress-bar progress-bar-success red-haze">
                                            <span class="sr-only">56% progress</span>
                                        </span>
                                    </div>
                                        <div class="status">
                                        <div class="status-title"> Completed</div>
                                        <div class="status-number">6
                                            <span class="font-red-haze">(0)</span>
                                        </div>
                                        </div>
                                </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                                <!-- END PORTLET MAIN -->
                            </div>
                            <!-- END BEGIN PROFILE SIDEBAR -->
                            <!-- BEGIN TICKET LIST CONTENT -->
                            <div class="app-ticket app-ticket-list">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet light bordered">
                                            <div class="portlet-title tabbable-line">
                                                <div class="caption caption-md">
                                                    <i class="icon-globe theme-font hide"></i>
                                                    <span class="caption-subject font-blue-madison bold uppercase">Ticket List</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="table-toolbar">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="btn-group">
                                                                <button id="sample_editable_1_new" class="btn sbold green" data-toggle="modal" href="#basic"> Add New
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <!--modal-->
                                                        <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
                                                          <div class="modal-dialog">
                                                              <div class="modal-content">
                                                                  <div class="modal-header">
                                                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                      <h4 class="modal-title">Add Ticket</h4>
                                                                  </div>
                                                                <form action="" method="post" role="form">
                                                                  <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <select name="category" class="form-control">
                                                                            <option value="">Select Category</option>
                                                                            <option value="gen"><strong>General issue</strong></option>
                                                                            <optgroup label="Account">
                                                                            <option value="Profile">Profile</option>
                                                                            <option value="Next of Kin">Next of Kin</option>
                                                                            <option value="Bank Details">Bank Details</option>
                                                                            <option value="Other issues">Other issues</option>
                                                                            </optgroup>
                                                                            <optgroup label="Matching Issues">
                                                                            <option value="I cant reach my sponsor or benefactor">I cant reach my sponsor/benefactor</option>
                                                                            <option value="Expired matched benefactor">Expired matched benefactor</option>
                                                                            <option value="other issue on matching">other issue on matching</option>
                                                                            </optgroup>
                                                                            
                                                                             <optgroup label="Payment Issues">
                                                                            <option value="Agent delaying CDS confirmation">Agent delaying CDS confirmation</option>
                                                                            <option value="My Sponosor is delaying confirmation">My Sponosor is delaying confirmation</option>
                                                                            <option value="I have no proof of payment">I have no proof of payment</option>
                                                                            <option value="Other issues on payment">Other issues on payment</option>
                                                                            </optgroup>
                                                                            <option value="e-Wallet"><strong>e-Wallet</strong></option>

                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                      <label>Name</label>
                                                                      <input class="form-control placeholder-no-fix" type="text" value="<?php echo $fname." ".$lname; ?>" name="name" readonly/> 
                                                                    </div>
                                                                    <div class="form-group">
                                                                      <label>Number</label>
                                                                      <input class="form-control placeholder-no-fix" type="text" placeholder="Phone Number" name="number" required/>
                                                                      <input name="t_ID" type="hidden" value="<?php echo $profile_ID; ?>" /> 
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                      <label>Body</label>
                                                                      <textarea class="form-control" rows="3" name="issue" required></textarea>
                                                                    </div>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                      <button type="submit"  name="submit_ticket" class="btn green">Submit Ticket</button>
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
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                                                                    <span></span>
                                                                </label>
                                                            </th>
                                                            <th> ID # </th>
                                                            <th> Description </th>
                                                            <th> Cust. Name </th>
                                                            <th> Cust. Phone </th>
                                                            <th> Date/Time </th>
                                                            <th> </th>
                                                            <th> Status </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $ticket_query = "SELECT * FROM tickets WHERE ticket_id='$profile_ID' LIMIT 10";
                                                            $t_result = mysqli_query($connection, $ticket_query) or die(mysqli_error($connection));

                                                            while($ticket_row = mysqli_fetch_array($t_result))
                                                            {
                                                                $code = $ticket_row['ticket_code'];
                                                                $t_post = $ticket_row['post'];
                                                                $t_date = $ticket_row['posted_on'];
                                                                $t_category = $ticket_row['category'];
                                                                $t_tel = $ticket_row['posted_phone'];
                                                                $t_stat = $ticket_row['post_status'];
                                                        ?>
                                                        <tr class="odd gradeX">
                                                            <td>
                                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                                    <input type="checkbox" class="checkboxes" value="1" />
                                                                    <span></span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <?php echo $code ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $t_post ?>
                                                            </td>
                                                            <td> <?php echo $fname." ".$lname?> </td>
                                                            <td>
                                                                <?php echo $t_tel ?> 
                                                            </td>
                                                            <td class="center"> <?php echo $t_date?> </td>
                                                            <?php
                                                                $get_text = "SELECT * FROM tickets WHERE ticket_code='$code'";
                                                                $get_result = mysqli_query($connection, $get_text) or die(mysqli_error($connection));

                                                                if(mysqli_num_rows($get_result) > 0)
                                                                {
                                                                  while($get_row = mysqli_fetch_array($get_result))
                                                                  {
                                                                    $get_code = $get_row['ticket_code'];
                                                                    
                                                                    $get_comment ="SELECT * FROM ticket_comment WHERE ticket_code='$get_code'";
                                                                    $get_comment_result=mysqli_query($connection, $get_comment) or die(mysqli_error($connection));
                                                                      
                                                                  }
                                                              ?>
                                                                <td>
                                                                <div class="btn-group">
                                                                  <button id="sample_editable_1_new" class="btn sbold green btn-outline" data-toggle="modal" href="#<?php echo $get_code ?>"> view
                                                                      
                                                                  </button>
                                                                </div>
                                                                </td>
                                                                <td>
                                                                <?php
                                                                    if(mysqli_num_rows($get_comment_result)> 0)
                                                                    {
                                                                    ?>
                                                                <div class="btn-group">
                                                                  <button id="sample_editable_1_new" class="btn sbold green" data-toggle="modal" href="#<?php echo $get_code ?>"> replied
                                                                  </button>
                                                                </div>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                <!--modal-->
                                                                <div class="modal fade" id="<?php echo $get_code ?>" tabindex="-1" role="basic" aria-hidden="true">
                                                                  <div class="modal-dialog">
                                                                      <div class="modal-content">
                                                                          <div class="modal-header">
                                                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                              <h4 class="modal-title"> TICKET CATEGORY: <?php echo $t_category?></h4>
                                                                          </div>
                                                                        <form action="" method="post" role="form">
                                                                          <div class="modal-body">
                                                                            
                                                                            <div class="form-group">
                                                                              <label>Name</label>
                                                                              <input class="form-control placeholder-no-fix" type="text" value="<?php echo $fname." ".$lname; ?>" name="name" readonly/> 
                                                                            </div>
                                                                            <div class="form-group">
                                                                              <label>Ticket Code</label>    
                                                                              <input class="form-control placeholder-no-fix" type="text" name="t_code" value="<?php echo $get_code; ?>" readonly/>
                                                                              <input name="t_ID" type="hidden" value="<?php echo $profile_ID; ?>" />  
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <h4>Subject:<br> <?php echo $t_post; ?><br>  <small>created on <?php echo $t_date ?></small></h4>
                                                                              </div>
                                                                            <!--message thread-->
                                                                            <div class="form-group">
                                                                              <label>Message Thread</label><br>
                                                                              <?php
                                                                                $get_stat = "SELECT * FROM ticket_comment WHERE ticket_code='$get_code' ORDER BY created ASC";
                                                                                $get_stat_result = mysqli_query($connection, $get_stat) or die(mysqli_error($connection));

                                                                                while($get_stat_row = mysqli_fetch_array($get_stat_result))
                                                                                {
                                                                                  $get_post = $get_stat_row['post'];
                                                                                  $get_status = $get_stat_row['status'];
                                                                                  $get_created = $get_stat_row['created'];

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
                                                                                <small><?php echo $get_created ?></small>
                                                                              </div>
                                                                              <?php
                                                                                }
                                                                               ?>
                                                                               
                                                                            </div>
                                                                            <!--message thread end-->
                                                                            <div class="form-group">
                                                                              <label>User Reply</label>
                                                                              <textarea class="form-control" rows="3" name="reply" required></textarea>
                                                                            </div>
                                                                          </div>
                                                                          <div class="modal-footer">
                                                                              <button type="submit"  name="user_ticket" class="btn green">Reply</button>
                                                                              <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                                          </div>
                                                                        </form>
                                                                      </div>
                                                                      <!-- /.modal-content -->
                                                                  </div>
                                                                  <!-- /.modal-dialog -->
                                                                </div>
                                                                    </td>
                                                                <!--modal-->
                                                              <?php
                                                                }
                                                               ?> 
                                                            
                                                        </tr>
                                                        <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PROFILE CONTENT -->
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
            </div>
        </div>
          <!-- END CONTENT BODY -->
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
        <script type="text/javascript" src="../assets/global/plugins/jstree/dist/jstree.min.js"></script>
        <script type="text/javascript" src="../assets/global/scripts/app.min.js"></script>
        <script type="text/javascript" src="../assets/pages/scripts/ui-tree.js"></script>
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
