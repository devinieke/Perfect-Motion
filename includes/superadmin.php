<?php
if(array_key_exists('agentUpdate', $_POST))
{
    $user = $_POST['userCds'];
    
	$cdsUpdate = "UPDATE cds SET paid=1, Completed=1 WHERE User_ID='$user'";
	$cdsUpdateResult = mysqli_query($connection, $cdsUpdate) or die(mysqli_error($connection));

	$cdsHistory = "UPDATE cds_history SET paid=1, Completed=1 WHERE User_ID='$user'";
	$cdsHistory = mysqli_query($connection, $cdsHistory) or die(mysqli_error($connection));
         
    if($cdsUpdate)
    {
      $success['cdsCheck'] = '<p class="alert alert-success">Request received.</p>';
    }
  }



if(array_key_exists('disableUser', $_POST))
	{
		$user = $_POST['disableID'];


		$disableLevel = "SELECT * FROM user WHERE User_ID='$user'";
		$disableLevelResult = mysqli_query($connection, $disableLevel) or die(mysqli_error($connection));

		while($disableLevelRow = mysqli_fetch_array($disableLevelResult))
		{
			$disableConfirm = $disableLevelRow['Level'];

			if($disableConfirm == 1)
			{
				$do1 = "UPDATE level_1 SET Active=0 WHERE User_ID='$user'";
				$do1Result = mysqli_query($connection, $do1) or die(mysqli_error($connection));
			}
			elseif($disableConfirm == 2)
			{
				$do2 = "UPDATE level_2 SET Active=0 WHERE User_ID='$user'";
				$do2Result = mysqli_query($connection, $do2) or die(mysqli_error($connection));
			}
			elseif($disableConfirm == 3)
			{
				$do3 = "UPDATE level_3 SET Active=0 WHERE User_ID='$user'";
				$do3Result = mysqli_query($connection, $do3) or die(mysqli_error($connection));
			}
			elseif($disableConfirm == 4)
			{
				$do4 = "UPDATE level_4 SET Active=0 WHERE User_ID='$user'";
				$do4Result = mysqli_query($connection, $do4) or die(mysqli_error($connection));
			}
			elseif($disableConfirm == 5)
			{
				$do5 = "UPDATE level_5 SET Active=0 WHERE User_ID='$user'";
				$do5Result = mysqli_query($connection, $do5) or die(mysqli_error($connection));
			}
            elseif($disableConfirm == 6)
			{
				$do5 = "UPDATE level_6 SET Active=0 WHERE User_ID='$user'";
				$do5Result = mysqli_query($connection, $do5) or die(mysqli_error($connection));
			}
		}

	  $check_sus = "SELECT * FROM suspension WHERE User_ID='$user'";
	  $check_sus_result = mysqli_query($connection, $check_sus) or die(mysqli_error($connection));

	  if(mysqli_num_rows($check_sus_result) > 0)
	  {

	  }
	  else
	  {
		  $suspend = "INSERT INTO suspension(User_ID, request, paid)VALUES('{$user}', '0', '0')";
		  $suspend_result = mysqli_query($connection, $suspend) or die(mysqli_error($connection));
	  }
	}

