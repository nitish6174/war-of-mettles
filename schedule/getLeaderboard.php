<?php

	header('Content-Type: text/xml');
	echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

	echo '<response>';

	include "../database/dbconf.php";

	if(mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database))
	{
		$query = "SELECT `id`,`schedule` FROM `users` ORDER BY `schedule` DESC";
		if ($query_run = mysql_query($query))
		{
			for($i=1;$i<=50;$i++)
			{
				echo '<row'.$i.'>';
				echo '<id>'; echo mysql_result($query_run,$i-1,'id'); echo '</id>';
				echo '<score>'; echo mysql_result($query_run,$i-1,'schedule'); echo '</score>';
				echo '</row'.$i.'>';
			}
		}
	}

	echo '</response>';

?>