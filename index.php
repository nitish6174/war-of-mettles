<?php

	ob_start();
	session_start();
	if(isset($_SESSION['id']) && !empty($_SESSION['id']))
	{
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
			else if($state==5)
				header('Location: finished.php');
		}
	}

?>

<html>

<head>
	<title>War of mettles</title>
	<meta charset="utf-8">  
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
  
  	<link rel='stylesheet' type='text/css' href='css/bootstrap.css' />
  	<!--<link rel='stylesheet' type='text/css' href='css/bootstrap-theme.css' />-->
  	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/login.css">
</head>

<body>

	<div class="container">
	<div class="jumbotron" id="pageBox">

		<h2>War of mettles</h2>

		<hr>

		<div class="row">
		<div class="col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
		<div class="jumbotron" id="storyBox">
			<p>
				The Empire of Tarkus needs a worthy successor.
				Kings of all the neighbouring kingdoms are drawn into a war for the throne, you being one of them.
				In the episode that follows, you have to prove your acumen as you compete against your peers.
			</p>
			<p>
				Each king has a castle and during the war, they will invade each other's castle to steal treasure.
				Evidently, the castle must have some defence arrangements and be well-guarded.
				You must ensure this in yours.
			</p>
			<p>
				And when the war begins, its the time to put up the walls, break into other kingdoms and increase your treasure.
			</p>
			<p>
			So guard your gold, make your strategies and stay alert !
			</p>
		</div>
		</div>
		</div>

		<hr>

		<div class="row">
		<div class="col-md-4 col-md-offset-4" style="text-align: center;">
		    <form role="form">
		    	<div class="form-group">
		    		<input type="text" class="form-control" placeholder="Enter ID" id="id">
		    	</div>
		    	<div class="form-group">
		    		<input type="password" class="form-control" placeholder="Enter password" id="password">
		    	</div>
		    <div class="alert alert-danger" role="alert" id="loginAlert">
		    	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="false"></span>
		    	<span class="sr-only">Error:</span>
		    	<span class="msg"></span>
		    	<!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
		    </div>
		    <input type="submit" class="btn btn-primary" onclick="return validateLogin()" value="Onwards to the Battlefield"/>
		    </form>
		</div>
		</div>

		<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal" id="loginButton">Onwards to the Battlefield</button> -->

	</div>
	</div>
	

	<!-- <div class="modal fade" id="loginModal" tabindex='-1'>
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<strong>Login to War Of Mettles</strong>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<form role="form">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Roll Number" id="roll">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Password" id="password">
						</div>
					</form>
					<div class="alert alert-danger" role="alert" id="loginAlert">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
						<span class="msg"></span>
					</div>
				</div>

				<div class="modal-footer" style="text-align: center;">
					<button type="submit" class="btn btn-primary" onclick="return validateLogin()">Log in</button>
				</div>

			</div>
		</div>
	</div> -->
  

	<script type="text/javascript" src="js/jquery.js"></script>
  	<script type="text/javascript" src="js/bootstrap.js"></script>
  	<script type="text/javascript" src="js/login.js"></script>
</body>

</html>