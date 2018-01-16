<?php
    ob_start();
    $mError = array();
    $mSuccess = array();


if(array_key_exists('upgrade', $_POST) || array_key_exists('upgrade2', $_POST) || array_key_exists('upgrade3', $_POST) || array_key_exists('upgrade4', $_POST) || array_key_exists('upgrade5', $_POST) )
    {
      $user = $_POST['startID'];

      $saltUser = "SELECT * FROM user WHERE User_ID='$user'";
      $saltUserResult = mysqli_query($connection, $saltUser) or die(mysqli_error($connection));

      while($getsalt = mysqli_fetch_array($saltUserResult))
      {
        $uniquesalt = $getsalt['Salt'];
      }
       ////Your first father
        $first_gen = "SELECT * FROM merge_2_tree WHERE Ben_ID='$uniquesalt'";
        $first_gen_result = mysqli_query($connection, $first_gen) or die(mysqli_error($connection));
        
        while($first_gen_row = mysqli_fetch_array($first_gen_result))
        {
            $first_gen_id= $first_gen_row['ref_ID'];
              
              $getfirstsalt= "SELECT * FROM user WHERE User_ID='$first_gen_id'";
              $getfirstsaltresult =  mysqli_query($connection, $getfirstsalt) or die(mysqli_error($connection));
              
              while($getfirstsaltrow = mysqli_fetch_array($getfirstsaltresult))
              {
                  $first_gen_salt=$getfirstsaltrow['Salt']; 
              }
            
        }
        
        ////Your Second Father
        
        $second_gen = "SELECT * FROM merge_2_tree WHERE Ben_ID='$first_gen_salt'";
        $second_gen_result = mysqli_query($connection, $second_gen) or die(mysqli_error($connection));
        
        while($second_gen_row = mysqli_fetch_array($second_gen_result))
        {
            $second_gen_id= $second_gen_row['ref_ID'];
              
              $getsecondsalt= "SELECT * FROM user WHERE User_ID='$second_gen_id'";
              $getsecondsaltresult =  mysqli_query($connection, $getsecondsalt) or die(mysqli_error($connection));
              
              while($getsecondsaltrow = mysqli_fetch_array($getsecondsaltresult))
              {
                  $second_gen_salt=$getsecondsaltrow['Salt']; 
              }
            
        }
    
        ////Your Third Father
        
        $third_gen = "SELECT * FROM merge_2_tree WHERE Ben_ID='$second_gen_salt'";
        $third_gen_result = mysqli_query($connection, $third_gen) or die(mysqli_error($connection));
        
        while($third_gen_row = mysqli_fetch_array($third_gen_result))
        {
            $third_gen_id= $third_gen_row['ref_ID'];
              
              $getthirdsalt= "SELECT * FROM user WHERE User_ID='$third_gen_id'";
              $getthirdsaltresult =  mysqli_query($connection, $getthirdsalt) or die(mysqli_error($connection));
              
              while($getthirdsaltrow = mysqli_fetch_array($getthirdsaltresult))
              {
                  $third_gen_salt=$getthirdsaltrow['Salt']; 
              }
            
        }
        
        ////Your Fourth Father
        
        $fourth_gen = "SELECT * FROM merge_2_tree WHERE Ben_ID='$third_gen_salt'";
        $fourth_gen_result = mysqli_query($connection, $fourth_gen) or die(mysqli_error($connection));
        
        while($fourth_gen_row = mysqli_fetch_array($fourth_gen_result))
        {
            $fourth_gen_id= $fourth_gen_row['ref_ID'];
              
              $getfourthsalt= "SELECT * FROM user WHERE User_ID='$fourth_gen_id'";
              $getfourthsaltresult =  mysqli_query($connection, $getfourthsalt) or die(mysqli_error($connection));
              
              while($getfourthsaltrow = mysqli_fetch_array($getfourthsaltresult))
              {
                  $fourth_gen_salt=$getfourthsaltrow['Salt']; 
              }
            
        }
        
        
                ////Your Fifth Father
        
        $fifth_gen = "SELECT * FROM merge_2_tree WHERE Ben_ID='$fourth_gen_salt'";
        $fifth_gen_result = mysqli_query($connection, $fifth_gen) or die(mysqli_error($connection));
        
        while($fifth_gen_row = mysqli_fetch_array($fifth_gen_result))
        {
            $fifth_gen_id= $fifth_gen_row['ref_ID'];
              
              $getfifthsalt= "SELECT * FROM user WHERE User_ID='$fifth_gen_id'";
              $getfifthsaltresult =  mysqli_query($connection, $getfifthsalt) or die(mysqli_error($connection));
              
              while($getfifthsaltrow = mysqli_fetch_array($getfifthsaltresult))
              {
                  $fifth_gen_salt=$getfifthsaltrow['Salt']; 
              }
            
        }
}


function merge($user_id, $sponsor_id, $user_level, $sponsor_level, $user_salt)
{
          global $connection;
          $mergeQuery = "INSERT INTO merge(Ben_ID, Spons_ID)VALUES('{$user_id}', '{$sponsor_id}')";
          $merge_test = mysqli_query($connection, $mergeQuery) or die(mysqli_error($connection));

          if($merge_test)
          {
            $mSuccess['passed'] = '<p class="alert alert-success">You have been matched successfully!</p>';
          }
          else
          {
            $mSuccess['failed'] = '<p class="alert alert-warning">No match, please try again soon.</p>';
          }

          //update level_0
          $updateLvl_0 = "UPDATE $user_level SET Merge=1 WHERE User_ID='$user_id'";
          $updateLvl_0_result = mysqli_query($connection, $updateLvl_0) or die(mysqli_error($connection));
          //update level_0

          //update level_1
          $level_1 = "SELECT * FROM $sponsor_level WHERE User_ID='$sponsor_id'";
          $level_1_result = mysqli_query($connection, $level_1) or die(mysqli_error($connection));

          while($level_1_row = mysqli_fetch_array($level_1_result))
          {
            $m1 = $level_1_row['Merge_1'];
            $m2 = $level_1_row['Merge_2'];
            $m3 = $level_1_row['Merge_3'];

            if($m1 == 0 && $m2 == 0 && $m3 == 0)
            {
              $update_1 = "UPDATE $sponsor_level SET Merge_1=1, ben_1='$user_id' WHERE User_ID='$sponsor_id'";
              $update_1_result = mysqli_query($connection, $update_1) or die(mysqli_error($connection));
                
            $insertsponsor_left ="INSERT INTO merge_tree(ref_ID, Ben_ID, Position)VALUES('{$sponsor_id}', '{$user_salt}', 'Left')";
            $insertsponsor_result_left = mysqli_query($connection, $insertsponsor_left) or die(mysqli_error($connection));
            
            }
            elseif($m1 == 1 && $m2 == 0 && $m3 == 0)
            {
              $update_2 = "UPDATE $sponsor_level SET Merge_2=1, ben_2='$user_id' WHERE User_ID='$sponsor_id'";
              $update_2_result = mysqli_query($connection, $update_2) or die(mysqli_error($connection));
                
            $insertsponsor_middle ="INSERT INTO merge_tree(ref_ID, Ben_ID, Position)VALUES('{$sponsor_id}', '{$user_salt}', 'Middle')";
            $insertsponsor_result_middle = mysqli_query($connection, $insertsponsor_middle) or die(mysqli_error($connection));
                
            }
            elseif($m1 == 1 && $m2 == 1 && $m3 == 0)
            {
              $update_3 = "UPDATE $sponsor_level SET Merge_3=1, ben_3='$user_id', completed=1 WHERE User_ID='$sponsor_id'";
              $update_3_result = mysqli_query($connection, $update_3) or die(mysqli_error($connection));
                
            $insertsponsor_right ="INSERT INTO merge_tree(ref_ID, Ben_ID, Position)VALUES('{$sponsor_id}', '{$user_salt}', 'Right')";
            $insertsponsor_result_right = mysqli_query($connection, $insertsponsor_right) or die(mysqli_error($connection));
                
            }
           }
}


function merge_2_trees($sponsor_id_2, $ben_salt)
    
