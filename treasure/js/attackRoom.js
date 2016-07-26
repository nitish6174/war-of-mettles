/*
$.post("ajax/getSelfData.php",{},
	function(data,status)
	{
		teamId = $('teamId',data).text();
		attRoom = $('attack room',data).text();
		attPlayerRow = $('attack row',data).text();
		attPlayerCol = $('attack col',data).text();
	
		attPlayerCell = document.querySelector('#attMazeR'+attPlayerRow+'C'+attPlayerCol);
		attPlayerCell.innerHTML = teamId;
		attPlayerCell.style.backgroundColor = 'blue';	
	}
);

setInterval(getAttackPlayers,100);

document.addEventListener('keyup',moveAttPlayer,false);
function moveAttPlayer(e)
{
	if(e.keyCode>=37 && e.keyCode<=40)
	{
		//attPlayerCell = document.querySelector('#attMazeR'+attPlayerRow+'C'+attPlayerCol);
		//attPlayerCell.style.backgroundColor = 'white';
		//attPlayerCell.innerHTML = '';
		//switch(e.keyCode)
		{
			case 37: 	if(attPlayerCol>1)
						{ 
							attPlayerCol--;
							setAttackPlayer();
							getAttackPlayers();
						}
						break;
			case 38: 	if(attPlayerRow>1)
						{
							attPlayerRow--;
							setAttackPlayer();
							getAttackPlayers();
						}
						else if(attPlayerCol==5)
						{
							loadGrid();
						}
						break;
			case 39: 	if(attPlayerCol<size)
						{
							attPlayerCol++;
							setAttackPlayer();
							getAttackPlayers();
						};
						break;
			case 40: 	if(attPlayerRow<size)
						{
							attPlayerRow++;
							setAttackPlayer();
							getAttackPlayers();
						};
						break;			
		}			
	}	
}
*/