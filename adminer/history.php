<?php include "../sambung.inc.php";?>
<head>
<title>..::[SPOTA Prodi Teknik Informatika]::..</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body bgcolor="#103779">
<div style=" background-color:#103779; font-family:verdana; font-size:10px; font-weight:normal; color:#CCCCCC;">
<?php
	$sql = "SELECT * FROM chatter ORDER BY id_chat ASC";
	$laksana =  mysql_query($sql);
	while ($baris =  mysql_fetch_array($laksana))
	{
		//$sqlchat = "SELECT chat_name FROM online_user WHERE online_id='$baris[id]'";
		//$querychat = mysql_query($sqlchat);
		//$resultchat = mysql_fetch_array($querychat);
		if (substr($baris['nama'],0,1)=="D")
			{
				$sqlchat = "SELECT nama_mhs FROM data_mahasiswa WHERE NIM='$baris[nama]'";
				$querychat = mysql_query($sqlchat);
				$resultchat = mysql_fetch_array($querychat);
				$logname = $resultchat['nama_mhs'];				
			}
			else if (substr($baris['nama'],0,1)=="1")
			{
				$sqlchat = "SELECT nama_dosen FROM data_dosen WHERE NIP='$baris[nama]'";
				$querychat = mysql_query($sqlchat);
				$resultchat = mysql_fetch_array($querychat);
				$logname = $resultchat['nama_dosen'];				
			}
			else
			{
				$logname = $baris['nama'];
			}			
		echo "[$baris[waktu]]&nbsp;<font color='#CCFF00'>$logname</font>&nbsp; : $baris[chitchat]<br>";
	}
?>
</div>
</body>