{ 
         global $connection;
          $level = "SELECT * FROM level_1 WHERE User_ID='$sponsor_id_2'";
          $level_result = mysqli_query($connection, $level) or die(mysqli_error($connection));

          while($level_row = mysqli_fetch_array($level_result))
          {
            $m1 = $level_row['Merge_1'];
            $m2 = $level_row['Merge_2'];
            $m3 = $level_row['Merge_3'];

            if($m1 == 0 && $m2 == 0 && $m3 == 0)
            {
                
            $insertsponsor_left ="INSERT INTO merge_2_tree(ref_ID, Ben_ID)VALUES('{$sponsor_id_2}', '{$ben_salt}')";
            $insertsponsor_result_left = mysqli_query($connection, $insertsponsor_left) or die(mysqli_error($connection));
            
            }
            elseif($m1 == 1 && $m2 == 0 && $m3 == 0)
            {
                
            $insertsponsor_middle ="INSERT INTO merge_2_tree(ref_ID, Ben_ID)VALUES('{$sponsor_id_2}', '{$ben_salt}')";
            $insertsponsor_result_middle = mysqli_query($connection, $insertsponsor_middle) or die(mysqli_error($connection));
                
            }
            elseif($m1 == 1 && $m2 == 1 && $m3 == 0)
            {
                
            $insertsponsor_right ="INSERT INTO merge_2_tree(ref_ID, Ben_ID)VALUES('{$sponsor_id_2}', '{$ben_salt}')";
            $insertsponsor_result_right = mysqli_query($connection, $insertsponsor_right) or die(mysqli_error($connection));
                
            }
           }
}
//level_1 User will be able to merge with 6 generations
    if(array_key_exists('start', $_POST))
    {
        $user = $_POST['startID'];

        $saltUser = "SELECT * FROM user WHERE User_ID='$user'";
        $saltUserResult = mysqli_query($connection, $saltUser) or die(mysqli_error($connection));

        while($getsalt = mysqli_fetch_array($saltUserResult))
        {
          $uniquesalt = $getsalt['Salt'];
        }

          //level_1 magic
          //check for refferal
        
        $refferal = "SELECT * FROM level_1 as l INNER JOIN referral as m ON l.User_ID=m.ref_ID INNER JOIN cds as c ON l.User_ID=c.User_ID WHERE (l.completed=0 AND merge_1=0 AND Ben_ID='$uniquesalt' AND Active=1) OR (Ben_ID='$uniquesalt' AND paid=1 AND l.completed=0 AND Active=1) ORDER BY l.Created ASC LIMIT 1";
        $refferal_result = mysqli_query($connection, $refferal) or die(mysqli_error($connection));

        if($refferal && mysqli_affected_rows($connection) == 1)
        {
          while($refRow = mysqli_fetch_array($refferal_result))
          {
            $ref = $refRow['User_ID'];

            $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
              
          }
        }
        //level_1 magic end

        //insert level_1 check query
        if(mysqli_num_rows($refferal_result) == 0)
        {
       
            //Find Sponsor in referrals
        $findupper = "SELECT * FROM referral WHERE Ben_ID='$uniquesalt'";
        $findupperresult = mysqli_query($connection, $findupper) or die(mysqli_error($connection));
            
        while($findupperrow = mysqli_fetch_array($findupperresult))
          {
            $user_ref_id= $findupperrow['ref_ID'];
          }
            
            ///nested downline 1
                
          $getrefsalt= "SELECT * FROM user as u LEFT JOIN merge_2_tree as m ON u.Salt=m.Ben_ID RIGHT JOIN cds as c ON c.User_ID=u.User_ID RIGHT JOIN level_1 as l ON l.User_ID=u.User_ID WHERE (l.completed=0 AND merge_1=0 AND Active=1 AND m.ref_ID='$user_ref_id') OR (paid=1 AND l.completed=0 AND Active=1 AND m.ref_ID='$user_ref_id') ORDER BY l.Created ASC LIMIT 1";
          $getrefsaltresult =  mysqli_query($connection, $getrefsalt) or die(mysqli_error($connection));

              
        if($getrefsalt && mysqli_affected_rows($connection) == 1)
            
        {
                    
              while($getrefsaltrow = mysqli_fetch_array($getrefsaltresult))
              {
                $new_ref_id = $getrefsaltrow['User_ID'];
            
            $refMain = "SELECT * FROM user WHERE User_ID='$new_ref_id'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
                  
              }
              //insert into merge_2_trees
          
            merge_2_trees($M_ID, $uniquesalt);
            merge($user, $M_ID, 'level_0', 'level_1', $uniquesalt);
            
            header('Location: dashboard.php?m=success');
            exit;
            
             }else
        {
            //nested downline 2
            $get_ref_ids_1="SELECT * FROM merge_2_tree as m INNER JOIN user as u ON u.Salt=m.Ben_ID WHERE ref_ID='$user_ref_id'";
            $get_ref_ids_result_1 = mysqli_query($connection, $get_ref_ids_1) or die (mysqli_error($connection));
            
            while($get_ref_ids_row_1 = mysqli_fetch_array($get_ref_ids_result_1))
            {
              
            $get_ref_id_1 =  $get_ref_ids_row_1 ['User_ID'];

                
              $getrefsalt_1= "SELECT * FROM user as u LEFT JOIN merge_2_tree as m ON u.Salt=m.Ben_ID RIGHT JOIN cds as c ON c.User_ID=u.User_ID RIGHT JOIN level_1 as l ON l.User_ID=u.User_ID WHERE (l.completed=0 AND merge_1=0 AND Active=1 AND m.ref_ID='$get_ref_id_1') OR (paid=1 AND l.completed=0 AND Active=1 AND m.ref_ID='$get_ref_id_1') ORDER BY l.Created ASC LIMIT 1";
              $getrefsaltresult_1 =  mysqli_query($connection, $getrefsalt_1) or die(mysqli_error($connection));
                
                
            if($getrefsalt_1 && mysqli_affected_rows($connection) == 1)
            
        {
                    
              while($getrefsaltrow_1 = mysqli_fetch_array($getrefsaltresult_1))
              {
                  
                  $new_ref_id_1 = $getrefsaltrow_1['User_ID'];
             
            $refMain = "SELECT * FROM user WHERE User_ID='$new_ref_id_1'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
                    
                  
              }
              //insert into merge_2_trees
          
            merge_2_trees($M_ID, $uniquesalt);
            
            merge($user, $M_ID, 'level_0', 'level_1', $uniquesalt);
            
            header('Location: dashboard.php?m=success');
            exit;
            
            
             }
                
                
            
                
            }
              
       if(mysqli_num_rows($getrefsaltresult_1) == 0)
        {
          // nested downline 3
           
            $get_ref_ids_1="SELECT * FROM merge_2_tree as m INNER JOIN user as u ON u.Salt=m.Ben_ID WHERE ref_ID='$user_ref_id'";
            $get_ref_ids_result_1 = mysqli_query($connection, $get_ref_ids_1) or die (mysqli_error($connection));
            
            while($get_ref_ids_row_1 = mysqli_fetch_array($get_ref_ids_result_1))
            {
              
            $get_ref_id_1 =  $get_ref_ids_row_1 ['User_ID'];
            
            $get_ref_ids_2="SELECT * FROM merge_2_tree as m INNER JOIN user as u ON u.Salt=m.Ben_ID WHERE ref_ID='$get_ref_id_1'";
            $get_ref_ids_result_2 = mysqli_query($connection, $get_ref_ids_2) or die (mysqli_error($connection));
                
             while($get_ref_ids_row_2 = mysqli_fetch_array($get_ref_ids_result_2))
            {
            
            $get_ref_id_2 =  $get_ref_ids_row_2 ['User_ID'];  
                 
            $getrefsalt_2= "SELECT * FROM user as u LEFT JOIN merge_2_tree as m ON u.Salt=m.Ben_ID RIGHT JOIN cds as c ON c.User_ID=u.User_ID RIGHT JOIN level_1 as l ON l.User_ID=u.User_ID WHERE (l.completed=0 AND merge_1=0 AND Active=1 AND m.ref_ID='$get_ref_id_2') OR (paid=1 AND l.completed=0 AND Active=1 AND m.ref_ID='$get_ref_id_2') ORDER BY l.Created ASC LIMIT 1";
            $getrefsaltresult_2 =  mysqli_query($connection, $getrefsalt_2) or die(mysqli_error($connection));
                 
            if($getrefsalt_2 && mysqli_affected_rows($connection) == 1)
            
        {
                    
              while($getrefsaltrow_2 = mysqli_fetch_array($getrefsaltresult_2))
              {
                    $new_ref_id_2 = $getrefsaltrow_2['User_ID'];
            
                $refMain = "SELECT * FROM user WHERE User_ID='$new_ref_id_2'";
                $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
                  
                  
                  
              }
              //insert into merge_2_trees
          
            merge_2_trees($M_ID, $uniquesalt);
            
            merge($user, $M_ID, 'level_0', 'level_1', $uniquesalt);
            
            header('Location: dashboard.php?m=success');
            exit;
            
             }
            
            }
            
            }
                    
                    
                
            }
              
        if(mysqli_num_rows($getrefsaltresult_2) == 0)
        {
            // nested downline 4
            $get_ref_ids_1="SELECT * FROM merge_2_tree as m INNER JOIN user as u ON u.Salt=m.Ben_ID WHERE ref_ID='$user_ref_id'";
            $get_ref_ids_result_1 = mysqli_query($connection, $get_ref_ids_1) or die (mysqli_error($connection));
            
            while($get_ref_ids_row_1 = mysqli_fetch_array($get_ref_ids_result_1))
            {
              
            $get_ref_id_1 =  $get_ref_ids_row_1 ['User_ID'];
            
            $get_ref_ids_2="SELECT * FROM merge_2_tree as m INNER JOIN user as u ON u.Salt=m.Ben_ID WHERE ref_ID='$get_ref_id_1'";
            $get_ref_ids_result_2 = mysqli_query($connection, $get_ref_ids_2) or die (mysqli_error($connection));
                
             while($get_ref_ids_row_2 = mysqli_fetch_array($get_ref_ids_result_2))
            {
            
            $get_ref_id_2 =  $get_ref_ids_row_2 ['User_ID'];  

            $get_ref_ids_3="SELECT * FROM merge_2_tree as m INNER JOIN user as u ON u.Salt=m.Ben_ID WHERE ref_ID='$get_ref_id_2'";
            $get_ref_ids_result_3 = mysqli_query($connection, $get_ref_ids_3) or die (mysqli_error($connection));
                 
             while($get_ref_ids_row_3 = mysqli_fetch_array($get_ref_ids_result_3))
            {
            
            $get_ref_id_3 =  $get_ref_ids_row_3 ['User_ID']; 
                 
         
         $getrefsalt_3= "SELECT * FROM user as u LEFT JOIN merge_2_tree as m ON u.Salt=m.Ben_ID RIGHT JOIN cds as c ON c.User_ID=u.User_ID RIGHT JOIN level_1 as l ON l.User_ID=u.User_ID WHERE (l.completed=0 AND merge_1=0 AND Active=1 AND m.ref_ID='$get_ref_id_3') OR (paid=1 AND l.completed=0 AND Active=1 AND m.ref_ID='$get_ref_id_3') ORDER BY l.Created ASC LIMIT 1";
          $getrefsaltresult_3 =  mysqli_query($connection, $getrefsalt_3) or die(mysqli_error($connection));
            
                 
         if($getrefsalt_3 && mysqli_affected_rows($connection) == 1)
            
        {
                    
              while($getrefsaltrow_3 = mysqli_fetch_array($getrefsaltresult_3))
              {
                    $new_ref_id_3 = $getrefsaltrow_3['User_ID'];
            
                $refMain = "SELECT * FROM user WHERE User_ID='$new_ref_id_3'";
                $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
                  
                  
                  
              }
              //insert into merge_2_trees
          
            merge_2_trees($M_ID, $uniquesalt); 
            
            merge($user, $M_ID, 'level_0', 'level_1', $uniquesalt);
            header('Location: dashboard.php?m=success');
            exit;
            
             }
                 
             }
            
             }
            }
            
            
                

            }
            if(mysqli_num_rows($getrefsaltresult_3) == 0)
            {
             // nested downline 5
            $get_ref_ids_1="SELECT * FROM merge_2_tree as m INNER JOIN user as u ON u.Salt=m.Ben_ID WHERE ref_ID='$user_ref_id'";
            $get_ref_ids_result_1 = mysqli_query($connection, $get_ref_ids_1) or die (mysqli_error($connection));
            
            while($get_ref_ids_row_1 = mysqli_fetch_array($get_ref_ids_result_1))
            {
              
            $get_ref_id_1 =  $get_ref_ids_row_1 ['User_ID'];
            
            $get_ref_ids_2="SELECT * FROM merge_2_tree as m INNER JOIN user as u ON u.Salt=m.Ben_ID WHERE ref_ID='$get_ref_id_1'";
            $get_ref_ids_result_2 = mysqli_query($connection, $get_ref_ids_2) or die (mysqli_error($connection));
                
             while($get_ref_ids_row_2 = mysqli_fetch_array($get_ref_ids_result_2))
            {
            
            $get_ref_id_2 =  $get_ref_ids_row_2 ['User_ID'];  

            $get_ref_ids_3="SELECT * FROM merge_2_tree as m INNER JOIN user as u ON u.Salt=m.Ben_ID WHERE ref_ID='$get_ref_id_2'";
            $get_ref_ids_result_3 = mysqli_query($connection, $get_ref_ids_3) or die (mysqli_error($connection));
                 
             while($get_ref_ids_row_3 = mysqli_fetch_array($get_ref_ids_result_3))
            {
            
            $get_ref_id_3 =  $get_ref_ids_row_3 ['User_ID'];
                 
             $get_ref_ids_4="SELECT * FROM merge_2_tree as m INNER JOIN user as u ON u.Salt=m.Ben_ID WHERE ref_ID='$get_ref_id_3'";
            $get_ref_ids_result_4 = mysqli_query($connection, $get_ref_ids_4) or die (mysqli_error($connection)); 
                 
             while($get_ref_ids_row_4 = mysqli_fetch_array($get_ref_ids_result_4))
            {
              
             $get_ref_id_4 =  $get_ref_ids_row_4 ['User_ID']; 
                 
            $getrefsalt_4= "SELECT * FROM user as u LEFT JOIN merge_2_tree as m ON u.Salt=m.Ben_ID RIGHT JOIN cds as c ON c.User_ID=u.User_ID RIGHT JOIN level_1 as l ON l.User_ID=u.User_ID WHERE (l.completed=0 AND merge_1=0 AND Active=1 AND m.ref_ID='$get_ref_id_4') OR (paid=1 AND l.completed=0 AND Active=1 AND m.ref_ID='$get_ref_id_4') ORDER BY l.Created ASC LIMIT 1";
            $getrefsaltresult_4 =  mysqli_query($connection, $getrefsalt_4) or die(mysqli_error($connection));
                 
            if($getrefsalt_4 && mysqli_affected_rows($connection) == 1)
            
        {
                    
              while($getrefsaltrow_4 = mysqli_fetch_array($getrefsaltresult_4))
              {
                    $new_ref_id_4 = $getrefsaltrow_4['User_ID'];
            
                $refMain = "SELECT * FROM user WHERE User_ID='$new_ref_id_4'";
                $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
                  
                  
                  
              }
              //insert into merge_2_trees
          
            merge_2_trees($M_ID, $uniquesalt); 
            
            merge($user, $M_ID, 'level_0', 'level_1', $uniquesalt);
            header('Location: dashboard.php?m=success');
            exit;
            
             }
                 
                 
            }
            
                 
             }
             }
            }
            
            }  
            
            
            if(mysqli_num_rows($getrefsaltresult_4) == 0)
            {
                // nested downline 6
                $get_ref_ids_1="SELECT * FROM merge_2_tree as m INNER JOIN user as u ON u.Salt=m.Ben_ID WHERE ref_ID='$user_ref_id'";
            $get_ref_ids_result_1 = mysqli_query($connection, $get_ref_ids_1) or die (mysqli_error($connection));
            
            while($get_ref_ids_row_1 = mysqli_fetch_array($get_ref_ids_result_1))
            {
              
            $get_ref_id_1 =  $get_ref_ids_row_1 ['User_ID'];
            
            $get_ref_ids_2="SELECT * FROM merge_2_tree as m INNER JOIN user as u ON u.Salt=m.Ben_ID WHERE ref_ID='$get_ref_id_1'";
            $get_ref_ids_result_2 = mysqli_query($connection, $get_ref_ids_2) or die (mysqli_error($connection));
                
             while($get_ref_ids_row_2 = mysqli_fetch_array($get_ref_ids_result_2))
            {
            
            $get_ref_id_2 =  $get_ref_ids_row_2 ['User_ID'];  

            $get_ref_ids_3="SELECT * FROM merge_2_tree as m INNER JOIN user as u ON u.Salt=m.Ben_ID WHERE ref_ID='$get_ref_id_2'";
            $get_ref_ids_result_3 = mysqli_query($connection, $get_ref_ids_3) or die (mysqli_error($connection));
                 
             while($get_ref_ids_row_3 = mysqli_fetch_array($get_ref_ids_result_3))
            {
            
            $get_ref_id_3 =  $get_ref_ids_row_3 ['User_ID'];
                 
             $get_ref_ids_4="SELECT * FROM merge_2_tree as m INNER JOIN user as u ON u.Salt=m.Ben_ID WHERE ref_ID='$get_ref_id_3'";
            $get_ref_ids_result_4 = mysqli_query($connection, $get_ref_ids_4) or die (mysqli_error($connection)); 
                 
             while($get_ref_ids_row_4 = mysqli_fetch_array($get_ref_ids_result_4))
            {
              
             $get_ref_id_4 =  $get_ref_ids_row_4 ['User_ID'];
                 
             $get_ref_ids_5="SELECT * FROM merge_2_tree as m INNER JOIN user as u ON u.Salt=m.Ben_ID WHERE ref_ID='$get_ref_id_4'";
            $get_ref_ids_result_5 = mysqli_query($connection, $get_ref_ids_5) or die (mysqli_error($connection));  
                 
          while($get_ref_ids_row_5 = mysqli_fetch_array($get_ref_ids_result_5))
            {
              
          $get_ref_id_5 =  $get_ref_ids_row_5 ['User_ID'];
              
          $getrefsalt_5= "SELECT * FROM user as u LEFT JOIN merge_2_tree as m ON u.Salt=m.Ben_ID RIGHT JOIN cds as c ON c.User_ID=u.User_ID RIGHT JOIN level_1 as l ON l.User_ID=u.User_ID WHERE (l.completed=0 AND merge_1=0 AND Active=1 AND m.ref_ID='$get_ref_id_5') OR (paid=1 AND l.completed=0 AND Active=1 AND m.ref_ID='$get_ref_id_5') ORDER BY l.Created ASC LIMIT 1";
          $getrefsaltresult_5 =  mysqli_query($connection, $getrefsalt_5) or die(mysqli_error($connection));
              
           if($getrefsalt_5 && mysqli_affected_rows($connection) == 1)
            
        {
                    
              while($getrefsaltrow_5 = mysqli_fetch_array($getrefsaltresult_5))
              {
                    $new_ref_id_5 = $getrefsaltrow_5['User_ID'];
            
                $refMain = "SELECT * FROM user WHERE User_ID='$new_ref_id_5'";
                $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
                  
                  
                  
              }
              //insert into merge_2_trees
          
            merge_2_trees($M_ID, $uniquesalt); 
            
            merge($user, $M_ID, 'level_0', 'level_1', $uniquesalt);
            header('Location: dashboard.php?m=success');
            exit;
            
             }
              
            
              
          }
            
                 
             }
             }
             }
            }
                
                
                
            }else{}
            
        }
        
          
            
        }
               
        
        else
        {
         
          
        
            //insert into merge_2_trees
          
          $level = "SELECT * FROM level_1 WHERE User_ID='$M_ID'";
          $level_result = mysqli_query($connection, $level) or die(mysqli_error($connection));

          while($level_row = mysqli_fetch_array($level_result))
          {
            $m1 = $level_row['Merge_1'];
            $m2 = $level_row['Merge_2'];
            $m3 = $level_row['Merge_3'];

            if($m1 == 0 && $m2 == 0 && $m3 == 0)
            {
                
            $insertsponsor_left ="INSERT INTO merge_2_tree(ref_ID, Ben_ID)VALUES('{$M_ID}', '{$uniquesalt}')";
            $insertsponsor_result_left = mysqli_query($connection, $insertsponsor_left) or die(mysqli_error($connection));
            
            }
            elseif($m1 == 1 && $m2 == 0 && $m3 == 0)
            {
                
            $insertsponsor_middle ="INSERT INTO merge_2_tree(ref_ID, Ben_ID)VALUES('{$M_ID}', '{$uniquesalt}')";
            $insertsponsor_result_middle = mysqli_query($connection, $insertsponsor_middle) or die(mysqli_error($connection));
                
            }
            elseif($m1 == 1 && $m2 == 1 && $m3 == 0)
            {
                
            $insertsponsor_right ="INSERT INTO merge_2_tree(ref_ID, Ben_ID)VALUES('{$M_ID}', '{$uniquesalt}')";
            $insertsponsor_result_right = mysqli_query($connection, $insertsponsor_right) or die(mysqli_error($connection));
                
            }
           } 
            
            merge($user, $M_ID, 'level_0', 'level_1', $uniquesalt);
            
        }
        //insert level_1 check query
        //all insert and update queries should be inside the level_1 query
    header('Location: dashboard.php?m=success');
    exit;
    }
