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
                           <td><input type="text" name="kapro" size="20" class="biasa"></td>
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
  $login = mysql_query("select * from log_kaprodi where (kaprodi_name = '" . $_POST['kapro'] . "') and (pwkaprodi = '" . md5($_POST['pass'] ). "')",$connect);
  $rowcount = mysql_num_rows($login);
  if ($rowcount == 1) 
  {
    $_SESSION['kapro'] = $_POST['kapro'];
    //$cekonline = mysql_query("SELECT online_id FROM online_user WHERE chat_name='" . $_POST['usernama'] . "'",$connect);
	  //  $re_cekonline = mysql_num_rows($cekonline);
		//if ($re_cekonline == 0)
		//if 
		//{
    	header("Location: kaprodi.php");
		//}
		//else
		//{
		//header("Location: index.php");
		//}
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
