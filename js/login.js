// $('#loginModal').modal({show:true});
$('#loginAlert').hide();

var id = document.querySelector('#id');
var password = document.querySelector('#password');

function validateLogin()
{
	if(id.value=="" || password.value=="")
	{
		$('#loginAlert .msg').text('Both fields are required');
		$('#loginAlert').show();       
	}
	else
	{
		$.post('login.php',
			{
				id: id.value,
				password: password.value
			},
			function(data,status)
			{
				var responseMsg = $('response',data).text();
				if(responseMsg=='OK')
				{
					$('#loginAlert').hide();
					$('#loginModal').modal('hide');
					window.location = "instructions1.php";
				}
				else
				{
					$('#loginAlert .msg').text(responseMsg);
					$('#loginAlert').show();
				}                
			}
		);
	}
	return false;
}























/*


$('#loginModal').modal({
    show:true,
    backdrop : "static",
    keyboard: false
}).on('hide.bs.modal',function(e){
    e.preventDefault();    
});


var xmlHttp = createXmlHttpRequestObject();

function validate()
{
    msg.innerHTML = '';
	if(roll.value=="" || password.value=="")
	{
		msg.innerHTML = 'Both fields are required';
	}
	else
	{
		rollvalue = encodeURIComponent(roll.value);
        passwordvalue = encodeURIComponent(password.value);
        xmlHttp.open("GET", "login.php?roll="+rollvalue+"&password="+passwordvalue, true);
        xmlHttp.onreadystatechange = handleServerResponse;
        xmlHttp.send();
	}
}

function handleServerResponse() 
{
    if ( xmlHttp.readyState==4 && xmlHttp.status==200 )
    {        
        xmlResponse = xmlHttp.responseXML;
        xmlDocumentElement = xmlResponse.documentElement;
        message = xmlDocumentElement.firstChild.data;
        if(message=="OK")
        {
            window.location = "bus/bus.html";
        }
        else
        {
            msg.innerHTML = message;
        }        
    }
}

function createXmlHttpRequestObject() 
{
    var xmlHttp;
    if (window.ActiveXObject)
    {
        try { xmlHttp = new ActiveXObject("Microsoft.XMLHTTP"); }
        catch (e) { xmlHttp = false; }
    }
    else
    {
        try { xmlHttp = new XMLHttpRequest(); }
        catch (e) { xmlHttp = false; }
    }

    if (!xmlHttp)
        alert("Could not create XML Object");
    else
        return xmlHttp;
}
*/