//level_1


//level_2
    if(array_key_exists('upgrade', $_POST))
    {
  
     $refferal_spon = "SELECT * FROM level_2 as l INNER JOIN merge_2_tree as m ON l.User_ID=m.ref_ID INNER JOIN cds as c ON l.User_ID=c.User_ID WHERE (l.completed=0 AND merge_1=0 AND Ben_ID='$fifth_gen_salt' AND Active=1) OR (Ben_ID='$fifth_gen_salt' AND paid=1 AND l.completed=0 AND Active=1) ORDER BY l.Created DESC LIMIT 1";
     $refferal_result_spon = mysqli_query($connection, $refferal_spon) or die(mysqli_error($connection));    
        
        if($refferal_spon && mysqli_affected_rows($connection) == 1)
        {
          while($refRow_spon = mysqli_fetch_array($refferal_result_spon))
          {
            $ref = $refRow_spon['User_ID'];

            $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
          }
        }
        
        if(mysqli_num_rows($refferal_result_spon) == 0)
        {
            
           
        // Find your sponosor's sponsor
            
          
          ///Now look for the Higher Sponsor to overtake your own sponsor
          
       $refferal_spon_1 = "SELECT * from user as u INNER JOIN level_2 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID = m.ref_ID INNER JOIN cds as c ON l.User_ID = c.User_ID where (l.completed=0 and merge_1=0 and Ben_ID='$fourth_gen_salt' AND Active=1) or (Ben_ID='$fourth_gen_salt' and paid=1 and l.completed=0 AND Active=1) ORDER BY l.Created DESC LIMIT 1";

      $refferal_result_spon_1 = mysqli_query($connection, $refferal_spon_1) or die(mysqli_error($connection));

      if($refferal_spon_1 && mysqli_affected_rows($connection) == 1)
      {
          

          
        while($refRow_spon_1 = mysqli_fetch_array($refferal_result_spon_1))
        {
          $ref = $refRow_spon_1['User_ID'];

          $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
          $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

          while($refMainRow = mysqli_fetch_array($refMainResult))
          {
              $M_ID = $refMainRow['User_ID'];
              $Mfirstname = $refMainRow['First_Name'];
              $Mlastname = $refMainRow['Last_Name'];
              $MbankName = $refMainRow['Bank_Name'];
              $Macc_Name = $refMainRow['Account_Name'];
              $M_img = $refMainRow['Image'];
              $Macc_Num = $refMainRow['Acc_No'];
              $M_phone = $refMainRow['Phone_1'];
              $Mtwitter = $refMainRow['Twitter_Url'];
              $Mfbook = $refMainRow['Facebook_Url'];
              $Mlevel = $refMainRow['Level'];
          }
        }
            
          
            merge($user, $M_ID, 'level_1', 'level_2', $uniquesalt);
          
            header('Location: dashboard_1.php?m=success');
            exit;
          
      }else
          {
               ///nested upperlive (that Henry's sponosor)
          

      ///Now look for the Higher Sponsor to overtake your own sponsor
          
       $refferal_spon_2 = "SELECT * from user as u INNER JOIN level_2 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID = m.ref_ID INNER JOIN cds as c ON l.User_ID = c.User_ID where (l.completed=0 and merge_1=0 and Ben_ID='$third_gen_salt' AND Active=1) or (Ben_ID='$third_gen_salt' and paid=1 and l.completed=0 AND Active=1) ORDER BY l.Created DESC LIMIT 1";

      $refferal_result_spon_2 = mysqli_query($connection, $refferal_spon_2) or die(mysqli_error($connection));

      if($refferal_spon_2 && mysqli_affected_rows($connection) == 1)
      {
          

          
        while($refRow_spon_2 = mysqli_fetch_array($refferal_result_spon_2))
        {
          $ref = $refRow_spon_2['User_ID'];

          $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
          $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

          while($refMainRow = mysqli_fetch_array($refMainResult))
          {
              $M_ID = $refMainRow['User_ID'];
              $Mfirstname = $refMainRow['First_Name'];
              $Mlastname = $refMainRow['Last_Name'];
              $MbankName = $refMainRow['Bank_Name'];
              $Macc_Name = $refMainRow['Account_Name'];
              $M_img = $refMainRow['Image'];
              $Macc_Num = $refMainRow['Acc_No'];
              $M_phone = $refMainRow['Phone_1'];
              $Mtwitter = $refMainRow['Twitter_Url'];
              $Mfbook = $refMainRow['Facebook_Url'];
              $Mlevel = $refMainRow['Level'];
          }
        }
            
          
            merge($user, $M_ID, 'level_1', 'level_2', $uniquesalt);
          
            header('Location: dashboard_1.php?m=success');
            exit;
 
                  
                  }else
      {
                   ///nested upperlive (that Henry's sponosor)
          

      ///Now look for the Higher Sponsor to overtake your own sponsor
          
       $refferal_spon_3 = "SELECT * from user as u INNER JOIN level_2 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID = m.ref_ID INNER JOIN cds as c ON l.User_ID = c.User_ID where (l.completed=0 and merge_1=0 and Ben_ID='$second_gen_salt' AND Active=1) or (Ben_ID='$second_gen_salt' and paid=1 and l.completed=0 AND Active=1) ORDER BY l.Created DESC LIMIT 1";

      $refferal_result_spon_3 = mysqli_query($connection, $refferal_spon_3) or die(mysqli_error($connection));

      if($refferal_spon_3 && mysqli_affected_rows($connection) == 1)
      {
          

          
        while($refRow_spon_3 = mysqli_fetch_array($refferal_result_spon_3))
        {
          $ref = $refRow_spon_3['User_ID'];

          $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
          $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

          while($refMainRow = mysqli_fetch_array($refMainResult))
          {
              $M_ID = $refMainRow['User_ID'];
              $Mfirstname = $refMainRow['First_Name'];
              $Mlastname = $refMainRow['Last_Name'];
              $MbankName = $refMainRow['Bank_Name'];
              $Macc_Name = $refMainRow['Account_Name'];
              $M_img = $refMainRow['Image'];
              $Macc_Num = $refMainRow['Acc_No'];
              $M_phone = $refMainRow['Phone_1'];
              $Mtwitter = $refMainRow['Twitter_Url'];
              $Mfbook = $refMainRow['Facebook_Url'];
              $Mlevel = $refMainRow['Level'];
          }
        }
            
          
            merge($user, $M_ID, 'level_1', 'level_2', $uniquesalt);
          
            header('Location: dashboard_1.php?m=success');
            exit;
 
                  
                  }else
      {
                   ///nested upperlive (that Henry's sponosor)
          

          ///Now look for the Higher Sponsor to overtake your own sponsor
          
       $refferal_spon_4 = "SELECT * from user as u INNER JOIN level_2 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID = m.ref_ID INNER JOIN cds as c ON l.User_ID = c.User_ID where (l.completed=0 and merge_1=0 and Ben_ID='$first_gen_salt' AND Active=1) or (Ben_ID='$first_gen_salt' and paid=1 and l.completed=0 AND Active=1) ORDER BY l.Created DESC LIMIT 1";

      $refferal_result_spon_4 = mysqli_query($connection, $refferal_spon_4) or die(mysqli_error($connection));

      if($refferal_spon_4 && mysqli_affected_rows($connection) == 1)
      {
        while($refRow_spon_4 = mysqli_fetch_array($refferal_result_spon_4))
        {
          $ref = $refRow_spon_4['User_ID'];

          $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
          $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

          while($refMainRow = mysqli_fetch_array($refMainResult))
          {
              $M_ID = $refMainRow['User_ID'];
              $Mfirstname = $refMainRow['First_Name'];
              $Mlastname = $refMainRow['Last_Name'];
              $MbankName = $refMainRow['Bank_Name'];
              $Macc_Name = $refMainRow['Account_Name'];
              $M_img = $refMainRow['Image'];
              $Macc_Num = $refMainRow['Acc_No'];
              $M_phone = $refMainRow['Phone_1'];
              $Mtwitter = $refMainRow['Twitter_Url'];
              $Mfbook = $refMainRow['Facebook_Url'];
              $Mlevel = $refMainRow['Level'];
          }
        }
            
          
            merge($user, $M_ID, 'level_1', 'level_2', $uniquesalt);
          
            header('Location: dashboard_1.php?m=success');
            exit;
 
                  
                  }else
      {
                   ///nested upperlive (that Henry's sponosor)
          

          ///Now look for the Higher Sponsor to overtake your own sponsor
          
       $refferal_spon_5 = "SELECT * from user as u INNER JOIN level_2 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID = m.ref_ID INNER JOIN cds as c ON l.User_ID = c.User_ID where (l.completed=0 and merge_1=0 and Ben_ID='$uniquesalt' AND Active=1) or (Ben_ID='$uniquesalt' and paid=1 and l.completed=0 AND Active=1) ORDER BY l.Created DESC LIMIT 1";

      $refferal_result_spon_5 = mysqli_query($connection, $refferal_spon_5) or die(mysqli_error($connection));

      if($refferal_spon_5 && mysqli_affected_rows($connection) == 1)
      {
          

          
        while($refRow_spon_5 = mysqli_fetch_array($refferal_result_spon_5))
        {
          $ref = $refRow_spon_5['User_ID'];

          $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
          $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

          while($refMainRow = mysqli_fetch_array($refMainResult))
          {
              $M_ID = $refMainRow['User_ID'];
              $Mfirstname = $refMainRow['First_Name'];
              $Mlastname = $refMainRow['Last_Name'];
              $MbankName = $refMainRow['Bank_Name'];
              $Macc_Name = $refMainRow['Account_Name'];
              $M_img = $refMainRow['Image'];
              $Macc_Num = $refMainRow['Acc_No'];
              $M_phone = $refMainRow['Phone_1'];
              $Mtwitter = $refMainRow['Twitter_Url'];
              $Mfbook = $refMainRow['Facebook_Url'];
              $Mlevel = $refMainRow['Level'];
          }
        }
            
          
            merge($user, $M_ID, 'level_1', 'level_2', $uniquesalt);
          
            header('Location: dashboard_1.php?m=success');
            exit;
 
                  
                  }else
      {
          ///// LEFT AND RIGHT MAGIC
              

          //level_1 magic
          //check for refferal
        $refferal_left = "SELECT * FROM user as u LEFT JOIN merge_2_tree as m ON u.Salt=m.Ben_ID RIGHT JOIN cds as c ON c.User_ID=u.User_ID RIGHT JOIN level_2 as l ON l.User_ID=u.User_ID WHERE (l.completed=0 AND merge_1=0 AND Active=1 AND m.ref_ID='$first_gen_id') OR (paid=1 AND l.completed=0 AND Active=1 AND m.ref_ID='$first_gen_id') ORDER BY l.Created ASC LIMIT 1";
        $refferal_result_left = mysqli_query($connection, $refferal_left) or die(mysqli_error($connection));
        

        if(mysqli_num_rows($refferal_result_left) > 0)
        {
          while($refRow = mysqli_fetch_array($refferal_result_left))
          {
            $ref = $refRow['User_ID'];

            $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
          }
            
            
            
            merge($user, $M_ID, 'level_1', 'level_2', $uniquesalt);
          
            header('Location: dashboard_1.php?m=success');
            exit;
            
            
            
        }elseif(mysqli_num_rows($refferal_result_left) == 0)
            
        {
            $get_ref_ids_1="SELECT * FROM merge_2_tree as m INNER JOIN user as u ON u.Salt=m.Ben_ID WHERE ref_ID='$first_gen_id'";
            $get_ref_ids_result_1 = mysqli_query($connection, $get_ref_ids_1) or die (mysqli_error($connection));
            
            while($get_ref_ids_row_1 = mysqli_fetch_array($get_ref_ids_result_1))
            {
              
            $get_ref_id_1 =  $get_ref_ids_row_1 ['User_ID'];
            
            $refferal_middle = "SELECT * FROM user as u LEFT JOIN merge_2_tree as m ON u.Salt=m.Ben_ID RIGHT JOIN cds as c ON c.User_ID=u.User_ID RIGHT JOIN level_2 as l ON l.User_ID=u.User_ID WHERE (l.completed=0 AND merge_1=0 AND Active=1 AND m.ref_ID='$get_ref_id_1') OR (paid=1 AND l.completed=0 AND Active=1 AND m.ref_ID='$get_ref_id_1') ORDER BY l.Created ASC LIMIT 1";
            $refferal_result_middle = mysqli_query($connection, $refferal_middle) or die(mysqli_error($connection));  
            
             if(mysqli_num_rows($refferal_result_middle) > 0)
        {
          while($refRow = mysqli_fetch_array($refferal_result_middle))
          {
            $ref = $refRow['User_ID'];

            $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
          }
                            
            merge($user, $M_ID, 'level_1', 'level_2', $uniquesalt);
                
            header('Location: dashboard_1.php?m=success');
            exit;
          //update level_1
            
        }  
                
            
            }
        
            if(mysqli_num_rows($refferal_result_middle) == 0)
            
        {    
                
         $refferal_right = "SELECT * FROM level_2 as l INNER JOIN cds as c ON l.User_ID=c.User_ID WHERE (l.completed=0 AND merge_1=0 AND  Active=1) OR (paid=1 AND l.completed=0 AND Active=1) ORDER BY l.Created ASC LIMIT 1";
        $refferal_result_right = mysqli_query($connection, $refferal_right) or die(mysqli_error($connection));
        
        
        if($refferal_right && mysqli_affected_rows($connection) == 1)
        {
          while($refRow = mysqli_fetch_array($refferal_result_right))
          {
            $ref = $refRow['User_ID'];

            $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
          }
            
            
            
            merge($user, $M_ID, 'level_1', 'level_2', $uniquesalt);
          
            header('Location: dashboard_1.php?m=success');
            exit;
            
        }
            
            
        }
            }         
                      
                      
                      
 ///// LEFT AND RIGHT MAGIC   
       
      }
       
      }
       
      }
       
      }
          
      }
        }
        else
        {
            /// run for user's sponsors
            merge($user, $M_ID, 'level_1', 'level_2', $uniquesalt);
          
            header('Location: dashboard_1.php?m=success');
            exit;
            
        }
        
        
    }

  //level_1

  //level2
  if(array_key_exists('upgrade2', $_POST))
  {

      
       $refferal_spon = "SELECT * FROM user as u INNER JOIN level_3 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID=m.ref_ID INNER JOIN cds as c ON l.User_ID=c.User_ID WHERE (l.completed=0 AND merge_1=0 AND Ben_ID='$fifth_gen_salt' AND Active=1) OR (Ben_ID='$fifth_gen_salt' AND paid=1 AND l.completed=0 AND Active=1) OR (Ben_ID='$fifth_gen_salt' and merge_3=0 and Level=4 and l.completed=0) ORDER BY l.Created ASC LIMIT 1";
     $refferal_result_spon = mysqli_query($connection, $refferal_spon) or die(mysqli_error($connection));    
        
        if($refferal_spon && mysqli_affected_rows($connection) == 1)
        {
          while($refRow_spon = mysqli_fetch_array($refferal_result_spon))
          {
            $ref = $refRow_spon['User_ID'];

            $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
          }
        }
        
        if(mysqli_num_rows($refferal_result_spon) == 0)
        {
            
           
        // Find your sponosor's sponsor
            
          
          ///Now look for the Higher Sponsor to overtake your own sponsor
          
       $refferal_spon_1 = "SELECT * FROM user as u INNER JOIN level_3 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID = m.ref_ID INNER JOIN cds as c ON l.User_ID = c.User_ID where (l.completed=0 and merge_1=0 and Ben_ID='$fourth_gen_salt' AND Active=1) or (Ben_ID='$fourth_gen_salt' and paid=1 and l.completed=0 AND Active=1) OR (Ben_ID='$fourth_gen_salt' and merge_3=0 and Level=4 and l.completed=0) ORDER BY l.Created DESC LIMIT 1";

      $refferal_result_spon_1 = mysqli_query($connection, $refferal_spon_1) or die(mysqli_error($connection));

      if($refferal_spon_1 && mysqli_affected_rows($connection) == 1)
      {
          

          
        while($refRow_spon_1 = mysqli_fetch_array($refferal_result_spon_1))
        {
          $ref = $refRow_spon_1['User_ID'];

          $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
          $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

          while($refMainRow = mysqli_fetch_array($refMainResult))
          {
              $M_ID = $refMainRow['User_ID'];
              $Mfirstname = $refMainRow['First_Name'];
              $Mlastname = $refMainRow['Last_Name'];
              $MbankName = $refMainRow['Bank_Name'];
              $Macc_Name = $refMainRow['Account_Name'];
              $M_img = $refMainRow['Image'];
              $Macc_Num = $refMainRow['Acc_No'];
              $M_phone = $refMainRow['Phone_1'];
              $Mtwitter = $refMainRow['Twitter_Url'];
              $Mfbook = $refMainRow['Facebook_Url'];
              $Mlevel = $refMainRow['Level'];
          }
        }
            
          
            merge($user, $M_ID, 'level_2', 'level_3', $uniquesalt);
          
            header('Location: dashboard_2.php?m=success');
            exit;
          
      }else
          {
          
          
          ///nested downline (That is Henry's sponors)
         
          
          ///Now look for the Higher Sponsor to overtake your own sponsor
          
       $refferal_spon_2 = "SELECT * FROM user as u INNER JOIN level_3 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID = m.ref_ID INNER JOIN cds as c ON l.User_ID = c.User_ID where (l.completed=0 and merge_1=0 and Ben_ID='$third_gen_salt' AND Active=1) or (Ben_ID='$third_gen_salt' and paid=1 and l.completed=0 AND Active=1) OR (Ben_ID='$third_gen_salt' and merge_3=0 and Level=4 and l.completed=0) ORDER BY l.Created DESC LIMIT 1";

      $refferal_result_spon_2 = mysqli_query($connection, $refferal_spon_2) or die(mysqli_error($connection));

      if($refferal_spon_2 && mysqli_affected_rows($connection) == 1)
      {
          

          
        while($refRow_spon_2 = mysqli_fetch_array($refferal_result_spon_2))
        {
          $ref = $refRow_spon_2['User_ID'];

          $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
          $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

          while($refMainRow = mysqli_fetch_array($refMainResult))
          {
              $M_ID = $refMainRow['User_ID'];
              $Mfirstname = $refMainRow['First_Name'];
              $Mlastname = $refMainRow['Last_Name'];
              $MbankName = $refMainRow['Bank_Name'];
              $Macc_Name = $refMainRow['Account_Name'];
              $M_img = $refMainRow['Image'];
              $Macc_Num = $refMainRow['Acc_No'];
              $M_phone = $refMainRow['Phone_1'];
              $Mtwitter = $refMainRow['Twitter_Url'];
              $Mfbook = $refMainRow['Facebook_Url'];
              $Mlevel = $refMainRow['Level'];
          }
        }
            
          
            merge($user, $M_ID, 'level_2', 'level_3', $uniquesalt);
          
            header('Location: dashboard_2.php?m=success');
            exit;
          
      }else
          {
                  
          ///nested downline (That is Henry's sponors)
         
          
          ///Now look for the Higher Sponsor to overtake your own sponsor
          
       $refferal_spon_3 = "SELECT * FROM user as u INNER JOIN level_3 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID = m.ref_ID INNER JOIN cds as c ON l.User_ID = c.User_ID where (l.completed=0 and merge_1=0 and Ben_ID='$second_gen_salt' AND Active=1) or (Ben_ID='$second_gen_salt' and paid=1 and l.completed=0 AND Active=1) OR (Ben_ID='$second_gen_salt' and merge_3=0 and Level=4 and l.completed=0) ORDER BY l.Created DESC LIMIT 1";

      $refferal_result_spon_3 = mysqli_query($connection, $refferal_spon_3) or die(mysqli_error($connection));

      if($refferal_spon_3 && mysqli_affected_rows($connection) == 1)
      {
          

          
        while($refRow_spon_3 = mysqli_fetch_array($refferal_result_spon_3))
        {
          $ref = $refRow_spon_3['User_ID'];

          $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
          $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

          while($refMainRow = mysqli_fetch_array($refMainResult))
          {
              $M_ID = $refMainRow['User_ID'];
              $Mfirstname = $refMainRow['First_Name'];
              $Mlastname = $refMainRow['Last_Name'];
              $MbankName = $refMainRow['Bank_Name'];
              $Macc_Name = $refMainRow['Account_Name'];
              $M_img = $refMainRow['Image'];
              $Macc_Num = $refMainRow['Acc_No'];
              $M_phone = $refMainRow['Phone_1'];
              $Mtwitter = $refMainRow['Twitter_Url'];
              $Mfbook = $refMainRow['Facebook_Url'];
              $Mlevel = $refMainRow['Level'];
          }
        }
            
          
            merge($user, $M_ID, 'level_2', 'level_3', $uniquesalt);
          
            header('Location: dashboard_2.php?m=success');
            exit;
          
      }else
          {
        
             ///nested downline (That is Henry's sponors)
         
          
          ///Now look for the Higher Sponsor to overtake your own sponsor
          
       $refferal_spon_4 = "SELECT * FROM user as u INNER JOIN level_3 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID = m.ref_ID INNER JOIN cds as c ON l.User_ID = c.User_ID where (l.completed=0 and merge_1=0 and Ben_ID='$first_gen_salt' AND Active=1) or (Ben_ID='$first_gen_salt' and paid=1 and l.completed=0 AND Active=1) OR (Ben_ID='$first_gen_salt' and merge_3=0 and Level=4 and l.completed=0) ORDER BY l.Created DESC LIMIT 1";

      $refferal_result_spon_4 = mysqli_query($connection, $refferal_spon_4) or die(mysqli_error($connection));

      if($refferal_spon_4 && mysqli_affected_rows($connection) == 1)
      {
          

          
        while($refRow_spon_4 = mysqli_fetch_array($refferal_result_spon_4))
        {
          $ref = $refRow_spon_4['User_ID'];

          $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
          $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

          while($refMainRow = mysqli_fetch_array($refMainResult))
          {
              $M_ID = $refMainRow['User_ID'];
              $Mfirstname = $refMainRow['First_Name'];
              $Mlastname = $refMainRow['Last_Name'];
              $MbankName = $refMainRow['Bank_Name'];
              $Macc_Name = $refMainRow['Account_Name'];
              $M_img = $refMainRow['Image'];
              $Macc_Num = $refMainRow['Acc_No'];
              $M_phone = $refMainRow['Phone_1'];
              $Mtwitter = $refMainRow['Twitter_Url'];
              $Mfbook = $refMainRow['Facebook_Url'];
              $Mlevel = $refMainRow['Level'];
          }
        }
            
          
            merge($user, $M_ID, 'level_2', 'level_3', $uniquesalt);
          
            header('Location: dashboard_2.php?m=success');
            exit;
          
      }else
          {
                  
                      ///nested downline (That is Henry's sponors)
         
          
          ///Now look for the Higher Sponsor to overtake your own sponsor
          
       $refferal_spon_5 = "SELECT * FROM user as u INNER JOIN level_3 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID = m.ref_ID INNER JOIN cds as c ON l.User_ID = c.User_ID where (l.completed=0 and merge_1=0 and Ben_ID='$uniquesalt' AND Active=1) or (Ben_ID='$uniquesalt' and paid=1 and l.completed=0 AND Active=1) OR (Ben_ID='$uniquesalt' and merge_3=0 and Level=4 and l.completed=0) ORDER BY l.Created DESC LIMIT 1";

      $refferal_result_spon_5 = mysqli_query($connection, $refferal_spon_5) or die(mysqli_error($connection));

      if($refferal_spon_5 && mysqli_affected_rows($connection) == 1)
      {
          

          
        while($refRow_spon_5 = mysqli_fetch_array($refferal_result_spon_5))
        {
          $ref = $refRow_spon_5['User_ID'];

          $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
          $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

          while($refMainRow = mysqli_fetch_array($refMainResult))
          {
              $M_ID = $refMainRow['User_ID'];
              $Mfirstname = $refMainRow['First_Name'];
              $Mlastname = $refMainRow['Last_Name'];
              $MbankName = $refMainRow['Bank_Name'];
              $Macc_Name = $refMainRow['Account_Name'];
              $M_img = $refMainRow['Image'];
              $Macc_Num = $refMainRow['Acc_No'];
              $M_phone = $refMainRow['Phone_1'];
              $Mtwitter = $refMainRow['Twitter_Url'];
              $Mfbook = $refMainRow['Facebook_Url'];
              $Mlevel = $refMainRow['Level'];
          }
        }
            
          
            merge($user, $M_ID, 'level_2', 'level_3', $uniquesalt);
          
            header('Location: dashboard_2.php?m=success');
            exit;
          
      }else
          {
                 ///// LEFT AND RIGHT MAGIC
              

          //level_3 magic
        //check for refferal
      $refferal_left = "SELECT * FROM user as u LEFT JOIN merge_2_tree as m ON u.Salt=m.Ben_ID RIGHT JOIN cds as c ON c.User_ID=u.User_ID RIGHT JOIN level_3 as l ON l.User_ID=u.User_ID WHERE (l.completed=0 AND merge_1=0 AND Active=1 AND m.ref_ID='$first_gen_id') OR (paid=1 AND l.completed=0 AND Active=1 AND m.ref_ID='$first_gen_id')  OR (merge_3=0 and Level=4 and l.completed=0 and m.ref_ID='$first_gen_id') ORDER BY l.Created ASC LIMIT 1";
        $refferal_result_left = mysqli_query($connection, $refferal_left) or die(mysqli_error($connection));
        

        if(mysqli_num_rows($refferal_result_left) > 0)
        {
          while($refRow = mysqli_fetch_array($refferal_result_left))
          {
            $ref = $refRow['User_ID'];

            $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
          }
            
            merge($user, $M_ID, 'level_2', 'level_3', $uniquesalt);
          
            header('Location: dashboard_2.php?m=success');
            exit;
            
            
            
        }elseif(mysqli_num_rows($refferal_result_left) == 0)
        {
            
            
            $get_ref_ids_1="SELECT * FROM merge_2_tree as m INNER JOIN user as u ON u.Salt=m.Ben_ID WHERE ref_ID='$first_gen_id'";
            $get_ref_ids_result_1 = mysqli_query($connection, $get_ref_ids_1) or die (mysqli_error($connection));
            
            while($get_ref_ids_row_1 = mysqli_fetch_array($get_ref_ids_result_1))
            {
              
            $get_ref_id_1 =  $get_ref_ids_row_1 ['User_ID'];
            
            $refferal_middle = "SELECT * FROM user as u LEFT JOIN merge_2_tree as m ON u.Salt=m.Ben_ID RIGHT JOIN cds as c ON c.User_ID=u.User_ID RIGHT JOIN level_3 as l ON l.User_ID=u.User_ID WHERE (l.completed=0 AND merge_1=0 AND Active=1 AND m.ref_ID='$get_ref_id_1') OR (paid=1 AND l.completed=0 AND Active=1 AND m.ref_ID='$get_ref_id_1')  OR (merge_3=0 and Level=4 and l.completed=0 and m.ref_ID='$get_ref_id_1') ORDER BY l.Created ASC LIMIT 1";
            $refferal_result_middle = mysqli_query($connection, $refferal_middle) or die(mysqli_error($connection)); 
                
                if(mysqli_num_rows($refferal_result_middle) > 0)
        {
          while($refRow = mysqli_fetch_array($refferal_result_middle))
          {
            $ref = $refRow['User_ID'];

            $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
          }

            merge($user, $M_ID, 'level_2', 'level_3', $uniquesalt);
                
            header('Location: dashboard_2.php?m=success');
            exit;
          //update level_1
            
        }
                
            } 
            
            
            if(mysqli_num_rows($refferal_result_middle) == 0)
        {
                
         $refferal_right = "SELECT * FROM user as u INNER JOIN level_3 as l ON u.User_ID=l.User_ID INNER JOIN cds as c ON l.User_ID=c.User_ID WHERE (l.completed=0 AND merge_1=0 AND  Active=1) OR (paid=1 AND l.completed=0 AND Active=1) OR (merge_3=0 and Level=4 and l.completed=0) ORDER BY l.Created ASC LIMIT 1";
        $refferal_result_right = mysqli_query($connection, $refferal_right) or die(mysqli_error($connection));
        
        
        if($refferal_right && mysqli_affected_rows($connection) == 1)
        {
          while($refRow = mysqli_fetch_array($refferal_result_right))
          {
            $ref = $refRow['User_ID'];

            $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
          }
            
            
            merge($user, $M_ID, 'level_2', 'level_3', $uniquesalt);
          
            header('Location: dashboard_2.php?m=success');
            exit;
            
        }
            
            
        }
            }       
                      
                      
 ///// LEFT AND RIGHT MAGIC      
                
            
                  
                  }
            
                  
                  }
                
            
                  
                  }     
                
            
                  
                  }
                  }
        }
        else
        {
            /// run for user's sponsors
            merge($user, $M_ID, 'level_2', 'level_3', $uniquesalt);
          
            header('Location: dashboard_2.php?m=success');
            exit;
            
        }
      
  }
  //level2

  //level3
  if(array_key_exists('upgrade3', $_POST))
  {
      
       $refferal_spon = "SELECT * FROM user as u INNER JOIN level_4 as l ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID=m.ref_ID INNER JOIN cds as c ON l.User_ID=c.User_ID WHERE (l.completed=0 AND merge_1=0 AND Ben_ID='$fifth_gen_salt' AND Active=1) OR (Ben_ID='$fifth_gen_salt' AND paid=1 AND l.completed=0 AND Active=1) OR (Ben_ID='$fifth_gen_salt' and merge_3=0 and Level=5 and l.completed=0) ORDER BY l.Created ASC LIMIT 1";
     $refferal_result_spon = mysqli_query($connection, $refferal_spon) or die(mysqli_error($connection));    
        
        if($refferal_spon && mysqli_affected_rows($connection) == 1)
        {
          while($refRow_spon = mysqli_fetch_array($refferal_result_spon))
          {
            $ref = $refRow_spon['User_ID'];

            $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
          }
        }
        
        if(mysqli_num_rows($refferal_result_spon) == 0)
        {
            
           
        // Find your sponosor's sponsor
            
          
          ///Now look for the Higher Sponsor to overtake your own sponsor
          
       $refferal_spon_1 = "SELECT * from user as u INNER JOIN level_4 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID = m.ref_ID INNER JOIN cds as c ON l.User_ID = c.User_ID where (l.completed=0 and merge_1=0 and Ben_ID='$fourth_gen_salt' AND Active=1) or (Ben_ID='$fourth_gen_salt' and paid=1 and l.completed=0 AND Active=1) OR (Ben_ID='$fourth_gen_salt' and merge_3=0 and Level=5 and l.completed=0) ORDER BY l.Created DESC LIMIT 1";

      $refferal_result_spon_1 = mysqli_query($connection, $refferal_spon_1) or die(mysqli_error($connection));

      if($refferal_spon_1 && mysqli_affected_rows($connection) == 1)
      {
          

          
        while($refRow_spon_1 = mysqli_fetch_array($refferal_result_spon_1))
        {
          $ref = $refRow_spon_1['User_ID'];

          $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
          $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

          while($refMainRow = mysqli_fetch_array($refMainResult))
          {
              $M_ID = $refMainRow['User_ID'];
              $Mfirstname = $refMainRow['First_Name'];
              $Mlastname = $refMainRow['Last_Name'];
              $MbankName = $refMainRow['Bank_Name'];
              $Macc_Name = $refMainRow['Account_Name'];
              $M_img = $refMainRow['Image'];
              $Macc_Num = $refMainRow['Acc_No'];
              $M_phone = $refMainRow['Phone_1'];
              $Mtwitter = $refMainRow['Twitter_Url'];
              $Mfbook = $refMainRow['Facebook_Url'];
              $Mlevel = $refMainRow['Level'];
          }
        }
            
          
            merge($user, $M_ID, 'level_3', 'level_4', $uniquesalt);
          
            header('Location: dashboard_3.php?m=success');
            exit;
          
      }else
          {
             // Find your sponosor's sponsor (Henry's Sponors)
            
          
          ///Now look for the Higher Sponsor to overtake your own sponsor
          
       $refferal_spon_2 = "SELECT * from user as u INNER JOIN level_4 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID = m.ref_ID INNER JOIN cds as c ON l.User_ID = c.User_ID where (l.completed=0 and merge_1=0 and Ben_ID='$third_gen_salt' AND Active=1) or (Ben_ID='$third_gen_salt' and paid=1 and l.completed=0 AND Active=1) OR (Ben_ID='$third_gen_salt' and merge_3=0 and Level=5 and l.completed=0) ORDER BY l.Created DESC LIMIT 1";

      $refferal_result_spon_2 = mysqli_query($connection, $refferal_spon_2) or die(mysqli_error($connection));

      if($refferal_spon_2 && mysqli_affected_rows($connection) == 1)
      {
          

          
        while($refRow_spon_2 = mysqli_fetch_array($refferal_result_spon_2))
        {
          $ref = $refRow_spon_2['User_ID'];

          $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
          $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

          while($refMainRow = mysqli_fetch_array($refMainResult))
          {
              $M_ID = $refMainRow['User_ID'];
              $Mfirstname = $refMainRow['First_Name'];
              $Mlastname = $refMainRow['Last_Name'];
              $MbankName = $refMainRow['Bank_Name'];
              $Macc_Name = $refMainRow['Account_Name'];
              $M_img = $refMainRow['Image'];
              $Macc_Num = $refMainRow['Acc_No'];
              $M_phone = $refMainRow['Phone_1'];
              $Mtwitter = $refMainRow['Twitter_Url'];
              $Mfbook = $refMainRow['Facebook_Url'];
              $Mlevel = $refMainRow['Level'];
          }
        }
            
          
            merge($user, $M_ID, 'level_3', 'level_4', $uniquesalt);
          
            header('Location: dashboard_3.php?m=success');
            exit;
          
      }else
          {
                      // Find your sponosor's sponsor (Henry's Sponors)
            
          
          ///Now look for the Higher Sponsor to overtake your own sponsor
          
       $refferal_spon_3 = "SELECT * from user as u INNER JOIN level_4 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID = m.ref_ID INNER JOIN cds as c ON l.User_ID = c.User_ID where (l.completed=0 and merge_1=0 and Ben_ID='$second_gen_salt' AND Active=1) or (Ben_ID='$second_gen_salt' and paid=1 and l.completed=0 AND Active=1) OR (Ben_ID='$second_gen_salt' and merge_3=0 and Level=5 and l.completed=0) ORDER BY l.Created DESC LIMIT 1";

      $refferal_result_spon_3 = mysqli_query($connection, $refferal_spon_3) or die(mysqli_error($connection));

      if($refferal_spon_3 && mysqli_affected_rows($connection) == 1)
      {
          

          
        while($refRow_spon_3 = mysqli_fetch_array($refferal_result_spon_3))
        {
          $ref = $refRow_spon_3['User_ID'];

          $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
          $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

          while($refMainRow = mysqli_fetch_array($refMainResult))
          {
              $M_ID = $refMainRow['User_ID'];
              $Mfirstname = $refMainRow['First_Name'];
              $Mlastname = $refMainRow['Last_Name'];
              $MbankName = $refMainRow['Bank_Name'];
              $Macc_Name = $refMainRow['Account_Name'];
              $M_img = $refMainRow['Image'];
              $Macc_Num = $refMainRow['Acc_No'];
              $M_phone = $refMainRow['Phone_1'];
              $Mtwitter = $refMainRow['Twitter_Url'];
              $Mfbook = $refMainRow['Facebook_Url'];
              $Mlevel = $refMainRow['Level'];
          }
        }
            
          
            merge($user, $M_ID, 'level_3', 'level_4', $uniquesalt);
          
            header('Location: dashboard_3.php?m=success');
            exit;
          
      }else
          {
                 // Find your sponosor's sponsor (Henry's Sponors)
            
          
          ///Now look for the Higher Sponsor to overtake your own sponsor
          
       $refferal_spon_4 = "SELECT * from user as u INNER JOIN level_4 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID = m.ref_ID INNER JOIN cds as c ON l.User_ID = c.User_ID where (l.completed=0 and merge_1=0 and Ben_ID='$first_gen_salt' AND Active=1) or (Ben_ID='$first_gen_salt' and paid=1 and l.completed=0 AND Active=1) OR (Ben_ID='$first_gen_salt' and merge_3=0 and Level=5 and l.completed=0) ORDER BY l.Created DESC LIMIT 1";

      $refferal_result_spon_4 = mysqli_query($connection, $refferal_spon_4) or die(mysqli_error($connection));

      if($refferal_spon_4 && mysqli_affected_rows($connection) == 1)
      {
          

          
        while($refRow_spon_4 = mysqli_fetch_array($refferal_result_spon_4))
        {
          $ref = $refRow_spon_4['User_ID'];

          $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
          $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

          while($refMainRow = mysqli_fetch_array($refMainResult))
          {
              $M_ID = $refMainRow['User_ID'];
              $Mfirstname = $refMainRow['First_Name'];
              $Mlastname = $refMainRow['Last_Name'];
              $MbankName = $refMainRow['Bank_Name'];
              $Macc_Name = $refMainRow['Account_Name'];
              $M_img = $refMainRow['Image'];
              $Macc_Num = $refMainRow['Acc_No'];
              $M_phone = $refMainRow['Phone_1'];
              $Mtwitter = $refMainRow['Twitter_Url'];
              $Mfbook = $refMainRow['Facebook_Url'];
              $Mlevel = $refMainRow['Level'];
          }
        }
            
          
            merge($user, $M_ID, 'level_3', 'level_4', $uniquesalt);
          
            header('Location: dashboard_3.php?m=success');
            exit;
          
      }else
          {
                   // Find your sponosor's sponsor (Henry's Sponors)
            
          
          ///Now look for the Higher Sponsor to overtake your own sponsor
          
       $refferal_spon_5 = "SELECT * from user as u INNER JOIN level_4 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID = m.ref_ID INNER JOIN cds as c ON l.User_ID = c.User_ID where (l.completed=0 and merge_1=0 and Ben_ID='$uniquesalt' AND Active=1) or (Ben_ID='$uniquesalt' and paid=1 and l.completed=0 AND Active=1) OR (Ben_ID='$uniquesalt' and merge_3=0 and Level=5 and l.completed=0) ORDER BY l.Created DESC LIMIT 1";

      $refferal_result_spon_5 = mysqli_query($connection, $refferal_spon_5) or die(mysqli_error($connection));

      if($refferal_spon_5 && mysqli_affected_rows($connection) == 1)
      {
          

          
        while($refRow_spon_5 = mysqli_fetch_array($refferal_result_spon_5))
        {
          $ref = $refRow_spon_5['User_ID'];

          $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
          $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

          while($refMainRow = mysqli_fetch_array($refMainResult))
          {
              $M_ID = $refMainRow['User_ID'];
              $Mfirstname = $refMainRow['First_Name'];
              $Mlastname = $refMainRow['Last_Name'];
              $MbankName = $refMainRow['Bank_Name'];
              $Macc_Name = $refMainRow['Account_Name'];
              $M_img = $refMainRow['Image'];
              $Macc_Num = $refMainRow['Acc_No'];
              $M_phone = $refMainRow['Phone_1'];
              $Mtwitter = $refMainRow['Twitter_Url'];
              $Mfbook = $refMainRow['Facebook_Url'];
              $Mlevel = $refMainRow['Level'];
          }
        }
            
          
            merge($user, $M_ID, 'level_3', 'level_4', $uniquesalt);
          
            header('Location: dashboard_3.php?m=success');
            exit;
          
      }else
          {
              ///// LEFT AND RIGHT MAGIC
              

          //level_3 magic
        //check for refferal
      $refferal_left = "SELECT * FROM user as u LEFT JOIN merge_2_tree as m ON u.Salt=m.Ben_ID RIGHT JOIN cds as c ON c.User_ID=u.User_ID RIGHT JOIN level_4 as l ON l.User_ID=u.User_ID WHERE (l.completed=0 AND merge_1=0 AND Active=1 AND m.ref_ID='$first_gen_id') OR (paid=1 AND l.completed=0 AND Active=1 AND m.ref_ID='$first_gen_id')  OR (merge_3=0 and Level=5 and l.completed=0 and m.ref_ID='$first_gen_id') ORDER BY l.Created ASC LIMIT 1";
        $refferal_result_left = mysqli_query($connection, $refferal_left) or die(mysqli_error($connection));
        

        if(mysqli_num_rows($refferal_result_left) > 0)
        {
          while($refRow = mysqli_fetch_array($refferal_result_left))
          {
            $ref = $refRow['User_ID'];

            $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
          }
            
            merge($user, $M_ID, 'level_3', 'level_4', $uniquesalt);
          
            header('Location: dashboard_3.php?m=success');
            exit;
            
            
            
        }elseif(mysqli_num_rows($refferal_result_left) == 0)
        {
            $get_ref_ids_1="SELECT * FROM merge_2_tree as m INNER JOIN user as u ON u.Salt=m.Ben_ID WHERE ref_ID='$first_gen_id'";
            $get_ref_ids_result_1 = mysqli_query($connection, $get_ref_ids_1) or die (mysqli_error($connection));
            
            while($get_ref_ids_row_1 = mysqli_fetch_array($get_ref_ids_result_1))
            {
              
            $get_ref_id_1 =  $get_ref_ids_row_1 ['User_ID'];
            
            $refferal_middle = "SELECT * FROM user as u LEFT JOIN merge_2_tree as m ON u.Salt=m.Ben_ID RIGHT JOIN cds as c ON c.User_ID=u.User_ID RIGHT JOIN level_4 as l ON l.User_ID=u.User_ID WHERE (l.completed=0 AND merge_1=0 AND Active=1 AND m.ref_ID='$get_ref_id_1') OR (paid=1 AND l.completed=0 AND Active=1 AND m.ref_ID='$get_ref_id_1')  OR (merge_3=0 and Level=5 and l.completed=0 and m.ref_ID='$get_ref_id_1') ORDER BY l.Created ASC LIMIT 1";
            $refferal_result_middle = mysqli_query($connection, $refferal_middle) or die(mysqli_error($connection));  
            
            
            if(mysqli_num_rows($refferal_result_middle) > 0)
        {
          while($refRow = mysqli_fetch_array($refferal_result_middle))
          {
            $ref = $refRow['User_ID'];

            $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
          }

            merge($user, $M_ID, 'level_3', 'level_4', $uniquesalt);
                
            header('Location: dashboard_3.php?m=success');
            exit;
          //update level_1
            
        }
            
            }
             
            
            
            if(mysqli_num_rows($refferal_result_middle) == 0)
        {
                
         $refferal_right = "SELECT * FROM user as u INNER JOIN level_4 as l ON u.User_ID=l.User_ID INNER JOIN cds as c ON l.User_ID=c.User_ID WHERE AND (l.completed=0 AND merge_1=0 AND  Active=1) OR (paid=1 AND l.completed=0 AND Active=1) OR (merge_3=0 and Level=5 and l.completed=0) ORDER BY l.Created ASC LIMIT 1";
        $refferal_result_right = mysqli_query($connection, $refferal_right) or die(mysqli_error($connection));
        
        
        if($refferal_right && mysqli_affected_rows($connection) == 1)
        {
          while($refRow = mysqli_fetch_array($refferal_result_right))
          {
            $ref = $refRow['User_ID'];

            $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
          }
            
            
            merge($user, $M_ID, 'level_3', 'level_4', $uniquesalt);
          
            header('Location: dashboard_3.php?m=success');
            exit;
            
        }
            
            
        }
            }       
                      
                      
 ///// LEFT AND RIGHT MAGIC       
                  
            
                  
                  }     
                  
            
                  
                  }     
                  
            
                  
                  }   
                  
            
                  
                  }     
                  
            
                  
                  }
        }
        else
        {
            /// run for user's sponsors
            merge($user, $M_ID, 'level_3', 'level_4', $uniquesalt);
          
            header('Location: dashboard_3.php?m=success');
            exit;
            
        }
  }
  //check level 4

