/*	
	Variables:
	size	teamId
	defRoom		defPlayerRow	defPlayerCol	defPlayerCell
	attRoom		attPlayerRow	attPlayerCol	attPlayerCell
*/


size=9;
// defMaterial = 0;
// attMaterial = 0;
// material1=0;
// material2=0;
// material3=0;

treasure = 1000;
loot = 0;

//	Fetching team's own data, initialising variables and loading frames

$.post("ajax/getSelfData.php",{},
	function(data,status)
	{
		teamId = $('teamId',data).text();
		
		defRoom = $('defence room',data).text();
		defPlayerRow = $('defence row',data).text();
		defPlayerCol = $('defence col',data).text();

		attRoom = $('attack room',data).text();
		attPlayerRow = $('attack row',data).text();
		attPlayerCol = $('attack col',data).text();

		attRoomTreasure = $('treasure',data).text();

		if(defRoom==0)
		{
			$('#defenceTitle').text('Defence player: Store');
			$('#defenceBox').load('defenceStore.php');
			$('#defenceStoreButton').html("Back to your Room");
			getMaterial();	
		}
		else
		{
			$('#defenceTitle').text('Defence player: Own Room');
			$('#defenceBox').load('defenceRoom.php');
			$('#defenceStoreButton').html("Go to Store");
		}

		if(attRoom==-1)
		{
			$('#attackTitle').text('Attack player: Grid');
			$('#attackBox').load('grid.php');
			$('#attackStoreButton').html("Go to Store");
		}
		else if(attRoom==0)
		{
			$('#attackTitle').text('Attack player: Store');
			$('#attackBox').load('attackStore.php');
			$('#attackStoreButton').html("Back to grid");
			getWeapon();
		}
		else
		{
			$('#attackTitle').text('Attack player: Room '+attRoom);
			$('#attackBox').load('attackRoom.php');
			$('#attackStoreButton').html("Back to grid");
		}

		setInterval(getDefencePlayers,100);
		setInterval(getAttackPlayers,100);
		setInterval(getTreasure,500);
		setInterval(getMaterial,500);
		setInterval(getWeapon,500);
		setInterval(getTime,1000);
	}
);




//	Window toggling on clicking buttons

$('#defenceStoreButton').click(function(){
	if (defRoom!=0) 
	{
		defRoom = 0;
		$.post("ajax/setDefencePlayer.php",
			{
				id: teamId,
				room: defRoom,
				row: defPlayerRow,
				col: defPlayerCol
			},
			function(data,status)
			{
				$('#defenceTitle').text('Defence player: Store');
				$('#defenceBox').load('defenceStore.php');
				$('#defenceStoreButton').html("Back to your Room");
			}
		);
	}
	else
	{
		defRoom = teamId;
		defPlayerRow = 9;
		defPlayerCol = 5;
		$.post("ajax/setDefencePlayer.php",
			{
				id: teamId,
				room: defRoom,
				row: defPlayerRow,
				col: defPlayerCol
			},
			function(data,status)
			{
				$('#defenceTitle').text('Defence player: Own Room');
				$('#defenceBox').load('defenceRoom.php');
				$('#defenceStoreButton').html("Go to Store");
			}
		);
		$('#defenceStoreButton').blur();
	}
});

$('#attackStoreButton').click(function(){
	if(attRoom==-1)
	{
		attRoom = 0;
		$.post("ajax/setAttackPlayer.php",
			{
				id: teamId,
				room: attRoom,
				row: attPlayerRow,
				col: attPlayerCol
			},
			function(data,status)
			{
				$('#attackTitle').text('Attack player: Store');
				$('#attackBox').load('attackStore.php');
				$('#attackStoreButton').html("Back to grid");
				getWeapon();
			}
		);
	}
	else if(attRoom==0)
	{
		attRoom = -1;
		$.post("ajax/setAttackPlayer.php",
			{
				id: teamId,
				room: attRoom,
				row: attPlayerRow,
				col: attPlayerCol
			},
			function(data,status)
			{
				$('#attackTitle').text('Attack player: Grid');
				$('#attackBox').load('grid.php');
				$('#attackStoreButton').html("Go to Store");
			}
		);

	}
	else
	{
		if(loot>0)
		{
			var r = confirm("You seem to be stuck in the room! Getting out this way would cost you twice the amount you looted from this room.");
		}
		if(loot==0 || r==true)
		{
			if(treasure >= 2*loot) { setTreasure(teamId, -2*loot); }
			else { setTreasure(teamId, treasure*(-1)); };
			setTreasure(attRoom, loot);
			attRoom = -1;
			$.post("ajax/setAttackPlayer.php",
				{
					id: teamId,
					room: attRoom,
					row: attPlayerRow,
					col: attPlayerCol
				},
				function(data,status)
				{
					$('#attackTitle').text('Attack player: Grid');
					$('#attackBox').load('grid.php');
					$('#attackStoreButton').html("Go to Store");
				}
			);
		}
	
	}
	$('#attackStoreButton').blur();
});






