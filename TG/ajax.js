function Object() {

	var check=false;

	if (window.XMLHttpRequest)
	{
		try
		{
			check = new XMLHttpRequest();
		}
		catch(e)
		{
			check=false;
		}
	}
	else if(window.ActiveXObject)
	{
		try
		{
		check=new ActiveXObject("Msxml2.HTMLHTTP");
		}
		catch(e)
		{
			try
			{
				check=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e)
			{
			check=false;
			}
		}
	}
	return check;
}

var http = Object();

function send(id)
{
var k=id;
	http.open("get","ajax.php?id="+id);
	http.onreadystatechange = function response() { 

	if(http.readyState == 4)
	{	
		la(k+"tr");
		document.getElementById(k+"td").innerHTML=http.responseText;
	}
	};
	http.send(null);
}

function delAjax(id,type)
{
	http.open("get","delajax.php?id="+id+"&type="+type);
	http.onreadystatechange = function response1() { 

	if(http.readyState == 4)
	{	
		alert(http.responseText);
	}
	};
	http.send(null);
}


/*
function response()
{
	k=327;
	if(http.readyState == 4)
	{	
		la(k+"tr");
		document.getElementById(k+"td").innerHTML=http.responseText;
	}
}


<form id="form1" align="center">
<input type="text" id="number"/>
<br />
<input type="button" onclick="send(form1.number.value)" value="send"/>
<br />
<div id="text">
</div>
</form>
*/