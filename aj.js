// JavaScript Document
var xmlHttp
function tsemang(a)
{
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null)
		{
		alert ("Browser tidak support Http Request")
		}
		
	var url="inti.php"
	url=url+"?task=tsemang&sem="+a
	url=url+"&sid="+Math.random()
	xmlHttp.onreadystatechange=menucari
	xmlHttp.open("GET",url,true)
	xmlHttp.send(null)
}

function menucari()
{
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
			{
				document.getElementById("adva").innerHTML=xmlHttp.responseText
			}
	if (xmlHttp.readyState==1 || xmlHttp.readyState=="loading")
			{
				document.getElementById("adva").innerHTML="<img src=\"images/loading1.gif\"/><br/>loading hasil.."
			}
}

function GetXmlHttpObject()
{
var xmlHttp=null;
try
  {
  // ngecek buat browser firefox, opera 8.0+, safari
  xmlHttp=new XMLHttpRequest();
  }
  catch (e)
    {
    // browser Internet Explorer
    try
      {
      // IE 6.0+
      xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
      }
      catch (e)
        {
        // IE 5.0
        xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
return xmlHttp;
}