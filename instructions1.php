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
		if($state==2)
			header('Location: schedule');
		else if($state==3)
			header('Location: instructions2.php');
		else if($state==4)
			header('Location: treasure');
		else if($state==5)
			header('Location: finished.php');
	}
?>

<html>

<head>
	<title>Instructions</title>
	<meta charset="utf-8">  
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />

	<link rel="stylesheet" href="css/bootstrap.css"></link>
	<!-- <link rel="stylesheet" href="css/bootstrap-theme.css"></link> -->
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/instructions.css">
	<link href='https://fonts.googleapis.com/css?family=Signika' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<!-- <link rel="stylesheet" href="css/instructions1.css"></link> -->
</head>

<body>

	<div class="container">
	<div class="jumbotron" id="pageBox">

		<h2>Instructions - Troop scheduling</h2>

		<hr>

		<div class="row">
		<div class="col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
		<div class="story" id="storyBox">
			<ul id="instructionList" class="list-group">
				<li class="list-group-item">Make a 7-day schedule for the various types of troops available with you to defend the 3 main areas of the castle:</br> 
					<ul>
						<li>Outer Walls (W)</li>
						<li>Watch Tower (T)</li>
						<li>Main Gate (G)</li>
					</ul>
				</li>
				<li class="list-group-item">The 7 types of troops with their capabilities of defending the different area(s) available with you are:- <br><br>
				<!-- <div id="tablediv" class="list-group-item"> -->
				<table class="table table-striped table-condensed table-bordered">
					<tr id="tablehead">
						<td>Troop:</td>
						<td>Forte Areas:</td>
					</tr>
					<tr>
						<td>Long Bow-man</td>
						<td>Watch Tower</td>
					</tr>
					<tr>
						
						<td>Long Swords-man</td>
						<td>Main Gate, Outer Walls</td>
					</tr>
					<tr>
						
						<td>Crossbow-man</td>
						<td>Watch Tower, Outer Walls</td>
					</tr>
					<tr>
						
						<td>Ballista</td>
						<td>Main Gate</td>
					</tr>
					<tr>
						
						<td>Slinger</td>
						<td>Watch Tower, Outer Walls</td>
					</tr>
					<tr>
						
						<td>Axe-man</td>
						<td>Outer Walls, Main Gate</td>
					</tr>
					<tr>
						
						<td>Bow-man</td>
						<td>Watch Tower, Main Gate</td>
					</tr>
					</table>
					<!-- </div> -->
				</li>

				<li class="list-group-item">You must allocate two types of troops per area per day. One for the early shift and one for the late shift.</li>
				<li class="list-group-item">Make the best available use of your troops keeping in mind the following points
				<ul>
					<li>Every troop is entitled to days off. Days off are indicated with black cells in the lower table. You can't assign shifts on days off.</li>
					<li>Some troops prefer to take particular days off. This is indicated by gray cells in the lower table. These are preferences, rather than rules.</li>
					<li>The green cells in the lower table indicate strategic shifts. Allotting duties here fetches you more points</li>
					<li>Most soldiers dislike working too many late shifts. Therefore, the late shifts should be distributed as fairly as possible among the troops. You should aim to assign exactly 3 late shifts to each troop over the 7-day planning period.</li>
					<li>Soldiers like it when they are given long rest (3 days or more). Thus it fetches you points.</li>
				</ul>
				</li>
			
			<div  align="center" class="list-group-item" id="image">
				<img id="screenshot" src="screenshots/screenshot1.png">
			</div>
			</ul>	
			<!-- </div> -->
		</div>
		</div>
		</div>

		<hr>

		<button type="button" class="btn btn-success" onclick="redirect()"  style="float:right;">I'm ready</button> 

	</div>
	</div>



	<script type="text/javascript" src="js/jquery.js"></script>
  	<script type="text/javascript" src="js/bootstrap.js"></script>
  	<script type="text/javascript" src="js/instructions1.js"></script>

</body>
</html>