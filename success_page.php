<?php require_once 'includes/dbconnect.php'; ?>
<?php require_once 'PHPMailer/PHPMailerAutoload.php'; ?>


<?php
	if(isset($_GET['e_id']))
	{
		$newID = $_GET['e_id'];

		$newUser = "SELECT * FROM user WHERE UserName='$newID'";
		$newUserResult = mysqli_query($connection, $newUser) or die(mysqli_error($connection));

		while($newRow = mysqli_fetch_array($newUserResult))
		{
			$newF = $newRow['First_Name'];
			$newE = $newRow['Email'];
			$newV = $newRow['verification_key'];
            $newP = $newRow['PIN'];
		}
	} 
 

	$success = array();
    $errors = array();

	if(array_key_exists('resend', $_POST))
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
        $mail->addAddress($newE, $newF);

        $mail->Subject = $subject;
        $mail->Body = '<a href=""><img src="http://pm4life.org/resources/img/assets/logo-dark.png"></a>

Dear '.$newF.' \r\n \r\n
	
	
Welcome to Perfect Motion 4 Live. In order to obtain access to all the features of your account, please verify your email address by click on the link below:\r\n \r\n

	
<a href="http://member.pm4life.org/verify.php?key='.$newV.'">http://pm4life.org/verify.php?key='.$newV.'</a>\r\n \r\n

Provided the above link is not working, you can as well copy the link  and paste it on your web browser address bar. \r\n \r\n

http://member.pm4life.org/verify.php?key='.$newV.' \r\n \r\n

If you have any questions about Perfect Motion 4 life, please visit 
our Fequently Asked Question Section at http://www.pm4life.org/faq\r\n \r\n


	
Best Regards,\r\n 

===========================================================\r\n 

Action Without Borders / pm4life.org\r\n 
302 Fifth Avenue, 11th Floor, New York, NY 10001, USA';

        if(!$mail->send())
        {
          $errors['failed'] = 'Message could not be sent at this time. Mailer Error: '.$mail->ErrorInfo;
        }
        else
        {
          $success['passed'] = 'Message Has Been Sent';
        }
	} 
 ?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Congratulations</title>
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
       <section id="slide" class="parallax pt40 pb20" style="margin-top:45px;">
        <?php if(isset($errors['failed'])){echo $errors['failed'];}elseif(isset($success['passed'])){echo $success['passed'];} ?>
           <div class="container text-center">
                <div class="alert alert-success" style="font-size:30px;">
<strong>Congratulations! <?php echo $newF; ?></strong>, Account Creation Successful </div>
            
            <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="well" style="text-align:left;">
            <h4 style="color:#f00;">A verification e-mail has been sent to the e-mail address displayed below</h4> 

<p>Click the link in the emall to verify this e-mail address, which will unlock your access to Perfect Motion 4 Life. You will have the access to be rich for life </p>
 <p>
 <h4>Account Email<br>
 <strong><?php echo $newE;?></strong></h4>
 <h4>PIN<br>
     <strong><span style="font-family: 'Arial', Times, serif;  letter-spacing: 2px;"><?php echo $newP;?></span></strong><br><h3 style="color:#f00; font-size:13px; font-weight:bold;" >(Please Copy and Secure this PIN. It will be required during funds transfer and User verification)</h3></h4>
 </p>
<h4>You will log in with this e-mail address.</h4>
 <p>
When logging in to  Perfect Motion 4 Life website, you will be prompted to fill in your other important infomation, Most Importantly, Your Bank Details
 </p>
                    <p>
                        If you dont receive any verification e-mail within 5 minitues, You can as well check your Spam or Junk, else, click the below button to resend </p>
                
                
                </div>
                <form action="" method="post">
		<button type="submit" id="register-submit-btn" class="btn red uppercase pull-left" name="resend">
			Resend Email
		</button>
	</form>
                </div>
            <div class="col-md-2"></div>
            
            
            </div>
            </div>
           
        </section>
        
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
            <a href="http://themeforest.net/user/vossendesign/portfolio" target="_blank"><strong>© Perfect Motion 4 Life 2017</strong></a>
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
