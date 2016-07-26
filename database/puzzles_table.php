<?php

	include "dbconf.php";

	if(mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database))
	{
		$query = "DELETE FROM `puzzles` WHERE 1;";
		if(!mysql_query($query)) {
			$query = "CREATE TABLE puzzles (
						id INT(2) UNSIGNED PRIMARY KEY, 
						puzzle11 INT(6) UNSIGNED,
						puzzle12 INT(6) UNSIGNED,
						puzzle13 INT(6) UNSIGNED,
						puzzle21 INT(6) UNSIGNED,
						puzzle22 INT(6) UNSIGNED,
						puzzle23 INT(6) UNSIGNED,
						puzzle31 INT(6) UNSIGNED,
						puzzle32 INT(6) UNSIGNED,
						puzzle33 INT(6) UNSIGNED,
						puzzle41 INT(6) UNSIGNED,
						puzzle42 INT(6) UNSIGNED,
						puzzle43 INT(6) UNSIGNED,
						puzzle51 INT(6) UNSIGNED,
						puzzle52 INT(6) UNSIGNED,
						puzzle53 INT(6) UNSIGNED
						)";
			mysql_query($query);
		}		
		for($i=1;$i<=50;$i++)
		{
			$query = "INSERT INTO `puzzles` VALUES ('$i', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');";
			echo $query.'<br>';
			mysql_query($query);
		}		
	}
	
?>