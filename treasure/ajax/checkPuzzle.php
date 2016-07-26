<?php
session_start();
header('Content-Type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

	echo '<response>';
	
	include "../../database/dbconf.php";

	if(mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database))
	{
		$id=$_POST['id'];
		$temp=$_POST['puzzleNumber'];
		$puzzle="puzzle".$temp;
		$query = "select * from `puzzles` WHERE `id`=$id";
		if($query_run=mysql_query($query)) {
			echo '<check>'.mysql_result($query_run,0,$puzzle).'</check>';
		}
	};
	echo '</response>';

?>