//	Processing keyboard movements

document.addEventListener('keyup',function(e)
{
	switch(e.keyCode)
		{
			// setTreasure();
			case 37: 	if(attPlayerCol>1) { setAttackPlayer(1); }; break;
			case 38: 	if(attPlayerRow>1) { setAttackPlayer(3); }
						else if(attPlayerCol==5)
						{					
							attRoom = -1;
							$.post("ajax/setAttackPlayer.php",
								{
									id: teamId,
									room: attRoom,
									row: attPlayerRow,
									col: attPlayerCol
								},
								function(data,status)
								{
									$('#attackTitle').text('Attack player: Grid');
									$('#attackBox').load('grid.php');
									$('#attackStoreButton').html("Go to Store");
								}
							);
						}
						break;
			case 39: 	if(attPlayerCol<size) { setAttackPlayer(2);  }; break;
			case 40: 	if(attPlayerRow<size) { setAttackPlayer(4); }; break;
			
			case 97: 	// num 1
						if(attPlayerRow>2 && attPlayerRow<8) { 
							getWeapon();
							if(weapon1>0)
							{
								removeWall(1);
								// setWeapon(teamId, -1, 1); 
							} 
						};
				break;
			case 98: 	// num 2
						if(attPlayerRow>2 && attPlayerRow<8) { 
							getWeapon();
							// alert(weapon2);
							if(weapon2>0)
							{
								removeWall(2); 
								// setWeapon(teamId, -1, 2); 
							} 
						};
				break;
			case 99: 	// num 3
						if(attPlayerRow>2 && attPlayerRow<8) { 
							getWeapon();
							if(weapon3>0)
							{
								removeWall(3); 
								// setWeapon(teamId, -1, 3); 
							} 
						};
				break;
			


			
			case 65: 	if(defPlayerCol>1) { setDefencePlayer(1); }; break;
			case 87: 	if(defPlayerRow>1) { setDefencePlayer(3); }; break;
			case 68: 	if(defPlayerCol<size) { setDefencePlayer(2); }; break;
			case 83: 	if(defPlayerRow<size) {setDefencePlayer(4); }; break;
			case 32: 	//space
						if(defPlayerRow>4 && !(defPlayerRow==9 && defPlayerCol==5))
						{
							getMaterial();
							$.post("ajax/checkWall.php",
							{
								room: defRoom,
								row: defPlayerRow-1,
								col: defPlayerCol
							},
							function(data,status)
							{
								if($('check',data).text()<defMaterial) 
								{
									if(defMaterial==1){ setWall(material1);	}
									else if(defMaterial==2){ setWall(material2); }
									else if(defMaterial==3){ setWall(material3); };

									setMaterial(teamId, -1, defMaterial);
								}
							});
						}	
						break;		
		}
},
false);










//	AJAX functions to set and retrieve maze data for defence and attack mazes



function setDefencePlayer(x)
{
	var row=defPlayerRow;
	var col=defPlayerCol;
	if(x==1) { col--; }
	else if(x==2) { col++; }
	else if(x==3) { row--; }
	else if(x==4) { row++; };
	if(row>3 && row<9)
	{
		$.post("ajax/checkWall.php",
			{
				room: defRoom,
				row: row,
				col: col
			},
			function(data,status)
			{
				if($('check',data).text()==0)
				{
					defPlayerCol = col;
					defPlayerRow = row;
					$.post("ajax/setDefencePlayer.php",
						{
							id: teamId,
							room: defRoom,
							row: defPlayerRow,
							col: defPlayerCol
						},
						function(data,status)
						{}
					);
				}
			}
		);
	} 
	else 
	{
		defPlayerCol = col;
		defPlayerRow = row;
		$.post("ajax/setDefencePlayer.php",
			{
				id: teamId,
				room: defRoom,
				row: defPlayerRow,
				col: defPlayerCol
			},
			function(data,status)
			{}
		);
	}
}



