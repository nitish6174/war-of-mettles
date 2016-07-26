<?php
	
	include "../../database/dbconf.php";

	if(mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database))
	{
		$id=$_POST['id'];
		$room=$_POST['room'];
		$row=$_POST['row'];
		$col=$_POST['col'];			
		$query = "UPDATE `defence_player` set `room`=$room,`row`=$row,`col`=$col WHERE `id`=$id;";
		mysql_query($query);
	}

?>