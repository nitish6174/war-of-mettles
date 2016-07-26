setInterval(getTime,500);

function getTime()
{
	$.post('getTime.php',{page:'3'},function(data,status){
		var m = $('m',data).text();
		var s = $('s',data).text();
		if( (m=='0'&&s=='0') || (Number(m)<0) )
		{
			redirect();
		}
		if(Number(m)>1)
			$('#msg').text('The war begins in '+m+' minutes');
		else if(Number(m)==1)
			$('#msg').text('The war begins in 1 minute and '+s+' seconds');
		else
			$('#msg').text('Get ready! Just '+s+' seconds left for the battle');
	});
}

function redirect()
{
	$.post('setState.php', {state:'4'} , function(data,status){
		window.location = "treasure";
	});	
}