function getDefencePlayers()
{
	$.post("ajax/getDefencePlayers.php",
		{
			id: teamId
		},
		function(data,status)
		{
			for(i=1;i<=3;i++)
			{
				for(j=1;j<=size;j++)
				{					
					$('#defMazeR'+i+'C'+j).css('background-color','white');
					$('#defMazeR'+i+'C'+j).html('');
				}
			}
			
			for(i=4;i<=8;i++)
			{
				for(j=1;j<=size;j++)
				{
					if($('cell'+i+j,data).text()=='0')
					{
						$('#defMazeR'+i+'C'+j).css('background-color','white');
						$('#defMazeR'+i+'C'+j).html('');
					}
					else
					{
						if($('cell'+i+j,data).text()=='1')
							$('#defMazeR'+i+'C'+j).html("<img src='images/woodWall.png' />");
						else if($('cell'+i+j,data).text()=='2')
							$('#defMazeR'+i+'C'+j).html("<img src='images/brickWall.png' />");
						else if($('cell'+i+j,data).text()=='3')
							$('#defMazeR'+i+'C'+j).html("<img src='images/concWall.png' />");
						$('#defMazeR'+i+'C'+j+' img').css('width', '100%');
					}
				}
			}
			for(i=9;i<=9;i++)
			{
				for(j=1;j<=size;j++)
				{					
					$('#defMazeR'+i+'C'+j).css('background-color','white');
					$('#defMazeR'+i+'C'+j).html('');
				}
			}
			

			for(i=1;i<=50;i++)
			{
				if( $('team'+i+' room',data).text() == defRoom )
				{
					exPlayerRow = $('team'+i+' row',data).text();
					exPlayerCol = $('team'+i+' col',data).text();
					exPlayerId = $('team'+i+' id',data).text();
					$('#defMazeR'+exPlayerRow+'C'+exPlayerCol).html(exPlayerId);
					$('#defMazeR'+exPlayerRow+'C'+exPlayerCol).css('background-color','red');
					$('#defMazeR'+exPlayerRow+'C'+exPlayerCol).css('color','white');
				}
			}

			
			defPlayerCell = document.querySelector('#defMazeR'+defPlayerRow+'C'+defPlayerCol);
			defPlayerCell.style.backgroundColor = 'green';
			defPlayerCell.style.color = 'white';
			defPlayerCell.innerHTML = teamId;
			$('#defMazeR8C5').html("<img src='images/treasure.png' />");
			$('#defMazeR1C5').html("<img src='images/door.png' />");

			$('#defMazeR8C5 img').css('width', '80%');
			$('#defMazeR1C5 img').css('width', '80%');
		}
	);	
}



function setAttackPlayer(x)
{
	var row=attPlayerRow;
	var col=attPlayerCol;
	if(x==1) { col--; }
	else if(x==2) { col++; }
	else if(x==3) { row--; }
	else if(x==4) { row++; };

	if(row>3 && row<9)
	{
		$.post("ajax/checkWall.php",
			{
				room: attRoom,
				row: row,
				col: col
			},
			function(data,status)
			{
				if($('check',data).text()==0)
				{
					attPlayerCol = col;
					attPlayerRow = row;
					$.post("ajax/setAttackPlayer.php",
						{
							id: teamId,
							room: attRoom,
							row: attPlayerRow,
							col: attPlayerCol
						},
						function(data,status)
						{}
					);
				}
			}
		);
	} 
	else 
	{
		attPlayerCol = col;
		attPlayerRow = row;
		$.post("ajax/setAttackPlayer.php",
			{
				id: teamId,
				room: attRoom,
				row: attPlayerRow,
				col: attPlayerCol
			},
			function(data,status)
			{}
		);
	}
	if(row==8 && col==5)
	{
		checkexTreasure(attRoom);
	}
}