if(array_key_exists('enableUser', $_POST))
	{
		$user = $_POST['disableID'];
        if(isset($_POST['Agent_ID']))
        {$agent = $_POST['Agent_ID'];}
        if(isset($_POST['agent_amount']))
        {$amount = $_POST['agent_amount'];}


		$disableLevel = "SELECT * FROM user WHERE User_ID='$user'";
		$disableLevelResult = mysqli_query($connection, $disableLevel) or die(mysqli_error($connection));

		while($disableLevelRow = mysqli_fetch_array($disableLevelResult))
		{
			$disableConfirm = $disableLevelRow['Level'];

			if($disableConfirm == 1)
			{
				$do1 = "UPDATE level_1 SET Active=1 WHERE User_ID='$user'";
				$do1Result = mysqli_query($connection, $do1) or die(mysqli_error($connection));
			}
			elseif($disableConfirm == 2)
			{
				$do2 = "UPDATE level_2 SET Active=1 WHERE User_ID='$user'";
				$do2Result = mysqli_query($connection, $do2) or die(mysqli_error($connection));
			}
			elseif($disableConfirm == 3)
			{
				$do3 = "UPDATE level_3 SET Active=1 WHERE User_ID='$user'";
				$do3Result = mysqli_query($connection, $do3) or die(mysqli_error($connection));
			}
			elseif($disableConfirm == 4)
			{
				$do4 = "UPDATE level_4 SET Active=1 WHERE User_ID='$user'";
				$do4Result = mysqli_query($connection, $do4) or die(mysqli_error($connection));
			}
			elseif($disableConfirm == 5)
			{
				$do5 = "UPDATE level_5 SET Active=1 WHERE User_ID='$user'";
				$do5Result = mysqli_query($connection, $do5) or die(mysqli_error($connection));
			}
            elseif($disableConfirm == 6)
			{
				$do5 = "UPDATE level_6 SET Active=1 WHERE User_ID='$user'";
				$do5Result = mysqli_query($connection, $do5) or die(mysqli_error($connection));
			}
		}
    
      $deletesuspension="DELETE FROM suspension WHERE User_ID='$user'";
      $deletesuspension_result = mysqli_query($connection, $deletesuspension) or die(mysqli_error($connection));
     
    ////Update Agent ewallet
       if(isset($_POST['agent_amount']))
        {
           if(ctype_digit($amount))
           {
      $ewallet="UPDATE e_wallet SET Book_Balance=Book_Balance-$amount WHERE User_ID='$agent'";
      $ewallet_result = mysqli_query($connection, $ewallet) or die(mysqli_error($connection));
           }
        }
	}

	if(array_key_exists('enableAgent', $_POST))
	{
		$user = $_POST['selectedID'];

		$enableAgent = "UPDATE user SET Agent='yes' WHERE User_ID='$user'";
		$enableQuery = mysqli_query($connection, $enableAgent) or die(mysqli_error($connection));
	}

	if(array_key_exists('disableAgent', $_POST))
	{
		$user = $_POST['disableAgentID'];

		$disableAgent = "UPDATE user SET Agent='' WHERE User_ID='$user'";
		$disableQuery = mysqli_query($connection, $disableAgent) or die(mysqli_error($connection));
	}

	if(array_key_exists('confirmBonus', $_POST))
	{
		$user = $_POST['confirmBonusID'];

		$confirmUser = "SELECT * FROM user WHERE User_ID='$user'";
		$confirmResult = mysqli_query($connection, $confirmUser) or die(mysqli_error($connection));

		while($confirmRow = mysqli_fetch_array($confirmResult))
		{
			$confirmSalt = $confirmRow['Salt'];

			$resetBonus = "UPDATE bonus SET payout=0 WHERE Salt='$confirmSalt'";
			$resetResult = mysqli_query($connection, $resetBonus) or die(mysqli_error($connection));
		}
	}

	if(array_key_exists('confirmRef', $_POST))
	{
		$user = $_POST['confirmRefID'];

		$resetRef = "UPDATE ref_payout_request SET payout_status=1 WHERE ref_ID='$user'";
		$resetRefResult = mysqli_query($connection, $resetRef) or die(mysqli_error($connection));

		$confirmUser = "UPDATE referral SET interest=0, Status=0, payout=0 WHERE ref_ID='$user' AND payout=1";
		$confirmResult = mysqli_query($connection, $confirmUser) or die(mysqli_error($connection));
	}

	//Reset Users
	if(array_key_exists('resetMatch', $_POST))
	{
		$sponsor = $_POST['resetSponsID'];
		$benefactor = $_POST['resetBenID'];
		$merge_id = $_POST['resetID'];
		$spons_level = $_POST['resetSponsLevel'];
		$ben_level= $_POST['resetBenLevel'];

		$deleteMerge = "DELETE FROM merge WHERE id='$merge_id'";
		$deleteMergeResult = mysqli_query($connection, $deleteMerge) or die(mysqli_error($connection));


		if($ben_level == 0)
		{
			$reset0 = "UPDATE level_0 SET Merge=0 WHERE User_ID='$benefactor'";
			$reset0Result = mysqli_query($connection, $reset0) or die(mysqli_error($connection));
		}
		elseif($ben_level == 1 || $spons_level == 1)
		{
			$reset1 = "UPDATE level_1 SET Merge=0 WHERE User_ID='$benefactor'";
			$reset1Result = mysqli_query($connection, $reset1) or die(mysqli_error($connection));

			$resetSpons1 = "SELECT * FROM level_1 WHERE User_ID='$sponsor'";
			$resetSpons1Result = mysqli_query($connection, $resetSpons1) or die(mysqli_error($connection));

			while($resetSpons1Row = mysqli_fetch_array($resetSpons1Result))
			{
				$m1 = $resetSpons1Row['Merge_1'];
				$m2 = $resetSpons1Row['Merge_2'];
				$m3 = $resetSpons1Row['Merge_3'];

				if($m1 == 1 && $m2 == 0 && $m3 == 0)
	            {
	              $update_1 = "UPDATE level_1 SET Merge_1=0 WHERE User_ID='$sponsor'";
	              $update_1_result = mysqli_query($connection, $update_1) or die(mysqli_error($connection));
	            }
	            elseif($m1 == 1 && $m2 == 1 && $m3 == 0)
	            {
	              $update_2 = "UPDATE level_1 SET Merge_2=0 WHERE User_ID='$sponsor'";
	              $update_2_result = mysqli_query($connection, $update_2) or die(mysqli_error($connection));
	            }
	            elseif($m1 == 1 && $m2 == 1 && $m3 == 1)
	            {
	              $update_3 = "UPDATE level_1 SET Merge_3=0, completed=1 WHERE User_ID='$sponsor'";
	              $update_3_result = mysqli_query($connection, $update_3) or die(mysqli_error($connection));
	            }			
			}
		}
		elseif($ben_level == 2 || $spons_level == 2)
		{
			$reset1 = "UPDATE level_2 SET Merge=0 WHERE User_ID='$benefactor'";
			$reset1Result = mysqli_query($connection, $reset1) or die(mysqli_error($connection));

			$resetSpons1 = "SELECT * FROM level_2 WHERE User_ID='$sponsor'";
			$resetSpons1Result = mysqli_query($connection, $resetSpons1) or die(mysqli_error($connection));

			while($resetSpons1Row = mysqli_fetch_array($resetSpons1Result))
			{
				$m1 = $resetSpons1Row['Merge_1'];
				$m2 = $resetSpons1Row['Merge_2'];
				$m3 = $resetSpons1Row['Merge_3'];

				if($m1 == 1 && $m2 == 0 && $m3 == 0)
	            {
	              $update_1 = "UPDATE level_2 SET Merge_1=0 WHERE User_ID='$sponsor'";
	              $update_1_result = mysqli_query($connection, $update_1) or die(mysqli_error($connection));
	            }
	            elseif($m1 == 1 && $m2 == 1 && $m3 == 0)
	            {
	              $update_2 = "UPDATE level_2 SET Merge_2=0 WHERE User_ID='$sponsor'";
	              $update_2_result = mysqli_query($connection, $update_2) or die(mysqli_error($connection));
	            }
	            elseif($m1 == 1 && $m2 == 1 && $m3 == 1)
	            {
	              $update_3 = "UPDATE level_2 SET Merge_3=0, completed=1 WHERE User_ID='$sponsor'";
	              $update_3_result = mysqli_query($connection, $update_3) or die(mysqli_error($connection));
	            }			
			}
		}
		 elseif($ben_level == 3 || $spons_level == 3)
		 {
			$reset1 = "UPDATE level_3 SET Merge=0 WHERE User_ID='$benefactor'";
		$reset1Result = mysqli_query($connection, $reset1) or die(mysqli_error($connection));

			$resetSpons1 = "SELECT * FROM level_3 WHERE User_ID='$sponsor'";
			$resetSpons1Result = mysqli_query($connection, $resetSpons1) or die(mysqli_error($connection));

		 	while($resetSpons1Row = mysqli_fetch_array($resetSpons1Result))
			{
		 		$m1 = $resetSpons1Row['Merge_1'];
				$m2 = $resetSpons1Row['Merge_2'];
				$m3 = $resetSpons1Row['Merge_3'];

				if($m1 == 1 && $m2 == 0 && $m3 == 0)
	           {
	               $update_1 = "UPDATE level_3 SET Merge_1=0 WHERE User_ID='$sponsor'";
	              $update_1_result = mysqli_query($connection, $update_1) or die(mysqli_error($connection));
	           }
	          elseif($m1 == 1 && $m2 == 1 && $m3 == 0)
	           {
	             $update_2 = "UPDATE level_3 SET Merge_2=0 WHERE User_ID='$sponsor'";
	              $update_2_result = mysqli_query($connection, $update_2) or die(mysqli_error($connection));
	            }
	            elseif($m1 == 1 && $m2 == 1 && $m3 == 1)
	            {
	              $update_3 = "UPDATE level_3 SET Merge_3=0, completed=1 WHERE User_ID='$sponsor'";
	              $update_3_result = mysqli_query($connection, $update_3) or die(mysqli_error($connection));
	          }			
			}
		 }elseif($ben_level == 4 || $spons_level == 4)
		 {
			$reset1 = "UPDATE level_4 SET Merge=0 WHERE User_ID='$benefactor'";
		$reset1Result = mysqli_query($connection, $reset1) or die(mysqli_error($connection));

			$resetSpons1 = "SELECT * FROM level_4 WHERE User_ID='$sponsor'";
			$resetSpons1Result = mysqli_query($connection, $resetSpons1) or die(mysqli_error($connection));

		 	while($resetSpons1Row = mysqli_fetch_array($resetSpons1Result))
			{
		 		$m1 = $resetSpons1Row['Merge_1'];
				$m2 = $resetSpons1Row['Merge_2'];
				$m3 = $resetSpons1Row['Merge_3'];

				if($m1 == 1 && $m2 == 0 && $m3 == 0)
	           {
	               $update_1 = "UPDATE level_4 SET Merge_1=0 WHERE User_ID='$sponsor'";
	              $update_1_result = mysqli_query($connection, $update_1) or die(mysqli_error($connection));
	           }
	          elseif($m1 == 1 && $m2 == 1 && $m3 == 0)
	           {
	             $update_2 = "UPDATE level_4 SET Merge_2=0 WHERE User_ID='$sponsor'";
	              $update_2_result = mysqli_query($connection, $update_2) or die(mysqli_error($connection));
	            }
	            elseif($m1 == 1 && $m2 == 1 && $m3 == 1)
	            {
	              $update_3 = "UPDATE level_4 SET Merge_3=0, completed=1 WHERE User_ID='$sponsor'";
	              $update_3_result = mysqli_query($connection, $update_3) or die(mysqli_error($connection));
	          }			
			}
		 }elseif($ben_level == 5 || $spons_level == 5)
		 {
			$reset1 = "UPDATE level_5 SET Merge=0 WHERE User_ID='$benefactor'";
		$reset1Result = mysqli_query($connection, $reset1) or die(mysqli_error($connection));

			$resetSpons1 = "SELECT * FROM level_5 WHERE User_ID='$sponsor'";
			$resetSpons1Result = mysqli_query($connection, $resetSpons1) or die(mysqli_error($connection));

		 	while($resetSpons1Row = mysqli_fetch_array($resetSpons1Result))
			{
		 		$m1 = $resetSpons1Row['Merge_1'];
				$m2 = $resetSpons1Row['Merge_2'];
				$m3 = $resetSpons1Row['Merge_3'];

				if($m1 == 1 && $m2 == 0 && $m3 == 0)
	           {
	               $update_1 = "UPDATE level_5 SET Merge_1=0 WHERE User_ID='$sponsor'";
	              $update_1_result = mysqli_query($connection, $update_1) or die(mysqli_error($connection));
	           }
	          elseif($m1 == 1 && $m2 == 1 && $m3 == 0)
	           {
	             $update_2 = "UPDATE level_5 SET Merge_2=0 WHERE User_ID='$sponsor'";
	              $update_2_result = mysqli_query($connection, $update_2) or die(mysqli_error($connection));
	            }
	            elseif($m1 == 1 && $m2 == 1 && $m3 == 1)
	            {
	              $update_3 = "UPDATE level_5 SET Merge_3=0, completed=1 WHERE User_ID='$sponsor'";
	              $update_3_result = mysqli_query($connection, $update_3) or die(mysqli_error($connection));
	          }			
			}
		 }elseif($ben_level == 6 || $spons_level == 6)
		 {
			$reset1 = "UPDATE level_6 SET Merge=0 WHERE User_ID='$benefactor'";
		$reset1Result = mysqli_query($connection, $reset1) or die(mysqli_error($connection));

			$resetSpons1 = "SELECT * FROM level_6 WHERE User_ID='$sponsor'";
			$resetSpons1Result = mysqli_query($connection, $resetSpons1) or die(mysqli_error($connection));

		 	while($resetSpons1Row = mysqli_fetch_array($resetSpons1Result))
			{
		 		$m1 = $resetSpons1Row['Merge_1'];
				$m2 = $resetSpons1Row['Merge_2'];
				$m3 = $resetSpons1Row['Merge_3'];

				if($m1 == 1 && $m2 == 0 && $m3 == 0)
	           {
	               $update_1 = "UPDATE level_6 SET Merge_1=0 WHERE User_ID='$sponsor'";
	              $update_1_result = mysqli_query($connection, $update_1) or die(mysqli_error($connection));
	           }
	          elseif($m1 == 1 && $m2 == 1 && $m3 == 0)
	           {
	             $update_2 = "UPDATE level_6 SET Merge_2=0 WHERE User_ID='$sponsor'";
	              $update_2_result = mysqli_query($connection, $update_2) or die(mysqli_error($connection));
	            }
	            elseif($m1 == 1 && $m2 == 1 && $m3 == 1)
	            {
	              $update_3 = "UPDATE level_6 SET Merge_3=0, completed=1 WHERE User_ID='$sponsor'";
	              $update_3_result = mysqli_query($connection, $update_3) or die(mysqli_error($connection));
	          }			
			}
		 }
	}
	//Reset Users
   if(array_key_exists('transfer', $_POST))
	{
        $user = $_POST['userID'];
        $bal = $_POST['balance'];
	 	$user_pin = $_POST['user_pin'];
	 	$ben_email = $_POST['ben_email'];
	 	$transfer_amount = $_POST['transfer_amount'];
    
    if($bal >= $transfer_amount )
    {
        $senderdetails = "SELECT * FROM user WHERE User_ID = '$user'";
        $resultsenderdetails = mysqli_query($connection, $senderdetails) or die(mysqli_error($connection));
        
        while($sender_row = mysqli_fetch_array($resultsenderdetails))
              {
                  $confirmpin = $sender_row['PIN'];
              }
        if ($confirmpin == $user_pin)
        {
            $bendetails = "SELECT * FROM user WHERE Email = '$ben_email'";
            $resultbendetails = mysqli_query($connection, $bendetails) or die(mysqli_error($connection));

            while($ben_row = mysqli_fetch_array($resultbendetails))
                  {
                      $ben_id = $ben_row['User_ID'];
                  }
             if($bendetails && mysqli_affected_rows($connection) == 1)
             {
                 
            $transferfund = "UPDATE e_wallet SET Amount=Amount+$transfer_amount WHERE User_ID='$ben_id'";
            $resulttransferfund = mysqli_query($connection, $transferfund) or die(mysqli_error($connection));
            
            $removefund = "UPDATE e_wallet SET Amount=Amount-$transfer_amount WHERE User_ID='$user'";
            $resultremovefund = mysqli_query($connection, $removefund) or die(mysqli_error($connection));
            
            $transferfundhistory = "INSERT INTO e_wallet_history(Transaction_Type, Sender_ID, Receiver_ID, Amount) VALUES ('Recharge', '{$user}', '{$ben_id}', '{$transfer_amount}')";
            $resulttransferfundhistory = mysqli_query($connection, $transferfundhistory) or die(mysqli_error($connection));
                 
            header('Location: success.php?m=success');
            exit;
                 
             }else
            {
               $error['upError']='<p class="alert alert-danger">Invalid Email</p>'; 
                
            }
            
            
        }else
        {
            $error['upError']='<p class="alert alert-danger">Invalid PIN</p>';
            
        }
        
    }else
    {
        $error_f ['upError']='<p class="alert alert-danger">Insufficient Funds</p>';
        
    }
    

    }

 ?>