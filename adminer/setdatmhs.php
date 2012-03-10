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
<script language="JavaScript">
function Showmes(idurl)
{
  go_on = confirm("Anda yakin untuk hapus data?");
  if (go_on)
  {
    document.location.href=idurl;
  }
}
</script>
</head>

<body>
<div id="haldatdos">
	<div id="genpasdos">
		<ul>	
		<li>		
			<form method="post" action="admin-spota.php?part=setdatmhs">
			<h2><u>Input Data Mahasiswa</u></h2>	
				<ul>
					<li>	  
					<table width="330" border="0">
  					<tr>
    					<td width="80">NIM</td>
						<td><input type="text" size="15" maxlength="9" name="NIM" class="biasa"></td>
  					</tr>
  					<tr>
   			 			<td width="80">Nama Mahasiswa</td>
						<td><input type="text" size="35" maxlength="60" name="nama_mhs" class="biasa"></td>
  					</tr>
  					<tr>
    					<td width="80">Email</td>
						<td><input type="text" size="25" maxlength="50" name="email_mhs" class="biasa"></td>
  					</tr>					
	 				</table> 
					</li>
				  	<li>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="tambah" value="Input Data Mahasiswa" class="spesial"> &nbsp;&nbsp;<input type="Reset" name="Cancel" value="Cancel Data Mahasiswa" class="spesial"></li>
				</ul>
			</form>
		</li>
		<li>
			<form name="ang" method="post" action="admin-spota.php?part=setdatmhs">
			<h2><u>Pencarian Data Mahasiswa</u></h2>	
				<ul>
					<li>	
						<table width="330" border="0">
  							<tr>
    							<td width="80">Angkatan</td>
    							<td><select name="angkatan" onChange="document.ang.submit()">
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
						</td>
 							</tr>
						</table>
						
					</li>
				</ul>
				</form>
			</li>
			<?php
					$NIMedit = $_GET['nim'];
					$query= "SELECT * FROM data_mahasiswa WHERE NIM='$NIMedit'";
						$hasil_panggil = mysql_query($query);
						$row = mysql_fetch_array($hasil_panggil);
						if ($NIMedit!='')
						{		
			?>
			<li>
			<form method="post" action="admin-spota.php?part=setdatmhs">
				<h2><u>Edit Data Mahasiswa</u></h2>	
				<ul>
					<li>	  
					<table width="330" border="0">
  					<tr>
    					<td width="80">NIM</td>
						<td><input type="hidden" size="15" maxlength="9" name="NIMedit" class="biasa" value="<?php echo "$row[NIM]" ?>"><?php echo "$row[NIM]" ?></td>
  					<tr>
   			 			<td width="80">Nama Mahasiswa </td>
						<td><input type="text" size="35" maxlength="60" name="nama_mhs_edit" class="biasa" value="<?php echo "$row[nama_mhs]" ?>"></td>
  					</tr>
  					<tr>
    					<td width="80">Email</td>
						<td><input type="text" size="25" maxlength="50" name="email_mhs_edit" class="biasa" value="<?php echo "$row[email]" ?>"></td>
  					</tr>					
	 				</table> 
					</li>
				  	<li>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="editpost" value="Ubah Data Mahasiswa" class="spesial"></li>
				</ul>
			</form>
			</li>
			<?php
			}
			?>
		</ul>
	</div>	
	<?php
		$angk = $_POST['angkatan']; 
		if (isset($angk) && $angk!=0 || $_GET['angkt']!='')
			{
	?>
				<div id="dafpassdos">
				<ul>
					<li>		
						<h2><u>Data Mahasiswa</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="admin-spota.php?part=setdatmhs">[Close Box]</a></h2>	
						<ul>			
						<?php
							$query="SELECT NIM, nama_mhs FROM data_mahasiswa WHERE angkatan='$angk' OR angkatan='$_GET[angkt]' ORDER BY NIM";
							$hasil_query=mysql_query($query);
							$color1 = "#e5e5e5";
							$color2 = "#FFFFFF";	
  								while ($baris=mysql_fetch_array($hasil_query))
									{
										$anganeh = substr($baris[NIM],4,2);
										$row_color = ($row_count % 2) ? $color1 : $color2;
										echo "<table width='630' bgcolor=".$row_color.">";
										echo "<tr>
													<td width='150'><img src='images/point.gif'>&nbsp;&nbsp;NIM  : &nbsp;$baris[NIM]</td>
													<td width='400'>&nbsp;&nbsp;Nama Mahasiswa : &nbsp;$baris[nama_mhs]</td>
													<td width='40'><a href='admin-spota.php?part=setdatmhs&&angkt=$anganeh&&nim=$baris[NIM]'><img src='images/ico_edit.gif' title='Edit Data'></a></td>
													<td width='40'><a href='admin-spota.php?part=setdatmhs' onClick=Showmes('hapusmhs.php?nim=$baris[NIM]')><img src='images/ico_delete.gif' title='Hapus Data'></a></td>
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
	
	
	<?php
		if (isset($_POST['tambah']))
		{
			$NIMinsert = strtoupper($_POST['NIM']);
			function ceknim($cek)
			{
				$regex = "/^D031(\d{5})$/";
				return(preg_match($regex,$cek));			
			}
			$namamhs   = $_POST['nama_mhs'];
			$email  = $_POST['email_mhs'];
			$check = "SELECT NIM,nama_mhs,email FROM data_mahasiswa where NIM='$NIMinsert' or nama_mhs='$namamhs' or email='$email'";
				$hasil_check= mysql_query($check);
				if (mysql_num_rows($hasil_check) != 0 or (!ceknim($NIMinsert)))
				{  
	?>
					<script type="text/javascript">alert("<?php echo $NIMinsert ?> dengan Nama : <?php echo $namamhs ?> dan E-mail : <?php echo $email ?> sudah ada atau format NIM salah!!!")</script>
  					<meta http-equiv="refresh" content="1;URL=admin-spota.php?part=setdatmhs">
					
	<?php
				}
				else
				{	
					function valemail($str)
					{
						return (ereg('^[^@]+@([a-z\-]+\.)+[a-z]{2,4}$',$str));
					}
						$str= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
						$rand = substr(str_shuffle(md5($str)),0,6);
						$nama = strtoupper($namamhs);
						$angkatan=substr($NIMinsert,4,2);
						$now=date("Y-m-d H:i:s");
						$ip=$_SERVER['REMOTE_ADDR'];
						$query = "INSERT INTO data_mahasiswa(NIM, nama_mhs, angkatan, email) values ('$NIMinsert','$nama','$angkatan','$email')";
						$query1 = "INSERT INTO log_mhs(NIM, pw ,pwmhs) values ('$NIMinsert','$rand',md5('$rand'))";
						$query2 = "INSERT INTO online_user(id,ip,tm,sta) values ('$NIMinsert','$ip','$now','0')";
						if (!empty($NIMinsert) and !empty($namamhs) and  valemail($email))
						{
							$kirim = mysql_query($query);
							$kirim1 = mysql_query($query1);
							$kirim2 = mysql_query($query2);
							if ($kirim)
							{
	?>					
							<script type="text/javascript">alert("Data Mahasiswa Berhasil Dimasukkan")</script>
  							<meta http-equiv="refresh" content="1;URL=admin-spota.php?part=setdatmhs">
	<?php					
							}
						}
						else
						{	
	?>
							<script type="text/javascript">alert("Data Mahasiswa Tidak Lengkap ataupun Email Tidak Valid")</script>
  							<meta http-equiv="refresh" content="1;URL=admin-spota.php?part=setdatmhs">
	<?php
						}
				}
		}
		
		if (isset($_POST['editpost']))
		{
			$NIMedit = $_POST['NIMedit'];
			$namamhs   = $_POST['nama_mhs_edit'];
			$emailmhs  = $_POST['email_mhs_edit'];
			function valemail($str)
				{
					return (ereg('^[^@]+@([a-z\-]+\.)+[a-z]{2,4}$',$str));
				}
			
			$nama = strtoupper($namamhs);
			$ang = substr($NIMedit,4,2);
			$query = "UPDATE data_mahasiswa SET nama_mhs= '$nama', email='$emailmhs' where NIM='$NIMedit'";
			if (!empty($namamhs) and  valemail($emailmhs))
			{
			$kirim = mysql_query($query);
			if ($kirim)
			{	
	?>		
					<script type="text/javascript">alert("Data Mahasiswa Berhasil Diubah")</script>
					<meta http-equiv="refresh" content="1;URL=admin-spota.php?part=setdatmhs&&angkt=<?php echo $ang;?>&&nim=<?php echo "$NIMedit";?>">
	<?php		
			}
			}
			else
			{
	?>
					<script type="text/javascript">alert("Data Mahasiswa Tidak Lengkap ataupun Email Tidak Valid")</script>
					<meta http-equiv="refresh" content="1;URL=admin-spota.php?part=setdatmhs&&angkt=<?php echo $ang;?>&&nim=<?php echo "$NIMedit";?>">
	<?php
			}
			
		}
		
	?>
	
	
</div>
</body>
</html>
