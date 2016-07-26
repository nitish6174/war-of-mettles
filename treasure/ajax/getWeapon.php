<?php

	session_start();

	header('Content-Type: text/xml');
	echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

	echo '<response>';
	$id=$_POST['id'];

	include "../../database/dbconf.php";

	if(mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database))
	{
		$query = "select * from `weapons` where `id`=$id";
		if($query_run=mysql_query($query))
		{
			echo '<saw>'.mysql_result($query_run, 0, 'weapon1').'</saw>';
			echo '<hammer>'.mysql_result($query_run, 0, 'weapon2').'</hammer>';
			echo '<explosive>'.mysql_result($query_run, 0, 'weapon3').'</explosive>';
		} 

	}
	echo '</response>';
?>