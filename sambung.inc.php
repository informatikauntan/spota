<?php
$hostname = "localhost";
$hostuser = "root";
$hostpass = "";
$databasen = "neospota";

$connect = mysql_connect($hostname,$hostuser,$hostpass);
mysql_select_db($databasen,$connect) or die('Koneksi gagal');


?>