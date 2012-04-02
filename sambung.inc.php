<?php
###################################
#                                 #
#         File index.php          #
#                                 #
###################################

$hostname = "localhost";
$hostuser = "root";
$hostpass = "";
$databasen = "spota";

$connect = mysql_connect($hostname,$hostuser,$hostpass);
mysql_select_db($databasen,$connect) or die('Koneksi gagal');


?>