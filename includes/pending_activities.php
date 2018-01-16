<p class="alert alert-warning">
  Pending Level 4 activities
</p>
<?php
  $mergeChk = "SELECT * FROM merge as e INNER JOIN user as u ON e.Ben_ID=u.User_ID WHERE u.Level=3 AND e.Spons_Con=0 AND e.Spons_ID='$profile_ID'";
  $mergeChkRslt = mysqli_query($connection, $mergeChk) or die(mysqli_error($connection));

  while($mergeChkRow = mysqli_fetch_array($mergeChkRslt))
  {
    $merge = $mergeChkRow['id'];
    $ben = $mergeChkRow['Ben_ID'];
    $det = $mergeChkRow['Other_Details'];
    $amt = $mergeChkRow['Amount'];
    $type = $mergeChkRow['Trans_Type'];
    $teller = $mergeChkRow['Teller_No'];
    $img = $mergeChkRow['Image'];

    $show="SELECT * FROM merge WHERE id='$merge'";
                                $result = mysqli_query($connection, $show) or die(mysqli_error($connection));
                                while ($array = mysqli_fetch_array($result))
                                { 
                                  $timeStop = $array['Created'];
                                  //$evitimer = $array['Amount'];
                                  // $timer = date("Y-m-d H:i:s",time()+(24*3600));
                                  //match timer
                                  $timer = date("Y-m-d H:i:s",time());
                                  $countdown = strtotime($timer) - strtotime($timeStop);
                                  $del_0 = 86400 - $countdown;
                                  $delta_0 = gmdate("H:i:s", $del_0);

                                  //evidence timer
                                  //$eviDelta = strtotime($evitimer) - strtotime($timer);
                                }

                              $evishow="SELECT * FROM merge WHERE id='$merge'";
                              $eviresult = mysqli_query($connection, $evishow) or die(mysqli_error($connection));
                              while ($eviarray = mysqli_fetch_array($eviresult))
                              { 
                                $evitimer = $eviarray['Evi_Date'];
                                //match timer
                                $timer = date("Y-m-d H:i:s",time());

                                //evidence timer
                                  $evi_countdown = strtotime($timer) - strtotime($evitimer);
                                  $evi_del_0 =  86400 - $evi_countdown;
                                  $evi_delta_0 = gmdate("H:i:s", $evi_del_0);
                              }

    $getUser = "SELECT * FROM user WHERE User_ID='$ben'";
    $getUserResult = mysqli_query($connection, $getUser) or die(mysqli_error($connection));

    while($getRow = mysqli_fetch_array($getUserResult))
    {
      $get_ID = $getRow['User_ID'];
      $get_firstname = $getRow['First_Name'];
      $get_lastname = $getRow['Last_Name'];
      $get_bankName = $getRow['Bank_Name'];
      $get_acc_Name = $getRow['Account_Name'];
      $get_acc_Num = $getRow['Acc_No'];
      $get_phone = $getRow['Phone_1'];
      $get_phone2 = $getRow['Phone_2'];
      $getimg = $getRow['Image'];
      $getgen = $getRow['Gender'];
      $get_twitter = $getRow['Twitter_Url'];
      $get_fbook = $getRow['Facebook_Url'];
      $get_level = $getRow['Level'];
?>
<!--card-->
<div class="row">

    <h3>My Benefactor Information</h3><h4><?php echo $get_firstname ?>
                                    <?php
                                        if($del_0 < 86400)
                                      {
                                        if($del_0 < 0)
                                        {
                                          echo '<span style="color:red; font-weight:bold;">is due to pay you ₦60,000.</span>';   
                                        }
                                        else
                                        {
                                          echo 'will pay you ₦60,000 in <span style="color:red; font-weight:bold;">'.$delta_0.'</span> ';
                                        }
                                      }
                                      else
                                      {
                                        echo '<span style="color:red; font-weight:bold;">is due to pay you ₦60,000.</span>';
                                      }
                                     ?></h4>
    <div class="well row">
          <div class="col-md-7">
          <address>
              Full Name: <strong><?php echo $get_firstname ?>  <?php echo $get_lastname ?></strong><br><br>
              Added Note: <strong>Please Call me on and after payment. Dont forget to upload the details of your payment</strong><br><br>
              Phone 1: <strong><?php echo $get_phone ?></strong><br>
              Phone 2: <strong><?php echo $get_phone2 ?></strong><br>
              <hr>
          </address>
          </div>
          <div class="col-md-5">
          <div class="profile-userpic">
            <!--image logic-->
            <?php
              if($getimg)
              {
             ?>
             <img src="../assets/images/profile/<?php echo $getimg; ?>" class="img-responsive pic-bordered" alt="" />
             <?php
              }
              elseif($getgen == "Male")
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
            <!--image logic-->
          </div>
          </div>
          <div class="row">
          <div class="col-md-7">
              <?php
                                  
                                  $selectMerge = "SELECT * FROM merge WHERE id='$merge' AND Ben_Con=1";
                                          $selectMergeResult = mysqli_query($connection, $selectMerge) or die(mysqli_error($connection));
                                    if(mysqli_num_rows($selectMergeResult) > 0)
                                          {
                                        ?>
              <address>
              Payment Details: <strong><?php echo $det; ?></strong><br>
              Amount Paid: <strong><?php echo $amt; ?></strong><br>
              Type: <strong><?php echo $type ?></strong><br>
              Teller No.: <strong><?php echo $teller; ?></strong><br>
              <a href="../assets/images/evidence/<?php echo $img; ?>" target="_blank">click here for evidence image</a>
              <hr>
          </address>
              <?php } ?>
              
</div>
          <div class="col-md-5">
              <?php

                                          if(mysqli_num_rows($selectMergeResult) > 0)
                                          {
                                            if($evi_del_0 < 86400)
                                            {
                                              if($evi_del_0 < 0)
                                              {
                                                echo '<span style="color:red; font-weight:bold;">Confirmation Period Has Expired.</span>';   
                                              }
                                              else
                                              {
                                                echo 'You have <span style="color:red; font-weight:bold;">'.$evi_delta_0.'</span> to confirm';
                                              }
                                            }
                                            else
                                            {
                                              echo '<span style="color:red; font-weight:bold;">Confirmation Period Has Expired.</span>';
                                            }    
                                         ?>
              <form class="" action="" method="post">
                <input type="hidden" name="spons" value="<?php echo $profile_ID; ?>" class="form-control">
                <input type="hidden" name="ben" value="<?php echo $ben; ?>" class="form-control">
                <input type="hidden" name="merge2" value="<?php echo $merge; ?>" class="form-control">
                <button class="btn red btn-large" name="conPay4" type="submit"title="">Confirm Payment</button>
              </form>
              <?php } ?>
              </div>
          </div>
      </div>
</div>
<!--card-->
<?php
    }
  }
