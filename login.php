<?php
session_start();

require_once "./config-pemilu.php";

if (!isset($_SESSION['id_user']) && isset($_POST['login-submit'])) {
	$query = mysqli_query($db,"SELECT id_user, id_priviledge FROM user where username='".stripslashes($_POST['username'])."' AND password='".md5($_POST['password'])."'");
	if ($query && (mysqli_num_rows($query) == 1) ) {
		$hasil = mysqli_fetch_row($query); 
		$_SESSION['id_user'] = $hasil[0];
		$_SESSION['id_priviledge'] = $hasil[1];
		mysqli_query($db, "UPDATE user SET is_logged_in = 1 WHERE id_user = '".$_SESSION['id_user']."'");
		echo '<h1>Login Succeed!</h1>';
	}
} else if (isset($_GET['force-logout']) && ($_SESSION['id_priviledge'] == 1)) {
	mysqli_query($db, "UPDATE user SET is_logged_in = 0 WHERE id_user = '".$_GET['id_user']."'");
	echo '<h1>Forced Logout Succeed!</h1>';
} else if (isset($_GET['logout']) && isset($_SESSION['id_user'])) {
	mysqli_query($db, "UPDATE user SET is_logged_in = 0 WHERE id_user = '".$_SESSION['id_user']."'");
	session_destroy();
	echo '<h1>Logout Succeed!</h1>';
}
?>
<p>After 3 second, this page will be redirected. Or you could just click <a href="index.php">here</a>.</p>
<script>setInterval(function(){ top.location = "index.php"; },3000); </script>

