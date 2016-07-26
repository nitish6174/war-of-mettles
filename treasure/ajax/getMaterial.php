<?php

	session_start();

	header('Content-Type: text/xml');
	echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

	echo '<response>';
	$id=$_POST['id'];

	include "../../database/dbconf.php";

	if(mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database))
	{
		$query = "select * from `materials` where `id`=$id";
		if($query_run=mysql_query($query))
		{
			echo '<wood>'.mysql_result($query_run, 0, 'material1').'</wood>';
			echo '<brick>'.mysql_result($query_run, 0, 'material2').'</brick>';
			echo '<concrete>'.mysql_result($query_run, 0, 'material3').'</concrete>';
		}
	}
	echo '</response>';
?>