<?php require_once 'includes/dbconnect.php'; ?>
<?php require_once 'includes/login_codes.php'; ?>
<?php require_once 'PHPMailer/PHPMailerAutoload.php'; ?>

<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <?php
        if(isset($_GET['ref_spons']))
        {
            $referral_sponsor = $_GET['ref_spons'];

            $refSpons = "SELECT * FROM user WHERE User_ID='$referral_sponsor'";
            $refSponsResult = mysqli_query($connection, $refSpons) or die(mysqli_error($connection));

            while($refSponsRow = mysqli_fetch_array($refSponsResult))
            {
                $refSponsFirstName = $refSponsRow['First_Name'];
                $refSponsLastName = $refSponsRow['Last_Name'];
                $refSponsUserName = $refSponsRow['UserName'];
            }
        }
     ?>
    <?php
        $success = array();
        $errors = array();
        $salt = time();

        if(array_key_exists('referral_register', $_POST))
        {
            $ref = mysql_prep($_POST['referral_ID']);
            $fName = mysql_prep($_POST['firstname']);
            $lName = mysql_prep($_POST['lastname']);
            $gen = mysql_prep($_POST['gender']);
            $code = mysql_prep($_POST['phonecode']);
            $mobile = mysql_prep($_POST['mobile']);
            $img = "";
            $agent = "";
            $email = mysql_prep($_POST['email']);
            $city = mysql_prep($_POST['city']);
            $state = mysql_prep($_POST['state']);
            $userName = mysql_prep($_POST['username']);
            $pass = mysql_prep($_POST['password']);
            $rpass = mysql_prep($_POST['rpassword']);
            $f_capt = mysql_prep($_POST['firstNumber']);
            $s_capt = mysql_prep($_POST['secondNumber']);
            $capt = mysql_prep($_POST['captchaResult']);
            filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
            
            $mobile_conc = "(+".$code.")".$mobile;
            $checkTotal = $f_capt + $s_capt;
            $rand = "1234567890ABCDEFGHIJKLMNOPQRSTUVWSYZ";
            $pin = substr(str_shuffle($rand), 0, 8);

            if (ctype_alnum($userName) || ctype_lower($userName)) 
            {
                
            if($capt == $checkTotal)
            {
                //login codes
                $ref_0 = "SELECT * FROM user WHERE UserName='$ref'";
            $ref_0_result = mysqli_query($connection, $ref_0) or die(mysqli_error($connection));

            if(mysqli_num_rows($ref_0_result) == 0)
            {
                //sponsor does not exist on pm4life exclusive
                $errors['userError'] = '<p class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Sponsor does not exist on PM4Life Exclusive</p>';
            }
            else
            {
                $checkemail = "SELECT * FROM user WHERE Email = '$email'";
            $checkResult = mysqli_query($connection, $checkemail) or die(mysqli_error($connection));
                
                $checkusername = "SELECT * FROM user WHERE UserName='$userName'";
            $checkusernameResult = mysqli_query($connection, $checkusername) or die(mysqli_error($connection));

            if(mysqli_num_rows($checkResult) > 0)
            {
                $errors['userError'] = '<p class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Email Already Exists</p>';
            }elseif(mysqli_num_rows($checkusernameResult) > 0)
            {
                $errors['userError'] = '<p class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Username Already Exists</p>';
            }
            elseif($pass != $rpass)
            {
                $errors['passError'] = '<p class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Passwords do not match</p>';
            }
            else
            {
                $password = sha1($pass.$salt);
                $v_key = sha1($userName);

                $query = "INSERT INTO user(UserName, First_Name, Last_Name, PIN, verification_key, Email, Password, Salt, State, Phone_1, Image, Agent, Gender, City, Stars, Level)VALUES('{$userName}', '{$fName}', '{$lName}', '{$pin}','{$v_key}', '{$email}', '{$password}', '{$salt}', '{$state}', '{$mobile_conc}', '{$img}', '{$agent}', '{$gen}',  '{$city}', '0', '0')";

                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
   /*
                if($result)
                {
                    $subject = "Please Verify Your Account.";

                    $mail = new PHPMailer();
                    $mail->Host = $smtphost;
                    $mail->SMTPAuth = true;
                    $mail->Username = $smtpuser;
                    $mail->Password = $smtppass;
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;

                    $mail->setFrom('no-reply@pm4life.org', 'Perfect Motion 4 Life');
                    $mail->addAddress($email, $fName);

                    $mail->Subject = $subject;
                    $mail->Body = 'Dear '.$fName.' 
	
	
Welcome to Perfect Motion 4 Live. In order to obtain access to all the features of your account, please verify your email address by click on the link below:

	
http://member.pm4life.org/verify.php?key='.$v_key.'

Provided the above link is not working, you can as well copy the link  and paste it on your browser address bar. 

http://member.pm4life.org/verify.php?key='.$v_key.'

Your PIN is '.$pin.'

If you have any questions about Perfect Motion 4 life, please visit 
our Fequently Asked Question Section at http://www.pm4life.org/faq


	
Best Regards,

====================================================

Action Without Borders / pm4life.org
302 Fifth Avenue, 11th Floor, New York, NY 10001, USA';

                    if(!$mail->send())
                    {
                      echo 'Message could not be sent at this time';
                      echo 'Mailer Error: '.$mail->ErrorInfo;
                    }
                    else
                    {
                      echo 'Message has been sent';
                    }
                }
                else
                {
                    $errors['failed']='<p class="alert alert-danger">there may be a few errors</p>';
                }
                
                */

                $ref_check = "SELECT * FROM user WHERE UserName = '$ref'";
                $ref_result = mysqli_query($connection, $ref_check) or die(mysqli_error($connection));  

                if(mysqli_num_rows($ref_result) > 0)
                {
                    while($ref_Row = mysqli_fetch_array($ref_result))
                    {
                      $ref_ID = $ref_Row['User_ID'];
                      $ref_Salt = $ref_Row['Salt'];
                      $ref_Level = $ref_Row['Level'];

                      //merge_tree actions
                      $ref_insert = "INSERT INTO referral(ref_ID, Ben_ID, Interest, standby, Locked)VALUES('{$ref_ID}', '{$salt}', '500', 1, 1)";
                        $ref_test = mysqli_query($connection, $ref_insert) or die(mysqli_error($connection));
                        
                        
                       //merge_tree actions

                       //ref_track actions
                       // $track = "SELECT * FROM ref_track WHERE Child_ID='$ref_Salt'";
                       // $trackResult = mysqli_query($connection, $track) or die(mysqli_error($connection));

                       // while($trackRow = mysqli_fetch_array($trackResult))
                       // {
                       //   $trackParent = $trackRow['Parent_ID'];

                       //   $trackInsert = "INSERT INTO ref_track(Parent_ID, Child_ID)VALUES('{$trackParent}', '{$salt}')";
                       //   $trackInsertResult = mysqli_query($connection, $trackInsert) or die(mysqli_error($connection));
                       // }

                       // $insertTrack = "INSERT INTO ref_track(Parent_ID, Child_ID)VALUES('{$salt}', '{$salt}')";
                       // $insertTrackResult = mysqli_query($connection, $insertTrack) or die(mysqli_error($connection));
                       //ref_track actions

                    }
                }

                //INSERT into level_0, cds and bonus
            }
            }
                //login codes
            }
            else
            {
                $errors['userError'] = '<p class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Wrong Answer on Captcha</p>';
            }
            
        }else
        {
            $errors['userError'] = '<p class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Your username must contain special charaters, spaces or capital letters</p>';
        }

            if(isset($errors['userError']) || isset($errors['passError']))
            {

            }
            else
            {
                header("Location: success_page.php?e_id=$userName");
                exit;
            }
        }
    ?>
    <head>
        <meta charset="utf-8" />
        <title>Register</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Register with Perfect Motion 4 Life and Together, we fight poverty" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="resources/css/theme_user.css" rel="stylesheet" type="text/css" />

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
        
        
    
        <!-- begin ben ajax request -->
        <script type="text/javascript">
          $(document).ready(function()
          {
            function getAll(){
              $.ajax
              ({
                url: 'code.php',
                data: 'action=displayAll',
                cache: false,
                success: function(r)
                {
                  $("#display_1").html(r);
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
                url: 'code.php',
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
        <!-- end ben ajax request -->
    
    </head>
    
    
    <!-- END HEAD -->
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
            <!-- BEGIN LOGIN FORM -->


            <!-- BEGIN REGISTRATION FORM -->
            <form action="" method="post" role="form" id="contactForm">
              <div class="form-group">
                  <p class="hint">Your Sponsor</p>
                  <!-- <label class="control-label visible-ie8 visible-ie9">Referral</label> -->
                  <?php
                        if(isset($_GET['ref_spons']))
                        {
                    ?>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="" value="<?php echo $refSponsFirstName." ".$refSponsLastName; ?>" readonly=""/>
                    <input type="hidden" name="referral_ID" value="<?php echo $refSponsUserName?>" class="form-control"> 
                    <?php
                        }
                        else
                        {
                    ?>
                    <input type="text" name="referral_ID" class="form-control" required placeholder="Your Sponsor's Username e.g. johnsmith"> 
                    <?php
                        }
                    ?>
            </div>
                <div class="form-title">
                    <span class="form-title">Sign Up</span>
                    <?php
                        if(isset($errors['passError']))
                        {
                            echo $errors['passError'];
                        }
                        if(isset($errors['userError']))
                        {
                            echo $errors['userError'];
                        }
                        if(isset($errors['failed']))
                        {
                            echo $errors['failed'];
                        }
                    ?>
                </div>
                <p class="hint"> Enter your personal details below:</p>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">First Name</label>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="First Name" name="firstname" required/> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Last Name</label>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="Last Name" name="lastname" required/> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Gender</label>
                    <select name="gender" class="form-control">
                        <option value="">Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <!--Country Phone Code-->
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Country</label>
                    <select name="country" class="form-control" id="getSpons">
                        <option value="displayAll" selected="selected">Country</option>
                    <?php
                        
                        $getcountry = "SELECT * FROM country";
                        $getcountry_result = mysqli_query($connection, $getcountry) or die(mysqli_error($connection));

                        while($getcountry_row = mysqli_fetch_array($getcountry_result))
                       {
                            $getcountry_name = $getcountry_row['nicename'];
                     ?>
                        <option value="<?php echo $getcountry_name ?>"><?php echo $getcountry_name; ?></option>
                    <?php
                        } 
                     ?>
                    </select>
                </div>
                <div class="form-group" style="width:20%; float:left; margin-right:15px" id="display_1">
                    
                </div>
                <div class="form-group" style="width:75%; float:left;">
                    <label class="control-label visible-ie8 visible-ie9">Mobile Number</label>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="Mobile" name="mobile" required/> </div>
                <!--Country Phone Code-->

                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Email</label>
                    <input class="form-control placeholder-no-fix" type="email" placeholder="Email" name="email" id='txtEmail' required/> </div>
                <div>
                <div class="form-group" style="width:48%; float:left; margin-right:15px">
                    <label class="control-label visible-ie8 visible-ie9">City/Town</label>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="City/Town" name="city" /></div>
                <div class="form-group" style="width:48%; float:left">
                <label class="control-label visible-ie8 visible-ie9">State</label>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="State" name="state" /></div>
                </div>

                <p class="hint"> Enter your Login credentials below: </p>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" required/> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password" required/> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword" required/> </div>
                <div class="form-group margin-top-20 margin-bottom-20">
                    <label class="mt-checkbox mt-checkbox-outline">
                        <input type="checkbox" name="tnc" /> I agree to the
                        <a href="javascript:;">Terms of Service </a> &
                        <a href="javascript:;">Privacy Policy </a>
                        <span></span>
                    </label>
                    <div class="form-group">
                        <?php   
                            $random_number1 = mt_rand(1, 15);
                            $random_number2 = mt_rand(1, 15);
                        ?>
                        <span style="font-size:18px; font-weight:bolder; color:#fff"><?php echo $random_number1 ?> + </span>  <span style="font-size:18px; font-weight:bolder; color:#fff"><?php echo $random_number2 ?> = </span>
                        <input  name="captchaResult" type="text" size="2" />

                        <input name="firstNumber" type="hidden" value="<?php echo $random_number1; ?>" />
                        <input name="secondNumber" type="hidden" value="<?php echo $random_number2; ?>" />
                    </div>
                    <div id="register_tnc_error"> </div>
                </div>
                <div class="form-actions">
                    <button type="submit" id="register-submit-btn" class="btn red uppercase pull-right" name="referral_register" onclick='Javascript:checkEmail();'>Submit</button>
                </div>
            </form>
            <!-- END REGISTRATION FORM -->
        </div>
        <div class="copyright "> <?php $d = date("Y"); echo $d; ?> &copy; Perfect Motion 4 Life </div>
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
