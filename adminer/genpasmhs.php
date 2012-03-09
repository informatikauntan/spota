<?php 
include "../sambung.inc.php";
session_start();
  if (!isset($_SESSION['user_nama']))
  {
	header("Location: index.php");
  }

//---------------------  
 $ip=$_SERVER['REMOTE_ADDR'];
 $now=date("Y-m-d H:i:s");
 $query = mysql_query("SELECT * FROM online_user WHERE id='$_SESSION[user_nama]'");
 $cek = mysql_fetch_array($query);
 		$dul=strtotime($cek['tm']);
		$skr=strtotime($now);
		$dif=(integer)$skr-$dul;
		//echo "$dif";
 if ($dif < 600)
 {		
 $sql = mysql_query("UPDATE online_user SET ip='$ip', tm='$now' ,sta='1' WHERE id='$_SESSION[user_nama]'"); 
 }
 else
 {
  $sql = mysql_query("UPDATE online_user SET sta='0' WHERE id='$_SESSION[user_nama]'");
 session_destroy();
 header("Location: index.php");
 }
 $ubah = mysql_query("UPDATE online_user SET sta='0' WHERE ((UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(tm))/60) > 10");                                                                     	
//------------------------------  
  
?> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>..::[SPOTA Prodi TEKNIK INFORMATIKA]::..</title>
<meta name="keywords" content="SPOTA, Sistem Pendukung Outline Tugas Akhir" />
<meta name="copyright" content="nikolaidiez - Teknik Informatika - UNTAN" />
<link href="default.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="haldatdos">
	<div id="genpasdos"> 
		<ul>	
		<li>		
		<form method="post" action="admin-spota.php?part=pasmhs" name="angk">
		<h2><u>Cari Password Mahasiswa</u></h2>	
			<ul>	
				<table width="330" border="0">
					<tr>
    				<td>Pilih Angkatan</td>
    				<td><select name="angkatan" onChange="document.angk.submit()">
							<option value="0"> - - Angkatan - -</option>
							<?php
							$check = "SELECT DISTINCT(angkatan) As P FROM data_mahasiswa";
							$hasil_check=mysql_query($check);
							while ($angcheck=mysql_fetch_array($hasil_check))
							{				
								if ($_POST['angkatan']==$angcheck[P] || $_GET['angkt']==$angcheck[P])
								{					
									echo "<option value='$angcheck[P]' selected>$angcheck[P] </option>";
								}
								
								else
								{
									echo "<option value='$angcheck[P]'>$angcheck[P] </option>";
								}				
							}
							?>									
						</select>
					&nbsp;&nbsp;<a href="admin-spota.php?part=pasmhs&&action=all">[Show All]</a></td>						
  				</tr>
				</table>
			</ul>
		</form>
	</li>
			<?php
					$NIMedit = $_GET['nim'];
					$query= "SELECT * FROM log_mhs WHERE NIM='$NIMedit'";
						$hasil_panggil = mysql_query($query);
						$row = mysql_fetch_array($hasil_panggil);
						if ($NIMedit!='')
						{		
			?>
			<li>
			<form method="post" action="admin-spota.php?part=pasmhs">
				<h2><u>Edit Data Mahasiswa</u></h2>	
				<ul>
					<li>	  
					<table width="330" border="0">
  					<tr>
    					<td width="80">NIM</td>
						<td><input type="hidden" size="15" maxlength="9" name="NIMpass" class="biasa" value="<?php echo "$row[NIM]" ?>"><?php echo "$row[NIM]" ?></td>
  					<tr>
   			 			<td width="80">Password</td>
						<td><input type="text" size="35" maxlength="60" name="pass" value="<?php echo "$row[pw]" ?>"> <br>/*Batas input password 15 karakter*/</td>
  					</tr>
	 				</table> 
					</li>
				  	<li>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="editpass" value="Ubah Password Mahasiswa" class="spesial"></li>
				</ul>
			</form>
			</li>
			<?php
			}
		if (isset($_POST['editpass']))
		{
			$pass = $_POST['pass'];
			$nim = $_POST['NIMpass'];
			$anganeh = substr($nim,4,2);
				$query="UPDATE log_mhs set pw='".$pass."', pwmhs='".md5($pass)."' WHERE NIM = '".$nim."'";
					
				if (!empty($pass))
				{
				$hasil_query = mysql_query($query);
		?>
					<script type="text/javascript">alert("Password Mahasiswa Berhasil Diubah")</script>
					<meta http-equiv="refresh" content="0;URL=admin-spota.php?part=pasmhs&&angkt=<?php=$anganeh?>&&nim=<?php=$nim?>">
		<?php			
				}
				else
				{
		?>
					<script type="text/javascript">alert("Password Mahasiswa Kosong")</script>
					<meta http-equiv="refresh" content="1;URL=admin-spota.php?part=pasmhs&&angkt=<?php=$anganeh?>&&nim=<?php=$nim?>">
		<?php	
				}	
		}
		?>
	</ul>
