<?php
include "sambung.inc.php";
session_start();
if(!isset($_POST['ok']))
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>..::[SPOTA Prodi TEKNIK INFORMATIKA]::..</title>
<meta name="keywords" content="SPOTA, Sistem Pendukung Outline Tugas Akhir" />
<meta name="copyright" content="nikolaidiez - Teknik Informatika - UNTAN" />
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body> <!--
<div id="header">
	<br /><br /><br /><br /><center><img src="images/maintenance.png" /></center>
</div>
-->
<div id="menu" style="background-image:url(images/menu.gif);">
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="praoutline.php">Praoutline</a></li>
		<li><a href="index.php?bag=kontak">Kontak</a></li>
	</ul>
</div>
<div id="header" style="background-image:url(images/header.gif);"></div>
<div id="page">
	<form method="post" action="<?php echo "index.php?bag=kotaksaran"; ?>">
	<div id="content">
	<ul>
		<li>
		<h2><u>Penjelasan tentang SPOTA</u></h2>
		<ul>
		<?php
		$link=$_GET['bag'];
		if ($link=="kontak")
		{
		?>
		
		
        <table width="100%" border="0">
            <tr>
            <td colspan="2"><u><strong>Berikan Saran Anda</strong></u></td>
            </tr>
          <tr>
            <td width="30%">Nama Anda&nbsp;</td>
            <td width="70%"><input type="text" name="nama" maxlength="20" size="20"></td>
            </tr>
            <tr>
            <td>Email Anda&nbsp;</td>
            <td><input type="text" name="email" maxlength="30" size="30"></td>
            </tr>
            <tr>
            <td>Saran/Pesan&nbsp;</td>
            <td><textarea name="problem" rows=6 cols=40></textarea></td>
            </tr>			
            <tr>
            <td>&nbsp;</td>
            <td>&nbsp;<input type="submit" name="kirimpesan" value="Kirim" class="biasa">&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="Cancel" class="biasa"></td>
            </tr>
      </table>
      
	  
		<?php
		}
		else
		{
		?>
		  <p>Sistem Pendukung Outline Tugas Akhir merupakan sistem yang dibangun untuk <b>membantu</b> kerja dosen dalam me-review atau menanggapi setiap judul yang dipilih atau diangkat oleh mahasiswa sebagai judul Tugas Akhir.</p>
		  <p>Mahasiswa diharapkan dapat<strong> meng-upload-kan</strong> draft praoutline yang berisi keterangan lengkap tentang judul yang diangkat dimulai dari inti permasalahan yang bersifat <strong><i>urgen</i></strong> dan tujuan <em><strong>jelas</strong></em> penelitian.</p>
		  <p>Hasil dari review atau tanggapan dosen dapat dilihat pada menu praoutline ataupun pada account masing-masing mahasiswa. Pada halaman itu pula dapat dilihat saran dari mahasiswa.</p> 
		<?php
		}
		?>
		</ul>
		</li>
	</ul>	
	</div>	
	</form>
	 <?php
      if (isset($_POST['kirimpesan']))
      {
          function valemail($str)
            {
              return (ereg('^[^@]+@([a-z\-]+\.)+[a-z]{2,4}$',$str));
            }

        $problem_cek = strip_tags($_POST['problem']);
		$problem_cek = trim($problem_cek);
		$nama=trim($_POST['nama']);
		$waktu=date("H:i:s");
		
		if ((($problem_cek!=NULL) or ($problem_cek!='%')) and (($nama!=NULL) or ($nama!='%')) and  (valemail($_POST['email']))) 
		{
				$query=mysql_query("INSERT INTO kotak_pesan(nama,email,saran,tanggal,waktu) values ('$nama','$_POST[email]','$problem_cek', NOW(), '$waktu')");
		?>   
           		<script language="javascript">alert("Terima Kasih")</script>
				<meta http-equiv="refresh" content="0;URL=index.php?bag=kontak">
   			<?php
        }
        else
        {
		?>
          		<script language="javascript">alert("Input Kosong ataupun Format Email keliru")</script>
				<meta http-equiv="refresh" content="0;URL=index.php?bag=kontak">
  		<?php
		}
	}	
		?>
	
	<div id="sidebar">
		<ul>
			<li>
				<h2>Website Untan Lainnya</h2>
					<ul>
						<li><a href="#">E-learning</a></li>
						<li><a href="#">Untan</a></li>
						<li><a href="#">Video Streaming</a></li>
						<li><a href="#">Next</a></li>
					</ul>
			</li>
			<li>
			<form method="post" action="index.php">
				<h2>Login Mahasiswa</h2>
					<ul>					
				    <table width="200" align="center">
                         <tr>
                           <td width="110">Username</td>
                           <td><input type="text" name="nim" size="20" class="biasa"></td>
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
			</form>		
			</li>
		</ul>
  </div>
</div>
<div id="footer">
	<p>Copyright 2008 - Teknik Informatika - Universitas Tanjungpura</p>
</div>

</body>
<?php
}
else
{
  include "sambung.inc.php";
  $nim=strtoupper($_POST['nim']);
  $pass=md5($_POST['pass']);
  $query = sprintf("SELECT * FROM log_mhs WHERE NIM='%s' and PWMHS='%s'",mysql_real_escape_string($nim),mysql_real_escape_string($pass));
  $login = mysql_query($query,$connect);
  $rowcount = mysql_num_rows($login);
  if ($rowcount == 1)
  {
  $_SESSION['nim'] = $nim;
  $now=date("Y-m-d H:i:s");
	$ip=$_SERVER['REMOTE_ADDR'];
	
    $cekonline = mysql_query("SELECT * FROM online_user WHERE id='" . $nim . "'",$connect);
	if(mysql_num_rows($cekonline)>=1){
	 $updatenya = mysql_query("UPDATE online_user SET tm=now(),sta='1' WHERE id='$nim'");
	}else{
	 $loginn = mysql_query("INSERT INTO `neospota`.`online_user` (`id` ,`ip` ,`tm` ,`sta` )VALUES (
                          '$nim', '$ip', now(), '1');
              ");
	}
	    $cek=mysql_fetch_array($cekonline);
		$dul=strtotime($cek['tm']);
		$skr=strtotime($now);
		$dif=$skr-$dul;
		if ($cek['sta']=="0")
		{
    	header("Location: mhs-spota/index.php");
		}
		else
		{
			if ($dif >= 600)
			{
				header("Location: mhs-spota/index.php");
			}
			else
			{
				if ($cek['ip']=="$ip")
				{
					header("Location: mhs-spota/index.php");
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
	<script type="text/javascript">alert("Gagal LOGIN, Cek Username dan Password Anda")</script>
	<meta http-equiv="refresh" content="0;URL=index.php">			
<?php  
  	}
}
?>


</html>
