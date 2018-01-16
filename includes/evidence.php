<?php 
ob_start();
require_once 'functions.php'; 
?>
<?php
	$success = array();
	$error = array();

	//merge udpate
	if(array_key_exists('payUp', $_POST))
	{
		$u_ID = $_POST['userID'];
		$s_ID = $_POST['sponsorID'];
		$merge_ID = $_POST['ID'];

		$trans = mysql_prep($_POST['transType']);
		$amount = mysql_prep($_POST['amount']);
		$bnk = mysql_prep($_POST['BankName']);
		$other = mysql_prep($_POST['other']);
		$rec = mysql_prep($_POST['rec_acc']);
		$branch = mysql_prep($_POST['branch']);
		$teller = mysql_prep($_POST['teller']);

		$img = $_FILES['payImg']['name'];
		$img_tmp = $_FILES['payImg']['tmp_name'];

		$salt = date('Y-m-d H:i:s');
		$image_salt = date('d-m-Y-H-i');
		$evi = $image_salt.$img;

		if(count($error) == 0)
		{
			move_uploaded_file($img_tmp, "../assets/images/evidence/$evi");

			$evi_update = "UPDATE merge SET Trans_Type='$trans', Amount='$amount', Banks='$bnk', Other_Details='$other', Rec_Acc_Num='$rec', Branch='$branch', Teller_No='$teller', Image='$evi', Ben_Con=1, Evi_Date='$salt' WHERE id='$merge_ID'";
			$evi_result = mysqli_query($connection, $evi_update) or die(mysqli_error($connection));

			if($evi_result)
			{
				        header('Location: success.php?m=success');
                        exit;

			}
			else
			{
				$error['upError']='<p class="alert alert-danger">there may be a few errors</p>';
			}
		}
        
        header('Location: success.php?m=success');
        exit;

	}
	//end merge update


	//cds Update
	if(array_key_exists('cdsPay', $_POST))
	{
		$user = $_POST['userID'];

		$agent = mysql_prep($_POST['agentName']);
		$type = mysql_prep($_POST['transType']);
		$amount = mysql_prep($_POST['amount']);
		$bnkName = mysql_prep($_POST['BankName']);
		$other = mysql_prep($_POST['other']);
		$rec = mysql_prep($_POST['rec_acc']);
		$tell = mysql_prep($_POST['teller']);
		$paymentType = mysql_prep($_POST['payType']);
		$lvl4cds = mysql_prep($_POST['cdsLevel4']);
		$agentid = mysql_prep($_POST['agentid']);

		$cdsEvi = $_FILES['cdsImg']['name'];
		$cdsEvi_tmp = $_FILES['cdsImg']['tmp_name'];

		$salt = date('d-m-Y-H-i');
		$evi = $salt.$cdsEvi;

		if(count($error) == 0)
		{
			move_uploaded_file($cdsEvi_tmp, "../assets/images/cds/$evi");

			$cdsUpdate = "UPDATE cds SET Agent_ID='$agentid', Bank_Name='$bnkName', Pay_Method='$paymentType', Amount='$amount', Payment_type='$type', Depositor_name='$other', Rec_Acc='$rec', Teller_Number='$tell', Evidence='$evi', Evi_date='$salt', paid=0, paid_4='no' WHERE User_ID='$user'";
			$cdsResult = mysqli_query($connection, $cdsUpdate) or die(mysqli_error($connection));

			if($cdsResult)
			{
				        

			}
			else
			{
				$error['upError']='<p class="alert alert-danger">there may be a few errors</p>';
			}

			move_uploaded_file($cdsEvi_tmp, "../assets/images/history/$evi");

			$cdsHistory = "INSERT INTO cds_history(User_ID, Agent_ID, Bank_Name, Pay_Method, Amount, Payment_type, Depositor_name, Rec_Acc, Teller_Number, Evidence, Evi_date, paid, paid_4)VALUES('{$user}', '{$agentid}', '{$bnkName}', '{$paymentType}', '{$amount}', '{$type}', '{$other}', '{$rec}', '{$tell}', '{$evi}', '{$salt}', 0, 'no')";

			$cdsHistoryResult = mysqli_query($connection, $cdsHistory) or die(mysqli_error($connection));

			$del_book = "DELETE FROM book_cds WHERE User_ID='$user'";
			$del_book_result = mysqli_query($connection, $del_book) or die(mysqli_error($connection));
            
            header('Location: success.php?m=success');
            exit;
            
		}
        
        header('Location: success.php?m=success');
        exit;
	}
	//end cds Update

