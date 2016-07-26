function redirect()
{
	$.post('setState.php', {state:'2'} , function(data,status){
		window.location = "schedule";
	});
}
