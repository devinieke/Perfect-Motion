<?php 
ob_start();
require_once 'functions.php'; 
?>
<?php
  $success = array();
  $error = array();

  //cds History Update
  if(array_key_exists('agentUpdate', $_POST))
  {
    $user = $_POST['userCds'];
    $agent = $_POST['agentCds'];
    $level = $_POST['userLevel'];
    $b_amount = $_POST['amountagent'];
      
    if($b_amount == 5250)
    { $b_amount="5000";    
    }elseif($b_amount == 6300)
    { $b_amount="6000";    
    }elseif($b_amount == 12400)
    {$b_amount="12000";    
    }elseif($b_amount == 18600)
    {$b_amount="18000";    
    }elseif($b_amount == 30800)
    {$b_amount="30000";    
    }elseif($b_amount == 46000)
    {$b_amount="45000";    
    }

      $checkbalance = "SELECT * FROM cds WHERE User_ID='$user' AND Agent_ID='$agent' AND paid=1";
      $checkbalance_result = mysqli_query($connection, $checkbalance) or die(mysqli_error($connection));
      
      if(mysqli_num_rows($checkbalance_result) == 0)
      {
      $wallet = "UPDATE e_wallet SET Book_Balance=Book_Balance-$b_amount WHERE User_ID='$agent'";
      $walletresult = mysqli_query($connection, $wallet) or die(mysqli_error($connection)); 
      }
 
  
      $cdsUpdate = "UPDATE cds SET paid=1, Completed=1 WHERE User_ID='$user' AND Agent_ID='$agent'";
      $cdsUpdateResult = mysqli_query($connection, $cdsUpdate) or die(mysqli_error($connection));

      $cdsHistory = "UPDATE cds_history SET paid=1, Completed=1 WHERE Agent_ID='$agent' AND User_ID='$user'";
      $cdsHistory = mysqli_query($connection, $cdsHistory) or die(mysqli_error($connection));
      
      
  
      header('Location: agent.php?m=success');
      exit;
  }
  //cds History Update

  //bonus request
  if(array_key_exists('bonusPay', $_POST))
  {
    $user = $_POST['requestID'];

    $userConfirm = "SELECT * FROM user WHERE User_ID='$user'";
    $userConfirmResult = mysqli_query($connection, $userConfirm) or die(mysqli_error($connection));

    while($userConfirmRow = mysqli_fetch_array($userConfirmResult))
    {
      $userConfirmSalt = $userConfirmRow['Salt'];
    }

    $bonusRequest = "UPDATE bonus SET payout=1 WHERE Salt='$userConfirmSalt'";
    $bonusRequestResult = mysqli_query($connection, $bonusRequest) or die(mysqli_error($connection));

    if($bonusRequest)
    {
      $success['bonus'] = '<p class="alert alert-success">Request received.</p>';
    }
  }
  //bonus request

  //complete request
  if(array_key_exists('completePay', $_POST))
  {
    $user = $_POST['compID'];
    $comp = $_POST['total_Val'];

    $insertRef = "INSERT INTO ref_payout_request(ref_ID, Amount, payout_status)VALUES('{$user}', '{$comp}', '0')";
    $insertRefResult = mysqli_query($connection, $insertRef) or die(mysqli_error($connection));

    $completeRequest = "UPDATE referral SET payout=1 WHERE ref_ID='$user' AND Status=1";
    $completeResult = mysqli_query($connection, $completeRequest) or die(mysqli_error($connection));

    if($completeRequest)
    {
      $success['complete'] = '<p class="alert alert-success">Request received.</p>';
    }
  }
  //complete request

  //recycle button

  //recycle button

