<?php require_once '../includes/dbconnect.php' ?>
<?php
    $mainUser = $_POST['profile'];
    $mainBen = $_POST['id'];

    $checkben = "SELECT * FROM user WHERE Salt='$mainBen'";
    $checkBenResult = mysqli_query($connection, $checkben) or die(mysqli_error($connection));

    while($checkRow = mysqli_fetch_array($checkBenResult))
    {
      $checkLevel = $checkRow['Level'];

      if($level != $checkLevel)
      {
        $deleteMatch = "DELETE FROM merge_tree WHERE ref_ID='$mainUser' AND Ben_ID='$mainBen'";
        $deleteMatchResult = mysqli_query($connection, $deleteMatch) or die(mysqli_error($connection));

        $standby = "UPDATE referral set standby=1 WHERE Ben_ID='$mainBen'";
        $standbyresult = mysqli_query($connection, $standby) or die(mysqli_error($connection));
      }
    }

  ?>