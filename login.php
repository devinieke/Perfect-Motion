<?php
ob_start();
session_start();
?>
<?php require_once 'includes/dbconnect.php'; ?>
<?php require_once 'includes/login_codes.php'; ?>

<?php

  $logsuccess = array();
  $logerror = array();

  if(array_key_exists('login', $_POST))
  {
    $log_user = mysql_prep($_POST['username']);
    $log_pass = mysql_prep($_POST['password']);

    $logQuery = "SELECT * FROM user WHERE UserName ='$log_user'";
    $logResult = mysqli_query($connection, $logQuery) or die(mysqli_error($connection));

    if(mysqli_num_rows($logResult) != 0)
    {
      while($logRow = mysqli_fetch_array($logResult))
      {
        $userSalt = $logRow['Salt'];
        $userPass = $logRow['Password'];
        $userLevel = $logRow['Level'];
        $userAux = $logRow['Aux_Level'];
        $userStatus = $logRow['Status'];
        $userRoll = $logRow['roll'];
      }

        if($userRoll == 'superadmin' && sha1($log_pass.$userSalt) == $userPass && $userStatus == 1)
        {
            $_SESSION['username'] = $log_user;
            redirect_to("admin/index.php");
        }
        else
        {
            if($userStatus == 1)//active user
            {
                if(sha1($log_pass.$userSalt) == $userPass && $userLevel == 1)
                {
                  $_SESSION['username'] = $log_user;
                  redirect_to("user/dashboard_1.php");
                }
                if(sha1($log_pass.$userSalt) == $userPass && $userLevel == 2)
                {
                    $_SESSION['username'] = $log_user;
                    redirect_to("user/dashboard_2.php");
                }
                if(sha1($log_pass.$userSalt) == $userPass && $userLevel == 4)
                {
                    $_SESSION['username'] = $log_user;
                    redirect_to("user/dashboard_4.php");
                }
                if(sha1($log_pass.$userSalt) == $userPass && $userLevel == 5)
                {
                  $_SESSION['username'] = $log_user;
                  redirect_to("user/dashboard_5.php");
                }
                if(sha1($log_pass.$userSalt) == $userPass && $userLevel == 6)
                {
                  $_SESSION['username'] = $log_user;
                  redirect_to("user/dashboard_6.php");
                }
                if(sha1($log_pass.$userSalt) == $userPass && $userLevel == 7)
                {
                  $_SESSION['username'] = $log_user;
                  redirect_to("user/dashboard_7.php");
                }
                if(sha1($log_pass.$userSalt) == $userPass && $userLevel == 3)
                {
                    $_SESSION['username'] = $log_user;
                    redirect_to("user/dashboard_3.php");
                }
                elseif(sha1($log_pass.$userSalt) == $userPass)
                    {

                    $_SESSION['username'] = $log_user;
                  redirect_to("user/dashboard.php");
                    }
                else
                {
                  $logerrors['sError']='<p class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Please confirm your Username or Password and try again</p>';
                }
            }
            elseif($userStatus == 0)// inactive user
            {
                $logerrors['sError']='<p class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Sorry This Account Is Inactive</p>';
            }
        }
    }
    else
		{
			$logerrors['sError']='<p class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>User Does not exist</p>';
		}
  }

 ?>

<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Member Login</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #4 for " name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
                        <link href="resources/css/theme_user.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="assets/pages/css/login-2.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" />

        <script type="text/javascript">
        function checkSubmit(e) {
           if(e && e.keyCode == 13) {
              document.forms[0].submit();
           }
        }
        </script>
    </head>
<nav class="navbar nav-down" data-fullwidth="true" data-menu-style="transparent" data-animation="shrink"><!-- Styles: light, dark, transparent | Animation: hiding, shrink -->
            <div class="container">

                <div class="navbar-header">
                    <div class="container">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar top-bar"></span>
                            <span class="icon-bar middle-bar"></span>
                            <span class="icon-bar bottom-bar"></span>
                        </button>
                        <a class="navbar-brand to-top" href="#"><img src="resources/img/assets/logo-light.png" class="logo-light" alt="#"><img src="resources/img/assets/logo-light.png" class="logo-dark" alt="#"></a>
                    </div>
                </div>

                <div id="navbar" class="navbar-collapse collapse">
                    <div class="container">
                        <ul class="nav navbar-nav menu-right">
                            <!-- Each section must have corresponding ID ( #hero -> id="hero" ) -->
                            <li><a href="#slide">Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#services">Services</a></li>
                            <li><a href="#">How it works</a></li>
                            <li><a href="#">Compensation Plan</a></li>
                            <li><a href="##">FAQ</a></li>
                            <li><a href="#contact">Join Now</a></li>
                            <li><a href="#contact">Login</a></li>

                            <li class="nav-separator"></li>
                            <li  class="nav-icon"><a href="http://facebook.com" target="_blank"><i class="ion-social-facebook"></i></a></li>
                            <li  class="nav-icon"><a href="http://twitter.com" target="_blank"><i class="ion-social-twitter"></i></a></li>
                            <li  class="nav-icon"><a href="#" target="_blank"><i class="ion-help-buoy"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
<?php if(isset($errors['pSuccess'])){echo $errors['pSuccess'];} ?>
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="" method="post" role="form">
                <div class="form-title">
<span style="font-size: 22px; font-weight: bold; color:#ffffff">Login to see what you've earned today</span>
                </div>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Enter any username and password. </span>
                </div>
                <?php if(isset($success['passed'])){echo $success['passed'];} ?>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
                <div class="form-actions">

                    <button type="submit" class="btn red btn-block uppercase" name="login" display: none; id="form_action">Login</button>
                    <?php if(isset($logerrors['sError'])){echo $logerrors['sError'];} ?>
                </div>
                <div class="form-actions">
                    <div class="pull-left">
                        <label class="rememberme mt-checkbox mt-checkbox-outline">
                            <input type="checkbox" name="remember" value="1" /> Remember me
                            <span></span>
                        </label>
                    </div>
                    <div class="pull-right forget-password-block">
                        <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
                    </div>
                </div>

                <?php if(isset($errors['userError'])){echo $errors['userError'];} ?>

                <div class="create-account">
                    <p>
                        <a href="register.php" class="btn-primary btn" id="register-btn">Create an account</a>
                    </p>
                </div>

    <!---            <div class="create-account">
                    <p>
                        <a href="register.php" class="btn-primary btn" id="register-btn">Create an account</a>
                    </p>
                </div> --->
            </form>
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
            <form class="forget-form" action="" method="post" >
                <div class="form-title">
                    <span class="form-title">Forget Password ?</span>
                    <span class="form-subtitle">Enter your e-mail to reset it.</span>
                </div>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="forgot_email" /> </div>
                    <?php if(isset($errors['pSuccess'])){echo $errors['pSuccess'];} ?>
                <div class="form-actions">
                    <button type="button" id="back-btn" class="btn btn-default">Back</button>
                    <button type="submit" class="btn btn-primary uppercase pull-right" name="forgot_password">Submit</button>
                </div>
            </form>
            <!-- END FORGOT PASSWORD FORM -->
        </div>
        <div class="copyright "> <?php $d = date("Y"); echo $d; ?> &copy; Perfect Motion</div>
        <?php
          if(isset($connection))
          {
            mysqli_close($connection);
          }
         ?>
        <!-- END LOGIN -->
        <!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script>
<script src="assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
         <script src="assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="assets/pages/scripts/login.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>
