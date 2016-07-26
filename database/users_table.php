<?php

	include "dbconf.php";

	if(mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database))
	{
		$query = "DELETE FROM `users` WHERE 1;";
		if(!mysql_query($query))
		{
			$query = "CREATE TABLE users (
						id INT(2) UNSIGNED PRIMARY KEY,
						password VARCHAR(10),
						logged_in INT(1) UNSIGNED,
						schedule INT(5),
						time INT(5),
						state INT(1),
						treasure INT(7) UNSIGNED
						)";
			echo $query.'<br><br>';
			mysql_query($query);
		}		
		for($i=1;$i<=50;$i++)
		{
			$password = (6174*$i)%10000;
			$query = "INSERT INTO `users` VALUES ('$i', '$password', '0', '-84', '1800', '0', '1000');";
			echo $query.'<br>';
			mysql_query($query);
		}
	}
	
?>