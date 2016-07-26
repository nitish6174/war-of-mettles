<?php

	ob_start();
	session_start();	
	if(!isset($_SESSION['id']) || empty($_SESSION['id']))
	{
		header('Location: ../war_of_mettles');
	}
	$id = $_SESSION['id'];
	
	include "database/dbconf.php";

	if(mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database))
	{
		$query = "SELECT `state` FROM `users` WHERE `id`='$id';";
		$query_run = mysql_query($query);
		$state = mysql_result($query_run,0,'state');
		if($state==1)
			header('Location: instructions1.php');
		else if($state==2)
			header('Location: schedule');
		else if($state==3)
			header('Location: instructions2.php');
		else if($state==4)
			header('Location: treasure');
	}
?>

<html>

<head>
	<title>War over!</title>
	<meta charset="utf-8">  
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />

	<link rel="stylesheet" href="css/bootstrap.css"></link>
	<!-- <link rel="stylesheet" href="../css/bootstrap-theme.css"></link> -->
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/finished.css"></link>
</head>

<body>

	<div class="container">
	<div class="jumbotron" id="pageBox">

		<h2>War over!</h2>

		<hr>

		<div class="row">
		<div class="col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
		<div class="jumbotron" id="storyBox">
			We hope you did well and enjoyed battling against your peers.
		</div>
		</div>
		</div>

	</div>
	</div>



	<script type="text/javascript" src="js/jquery.js"></script>
  	<script type="text/javascript" src="js/bootstrap.js"></script>
  	<script type="text/javascript" src="js/finished.js"></script>

</body>