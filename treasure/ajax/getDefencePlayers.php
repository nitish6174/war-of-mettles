<?php
	session_start();
	header('Content-Type: text/xml');
	echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

	echo '<response>';

		include "../../database/dbconf.php";

		if(mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database))
		{
			
			//walls data
			$room = $_POST['id'];
			$query = "select * from `walls` where `room`=$room";
			if ($query_run = mysql_query($query))
			{
				for($i=4;$i<=8;$i++)
				{
					//echo '<row'.$i.'>';
					for($j=1;$j<=9;$j++)
					{
						$colName = 'w'.$i.$j;
						$data = mysql_result($query_run,0,$colName);
						echo '<cell'.$i.$j.'>'.$data.'</cell'.$i.$j.'>';
					}
					//echo '</row'.$i.'>';
				}
			}
			// attack player data
			for($i=1;$i<=50;$i++)
			{
				$query = "select `id`,`room`,`row`,`col` from `attack_player` where `id`=$i";
				if ($query_run = mysql_query($query))
				{
					echo '<team'.$i.'>';
						echo '<id>'.mysql_result($query_run,0,'id').'</id>';
						echo '<room>'.mysql_result($query_run,0,'room').'</room>';
						echo '<row>'.mysql_result($query_run,0,'row').'</row>';
						echo '<col>'.mysql_result($query_run,0,'col').'</col>';
					echo '</team'.$i.'>';
				}
			}
		}

	echo '</response>';
?>