//suspension update Update
	if(array_key_exists('paid_suspension', $_POST))
	{
		$user = $_POST['User_ID'];
        $agent_id = $_POST['paid_agent'];
        $amount = $_POST['paid_amount'];
        
        $del_book = "DELETE FROM book_cds WHERE User_ID='$user'";
        $del_book_result = mysqli_query($connection, $del_book) or die(mysqli_error($connection));
        
        $updatesuspension ="UPDATE suspension SET Agent_ID='$agent_id', request=1, amount='$amount' WHERE User_ID='$user'";
        $updatesuspension_result = mysqli_query($connection, $updatesuspension) or die(mysqli_error($connection));
        
        header('Location: success.php?m=success');
        exit;
	}

	if(array_key_exists('paid_suspension_e', $_POST))
	{
		$user = $_POST['id'];
        $type = $_POST['type'];
        $amount = $_POST['total'];
        
        
        $updatesuspension ="UPDATE suspension SET other_method='$type', request=1, amount='$amount' WHERE User_ID='$user'";
        $updatesuspension_result = mysqli_query($connection, $updatesuspension) or die(mysqli_error($connection));
        
        header('Location: success.php?m=success');
        exit;
	}
	//end suspension update

	//E_Wallet Update
	if(array_key_exists('eWalletPay', $_POST))
	{
		$user = $_POST['userID'];
		$required = $_POST['required'];
	 	$pay = $_POST['payType'];
	 	$ref = $_POST['refAmount'];
	 	$bal = $_POST['balance'];

	 	if($ref >= $required)
	 	{
	 		$to = $required/500;

	 		$refUpdate = "UPDATE referral SET Interest=0, Status=0 WHERE ref_ID='$user' AND Status=1 LIMIT $to";
	 		$refUpdateResult = mysqli_query($connection, $refUpdate) or die(mysqli_error($connection));
	 	}
	 	elseif($required > $ref)
	 	{
	 		$to = $ref/500;
	 		$refUpdate = "UPDATE referral SET Interest=0, Status=0 WHERE ref_ID='$user' AND Status=1 LIMIT $to";
	 		$refUpdateResult = mysqli_query($connection, $refUpdate) or die(mysqli_error($connection));

	 		$main = $required - $ref;
	 		$final = $bal - $main;

	 		$ewallet_Update = "UPDATE e_wallet SET Amount='$final' WHERE User_ID='$user'";
			$ewallet_Result = mysqli_query($connection, $ewallet_Update) or die(mysqli_error($connection));
	 	}

		$salt = date('d-m-Y-H-i');

		if(count($error) == 0)
		{
			$cdsUpdate = "UPDATE cds SET Pay_Method='e-Wallet', Amount='$required', paid=1, Completed=1 WHERE User_ID='$user'";
			$cdsResult = mysqli_query($connection, $cdsUpdate) or die(mysqli_error($connection));

			$e_wallet_cds = "INSERT INTO cds_history(User_ID, Pay_Method, Amount, paid, Completed)VALUES('{$user}', 'e-Wallet', '{$required}', 1, 1)";
			$e_wallet_cds_history = mysqli_query($connection, $e_wallet_cds) or die(mysqli_error($connection));
		}
        
        header('Location: success.php?m=success');
        exit;
	}
	//end E_Wallet Update

	//perfect pay
	if(array_key_exists('perfectButton', $_POST))
	{
		$accName = $_POST['perfectName'];
		$accNum = $_POST['perfectAcc'];
		$total = $_POST['total'];
		$type = $_POST['type'];
		$user = $_POST['id'];

		$dep_name = $accName." (".$accNum.")";

		$perfectpay = "UPDATE cds SET Pay_Method='$type', Amount='$total', Depositor_name='$dep_name', paid='0' WHERE User_ID='$user'";
		$perfectpayResult = mysqli_query($connection, $perfectpay) or die(mysqli_error($connection));

		$p_history = "INSERT INTO cds_history(User_ID, Pay_Method, Amount, Depositor_name, paid)VALUES('{$user}', '{$type}', '{$total}', '{$dep_name}', 0)";
		$p_history_result = mysqli_query($connection, $p_history) or die(mysqli_error($connection));
        
        header('Location: success.php?m=success');
        exit;
	}
	//perfect pay

	//book button
	if(array_key_exists('book', $_POST))
	{
		$user = $_POST['Book_user'];
		$agent = $_POST['Book_agent'];
		$amount = $_POST['Book_amount'];
		$agentamount = $_POST['agent_amount'];
		$book_type = $_POST['Book_type'];
        
    if($agentamount == 5250)
    { $b_amount="5000";    
    }elseif($agentamount == 6300)
    { $b_amount="6000";    
    }elseif($agentamount == 12400)
    {$b_amount="12000";    
    }elseif($agentamount == 18600)
    {$b_amount="18000";    
    }elseif($agentamount == 30800)
    {$b_amount="30000";    
    }elseif($agentamount == 46000)
    {$b_amount="45000";    
    }elseif($agentamount == 10250)
    {$b_amount="10000";    
    }

        $checkbook = "SELECT * FROM book_cds WHERE User_ID='$user' AND Agent_ID='$agent'";
        $checkbook_result = mysqli_query($connection, $checkbook) or die(mysqli_error($connection));
            
        if(mysqli_num_rows($checkbook_result) == 0)
        {
            
		$bookInsert = "INSERT INTO book_cds(User_ID, Agent_ID, Amount, book_type)VALUES('{$user}', '{$agent}', '{$b_amount}','{$book_type}')";
		$bookInsertResult = mysqli_query($connection, $bookInsert) or die(mysqli_error($connection));
            
        $wallet = "UPDATE e_wallet SET Amount=Amount-$b_amount, Book_Balance=Book_Balance+$b_amount WHERE User_ID='$agent'";
		$walletresult = mysqli_query($connection, $wallet) or die(mysqli_error($connection));
            
        }

        header('Location: booking.php?m=success&amount='.$amount. '&agentamount='.$agentamount);
        exit;
	}
	//book button

//transfer fund from ewallet to another ewallet

if(array_key_exists('transfer', $_POST))
	{
        $user = $_POST['userID'];
        $bal = $_POST['balance'];
	 	$user_pin = $_POST['user_pin'];
	 	$ben_name = $_POST['ben_name'];
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
            
            $transferfundhistory = "INSERT INTO e_wallet_history(Transaction_Type, Sender_ID, Receiver_ID, Amount) VALUES ('Funds Transfer', '{$user}', '{$ben_id}', '{$transfer_amount}')";
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


//transfer fund from ewallet to another ewallet
 ?>
