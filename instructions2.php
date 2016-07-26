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
</head>

<body>

	<div class="container">
	<div class="jumbotron" id="pageBox">

		<h2>Instructions - Think solve n' steal</h2>

		<hr>

		<div class="row">
		<div class="col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
		<div class="story" id="storyBox">
			<ul id="instructionList" class="list-group">
				<li class="list-group-item">Finally the time for battle has come! The screen in the upcoming challenge will be divided into two parts</br> 
					<ul>
						<li>Defense section</li>
						<li>Attack section</li>
					</ul>
				</li>
				<li class="list-group-item">All the teams are provided with an initial amount of treasure in their room. The Objective is to defend your treasure while stealing or earning it at the same time.<br><br>
				
				</li>

				<li class="list-group-item">Defence:<br>
					<ul>
						<li>The treasure is to be defended by building walls of different material. The types of materials available with you are: 
						<table class="table table-striped table-condensed table-bordered">
							<tr>
								<td>Wood</td>
								<td>Level 1 protection</td>
							</tr>
							<tr>
								<td>Brick</td>
								<td>Level 2 protection</td>
							</tr>
							<tr>
								
								<td>Concrete</td>
								<td>Level 3 protection</td>
							</tr>
						</table>
						</li>
						<li>Every block of a material helps you set a wall in one cell.</li>
						<li>The material for building wall can be purchased from the defence store. Also you can toggle between your material by clicking on the respective buttons in the store but you can only take a single type of material in your room at a time.</li>
						<li>Wall can be placed only in one direction: Upwards, i.e., on the cell directly in front of you (direction towards the entry of the room).</li>
						<li>You can replace a lower level wall with a higher one but not vice versa.</li>
						<li>You cannot place your defences any higher than the 4th row from the top.</li>
					</ul>
				</li>
				<li class="list-group-item">Attack:<br>
					<ul>
						<li>You can attack an opponent's treasure by entering his room.</li>
						<li>Every visit to the cell containing the treasure increases your treasure value by 10 and decreases that of the opponent by the same value. There are no limits on the number of visits on the treasure cell.</li> 
						<li>At a time, at most 3 teams could be attacking in the same room.</li>
						<li>To break the walls set up by the defence player of that room, you have 3 kinds of weapons: 
						<table class="table table-striped table-condensed table-bordered">
							<tr>
								<td>Saw</td>
								<td>Level 1 destruction</td>
							</tr>
							<tr>
								<td>Hammer</td>
								<td>Level 2 destruction</td>
							</tr>
							<tr>
								
								<td>Explosive</td>
								<td>Level 3 destruction</td>
							</tr>
						</table>
						</li>
						<li>A weapon of level x can destroy a wall of level less than or equal to x.</li>
						<li>The weapons can be purchased from the Attack store.</li>
						<li>Wall can be destroyed only in one direction: Downwards, i.e., on the cell directly in front of you (direction towards the entry of the room).</li>
						<li>You can replace a lower level wall with a higher one but not vice versa.</li>
					</ul>
				</li>
				<li class="list-group-item">Rooms:<br>
				<ul>
					<li>
						Each team has it's own room assigned to them which they are tasked to protect.
					</li>
					<li>
						You can loot other players' treasure by attacking their rooms.
					</li>
					<li>
						Each room tile in the grid displays the amount of treasure within that room on hovering.
					</li>
					<li>
						There are only 2 ways to exit a room while attacking:<br>
						<ul id="circlelist">
							<li>
								To exit from the gate in the first row. No penalty is incurred when exiting the room from the gate.
							</li>
							<li>
								To use the esacape button to get back to the grid. Using this option costs you twice the amount of treasure looted from that particular room to be deducted from your total treasure.

							</li>
						</ul>
					</li>
				</ul>

				</li>
				<li class="list-group-item">Puzzles:<br>
				<ul>
					
					<li>
						You can increase your treasure by solving puzzles. The puzzles can be found in the Attack Store.
					</li>
					<li>
						There are a total of 5 different types of puzzles. Each puzzle has 3 levels of difficulty with varying rewards for each.
					</li>
					<li>
						Each puzzle of a particular difficulty and type can only be solved once. Detailed instructions and rules for solving the puzzles can be found in the nav bar.
					</li>
				</ul>

				</li>
				<li class="list-group-item">
				Controls: <br>
				<ul>
					<li>
						Use W,A,S,D to move up, left, down and right respectively in the defense room.
					</li>

					<li>
						Use arrow keys to move in the attack room.
					</li>
					<li>
						Walls can be placed by using the spacebar.
					</li>
					<li>
						To get out of attack room, go to the door in the first row and press UP arrow.
					</li>
					<li>
						Walls can be destroyed by using the num-pad '1', '2', '3' for saw, hammer and explosive respectively.
					</li>
					</ul>
					
				</li>
			<!-- <div  align="center" class="list-group-item" id="image"> -->
				<!-- <img id="screenshot" src="screenshots/screenshot2.png"> -->
			<!-- </div> -->
			</ul>	
			<!-- </div> -->
		</div>
		</div>
		</div>

		<hr>

		<div class="well" id="msg" style="text-align:center;">Next round soon to begin</div>
		<button type="button" class="btn btn-success" onclick="redirect()">I'm ready</button> 

	</div>
	</div>



	<script type="text/javascript" src="js/jquery.js"></script>
  	<script type="text/javascript" src="js/bootstrap.js"></script>
  	<script type="text/javascript" src="js/instructions2.js"></script>

</body>