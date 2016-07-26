<?php

	include "dbconf.php";

	if(mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database))
	{
		$query = "DELETE FROM `defence_player` WHERE 1;";
		if(!mysql_query($query))
		{
			$query = "CREATE TABLE defence_player (
						id INT(2) UNSIGNED PRIMARY KEY, 
						room INT(2),
						row INT(2),
						col INT(2)
						)";
			mysql_query($query);
		}
		
		for($i=1;$i<10;$i++)
		{
			$query = "INSERT INTO `defence_player` (`id`, `room`, `row`, `col`) VALUES ('$i', '$i', '9', '5');";
			echo $query.'<br>';
			mysql_query($query);
		}
		for($i=10;$i<=50;$i++)
		{
			$query = "INSERT INTO `defence_player` (`id`, `room`, `row`, `col`) VALUES ('$i', '$i', '9', '5');";
			echo $query.'<br>';
			mysql_query($query);
		}		
	}
	
?>