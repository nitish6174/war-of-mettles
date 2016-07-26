<!DOCTYPE html>
<html>


<head>
	<meta charset="utf-8"/>
	<title>Defence Store</title>
	<link rel="stylesheet" type="text/css" href="css/defenceStore.css">
</head>


<body>
	<div id="defcontainer">
		<div id="buy">
			<div id="buyTitle">Purchase material</div>
			<div class="items">
				<div class="buyitem" id="woodwallbuy">
					<img src="images/wood.png"><br>
					<strong style="font-size:16px;">Wood</strong><br> <strong>Cost:</strong> 5 per block<br>
					<input type="number" class="inputBox" placeholder="Amount" min="1" style="width:70px" id="woodInputBox"/>
					<input type="submit" class="inputButton" value="Buy" id="woodButton">
				</div>
				<div class="buyitem" id="brickwallbuy">
					<img src="images/brick.png"><br>
					<strong style="font-size:16px;">Brick</strong><br> <strong>Cost:</strong> 20 per block<br>
					<input type="number" class="inputBox" placeholder="Amount" min="1" style="width:70px" id="brickInputBox"/>
					<input type="submit" class="inputButton" value="Buy" id="brickButton">
				</div>
				<div class="buyitem" id="concwallbuy">
					<img src="images/conc.png"><br>
					<strong style="font-size:16px;">Concrete</strong><br> <strong>Cost:</strong> 50 per block<br>
					<input type="number" class="inputBox" placeholder="Amount" min="1" style="width:70px" id="concreteInputBox"/>
					<input type="submit" class="inputButton" value="Buy" id="concreteButton">
				</div>
			</div>
		</div>
		<div id="use">
			<div id="useTitle">Switch between your items</div>
			<div class="items">
				<div class="useitem" id="woodwalluse">
					<img src="images/wood.png"><br><strong>Wood</strong><br><span></span> available
				</div>
				<div class="useitem" id="brickwalluse">
					<img src="images/brick.png"><br><strong>Brick</strong><br><span></span> available
				</div>
				<div class="useitem" id="concwalluse">
					<img src="images/conc.png"><br><strong>Concrete</strong><br><span></span> available
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="js/defenceStore.js"></script>

</body>


</html>