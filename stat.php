<?php session_start(); 
require_once "./config-pemilu.php"; ?>
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
    
    <script src="js/jquery-1.6.2.js"></script>
  </head>

  <body>

    <?php require "./navbar.php"; ?>
    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
<?php
if (!isset($_SESSION['id_user'])) {
?>
	<h1>Sorry, but you need to login before you could vote.</h1>
<?php	
} else {
?>
        <div class="row">
			<div class="span6">
				<h1>Perhitungan Suara</h1>
			</div>
			<div class="span3">
		<?php
$num_suara = mysqli_num_rows(mysqli_query($db, "SELECT id FROM log")); ?>
				<h3>Jumlah total suara: <?php echo $num_suara; ?></h3>
			</div>
		</div>
		
        <br/>		
		<div class="row">
			<div class="span6">
				<label>Waktu perhitungan suara (dalam 1/1000 detik) : </label>
				<input type="text" id="waktu" value="4000"/>
				<button id="mulai" class="btn btn-success btn-large">Mulai perhitungan suara</button>
			</div>
			<div class="span4">
				<p>Suara <span id="nomer"></span>: <span id="spoil"></span></p>	
			</div>
		</div>
		
        <br/><br/>
        
        <?php
$query = mysqli_query($db, "SELECT id_calon, nama FROM calon");

while ($data_calon = mysqli_fetch_array($query)) {
?>
			<h3><?php echo $data_calon['nama']; ?></h3>
			<div class="progress progress-striped active">
			  <div id="bar-<?php echo $data_calon['id_calon']; ?>" class="bar" style="width: 0%;" ></div>
			  <input type="hidden" id="store-<?php echo $data_calon['id_calon']; ?>" value="0" />
			</div>
<?php
}
}
?>
      </div>

      <hr>

<?php include "./footer.php"; ?>
    </div> <!-- /container -->
	<script>
		 //setTimeout(function(){
		var total= <?php echo $num_suara; ?>;	 
		var ii = 0;
		var inc = 0;
		var waktu = 1000;
		
		function getSuara(id) {
			$.post("ajax-handler.php", {operation: 4, limit: id}, function(r) {
				$("#spoil").html('<h1>' + r + '</h1>');
				$("#nomer").text(ii);
		
				$("#store-" + r).val(Number($("#store-" + r).val()) + 1);
				$("#bar-" + r).css('width', String(Number($("#store-" + r).val())*inc) + '%');
				$("#bar-" + r).text($("#store-" + r).val() + ' suara');
			});
		}
        
        inc = 100/total;
        
        $("#mulai").click(function() {
			waktu = $("#waktu").val();
		    var loop = setInterval(function() {
				getSuara(ii);
				ii++;
				if (ii>=total) clearInterval(loop);
			}, waktu/total);
		});
	</script>	
	</body>
</html>
