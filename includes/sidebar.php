<?php



  // regular user_session timeout
  if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600))
  {
      // last request was more than 30 minutes ago
      session_unset();     // unset $_SESSION variable for the run-time 
      session_destroy();   // destroy session data in storage
      header("Location: ../login.php?session_expired=yes");
      exit;
  }
  $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
  // regular session timeout
 ?>

 <?php
// reset merge 
$timer = date("Y-m-d H:i:s",time());
$test = strtotime($timer);
$diff = $test - 129600;
$converdiff =  date("Y-m-d H:i:s",$diff);

$check_expired = "SELECT * FROM merge WHERE Created<'$converdiff' AND Ben_Con=0";
$check_expired_result = mysqli_query($connection, $check_expired) or die(mysqli_error($connection));

while($check_expired_row = mysqli_fetch_array($check_expired_result))
{
    $sponsor = $check_expired_row['Spons_ID'];
	$benefactor = $check_expired_row['Ben_ID'];
	$merge_id = $check_expired_row['id'];

    $entryCheck = "SELECT * FROM user WHERE User_ID='$sponsor'";
    $entryCheckResult = mysqli_query($connection, $entryCheck) or die(mysqli_error($connection));
    while($entryCheckRow = mysqli_fetch_array($entryCheckResult))
        {
            $spons_level = $entryCheckRow['Level'];

            $getBen = "SELECT * FROM user WHERE User_ID='$benefactor'";
            $getBenResult = mysqli_query($connection, $getBen) or die(mysqli_error($connection));

            while($getBenRow = mysqli_fetch_array($getBenResult))
            {
                $ben_level = $getBenRow['Level'];
                $ben_salt = $getBenRow['Salt'];
      
        $deleteMerge = "DELETE FROM merge WHERE id='$merge_id'";
		$deleteMergeResult = mysqli_query($connection, $deleteMerge) or die(mysqli_error($connection));


		if($ben_level == 0 && $spons_level == 1)
		{
			//first delete from merge_2_tree
            
        $deletetree = "DELETE FROM merge_2_tree WHERE Ben_ID='$ben_salt'";
		$deletetreeResult = mysqli_query($connection, $deletetree) or die(mysqli_error($connection));
            
            $reset0 = "UPDATE level_0 SET Merge=0 WHERE User_ID='$benefactor'";
			$reset0Result = mysqli_query($connection, $reset0) or die(mysqli_error($connection));
            
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
		elseif($ben_level == 1 && $spons_level == 2)
		{
			$reset1 = "UPDATE level_1 SET Merge=0 WHERE User_ID='$benefactor'";
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
		elseif($ben_level == 2 && $spons_level == 3)
		{
			$reset1 = "UPDATE level_2 SET Merge=0 WHERE User_ID='$benefactor'";
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
			
		}elseif($ben_level == 2 && $spons_level == 4)
		{
			$reset1 = "UPDATE level_2 SET Merge=0 WHERE User_ID='$benefactor'";
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
			
		}
		 elseif($ben_level == 3 && $spons_level == 4)
		 {
			$reset1 = "UPDATE level_3 SET Merge=0 WHERE User_ID='$benefactor'";
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

			
		 }elseif($ben_level == 3 && $spons_level == 5)
		 {
			$reset1 = "UPDATE level_3 SET Merge=0 WHERE User_ID='$benefactor'";
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

			
		 }elseif($ben_level == 4 && $spons_level == 5)
		 {
        
             $reset1 = "UPDATE level_4 SET Merge=0 WHERE User_ID='$benefactor'";
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

			
		 }elseif($ben_level == 4 && $spons_level == 6)
		 {
        
             $reset1 = "UPDATE level_4 SET Merge=0 WHERE User_ID='$benefactor'";
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

			
		 }elseif($ben_level == 5 && $spons_level == 6)
		 {
			$reset1 = "UPDATE level_5 SET Merge=0 WHERE User_ID='$benefactor'";
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
    }
    
}
/// end reset

 //book restore
 
  $ugr = $test - 43200;
  $ugs = date("Y-m-d H:i:s",$ugr);

 $b_cds = "SELECT * FROM book_cds WHERE Created<'$ugs'";
 $b_cds_result = mysqli_query($connection, $b_cds) or die(mysqli_error($connection));

 while($b_cds_row = mysqli_fetch_array($b_cds_result))
 {
  $created = $b_cds_row['Created'];
  $agent_name = $b_cds_row['Agent_ID'];
  $user_name = $b_cds_row['User_ID'];
  $money = $b_cds_row['Amount'];

    $reverse = "UPDATE e_wallet SET Amount=Amount+$money, Book_Balance=Amount-$money WHERE User_ID='$agent_name'";
    $reverseResult = mysqli_query($connection, $reverse) or die(mysqli_error($connection));

    $del = "DELETE FROM book_cds WHERE Created='$created'";
    $delresult = mysqli_query($connection, $del) or die(mysqli_error($connection));
 }
 //book restore


  ?>

<?php
	if(!isset($_SESSION['admin']))
    {
      
    }
    else
    {
      $ad = $_SESSION['admin'];
    }

    if(isset($_SESSION['username']))
    {
        $userNav = $_SESSION['username'];
    }
 ?>
<ul class="page-sidebar-menu  page-sidebar-menu-closed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
    <?php
      if($userNav)
      {
        $userlevel = "SELECT * FROM user WHERE UserName='$userNav'";
        $userResult= mysqli_query($connection, $userlevel) or die(mysqli_error($connection));

        while($navRow = mysqli_fetch_array($userResult))
        {
          $lvl = $navRow['Level'];
          $aux = $navRow['Aux_Level'];
          $agent = $navRow['Agent'];

          if($lvl == 0)
          {
    ?>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/user/dashboard.php'){?>class="nav-item start active" <?php }?>><a href="dashboard.php" class="nav-link nav-toggle"><i class="icon-home"></i><span class="title">Dashboard</span><span class="arrow"></span></a>
    </li>
    <?php
          }
          elseif($lvl == 1)
          {
    ?>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/user/dashboard_1.php'){?>class="nav-item start active" <?php }?>><a href="dashboard_1.php" class="nav-link nav-toggle"><i class="icon-home"></i><span class="title">Dashboard</span><span class="arrow"></span></a>
    </li>
    <?php
          }
          elseif($lvl == 2)
          {
    ?>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/user/dashboard_2.php'){?>class="nav-item start active" <?php }?>><a href="dashboard_2.php" class="nav-link nav-toggle"><i class="icon-home"></i><span class="title">Dashboard</span><span class="arrow"></span></a>
    </li>
    <?php
          }
          elseif($lvl == 5)
          {
    ?>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/user/dashboard_5.php'){?>class="nav-item start active" <?php }?>><a href="dashboard_5.php" class="nav-link nav-toggle"><i class="icon-home"></i><span class="title">Dashboard</span><span class="arrow"></span></a>
    </li>
    <?php
          }
            elseif($lvl == 6)
          {
    ?>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/user/dashboard_6.php'){?>class="nav-item start active" <?php }?>><a href="dashboard_6.php" class="nav-link nav-toggle"><i class="icon-home"></i><span class="title">Dashboard</span><span class="arrow"></span></a>
    </li>
    <?php
          }
            elseif($lvl == 7)
          {
    ?>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/user/dashboard_7.php'){?>class="nav-item start active" <?php }?>><a href="dashboard_7.php" class="nav-link nav-toggle"><i class="icon-home"></i><span class="title">Dashboard</span><span class="arrow"></span></a>
    </li>
    <?php
          }
          elseif($lvl == 4)
          {
    ?>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/user/dashboard_4.php'){?>class="nav-item start active" <?php }?>><a href="dashboard_4.php" class="nav-link nav-toggle"><i class="icon-home"></i><span class="title">Dashboard</span><span class="arrow"></span></a>
    </li>
    <?php
          }
          elseif($lvl == 3)
          {
    ?>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/user/dashboard_3.php'){?>class="nav-item start active" <?php }?>><a href="dashboard_3.php" class="nav-link nav-toggle"><i class="icon-home"></i><span class="title">Dashboard</span><span class="arrow"></span></a>
    </li>
    <?php
          }
        }
      }
     ?>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/user/profile.php'){?>class="nav-item start active" <?php }?>><a href="profile.php" class="nav-link nav-toggle"><i class="icon-user"></i><span class="title"> Profile</span><span class="selected"></span></a>
    </li>

    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/user/my_team.php'){?>class="nav-item start active" <?php }?>><a href="my_team.php" class="nav-link nav-toggle"><i class="icon-users"></i><span class="title">My Team</span><span class="selected"></span></a>
    </li>
    
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/user/referrals.php'){?>class="nav-item start active" <?php }?>><a href="referrals.php" class="nav-link nav-toggle"><i class="icon-user-following"></i><span class="title">Refferals</span><span class="selected"></span></a>
    </li>
    
     <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/user/myewallet.php'){?>class="nav-item start active" <?php }?>><a href="myewallet.php" class="nav-link nav-toggle"><i class="icon-wallet"></i><span class="title">My e-wallet</span><span class="selected"></span></a>
    </li>
    
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/user/referral_link.php'){?>class="nav-item start active" <?php }?>><a href="referral_link.php" class="nav-link nav-toggle"><i class="icon-link"></i><span class="title">Refferal links</span><span class="selected"></span></a>
    </li>
    
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/user/funds_transfer.php'){?>class="nav-item start active" <?php }?>><a href="funds_transfer.php" class="nav-link nav-toggle"><i class="icon-share-alt"></i><span class="title">Transfer Funds</span><span class="selected"></span></a>
    </li>
    
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/user/tickets.php'){?>class="nav-item start active" <?php }?>><a href="tickets.php" class="nav-link nav-toggle"><i class="icon-support"></i><span class="title">My tickets</span><span class="selected"></span></a>
    </li>

    <!-- <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/user/tree_manager.php'){?>class="nav-item start active" <?php }?>><a href="tree_manager.php" class="nav-link nav-toggle"><i class="icon-support"></i><span class="title">Tree Manager</span><span class="selected"></span></a>
    </li> -->

    <li <?php if($_SERVER['PHP_SELF'] == '#'){?>class="nav-item start active" <?php }?>><a href="#" class="nav-link nav-toggle"><i class="icon-earphones"></i><span class="title">Call center</span><span class="selected"></span></a>
    </li>
    <?php
      if($agent == 'yes')
      {
    ?>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/user/agent.php'){?>class="nav-item start active" <?php }?>><a href="agent.php" class="nav-link nav-toggle"><i class="fa fa-user-secret"></i><span class="title"> Agent</span><span class="selected"></span></a>
    </li>
    <?php
      } 
     ?>

    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/user/logout.php'){?>class="nav-item start active" <?php }?>><a href="logout.php" class="nav-link nav-toggle"><i class="icon-logout"></i><span class="title">Logout</span><span class="selected"></span></a>
    </li>
    <?php
    	if(isset($ad) == 'superadmin')
    	{
     ?>
     <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/admin/index.php'){?>class="nav-item start active" <?php }?>><a href="../admin/index.php" class="nav-link nav-toggle"><i class="icon-logout"></i><span class="title">Log back as admin</span><span class="selected"></span></a>
    </li>
     <?php
     	} 
      ?>
</ul>
<!-- END SIDEBAR MENU -->
