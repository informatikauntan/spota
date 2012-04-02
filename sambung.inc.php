<?php
#########################################
#                                       #
#      File sambung.inc.php             #
#   Sekalian ganti host buat localhost  #
#       tanpa password (standar)        #
#                                       #
#########################################

$hostname = "localhost";
$hostuser = "root";
$hostpass = "";
$databasen = "spota";

$connect = mysql_connect($hostname,$hostuser,$hostpass);
mysql_select_db($databasen,$connect) or die('Koneksi gagal');


?>