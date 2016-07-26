<?php

	include "dbconf.php";

	if(mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database))
	{
		$query = "DELETE FROM `schedule2` WHERE 1;";
		if(!mysql_query($query))
		{
			$query = "CREATE TABLE schedule2 (
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
						c37 INT(2) UNSIGNED,
						c41 INT(2) UNSIGNED,
						c42 INT(2) UNSIGNED,
						c43 INT(2) UNSIGNED,
						c44 INT(2) UNSIGNED,
						c45 INT(2) UNSIGNED,
						c46 INT(2) UNSIGNED,
						c47 INT(2) UNSIGNED,
						c51 INT(2) UNSIGNED,
						c52 INT(2) UNSIGNED,
						c53 INT(2) UNSIGNED,
						c54 INT(2) UNSIGNED,
						c55 INT(2) UNSIGNED,
						c56 INT(2) UNSIGNED,
						c57 INT(2) UNSIGNED,
						c61 INT(2) UNSIGNED,
						c62 INT(2) UNSIGNED,
						c63 INT(2) UNSIGNED,
						c64 INT(2) UNSIGNED,
						c65 INT(2) UNSIGNED,
						c66 INT(2) UNSIGNED,
						c67 INT(2) UNSIGNED,
						c71 INT(2) UNSIGNED,
						c72 INT(2) UNSIGNED,
						c73 INT(2) UNSIGNED,
						c74 INT(2) UNSIGNED,
						c75 INT(2) UNSIGNED,
						c76 INT(2) UNSIGNED,
						c77 INT(2) UNSIGNED
						)";
			mysql_query($query);
			echo $query.'<br><br>';
		}		
		for($i=1;$i<=50;$i++)
		{
			$query = "INSERT INTO `schedule2` VALUES ('$i', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');";
			echo $query.'<br>';
			mysql_query($query);
		}		
	}
	
?>