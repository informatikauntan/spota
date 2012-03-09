<?php
function tgli($tgl)
{
		  $tanggal=substr($tgl,8,2);
		  $bulan=substr($tgl,5,2);
		  $tahun=substr($tgl,0,4);
		  return $tanggal.'-'.$bulan.'-'.$tahun;
}

function nama($nim)
{
	$query = mysql_query("SELECT nama_mhs FROM data_mahasiswa WHERE NIM='$nim'");
	$hasil = mysql_fetch_array($query);
	return $hasil['nama_mhs'];
}

?>