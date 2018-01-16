<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner"> <?php $d = date("Y"); echo $d; ?> &copy; Perfect Motion 4 Life
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->
<?php
  if(isset($connection))
  {
    mysqli_close($connection);
  }
 ?>