//confirm for level 1
  if(array_key_exists('conPay', $_POST))
  {
    $s_ID = $_POST['spons'];
    $b_ID = $_POST['ben'];
    $mergeID = $_POST['mergeID'];
      
      
    $rCode = "SELECT * FROM user WHERE User_ID='$b_ID'";
    $rCodeResult = mysqli_query($connection, $rCode) or die(mysqli_error($connection));

    while($rCodeRow = mysqli_fetch_array($rCodeResult))
    {
     $Bensalt = $rCodeRow['Salt'];

    $bonus = "SELECT * FROM referral WHERE Ben_ID='$Bensalt' AND Status=0";
    $bonusResult = mysqli_query($connection, $bonus) or die(mysqli_error($connection));
        
     if(mysqli_affected_rows($connection) == 1)
    {
      $bUpdate = "UPDATE referral SET Status=1 WHERE Ben_ID='$Bensalt'";
      $bUpdateResult = mysqli_query($connection, $bUpdate) or die(mysqli_error($connection));
    }
    }

    $mUpdate = "UPDATE merge SET Spons_Con=1 WHERE id='$mergeID'";
    $mUpdateResult = mysqli_query($connection, $mUpdate) or die(mysqli_error($connection));

    $lvlUpdate = "UPDATE level_0 SET Active=0 WHERE Salt='$Bensalt'";
    $lvlResult = mysqli_query($connection, $lvlUpdate) or die(mysqli_error($connection));

    $userUpdate = "UPDATE user SET Level=1, Stars=Stars+1 WHERE User_ID=$b_ID";
    $userResult = mysqli_query($connection, $userUpdate) or die(mysqli_error($connection));
      
    //check position
      
    $bCode = "SELECT * FROM user WHERE User_ID='$b_ID'";
    $bCodeResult = mysqli_query($connection, $bCode) or die(mysqli_error($connection));

    while($bCodeRow = mysqli_fetch_array($bCodeResult))
    {
      $salt = $bCodeRow['Salt'];
    }
    
    $check_position = "SELECT * FROM merge_tree WHERE Ben_ID='$salt'";
    $check_position_result = mysqli_query($connection, $check_position) or die(mysqli_error($connection));
      
    while($check_position_row = mysqli_fetch_array($check_position_result))
    {
        $position = $check_position_row ['Position'];
    }

    $lvl_check = "SELECT * FROM level_1 WHERE User_ID='$b_ID'";
    $lvl_check_result = mysqli_query($connection, $lvl_check) or die($mysqli_error($connection));

    if($lvl_check && mysqli_affected_rows($connection) == 0)
    {
      $lvl_Insert = "INSERT INTO level_1(User_ID, Salt, Active, Merge, Merge_1, Merge_2, Merge_3, completed, Position)VALUES('{$b_ID}', '{$salt}', '1', '0', '0', '0', '0', '0', '{$position}')";
      $lvl_Insert_result = mysqli_query($connection, $lvl_Insert) or die(mysqli_error($connection));
    }
    else
    {
      $newlvl = "UPDATE level_1 SET Active=1, Merge=0, Merge_1=0, Merge_2=0, Merge_3=0, completed=0, Position='$position', ben_1=0, ben_2=0, ben_3=0, Created=now() WHERE User_ID='$b_ID'";
      $newlvlResult = mysqli_query($connection, $newlvl) or die(mysqli_error($connection));
    }
   


  }
  //confirm for level 1

  //confirm for level 2
  if(array_key_exists('conPay2', $_POST))
  {
    $s_ID = $_POST['spons'];
    $b_ID = $_POST['ben'];
    $merge2 = $_POST['merge2'];

    $mUpdate = "UPDATE merge SET Spons_Con=1 WHERE id='$merge2'";
    $mUpdateResult = mysqli_query($connection, $mUpdate) or die(mysqli_error($connection));

    $lvlUpdate = "UPDATE level_1 SET Active=0 WHERE User_ID='$b_ID'";
    $lvlResult = mysqli_query($connection, $lvlUpdate) or die(mysqli_error($connection));

    $userUpdate = "UPDATE user SET Level=2 WHERE User_ID=$b_ID";
    $userResult = mysqli_query($connection, $userUpdate) or die(mysqli_error($connection));
      
    $del_merge_tree = "DELETE FROM merge_tree WHERE ref_ID='$b_ID'";
    $del_merge_tree_result = mysqli_query($connection, $del_merge_tree) or die($mysqli_error($connection));

          
    //check position
      
    $bCode = "SELECT * FROM user WHERE User_ID='$b_ID'";
    $bCodeResult = mysqli_query($connection, $bCode) or die(mysqli_error($connection));

    while($bCodeRow = mysqli_fetch_array($bCodeResult))
    {
      $salt = $bCodeRow['Salt'];
    }
    
    $check_position = "SELECT * FROM merge_tree WHERE Ben_ID='$salt'";
    $check_position_result = mysqli_query($connection, $check_position) or die(mysqli_error($connection));
      
    while($check_position_row = mysqli_fetch_array($check_position_result))
    {
        $position = $check_position_row ['Position'];
    }
      
    $lvl_check = "SELECT * FROM level_2 WHERE User_ID='$b_ID'";
    $lvl_check_result = mysqli_query($connection, $lvl_check) or die($mysqli_error($connection));
      

    if($lvl_check && mysqli_affected_rows($connection) == 0)
    {
      $lvl_Insert = "INSERT INTO level_2(User_ID, Active, Merge, Merge_1, Merge_2, Merge_3, completed, Position)VALUES('{$b_ID}', '1', '0', '0', '0', '0', '0', '{$position}')";
      $lvl_Insert_result = mysqli_query($connection, $lvl_Insert) or die(mysqli_error($connection));
    }
    else
    {
      $newlvl = "UPDATE level_2 SET Active=1, Merge=0, Merge_1=0, Merge_2=0, Merge_3=0, completed=0, Position='$position', ben_1=0, ben_2=0, ben_3=0, Created=now() WHERE User_ID='$b_ID'";
      $newlvlResult = mysqli_query($connection, $newlvl) or die(mysqli_error($connection));
    }


    $resetCDS = "UPDATE cds SET Agent_ID='', Bank_Name='', Amount='', Payment_type='', Depositor_name='', Rec_Acc='', Teller_number='', Pay_Method='', Completed=0, paid=0, Evidence='', Evi_date='' WHERE User_ID='$b_ID'";
    $resetResult = mysqli_query($connection, $resetCDS) or die(mysqli_error($connection));
      
        
    
  }
  //confirm for level 2

  //confirm for level 3
  if(array_key_exists('conPay3', $_POST))
  {
    $s_ID = $_POST['spons'];
    $b_ID = $_POST['ben'];
    $merge2 = $_POST['merge2'];

    $mUpdate = "UPDATE merge SET Spons_Con=1 WHERE id='$merge2'";
    $mUpdateResult = mysqli_query($connection, $mUpdate) or die(mysqli_error($connection));

    $lvlUpdate = "UPDATE level_2 SET Active=0 WHERE User_ID='$b_ID'";
    $lvlResult = mysqli_query($connection, $lvlUpdate) or die(mysqli_error($connection));

    $userUpdate = "UPDATE user SET Level=3 WHERE User_ID=$b_ID";
    $userResult = mysqli_query($connection, $userUpdate) or die(mysqli_error($connection));
      
    $del_merge_tree = "DELETE FROM merge_tree WHERE ref_ID='$b_ID'";
    $del_merge_tree_result = mysqli_query($connection, $del_merge_tree) or die($mysqli_error($connection));
   
    //check position
      
    $bCode = "SELECT * FROM user WHERE User_ID='$b_ID'";
    $bCodeResult = mysqli_query($connection, $bCode) or die(mysqli_error($connection));

    while($bCodeRow = mysqli_fetch_array($bCodeResult))
    {
      $salt = $bCodeRow['Salt'];
    }
    
    $check_position = "SELECT * FROM merge_tree WHERE Ben_ID='$salt'";
    $check_position_result = mysqli_query($connection, $check_position) or die(mysqli_error($connection));
      
    while($check_position_row = mysqli_fetch_array($check_position_result))
    {
        $position = $check_position_row ['Position'];
    }

    $lvl_check = "SELECT * FROM level_3 WHERE User_ID='$b_ID'";
    $lvl_check_result = mysqli_query($connection, $lvl_check) or die($mysqli_error($connection));
    

    if($lvl_check && mysqli_affected_rows($connection) == 0)
    {
      $lvl_Insert = "INSERT INTO level_3(User_ID, Active, Merge, Merge_1, Merge_2, Merge_3, completed, Position)VALUES('{$b_ID}', '1', '0', '0', '0', '0', '0', '{$position}')";
      $lvl_Insert_result = mysqli_query($connection, $lvl_Insert) or die(mysqli_error($connection));
    }
    else
    {
      $newlvl = "UPDATE level_3 SET Active=1, Merge=0, Merge_1=0, Merge_2=0, Merge_3=0, completed=0, Position='$position', ben_1=0, ben_2=0, ben_3=0, Created=now() WHERE User_ID='$b_ID'";
      $newlvlResult = mysqli_query($connection, $newlvl) or die(mysqli_error($connection));
    }

    $resetCDS = "UPDATE cds SET Agent_ID='', Bank_Name='', Amount='', Payment_type='', Depositor_name='', Rec_Acc='', Teller_number='', Pay_Method='', Completed=0, paid=0, Evidence='', Evi_date='' WHERE User_ID='$b_ID'";
    $resetResult = mysqli_query($connection, $resetCDS) or die(mysqli_error($connection));
  }
  //confirm for level 3

  //confirm for level 4
  if(array_key_exists('conPay4', $_POST))
  {
    $s_ID = $_POST['spons'];
    $b_ID = $_POST['ben'];
    $merge2 = $_POST['merge2'];

    $mUpdate = "UPDATE merge SET Spons_Con=1 WHERE id='$merge2'";
    $mUpdateResult = mysqli_query($connection, $mUpdate) or die(mysqli_error($connection));

    $lvlUpdate = "UPDATE level_3 SET Active=0 WHERE User_ID='$b_ID'";
    $lvlResult = mysqli_query($connection, $lvlUpdate) or die(mysqli_error($connection));

    $userUpdate = "UPDATE user SET Level=4 WHERE User_ID=$b_ID";
    $userResult = mysqli_query($connection, $userUpdate) or die(mysqli_error($connection));
      
    $del_merge_tree = "DELETE FROM merge_tree WHERE ref_ID='$b_ID'";
    $del_merge_tree_result = mysqli_query($connection, $del_merge_tree) or die($mysqli_error($connection));
   
    //check position
      
    $bCode = "SELECT * FROM user WHERE User_ID='$b_ID'";
    $bCodeResult = mysqli_query($connection, $bCode) or die(mysqli_error($connection));

    while($bCodeRow = mysqli_fetch_array($bCodeResult))
    {
      $salt = $bCodeRow['Salt'];
    }
    
    $check_position = "SELECT * FROM merge_tree WHERE Ben_ID='$salt'";
    $check_position_result = mysqli_query($connection, $check_position) or die(mysqli_error($connection));
      
    while($check_position_row = mysqli_fetch_array($check_position_result))
    {
        $position = $check_position_row ['Position'];
    }

    $lvl_check = "SELECT * FROM level_4 WHERE User_ID='$b_ID'";
    $lvl_check_result = mysqli_query($connection, $lvl_check) or die($mysqli_error($connection));

    if($lvl_check && mysqli_affected_rows($connection) == 0)
    {
      $lvl_Insert = "INSERT INTO level_4(User_ID, Active, Merge, Merge_1, Merge_2, Merge_3, completed, Position)VALUES('{$b_ID}', '1', '0', '0', '0', '0', '0', '{$position}')";
      $lvl_Insert_result = mysqli_query($connection, $lvl_Insert) or die(mysqli_error($connection));
    }
    else
    {
      $newlvl = "UPDATE level_4 SET Active=1, Merge=0, Merge_1=0, Merge_2=0, Merge_3=0, completed=0, Position='$position', ben_1=0, ben_2=0, ben_3=0, Created=now() WHERE User_ID='$b_ID'";
      $newlvlResult = mysqli_query($connection, $newlvl) or die(mysqli_error($connection));
    }

    $resetCDS = "UPDATE cds SET Agent_ID='', Bank_Name='', Amount='', Payment_type='', Depositor_name='', Rec_Acc='', Teller_number='', Pay_Method='', Completed=0, paid=0, Evidence='', Evi_date='' WHERE User_ID='$b_ID'";
    $resetResult = mysqli_query($connection, $resetCDS) or die(mysqli_error($connection));
  }
  //confirm for level 4

  //confirm for level 5
  if(array_key_exists('conPay5', $_POST))
  {
    $s_ID = $_POST['spons'];
    $b_ID = $_POST['ben'];
    $merge2 = $_POST['merge2'];

    $mUpdate = "UPDATE merge SET Spons_Con=1 WHERE id='$merge2'";
    $mUpdateResult = mysqli_query($connection, $mUpdate) or die(mysqli_error($connection));

    $lvlUpdate = "UPDATE level_4 SET Active=0 WHERE User_ID='$b_ID'";
    $lvlResult = mysqli_query($connection, $lvlUpdate) or die(mysqli_error($connection));

    $userUpdate = "UPDATE user SET Level=5 WHERE User_ID=$b_ID";
    $userResult = mysqli_query($connection, $userUpdate) or die(mysqli_error($connection));
    
      
    $del_merge_tree = "DELETE FROM merge_tree WHERE ref_ID='$b_ID'";
    $del_merge_tree_result = mysqli_query($connection, $del_merge_tree) or die($mysqli_error($connection));
    //check position
      
    $bCode = "SELECT * FROM user WHERE User_ID='$b_ID'";
    $bCodeResult = mysqli_query($connection, $bCode) or die(mysqli_error($connection));

    while($bCodeRow = mysqli_fetch_array($bCodeResult))
    {
      $salt = $bCodeRow['Salt'];
    }
    
    $check_position = "SELECT * FROM merge_tree WHERE Ben_ID='$salt'";
    $check_position_result = mysqli_query($connection, $check_position) or die(mysqli_error($connection));
      
    while($check_position_row = mysqli_fetch_array($check_position_result))
    {
        $position = $check_position_row ['Position'];
    }

    $lvl_check = "SELECT * FROM level_5 WHERE User_ID='$b_ID'";
    $lvl_check_result = mysqli_query($connection, $lvl_check) or die($mysqli_error($connection));

    if($lvl_check && mysqli_affected_rows($connection) == 0)
    {
      $lvl_Insert = "INSERT INTO level_5(User_ID, Active, Merge, Merge_1, Merge_2, Merge_3, completed, Position)VALUES('{$b_ID}', '1', '0', '0', '0', '0', '0', '{$position}')";
      $lvl_Insert_result = mysqli_query($connection, $lvl_Insert) or die(mysqli_error($connection));
    }
    else
    {
      $newlvl = "UPDATE level_5 SET Active=1, Merge=0, Merge_1=0, Merge_2=0, Merge_3=0, completed=0, Position='$position', ben_1=0, ben_2=0, ben_3=0, Created=now() WHERE User_ID='$b_ID'";
      $newlvlResult = mysqli_query($connection, $newlvl) or die(mysqli_error($connection));
    }

    $resetCDS = "UPDATE cds SET Agent_ID='', Bank_Name='', Amount='', Payment_type='', Depositor_name='', Rec_Acc='', Pay_Method='', Completed=0, Teller_number='', paid=0, Evidence='', Evi_date='' WHERE User_ID='$b_ID'";
    $resetResult = mysqli_query($connection, $resetCDS) or die(mysqli_error($connection));
  }
  //confirm for level 5



 //confirm for level 
  if(array_key_exists('conPay6', $_POST))
  {
    $s_ID = $_POST['spons'];
    $b_ID = $_POST['ben'];
    $merge2 = $_POST['merge2'];

    $mUpdate = "UPDATE merge SET Spons_Con=1 WHERE id='$merge2'";
    $mUpdateResult = mysqli_query($connection, $mUpdate) or die(mysqli_error($connection));

    $lvlUpdate = "UPDATE level_5 SET Active=0 WHERE User_ID='$b_ID'";
    $lvlResult = mysqli_query($connection, $lvlUpdate) or die(mysqli_error($connection));

    $userUpdate = "UPDATE user SET Level=6 WHERE User_ID=$b_ID";
    $userResult = mysqli_query($connection, $userUpdate) or die(mysqli_error($connection));
      
    $del_merge_tree = "DELETE FROM merge_tree WHERE ref_ID='$b_ID'";
    $del_merge_tree_result = mysqli_query($connection, $del_merge_tree) or die($mysqli_error($connection));
      
    //check position
      
    $bCode = "SELECT * FROM user WHERE User_ID='$b_ID'";
    $bCodeResult = mysqli_query($connection, $bCode) or die(mysqli_error($connection));

    while($bCodeRow = mysqli_fetch_array($bCodeResult))
    {
      $salt = $bCodeRow['Salt'];
    }
    
    $check_position = "SELECT * FROM merge_tree WHERE Ben_ID='$salt'";
    $check_position_result = mysqli_query($connection, $check_position) or die(mysqli_error($connection));
      
    while($check_position_row = mysqli_fetch_array($check_position_result))
    {
        $position = $check_position_row ['Position'];
    }

    $lvl_check = "SELECT * FROM level_6 WHERE User_ID='$b_ID'";
    $lvl_check_result = mysqli_query($connection, $lvl_check) or die($mysqli_error($connection));

    if($lvl_check && mysqli_affected_rows($connection) == 0)
    {
      $lvl_Insert = "INSERT INTO level_6(User_ID, Active, Merge, Merge_1, Merge_2, Merge_3, completed, Position)VALUES('{$b_ID}', '1', '0', '0', '0', '0', '0', '{$position}')";
      $lvl_Insert_result = mysqli_query($connection, $lvl_Insert) or die(mysqli_error($connection));
    }
    else
    {
      $newlvl = "UPDATE level_6 SET Active=1, Merge=0, Merge_1=0, Merge_2=0, Merge_3=0, completed=0, Position='$position', ben_1=0, ben_2=0, ben_3=0, Created=now() WHERE User_ID='$b_ID'";
      $newlvlResult = mysqli_query($connection, $newlvl) or die(mysqli_error($connection));
    }

    $resetCDS = "UPDATE cds SET Agent_ID='', Bank_Name='', Amount='', Payment_type='', Depositor_name='', Rec_Acc='', Teller_number='', Pay_Method='', Completed=0, paid=0, Evidence='', Evi_date='' WHERE User_ID='$b_ID'";
    $resetResult = mysqli_query($connection, $resetCDS) or die(mysqli_error($connection));
  }
  //confirm for level 6

//confirm for level  7 (elite)
  if(array_key_exists('elite', $_POST))
  {
    $s_ID = $_POST['startID'];


    $lvlUpdate = "UPDATE level_6 SET Active=0 WHERE User_ID='$s_ID'";
    $lvlResult = mysqli_query($connection, $lvlUpdate) or die(mysqli_error($connection));

    $userUpdate = "UPDATE user SET Level=7 WHERE User_ID=$s_ID";
    $userResult = mysqli_query($connection, $userUpdate) or die(mysqli_error($connection));
    
      
    $resetCDS = "UPDATE cds SET Agent_ID='', Bank_Name='', Amount='', Payment_type='', Depositor_name='', Rec_Acc='', Teller_number='', Pay_Method='', Completed=0, paid=0, Evidence='', Evi_date='' WHERE User_ID='$b_ID'";
    $resetResult = mysqli_query($connection, $resetCDS) or die(mysqli_error($connection));
    
    
  }
  //confirm for level 6
 ?>
