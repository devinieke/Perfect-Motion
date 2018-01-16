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
    <head>
     <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>           
           <script>
        $(document).ready(function() {
            $("#callType").on('change', function(){
                $('.form1').toggle();
                $('.form2').toggle();
            });   
        });
   </script>
   <style>
       .form2 {
           display: none;
       }
   </style>
        <!-- end ben ajax request -->
    </head>
<body>
    
 <!--Country Phone Code-->
    
    <select name="title" id="callType"> 
    <option value ="Pro"> Professor </option>
    <option value ="Lib"> Librarian </option> 
</select>

<div class="form1">
    <input type="text" name="text1" value="text1" />
    <input type="text" name="text2" value="text2" />
</div>

<div class="form2">
    <input type="text" name="text3" value="text3" />
    <input type="text" name="text4" value="text4" />
</div>
    
    </body>

        
          <!-- begin ben ajax request -->
       
</html>
