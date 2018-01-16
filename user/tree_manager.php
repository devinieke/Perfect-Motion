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
  $dets = "SELECT * FROM user WHERE User_ID='$profile_ID' AND (Bank_Name='' OR Acc_No='' OR Account_Name='')";
  $detsResult = mysqli_query($connection, $dets) or die(mysqli_error($connection));

  if($detsResult && mysqli_affected_rows($connection) == 1)
  {
          redirect_to("profile.php");
  }
 ?>
<?php
  if(array_key_exists('removeBen', $_POST))
  {
    $ben_salt = $_POST['mainBenID'];
    $spon_id = $_POST['mainSponID'];

    $getSalt = "DELETE FROM merge_tree WHERE ref_ID='$spon_id' AND Ben_ID='$ben_salt'";
    $getSaltResult = mysqli_query($connection, $getSalt) or die(mysqli_error($connection));
  }
 ?>

<?php


	$merge_error = array();

	if(array_key_exists('mergeBen', $_POST))
	{
		$s_i = $_POST['spon_u_id'];
		$b_s = $_POST['ben_u_salt'];

		$checkStar = "SELECT * FROM user WHERE User_ID='$s_i'";
		$checkStarResult = mysqli_query($connection, $checkStar) or die(mysqli_error($connection));

		while($checkStarRow = mysqli_fetch_array($checkStarResult))
		{
        $check_tree= "SELECT * FROM merge_tree WHERE ref_ID=$s_i and Ben_ID=$b_s";
        $check_tree_result = mysqli_query($connection, $check_tree) or die(mysqli_error($connection));

        $check_tree1= "SELECT * FROM merge_tree WHERE ref_ID=$b_s and Ben_ID=$s_i";
        $check_tree1_result = mysqli_query($connection, $check_tree1) or die(mysqli_error($connection));

        $check_tree2= "SELECT * FROM merge_tree WHERE Ben_ID=$b_s";
        $check_tree2_result = mysqli_query($connection, $check_tree2) or die(mysqli_error($connection));

        if(mysqli_num_rows($check_tree_result) > 0)
        {
          $merge_error['mError']='<p class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Already Matched With That User</p>';
        }
        elseif(mysqli_num_rows($check_tree1_result) > 0)
        {
          $merge_error['mError']='<p class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Already Matched With That User</p>';
        }
        elseif(mysqli_num_rows($check_tree2_result) >= 1)
        {
          $merge_error['mError']='<p class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>User Already Matched to benefactor</p>';
        }
        else
        {
          $check_tree= "SELECT * FROM merge_tree WHERE ref_ID=$s_i";
          $check_tree_result = mysqli_query($connection, $check_tree) or die(mysqli_error($connection));
          $check_count = mysqli_num_rows($check_tree_result);

          if($check_count >= 3)
          {
            $merge_error['mError']='<p class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Maximum Matches Reached</p>';
          }
          else
          {
            $standby = "UPDATE referral SET standby=0, Locked=1 WHERE ref_ID=$s_i AND Ben_ID=$b_s";
            $standbyResult = mysqli_query($connection, $standby) or die(mysqli_error($connection));

            $getSalt = "INSERT INTO merge_tree(ref_ID, Ben_ID)VALUES('{$s_i}', '{$b_s}')";
            $getSaltResult = mysqli_query($connection, $getSalt) or die(mysqli_error($connection));

            $merge_error['mSuccess']='<p class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Merge Successful</p>';
          }
        }
		}
	}
      if(array_key_exists('mergeBen_1', $_POST))
	{
		$s_i = $_POST['spon_u_id'];
		$b_s = $_POST['ben_u_salt'];

		$checkStar = "SELECT * FROM user WHERE User_ID='$s_i'";
		$checkStarResult = mysqli_query($connection, $checkStar) or die(mysqli_error($connection));

		while($checkStarRow = mysqli_fetch_array($checkStarResult))
		{
        $check_tree= "SELECT * FROM merge_2_tree WHERE ref_ID=$s_i and Ben_ID=$b_s";
        $check_tree_result = mysqli_query($connection, $check_tree) or die(mysqli_error($connection));

        $check_tree1= "SELECT * FROM merge_2_tree WHERE ref_ID=$b_s and Ben_ID=$s_i";
        $check_tree1_result = mysqli_query($connection, $check_tree1) or die(mysqli_error($connection));

        $check_tree2= "SELECT * FROM merge_2_tree WHERE Ben_ID=$b_s";
        $check_tree2_result = mysqli_query($connection, $check_tree2) or die(mysqli_error($connection));

        if(mysqli_num_rows($check_tree_result) > 0)
        {
          $merge_error['mError']='<p class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Already Matched With That User</p>';
        }
        elseif(mysqli_num_rows($check_tree1_result) > 0)
        {
          $merge_error['mError']='<p class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Already Matched With That User</p>';
        }
        elseif(mysqli_num_rows($check_tree2_result) >= 1)
        {
          $merge_error['mError']='<p class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>User Already Matched to benefactor</p>';
        }
        else
        {
          $check_tree= "SELECT * FROM merge_2_tree WHERE ref_ID=$s_i";
          $check_tree_result = mysqli_query($connection, $check_tree) or die(mysqli_error($connection));
          $check_count = mysqli_num_rows($check_tree_result);

          if($check_count >= 3)
          {
            $merge_error['mError']='<p class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Maximum Matches Reached</p>';
          }
          else
          {
            $standby = "UPDATE referral SET standby=0, Locked=1 WHERE ref_ID=$s_i AND Ben_ID=$b_s";
            $standbyResult = mysqli_query($connection, $standby) or die(mysqli_error($connection));

            $getSalt = "INSERT INTO merge_2_tree(ref_ID, Ben_ID)VALUES('{$s_i}', '{$b_s}')";
            $getSaltResult = mysqli_query($connection, $getSalt) or die(mysqli_error($connection));

            $merge_error['mSuccess']='<p class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Merge Successful</p>';
          }
        }
		}
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
  if($level == 4 || $level == 5 || $level == 6)
    {
        $mergebutton = "mergeBen_1";
    }else
    {
      $mergebutton = "mergeBen";
    }
 ?>

<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Tree Manager</title>
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

<style type="text/css">
        select {


        font-size: 18px!important;
        padding : 8px!important;
        height: 40px!important;
        border-radius : 3px!important;
        width : 280px!important;
        background-color: #dadada!important;

        }

    .rule {
  margin: 30px 0;
  border: none;
  height: 1.5px;
  background-image: -webkit-linear-gradient(left, #f0f0f0, #c9bbae, #f0f0f0);
  background-image: linear-gradient(left, #f0f0f0, #c9bbae, #f0f0f0);
}



    ul li{
    color : #023137;
    border-radius:5px;
    font-weight: 600;
    }

        </style>
        <!-- END THEME LAYOUT STYLES -->


        <!-- begin ajax request -->
        <script type="text/javascript">
          $(document).ready(function()
          {
            function getAll(){
              $.ajax
              ({
                url: 'tree_1_data.php',
                data: 'action=showAll',
                cache: false,
                success: function(r)
                {
                  $("#display_1").html(r);
                }
              });
            }

            getAll();

            $("#getUsers").change(function()
            {
              var id = $(this).find(":selected").val();
              var datastring = 'action='+ id;

              $.ajax
              ({
                url: 'tree_1_data.php',
                data: datastring,
                cache: false,
                success: function(r)
                {
                  $("#display_1").html(r);
                }
              });
            })

          });
        </script>
        <!-- end ajax request -->

         <!-- begin ajax request -->
        <script type="text/javascript">
          $(document).ready(function()
          {
            function getAll(){
              $.ajax
              ({
                url: 'tree_data.php',
                data: 'action=showAll',
                cache: false,
                success: function(r)
                {
                  $("#display").html(r);
                }
              });
            }

            getAll();

            $("#getUsers").change(function()
            {
              var id = $(this).find(":selected").val();
              var datastring = 'action='+ id;

              $.ajax
              ({
                url: 'tree_data.php',
                data: datastring,
                cache: false,
                success: function(r)
                {
                  $("#display").html(r);
                }
              });
            })

          });
        </script>
        <!-- end ajax request -->

        <!-- begin ben ajax request -->
        <script type="text/javascript">
          $(document).ready(function()
          {
            function getAll(){
              $.ajax
              ({
                url: 'ben_data.php',
                data: 'action=displayAll',
                cache: false,
                success: function(r)
                {
                  $("#showBen").html(r);
                }
              });
            }

            getAll();

            $("#getSpons").change(function()
            {
              var id = $(this).find(":selected").val();
              var datastring = 'action='+ id;

              $.ajax
              ({
                url: 'ben_data.php',
                data: datastring,
                cache: false,
                success: function(r)
                {
                  $("#showBen").html(r);
                }
              });
            })

          });
        </script>
        <!-- end ben ajax request -->


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
                        <div class="page-title">
                            <h1>Tree Manager
                            </h1>
                        </div>
                        <!-- END PAGE TITLE -->
                        <!-- BEGIN PAGE TOOLBAR -->

                        <!-- END PAGE TOOLBAR -->
                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->



                    <!-- END PAGE BASE CONTENT -->
                    <div class="rule"></div>
                    <div class="row">
                    <div class="col-md-3">
                        <img src="../assets/images/user_merge.jpg" style="margin-top: 15px;">
                        </div>
                    <form action="" method="post">
                      <div class="form-group">
                          <div class="col-md-3">
                        <label><img src="../assets/images/sponsor.jpg"></label>
                              <select class="form-control" id="getSpons" name="spon_u_id" required>
                                  <option value="displayAll" selected="selected">Select Sponsor</option>
                                  <option value="<?php echo $profile_ID ?>"><?php echo $fname." ".$lname ?></option>
                                <?php
                                  $getMatch = "SELECT * FROM merge_tree WHERE ref_ID='$profile_ID'";
                                  $getMatchResult = mysqli_query($connection, $getMatch) or die(mysqli_error($connection));

                                  while($getMatchRow = mysqli_fetch_array($getMatchResult))
                                  {
                                    $getChild = $getMatchRow['Ben_ID'];
                                    $getMain = $getMatchRow['ref_ID'];

                                    $getDetails = "SELECT * FROM user WHERE Salt='$getChild' AND Status=1";
                                    $getDetailsResult = mysqli_query($connection, $getDetails) or die(mysqli_error($connection));

                                    while($getDetailsRow = mysqli_fetch_array($getDetailsResult))
                                    {
                                      $UserID = $getDetailsRow['User_ID'];
                                      $getUserFirst = $getDetailsRow['First_Name'];
                                      $getuserLast = $getDetailsRow['Last_Name'];
                                      $getUserLevel = $getDetailsRow['Level'];
                                ?>
                                  <option value="<?php echo $UserID; ?>"><?php echo $getUserFirst." ".$getuserLast ?></option>
                                <?php
                                    }

                                    $get_spon = "SELECT * FROM merge_tree WHERE ref_ID='$UserID'";
                                    $get_spon_result = mysqli_query($connection, $get_spon) or die(mysqli_error($connection));

                                    while($get_spon_row = mysqli_fetch_array($get_spon_result))
                                    {
                                      $downLine = $get_spon_row['Ben_ID'];

                                      $getDownLine = "SELECT * FROM user WHERE Salt = '$downLine' AND Status = 1";
                                      $getDownLineResult = mysqli_query($connection, $getDownLine) or die(mysqli_error($connection));

                                      while($getDetailRow = mysqli_fetch_array($getDownLineResult))
                                      {
                                        $u_ID = $getDetailRow['User_ID'];
                                        $u_first = $getDetailRow['First_Name'];
                                        $u_Last = $getDetailRow['Last_Name'];
                                        $u_Level = $getDetailRow['Level'];
                                  ?>
                                  <option value="<?php echo $u_ID; ?>"><?php echo $u_first." ".$u_Last ?></option>
                                  <?php
                                      }
                                    }

                                    $get_next = "SELECT * FROM merge_tree WHERE ref_ID='$u_ID'";
                                    $get_next_result = mysqli_query($connection, $get_next) or die(mysqli_error($connection));

                                    while($get_next_row = mysqli_fetch_array($get_next_result))
                                    {
                                      $nextdown = $get_next_row['Ben_ID'];

                                      $getnextdown = "SELECT * FROM user WHERE Salt = '$nextdown' AND Status=1";
                                      $getdownresult = mysqli_query($connection, $getnextdown) or die(mysqli_error($connection));

                                      while($getdownrow = mysqli_fetch_array($getdownresult))
                                      {
                                        $ID = $getdownrow['User_ID'];
                                        $first = $getdownrow['First_Name'];
                                        $Last = $getdownrow['Last_Name'];
                                        $Level = $getdownrow['Level'];
                                  ?>
                                  <option value="<?php echo $ID; ?>"><?php echo $first." ".$Last ?></option>
                                  <?php
                                      }
                                    }
                                  }
                                 ?>
                        </select>

                        </div>
                        <div class="col-md-3">


                        <label><img src="../assets/images/benefactor.jpg"></label>
                        <select class="form-control" id="showBen" name="ben_u_salt" required>


                        </select>
                          </div>
                          <div class="col-md-3">
                        <label><img src="../assets/images/blank.jpg"></label>
                          <button style="width:59%; text-align: center; color:#fff;background-color:green; font-size: 16px; border-radius:5px;" class="btn btn-sm green btn-outline filter-submit margin-bottom" name="<?php echo $mergebutton; ?>" type="submit" >
                          <i class="fa fa-check"></i> Merge
                          </button>
                        </form>
                        <?php
                          if(isset($merge_error['mSuccess']))
                          {
                            echo $merge_error['mSuccess'];
                          }
                          elseif(isset($merge_error['mError']))
                          {
                            echo $merge_error['mError'];
                          }
                         ?>
                        </div>


                        </div></div>
                                            <div class="rule"></div>

                    </div>
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
