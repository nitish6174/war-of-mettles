<?php
	
	include "../../database/dbconf.php";

	if(mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database))
	{
		$id=$_POST['id'];
		$change = $_POST['amount'];
		$type = $_POST['type'];
		$material = 'material'.$type;

		$query = "update `materials` set `$material`=`$material`+$change where `id`=$id";
		mysql_query($query);
	}

?>