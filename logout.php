<?php

	ob_start();
	session_start();

	if(isset($_SESSION['id']) && !empty($_SESSION['id']))
		$id = $_SESSION['id'];
	else
		$id = '0';

	session_destroy();
	//header('Location: index.php');
	
	if($id!=0)
	{
		$query = "UPDATE `users` set `logged_in`='0' WHERE `id`='$id'";

		include "database/dbconf.php";

		if( mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database) && mysql_query($query) )
		{			
			header('Location: ../war_of_mettles');
		}
		else
		{
			echo 'Error while logging out<br>';
			echo '<a href="../war_of_mettles">Click here</a> to go back to login page';
		}
	}
	else
	{
		echo 'You are already logged out<br>';		
		echo '<a href="../war_of_mettles">Click here</a> to go back to login page';
	}
	
?>