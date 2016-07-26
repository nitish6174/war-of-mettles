$('.attinputBox').on('input',function() {
	if (this.value.length > 2) {
        this.value = this.value.slice(0,2); 
    }
});

$('.attinputButton').click(function() {
	if($(this).attr('id')=='sawButton')
	{
		var amount=$('#sawInputBox').val();
		var type="1";
		var cost = amount*10;
	}
	else if($(this).attr('id')=='hammerButton')
	{
		amount=$('#hammerInputBox').val();
		type="2";
		cost=amount*30;
	} 
	else if($(this).attr('id')=='explosiveButton')
	{
		amount=$('#explosiveInputBox').val();
		type="3";
		cost=amount*80;
	}

	if(cost<=treasure)
	{
		if(amount>0) {
			setWeapon(teamId, amount, type);
			setTreasure(teamId, cost*(-1));
			getWeapon();
		}
	}
	else
	{
		$('#attackAlert').text("Insufficient treaure for this purchase").show();
		setTimeout(function(){$('#attackAlert').hide();},5000);
	}
});

$('#puzzleButton').click(function()
{
	$('#attackBox').load('puzzles/puzzles.html');
	$('#attackTitle').text('Attack player: Puzzle section');
});
