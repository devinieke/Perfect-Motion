<?php
	ob_start();
	require_once 'functions.php';
 ?>
 <?php
 	if(array_key_exists('admin_ticket', $_POST))
 	{
 		$user_detail = mysql_prep($_POST['t_ID']);
 		$ticket_code = mysql_prep($_POST['t_code']);
 		$ticket_post = mysql_prep($_POST['resp']);
 		$ticket_status = "admin_reply";

 		$admin_post = "INSERT INTO ticket_comment(User_ID, ticket_code, post, status)VALUES('{$user_detail}', '{$ticket_code}', '{$ticket_post}', '{$ticket_status}')";
 		$admin_result = mysqli_query($connection, $admin_post) or die(mysqli_error($connection));
 	}
  ?>

  <?php
 	if(array_key_exists('user_ticket', $_POST))
 	{
 		$user_detail = mysql_prep($_POST['t_ID']);
 		$ticket_code = mysql_prep($_POST['t_code']);
 		$ticket_post = mysql_prep($_POST['reply']);
 		$ticket_status = "user_reply";

 		$admin_post = "INSERT INTO ticket_comment(User_ID, ticket_code, post, status)VALUES('{$user_detail}', '{$ticket_code}', '{$ticket_post}', '{$ticket_status}')";
 		$admin_result = mysqli_query($connection, $admin_post) or die(mysqli_error($connection));
 	}
  ?>