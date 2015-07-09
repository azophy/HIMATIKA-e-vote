<?php session_start(); require_once "./config-pemilu.php"; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <title>HIMATIKA 2013 Election System</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="">
	    <meta name="author" content="HIMATIKA 2013 Electoral Committee">
	
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
		
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
    
    <script type="text/javascript" src="js/jquery-1.6.2.js"></script>
    <script type="text/javascript" src="js/library.js"></script>
    <script>
		$(document).ready(function() {
<?php
		$query = mysqli_query($db, "SELECT id_user FROM user WHERE is_logged_in = '1'");
		while ($data_user = mysqli_fetch_array($query)) {
?>
			//var refreshInterval<?php echo $data_user['id_user'];?> = setInterval (checkStatus(<?php echo $data_user['id_user'];?>), 1000);
			setInterval (function() { checkStatus(<?php echo $data_user['id_user'];?>); }, 1000);
<?php	} ?>
			//setInterval(function() { alert('ok'); }, 1000);
		});
    </script>
  </head>

  <body>

    <?php require "./navbar.php"; ?>
    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1>Operator Panel</h1><br/>
        <p>Where the operator can control the operational of the e-vote system.</p>
        <ul>
<?php
if (!isset($_SESSION['id_priviledge']) || $_SESSION['id_priviledge'] != 1) {
?>
		<h1>We're sorry, but you don't have the necessery priviledge to access this section.</h1>
<?php } else { 
		$query = mysqli_query($db, "SELECT id_user, nama FROM user WHERE is_logged_in = '1'");
		while ($data_user = mysqli_fetch_array($query)) {

?>
		
		<h3>User <?php echo $data_user['nama']; ?></h3>
		<h1 id="display-evote-status-<?php echo $data_user['id_user']; ?>"></h1>
		<h3>Toggle E-vote access:</h3>
		<button id="enable-evote" class="btn btn-primary btn-large" onClick="enableEvote(<?php echo $data_user['id_user']; ?>)">Enable E-vote</button>
		<button id="disable-evote" class="btn btn-inverse btn-large" onClick="disableEvote(<?php echo $data_user['id_user']; ?>)">Disable E-vote</button>
		<a href="login.php?force-logout=true&id_user=<?php echo $data_user['id_user']; ?>" class="btn btn-danger btn-large">Disable E-vote Client</a>
		<hr/>
<?
		}
}
?>
		</ul>
      </div>

      <hr>

<?php include "./footer.php"; ?>
    </div> <!-- /container -->
	
	</body>
</html>
