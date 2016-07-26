<?php
session_start();
header('Content-Type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

	echo '<response>';
	
	include "../../database/dbconf.php";

	if(mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database))
	{
		$room=$_POST['room'];
		$row=$_POST['row'];
		$col=$_POST['col'];
		$colName = 'w'.$row.$col;
		$query = "select * from `walls` WHERE `room`=$room";
		if($query_run=mysql_query($query)) {
			echo '<check>'.mysql_result($query_run,0,$colName).'</check>';
		}
	};
	echo '</response>';

?>