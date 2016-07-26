<?php

	session_start();
	$id = $_SESSION['id'];

	header('Content-Type: text/xml');
	echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

	echo '<response>';
		echo '<teamId>';
			echo $id;
		echo '</teamId>';

		include "../../database/dbconf.php";

		if(mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database))
		{
			$query = "select `id`,`room`,`row`,`col` from `defence_player` where `id`=$id";
			if ($query_run = mysql_query($query))
			{
				echo '<defence>';
					echo '<id>'.mysql_result($query_run,0,'id').'</id>';
					echo '<room>'.mysql_result($query_run,0,'room').'</room>';
					echo '<row>'.mysql_result($query_run,0,'row').'</row>';
					echo '<col>'.mysql_result($query_run,0,'col').'</col>';
				echo '</defence>';
			}
			$query = "select `id`,`room`,`row`,`col` from `attack_player` where `id`=$id";
			if ($query_run = mysql_query($query))
			{
				echo '<attack>';
					echo '<id>'.mysql_result($query_run,0,'id').'</id>';
					$attack_room = mysql_result($query_run,0,'room');
					echo '<room>'.mysql_result($query_run,0,'room').'</room>';
					echo '<row>'.mysql_result($query_run,0,'row').'</row>';
					echo '<col>'.mysql_result($query_run,0,'col').'</col>';
				echo '</attack>';
			}
			// $query = "select `treasure` from `users` where `id`=$attack_room";
			// if ($query_run = mysql_query($query))
			// {
			// 		echo '<treasure>'.mysql_result($query_run,0,'treasure').'</treasure>';
			// }

		}
	echo '</response>';
?>