function getAttackPlayers()
{
	$.post("ajax/getAttackPlayers.php",
	{
		id: teamId,
		room: attRoom,
		row: attPlayerRow,
		col: attPlayerCol
	},
	function(data,status)
	{
		for(i=1;i<=size;i++)
		{
			for(j=1;j<=size;j++)
			{
				$('#attMazeR'+i+'C'+j).css('background-color','white');
				$('#attMazeR'+i+'C'+j).html('');
			}
		}
		for(i=4;i<=8;i++)
		{
			for(j=1;j<=size;j++)
			{
				if($('cell'+i+j,data).text()!='0')
				{
					if($('cell'+i+j,data).text()=='1')
						$('#attMazeR'+i+'C'+j).html("<img src='images/woodWall.png' />");
					else if($('cell'+i+j,data).text()=='2')
						$('#attMazeR'+i+'C'+j).html("<img src='images/brickWall.png' />");
					else if($('cell'+i+j,data).text()=='3')
						$('#attMazeR'+i+'C'+j).html("<img src='images/concWall.png' />");
					$('#attMazeR'+i+'C'+j+' img').css('width', '100%');
				}
			}
		}		
		for(i=1;i<=50;i++)
		{
			if( $('team'+i+' room',data).text() == attRoom )
			{
				exPlayerRow = $('team'+i+' row',data).text();
				exPlayerCol = $('team'+i+' col',data).text();
				exPlayerId = $('team'+i+' id',data).text();
				$('#attMazeR'+exPlayerRow+'C'+exPlayerCol).html(exPlayerId);
				$('#attMazeR'+exPlayerRow+'C'+exPlayerCol).css('color', 'white');
				if(exPlayerId!=teamId)
				{						
					$('#attMazeR'+exPlayerRow+'C'+exPlayerCol).css('background-color','red');						
				}
				else
				{
					$('#attMazeR'+exPlayerRow+'C'+exPlayerCol).css('background-color','blue');
				}
			}
		}
		$('#attMazeR8C5').html("<img src='images/treasure.png' />");
		$('#attMazeR1C5').html("<img src='images/door.png' />");
		$('#attMazeR8C5 img').css('width', '80%');
		$('#attMazeR1C5 img').css('width', '80%');
		if( $('defender room',data).text() == attRoom )
		{
			exPlayerRow = $('defender row',data).text();
			exPlayerCol = $('defender col',data).text();
			exPlayerId = $('defender id',data).text();
			$('#attMazeR'+exPlayerRow+'C'+exPlayerCol).html(exPlayerId);
			$('#attMazeR'+exPlayerRow+'C'+exPlayerCol).css('background-color','orange');
			$('#attMazeR'+exPlayerRow+'C'+exPlayerCol).css('color','white');
		}
	}
	);
	
}

function setTreasure(team, change)
{
	$.post('ajax/setTreasure.php',
		{
			id:team,
			change: change,
		},
		function(data,status)
		{}
	);
}

function getTreasure()
{
	$.post('ajax/getTreasure.php',
		{
			id: teamId
		},
		function(data,status)
		{
			treasure=$('treasure',data).text();
			$('#treasureValue').html(treasure);
		}
	);
}

function checkexTreasure(x)
{
	$.post('ajax/getTreasure.php',
		{
			id: x
		},
		function(data,status)
		{
			exTreasure=$('treasure',data).text();
			if(exTreasure>0)
			{
				loot+=10;
				setTreasure(teamId, 10);
				setTreasure(attRoom, -10);
			}
			else 
			{
				$('#attackAlert').text("This room's treasure is exhausted").show();
				setTimeout(function(){$('#attackAlert').hide();},5000);
			}
		}
	);
	
}

// Functions to set and remove wall


function setWall(wallMaterial)
{
	if(wallMaterial>0) {
		$.post("ajax/setWall.php",
			{
				room: teamId,
				row: defPlayerRow-1,
				col: defPlayerCol,
				level: defMaterial
			},
			function(data,status)
			{}
		);
	}
	else
	{
		$('#defenceAlert').text("You are out of material to build wall").show();
		setTimeout(function(){$('#defenceAlert').hide();},5000);
	}
}

function removeWall(x)
{
	$.post("ajax/removeWall.php",
		{
			id: teamId,
			room: attRoom,
			row: attPlayerRow+1,
			col: attPlayerCol,
			level: x
		},
		function(data,status)
		{
			if($('check', data).text()==1)
				setWeapon(teamId,-1,x);
		}
	);
}

