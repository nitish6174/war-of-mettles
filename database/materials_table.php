<?php

	include "dbconf.php";

	if(mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database))
	{
		$query = "DELETE FROM `materials` WHERE 1;";
		if(!mysql_query($query))
		{
			$query = "CREATE TABLE materials (
						id INT(2) UNSIGNED PRIMARY KEY, 
						material1 INT(6) UNSIGNED,
						material2 INT(6) UNSIGNED,
						material3 INT(6) UNSIGNED
						)";
			mysql_query($query);
		}		
		for($i=1;$i<=50;$i++)
		{
			$query = "INSERT INTO `materials` (`id`, `material1`, `material2`, `material3`) VALUES ('$i', '0', '0', '0');";
			echo $query.'<br>';
			mysql_query($query);
		}
		
	}
	
?>