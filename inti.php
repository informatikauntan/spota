<?php
include "sambung.inc.php";
session_start();
 /* if (!isset($_SESSION['kapro']))
  {
	header("Location: index.php");
  }
*/
$task=$_GET['task'];

$sem=$_GET['sem'];

if ($task=="tsemang")
{
	if($sem=="carilain")
	{
	sleep(1);
	echo "
	<select name='semester'>
	<option value=''>--Pilih Semester--</option>
	<option value='GAZAL'>GAZAL</option>
	<option value='GENAP'>GENAP</option>
	</select>";
	
	$sqlcar=mysql_query("SELECT ang FROM tahun_ang");
	echo 
	"
	<select name='tahun'>
	<option value=''>--Pilih Tahun Akademik--</option>";
	while ($hasilcar=mysql_fetch_array($sqlcar))
	{
	echo "<option value='$hasilcar[ang]'>$hasilcar[ang]</option>";
	}
	
	echo "
	</select>
	";
	}
	else
	{
	sleep(1);
	echo "<input type='text' name='key' size='50'>";
	}
}
?>
