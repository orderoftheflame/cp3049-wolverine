var xmlhttp;

function validate(form)
{
	var str = form.txtUsername.value;
	alert(str);
	return false;
}

function getUser(str)
{
xmlhttp=GetXmlHttpObject();
if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  return;
  }
var url="getuser.php";
url=url+"?q="+str;
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);
}

function stateChanged()
{
	if (xmlhttp.readyState==4)
	{
	
	var response = xmlhttp.responseText.toString();
	response = response.replace(/^\s+|\s+$/g,"");
		if (response == "found"){
			document.getElementById("txtUserResult").innerHTML='<p class="red bold">Username is already taken, try another.</p>';
		}else{
			if (response == "notfound"){
				document.getElementById("txtUserResult").innerHTML='<p class="green bold">Username valid.</p>';
			}
		}

		//document.getElementById("txtUserResult").innerHTML=xmlhttp.responseText;
	}
}

function GetXmlHttpObject()
{
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  return new XMLHttpRequest();
  }
if (window.ActiveXObject)
  {
  // code for IE6, IE5
  return new ActiveXObject("Microsoft.XMLHTTP");
  }
return null;
}