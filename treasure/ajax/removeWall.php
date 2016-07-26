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
		$level=$_POST['level'];
		$colName = 'w'.$row.$col;
		$query = "select * from `walls` where `room`=$room";
		if($query_run=mysql_query($query)) 
		{
			$wallLevel = mysql_result($query_run, 0, $colName);
			if($wallLevel<=$level && $wallLevel>0)
			{
				$query = "UPDATE `walls` set $colName='0' WHERE `room`=$room";
				mysql_query($query);
				echo '<check>1</check>';
			}
			else
				echo '<check>0</check>';
		};
	}
	echo '</response>';
?>