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
      
      .notif-box {
		  padding: 20px;
		  margin-bottom: 10px;
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
		
		while ($data_user = mysqli_fetch_array($query)) { ?>
			var refreshInterval<?php echo $data_user['id_user']; ?> = setInterval(function() { checkStatusNotif(<?php echo $data_user['id_user']; ?>); }, 1000);
<?php	} ?>
		});
    </script>
  </head>

  <body>
    <div class="container">
		<h1>E-vote status panel.</h1>
<?php
if (!isset($_SESSION['id_priviledge'])) {
?>
		<h1>We're sorry, but you don't have the necessery priviledge to access this section.</h1>
<?php } else { 
		$query = mysqli_query($db, "SELECT id_user, nama FROM user WHERE is_logged_in = '1'");
		while ($data_user = mysqli_fetch_array($query)) {

?>
		<div id="notif-<?php echo $data_user['id_user']; ?>" class="notif-box">
			<h1><?php echo $data_user['nama']; ?></h1>
		</div>
<?
		}
}
?>
      <hr>

<?php include "./footer.php"; ?>
    </div> <!-- /container -->
	
	</body>
</html>
