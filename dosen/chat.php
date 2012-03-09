<?php
include "../sambung.inc.php";
include "converttanggal.php";
session_start();
$initid=$_SESSION['nipdos'];
  if (!isset($initid))
  {
	header("Location: index.php");
  }
//---------------------  
 $ip=$_SERVER['REMOTE_ADDR'];
 $now=date("Y-m-d H:i:s");
 $query = mysql_query("SELECT * FROM online_user WHERE id='$_SESSION[nipdos]'");
 $cek = mysql_fetch_array($query);
 		$dul=strtotime($cek['tm']);
		$skr=strtotime($now);
		$dif=(integer)$skr-$dul;
		//echo "$dif";
 if ($dif < 600)
 {		
 $sql = mysql_query("UPDATE online_user SET ip='$ip', tm='$now' ,sta='1' WHERE id='$_SESSION[nipdos]'"); 
 }
 else
 {
  $sql = mysql_query("UPDATE online_user SET sta='0' WHERE id='$_SESSION[nipdos]'");
 session_destroy();
 header("Location: index.php");
 }
 $ubah = mysql_query("UPDATE online_user SET sta='0' WHERE ((UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(tm))/60) > 10");     
 
 $ceknip = mysql_query("SELECT nama_dosen FROM data_dosen WHERE NIP='$_SESSION[nipdos]'");
 $q=mysql_fetch_array($ceknip);
 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>..::[SPOTA Prodi TEKNIK INFORMATIKA]::..</title>
<meta name="keywords" content="SPOTA, Sistem Pendukung Outline Tugas Akhir" />
<meta name="copyright" content="nikolaidiez - Teknik Informatika - UNTAN" />
<script type="text/javascript" src="ed.js"></script>
<script type="text/javascript" src="aj.js"></script>
<link href="default.css" rel="stylesheet" type="text/css" media="screen" />
<script language="javascript" type="text/javascript">
var httpObject = null;
      var link = "";
      var timerID = 0;
	  var id = "<?php echo $_SESSION['nipdos']; ?>"; 
      var nama = "<?php echo $q['nama_dosen']; ?>";

      // Get the HTTP Object
      function getHTTPObject(){
         if (window.ActiveXObject) return new ActiveXObject("Microsoft.XMLHTTP");
         else if (window.XMLHttpRequest) return new XMLHttpRequest();
         else {
            alert("Your browser does not support AJAX.");
            return null;
         }
      }

      // Change the value of the outputText field
      function setOutput(){
         if(httpObject.readyState == 4){
            var response = httpObject.responseText;
            var objDiv = document.getElementById("result");
            objDiv.innerHTML += response;
  
            var inpObj = document.getElementById("msg");
            inpObj.value = "";
            inpObj.focus();
         }
      }

		
      // Change the value of the outputText field
      function setAll(){
         if(httpObject.readyState == 4){
            var response = httpObject.responseText;
            var objDiv = document.getElementById("result");
            objDiv.innerHTML = response;
           
         }
      }

      // Implement business logic
      function doWork(){
         httpObject = getHTTPObject();
         if (httpObject != null) {
            link = "point.php?id="+id+"&nama="+nama+"&msg="+document.getElementById('msg').value;
            link = link+"&sid="+Math.random()
			httpObject.open("GET", link , true);
            httpObject.onreadystatechange = setOutput;
            httpObject.send(null);
         }
      }

      // Implement business logic
      function doReload(){
         httpObject = getHTTPObject();
         
         if (httpObject != null) {
            link = "point.php?all="+Math.random()
            httpObject.open("GET", link , true);
            httpObject.onreadystatechange = setAll;
            httpObject.send(null);
         }
      }

      function UpdateTimer() {
         doReload();
         timerID = setTimeout("UpdateTimer()", 1000);
      }

	  function history(url)
	  {
	  window.open(url, '', 'width=400, height=200,status=no,menubar=no,toolbar=no,resizable=1,scrollbars=1');
	  }	  

      function keypressed(e){
         if(e.keyCode=='13'){
            doWork();
         }
      }
</script>
</head>
<body class="admin" onload="UpdateTimer();">
<div id="header"></div>
<div id="main">
<?php include "menu.php"; ?>
<br><br>
<div id="chat">
<div id="head">Chat SPOTA v1.1&nbsp;&nbsp;<a href="javascript:void(0);" onClick="history('history.php');">[History]</a></div>                                                                                             
<div id="result"></div>
<div id="sender" onkeyup="keypressed(event);">  
<input type="text" name="msg" id="msg" size="130" />&nbsp;<img src="../images/submm.png" onClick="doWork();">
</div>
</div>
</div>
</body>
</body>
</html>