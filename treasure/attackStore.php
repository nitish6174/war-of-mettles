<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link  rel="stylesheet" type="text/css" href="css/attackStore.css"></link>
</head>

<body>
	<div id="attcontainer">
		<div id="attbuy">
			<div id="attBuyTitle">Purchase weapon</div>
			<div class="attItems">
				<div class="attbuyitem" id="sawbuy">
					<img id="saw" src="images/saw.png"><br><strong style="font-size:16px">Saw</strong><br> <strong>Cost:</strong> 10 per piece<br>
					<input type="number" class="attinputBox" placeholder="amount" min="1" id="sawInputBox" style="width:70px"/>
					<input type="submit" class="attinputButton" value="Buy" id="sawButton"><br>
				</div>
				<div class="attbuyitem" id="hammerbuy">
					<img id="hammer" src="images/hammer.ico"><br><strong style="font-size:16px">Hammer</strong><br> <strong>Cost:</strong> 30 per piece<br>
					<input type="number" class="attinputBox" placeholder="amount" min="1" id="hammerInputBox" style="width:70px"/>
					<input type="submit" class="attinputButton" value="Buy" id="hammerButton"><br>
				</div>
				<div class="attbuyitem" id="expbuy">
					<img id="ball" src="images/ballw.png.gif"><br><strong style="font-size:16px">Explosive</strong><br> <strong>Cost:</strong> 80 per piece<br>
					<input type="number" class="attinputBox" placeholder="amount" min="1" id="explosiveInputBox" style="width:70px"/>
					<input type="submit" class="attinputButton" value="Buy" id="explosiveButton"><br>
				</div>
			</div>
		</div>
		<div id="attuse">
			<div class="attuseitem" id="woodwalluse">
				<input type="button" value="Puzzles" id="puzzleButton">
			</div>
		</div>
	</div>
	<script type="text/javascript" src="js/attackStore.js"></script>

</body>

</html>