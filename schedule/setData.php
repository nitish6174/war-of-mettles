<?php

	session_start();
	$id = $_SESSION['id'];

	include "../database/dbconf.php";

	if(mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database))
	{
		$table1 = $_POST['table1'];
		$table2 = $_POST['table2'];
		$score = $_POST['score'];

		for($i=1;$i<=3;$i++)
		{
			for($j=1;$j<=7;$j++)
			{
				$colName = 'c'.$i.$j;
				$value = $table1[$i-1][$j-1];
				mysql_query("UPDATE `schedule1` SET $colName='$value' where `id`='$id'");
			}
		}
		for($i=1;$i<=7;$i++)
		{
			for($j=1;$j<=7;$j++)
			{
				$colName = 'c'.$i.$j;
				$value = $table2[$i-1][$j-1];
				mysql_query("UPDATE `schedule2` SET $colName='$value' where `id`='$id'");
			}
		}

		mysql_query("UPDATE `users` SET `schedule`='$score',`state`='3' where `id`='$id'");
	}

?>