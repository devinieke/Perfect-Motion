<?php require_once 'includes/dbconnect.php'; ?>
<?php require_once 'includes/functions.php'; ?>

<!DOCTYPE html>

<?php
  if(isset($_GET['id']))
  {
    $ref_sponsor = $_GET['id'];

    $sponsor = "SELECT * FROM user WHERE UserName='$ref_sponsor'";
    $sponsor_result = mysqli_query($connection, $sponsor) or die(mysqli_error($connection));

    while($sponsor_row = mysqli_fetch_array($sponsor_result))
    {
        $sponsor_id = $sponsor_row['User_ID'];
        $sponsor_fname = $sponsor_row['First_Name'];
        $sponsor_lname = $sponsor_row['Last_Name'];
        $sponsor_tel = $sponsor_row['Phone_1'];
        $level = $sponsor_row['Level'];
        $sponsor_img = $sponsor_row['Image'];
        $sponsor_gen = $sponsor_row['Gender'];
    }

    $income = "SELECT sum(Amount) FROM merge WHERE Spons_ID='$sponsor_id' AND Spons_Con='1'";
    $incomeResult = mysqli_query($connection, $income) or die(mysqli_error($connection));

    while($incomeRow = mysqli_fetch_array($incomeResult))
    {
        $incomeTotal = $incomeRow['sum(Amount)'];
    }

    $refQuery = "SELECT * FROM referral WHERE ref_ID = '$sponsor_id'";
    $refResult = mysqli_query($connection, $refQuery) or die(mysql_error());
    $refCount = mysqli_num_rows($refResult);
  }
 ?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Wunderkind - Multipurpose Responsive Onepage Template</title>
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
       <section id="slide" class="parallax pt20 pb20" style="margin-top:45px;">
        <div class="container text-center">
                <h3 style="color:#000;"><strong><?php echo $sponsor_fname; ?> wants you to join Perfect Motion 4 Life </strong></h3>
            </div>
        </section>
        <section id="who-we-are" data-overlay-dark="3">
            <div class="background-image">
                <img src="resources/img/backgrounds/bg-2.jpg" alt="#">
            </div>
            <div class="container">   
                <div class="row vertical-align">
                    <div class="col-md-6 pt10 pb10">
                        <div class="row">
                            <div class="col-md-6">
                            <!--image logic-->
                              <?php
                                if($sponsor_img)
                                {
                              ?>
                                  <img alt="#" src="assets/images/profile/<?php echo $sponsor_img ?>" width="220px" height="230px" style="border: 1px solid #fff;">
                              <?php
                                }
                                elseif($sponsor_gen == "Male")
                                {
                              ?>
                                  <img alt="#" src="assets/images/male_avatar.jpg" width="220px" height="230px" style="border: 1px solid #fff;">
                              <?php
                                }
                                else
                                {
                              ?>
                                  <img alt="#" src="assets/images/female_avatar.jpg" width="220px" height="230px" style="border: 1px solid #fff;">
                              <?php
                                }
                              ?>
                            <!--image logic-->
                            </div>
                            <div class="col-md-6">
                            <span class="card_info"><strong>Your Sponsor Information</strong></span>
                            <br>
                            <br>
                            <span class="card_info"><strong>Name : </strong><?php echo $sponsor_fname ?>  <?php echo $sponsor_lname ?></span> <br>
                            <span class="card_info"><strong>Mobile : </strong><?php echo $sponsor_tel ?></span> <br>
                            <span class="card_info"><strong>Level :</strong> <?php echo $level; ?> </span><br>          
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 pr10 mt10 mb10 con_text">   
                        <h2><strong>Learn more </strong><br><span class="color">About Perfect Motion 4 Life</span></h2>   
                        <p>Fusce faucibus tincidunt nulla, tincidunt sagittis magna venenatis quis. Proin commodo eu ipsum eu suscipit. In dapibus arcu sit amet imperdiet. Praesent condimentum nulla at mauris ornare. Praesent condimentum nulla at mauris ornare, eget consequat felis euismod. Praesent condimentum nulla at mauris ornare.</p>
                        <p>Praesent condimentum nulla at mauris ornare, eget consequat felis euismod. Praesent condimentum nulla at mauris ornare. Fusce faucibus tincidunt nulla, tincidunt sagittis magna venenatis quis. Proin commodo eu ipsum eu suscipit.</p> 
                        <div class="row pt20"> 						

                        <div class="col-md-6 text-center">
                            <a href="register.php?ref_spons=<?php echo $sponsor_id; ?>" class="btn btn-md btn-primary btn-appear mt30">
                                <span>Create your own Account <i class="ion-checkmark"></i></span>
                            </a>
                        </div> 
                    <div class="col-md-6 text-center"> 
                        <a href="http://themeforest.net/user/vossendesign/portfolio?ref=VossenDesign" target="_blank" class="btn btn-md btn-primary btn-appear mt30"><span>Frequent Asked Question<i class="ion-checkmark"></i></span></a>
                    </div> 

                </div>
                    </div>

                    

                </div>
            </div>
        </section>
        <section class="pt40 pb40" data-overlay-light="9"> 
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
            <a href="http://themeforest.net/user/vossendesign/portfolio" target="_blank"><strong>© Wunderkind 2016</strong></a>
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
