/*
$.post("ajax/getSelfData.php",{},
	function(data,status)
	{
		teamId = $('teamId',data).text();
		defRoom = teamId;
		defPlayerRow = $('defence row',data).text();
		defPlayerCol = $('defence col',data).text();

		defPlayerCell = document.querySelector('#defMazeR'+defPlayerRow+'C'+defPlayerCol);
		defPlayerCell.innerHTML = teamId;
		defPlayerCell.style.backgroundColor = 'green';	
	}
);

setInterval(getDefencePlayers,100);


document.addEventListener('keyup',function(e)
{
	if(e.keyCode==65 || e.keyCode==87 || e.keyCode==68 || e.keyCode==83)
	{
		switch(e.keyCode)
		{
			case 65: 	if(defPlayerCol>1) { defPlayerCol--; }; break;
			case 87: 	if(defPlayerRow>1) { defPlayerRow--; }; break;
			case 68: 	if(defPlayerCol<size) { defPlayerCol++; }; break;
			case 83: 	if(defPlayerRow<size) { defPlayerRow++; }; break;			
		}
		setDefencePlayer();
		getDefencePlayers();
	}	
},
false);*/

