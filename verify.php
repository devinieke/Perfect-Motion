<?php require_once 'includes/dbconnect.php'; ?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Verification - Perfect Motion 4 life</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="resources/img/assets/favicon.png" rel="icon" type="image/png"> 
        <link href="resources/css/init.css" rel="stylesheet" type="text/css">
        <link href="resources/css/ion-icons.min.css" rel="stylesheet" type="text/css">
        <link href="resources/css/etline-icons.min.css" rel="stylesheet" type="text/css">
        <link href="resources/css/theme.css" rel="stylesheet" type="text/css">  
        <link href="resources/css/custom.css" rel="stylesheet" type="text/css"> 
        <link href="resources/css/colors/purple.css" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700%7CRaleway:400,100,200,300%7CHind:400,300" rel="stylesheet" type="text/css">
        
        <style type="text/css">
        .card_info {padding-bottom:20px; padding-top: 20px;font-family: Arial; color: #fff; font-size: 18px;}
            .card_info strong {padding-bottom:20px; padding-top: 20px;font-family: Arial; color: #027193; font-size: 18px;}
            .con_text p {color:#fff;}
        
        
        </style>
    </head>
    <body data-fade-in="true">
        
        <div class="pre-loader"><div></div></div>
        
        <!-- Start Header -->
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
                        <a class="navbar-brand to-top" href="#"><img src="resources/img/assets/logo-light.png" class="logo-light" alt="#"><img src="resources/img/assets/logo-dark.png" class="logo-dark" alt="#"></a> 
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
       <?php
  

  $success = array();

  $key = $_GET['key'];

  $verify_query = "SELECT * FROM user WHERE verification_key='$key'";
  $verify_result = mysqli_query($connection, $verify_query) or die(mysqli_error($connection));

  while($verify_row = mysqli_fetch_array($verify_result))
  {
    $user_id = $verify_row['User_ID'];
    $level_0_salt = $verify_row['Salt'];
 

  if(mysqli_affected_rows($connection) > 0)
  {
    $update = "UPDATE user SET Status=1 WHERE User_ID='$user_id'";
    $update_result = mysqli_query($connection, $update) or die(mysqli_error($connection));

    if($update_result)
    {
        // check_level_0
        $check_0 = "SELECT * FROM level_0 WHERE Salt='$level_0_salt'";
        $check_0_result = mysqli_query($connection, $check_0) or die(mysqli_error($connection));

        if(mysqli_num_rows($check_0_result) > 0)
        {

        }
        else
        {
            $level_0 = "INSERT INTO level_0(User_ID,Active, Merge, Salt)VALUES('{$user_id}', 1, 0, '{$level_0_salt}')";
            $level_0_result = mysqli_query($connection, $level_0) or die(mysqli_error($connection));
        }
        // check_level_0

        // check_bonus
        $check_bonus = "SELECT * FROM bonus WHERE Salt='$level_0_salt'";
        $check_bonus_result = mysqli_query($connection, $check_bonus) or die(mysqli_error($connection));

        if(mysqli_num_rows($check_bonus_result) > 0)
        {

        }
        else
        {
            $bonus = "INSERT INTO bonus(User_ID, Salt)VALUES('{$user_id}', '{$level_0_salt}')";
            $bonus_result = mysqli_query($connection, $bonus) or die(mysqli_error($connection));
        }
        // check_bonus

        // check_cds
        $check_cds = "SELECT * FROM cds WHERE User_ID='$user_id'";
        $check_cds_result = mysqli_query($connection, $check_cds) or die(mysqli_error($connection));

        if(mysqli_num_rows($check_cds_result) > 0)
        {

        }
        else
        {
            $cds = "INSERT INTO cds(User_ID, paid)VALUES('{$user_id}', 0)";
            $cds_result = mysqli_query($connection, $cds) or die(mysqli_error($connection));
        }
        // check_cds

        //check ewallet
            $check_wallet = "SELECT * FROM e_wallet WHERE User_ID='$user_id'";
            $check_wallet_result = mysqli_query($connection, $check_wallet) or die(mysqli_error($connection));

            if(mysqli_num_rows($check_wallet_result) > 0)
            {

            }
            else
            {
                $wallet = "INSERT INTO e_wallet(User_ID, Amount)VALUES('{$user_id}', 0)";
                $wallet_result = mysqli_query($connection, $wallet) or die(mysqli_error($connection));
            }
        //check ewallet
      ?>
<section id="slide" class="parallax pt40 pb20" style="margin-top:45px;">
        <div class="container text-center">
                <div class="alert alert-success" style="font-size:30px;">
Your <strong>Perfect Motion 4 Life</strong> account is verified</div>
            
            <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="well" style="text-align:left;">
            <h4 style="color:#f00;">You are now a Verifeid Perfect Motion 4 Life user</h4> 

<p>Now that you are a full member of Perfect Motion 4 Life, We advise you study all of our avaliable Guides. This will help you understand how your life change be change with a short period </p>
                    
<a href="login.php">Click here</a> to Login
 </div>
                
                </div>
            <div class="col-md-2"></div>
            
            
            </div>
            </div>
           
        </section>

<?php
    }
    else {
      $success['pSuccess'] = '<p class="alert alert-success">Failed to activate account.</p>';
    }
  }
  else {
    $success['pSuccess'] = '<p class="alert alert-success">Verification Key does not exist.</p>';
  }
 }
 ?>

        
        <section class="pt40 pb40" data-overlay-light="10"> 
            <div class="background-image">
                <img src="resources/img/backgrounds/bg-3.jpg" alt="#">
            </div>
            <div class="container">   
                <div class="row vertical-align">

                    <div class="col-md-6 pr30 mt40 mb40">   
                        <h2><strong>We're Creative</strong><br>Crafting With Love</h2>   
                        <p>Fusce faucibus tincidunt nulla, tincidunt sagittis magna venenatis quis. Proin commodo eu ipsum eu suscipit. In dapibus arcu sit amet imperdiet. Praesent condimentum nulla at mauris ornare. Praesent condimentum nulla at mauris ornare, eget consequat felis euismod. Praesent condimentum nulla at mauris ornare.</p>
                        <p>Praesent condimentum nulla at mauris ornare, eget consequat felis euismod. Praesent condimentum nulla at mauris ornare. Fusce faucibus tincidunt nulla, tincidunt sagittis magna venenatis quis. Proin commodo eu ipsum eu suscipit.</p> 
                    </div>

                    <div class="col-md-6 mt50 mb50">
                        <div class="video-container">
                            <img src="resources/img/video/thumbnail-youtube.jpg" />
                            <iframe data-video-embed="https://www.youtube.com/embed/B08iLAtS3AQ"></iframe>
                        </div>                        
                    </div>

                </div>
            </div>
        </section>
        <footer id="footer" class="footer style-1 dark">

            <a href="index.html"><img src="resources/img/assets/footer-logo.png" alt="#" class="mr-auto img-responsive"></a>
            <ul>
                <li><a href="https://www.twitter.com/" target="_blank" class="color"><i class="ion-social-twitter"></i></a></li>
                <li><a href="https://www.facebook.com/" target="_blank" class="color"><i class="ion-social-facebook"></i></a></li>
                <li><a href="https://www.linkedin.com/" target="_blank" class="color"><i class="ion-social-linkedin"></i></a></li>
                <li><a href="https://www.pinterest.com/" target="_blank" class="color"><i class="ion-social-pinterest"></i></a></li> 
                <li><a href="https://plus.google.com/" target="_blank" class="color"><i class="ion-social-googleplus"></i></a></li> 
            </ul>
            <a href="http://themeforest.net/user/vossendesign/portfolio" target="_blank"><strong>© Perfect Motion 4 Life 2016</strong></a>
            <p>Made with love for great people.</p>
            
            <!-- Back To Top Button -->
            <span><a class="scroll-top"><i class="ion-chevron-up"></i></a></span>
            
        </footer>
        <!-- End Footer -->
        
        <script src="resources/js/jquery.js"></script>
        <script src="resources/js/init.js"></script>
        <script src="resources/js/scripts.js"></script>       
        
    </body>
</html>