?>
<?php
$level3Button = "SELECT * FROM level_4 WHERE User_ID='$profile_ID' AND Merge_2=1";
$level3Result = mysqli_query($connection, $level3Button) or die(mysqli_error($connection));
if($level3Result && mysqli_affected_rows($connection) == 1)
{
$startButton = "SELECT * FROM level_4 WHERE User_ID='$profile_ID' AND Merge=1";
$startResult = mysqli_query($connection, $startButton) or die(mysqli_error($connection));

if($startButton && mysqli_affected_rows($connection) == 1)
{
    echo '<p class="alert alert-warning">Already Matched.</p>';

?>
<?php
if($level4Chk && mysqli_affected_rows($connection) == 0)
{
echo '<p class="alert alert-warning"> No Available Sponsors, Please Try Again Soon.</p>';
}
elseif($lvl4_con == 0)
{
?>
<div class="row">

<h3>My Sponsor Information</h3><h4><?php
                                        if($delta < -86400)
                                      {
                                        echo '<span style="color:red; font-weight:bold;">You are due to pay ₦100,000 to </span>';
                                      }
                                      else
                                      {
                                        echo 'You have <span id="countdown" style="color:red; font-weight:bold;"></span> to pay ₦100,000 to';
                                      }
                                     ?>
                                    <?php echo $M4firstname ?></h4>
            <div class="well row">
                <div class="col-md-7">
                <address>
                    Full Name: <strong><?php echo $M4firstname ?>  <?php echo $M4lastname ?></strong><br>
                    Account Name: <strong><?php echo $M4acc_Name ?></strong><br>
                    Bank Name: <strong><?php echo $M4bankName ?></strong><br>
                    Account No.: <strong><?php echo $M4acc_Num ?></strong><br>
                    Donation Type.: <strong>Cash or Transfer or Bank Payment</strong><br><br>
                    Added Note: <strong>Please Call me on and after payment. Dont forget to upload the details of your payment</strong><br><br>
                    Phone 1: <strong><?php echo $M4_phone ?></strong><br>
                    <!-- Phone 2: <strong>Loop, Inc.</strong><br> -->
                </address>
                </div>
                <div class="col-md-5">
                <div class="profile-userpic">
                  <!--image logic-->
                  <?php
                    if($M4_img)
                    {
                   ?>
                   <img src="../assets/images/profile/<?php echo $M4_img; ?>" class="img-responsive pic-bordered" alt="" />
                   <?php
                    }
                    elseif($M4_gen == "Male")
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
                  <!--image logic-->
                </div>
                </div>
                <div class="row">
                <div class="col-md-7">
                    
</div>
                <div class="col-md-5">
                    <a href="payDetail.php?match_ID=<?php echo $M4_ID; ?>&ID=<?php echo $lvl_id; ?>" class="btn btn-sm green">
                         <i class="fa fa-edit"></i>
                        Upload Payment Details
                                </a>
                    </div>
                </div>
            </div>
</div>
<?php
}
else
{
echo '<p class="alert alert-warning">No matches, please try again soon.</p>';
}
?>
<?php
}
else
{
?>
<div class="note note-warning">
                                        <h4 class="block">Hello <?php echo $fname; ?>  <?php echo $lname; ?>! </h4>
                                        <p> Your third Match will be pending until you've upgraded to level 4. Please kindly click the Upgade button bellow and pay your sponosor now. <br><br> Thanks</p>
        
                                    </div>
<p>
<form class="" action="" method="post">
<input type="hidden" name="startID" value="<?php echo $profile_ID?>" class="form-control">
<input type="hidden" name="matchID" value="<?php echo $M4_ID?>" class="form-control">
<button type="submit" id="register-submit-btn" class="btn btn-primary mt-ladda-btn ladda-button green" data-style="expand-right" name="upgrade4"><span class="ladda-label"><i class="icon-arrow-right"></i> Upgrade Now</span></button>
</form>
</p>
<?php
}
}
 ?>

 <!-- remaining moves -->
 <hr>
 <p class="alert alert-danger">
   Pending Level 3 activities
 </p>
   <?php
     $level2Chk = "SELECT * FROM merge as e INNER JOIN user as u ON e.Ben_ID=u.User_ID WHERE u.Level=2 AND e.Spons_Con=0 AND e.Spons_ID='$profile_ID'";
     $level2ChkRslt = mysqli_query($connection, $level2Chk) or die(mysqli_error($connection));

     while($level2ChkRow = mysqli_fetch_array($level2ChkRslt))
     {
       $level2 = $level2ChkRow['id'];
       $lvl2ben = $level2ChkRow['Ben_ID'];
       $lvl2det = $level2ChkRow['Other_Details'];
       $lvl2amt = $level2ChkRow['Amount'];
       $lvl2type = $level2ChkRow['Trans_Type'];
       $lvl2teller = $level2ChkRow['Teller_No'];
       $lvl2img = $level2ChkRow['Image'];

       $show="SELECT * FROM merge WHERE id='$level2'";
                                $result = mysqli_query($connection, $show) or die(mysqli_error($connection));
                                while ($array = mysqli_fetch_array($result))
                                { 
                                  $timeStop = $array['Created'];
                                  //$evitimer = $array['Amount'];
                                  // $timer = date("Y-m-d H:i:s",time()+(24*3600));
                                  //match timer
                                  $timer = date("Y-m-d H:i:s",time());
                                  $countdown = strtotime($timer) - strtotime($timeStop);
                                  $level_3 = 86400 - $countdown;
                                  $l_delta_0 = gmdate("H:i:s", $level_3);

                                  //evidence timer
                                  //$eviDelta = strtotime($evitimer) - strtotime($timer);
                                }

                              $evishow="SELECT * FROM merge WHERE id='$level2'";
                              $eviresult = mysqli_query($connection, $evishow) or die(mysqli_error($connection));
                              while ($eviarray = mysqli_fetch_array($eviresult))
                              { 
                                $evitimer = $eviarray['Evi_Date'];
                                //match timer
                                $timer = date("Y-m-d H:i:s",time());

                                //evidence timer
                                  $evi_countdown = strtotime($timer) - strtotime($evitimer);
                                  $evi_level_3 =  86400 - $evi_countdown;
                                  $evi_delta_3 = gmdate("H:i:s", $evi_level_3);
                              }

       $get2User = "SELECT * FROM user WHERE User_ID='$lvl2ben'";
       $get2UserResult = mysqli_query($connection, $get2User) or die(mysqli_error($connection));

       while($get2Row = mysqli_fetch_array($get2UserResult))
       {
         $get2_ID = $get2Row['User_ID'];
         $get2_firstname = $get2Row['First_Name'];
         $get2_lastname = $get2Row['Last_Name'];
         $get2_bankName = $get2Row['Bank_Name'];
         $get2_acc_Name = $get2Row['Account_Name'];
         $get2_acc_Num = $get2Row['Acc_No'];
         $get2_phone = $get2Row['Phone_1'];
         $get2_phone2 = $get2Row['Phone_2'];
         $get2img = $get2Row['Image'];
         $get2gen = $get2Row['Gender'];
         $get2_twitter = $get2Row['Twitter_Url'];
         $get2_fbook = $get2Row['Facebook_Url'];
         $get2_level = $get2Row['Level'];
   ?>
   <!--card-->
   <div class="row">

       <h3>My Benefactor Information</h3><h4><?php echo $get2_firstname ?>
                                    <?php
                                        if($level_3 < 86400)
                                      {
                                        if($level_3 < 0)
                                        {
                                          echo '<span style="color:red; font-weight:bold;">is due to pay you ₦40,000.</span>';   
                                        }
                                        else
                                        {
                                          echo 'will pay you ₦40,000 in <span style="color:red; font-weight:bold;">'.$l_delta_0.'</span> ';
                                        }
                                      }
                                      else
                                      {
                                        echo '<span style="color:red; font-weight:bold;">is due to pay you ₦40,000.</span>';
                                      }
                                     ?></h4>
       <div class="well row">
             <div class="col-md-7">
             <address>
                 Full Name: <strong><?php echo $get2_firstname ?>  <?php echo $get2_lastname ?></strong><br><br>
                 Added Note: <strong>Please Call me on and after payment. Dont forget to upload the details of your payment</strong><br><br>
                 Phone 1: <strong><?php echo $get2_phone ?></strong><br>
                 Phone 2: <strong><?php echo $get2_phone2 ?></strong><br>
                 <hr>
             </address>
             </div>
             <div class="col-md-5">
             <div class="profile-userpic">
               <!--image logic-->
               <?php
                 if($get2img)
                 {
                ?>
                <img src="../assets/images/profile/<?php echo $get2img; ?>" class="img-responsive pic-bordered" alt="" />
                <?php
                 }
                 elseif($get2gen == "Male")
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
               <!--image logic-->
             </div>
             </div>
             <div class="row">
             <div class="col-md-7">
                 <?php
                                  
                                  $selectMerge_lk = "SELECT * FROM merge WHERE id='$level2' AND Ben_Con=1";
                                          $selectMergeResult_lk = mysqli_query($connection, $selectMerge_lk) or die(mysqli_error($connection));
                                    if(mysqli_num_rows($selectMergeResult_lk) > 0)
                                          {
                                        ?>
                 <address>
                 Payment Details: <strong><?php echo $lvl2det; ?></strong><br>
                 Amount Paid: <strong><?php echo $lvl2amt; ?></strong><br>
                 Type: <strong><?php echo $lvl2type ?></strong><br>
                 Teller No.: <strong><?php echo $lvl2teller; ?></strong><br>
                 <a href="../assets/images/evidence/<?php echo $lvl2img; ?>" target="_blank">click here for evidence image</a>
                 <hr>
             </address>
                 <?php } ?>
                 <a href="javascript:;" class="btn btn-sm green">
                     Twitter
                             </a>
                 <a href="javascript:;" class="btn btn-sm blue">
                     Facebook
                             </a>
</div>
             <div class="col-md-5">
                 <?php
                 

                                          if(mysqli_num_rows($selectMergeResult_lk) > 0)
                                          {
                                            if($evi_level_3 < 86400)
                                            {
                                              if($evi_level_3 < 0)
                                              {
                                                echo '<span style="color:red; font-weight:bold;">Confirmation Period Has Expired.</span>';   
                                              }
                                              else
                                              {
                                                echo 'You have <span style="color:red; font-weight:bold;">'.$evi_delta_3.'</span> to confirm';
                                              }
                                            }
                                            else
                                            {
                                              echo '<span style="color:red; font-weight:bold;">Confirmation Period Has Expired.</span>';
                                            }    
                                         ?>
                 <form class="" action="" method="post">
                   <input type="hidden" name="spons" value="<?php echo $profile_ID; ?>" class="form-control">
                   <input type="hidden" name="ben" value="<?php echo $lvl2ben; ?>" class="form-control">
                   <input type="hidden" name="merge2" value="<?php echo $level2; ?>" class="form-control">
                   <button class="btn red btn-large" name="conPay3" type="submit"title="">Confirm Payment</button>
                 </form>
                 <?php } ?>
                 </div>
             </div>
         </div>
   </div>
   <!--card-->
   <?php
       }
     }
   ?>
 <!-- end remaining moves -->
