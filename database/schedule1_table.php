<?php

	include "dbconf.php";

	if(mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database))
	{
		$query = "DELETE FROM `schedule1` WHERE 1;";
		if(!mysql_query($query))
		{
			$query = "CREATE TABLE schedule1 (
						id INT(2) UNSIGNED PRIMARY KEY, 
						c11 INT(2) UNSIGNED,
						c12 INT(2) UNSIGNED,
						c13 INT(2) UNSIGNED,
						c14 INT(2) UNSIGNED,
						c15 INT(2) UNSIGNED,
						c16 INT(2) UNSIGNED,
						c17 INT(2) UNSIGNED,
						c21 INT(2) UNSIGNED,
						c22 INT(2) UNSIGNED,
						c23 INT(2) UNSIGNED,
						c24 INT(2) UNSIGNED,
						c25 INT(2) UNSIGNED,
						c26 INT(2) UNSIGNED,
						c27 INT(2) UNSIGNED,
						c31 INT(2) UNSIGNED,
						c32 INT(2) UNSIGNED,
						c33 INT(2) UNSIGNED,
						c34 INT(2) UNSIGNED,
						c35 INT(2) UNSIGNED,
						c36 INT(2) UNSIGNED,
						c37 INT(2) UNSIGNED
						)";
			mysql_query($query);
			echo $query.'<br><br>';
		}		
		for($i=1;$i<=50;$i++)
		{
			$query = "INSERT INTO `schedule1` VALUES ('$i', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3');";
			echo $query.'<br>';
			mysql_query($query);
		}		
	}
	
?>