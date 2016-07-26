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
		else if($state==3)
			header('Location: ../instructions2.php');
		else if($state==4)
			header('Location: ../treasure');
		else if($state==5)
			header('Location: ../finished.php');
	}
?>

<html>

<head>
	<title>War of mettles</title>
	<meta charset="utf-8">  
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />

	<link rel="stylesheet" href="../css/bootstrap.css"></link>
	<!-- <link rel="stylesheet" href="../css/bootstrap-theme.css"></link> -->
	<link rel="stylesheet" href="../css/font-awesome.css">
	<link rel="stylesheet" href="schedule.css"></link>
</head>


<body>


	<div id="menuBar">
		<div class="menuLeft">
			<div id="pageTitle">TROOP SCHEDULING</div>
		</div>
		<div class="menuCenter">
			<div class="menuBarOption" id="objective" data-toggle="modal" data-target="#objModal">Objective</div>
			<div class="menuBarOption" id="rules" data-toggle="modal" data-target="#rulesModal">Scoring</div>			
			<div class="menuBarOption" id="leaderboard" data-toggle="modal" data-target="#leaderboardModal" onclick="loadLeaderboard();">Leaderboard</div>
		</div>
		<div class="menuRight">
			<div id="teamId">Team ID : <span><?php echo $id; ?></span></div>
			<button class="btn btn-default" onclick="logout()">Logout</button>
		</div>	
	</div>

	
	
	<div id="infoBar">
	<div class="infoLeft">
		<div class="infoBarOption" id="score"> Current score : <span>0</span></div>
		<div class="infoBarOption" id="timeBonus"> Time bonus : <span>0</span></div>
	</div>
	<div class="infoCenter">
		<div class="infoBarOption" id="totalScore"> Total score : <span>0</span></div>
	</div>
	<div class="infoRight">
		<div class="infoBarOption" id="time"> Time remaining : <span>00:00</span></div>
		<div class="infoBarOption" id="submit">
			<button class="btn btn-primary" onclick="submit()">Submit my schedule</button>
		</div>
	</div>
	</div>







	<div class="row">








	<div class="col-md-3">
	<div id="scoreSection">
	<div class="panel panel-default" style="background-color: #fff;">

		<div class="panel-heading sSTitle">Your score break-up :</div>
		
		<ul class="list-group">
		<li class="list-group-item sSRow gain" id="sSAssigned">
			<div class="sSType">Shifts assigned</div>
			<div class="sSValue">
				<div class="sSMultiplier"></div>x<div class="sSCount"></div>=<div class="sSResult"></div>
			</div>
		</li>
		<li class="list-group-item sSRow gain" id="sSStrategic">
			<div class="sSType">Strategic shifts alloted</div>
			<div class="sSValue">
				<div class="sSMultiplier"></div>x<div class="sSCount"></div>=<div class="sSResult"></div>
			</div>
		</li>
		<li class="list-group-item sSRow gain" id="sSRest">
			<div class="sSType">Long rest given</div>
			<div class="sSValue">
				<div class="sSMultiplier"></div>x<div class="sSCount"></div>=<div class="sSResult"></div>
			</div>
		</li>
		<li class="list-group-item sSRow loss" id="sSDeviation">
			<div class="sSType">Deviation from 3 late shifts</div>
			<div class="sSValue">
				<div class="sSMultiplier"></div>x<div class="sSCount"></div>=<div class="sSResult"></div>
			</div>
		</li>
		<li class="list-group-item sSRow loss" id="sSDayoff">
			<div class="sSType">Shift assigned on dayoff preference</div>
			<div class="sSValue">
				<div class="sSMultiplier"></div>x<div class="sSCount"></div>=<div class="sSResult"></div>
			</div>
		</li>
		<li class="list-group-item sSRow loss" id="sSConsecutive">
			<div class="sSType">Late shift followed by early shift</div>
			<div class="sSValue">
				<div class="sSMultiplier"></div>x<div class="sSCount"></div>=<div class="sSResult"></div>
			</div>
		</li>
		</ul>

	</div>
	</div>
	</div>







	<div class="col-md-7">
	<div id="gameSection">		




		<div id="table1">
			<div class="t1Header" id="t1Row0">
				<div class="t1HeaderHeader" id="t1Row0Col0"></div>
				<div class="t1HeaderCell" id="t1Row0Col1">Day 1</div>
				<div class="t1HeaderCell" id="t1Row0Col2">Day 2</div>
				<div class="t1HeaderCell" id="t1Row0Col3">Day 3</div>
				<div class="t1HeaderCell" id="t1Row0Col4">Day 4</div>
				<div class="t1HeaderCell" id="t1Row0Col5">Day 5</div>
				<div class="t1HeaderCell" id="t1Row0Col6">Day 6</div>
				<div class="t1HeaderCell" id="t1Row0Col7">Day 7</div>				
			</div>
			<div class="t1Row" id="t1Row1">
				<div class="t1RowHeader" id="t1Row1Col0">Area 1</div>
				<div class="t1Cell" data-cTable="1" data-cRow="1" data-cCol="1"><div class="t1Early"></div><div class="t1Late"></div></div>
				<div class="t1Cell" data-cTable="1" data-cRow="1" data-cCol="2"><div class="t1Early"></div><div class="t1Late"></div></div>
				<div class="t1Cell" data-cTable="1" data-cRow="1" data-cCol="3"><div class="t1Early"></div><div class="t1Late"></div></div>
				<div class="t1Cell" data-cTable="1" data-cRow="1" data-cCol="4"><div class="t1Early"></div><div class="t1Late"></div></div>
				<div class="t1Cell" data-cTable="1" data-cRow="1" data-cCol="5"><div class="t1Early"></div><div class="t1Late"></div></div>
				<div class="t1Cell" data-cTable="1" data-cRow="1" data-cCol="6"><div class="t1Early"></div><div class="t1Late"></div></div>
				<div class="t1Cell" data-cTable="1" data-cRow="1" data-cCol="7"><div class="t1Early"></div><div class="t1Late"></div></div>
			</div>
			<div class="t1Row" id="t1Row2">
				<div class="t1RowHeader" id="t1Row2Col0">Area 2</div>
				<div class="t1Cell" data-cTable="1" data-cRow="2" data-cCol="1"><div class="t1Early"></div><div class="t1Late"></div></div>
				<div class="t1Cell" data-cTable="1" data-cRow="2" data-cCol="2"><div class="t1Early"></div><div class="t1Late"></div></div>
				<div class="t1Cell" data-cTable="1" data-cRow="2" data-cCol="3"><div class="t1Early"></div><div class="t1Late"></div></div>
				<div class="t1Cell" data-cTable="1" data-cRow="2" data-cCol="4"><div class="t1Early"></div><div class="t1Late"></div></div>
				<div class="t1Cell" data-cTable="1" data-cRow="2" data-cCol="5"><div class="t1Early"></div><div class="t1Late"></div></div>
				<div class="t1Cell" data-cTable="1" data-cRow="2" data-cCol="6"><div class="t1Early"></div><div class="t1Late"></div></div>
				<div class="t1Cell" data-cTable="1" data-cRow="2" data-cCol="7"><div class="t1Early"></div><div class="t1Late"></div></div>
			</div>
			<div class="t1Row" id="t1Row3">
				<div class="t1RowHeader" id="t1Row3Col0">Area 3</div>
				<div class="t1Cell" data-cTable="1" data-cRow="3" data-cCol="1"><div class="t1Early"></div><div class="t1Late"></div></div>
				<div class="t1Cell" data-cTable="1" data-cRow="3" data-cCol="2"><div class="t1Early"></div><div class="t1Late"></div></div>
				<div class="t1Cell" data-cTable="1" data-cRow="3" data-cCol="3"><div class="t1Early"></div><div class="t1Late"></div></div>
				<div class="t1Cell" data-cTable="1" data-cRow="3" data-cCol="4"><div class="t1Early"></div><div class="t1Late"></div></div>
				<div class="t1Cell" data-cTable="1" data-cRow="3" data-cCol="5"><div class="t1Early"></div><div class="t1Late"></div></div>
				<div class="t1Cell" data-cTable="1" data-cRow="3" data-cCol="6"><div class="t1Early"></div><div class="t1Late"></div></div>
				<div class="t1Cell" data-cTable="1" data-cRow="3" data-cCol="7"><div class="t1Early"></div><div class="t1Late"></div></div>
			</div>			
		</div>





		<div id="table2">
			<div class="t2Row" id="t2Row1">
				<div class="t2RowHeader" id="t2Row1Col0">
					<div class="troopName">A</div>
					<div class="troopArea"><div class="area1 hiddenCard">1</div><div class="area2 hiddenCard">2</div><div class="area3 hiddenCard">3</div></div>
					<div class="lateCount" id="ALate"><span>0</span></div>
				</div>
				<div class="t2Cell" data-cTable="2" data-cRow="1" data-cCol="1"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="1" data-cCol="2"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="1" data-cCol="3"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="1" data-cCol="4"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="1" data-cCol="5"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="1" data-cCol="6"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="1" data-cCol="7"><div class="t2Early"></div><div class="t2Late"></div></div>
			</div>
			<div class="t2Row" id="t2Row2">
				<div class="t2RowHeader" id="t2Row2Col0">
					<div class="troopName">B</div>
					<div class="troopArea"><div class="area1 hiddenCard">1</div><div class="area2 hiddenCard">2</div><div class="area3 hiddenCard">3</div></div>
					<div class="lateCount" id="BLate"><span>0</span></div>
				</div>
				<div class="t2Cell" data-cTable="2" data-cRow="2" data-cCol="1"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="2" data-cCol="2"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="2" data-cCol="3"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="2" data-cCol="4"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="2" data-cCol="5"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="2" data-cCol="6"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="2" data-cCol="7"><div class="t2Early"></div><div class="t2Late"></div></div>
			</div>
			<div class="t2Row" id="t2Row3">
				<div class="t2RowHeader" id="t2Row3Col0">
					<div class="troopName">C</div>
					<div class="troopArea"><div class="area1 hiddenCard">1</div><div class="area2 hiddenCard">2</div><div class="area3 hiddenCard">3</div></div>
					<div class="lateCount" id="CLate"><span>0</span></div>
				</div>
				<div class="t2Cell" data-cTable="2" data-cRow="3" data-cCol="1"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="3" data-cCol="2"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="3" data-cCol="3"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="3" data-cCol="4"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="3" data-cCol="5"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="3" data-cCol="6"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="3" data-cCol="7"><div class="t2Early"></div><div class="t2Late"></div></div>
			</div>
			<div class="t2Row" id="t2Row4">
				<div class="t2RowHeader" id="t2Row4Col0">
					<div class="troopName">D</div>
					<div class="troopArea"><div class="area1 hiddenCard">1</div><div class="area2 hiddenCard">2</div><div class="area3 hiddenCard">3</div></div>
					<div class="lateCount" id="DLate"><span>0</span></div>
				</div>
				<div class="t2Cell" data-cTable="2" data-cRow="4" data-cCol="1"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="4" data-cCol="2"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="4" data-cCol="3"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="4" data-cCol="4"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="4" data-cCol="5"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="4" data-cCol="6"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="4" data-cCol="7"><div class="t2Early"></div><div class="t2Late"></div></div>
			</div>
			<div class="t2Row" id="t2Row5">
				<div class="t2RowHeader" id="t2Row5Col0">
					<div class="troopName">E</div>
					<div class="troopArea"><div class="area1 hiddenCard">1</div><div class="area2 hiddenCard">2</div><div class="area3 hiddenCard">3</div></div>
					<div class="lateCount" id="ELate"><span>0</span></div>
				</div>
				<div class="t2Cell" data-cTable="2" data-cRow="5" data-cCol="1"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="5" data-cCol="2"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="5" data-cCol="3"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="5" data-cCol="4"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="5" data-cCol="5"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="5" data-cCol="6"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="5" data-cCol="7"><div class="t2Early"></div><div class="t2Late"></div></div>
			</div>
			<div class="t2Row" id="t2Row6">
				<div class="t2RowHeader" id="t2Row6Col0">
					<div class="troopName">F</div>
					<div class="troopArea"><div class="area1 hiddenCard">1</div><div class="area2 hiddenCard">2</div><div class="area3 hiddenCard">3</div></div>
					<div class="lateCount" id="FLate"><span>0</span></div>
				</div>
				<div class="t2Cell" data-cTable="2" data-cRow="6" data-cCol="1"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="6" data-cCol="2"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="6" data-cCol="3"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="6" data-cCol="4"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="6" data-cCol="5"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="6" data-cCol="6"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="6" data-cCol="7"><div class="t2Early"></div><div class="t2Late"></div></div>
			</div>
			<div class="t2Row" id="t2Row7">
				<div class="t2RowHeader" id="t2Row7Col0">
					<div class="troopName">G</div>
					<div class="troopArea"><div class="area1 hiddenCard">1</div><div class="area2 hiddenCard">2</div><div class="area3 hiddenCard">3</div></div>
					<div class="lateCount" id="GLate"><span>0</span></div>
				</div>
				<div class="t2Cell" data-cTable="2" data-cRow="7" data-cCol="1"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="7" data-cCol="2"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="7" data-cCol="3"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="7" data-cCol="4"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="7" data-cCol="5"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="7" data-cCol="6"><div class="t2Early"></div><div class="t2Late"></div></div>
				<div class="t2Cell" data-cTable="2" data-cRow="7" data-cCol="7"><div class="t2Early"></div><div class="t2Late"></div></div>
			</div>			
		</div>

	</div>
	</div>







	<div class="col-md-2" style="height: 100%;">
	<div id="helpSection">

	<div id="helpBox">
		<p id="helpTitle">Basic help</p>
		<div id="helpList" class="list-group">
			<div>
				First column of lower table shows troop ID, list of battlefields on which it can be assigned duty and the number of late shifts assigned to that troop
			</div>
			<div>
				Click on a sticker in upper table and then click in one of the highlighted cells in lower table to assign that duty
			</div>
			<div>
				To remove/reallot an assigned duty from a troop, click on that sticker in the lower table and then in a highlighted cell
			</div>
			<div>
				Grey boxes in lower table indicate that the troop wants to rest on that day.
				Assigning duty to grey boxes yields negative points
			</div>
			<div>
				Green blocks in lower table indicate strategic shifts. Assigning duties here fetch more points
			</div>
			<div>
				Black cells cannot be alloted duty as they are mandatory rest days
			</div>
		</div>		
	</div>

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

				<div class="modal-body" text-align:center>
				The objective of the game is to make a work schedule for your troops to defend the castle.

				</div>

				<div class="modal-footer" style="text-align: center;">
					<nav>
					  <ul class="pager">
					    <!-- <li class="previous disabled"><a href="#"><span aria-hidden="true">&larr;</span> Older</a></li> -->
					    <li class="next"><a data-dismiss="modal" data-toggle="modal" data-target="#rulesModal">Scoring <span aria-hidden="true">&rarr;</span></a></li>
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
					<strong>Scoring</strong>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
				<table class="table table-striped table-condensed table-bordered">
					<tr>
						<td>Assigning a shift</td>
						<td>+11</td>
					</tr>
					<tr>
						<td>Assigning a strategic shift</td>
						<td>+7</td>
					</tr>
					<tr>
						
						<td>For each allocated long rest (3 or more consecutive days off)</td>
						<td>+3</td>
					</tr>
					
					<tr>
						
						<td>For every shift assigned on day-off preference</td>
						<td>-8</td>
					</tr>
					<tr>
						
						<td>For every deviation from 3 late shifts</td>
						<td>-5</td>
					</tr>
					<tr>
						
						<td>For every late shift followed by an early shift</td>
						<td>-13</td>
					</tr>
					
					</table>
	
				

				</div>

				<div class="modal-footer" style="text-align: center;">
					<nav>
					  <ul class="pager">
					    <li class="previous"><a data-dismiss="modal" data-toggle="modal" data-target="#objModal"><span aria-hidden="true">&larr;</span> Objective</a></li>
					   
					  </ul>
					</nav>
				</div>

			</div>
		</div>
	</div>

	

	<!--	Leaderboard modal 	-->
	<div class="modal fade" id="leaderboardModal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<strong>Leaderboard</strong>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					The scores displayed are without time bonus<br><br>
					<table class="table table-striped table-hover table-condensed" style="width:60%;margin-left:20%;text-align:center;">
						<tr data-tRow="0"><th data-tCol="1">Team ID</th><th data-tCol="2">Score</th></tr>
						<tr data-tRow="1"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="2"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="3"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="4"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="5"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="6"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="7"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="8"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="9"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="10"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="11"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="12"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="13"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="14"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="15"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="16"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="17"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="18"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="19"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="20"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="21"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="22"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="23"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="24"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="25"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="26"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="27"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="28"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="29"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="30"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="31"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="32"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="33"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="34"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="35"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="36"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="37"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="38"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="39"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="40"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="41"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="42"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="43"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="44"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="45"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="46"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="47"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="48"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="49"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
						<tr data-tRow="50"><td data-tCol="1"></td><td data-tCol="2"></td></tr>
					</table>
				</div>

				<div class="modal-footer" style="text-align: center;">
					<button class="btn btn-primary" onclick="loadLeaderboard()">Refresh list</button>
				</div>

			</div>
		</div>
	</div>



	<!--	Loading modal 	-->
	<div class="modal fade" id="waitModal">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-body" style="text-align:center; font-size:16px;">
			Please wait a moment while the next stage is set ......
		</div>
		</div>
	</div>
	</div>



	<script type='text/javascript' src='../js/jquery.js'></script>
	<script type='text/javascript' src='../js/bootstrap.js'></script>
	<script type='text/javascript' src='schedule.js'></script>
</body>

</html>