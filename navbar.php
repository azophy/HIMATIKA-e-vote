<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="./index.php">Pemilu HIMATIKA 2013</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <!-- <li class="active"><a href="./stat.php">Status</a></li> -->
              <li><a href="./stat.php">Count vote</a></li>
              <li><a href="javascript:void(0);" onClick="window.open('voting.php', '', 'fullscreen=yes, scrollbars=auto, width=1024, height=768');">Vote!!!</a></li>
              <li><a href="notif-panel.php">Notification Panel</a></li>
              <li><a href="http://pemira.himatika.itb.ac.id">About PH' 13</a></li>
            </ul>
<?php
if (!isset($_SESSION['id_user'])) {
?>
            <form class="navbar-form pull-right" method="post" action="login.php">
              <input class="span2" type="text" placeholder="Username" name="username">
              <input class="span2" type="password" placeholder="Password" name="password">
              <button type="submit" class="btn" name="login-submit">Sign in</button>
            </form>
<?php } else { ?>
			 <ul class="nav pull-right">
			   <li><a href="operator.php">Operator Panel</a></li>
			   <!-- <li><a href="initiate-fullscreen.php">Initiate Fullscreen</a></li> -->
			   <li><a href="login.php?logout=true">Log Out</a></li>
             </ul>
<?php } ?>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
