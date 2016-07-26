
//	Arrays
troopArea = [[0,1,0],[1,0,1],[1,1,0],[0,0,1],[1,1,0],[1,0,1],[0,1,1]];
cellType = [ [0,1,4,2,0,3,0] , [4,0,2,0,3,1,0] , [3,2,0,4,0,0,1] , [0,0,3,0,1,2,4] , [1,0,0,0,4,0,2] , [0,4,1,3,2,0,0] , [2,3,0,1,0,4,0] ];
table1 = [ [0,0,0,0,0,0,0] , [0,0,0,0,0,0,0] , [0,0,0,0,0,0,0] ];
table2 = [ [0,0,0,0,0,0,0] , [0,0,0,0,0,0,0] , [0,0,0,0,0,0,0] , [0,0,0,0,0,0,0] , [0,0,0,0,0,0,0] , [0,0,0,0,0,0,0] , [0,0,0,0,0,0,0] ];

stickerSelected = 0;
stickerArea = 0;
stickerDay = 0;
stickerShift = 0;
stickerShiftName = '';
stickerTroop = 0;


//	Creating variables for the 5 sections of page
menuBar = document.querySelector('#menuBar');
infoBar = document.querySelector('#infoBar');
scoreSection = document.querySelector('#scoreSection');
gameSection = document.querySelector('#gameSection');
helpSection = document.querySelector('#helpSection');


//	Score multiplier variables
// Old: 5 3 2 -3 -5 -10
// New: 
assignedMultiplier	= 11;
strategicMultiplier	= 7;
restMultiplier		= 3;
deviationMultiplier	= -5;
dayoffMultiplier	= -8;
consecutiveMultiplier = -13;

document.querySelector('#sSAssigned .sSMultiplier').innerHTML = assignedMultiplier;
document.querySelector('#sSStrategic .sSMultiplier').innerHTML = strategicMultiplier;
document.querySelector('#sSRest .sSMultiplier').innerHTML = restMultiplier;
document.querySelector('#sSDeviation .sSMultiplier').innerHTML = deviationMultiplier;
document.querySelector('#sSDayoff .sSMultiplier').innerHTML = dayoffMultiplier;
document.querySelector('#sSConsecutive .sSMultiplier').innerHTML = consecutiveMultiplier;




//	Loading troops-area data

for(var i=1;i<=7;i++)
{
	for(var j=1;j<=3;j++)
	{
		if(troopArea[i-1][j-1]==1)
			$('#t2Row'+i+' .area'+j).removeClass('hiddenCard');
	}
}


//	Applying classes to table2 cells

for(var i=1;i<=7;i++)
{
	for(var j=1;j<=7;j++)
	{
		switch(cellType[i-1][j-1])
		{
			case 4: $('#t2Row'+i+' div[data-cCol='+j+']').addClass('type4'); break;
			case 3: $('#t2Row'+i+' div[data-cCol='+j+']').addClass('type3'); break;
			case 0:  $('#t2Row'+i+' div[data-cCol='+j+']').addClass('type0'); break;
			case 1:  $('#t2Row'+i+' div[data-cCol='+j+']').addClass('type1'); break;
			case 2:  $('#t2Row'+i+' div[data-cCol='+j+']').addClass('type2'); break;			
		}
	}
}


//	Loading stickers in table1 and table2

