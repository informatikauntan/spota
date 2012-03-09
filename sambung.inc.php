<?php
$hostname = "localhost";
$hostuser = "root";
$hostpass = "root";
$databasen = "spota";

$connect = mysql_connect($hostname,$hostuser,$hostpass);
mysql_select_db($databasen,$connect) or die('Koneksi gagal');


?>