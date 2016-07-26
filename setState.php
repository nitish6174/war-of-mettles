<?php

	ob_start();
	session_start();
	$id = $_SESSION['id'];

	include "database/dbconf.php";

	if( mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database) )
	{
		$state = $_POST['state'];
		$query = "UPDATE `users` set `state`='$state' WHERE `id`='$id';";
		mysql_query($query);
	}

?>