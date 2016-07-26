<?php

	include "dbconf.php";

	if(mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database))
	{
		$query = "DELETE FROM `walls` WHERE 1;";
		if(!mysql_query($query))
		{
			$query = "CREATE TABLE walls (
						room INT(2) UNSIGNED PRIMARY KEY, 
						w41 INT(6) UNSIGNED,
						w42 INT(6) UNSIGNED,
						w43 INT(6) UNSIGNED,
						w44 INT(6) UNSIGNED,
						w45 INT(6) UNSIGNED,
						w46 INT(6) UNSIGNED,
						w47 INT(6) UNSIGNED,
						w48 INT(6) UNSIGNED,
						w49 INT(6) UNSIGNED,
						w51 INT(6) UNSIGNED,
						w52 INT(6) UNSIGNED,
						w53 INT(6) UNSIGNED,
						w54 INT(6) UNSIGNED,
						w55 INT(6) UNSIGNED,
						w56 INT(6) UNSIGNED,
						w57 INT(6) UNSIGNED,
						w58 INT(6) UNSIGNED,
						w59 INT(6) UNSIGNED,
						w61 INT(6) UNSIGNED,
						w62 INT(6) UNSIGNED,
						w63 INT(6) UNSIGNED,
						w64 INT(6) UNSIGNED,
						w65 INT(6) UNSIGNED,
						w66 INT(6) UNSIGNED,
						w67 INT(6) UNSIGNED,
						w68 INT(6) UNSIGNED,
						w69 INT(6) UNSIGNED,
						w71 INT(6) UNSIGNED,
						w72 INT(6) UNSIGNED,
						w73 INT(6) UNSIGNED,
						w74 INT(6) UNSIGNED,
						w75 INT(6) UNSIGNED,
						w76 INT(6) UNSIGNED,
						w77 INT(6) UNSIGNED,
						w78 INT(6) UNSIGNED,
						w79 INT(6) UNSIGNED,
						w81 INT(6) UNSIGNED,
						w82 INT(6) UNSIGNED,
						w83 INT(6) UNSIGNED,
						w84 INT(6) UNSIGNED,
						w85 INT(6) UNSIGNED,
						w86 INT(6) UNSIGNED,
						w87 INT(6) UNSIGNED,
						w88 INT(6) UNSIGNED,
						w89 INT(6) UNSIGNED						
						)";
			mysql_query($query);
		}		
		for($i=1;$i<=50;$i++)
		{
			$query = "INSERT INTO `walls` VALUES ('$i', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');";
			echo $query.'<br>';
			mysql_query($query);
		}		
	}
	
?>