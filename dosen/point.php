<?php
include "../sambung.inc.php";
include "converttanggal.php";
session_start();
$initid=$_SESSION['nipdos'];
  if (!isset($initid))
  {
	header("Location: index.php");
  }
  include "cekonline.php";
  $ubah1 = mysql_query("DELETE FROM chatter WHERE (UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(waktu)) > 10800");  
?>
<?php
$chat = strip_tags($_GET['msg']);
$chat = trim($chat);
$all= $_GET['all'];
$id=$_GET['id'];
$nama=$_GET['nama'];
$waktu=date("Y-m-d H:i:s");
if (isset($_GET['msg']))
{
if ($chat!=NULL or $chat!='%')
{
	$query = mysql_query("INSERT INTO chatter(id, nama, waktu, chitchat) values ('$id', '$nama', '$waktu', '$chat')");
}
else
{
	$query = "";
}
}

if (isset($_GET['all']))
{
echo "<div id='online'>";
echo "<u>Online User</u><br><br>";
	$sql2 = "SELECT id FROM online_user WHERE sta='1'";
	$do = mysql_query($sql2);
	while ($row = mysql_fetch_array($do))
	{	
		
			if (substr($row['id'],0,1)=="D")
			{
				$sqlname = "SELECT nama_mhs FROM data_mahasiswa WHERE NIM='$row[id]'";
				$querysql = mysql_query($sqlname);
				$result = mysql_fetch_array($querysql);
				$log = $result['nama_mhs'];				
			}
			else if (substr($row['id'],0,1)=="1")
			{
				$sqlname = "SELECT nama_dosen FROM data_dosen WHERE NIP='$row[id]'";
				$querysql = mysql_query($sqlname);
				$result = mysql_fetch_array($querysql);
				$log = $result['nama_dosen'];				
			}
			else
			{
				$log = $row['id'];
			}	
	echo "&nbsp;<b>$log</b><br>";
	}
	echo "</div>";	
	//echo "<div id='hasil'>";
	$sql = "SELECT id_chat, id, nama, TIME_FORMAT(waktu,'%T') AS 'wkt', chitchat FROM (SELECT * FROM chatter ORDER BY id_chat DESC LIMIT 0,31) AS P ORDER BY waktu ASC";
	$laksana =  mysql_query($sql);
	while ($baris =  mysql_fetch_array($laksana))
	{
		//$sqlchat = "SELECT chat_name FROM online_user WHERE online_id='$baris[id]'";
		//$querychat = mysql_query($sqlchat);
		//$resultchat = mysql_fetch_array($querychat);
		if (substr($baris['id'],0,1)=="D")
			{
				$sqlchat = "SELECT nama_mhs FROM data_mahasiswa WHERE NIM='$baris[id]'";
				$querychat = mysql_query($sqlchat);
				$resultchat = mysql_fetch_array($querychat);
				$logname = $resultchat['nama_mhs'];				
			}
			else if (substr($baris['id'],0,1)=="1")
			{
				$sqlchat = "SELECT nama_dosen FROM data_dosen WHERE NIP='$baris[id]'";
				$querychat = mysql_query($sqlchat);
				$resultchat = mysql_fetch_array($querychat);
				$logname = $resultchat['nama_dosen'];				
			}
			else
			{
				$logname = $baris['id'];
			}	
		echo "&nbsp;[$baris[wkt]]&nbsp;<font color='#9BD411'>$logname</font>&nbsp; : $baris[chitchat]<br>";
	}
}

?>
