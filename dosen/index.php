<?php 
session_start();
if(!isset($_POST['ok']))
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>..::[SPOTA Prodi TEKNIK INFORMATIKA]::..</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body>
	<div id="inti">
	<form method="post" action="index.php">
		<ul>
			<li>
				<h2>Login Dosen</h2>
				<ul>
				<table width="220" align="center">
                         <tr>
                           <td width="110">Username</td>
                           <td><input type="text" name="nip" size="20" class="biasa"></td>
                         </tr>
                         <tr>
                           <td width="110">Password</td>
                           <td><input type="password" name="pass" size="20" class="biasa"></td>
                         </tr>
						 <tr>
                           <td colspan="2" align="center"><input type="submit" name="ok" value="Login" class="spesial"></td>
                         </tr>
                </table>
				</ul>			
			</li>
		</ul>
	</form>	
	</div>
<?php
}
else
{
  include "../sambung.inc.php";
  $login = mysql_query("select * from log_dos where (NIP = '" . $_POST['nip'] . "') and (pwdosen = '" . md5($_POST['pass'] ). "')",$connect);
  $rowcount = mysql_num_rows($login);
  if ($rowcount == 1) 
  {
    $_SESSION['nipdos'] = $_POST['nip'];
    $now=date("Y-m-d H:i:s");
    $nip=$_POST['nip'];
	$ip=$_SERVER['REMOTE_ADDR'];
    $cekonline = mysql_query("SELECT * FROM online_user WHERE id='" . $_POST['nip'] . "'",$connect);
	if(mysql_num_rows($cekonline)>=1){
	 $updatenya = mysql_query("UPDATE online_user SET tm=now(),sta='1' WHERE id='$nip'");
	}else{
	 $loginn = mysql_query("INSERT INTO `neospota`.`online_user` (`id` ,`ip` ,`tm` ,`sta` )VALUES (
                          '$nip', '$ip', now(), '1');
              ");
	}
	    $cek=mysql_fetch_array($cekonline);
		$dul=strtotime($cek['tm']);
		$skr=strtotime($now);
		$dif=$skr-$dul;
		if ($cek['sta']=="0")
		{
    	header("Location: dosen-spota.php");
		}
		else
		{
			if ($dif >= 600)
			{
				header("Location: dosen-spota.php");
			}
			else
			{
				if ($cek['ip']=="$ip")
				{
					header("Location: dosen-spota.php");
				} 
				else
				{
					header("Location: index.php");
				}
			} 
		
		}
  }
  else
  {
?>  
  	<script type="text/javascript">alert("Gagal Login")</script>
  	<meta http-equiv="refresh" content="1;URL=index.php">
<?php  
  }
}  
?>
</body>
</html>