$.post('getData.php',{},function(data,status){
	teamId = $('teamId',data).text();
	timeLeft = $('time',data).text();
	timeBonus = timeLeft/10;
	minLeft = Math.floor(timeLeft/60);
	secLeft = timeLeft - minLeft*60;
	
	for(var i=1;i<=3;i++)
	{
		for(var j=1;j<=7;j++)
		{
			var cellStatus = $('table1 cell'+i+j,data).text();
			switch(cellStatus)
			{
				case '1':
					table1[i-1][j-1]=1;
					$('#t1Row'+i+' div[data-cCol='+j+'] .t1Early').html('<img src="resources/sticker'+i+'d.bmp">');
					break;
				case '2':
					table1[i-1][j-1]=2;
					$('#t1Row'+i+' div[data-cCol='+j+'] .t1Late').html('<img src="resources/sticker'+i+'n.bmp">');
					break;
				case '3':
					table1[i-1][j-1]=3;
					$('#t1Row'+i+' div[data-cCol='+j+'] .t1Early').html('<img src="resources/sticker'+i+'d.bmp">');
					$('#t1Row'+i+' div[data-cCol='+j+'] .t1Late').html('<img src="resources/sticker'+i+'n.bmp">');
					break;
				default: break;
			}	
		}
	}

	for(var i=1;i<=7;i++)
	{
		for(var j=1;j<=7;j++)
		{
			var cellStatus = $('table2 cell'+i+j,data).text();

			if(cellStatus>0 && cellStatus<=3)
			{
				table2[i-1][j-1]=Number(cellStatus);
				$('#t2Row'+i+' div[data-cCol='+j+'] .t2Early').html('<img src="resources/sticker'+cellStatus+'d.bmp">');
			}
			else if(cellStatus>3)
			{
				table2[i-1][j-1]=Number(cellStatus);
				$('#t2Row'+i+' div[data-cCol='+j+'] .t2Late').html('<img src="resources/sticker'+(Number(cellStatus)-3)+'n.bmp">');	
			}
		}
	}
	calculateScore();
	$('#timeBonus span').text(timeBonus.toFixed(1));
	$('#totalScore span').text((score+timeBonus).toFixed(1));
	var minDisp = (String(minLeft).length>1)?(minLeft):('0'+minLeft);
	var secDisp = (String(secLeft).length>1)?(secLeft):('0'+secLeft);
	$('#time span').text( minDisp+':'+secDisp);

	setInterval(reduceTime,1000);
	setTimeout(timeUp,1000*timeLeft);
});



$('.t1Cell div').click(function(){
	if(stickerSelected<2)
	{
		if($(this).html()!='' && !$(this).hasClass('selected'))
		{
			var parentDiv = $(this).parent();
			stickerSelected = 1;
			stickerArea = parentDiv.attr('data-cRow');
			stickerDay = parentDiv.attr('data-cCol');
			stickerShift = (this.className=='t1Early')?1:2;
			stickerShiftName = (stickerShift==1)?'Early':'Late';

			$('.selected').removeClass('selected');
			$(this).addClass('selected');		
			$('.highlightedCell').removeClass('highlightedCell');
			for(var i=1;i<=7;i++)
			{
				if( !($('#t2Row'+i+' .area'+stickerArea).hasClass('hiddenCard')) && cellType[i-1][stickerDay-1]!=4 && table2[i-1][stickerDay-1]==0 )
					$('#t2Row'+i+' .t2Cell[data-cCol='+stickerDay+'] .t2'+stickerShiftName).addClass('highlightedCell');
			}
		}	
		else
		{
			stickerSelected = 0;
			stickerArea = 0;
			stickerDay = 0;
			stickerShift = 0;
			stickerShiftName = '';
			$('.highlightedCell').removeClass('highlightedCell');
			$('.selected').removeClass('selected');
		}
	}
	else if(stickerSelected==2)
	{
		if($(this).hasClass('highlightedCell'))
		{
			var parentRow = $(this).parent().attr('data-cRow');
			var parentCol = $(this).parent().attr('data-cCol');
			table1[parentRow-1][parentCol-1] += stickerShift;
			table2[stickerTroop-1][stickerDay-1] = 0;
			if(stickerShift==1)
				$(this).html('<img src="resources/sticker'+stickerArea+'d.bmp">');
			else
				$(this).html('<img src="resources/sticker'+stickerArea+'n.bmp">');
			$('#t2Row'+stickerTroop+' .t2Cell[data-cCol='+stickerDay+'] .t2'+stickerShiftName).html('');
			calculateScore();
			$.post('setStickers.php',
				{
					table1: 1,
					row1: parentRow,
					col1: parentCol,
					value1: table1[parentRow-1][parentCol-1],
					table2: 2,
					row2: stickerTroop,
					col2: stickerDay,
					value2: 0,
					score: score
				},function(data,status){}
			);
		}
		stickerSelected = 0;
		stickerArea = 0;
		stickerDay = 0;
		stickerShift = 0;
		stickerShiftName = '';
		stickerTroop = 0;
		$('.highlightedCell').removeClass('highlightedCell');
		$('.selected').removeClass('selected');
	}
});



