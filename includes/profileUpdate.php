<?php 
ob_start();
require_once 'functions.php' 
?>

<?php

	$success = array();
	$error = array();

	if(array_key_exists('bnkDetails', $_POST))
	{
		$update  = $_POST['bUpdate'];
		$accName = mysql_prep($_POST['AccName']);
		$bnkName = mysql_prep($_POST['BnkName']);
		$accNum  = mysql_prep($_POST['AccNum']);
		$perfName = mysql_prep($_POST['perf_AccName']);
		$perfNum = mysql_prep($_POST['perf_AccNum']);
		
		$bitNum = mysql_prep($_POST['bit_AccNum']);
		$payName = mysql_prep($_POST['payza_AccName']);
		$payNum = mysql_prep($_POST['payza_AccNum']);	

		if(count($error) == 0)
		{
			$bnkUpdate = "UPDATE user SET Account_Name='$accName', Bank_Name='$bnkName', Acc_No='$accNum', Perfect_Name='$perfName', Perfect_Number='$perfNum', Bit_Number='$bitNum', Payza_Name='$payName', Payza_Number='$payNum' WHERE User_ID='$update'";
			$bnkResult = mysqli_query($connection, $bnkUpdate) or die(mysqli_error($connection));

			if($bnkResult)
			{
				$success['upSuccess'] = '<p class="alert alert-success">Profile Update Successful</p>';
			}
			else
			{
				$error['upError']='<p class="alert alert-danger">there may be a few errors</p>';
			}
		}
	}

	if(array_key_exists('chngPass', $_POST))
	{
		$update = $_POST['bUpdate'];
		$current = mysql_prep($_POST['current']);
		$new = mysql_prep($_POST['newPass']);
		$confirm = mysql_prep($_POST['conPass']);

		$chkPass = "SELECT * FROM user WHERE User_ID='$update'";
		$chkPassRslt = mysqli_query($connection, $chkPass) or die(mysqli_error($connection));
		while($passRow = mysqli_fetch_array($chkPassRslt))
		{
			$salt = $passRow['Salt'];
			$pass = $passRow['Password'];

			if(sha1($current.$salt) == $pass)
			{
				if($new == $confirm)
				{
					$latest = sha1($new.$salt);
					$updatePass = "UPDATE user SET Password='$latest' WHERE User_ID='$update'";
					$updatepassResult = mysqli_query($connection, $updatePass) or die(mysqli_error($connection));

					$error['upError']='<p class="alert alert-success"> You have changed your pasword</p>';
				}
				else
				{
					$error['upError']='<p class="alert alert-danger"> The Passwords Do Not Match</p>';
				}
			}
		}
	}

	if(array_key_exists('chngImg', $_POST))
	{
		$update = $_POST['bUpdate'];
		$img = $_FILES['profileImg']['name'];
		$img_tmp = $_FILES['profileImg']['tmp_name'];

		$salt = date('d-m-Y-H-i');
		$profile = $salt.$img;

		$imgChk = "SELECT * FROM user WHERE User_ID='$update'";
		$imgChkRslt = mysqli_query($connection, $imgChk) or die(mysqli_error($connection));

		while($imgRow = mysqli_fetch_array($imgChkRslt))
		{
			$profileChk = $imgRow['Image'];

			if($profileChk)
			{
				$file = '../assets/images/profile/'.$profileChk;
				if ($file)
				{
					unlink($file);
				}

				move_uploaded_file($img_tmp, "../assets/images/profile/$profile");
				$img_update = "UPDATE user SET Image='$profile' WHERE User_ID='$update'";
				$img_update_result = mysqli_query($connection, $img_update) or die(mysqli_error($connection));
			}
			else
			{
				move_uploaded_file($img_tmp, "../assets/images/profile/$profile");

				$img_edit = "UPDATE user SET Image='$profile' WHERE User_ID='$update'";
				$img_edit_result = mysqli_query($connection, $img_edit) or die(mysqli_error($connection));
			}
		}
	}

	if(array_key_exists('info', $_POST))
	{
		$update  = $_POST['bUpdate'];
		$fName = mysql_prep($_POST['firstName']);
		if($fName)
		{
			$fQuery = "UPDATE user SET First_Name='$fName' WHERE User_ID = '$update'";
			$fResult = mysqli_query($connection, $fQuery) or die(mysqli_error($connection));
		}

		$lName = mysql_prep($_POST['lastName']);
		if($lName)
		{
			$lQuery = "UPDATE user SET Last_Name='$lName' WHERE User_ID = '$update'";
			$lResult = mysqli_query($connection, $lQuery) or die(mysqli_error($connection));
		}

		$tel = mysql_prep($_POST['tel']);
		if($tel)
		{
			$telQuery = "UPDATE user SET Phone_1='$tel' WHERE User_ID='$update'";
			$telResult = mysqli_query($connection, $telQuery) or die(mysqli_error($connection));
		}

		$tel2 = mysql_prep($_POST['tel2']);
		if($tel2)
		{
			$tel2Query = "UPDATE user SET Phone_2='$tel2' WHERE User_ID='$update'";
			$tel2Result = mysqli_query($connection, $tel2Query) or die(mysqli_error($connection));
		}

		$email = mysql_prep($_POST['email']);
		if($email)
		{
			$emailQuery = "UPDATE user SET Email = '$email' WHERE User_ID='$update'";
			$emailResult = mysqli_query($connection, $emailQuery) or die(mysqli_error($connection));
		}

		$add = mysql_prep($_POST['address']);
		if($add)
		{
			$addQuery = "UPDATE user SET Address='$add' WHERE User_ID='$update'";
			$addResult = mysqli_query($connection, $addQuery) or die(mysqli_error($connection));
		}

		$city = mysql_prep($_POST['city']);
		if($city)
		{
			$cityQuery = "UPDATE user SET City='$city' WHERE User_ID='$update'";
			$cityResult = mysqli_query($connection, $cityQuery) or die(mysqli_error($connection));
		}

		$tUrl = mysql_prep($_POST['twitterurl']);
		if($tUrl)
		{
			$tUrlQuery = "UPDATE user SET Twitter_Url='$tUrl' WHERE User_ID='$update'";
			$tUrlResult = mysqli_query($connection, $tUrlQuery) or die(mysqli_error($connection));
		}

		$fbUrl = mysql_prep($_POST['facebookurl']);
		if($fbUrl)
		{
			$fbUrlQuery = "UPDATE user SET Facebook_Url='$fbUrl' WHERE User_ID='$update'";
			$fbUrlResult = mysqli_query($connection, $fbUrlQuery) or die(mysqli_error($connection));
		}

		$kinName = mysql_prep($_POST['kin_Name']);
		if($kinName)
		{
			$kinNameQuery = "UPDATE user set Kin_Name='$kinName' WHERE User_ID='$update'";
			$kinNameResult = mysqli_query($connection, $kinNameQuery) or die(mysqli_error($connection));
		}

		$kinrel = mysql_prep($_POST['kin_rel']);
		if($kinrel)
		{
			$kinrelQuery = "UPDATE user set Kin_Rel='$kinrel' WHERE User_ID='$update'";
			$kinrelResult = mysqli_query($connection, $kinrelQuery) or die(mysqli_error($connection));
		}

		$kinnum = mysql_prep($_POST['kin_num']);
		if($kinnum)
		{
			$kinnumQuery = "UPDATE user set Kin_Num='$kinnum' WHERE User_ID='$update'";
			$kinnumResult = mysqli_query($connection, $kinnumQuery) or die(mysqli_error($connection));
		}
	}
 ?>
