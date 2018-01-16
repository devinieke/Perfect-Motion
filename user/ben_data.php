<?php 
ob_start();
session_start(); 
?>
<?php include '../includes/dbconnect.php'; ?>
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
      $profile_Salt = $confirmRow['Salt'];
    }
 ?>




<?php
	$get = $_REQUEST['action'];

	if($get == "displayAll")
	{
?>
   	<option>Select Benefactor</option>
<?php
	}
	else
	{
		$getSpon = "SELECT * FROM user WHERE User_ID='$get'";
		$getSpon_r = mysqli_query($connection, $getSpon) or die(mysqli_error($connection));

		while($get_s_row = mysqli_fetch_array($getSpon_r))
		{
			$getSpon_l = $get_s_row['Level'];
			$ben_l = $getSpon_l-1;

			$selectBen = "SELECT DISTINCT u.First_Name, u.Last_Name, u.User_ID, u.Salt FROM referral AS m INNER JOIN user AS u ON m.Ben_ID=u.Salt WHERE u.Level=$ben_l AND u.Status=1 AND m.Locked=0";
			$selectBenResult = mysqli_query($connection, $selectBen) or die(mysqli_error($connection));

			while($ben_row = mysqli_fetch_array($selectBenResult))
			{
				$benFirst = $ben_row['First_Name'];
				$benLast = $ben_row['Last_Name'];
				$ben = $ben_row['User_ID'];
				$ben_s = $ben_row['Salt'];
?>
	<option value="<?php echo $ben_s; ?>"><?php echo $benFirst." ".$benLast ?></option>
<?php
			}
		}
	}
?>
<?php } ?>