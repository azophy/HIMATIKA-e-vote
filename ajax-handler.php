<?php
session_start();

require_once "./config-pemilu.php";

if (isset($_POST['operation'])) {
	switch ($_POST['operation']) {
		case '1': 
			$query = mysqli_query($db, "SELECT value FROM data where var_name = 'evote-enabled-".$_POST['id_user']."'");
			if ($query && (mysqli_num_rows($query) == 1) ) {
				$hasil = mysqli_fetch_row($query);
				echo $hasil[0];
			}
		break; //check is evote enabled or not
		case '2': 
			$query = mysqli_query($db, "UPDATE data  SET `value` =  '".stripslashes($_POST['value'])."' WHERE  `var_name` =  'evote-enabled-".$_POST['id_user']."'");
		break; //enter data into log
		case '3':
			$hasil = array();
			$i=0;
			$query = mysqli_query($db, "SELECT id_user FROM user WHERE is_logged_in = '1'");
			while ($data_user = mysqli_fetch_array($query)) {
				$query2 = mysqli_query($db, "SELECT value FROM data where var_name = 'evote-enabled-".$data_user['id_user']."'");
				if ($query2 && (mysqli_num_rows($query2) == 1) ) {
					$hasil[$i++] = mysqli_fetch_row($query2);
				}
			}
			echo json_encode($hasil);
		break; //check is evote enabled or not (for multiple client instance)
		case '4': 
			//if (!isset($_SESSION['id_retrieve']) || empty($_SESSION['id_retrieve'])) $_SESSION['id_retrieve'] = 0;
			$query = mysqli_query($db, "SELECT id_calon FROM log LIMIT ".$_POST['limit'].",1");
			$_SESSION['id_retrieve']++;
			$hasil=mysqli_fetch_row($query);
			echo $hasil[0];
		break; //get data one by one for counting
		
	}
}
?>