function setMaterial(id,amount,type)
{
	$.post('ajax/setMaterial.php',
			{
				id:id,
				amount: amount,
				type:type
			},
			function(data, status)
			{}
		);
}



function getMaterial()
{
	$.post('ajax/getMaterial.php',
		{
			id: teamId
		},
		function(data,status)
		{
			material1=$('wood',data).text();
			material2=$('brick',data).text();
			material3=$('concrete',data).text();

			$('#woodValue').text(material1);
			$('#brickValue').text(material2);
			$('#concreteValue').text(material3);
			$('#woodwalluse span').text(material1);
			$('#brickwalluse span').text(material2);
			$('#concwalluse span').text(material3);
		}
	);
}
function setWeapon(id,amount,type)
{
	$.post('ajax/setWeapon.php',
			{
				id:id,
				amount: amount,
				type:type
			},
			function(data, status)
			{}
		);
}

function getWeapon()
{
	$.post('ajax/getWeapon.php',
		{
			id: teamId
		},
		function(data,status)
		{
			weapon1=$('saw',data).text();
			weapon2=$('hammer',data).text();
			weapon3=$('explosive',data).text();

			$('#sawValue').html(weapon1);
			$('#hammerValue').html(weapon2);
			$('#explosiveValue').html(weapon3);
		}
	);
}

function setPuzzle(puzzleNum)
{
	$.post('ajax/setPuzzle.php', 
	{
		id:teamId,
		puzzleNumber:puzzleNum
	},
		function(data, status){}
	);
}

//	Function to load grid when exiting from attack room

function loadGrid()
{
	attRoom = -1;
	document.removeEventListener('keyup',moveAttPlayer);
	$.post("ajax/setAttackPlayer.php",
		{
			id: teamId,
			room: '-1',
			row: '0',
			col: '0'
		},
		function(data,status){}
	);
	$('#attackTitle').text('Attack player: Grid');
	$('#attackBox').load('grid.php');
	$('#attackStoreButton').html("Go to Store");
}

// Functions to check walls when moving

function checkattCell(x,row,col)
{
	if(x==1) { col--; }
	else if(x==2) { col++; }
	else if(x==3) { row--; }
	else if(x==4) { row++; };
	if(row>3 && row<9)
	{
		$.post("ajax/checkWall.php",
			{
				room: attRoom,
				row: row,
				col: col
			},
			function(data,status)
			{
				if($('check',data).text()==0)
					check=1;
				else
					check=0;
			}
		);
	} else check=1;
	return check;
}

function checkdefCell(x,row,col)
{
	if(x==1) { col--; }
	else if(x==2) { col++; }
	else if(x==3) { row--; }
	else if(x==4) { row++; };
	if(row==8 && col==5)
	{
		check = 0;
	}
	else if(row>3 && row<9)
	{
		$.post("ajax/checkWall.php",
			{
				room: defRoom,
				row: row,
				col: col
			},
			function(data,status)
			{
				if($('check',data).text()==0)
					check=1;
				else
					check=0;
			}
		);
	} 
	else 
	{
		check=1;
	};

	return check;
}

//Updating treasure on successful attempt at puzzle
function solved(x,puzzleNum)
{
	setTreasure(teamId,x);
	$('#attackAlert').text("Puzzle reward added to your balance").show();
	setTimeout(function(){$('#attackAlert').hide();},5000);
	$('#attackBox').load('puzzles/puzzles.html');
	$('#attackTitle').text('Attack player: Puzzle section');
	setPuzzle(puzzleNum);
}

function getTime()
{
	$.post('../getTime.php',{page:'4'},function(data,status){
		var m = $('m',data).text();
		var s = $('s',data).text();
		if( (m=='0'&&s=='0') || (Number(m)<0) )
		{
			$.post('../setState.php', {state:'5'} , function(data,status){
				window.location = "../finished.php";
			});	
		}
		if(s.length==1)
			s = '0'+s;
		$('#timeValue').text(m+':'+s);
	});
}

function logout()
{
	response = confirm('Are you sure you want to log out?');
	if(response==true)
		window.location = "../logout.php";
}

// $(window).bind("beforeunload", function () { logout();  });

// window.onbeforeunload = function() {
//         return "Leaving or Refreshing the page may cause problems!";
// }