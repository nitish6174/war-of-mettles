var row = [1,2,4,5,5,6,8,9];
var col = [2,3,6,1,9,4,6,8];
var num = [3,5,2,6,4,2,8,4];

for(var i=0;i<9;i++)
{
	$('#islandsMazeR'+row[i]+'C'+col[i]+'').removeClass('blankcell');
	$('#islandsMazeR'+row[i]+'C'+col[i]+'').removeClass('default');
	$('#islandsMazeR'+row[i]+'C'+col[i]+'').addClass('ncell');
	$('#islandsMazeR'+row[i]+'C'+col[i]+'').text(num[i]);
}

$('.blankcell').click( function(){
	if($(this).hasClass('default')) 
	{
		$(this).removeClass('default');
		$(this).addClass('blue');
	}
	else if($(this).hasClass('blue')) 
	{
		$(this).removeClass('blue');
		$(this).addClass('white');
	}
	else if($(this).hasClass('white')) 
	{
		$(this).removeClass('white');
		$(this).addClass('default');
	};
});