<?php
session_start();
require_once "./config-pemilu.php";
?>
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
    <!-- <script type="text/javascript" src="js/disable-rightclick.js"></script> -->
  </head>

  <body>
    <div class="container">
<?php
if (!isset($_SESSION['id_user'])) {
?>
	<h1>Sorry, but you need to login before you could vote.</h1>
	<p>After 3 second, this page will be redirected to our homepage. Or you could just click <a href="index.php">here</a>.</p>
	<script>setInterval(function(){ top.location = "index.php"; },3000); </script>
<?php	
} else {
$query = mysqli_query($db, "SELECT value FROM data where var_name = 'evote-enabled-".$_SESSION['id_user']."'");
if ($query && (mysqli_num_rows($query) == 1) ) {
	$hasil = mysqli_fetch_row($query);
	
	if ($hasil[0] != 1) {
?>
		<script>
			function checkStatus() {
				$.post("ajax-handler.php", {operation: 1, id_user: <?php echo $_SESSION['id_user'];?>}, function(r) {
			       // format and output result
			       if (r == 1) {
				       top.location.reload();
				   }
			    });
			}
			
			$(document).ready(function() {
				var refreshInterval = setInterval (checkStatus, 1000);
			});
		</script>
		<h1>You still cannot vote.</h1>
		<p><a href="javascript: window.location.reload();">Refresh</a> or ask the operator to enabled it.</p>
<?php
	} else {
if (isset($_POST['submit'])) {
	echo '<h1>Sukses!!!</h1><p>After 3 second, this page will be redirected.</p>';
	echo '<script>setInterval(function(){ top.location = "voting.php"; }, 3000); </script>';
	
	mysqli_query($db, "UPDATE data  SET `value` =  '0' WHERE  `var_name` =  'evote-enabled-".$_SESSION['id_user']."'");
	mysqli_query($db,"INSERT INTO log VALUES('','".stripslashes($_POST['submit'])."','')");
}  else {
?>
		<script>
			function checkStatus() {
				$.post("ajax-handler.php", {operation: 1, id_user: <?php echo $_SESSION['id_user'];?>}, function(r) {
			       // format and output result
			       if (r != 1) {
				       top.location.reload();
				   }
			    });
			}
			
			$(document).ready(function() {
				var refreshInterval = setInterval (checkStatus, 1000);
			});
		</script>
		<h1>Now you're ready to vote!</h1><hr/>
      <!-- Main hero unit for a primary marketing message or call to action -->
      <form action="#" method="post">
      <div class="header-votng">
        <h1>Vote Area</h1><br/>
        <p>Silahkan pilih calon yang anda dukung dengan melakukan klik pada tomobol di bawah gambar calon.</p>
      </div>
		
      <!-- Example row of columns -->
      <div class="row">
<?php
$query = mysqli_query($db, "SELECT id_calon, nama, nim, img_url FROM calon");
$num_calon = mysqli_num_rows($query);
$pjg=12/$num_calon;
while ($data_calon = mysqli_fetch_array($query)) {
?>
        <div class="span<?php echo $pjg;?>">
          <h2><?php echo $data_calon['nama'];?></h2>
          <p><img src="<?php echo $data_calon['img_url'];?>" class="img-polaroid"></p>
          <button class="btn btn-large btn-block" type="submit" name="submit" value="<?php echo $data_calon['id_calon']; ?>" onClick="return confirm('Apakah anda yakin ingin memilih <?php echo  $data_calon['nama'];?>?');">Pilih <?php echo  $data_calon['nama'];?></button>
        </div>
<?php } ?>
      </div>
<?php
}
	}
}
}
?>
		</form>
      <hr>

<?php include "./footer.php"; ?>
    </div> <!-- /container -->
	</body>
</html>
