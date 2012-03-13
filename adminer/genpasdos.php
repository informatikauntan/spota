<?php 
include "../sambung.inc.php";
session_start();
  if (!isset($_SESSION['user_nama']))
  {
	header("Location: index.php");
  }

include "cekonline.php";  
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
		<form method="post" action="admin-spota.php?part=pasdos" name="formnip">	
		<h2><u>Cari Password Dosen</u></h2>	
			<ul>	
				<table width="330" border="0">
					<tr>
    				<td>Pilih NIP</td>
    				<td><select name="NIP" onChange="document.formnip.submit()">
							<option value="0"> - - NIP - -</option>
							<?php
							$check = "SELECT NIP FROM log_dos";
							$hasil_check=mysql_query($check);
							while ($nipcheck=mysql_fetch_array($hasil_check))
							{				
								if ($_POST['NIP']==$nipcheck[NIP])
								{					
									echo "<option value='$nipcheck[NIP]' selected>$nipcheck[NIP] </option>";
								}
							else
								{
								echo "<option value='$nipcheck[NIP]'>$nipcheck[NIP] </option>";
								}				
							}
							?>									
						</select>
				
							<?php
								$nippost = $_POST['NIP'];
								if (isset($nippost) && $nippost!=0)
								{
									$show = "SELECT pw FROM log_dos WHERE NIP='$nippost'";
									$do = mysql_query($show);
									$result = mysql_fetch_assoc($do);				
								}
							?>
					&nbsp;&nbsp;<a href="admin-spota.php?part=pasdos&&action=all">[Show All]</a></td>
  				</tr>
  				<tr>
    			<td>Password</td>
    			<td style="color:#990000; font-weight:bold; "><?php echo $result[pw]?></td>
  				</tr>
				</table>			
			</ul>
		</form>
		</li>
		
			<?php
			$NIPedit = $_GET['nippas'];
			if (isset($NIPedit))
			{
				$query= "SELECT * FROM log_dos WHERE NIP='$NIPedit'";
				$hasil_panggil = mysql_query($query);
				$baris = mysql_fetch_assoc($hasil_panggil);
			
			?>
		<li>
			<form method="post" action="admin-spota.php?part=pasdos&&action=all&&nippas=<?php echo $NIPedit?>">
				<h2><u>Edit Data Dosen</u></h2>	
				<ul>
					<li>	  
					<table width="330" border="0">
  					<tr>
    					<td width="80">NIP</td>
						<td><input type="hidden" size="15" maxlength="9" name="NIPin" class="biasa" value="<?php echo "$baris[NIP]" ?>"><?php echo "$baris[NIP]" ?></td>
  					<tr>
   			 			<td width="80">Nama Dosen </td>
						<td><input type="text" size="35" maxlength="15" name="pwdosen" value="<?php echo "$baris[pw]" ?>"> <br>/*Batas input password 15 karakter*/ </td>
  					</tr>
	 				</table> 
					</li>
				  	<li>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="editpass" value="Ubah Password Dosen" class="spesial">&nbsp;&nbsp;&nbsp;&nbsp;<a href="admin-spota.php?part=pasdos&&action=all">[Close Box]</a></li>
				</ul>
			</form>	
		</li>		
		<?php
		}
		if (isset($_POST['editpass']))
		{
			$pass = $_POST['pwdosen'];
			$nip = $_POST['NIPin'];
				$query="UPDATE log_dos set pw='".$pass."', pwdosen='".md5($pass)."' WHERE NIP = '".$nip."'";
				$hasil_query = mysql_query($query);	
				if (!empty($pass))
				{
		?>
					<script type="text/javascript">alert("Password Dosen Berhasil Diubah")</script>
					<meta http-equiv="refresh" content="0;URL=admin-spota.php?part=pasdos&&action=all&&nippas=<?php echo "$nip";?>">
		<?php			
				}
				else
				{
		?>
					<script type="text/javascript">alert("Password Dosen Kosong")</script>
					<meta http-equiv="refresh" content="1;URL=admin-spota.php?part=setdatdos&&action=all&&nippas=<?php echo "$nip";?>">
		<?php	
				}	
		}
		?>
		</ul>
	</div>	
	<?php
	$all = $_GET['action'];
	if ($all=='all')
	{
	?>	
	<div id="dafpassdos">
		<ul>	
		<li>		
		<h2><u>Daftar Password Dosen</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="admin-spota.php?part=pasdos">[Close Box]</a></h2>	
			<ul>	
			<?php
			$query = "SELECT * FROM log_dos";
			$hasil_query=mysql_query($query);
			$color1 = "#e5e5e5";
			$color2 = "#FFFFFF";	
			
			while ($baris=mysql_fetch_array($hasil_query))
			{
			$row_color = ($row_count % 2) ? $color1 : $color2;
			echo "<table width='630' bgcolor=".$row_color.">";
				echo "<tr>
						<td width='200'><img src='images/point.gif'>&nbsp;NIP Dosen : &nbsp;<a style='color:#990000; font-weight:bold; '>$baris[NIP]</a></td>
						<td width='350'>&nbsp;Password Dosen : &nbsp;<a style='color:#990000; font-weight:bold; '>$baris[pw]</a></td>
						<td width='80'>&nbsp;&nbsp;<a href='admin-spota.php?part=pasdos&&action=all&&nippas=$baris[NIP]'><img src='images/ico_edit.gif' title='Edit Password'></a></td>
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
