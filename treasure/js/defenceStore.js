$('.inputBox').on('input',function() {
	if (this.value.length > 2) {
        this.value = this.value.slice(0,2); 
    }
});

$('.inputButton').click(function() {
	if($(this).attr('id')=='woodButton')
	{
		var amount=$('#woodInputBox').val();
		var type="1";
		var cost = amount*5;
		defMaterial=1;
	}
	else if($(this).attr('id')=='brickButton')
	{
		amount=$('#brickInputBox').val();
		type="2";
		cost=amount*20;
		defMaterial=2;
	} 
	else if($(this).attr('id')=='concreteButton')
	{
		amount=$('#concreteInputBox').val();
		type="3";
		cost=amount*50;
		defMaterial=3;
	} 
	if(cost<=treasure)
	{
		if(amount>0) {
			setMaterial(teamId, amount, type);
			setTreasure(teamId, cost*(-1));
			getMaterial();
		}
	}
	else
	{
		$('#defenceAlert').text("Insufficient treaure for this purchase").show();
		setTimeout(function(){$('#defenceAlert').hide();},5000);
	}
});

$('.useitem').click(function() {
	if($(this).attr('id')=='woodwalluse')
	{
		selectedMaterial = 1;
		var amount=material1;
		if(amount>0)
			defMaterial=1;
	}
	else if($(this).attr('id')=='brickwalluse')
	{
		selectedMaterial = 2;
		amount=material2;
		if(amount>0)
			defMaterial=2;
	} 
	else if($(this).attr('id')=='concwalluse')
	{
		selectedMaterial = 3;
		amount=material3;
		if(amount>0)
			defMaterial=3;
	};
	if(amount>0)
	{
		$('#defenceAlert').text("Weapon switched").show();
		setTimeout(function(){$('#defenceAlert').hide();},5000);
	}
	else
	{
		$('#defenceAlert').text("Buy this material first to use it").show();
		setTimeout(function(){$('#defenceAlert').hide();},5000);
	}
});

// $('.useitem').hover(function() {
// 	$(this).text('USE');
// 	$(this).css('font-size', '40px');
// }
// );