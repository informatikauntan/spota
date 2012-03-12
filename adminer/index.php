<?php
session_start();
include ("../sambung.inc.php");
if ($_SESSION['user_nama']==''){
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
				<h2>Login Administrator</h2>
				<ul>
				<table width="220" align="center">
                         <tr>
                           <td width="110">Username</td>
                           <td><input type="text" name="usernama" size="20" class="biasa"></td>
                         </tr>
                         <tr>
                           <td width="110">Password</td>
                           <td><input type="password" name="password" size="20" class="biasa"></td>
                         </tr>
						 <tr>
                           <td colspan="2" align="center"><input type="submit" name="submit" value="Login" class="spesial"></td>
                         </tr>
                </table>			
				</ul>			
			</li>
		</ul>
		</form>
	</div>
</body>
</html>
<?php
}else{
echo "<script>window.location.href='admin-spota.php'</script>";
}
if (ISSET($_POST['submit'])){
  $login = mysql_query("select * from log_admin where (user_name = '" . $_POST['usernama'] . "') and (pwadmin = '" . md5($_POST['password'] ). "')",$connect);
  $rowcount = mysql_num_rows($login);
  if ($rowcount == 1) 
  {
    $_SESSION['user_nama'] = $_POST['usernama'];
	$usernama=$_POST['usernama'];
	$now=date("Y-m-d H:i:s");
	$ip=$_SERVER['REMOTE_ADDR'];
    $cekonline = mysql_query("SELECT * FROM online_user WHERE id='" . $_POST['usernama'] . "'",$connect);
	if(mysql_num_rows($cekonline)>=1){
	 $updatenya = mysql_query("UPDATE online_user SET tm=now(),sta='1' WHERE id='$usernama'");
	}else{
	 $loginn = mysql_query("INSERT INTO `online_user` (`id` ,`ip` ,`tm` ,`sta` )VALUES (
                          '$usernama', '$ip', now(), '1');
              ");
	}
	      $cek=mysql_fetch_array($cekonline);
		$dul=strtotime($cek['tm']);
		$skr=strtotime($now);
		$dif=$skr-$dul;
		if ($cek['sta']=="0")
		{
		echo "<script>window.location.href='admin-spota.php'</script>";
		}
		else
		{
			if ($dif >= 600)
			{
				echo "<script>window.location.href='admin-spota.php'</script>";
			}
			else
			{
				if ($cek['ip']=="$ip")
				{
					echo "<script>window.location.href='admin-spota.php'</script>";
				} 
				else
				{
					echo "<script>window.location.href='index.php'</script>";
				}
			} 
		
		}
  }
  else{
  	echo "<script>alert('Gagal Login');</script>";
  }
}
?>