</div>
	<?php
		$angk = $_POST['angkatan']; 
		$all = $_GET['action'];
		if (isset($angk) && $angk!=0 || $_GET['angkt']!='')
			{
				
	?>
				<div id="dafpassdos">
				<ul>
					<li>		
						<h2><u>Data Password Mahasiswa</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="admin-spota.php?part=pasmhs">[Close Box]</a></h2>	
						<ul>			
						<?php
							$query="SELECT NIM, pw FROM log_mhs WHERE MID(NIM,5,2)='$_POST[angkatan]' or MID(NIM,5,2)='$_GET[angkt]'";
							$hasil_query=mysql_query($query);
							$color1 = "#e5e5e5";
							$color2 = "#FFFFFF";	
  								while ($baris=mysql_fetch_array($hasil_query))
									{
										$anganeh = substr($baris[NIM],4,2);
										$row_color = ($row_count % 2) ? $color1 : $color2;
										echo "<table width='630' bgcolor=".$row_color.">";
										echo "<tr>
													<td width='200'><img src='images/point.gif'>&nbsp;&nbsp;NIM  : &nbsp;<a style='color:#990000; font-weight:bold; '>$baris[NIM]</a></td>
													<td width='400'>&nbsp;&nbsp;Password Mahasiswa : &nbsp;<a style='color:#990000; font-weight:bold; '>$baris[pw]</a></td>
													<td width=30'><a href='admin-spota.php?part=pasmhs&&angkt=$anganeh&&nim=$baris[NIM]'><img src='images/ico_edit.gif' title='Edit Data'></a></td>
											 </tr>";	
							 			$row_count++;
										echo "</table>";
									}
									
			   			?> 
						</ul>	   
					</li>
				</ul>	
				</div>
		<?php
		}	
		else if ($all=='all')
		{
		?>
		<div id="dafpassdos">
				<ul>
					<li>		
						<h2><u>Data Password Mahasiswa</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="admin-spota.php?part=pasmhs">[Close Box]</a></h2>	
						<ul>			
						<?php
							$query="SELECT NIM, pw FROM log_mhs ORDER BY NIM";
							$hasil_query=mysql_query($query);
							$color1 = "#e5e5e5";
							$color2 = "#FFFFFF";	
  								while ($baris=mysql_fetch_array($hasil_query))
									{
										$anganeh = substr($baris[NIM],4,2);
										$row_color = ($row_count % 2) ? $color1 : $color2;
										echo "<table width='630' bgcolor=".$row_color.">";
										echo "<tr>
													<td width='200'><img src='images/point.gif'>&nbsp;&nbsp;NIM  : &nbsp;<a style='color:#990000; font-weight:bold; '>$baris[NIM]</a></td>
													<td width='400'>&nbsp;&nbsp;Password Mahasiswa : &nbsp;<a style='color:#990000; font-weight:bold; '>$baris[pw]</a></td>
													<td width=30'><a href='admin-spota.php?part=pasmhs&&angkt=$anganeh&&nim=$baris[NIM]'><img src='images/ico_edit.gif' title='Edit Data'></a></td>
											 </tr>";	
							 			$row_count++;
										echo "</table>";
									}
									
			   			?> 
						</ul>	   
					</li>
				</ul>	
				</div>
		<?php
		}
		?>		
</div>	
</body>
</html>
