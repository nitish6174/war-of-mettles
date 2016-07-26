teamButton = document.querySelector('#team'+teamId);
teamButton.style.display= 'none';
$('#gridMaze').css('display','block');


//	Loading attack room from grid

$('.teamButton').click(function(){
	attRoom = $(this).text();
	attPlayerRow = 1;
	attPlayerCol = 5;
	loot=0;
	$.post("ajax/setAttackPlayer.php",
		{
			id: teamId,
			room: attRoom,
			row: attPlayerRow,
			col: attPlayerCol
		},
		function(data,status)
		{
			// alert($('return',data).text());			
			if($('return',data).text()=="1")
			{
				$('#attackTitle').text('Attack player: Room '+attRoom);
				$('#attackBox').load('attackRoom.php');
				$('#attackStoreButton').html("Back to grid");			
			}
			else
			{
				$('#attackAlert').text("This room is already under attack by 3 other teams right now. Try another room.").show();
				setTimeout(function(){$('#attackAlert').hide();},5000);
			}
		}
	);
});

$('.teamButton').hover(
	function(){
		hoverRoom = $(this).text();
		$.post('ajax/getTreasure.php',
			{
				id: hoverRoom
			},
			function(data,status)
			{
				$('#attackTitle').text('Room:'+hoverRoom+' Treasure:'+$('treasure',data).text());
			}
		);
	},
	function() { $('#attackTitle').text('Attack player: Grid'); }
);

