$('.puzzleButton').click(function() {
	if($(this).attr('id')=='puzzle1Easy')
	{
		puzzleNumber=11;
	}
	else if($(this).attr('id')=='puzzle1Medium')
	{
		puzzleNumber=12;
	}
	else if($(this).attr('id')=='puzzle1Difficult')
	{
		puzzleNumber=13;
	}
	else if($(this).attr('id')=='puzzle2Easy')
	{
		puzzleNumber=21;
	}
	else if($(this).attr('id')=='puzzle2Medium')
	{
		puzzleNumber=22;
	}
	else if($(this).attr('id')=='puzzle2Difficult')
	{
		puzzleNumber=23;
	}

	else if($(this).attr('id')=='puzzle3Easy')
	{
		puzzleNumber=31;
	}
	else if($(this).attr('id')=='puzzle3Medium')
	{
		puzzleNumber=32;
	}
	else if($(this).attr('id')=='puzzle3Difficult')
	{
		puzzleNumber=33;
	}
	else if($(this).attr('id')=='puzzle4Easy')
	{
		puzzleNumber=41;
	}
	else if($(this).attr('id')=='puzzle4Medium')
	{
		puzzleNumber=42;
	}
	else if($(this).attr('id')=='puzzle4Difficult')
	{
		puzzleNumber=43;
	}
	else if($(this).attr('id')=='puzzle5Easy')
	{
		puzzleNumber=51;
	}
	else if($(this).attr('id')=='puzzle5Medium')
	{
		puzzleNumber=52;
	}
	else if($(this).attr('id')=='puzzle5Difficult')
	{
		puzzleNumber=53;
	};
	$.post('ajax/checkPuzzle.php',
	{
		id:teamId,
		puzzleNumber:puzzleNumber
	},
	function(data, status)
	{
		if($('check', data).text() == 0)
		{
				if(puzzleNumber==11)
				{
					$('#attackBox').load('puzzles/tents/tents1.html');
					$('#attackTitle').text('Puzzle Section: Tents');
				}
				else if(puzzleNumber==12)
				{
					$('#attackBox').load('puzzles/tents/tents2.html');
					$('#attackTitle').text('Puzzle Section: Tents');
				}
				else if(puzzleNumber==13)
				{
					$('#attackBox').load('puzzles/tents/tents3.html');
					$('#attackTitle').text('Puzzle Section: Tents');
				}
				else if(puzzleNumber==21)
				{
					$('#attackBox').load('puzzles/kaku/kaku1.html');
					$('#attackTitle').text('Puzzle Section: Sums');
				}
				else if(puzzleNumber==22)
				{
					$('#attackBox').load('puzzles/kaku/kaku2.html');
					$('#attackTitle').text('Puzzle Section: Sums');
				}
				else if(puzzleNumber==23)
				{
					$('#attackBox').load('puzzles/kaku/kaku3.html');
					$('#attackTitle').text('Puzzle Section: Sums');
				}

				else if(puzzleNumber==31)
				{
					$('#attackBox').load('puzzles/range/range1.html');
					$('#attackTitle').text('Puzzle Section: Range');
				}
				else if(puzzleNumber==32)
				{
					$('#attackBox').load('puzzles/range/range2.html');
					$('#attackTitle').text('Puzzle Section: Range');
				}
				else if(puzzleNumber==33)
				{
					$('#attackBox').load('puzzles/range/range3.html');
					$('#attackTitle').text('Puzzle Section: Range');
				}
				else if(puzzleNumber==41)
				{
					$('#attackBox').load('puzzles/three/three1.html');
					$('#attackTitle').text('Puzzle Section: 3-in-a-Row');
				}
				else if(puzzleNumber==42)
				{
					$('#attackBox').load('puzzles/three/three2.html');
					$('#attackTitle').text('Puzzle Section: 3-in-a-Row');
				}
				else if(puzzleNumber==43)
				{
					$('#attackBox').load('puzzles/three/three3.html');
					$('#attackTitle').text('Puzzle Section: 3-in-a-Row');
				}
				else if(puzzleNumber==51)
				{
					$('#attackBox').load('puzzles/islands/islands1.html');
					$('#attackTitle').text('Puzzle Section: Islands');
				}
				else if(puzzleNumber==52)
				{
					$('#attackBox').load('puzzles/islands/islands2.html');
					$('#attackTitle').text('Puzzle Section: Islands');
				}
				else if(puzzleNumber==53)
				{
					$('#attackBox').load('puzzles/islands/islands3.html');
					$('#attackTitle').text('Puzzle Section: Islands');
				}
		}
		else
		{
			$('#attackAlert').text("You have already solved this puzzle").show();
			setTimeout(function(){$('#attackAlert').hide();},5000);
		}
	});

});