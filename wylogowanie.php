<?php
$dbhost = 'localhost';
$dbuser = '15_drozdowski';
$dbpass = 'J1a1h6x4t8';
$dbname = '15_drozdowski';
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);
	if (!$conn ) {
	die('Bład połączenia z serwerem: ' . mysql_error());
	}
	mysql_select_db($dbname);

    session_start();
		mysql_query("call Zysk(".$_SESSION['id'].")");
    session_unset();
    header('Location: index.php');
?>
