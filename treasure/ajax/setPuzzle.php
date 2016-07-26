<?php
	
	include "../../database/dbconf.php";

	if(mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database))
	{
		$id=$_POST['id'];
		$temp=$_POST['puzzleNumber'];
		$puzzle="puzzle".$temp;
		$query = "update `puzzles` set $puzzle='1' WHERE `id`=$id";
		mysql_query($query);
	}

?>