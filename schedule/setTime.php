<?php

	session_start();
	$id = $_SESSION['id'];

	include "../database/dbconf.php";

	if(mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database))
	{
		$value = $_POST['value'];
		mysql_query("UPDATE `users` SET `time`='$value' where `id`='$id'");
	}

?>