$('.t2Cell div').click(function(){
	if(stickerSelected==0 && $(this).html()!='')
	{
		var parentDiv = $(this).parent();
		stickerSelected = 2;
		stickerTroop = parentDiv.attr('data-cRow');
		stickerDay = parentDiv.attr('data-cCol');
		stickerArea = (table2[stickerTroop-1][stickerDay-1]-1)%3+1;
		stickerShift = (this.className=='t2Early')?1:2;
		stickerShiftName = (stickerShift==1)?'Early':'Late';

		$('.selected').removeClass('selected');
		$(this).addClass('selected');		
		$('.highlightedCell').removeClass('highlightedCell');
		$('#t1Row'+stickerArea+' .t1Cell[data-cCol='+stickerDay+'] .t1'+stickerShiftName).addClass('highlightedCell');
		for(var i=1;i<=7;i++)
		{
			if( !($('#t2Row'+i+' .area'+stickerArea).hasClass('hiddenCard')) && cellType[i-1][stickerDay-1]!=4 && table2[i-1][stickerDay-1]==0 )
				$('#t2Row'+i+' .t2Cell[data-cCol='+stickerDay+'] .t2'+stickerShiftName).addClass('highlightedCell');
		}		
	}
	else if(stickerSelected==1)
	{
		if($(this).hasClass('highlightedCell'))
		{
			parentRow = $(this).parent().attr('data-cRow');
			parentCol = $(this).parent().attr('data-cCol');
			table2[parentRow-1][parentCol-1] = Number((stickerShift-1)*3)+Number(stickerArea);
			table1[stickerArea-1][stickerDay-1] -= stickerShift;
			if(stickerShift==1)
				$(this).html('<img src="resources/sticker'+stickerArea+'d.bmp">');
			else
				$(this).html('<img src="resources/sticker'+stickerArea+'n.bmp">');
			$('#t1Row'+stickerArea+' .t1Cell[data-cCol='+stickerDay+'] .t1'+stickerShiftName).html('');
			calculateScore();
			$.post('setStickers.php',
				{
					table1: '1',
					row1: stickerArea,
					col1: stickerDay,
					value1: table1[stickerArea-1][stickerDay-1],
					table2: '2',
					row2: parentRow,
					col2: parentCol,
					value2: table2[parentRow-1][parentCol-1],
					score: score
				},function(data,status){
			});
		}
		stickerSelected = 0;
		stickerArea = 0;
		stickerDay = 0;
		stickerShift = 0;
		stickerShiftName = '';
		$('.highlightedCell').removeClass('highlightedCell');
		$('.selected').removeClass('selected');
	}
	else if(stickerSelected==2)
	{
		if($(this).hasClass('highlightedCell'))
		{
			var parentRow = $(this).parent().attr('data-cRow');
			var parentCol = $(this).parent().attr('data-cCol');
			table2[parentRow-1][parentCol-1] = Number((stickerShift-1)*3)+Number(stickerArea);
			table2[stickerTroop-1][stickerDay-1] = 0;
			if(stickerShift==1)
				$(this).html('<img src="resources/sticker'+stickerArea+'d.bmp">');
			else
				$(this).html('<img src="resources/sticker'+stickerArea+'n.bmp">');
			$('#t2Row'+stickerTroop+' .t2Cell[data-cCol='+stickerDay+'] .t2'+stickerShiftName).html('');
			calculateScore();
			$.post('setStickers.php',
				{
					table1: '2',
					row1: parentRow,
					col1: parentCol,
					value1: table2[parentRow-1][parentCol-1],
					table2: '2',
					row2: stickerTroop,
					col2: stickerDay,
					value2: '0',
					score: score
				},function(data,status){}
			);
		}
		stickerSelected = 0;
		stickerArea = 0;
		stickerDay = 0;
		stickerShift = 0;
		stickerShiftName = '';
		stickerTroop = 0;
		$('.highlightedCell').removeClass('highlightedCell');
		$('.selected').removeClass('selected');
	}
});







