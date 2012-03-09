// JavaScript Document
var xmlHttp
function cool(a)
{
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null)
		{
		alert ("Browser tidak support Http Request")
		}
var url="inti.php"
url=url+"?task=tampil&jenis_rev="+a
xmlHttp.onreadystatechange=radio
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
}

function radio()
{
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
			{
				document.getElementById("rev").innerHTML=xmlHttp.responseText
			}
	if (xmlHttp.readyState==1 || xmlHttp.readyState=="loading")
			{
				document.getElementById("rev").innerHTML="<img src=\"images/loading2.gif\"/><br/>Loading.."
			}
}

function tberkas(a)
{
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null)
		{
		alert ("Browser tidak support Http Request")
		}

if (a.checked)
{
	mun=a.value;
}
	else
{
	mun="";
}

var url="inti.php"
url=url+"?task=berkas&aktif="+mun
url=url+"&sid="+Math.random()
xmlHttp.onreadystatechange=munculberkas
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
}



function tradio(a)
{
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null)
		{
		alert ("Browser tidak support Http Request")
		}

if (a.checked)
{
	ok="ad";
}
	else
{
	ok="";
}

var url="inti.php"
url=url+"?task=tradio&rad="+ok
url=url+"&sid="+Math.random()
xmlHttp.onreadystatechange=munculradio
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
}

function rec(a)
{
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null)
		{
		alert ("Browser tidak support Http Request")
		}
		

		
	var url="inti.php"
	url=url+"?task=tcombo&rad="+a
	url=url+"&sid="+Math.random()
	xmlHttp.onreadystatechange=munculcombo
	xmlHttp.open("GET",url,true)
	xmlHttp.send(null)
		
}

function recm(a)
{
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null)
		{
		alert ("Browser tidak support Http Request")
		}
	
	var url="inti.php"
	url=url+"?task=tcombo&rad="+a
	url=url+"&sid="+Math.random()
	xmlHttp.onreadystatechange=munculcombom
	xmlHttp.open("GET",url,true)
	xmlHttp.send(null)
		
}

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


function munculcombom()
{
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
			{
				document.getElementById("accm").innerHTML=xmlHttp.responseText
			}
	if (xmlHttp.readyState==1 || xmlHttp.readyState=="loading")
			{
				document.getElementById("accm").innerHTML="<img src=\"images/loading3.gif\"/><br/>loading hasil.."
			}
}

function munculberkas()
{
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
			{
				document.getElementById("berkas").innerHTML=xmlHttp.responseText
			}
	if (xmlHttp.readyState==1 || xmlHttp.readyState=="loading")
			{
				document.getElementById("berkas").innerHTML="<img src=\"images/loading1.gif\"/>loading hasil.."
			}
}



function munculcombo()
{
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
			{
				document.getElementById("acp").innerHTML=xmlHttp.responseText
			}
	if (xmlHttp.readyState==1 || xmlHttp.readyState=="loading")
			{
				document.getElementById("acp").innerHTML="<img src=\"images/loading3.gif\"/><br/>loading hasil.."
			}
}

function munculradio()
{
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
			{
				document.getElementById("acc").innerHTML=xmlHttp.responseText
			}
	if (xmlHttp.readyState==1 || xmlHttp.readyState=="loading")
			{
				document.getElementById("acc").innerHTML="<img src=\"images/loading3.gif\"/><br/>loading.."
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