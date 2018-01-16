<?php
  // regular user_session timeout
  if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600))// time in seconds
  {
      // last request was more than 1 minute ago
      session_unset();     // unset $_SESSION variable for the run-time 
      session_destroy();   // destroy session data in storage
      header("Location: ../login.php?session_expired=yes");//redirect the user
      exit;
  }
  $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
  // regular session timeout
 ?>


<ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
  <li class="class="nav-link nav-toggle start active"">
    <form action="search_result.php" method="get" name="search" role="search">
      <div class="form-group">
        <input type="text" class="form-control" name="search_query" placeholder="email or username or phone no" style="width:75%;float:left;margin-left:5px; margin-right:5px;"/>
        <button type="submit" id="register-submit-btn" class="btn green btn small" name="go"><i class="fa fa-search"></i></button>
      </div>
    </form>
  </li>
  <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/admin/agent_dashboard.php'){?>class="nav-item start active" <?php }?>><a href="agent_dashboard.php" class="nav-link nav-toggle"><i class="icon-home"></i><span class="title"> Dashboard</span><span class="selected"></span></a>
    </li>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/admin/level_0.php'){?>class="nav-item start active" <?php }?>><a href="level_0.php" class="nav-link nav-toggle"><i class="fa fa-user-plus"></i><span class="title"> Entry Level Users</span><span class="selected"></span></a>
    </li>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/admin/level_1.php'){?>class="nav-item start active" <?php }?>><a href="level_1.php" class="nav-link nav-toggle"><i class="fa fa-user-plus"></i><span class="title"> Level 1 Users</span><span class="selected"></span></a>
    </li>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/admin/level_2.php'){?>class="nav-item start active" <?php }?>><a href="level_2.php" class="nav-link nav-toggle"><i class="fa fa-user-plus"></i><span class="title"> Level 2 Users</span><span class="selected"></span></a>
    </li>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/admin/level_3.php'){?>class="nav-item start active" <?php }?>><a href="level_3.php" class="nav-link nav-toggle"><i class="fa fa-user-plus"></i><span class="title"> Level 3 Users</span><span class="selected"></span></a>
    </li>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/admin/level_4.php'){?>class="nav-item start active" <?php }?>><a href="level_4.php" class="nav-link nav-toggle"><i class="fa fa-user-plus"></i><span class="title"> Level 4 Users</span><span class="selected"></span></a>
    </li>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/admin/level_5.php'){?>class="nav-item start active" <?php }?>><a href="level_5.php" class="nav-link nav-toggle"><i class="fa fa-user-plus"></i><span class="title"> Level 5 Users</span><span class="selected"></span></a>
    </li>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/admin/level_6.php'){?>class="nav-item start active" <?php }?>><a href="level_6.php" class="nav-link nav-toggle"><i class="fa fa-user-plus"></i><span class="title"> Level 6 Users</span><span class="selected"></span></a>
    </li>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/admin/elite.php'){?>class="nav-item start active" <?php }?>><a href="elite.php" class="nav-link nav-toggle"><i class="fa fa-user-plus"></i><span class="title"> Elite</span><span class="selected"></span></a>
    </li>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/admin/support_ticket.php'){?>class="nav-item start active" <?php }?>><a href="support_ticket.php" class="nav-link nav-toggle"><i class="fa fa-user-plus"></i><span class="title">Tickets</span><span class="selected"></span></a>
    </li>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/admin/agents_activities.php'){?>class="nav-item start active" <?php }?>><a href="agents_activities.php" class="nav-link nav-toggle"><i class="fa fa-user-plus"></i><span class="title"> Agents</span><span class="selected"></span></a>
    </li>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/admin/cds_activities.php'){?>class="nav-item start active" <?php }?>><a href="cds_activities.php" class="nav-link nav-toggle"><i class="fa fa-user-plus"></i><span class="title"> CDS Activities</span><span class="selected"></span></a>
    </li>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/admin/cds_approval.php'){?>class="nav-item start active" <?php }?>><a href="cds_approval.php" class="nav-link nav-toggle"><i class="icon-direction"></i><span class="title">CDS Approval</span><span class="selected"></span></a>
    </li>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/admin/funds_transfer.php'){?>class="nav-item start active" <?php }?>><a href="funds_transfer.php" class="nav-link nav-toggle"><i class="icon-share-alt"></i><span class="title">Transfer Funds</span><span class="selected"></span></a>
    </li>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/admin/ewallet_history.php'){?>class="nav-item start active" <?php }?>><a href="ewallet_history.php" class="nav-link nav-toggle"><i class="icon-folder"></i><span class="title">eWallet Transactions</span><span class="selected"></span></a>
    </li>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/admin/referral_payouts.php'){?>class="nav-item start active" <?php }?>><a href="referral_payouts.php" class="nav-link nav-toggle"><i class="fa fa-user-plus"></i><span class="title"> Referral Bonus</span><span class="selected"></span></a>
    </li>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/admin/referral_history.php'){?>class="nav-item start active" <?php }?>><a href="referral_history.php" class="nav-link nav-toggle"><i class="fa fa-user-plus"></i><span class="title"> Referral History</span><span class="selected"></span></a>
    </li>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/admin/suspensions.php'){?>class="nav-item start active" <?php }?>><a href="suspensions.php" class="nav-link nav-toggle"><i class="fa fa-user-plus"></i><span class="title"> Suspensions</span><span class="selected"></span></a>
    </li>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/admin/expired_matches.php'){?>class="nav-item start active" <?php }?>><a href="expired_matches.php" class="nav-link nav-toggle"><i class="fa fa-user-plus"></i><span class="title"> Expired Matches</span><span class="selected"></span></a>
    </li>
    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/admin/expired_confirmations.php'){?>class="nav-item start active" <?php }?>><a href="expired_confirmations.php" class="nav-link nav-toggle"><i class="fa fa-user-plus"></i><span class="title"> Expired Confirmations</span><span class="selected"></span></a>
    </li>

    <li <?php if($_SERVER['PHP_SELF'] == '/pm_exclusive/user/logout.php'){?>class="nav-item start active" <?php }?>><a href="../user/logout.php" class="nav-link nav-toggle"><i class="fa fa-user-plus"></i><span class="title"> Log Out</span><span class="selected"></span></a>
    </li>
</ul>