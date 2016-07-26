<?php
	
	include "../../database/dbconf.php";

	if(mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database))
	{
		$room=$_POST['room'];
		$row=$_POST['row'];
		$col=$_POST['col'];
		$level=$_POST['level'];
		$colName = 'w'.$row.$col;
		$query = "UPDATE `walls` set $colName=$level WHERE `room`=$room;";
		mysql_query($query);
	}

?>