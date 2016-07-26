<?php
	
	include "../../database/dbconf.php";

	if(mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database))
	{
		$id=$_POST['id'];
		$change = $_POST['change'];

		$query = "update `users` set `treasure`=`treasure`+$change where `id`=$id";
		mysql_query($query);
	}

?>