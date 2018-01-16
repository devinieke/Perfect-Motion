<?php include '../includes/dbconnect.php'; ?>

<?php
	$action = $_REQUEST['action'];

	if($action == "showAll")
	{
		?>
<div class="col-md-4">
    <img src="../assets/images/manager.jpg" style="width:280px; max-width: 600px">
</div>
<div class="col-md-4">
    <img src="../assets/images/manager.jpg" style="width:280px; max-width: 600px">
</div>
<div class="col-md-4">
    <img src="../assets/images/manager.jpg" style="width:280px; max-width: 600px">
</div>

<?php
	}
	else
	{
		$getAll = "SELECT * FROM merge_tree WHERE ref_ID='$action'";
		$getAllResult = mysqli_query($connection, $getAll) or die(mysqli_query($connection));

        ?><?php
		while($getAllRow = mysqli_fetch_array($getAllResult))
		{
			$getAllID = $getAllRow['Ben_ID'];
			
			$getMain = "SELECT * FROM user WHERE Salt='$getAllID'";
			$getMainResult = mysqli_query($connection, $getMain) or die(mysqli_error($connection));

			while($getMainRow = mysqli_fetch_array($getMainResult))
			{
				$getImg = $getMainRow['Image'];
				$getFirst = $getMainRow['First_Name'];
				$getLast = $getMainRow['Last_Name'];
				$getEmail = $getMainRow['Email'];
				$getPhone = $getMainRow['Phone_1'];
				$getGen = $getMainRow['Gender'];
				$g_s = $getMainRow['Salt'];

?>                       <div class="col-md-4"><div class="well row">
				        <div class="col-md-12">
				            <div class="profile-userpic">
								<?php
                                    if($getImg)
                                    {
                                   ?>
                                   <img src="../assets/images/profile/<?php echo $getImg; ?>" class="img-responsive pic-bordered" alt="" />
                                   <?php
                                    }
                                    elseif($getGen == "Male")
                                    {
                                   ?>
                                   <img src="../assets/images/male_avatar.jpg" class="img-responsive pic-bordered" alt="" />
                                   <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <img src="../assets/images/female_avatar.jpg" class="img-responsive pic-bordered" alt="" />
                                    <?php
                                    }
                                    ?>
							</div>
				        </div>

						<div class="col-md-12">
							<address style="text-align:center;">
								<strong><?php echo $getFirst." ".$getLast ?></strong><br>
								<span><?php echo $getEmail ?></span><br>
								<strong><?php echo $getPhone ?></strong><br>
							</address>
						</div></div></div>

<?php
			}
		}
	}
 ?>