//check level 5
  if(array_key_exists('upgrade4', $_POST))
  {


        //level_3 magic
        //check for refferal
     $refferal_spon = "SELECT * FROM user as u INNER JOIN level_5 as l ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID=m.ref_ID INNER JOIN cds as c ON l.User_ID=c.User_ID WHERE (l.completed=0 AND merge_1=0 AND Ben_ID='$fifth_gen_salt' AND Active=1) OR (Ben_ID='$fifth_gen_salt' AND paid=1 AND l.completed=0 AND Active=1) OR (Ben_ID='$fifth_gen_salt' and merge_3=0 and Level=6 and l.completed=0) ORDER BY l.Created ASC LIMIT 1";
     $refferal_result_spon = mysqli_query($connection, $refferal_spon) or die(mysqli_error($connection));    
        
        if($refferal_spon && mysqli_affected_rows($connection) == 1)
        {
          while($refRow_spon = mysqli_fetch_array($refferal_result_spon))
          {
            $ref = $refRow_spon['User_ID'];

            $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
          }
        }
        
        if(mysqli_num_rows($refferal_result_spon) == 0)
        {
            
           
        // Find your sponosor's sponsor

          
          ///Now look for the Higher Sponsor to overtake your own sponsor
          
       $refferal_spon_1 = "SELECT * from user as u INNER JOIN level_5 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID = m.ref_ID INNER JOIN cds as c ON l.User_ID = c.User_ID where (l.completed=0 and merge_1=0 and Ben_ID='$fouth_gen_salt' AND Active=1) or (Ben_ID='$fouth_gen_salt' and paid=1 and l.completed=0 AND Active=1) OR (Ben_ID='$fouth_gen_salt' and merge_3=0 and Level=6 and l.completed=0) ORDER BY l.Created DESC LIMIT 1";

      $refferal_result_spon_1 = mysqli_query($connection, $refferal_spon_1) or die(mysqli_error($connection));

      if($refferal_spon_1 && mysqli_affected_rows($connection) == 1)
      {
          

          
        while($refRow_spon_1 = mysqli_fetch_array($refferal_result_spon_1))
        {
          $ref = $refRow_spon_1['User_ID'];

          $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
          $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

          while($refMainRow = mysqli_fetch_array($refMainResult))
          {
              $M_ID = $refMainRow['User_ID'];
              $Mfirstname = $refMainRow['First_Name'];
              $Mlastname = $refMainRow['Last_Name'];
              $MbankName = $refMainRow['Bank_Name'];
              $Macc_Name = $refMainRow['Account_Name'];
              $M_img = $refMainRow['Image'];
              $Macc_Num = $refMainRow['Acc_No'];
              $M_phone = $refMainRow['Phone_1'];
              $Mtwitter = $refMainRow['Twitter_Url'];
              $Mfbook = $refMainRow['Facebook_Url'];
              $Mlevel = $refMainRow['Level'];
          }
        }
            
          
            merge($user, $M_ID, 'level_4', 'level_5', $uniquesalt);
          
            header('Location: dashboard_4.php?m=success');
            exit;
          
      }else
          {
          // Find your sponosor's sponsor (Henry's Sponsor)
          
          ///Now look for the Higher Sponsor to overtake your own sponsor
          
       $refferal_spon_2 = "SELECT * from user as u INNER JOIN level_5 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID = m.ref_ID INNER JOIN cds as c ON l.User_ID = c.User_ID where (l.completed=0 and merge_1=0 and Ben_ID='$third_gen_salt' AND Active=1) or (Ben_ID='$third_gen_salt' and paid=1 and l.completed=0 AND Active=1) OR (Ben_ID='$third_gen_salt' and merge_3=0 and Level=6 and l.completed=0) ORDER BY l.Created DESC LIMIT 1";

      $refferal_result_spon_2 = mysqli_query($connection, $refferal_spon_2) or die(mysqli_error($connection));

      if($refferal_spon_2 && mysqli_affected_rows($connection) == 1)
      {
          

          
        while($refRow_spon_2 = mysqli_fetch_array($refferal_result_spon_2))
        {
          $ref = $refRow_spon_2['User_ID'];

          $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
          $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

          while($refMainRow = mysqli_fetch_array($refMainResult))
          {
              $M_ID = $refMainRow['User_ID'];
              $Mfirstname = $refMainRow['First_Name'];
              $Mlastname = $refMainRow['Last_Name'];
              $MbankName = $refMainRow['Bank_Name'];
              $Macc_Name = $refMainRow['Account_Name'];
              $M_img = $refMainRow['Image'];
              $Macc_Num = $refMainRow['Acc_No'];
              $M_phone = $refMainRow['Phone_1'];
              $Mtwitter = $refMainRow['Twitter_Url'];
              $Mfbook = $refMainRow['Facebook_Url'];
              $Mlevel = $refMainRow['Level'];
          }
        }
            
          
            merge($user, $M_ID, 'level_4', 'level_5', $uniquesalt);
          
            header('Location: dashboard_4.php?m=success');
            exit;
          
      }else
          {
               // Find your sponosor's sponsor (Henry's Sponsor)
          
          ///Now look for the Higher Sponsor to overtake your own sponsor
          
       $refferal_spon_3 = "SELECT * from user as u INNER JOIN level_5 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID = m.ref_ID INNER JOIN cds as c ON l.User_ID = c.User_ID where (l.completed=0 and merge_1=0 and Ben_ID='$second_gen_salt' AND Active=1) or (Ben_ID='$second_gen_salt' and paid=1 and l.completed=0 AND Active=1) OR (Ben_ID='$second_gen_salt' and merge_3=0 and Level=6 and l.completed=0) ORDER BY l.Created DESC LIMIT 1";

      $refferal_result_spon_3 = mysqli_query($connection, $refferal_spon_3) or die(mysqli_error($connection));

      if($refferal_spon_3 && mysqli_affected_rows($connection) == 1)
      {
          

          
        while($refRow_spon_3 = mysqli_fetch_array($refferal_result_spon_3))
        {
          $ref = $refRow_spon_3['User_ID'];

          $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
          $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

          while($refMainRow = mysqli_fetch_array($refMainResult))
          {
              $M_ID = $refMainRow['User_ID'];
              $Mfirstname = $refMainRow['First_Name'];
              $Mlastname = $refMainRow['Last_Name'];
              $MbankName = $refMainRow['Bank_Name'];
              $Macc_Name = $refMainRow['Account_Name'];
              $M_img = $refMainRow['Image'];
              $Macc_Num = $refMainRow['Acc_No'];
              $M_phone = $refMainRow['Phone_1'];
              $Mtwitter = $refMainRow['Twitter_Url'];
              $Mfbook = $refMainRow['Facebook_Url'];
              $Mlevel = $refMainRow['Level'];
          }
        }
            
          
            merge($user, $M_ID, 'level_4', 'level_5', $uniquesalt);
          
            header('Location: dashboard_4.php?m=success');
            exit;
          
      }else
          {
                          // Find your sponosor's sponsor (Henry's Sponsor)
          
          ///Now look for the Higher Sponsor to overtake your own sponsor
          
       $refferal_spon_4 = "SELECT * from user as u INNER JOIN level_5 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID = m.ref_ID INNER JOIN cds as c ON l.User_ID = c.User_ID where (l.completed=0 and merge_1=0 and Ben_ID='$first_gen_salt' AND Active=1) or (Ben_ID='$first_gen_salt' and paid=1 and l.completed=0 AND Active=1) OR (Ben_ID='$first_gen_salt' and merge_3=0 and Level=6 and l.completed=0) ORDER BY l.Created DESC LIMIT 1";

      $refferal_result_spon_4 = mysqli_query($connection, $refferal_spon_4) or die(mysqli_error($connection));

      if($refferal_spon_4 && mysqli_affected_rows($connection) == 1)
      {
          

          
        while($refRow_spon_4 = mysqli_fetch_array($refferal_result_spon_4))
        {
          $ref = $refRow_spon_4['User_ID'];

          $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
          $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

          while($refMainRow = mysqli_fetch_array($refMainResult))
          {
              $M_ID = $refMainRow['User_ID'];
              $Mfirstname = $refMainRow['First_Name'];
              $Mlastname = $refMainRow['Last_Name'];
              $MbankName = $refMainRow['Bank_Name'];
              $Macc_Name = $refMainRow['Account_Name'];
              $M_img = $refMainRow['Image'];
              $Macc_Num = $refMainRow['Acc_No'];
              $M_phone = $refMainRow['Phone_1'];
              $Mtwitter = $refMainRow['Twitter_Url'];
              $Mfbook = $refMainRow['Facebook_Url'];
              $Mlevel = $refMainRow['Level'];
          }
        }
            
          
            merge($user, $M_ID, 'level_4', 'level_5', $uniquesalt);
          
            header('Location: dashboard_4.php?m=success');
            exit;
          
      }else
          {
                      // Find your sponosor's sponsor (Henry's Sponsor)
          
          ///Now look for the Higher Sponsor to overtake your own sponsor
          
       $refferal_spon_5 = "SELECT * from user as u INNER JOIN level_5 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID = m.ref_ID INNER JOIN cds as c ON l.User_ID = c.User_ID where (l.completed=0 and merge_1=0 and Ben_ID='$uniquesalt' AND Active=1) or (Ben_ID='$uniquesalt' and paid=1 and l.completed=0 AND Active=1) OR (Ben_ID='$uniquesalt' and merge_3=0 and Level=6 and l.completed=0) ORDER BY l.Created DESC LIMIT 1";

      $refferal_result_spon_5 = mysqli_query($connection, $refferal_spon_5) or die(mysqli_error($connection));

      if($refferal_spon_5 && mysqli_affected_rows($connection) == 1)
      {
          

          
        while($refRow_spon_5 = mysqli_fetch_array($refferal_result_spon_5))
        {
          $ref = $refRow_spon_5['User_ID'];

          $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
          $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

          while($refMainRow = mysqli_fetch_array($refMainResult))
          {
              $M_ID = $refMainRow['User_ID'];
              $Mfirstname = $refMainRow['First_Name'];
              $Mlastname = $refMainRow['Last_Name'];
              $MbankName = $refMainRow['Bank_Name'];
              $Macc_Name = $refMainRow['Account_Name'];
              $M_img = $refMainRow['Image'];
              $Macc_Num = $refMainRow['Acc_No'];
              $M_phone = $refMainRow['Phone_1'];
              $Mtwitter = $refMainRow['Twitter_Url'];
              $Mfbook = $refMainRow['Facebook_Url'];
              $Mlevel = $refMainRow['Level'];
          }
        }
            
          
            merge($user, $M_ID, 'level_4', 'level_5', $uniquesalt);
          
            header('Location: dashboard_4.php?m=success');
            exit;
          
      }else
          {
             ///// LEFT AND RIGHT MAGIC
              

          //level_3 magic
        //check for refferal
      $refferal_left = "SELECT * FROM user as u LEFT JOIN merge_2_tree as m ON u.Salt=m.Ben_ID RIGHT JOIN cds as c ON c.User_ID=u.User_ID RIGHT JOIN level_5 as l ON l.User_ID=u.User_ID WHERE (l.completed=0 AND merge_1=0 AND Active=1 AND m.ref_ID='$first_gen_id') OR (paid=1 AND l.completed=0 AND Active=1 AND m.ref_ID='$first_gen_id')  OR (merge_3=0 and Level=6 and l.completed=0 and m.ref_ID='$first_gen_id') ORDER BY l.Created ASC LIMIT 1";
        $refferal_result_left = mysqli_query($connection, $refferal_left) or die(mysqli_error($connection));
        

        if(mysqli_num_rows($refferal_result_left) > 0)
        {
          while($refRow = mysqli_fetch_array($refferal_result_left))
          {
            $ref = $refRow['User_ID'];

            $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
          }
            
            merge($user, $M_ID, 'level_4', 'level_5', $uniquesalt);
          
            header('Location: dashboard_4.php?m=success');
            exit;
            
            
            
        }elseif(mysqli_num_rows($refferal_result_left) == 0)
        {
            
            $get_ref_ids_1="SELECT * FROM merge_2_tree as m INNER JOIN user as u ON u.Salt=m.Ben_ID WHERE ref_ID='$first_gen_id'";
            $get_ref_ids_result_1 = mysqli_query($connection, $get_ref_ids_1) or die (mysqli_error($connection));
            
            while($get_ref_ids_row_1 = mysqli_fetch_array($get_ref_ids_result_1))
            {
              
            $get_ref_id_1 =  $get_ref_ids_row_1 ['User_ID'];
            
            $refferal_middle = "SELECT * FROM user as u LEFT JOIN merge_2_tree as m ON u.Salt=m.Ben_ID RIGHT JOIN cds as c ON c.User_ID=u.User_ID RIGHT JOIN level_5 as l ON l.User_ID=u.User_ID WHERE (l.completed=0 AND merge_1=0 AND Active=1 AND m.ref_ID='$get_ref_id_1') OR (paid=1 AND l.completed=0 AND Active=1 AND m.ref_ID='$get_ref_id_1')  OR (merge_3=0 and Level=6 and l.completed=0 and m.ref_ID='$get_ref_id_1') ORDER BY l.Created ASC LIMIT 1";
            $refferal_result_middle = mysqli_query($connection, $refferal_middle) or die(mysqli_error($connection));  
            
            
            if(mysqli_num_rows($refferal_result_middle) > 0)
        {
          while($refRow = mysqli_fetch_array($refferal_result_middle))
          {
            $ref = $refRow['User_ID'];

            $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
          }

            merge($user, $M_ID, 'level_4', 'level_5', $uniquesalt);
                
            header('Location: dashboard_4.php?m=success');
            exit;
          //update level_1
            
        }
            
            }
            
            


            
            
            if(mysqli_num_rows($refferal_result_middle) == 0)
        
        {
                
         $refferal_right = "SELECT * FROM user as u INNER JOIN level_5 as l ON u.User_ID=l.User_ID INNER JOIN cds as c ON l.User_ID=c.User_ID WHERE AND (l.completed=0 AND merge_1=0 AND  Active=1) OR (paid=1 AND l.completed=0 AND Active=1) OR (merge_3=0 and Level=6 and l.completed=0) ORDER BY l.Created ASC LIMIT 1";
        $refferal_result_right = mysqli_query($connection, $refferal_right) or die(mysqli_error($connection));
        
        
        if($refferal_right && mysqli_affected_rows($connection) == 1)
        {
          while($refRow = mysqli_fetch_array($refferal_result_right))
          {
            $ref = $refRow['User_ID'];

            $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
          }
            
            
            merge($user, $M_ID, 'level_4', 'level_5', $uniquesalt);
          
            header('Location: dashboard_4.php?m=success');
            exit;
            
        }
            
            
        }
            }       
                      
                      
 ///// LEFT AND RIGHT MAGIC       
               ///// LEFT AND RIGHT MAGIC
              

          //level_3 magic
        //check for refferal
      $refferal_left = "SELECT * FROM user as u INNER JOIN level_5 as l ON u.User_ID=l.User_ID INNER JOIN cds as c ON l.User_ID=c.User_ID WHERE Position='Left' AND (l.completed=0 AND merge_1=0 AND  Active=1) OR (paid=1 AND l.completed=0 AND Active=1) OR (merge_3=0 and Level=6 and l.completed=0) ORDER BY l.Created ASC LIMIT 1";
        $refferal_result_left = mysqli_query($connection, $refferal_left) or die(mysqli_error($connection));
        

        if(mysqli_num_rows($refferal_result_left) > 0)
        {
          while($refRow = mysqli_fetch_array($refferal_result_left))
          {
            $ref = $refRow['User_ID'];

            $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
          }
            
            merge($user, $M_ID, 'level_4', 'level_5', $uniquesalt);
          
            header('Location: dashboard_4.php?m=success');
            exit;
            
            
            
        }elseif(mysqli_num_rows($refferal_result_left) == 0)
        {
            $refferal_middle = "SELECT * FROM user as u INNER JOIN level_5 as l ON u.User_ID=l.User_ID INNER JOIN cds as c ON l.User_ID=c.User_ID WHERE Position='Middle' AND (l.completed=0 AND merge_1=0 AND  Active=1) OR (paid=1 AND l.completed=0 AND Active=1) OR (merge_3=0 and Level=6 and l.completed=0) ORDER BY l.Created ASC LIMIT 1";
            $refferal_result_middle = mysqli_query($connection, $refferal_middle) or die(mysqli_error($connection));  
            
            
            if(mysqli_num_rows($refferal_result_middle) > 0)
        {
          while($refRow = mysqli_fetch_array($refferal_result_middle))
          {
            $ref = $refRow['User_ID'];

            $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
          }

            merge($user, $M_ID, 'level_4', 'level_5', $uniquesalt);
                
            header('Location: dashboard_4.php?m=success');
            exit;
          //update level_1
            
        }else
        {
                
         $refferal_right = "SELECT * FROM user as u INNER JOIN level_5 as l ON u.User_ID=l.User_ID INNER JOIN cds as c ON l.User_ID=c.User_ID WHERE Position='Right' AND (l.completed=0 AND merge_1=0 AND  Active=1) OR (paid=1 AND l.completed=0 AND Active=1) OR (merge_3=0 and Level=6 and l.completed=0) ORDER BY l.Created ASC LIMIT 1";
        $refferal_result_right = mysqli_query($connection, $refferal_right) or die(mysqli_error($connection));
        
        
        if($refferal_right && mysqli_affected_rows($connection) == 1)
        {
          while($refRow = mysqli_fetch_array($refferal_result_right))
          {
            $ref = $refRow['User_ID'];

            $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
          }
            
            
            merge($user, $M_ID, 'level_4', 'level_5', $uniquesalt);
          
            header('Location: dashboard_4.php?m=success');
            exit;
            
        }
            
            
        }
            }       
                      
                      
 ///// LEFT AND RIGHT MAGIC     
             
                  
                  }     
                  
             
                  
                  }     
                  
             
                  
                  }    
                  
             
                  
                  } 
                  
             
                  
                  }
        }
        else
        {
            /// run for user's sponsors
            merge($user, $M_ID, 'level_4', 'level_5', $uniquesalt);
          
            header('Location: dashboard_4.php?m=success');
            exit;
            
        }
  }
  //check level 5 end 


  //check level_6
  if(array_key_exists('upgrade5', $_POST))
  {


        //level_3 magic
        //check for refferal
      $refferal_spon = "SELECT * FROM user as u INNER JOIN level_6 as l ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID=m.ref_ID INNER JOIN cds as c ON l.User_ID=c.User_ID WHERE (l.completed=0 AND merge_1=0 AND Ben_ID='$fifth_gen_salt' AND Active=1) OR (Ben_ID='$fifth_gen_salt' AND paid=1 AND l.completed=0 AND Active=1) ORDER BY l.Created ASC LIMIT 1";
     $refferal_result_spon = mysqli_query($connection, $refferal_spon) or die(mysqli_error($connection));    
        
        if($refferal_spon && mysqli_affected_rows($connection) == 1)
        {
          while($refRow_spon = mysqli_fetch_array($refferal_result_spon))
          {
            $ref = $refRow_spon['User_ID'];

            $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
          }
        }
        
        if(mysqli_num_rows($refferal_result_spon) == 0)
        {
            
           
        // Find your sponosor's sponsor
            
          
          ///Now look for the Higher Sponsor to overtake your own sponsor
          
       $refferal_spon_1 = "SELECT * from user as u INNER JOIN level_6 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID = m.ref_ID INNER JOIN cds as c ON l.User_ID = c.User_ID where (l.completed=0 and merge_1=0 and Ben_ID='$fourth_gen_salt' AND Active=1) or (Ben_ID='$fourth_gen_salt' and paid=1 and l.completed=0 AND Active=1) ORDER BY l.Created DESC LIMIT 1";

      $refferal_result_spon_1 = mysqli_query($connection, $refferal_spon_1) or die(mysqli_error($connection));

      if($refferal_spon_1 && mysqli_affected_rows($connection) == 1)
      {
          

          
        while($refRow_spon_1 = mysqli_fetch_array($refferal_result_spon_1))
        {
          $ref = $refRow_spon_1['User_ID'];

          $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
          $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

          while($refMainRow = mysqli_fetch_array($refMainResult))
          {
              $M_ID = $refMainRow['User_ID'];
              $Mfirstname = $refMainRow['First_Name'];
              $Mlastname = $refMainRow['Last_Name'];
              $MbankName = $refMainRow['Bank_Name'];
              $Macc_Name = $refMainRow['Account_Name'];
              $M_img = $refMainRow['Image'];
              $Macc_Num = $refMainRow['Acc_No'];
              $M_phone = $refMainRow['Phone_1'];
              $Mtwitter = $refMainRow['Twitter_Url'];
              $Mfbook = $refMainRow['Facebook_Url'];
              $Mlevel = $refMainRow['Level'];
          }
        }
            
          
            merge($user, $M_ID, 'level_5', 'level_6', $uniquesalt);
          
            header('Location: dashboard_5.php?m=success');
            exit;
          
      }else
          {
         // Find your sponosor's sponsor Henry's Sponosor
            
          
          ///Now look for the Higher Sponsor to overtake your own sponsor
          
       $refferal_spon_2 = "SELECT * from user as u INNER JOIN level_6 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID = m.ref_ID INNER JOIN cds as c ON l.User_ID = c.User_ID where (l.completed=0 and merge_1=0 and Ben_ID='$third_gen_salt' AND Active=1) or (Ben_ID='$third_gen_salt' and paid=1 and l.completed=0 AND Active=1) ORDER BY l.Created DESC LIMIT 1";

      $refferal_result_spon_2 = mysqli_query($connection, $refferal_spon_2) or die(mysqli_error($connection));

      if($refferal_spon_2 && mysqli_affected_rows($connection) == 1)
      {
          

          
        while($refRow_spon_2 = mysqli_fetch_array($refferal_result_spon_2))
        {
          $ref = $refRow_spon_2['User_ID'];

          $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
          $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

          while($refMainRow = mysqli_fetch_array($refMainResult))
          {
              $M_ID = $refMainRow['User_ID'];
              $Mfirstname = $refMainRow['First_Name'];
              $Mlastname = $refMainRow['Last_Name'];
              $MbankName = $refMainRow['Bank_Name'];
              $Macc_Name = $refMainRow['Account_Name'];
              $M_img = $refMainRow['Image'];
              $Macc_Num = $refMainRow['Acc_No'];
              $M_phone = $refMainRow['Phone_1'];
              $Mtwitter = $refMainRow['Twitter_Url'];
              $Mfbook = $refMainRow['Facebook_Url'];
              $Mlevel = $refMainRow['Level'];
          }
        }
            
          
            merge($user, $M_ID, 'level_5', 'level_6', $uniquesalt);
          
            header('Location: dashboard_5.php?m=success');
            exit;
          
      }else
          {
            // Find your sponosor's sponsor Henry's Sponosor
            
          
          ///Now look for the Higher Sponsor to overtake your own sponsor
          
       $refferal_spon_3 = "SELECT * from user as u INNER JOIN level_6 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID = m.ref_ID INNER JOIN cds as c ON l.User_ID = c.User_ID where (l.completed=0 and merge_1=0 and Ben_ID='$second_gen_salt' AND Active=1) or (Ben_ID='$second_gen_salt' and paid=1 and l.completed=0 AND Active=1) ORDER BY l.Created DESC LIMIT 1";

      $refferal_result_spon_3 = mysqli_query($connection, $refferal_spon_3) or die(mysqli_error($connection));

      if($refferal_spon_3 && mysqli_affected_rows($connection) == 1)
      {
          

          
        while($refRow_spon_3 = mysqli_fetch_array($refferal_result_spon_3))
        {
          $ref = $refRow_spon_3['User_ID'];

          $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
          $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

          while($refMainRow = mysqli_fetch_array($refMainResult))
          {
              $M_ID = $refMainRow['User_ID'];
              $Mfirstname = $refMainRow['First_Name'];
              $Mlastname = $refMainRow['Last_Name'];
              $MbankName = $refMainRow['Bank_Name'];
              $Macc_Name = $refMainRow['Account_Name'];
              $M_img = $refMainRow['Image'];
              $Macc_Num = $refMainRow['Acc_No'];
              $M_phone = $refMainRow['Phone_1'];
              $Mtwitter = $refMainRow['Twitter_Url'];
              $Mfbook = $refMainRow['Facebook_Url'];
              $Mlevel = $refMainRow['Level'];
          }
        }
            
          
            merge($user, $M_ID, 'level_5', 'level_6', $uniquesalt);
          
            header('Location: dashboard_5.php?m=success');
            exit;
          
      }else
          {
            // Find your sponosor's sponsor Henry's Sponosor
            
          
          ///Now look for the Higher Sponsor to overtake your own sponsor
          
       $refferal_spon_4 = "SELECT * from user as u INNER JOIN level_6 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID = m.ref_ID INNER JOIN cds as c ON l.User_ID = c.User_ID where (l.completed=0 and merge_1=0 and Ben_ID='$first_gen_salt' AND Active=1) or (Ben_ID='$first_gen_salt' and paid=1 and l.completed=0 AND Active=1) ORDER BY l.Created DESC LIMIT 1";

      $refferal_result_spon_4 = mysqli_query($connection, $refferal_spon_4) or die(mysqli_error($connection));

      if($refferal_spon_4 && mysqli_affected_rows($connection) == 1)
      {
          

          
        while($refRow_spon_4 = mysqli_fetch_array($refferal_result_spon_4))
        {
          $ref = $refRow_spon_4['User_ID'];

          $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
          $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

          while($refMainRow = mysqli_fetch_array($refMainResult))
          {
              $M_ID = $refMainRow['User_ID'];
              $Mfirstname = $refMainRow['First_Name'];
              $Mlastname = $refMainRow['Last_Name'];
              $MbankName = $refMainRow['Bank_Name'];
              $Macc_Name = $refMainRow['Account_Name'];
              $M_img = $refMainRow['Image'];
              $Macc_Num = $refMainRow['Acc_No'];
              $M_phone = $refMainRow['Phone_1'];
              $Mtwitter = $refMainRow['Twitter_Url'];
              $Mfbook = $refMainRow['Facebook_Url'];
              $Mlevel = $refMainRow['Level'];
          }
        }
            
          
            merge($user, $M_ID, 'level_5', 'level_6', $uniquesalt);
          
            header('Location: dashboard_5.php?m=success');
            exit;
          
      }else
          {
             // Find your sponosor's sponsor Henry's Sponosor
            
          
          ///Now look for the Higher Sponsor to overtake your own sponsor
          
       $refferal_spon_5 = "SELECT * from user as u INNER JOIN level_6 as l  ON u.User_ID = l.User_ID INNER JOIN merge_2_tree as m ON l.User_ID = m.ref_ID INNER JOIN cds as c ON l.User_ID = c.User_ID where (l.completed=0 and merge_1=0 and Ben_ID='$uniquesalt' AND Active=1) or (Ben_ID='$uniquesalt' and paid=1 and l.completed=0 AND Active=1) ORDER BY l.Created DESC LIMIT 1";

      $refferal_result_spon_5 = mysqli_query($connection, $refferal_spon_5) or die(mysqli_error($connection));

      if($refferal_spon_5 && mysqli_affected_rows($connection) == 1)
      {
          

          
        while($refRow_spon_5 = mysqli_fetch_array($refferal_result_spon_5))
        {
          $ref = $refRow_spon_5['User_ID'];

          $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
          $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

          while($refMainRow = mysqli_fetch_array($refMainResult))
          {
              $M_ID = $refMainRow['User_ID'];
              $Mfirstname = $refMainRow['First_Name'];
              $Mlastname = $refMainRow['Last_Name'];
              $MbankName = $refMainRow['Bank_Name'];
              $Macc_Name = $refMainRow['Account_Name'];
              $M_img = $refMainRow['Image'];
              $Macc_Num = $refMainRow['Acc_No'];
              $M_phone = $refMainRow['Phone_1'];
              $Mtwitter = $refMainRow['Twitter_Url'];
              $Mfbook = $refMainRow['Facebook_Url'];
              $Mlevel = $refMainRow['Level'];
          }
        }
            
          
            merge($user, $M_ID, 'level_5', 'level_6', $uniquesalt);
          
            header('Location: dashboard_5.php?m=success');
            exit;
          
      }else
          {
              ///// LEFT AND RIGHT MAGIC
              

          //level_3 magic
        //check for refferal
      $refferal_left = "SELECT * FROM user as u LEFT JOIN merge_2_tree as m ON u.Salt=m.Ben_ID RIGHT JOIN cds as c ON c.User_ID=u.User_ID RIGHT JOIN level_6 as l ON l.User_ID=u.User_ID WHERE (l.completed=0 AND merge_1=0 AND Active=1 AND m.ref_ID='$first_gen_id') OR (paid=1 AND l.completed=0 AND Active=1 AND m.ref_ID='$first_gen_id') ORDER BY l.Created ASC LIMIT 1";
        $refferal_result_left = mysqli_query($connection, $refferal_left) or die(mysqli_error($connection));
        

        if(mysqli_num_rows($refferal_result_left) > 0)
        {
          while($refRow = mysqli_fetch_array($refferal_result_left))
          {
            $ref = $refRow['User_ID'];

            $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
          }
            
            merge($user, $M_ID, 'level_5', 'level_6', $uniquesalt);
          
            header('Location: dashboard_5.php?m=success');
            exit;
            
            
            
        }elseif(mysqli_num_rows($refferal_result_left) == 0)
        {
            $get_ref_ids_1="SELECT * FROM merge_2_tree as m INNER JOIN user as u ON u.Salt=m.Ben_ID WHERE ref_ID='$first_gen_id'";
            $get_ref_ids_result_1 = mysqli_query($connection, $get_ref_ids_1) or die (mysqli_error($connection));
            
            while($get_ref_ids_row_1 = mysqli_fetch_array($get_ref_ids_result_1))
            {
              
            $get_ref_id_1 =  $get_ref_ids_row_1 ['User_ID'];
            
               $refferal_middle = "SELECT * FROM user as u LEFT JOIN merge_2_tree as m ON u.Salt=m.Ben_ID RIGHT JOIN cds as c ON c.User_ID=u.User_ID RIGHT JOIN level_6 as l ON l.User_ID=u.User_ID WHERE (l.completed=0 AND merge_1=0 AND Active=1 AND m.ref_ID='$get_ref_id_1') OR (paid=1 AND l.completed=0 AND Active=1 AND m.ref_ID='$get_ref_id_1') ORDER BY l.Created ASC LIMIT 1";
            $refferal_result_middle = mysqli_query($connection, $refferal_middle) or die(mysqli_error($connection));  
            
            
            if(mysqli_num_rows($refferal_result_middle) > 0)
        {
          while($refRow = mysqli_fetch_array($refferal_result_middle))
          {
            $ref = $refRow['User_ID'];

            $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
          }

            merge($user, $M_ID, 'level_5', 'level_6', $uniquesalt);
                
            header('Location: dashboard_5.php?m=success');
            exit;
          //update level_1
            
        }
            
            }
            
            
            
            if(mysqli_num_rows($refferal_result_middle) == 0)
        {
                
         $refferal_right = "SELECT * FROM user as u INNER JOIN level_6 as l ON u.User_ID=l.User_ID INNER JOIN cds as c ON l.User_ID=c.User_ID (l.completed=0 AND merge_1=0 AND  Active=1) OR (paid=1 AND l.completed=0 AND Active=1) ORDER BY l.Created ASC LIMIT 1";
        $refferal_result_right = mysqli_query($connection, $refferal_right) or die(mysqli_error($connection));
        
        
        if($refferal_right && mysqli_affected_rows($connection) == 1)
        {
          while($refRow = mysqli_fetch_array($refferal_result_right))
          {
            $ref = $refRow['User_ID'];

            $refMain = "SELECT * FROM user WHERE User_ID='$ref'";
            $refMainResult = mysqli_query($connection, $refMain) or die(mysqli_error($connection));

            while($refMainRow = mysqli_fetch_array($refMainResult))
            {
                $M_ID = $refMainRow['User_ID'];
                $Mfirstname = $refMainRow['First_Name'];
                $Mlastname = $refMainRow['Last_Name'];
                $MbankName = $refMainRow['Bank_Name'];
                $Macc_Name = $refMainRow['Account_Name'];
                $M_img = $refMainRow['Image'];
                $Macc_Num = $refMainRow['Acc_No'];
                $M_phone = $refMainRow['Phone_1'];
                $Mtwitter = $refMainRow['Twitter_Url'];
                $Mfbook = $refMainRow['Facebook_Url'];
                $Mlevel = $refMainRow['Level'];
            }
          }
            
            
            merge($user, $M_ID, 'level_5', 'level_6', $uniquesalt);
          
            header('Location: dashboard_5.php?m=success');
            exit;
            
        }
            
            
        }
            }       
                      
                      
 ///// LEFT AND RIGHT MAGIC      
                   
            
                  
                  }      
                   
            
                  
                  }       
                   
            
                  
                  }  
                        
                   
            
                  
                  }  
                  
            
                  
                  }
        }
        else
        {
            /// run for user's sponsors
            merge($user, $M_ID, 'level_5', 'level_6', $uniquesalt);
          
            header('Location: dashboard_5.php?m=success');
            exit;
            
        }
  }
  //check level_5
?>
