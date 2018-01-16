<?php require_once 'includes/dbconnect.php'; ?>
<?php
	$action = $_REQUEST['action'];

	if($action == "displayAll")
	{
?>
<input class="form-control placeholder-no-fix" type="text" placeholder="" value="" readonly  />
<?php
	}
	else
	{
		$getall_code = "SELECT * FROM country WHERE nicename='$action'";
		$getall_result = mysqli_query($connection, $getall_code) or die(mysqli_error($connection));

		while($getall_row = mysqli_fetch_array($getall_result))
		{
			$getall_phone = $getall_row['phonecode'];
?>
<input class="form-control placeholder-no-fix" type="text" placeholder="<?php echo $getall_phone ?>" value="<?php echo $getall_phone ?>"name="phonecode" readonly  />
<?php
		}
	}
 ?>