function calculateScore()
{
	for(var i=1;i<=7;i++)
	{
		var lateCount = 0;
		for(var j=1;j<=7;j++)
		{
			if(table2[i-1][j-1]>3)
				lateCount++;
		}
		$('#t2Row'+i+' .lateCount span').text(lateCount);
	}

	var assignedCount = 0;
	var strategicCount = 0;
	var restCount = 0;
	var deviationCount = 0;
	var dayoffCount = 0; 
	var consecutiveCount = 0;

	for(var i=1;i<=7;i++)
	{
		for(var j=1;j<=7;j++)
		{
			if(cellType[i-1][j-1]==3 && table2[i-1][j-1]!=0)
				dayoffCount++;
			else if( cellType[i-1][j-1]==1 || cellType[i-1][j-1]==2 )
			{
				if( (cellType[i-1][j-1]==1 && table2[i-1][j-1]>0 && table2[i-1][j-1]<=3) || (cellType[i-1][j-1]==2 && table2[i-1][j-1]>3 && table2[i-1][j-1]<=6) )
					strategicCount++;
			}
			if(j>1 && table2[i-1][j-1]>0 && table2[i-1][j-1]<=3 && table2[i-1][j-2]>3)
				consecutiveCount++;
		}
		for(var j=1;j<=7;j++)
		{
			if(table2[i-1][j-1]==0 && j<7 && table2[i-1][j]==0)
			{
				restCount++;
				while(table2[i-1][j-1]==0)
					j++;
			}
		}
		if($('#t2Row'+i+' .lateCount span').text()<3)
			deviationCount+=3-$('#t2Row'+i+' .lateCount span').text();
		else
			deviationCount+=$('#t2Row'+i+' .lateCount span').text()-3;
	}
	for(var i=1;i<=3;i++)
	{
		for(var j=1;j<=7;j++)
		{
			if(table1[i-1][j-1]==0)
				assignedCount+=2;
			else if(table1[i-1][j-1]==1 || table1[i-1][j-1]==2)
				assignedCount+=1;
		}
	}

	$('#sSDayoff .sSCount').text(dayoffCount);
	$('#sSStrategic .sSCount').text(strategicCount);
	$('#sSRest .sSCount').text(restCount);
	$('#sSDeviation .sSCount').text(deviationCount);
	$('#sSAssigned .sSCount').text(assignedCount);
	$('#sSConsecutive .sSCount').text(consecutiveCount);

	$('#sSDayoff .sSResult').text(dayoffCount*dayoffMultiplier);
	$('#sSStrategic .sSResult').text(strategicCount*strategicMultiplier);
	$('#sSRest .sSResult').text(restCount*restMultiplier);
	$('#sSDeviation .sSResult').text(deviationCount*deviationMultiplier);
	$('#sSAssigned .sSResult').text(assignedCount*assignedMultiplier);
	$('#sSConsecutive .sSResult').text(consecutiveCount*consecutiveMultiplier);

	score = Number($('#sSDayoff .sSResult').text())+Number($('#sSStrategic .sSResult').text())+Number($('#sSRest .sSResult').text())+Number($('#sSDeviation .sSResult').text())+Number($('#sSAssigned .sSResult').text())+Number($('#sSConsecutive .sSResult').text());
	$('#score span').text(score);
	$('#totalScore span').text((score+timeBonus).toFixed(1));
}




function reduceTime()
{
	if(timeLeft>0)
	{
		timeLeft--;
		secLeft--;
		timeBonus = timeLeft/10;
		if(secLeft<0)
		{
			secLeft=59;
			minLeft--;
		}
		$('#timeBonus span').text(timeBonus.toFixed(1));
		$('#totalScore span').text((score+timeBonus).toFixed(1));
		var minDisp = (String(minLeft).length>1)?(minLeft):('0'+minLeft);
		var secDisp = (String(secLeft).length>1)?(secLeft):('0'+secLeft);
		$('#time span').text( minDisp+':'+secDisp);
		$.post('setTime.php',{value:timeLeft},function(data,status){});
	}
}

function timeUp()
{
	clearInterval(reduceTime);
	alert('Time up. Your schedule will be submitted now');
	$('#waitModal').modal({
	    show : true,
	    backdrop : "static",
	    keyboard: false
	});
	$.post('setData.php',
		{
			table1: table1,
			table2: table2,
			score: score
		},
		function(data,status)
		{
			$('#waitModal').modal("hide");
			window.location = "../instructions2.php";
		}
	);
}

function submit()
{	
	response = confirm('Are you sure you want to submit your schedule?');
	if(response==true)
	{
		clearInterval(reduceTime);
		$('#waitModal').modal({
		    show : true,
		    backdrop : "static",
		    keyboard: false
		});
		$.post('setData.php',
			{
				table1: table1,
				table2: table2,
				score: score
			},
			function(data,status)
			{
				$('#waitModal').modal("hide");
				window.location = "../instructions2.php";
			}
		);		
	}
}

function logout()
{
	response = confirm('Are you sure you want to log out?');
	if(response==true)
		window.location = "../logout.php";
}

function loadLeaderboard()
{
	$.post('getLeaderboard.php',{},function(data,status){
		for(i=1;i<=50;i++)
		{
			var id = $('row'+i+' id',data).text();
			var score = $('row'+i+' score',data).text();
			$('#leaderboardModal tr[data-tRow='+i+'] td[data-tCol=1]').text(id);
			$('#leaderboardModal tr[data-tRow='+i+'] td[data-tCol=2]').text(score);
		}
	});
}


