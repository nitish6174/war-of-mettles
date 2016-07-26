<?php

	session_start();
	$id = $_SESSION['id'];

	header('Content-Type: text/xml');
	echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

	echo '<response>';

		echo '<teamId>';
			echo $id;
		echo '</teamId>';
		

		include "../database/dbconf.php";

		if(mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database))
		{	
			$query = "select `time` from `users` where `id`=$id";
			if ($query_run = mysql_query($query))
			{
				echo '<time>';
					echo mysql_result($query_run,0,'time');
				echo '</time>';
			}

			$query = "select * from `schedule1` where `id`=$id";
			if ($query_run = mysql_query($query))
			{
				echo '<table1>';
				for($i=1;$i<=3;$i++)
				{
					for($j=1;$j<=7;$j++)
					{
						$colName = 'c'.$i.$j;
						echo '<cell'.$i.$j.'>';
							echo mysql_result($query_run,0,$colName);
						echo '</cell'.$i.$j.'>';
					}
				}
				echo '</table1>';			
			}

			$query = "select * from `schedule2` where `id`=$id";
			if ($query_run = mysql_query($query))
			{
				echo '<table2>';
				for($i=1;$i<=7;$i++)
				{
					for($j=1;$j<=7;$j++)
					{
						$colName = 'c'.$i.$j;
						echo '<cell'.$i.$j.'>';
							echo mysql_result($query_run,0,$colName);
						echo '</cell'.$i.$j.'>';
					}
				}
				echo '</table2>';			
			}
		}

	echo '</response>';
?>