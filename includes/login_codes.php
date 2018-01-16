<?php
  ob_start();
  require_once 'functions.php';
  require_once 'dbconnect.php';
  require_once './PHPMailer/PHPMailerAutoload.php';
?>

<?php
  $success = array();
  $errors = array();

  $salt = time();


  if(array_key_exists('forgot_password', $_POST))
  {
    $f_email = mysql_prep($_POST['forgot_email']);

    $forgotQuery = "SELECT * FROM user WHERE Email='$f_email'";
    $forgotResult = mysqli_query($connection, $forgotQuery) or die(mysqli_error($connection));

    if(mysqli_num_rows($forgotResult) > 0)
    {
      while($forgotRow = mysqli_fetch_array($forgotResult))
      {
        $forgotSalt = $forgotRow['Salt'];
        $f_name = $forgotRow['First_Name'];
        $hash = substr(str_shuffle(MD5(microtime())), 0, 6);

        $hashUpdate = sha1($forgotSalt.$hash);

        $hashQuery = "UPDATE user SET Password='$hashUpdate' WHERE Email='$f_email'";
        $hashResult = mysqli_query($connection, $hashQuery) or die(mysqli_error($connection));

        $subject = "Reset Password: Perfect Motion 4 Life.";

        $mail = new PHPMailer();
        $mail->Host = $smtphost;
        $mail->SMTPAuth = true;
        $mail->Username = $smtpuser;
        $mail->Password = $smtppass;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('info@pm4life.org', 'Perfect Motion 4 Life');
        $mail->addAddress($f_email, $f_name);

        $mail->Subject = $subject;
        $mail->Body = "Dear ".$f_name.", \r\n".$hash." is your new password. \r\n Please use it to login and set your new password immediately. \r\nThank You";

          if(!$mail->send())
          {
            echo 'Message could not be sent at this time';
            echo 'Mailer Error: '.$mail->ErrorInfo;
          }
          else {
            echo 'Message has been sent';
          }
      }
    }
    else
    {
      $errors['pSuccess'] = '<p class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>User Does Not Exist.</p>';
    }
  }
 ?>
