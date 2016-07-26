<?php

	ob_start();
	session_start();
	if(!isset($_SESSION['id']) || empty($_SESSION['id']))
	{
		header('Location: ..');
	}
	$id = $_SESSION['id'];
	
	include "../database/dbconf.php";

	if(mysql_connect($db_hostname,$db_username,$db_password) && mysql_select_db($db_database))
	{
		$query = "SELECT `state` FROM `users` WHERE `id`='$id';";
		$query_run = mysql_query($query);
		$state = mysql_result($query_run,0,'state');
		if($state==1)
			header('Location: ../instructions1.php');
		else if($state==2)
			header('Location: ../schedule');
		else if($state==3)
			header('Location: ../instructions2.php');
		else if($state==5)
			header('Location: ../finished.php');
	}
?>


<!DOCTYPE html>
<html>

<head>
	<title>Treasure Hunt</title>
	<meta charset="utf-8"/>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />

	<link rel="stylesheet" href="../css/bootstrap.css"></link>
	<!-- <link rel="stylesheet" href="../css/bootstrap-theme.css"></link> -->
	<link rel="stylesheet" href="../css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/dashboard.css">
</head>


<body>




	<div id="menuBar">
		<div class="menuLeft">
			<div id="pageTitle">THINK SOLVE N' STEAL</div>
		</div>
		<div class="menuCenter">
			<div class="menuBarOption" id="objective" data-toggle="modal" data-target="#objModal">Objective</div>
			<div class="menuBarOption" id="rules" data-toggle="modal" data-target="#rulesModal">Rules & scoring</div>
			<div class="menuBarOption" id="howToPlay" data-toggle="modal" data-target="#howModal">How to play</div>	
			<div class="menuBarOption" id="puzzleHelp" data-toggle="modal" data-target="#puzzlesModal">Help on puzzles</div>	
		</div>
		<div class="menuRight">
			<div id="teamId">Team ID : <span><?php echo $id; ?></span></div>
			<button class="btn btn-default" onclick="logout()">Logout</button>
		</div>	
	</div>

	<div id="infoBar">
		<div class="infoLeft">
			<div class="infoBarOption" id="d1">Wood : <span id="woodValue">?</span></div>
			<div class="infoBarOption" id="d2">Brick : <span id="brickValue">?</span></div>
			<div class="infoBarOption" id="d3">Concrete : <span id="concreteValue">?</span></div>
		</div>
		<div class="infoCenter">
			<div class="infoBarOption" id="treasure">Your treasure : <span id="treasureValue">?</span></div>
			<div class="infoBarOption" id="time">Time remaining : <span id="timeValue">?</span></div>
		</div>
		<div class="infoRight">
			<div class="infoBarOption" id="a1">Saw : <span id="sawValue">?</span></div>
			<div class="infoBarOption" id="a2">Hammer : <span id="hammerValue">?</span></div>
			<div class="infoBarOption" id="a3">Explosive : <span id="explosiveValue">?</span></div>
		</div>
	</div>


	<div id="wrapper">

		<div class="section" id="defenceSection">
			<div class="title" id="defenceTitle">Your Room</div>
			<div class="box" id="defenceBox"></div>
		</div>

		<div class="section" id="attackSection">
			<div class="title" id="attackTitle">Rooms</div>
			<div class="box" id="attackBox"></div>			
		</div>
	</div>

	<div id="toggle">
		<div class="buttonBar"><button class="toggleButton" id="defenceStoreButton"></button></div>
		<div class="buttonBar"><button class="toggleButton" id="attackStoreButton"></button></div>
	</div>

	<div id="alertMessage">
		<div class="messageBar">
			<div class="alert alert-warning" role="alert" id="defenceAlert">
				<!-- <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="false"></span> -->
				<!-- <span class="sr-only">Error:</span> -->
				<span class="msg"></span>
			</div>
		</div>
		<div class="messageBar">
			<div class="alert alert-warning" role="alert" id="attackAlert">
				<!-- <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="false"></span> -->
				<!-- <span class="sr-only">Error:</span> -->
				<span class="msg"></span>
			</div>
		</div>
	</div>








	<!-- Modals -->

	<div class="modal fade" id="objModal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<strong>Objective</strong>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					The Objective of this game is to obtain as much treasure as possible. 
				</div>

				<div class="modal-footer" style="text-align: center;">
					<nav>
						<ul class="pager">
							<!-- <li class="previous disabled"><a href="#"><span aria-hidden="true">&larr;</span> Older</a></li> -->
							<li class="next"><a data-dismiss="modal" data-toggle="modal" data-target="#rulesModal">Rules & scoring <span aria-hidden="true">&rarr;</span></a></li>
						</ul>
					</nav>
				</div>

			</div>
		</div>
	</div>

	<div class="modal fade" id="rulesModal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<strong>Rules & scoring</strong>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
				<ul style="text-align:left">
					<li>Every visit to an opponent's cell containing the treasure increases your treasure value by 10 and decreases that of the opponent by the same value.</li>
					<li>Earn treasure by solving puzzles in the attack store.</li>
					<li>A weapon of level x can destroy a wall of level less than or equal to x.</li>
				</ul>
				</div>

				<div class="modal-footer" style="text-align: center;">
					<nav>
						<ul class="pager">
							<li class="previous"><a data-dismiss="modal" data-toggle="modal" data-target="#objModal"><span aria-hidden="true">&larr;</span> Objective</a></li>
							<li class="next"><a data-dismiss="modal" data-toggle="modal" data-target="#howModal">How to play <span aria-hidden="true">&rarr;</span></a></li>
						</ul>
					</nav>
				</div>

			</div>
		</div>
	</div>

	<div class="modal fade" id="howModal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<strong>How to play</strong>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<ul style="text-align:left" style="padding-left:20px;">
						<li>In the defense room, use W,A,S,D keys to navigate up, left, down and right respectively.</li>
						<li>In the attack room, use arrow keys to navigate.</li>
						<li>To get out of attack room, go to the door in the first row and press UP arrow.</li>
						<li>To place walls, press SPACE. The walls can only be placed in the cell directly above your current position.</li>
						<li>To destroy walls, press the num-pad keys '1', '2', '3' for saw, hammer and explosive respectively. Walls directly below the current position will be destroyed.</li>
					</ul>
				</div>

				<div class="modal-footer" style="text-align: center;">
					<nav>
						<ul class="pager">
							<li class="previous"><a data-dismiss="modal" data-toggle="modal" data-target="#rulesModal"><span aria-hidden="true">&larr;</span> Rules & scoring</a></li>
							<!-- <li class="next disabled"><a data-toggle="modal" data-target="howModal">Rules & scoring <span aria-hidden="true">&rarr;</span></a></li> -->
						</ul>
					</nav>
				</div>

			</div>
		</div>
	</div>

	<div class="modal fade" id="puzzlesModal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header" style="text-align: center;">
					<strong style="font-size:18px;">How to solve puzzles</strong>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<br><br>
					<ul class="nav nav-pills nav-justified">
						<li role="presentation" class="active"><a data-toggle="pill" href="#tents">Tents</a></li>
						<li role="presentation"><a data-toggle="pill" href="#sums">Sums</a></li>
						<li role="presentation"><a data-toggle="pill" href="#ranges">Ranges</a></li>
						<li role="presentation"><a data-toggle="pill" href="#three">3-in-a-Row</a></li>
						<li role="presentation"><a data-toggle="pill" href="#islands">Islands</a></li>
					</ul>
				</div>

				<div class="modal-body">					
					<div class="tab-content">

					  <div id="tents" class="tab-pane active">
					    <h3>Tents</h3>
					    <p><strong>Find all of the hidden tents.</strong></p>
					    <ul style="text-align:left">					    
							<li>Each tent(yellow cell) is attached to one tree (so there are as many tents as there are trees).</li>
							<li>The numbers across the top and down the side tell you how many tents are in the respective row or column.</li>
							<li>A tent can only be found horizontally or vertically adjacent to a tree.</li>
							<li>Tents are never adjacent to each other, neither vertically, horizontally, nor diagonally.</li>
							<li>A tree might be next to two tents, but is only connected to one.</li>
					  	</ul>
					  	<img src="images/tents_example.png"><br><br>
					  	<p><strong>Click on the cells in the grid to toggle between the states</strong></p>
					  </div>

					  <div id="sums" class="tab-pane">
					    <h3>Sums</h3>
					    <p><strong>Complete all of the sums.</strong></p>
					    <ul style="text-align:left">					    
							<li>Find all of the Blue squares such that all of the totals match the clues.</li>
							<li>The clues are on the right and across the bottom and are the totals for the respective rows and columns.</li>
							<li>The numbers across the top and on the left are the values for each of the squares.</li>
							<li> E.g. the first square in a row or column is worth 1, the second 2, the third 3, and so on.</li>
							<li>Marking a square in Blue will add that square's value to both the row's total and the column's total.</li>
					  	</ul>
					  	<img src="images/kaku_example.png"><br><br>
					  	<p><strong>Click on the cells in the grid to toggle between the states</strong></p>
					  </div>

					  <div id="ranges" class="tab-pane">
					    <h3>Ranges</h3>
					    <p><strong>Complete the grid</strong></p>
					    <ul style="text-align:left">					    
							<li>Each number tells you how many white squares are reachable from that square, horizontally and vertically, in total, including the numbered square (i.e. the range)</li>
							<li>Black squares do not touch horizontally or vertically.</li>
							<li>Any white square can be reached from any other (i.e. they are connected).</li>
					  	</ul>
					  	<img src="images/range_example.png"><br><br>
					  	<p><strong>Click on the cells in the grid to toggle between the states</strong></p>
					  </div>

					  <div id="three" class="tab-pane">
					    <h3>3-in-a-Row</h3>
					    <ul style="text-align:left">					    
							<li>Fill the grid with Blue and White squares.</li>
							<li>A 3-In-A-Row of the same colour is not allowed.</li>
							<li>Each row and column has an equal number of Blue and White squares.</li>
					  	</ul>
					  	<img src="images/three_example.png"><br><br>
					  	<p><strong>Click on the cells in the grid to toggle between the states</strong></p>
					  </div>

					  <div id="islands" class="tab-pane">
					    <h3>Islands</h3>
					    <p><strong>Find all of the islands.</strong></p>
					    <ul style="text-align:left">					    
							<li>The completed grid is a sea of Blue water with White islands.</li>
							<li>The numbers tell you how many White squares are in each island.</li>
							<li>Every island is isolated from every other island vertically and horizontally but they may touch diagonally.</li>
							<li>All of the Blue water squares are connected.</li>
							<li>2x2 Blue water blocks are NOT allowed (2x2 White island blocks are).</li>
					  	</ul>
					  	<img src="images/islands_example.png"><br><br>
					  	<p><strong>Click on the cells in the grid to toggle between the states</strong></p>
					  </div>

					</div>
				</div>

				<!-- <div class="modal-footer" style="text-align: center;">
				</div> -->

			</div>
		</div>
	</div>


	
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type='text/javascript' src='../js/bootstrap.js'></script>
	<script type="text/javascript" src="js/dashboard.js"></script>



</body>


</html>










