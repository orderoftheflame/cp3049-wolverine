var xmlhttp;
var updateTag;

function callService(page, query, updateTagID)
{
	updateTag = updateTagID;
	document.getElementById(updateTagID).innerHTML="Loading...";
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	  {
	  alert ("Browser does not support HTTP Request");
	  return;
	  }
	var url=page;
	url=url+"?q="+query;
	url=url+"&sid="+Math.random();
	xmlhttp.onreadystatechange=stateChanged;
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);
}
function runSpecial(fromSelect, page,q, updateTag){
var selObj = document.getElementById(fromSelect);
var selIndex = selObj.selectedIndex;
var val = selObj.options[selIndex].value;
callService2(page,val,q,updateTag);
}
function callService2(page, query1, query2, updateTagID)
{
	updateTag = updateTagID;
	document.getElementById(updateTagID).innerHTML="Loading...";
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	  {
	  alert ("Browser does not support HTTP Request");
	  return;
	  }
	var url=page;
	url=url+"?q="+query1;
	url=url+"&q2="+query2;
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
	document.getElementById(updateTag).innerHTML=response;
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