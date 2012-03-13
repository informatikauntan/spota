<?php
include "../sambung.inc.php";
session_start();
  if (!isset($_SESSION['user_nama']))
  {
  header("Location: index.php");
  }
  
include "cekonline.php";?>
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
  <div id="conthaldatdos">
    <ul>
    <li>
    <h2><u>Data Dosen</u></h2>
      <ul>
        <?php
          $query="SELECT NIP, nama_dosen FROM data_dosen ORDER BY NIP";
          $hasil_query=mysql_query($query);
          $color1 = "#e5e5e5";
          $color2 = "#FFFFFF";
              while ($baris=mysql_fetch_array($hasil_query))
            {
            $row_color = ($row_count % 2) ? $color1 : $color2;
            echo "<table width='630' bgcolor=".$row_color.">";
            echo "<tr>
              <td width='200'><img src='images/point.gif'>&nbsp;&nbsp;<a>NIP Dosen : &nbsp;</a>$baris[NIP]</td>
              <td width='350'>&nbsp;&nbsp;<a>Nama Dosen : &nbsp;</a>$baris[nama_dosen]</td>
              <td width='40'><a href='admin-spota.php?part=setdatdos&&action=edit&&nip=$baris[NIP]'><img src='images/ico_edit.gif' title='Edit Data'></a></td>
              <td width='40'><a href='admin-spota.php?part=setdatdos' onClick=Showmes('hapusdosen.php?nip=$baris[NIP]')><img src='images/ico_delete.gif' title='Hapus Data'></a></td>
               </tr>";
               $row_count++;
            echo "</table>";
            }
         ?>
      </ul>
    </li>
    </ul>

  </div>
  <div id="sidehaldatdos">
    <ul>
    <li>
    <form method="post" action="admin-spota.php?part=setdatdos">
    <h2><u>Input Data Dosen</u></h2>
        <ul>
          <li>
          <table width="330" border="0">
            <tr>
              <td width="80">NIP</td>
            <td><input type="text" size="15" maxlength="9" name="NIP" class="biasa"></td>
            </tr>
            <tr>
                <td width="80">Nama Dosen </td>
            <td><input type="text" size="35" maxlength="60" name="nama_dosen" class="biasa"></td>
            </tr>
            <tr>
              <td width="80">Email</td>
            <td><input type="text" size="25" maxlength="50" name="email_dosen" class="biasa"></td>
            </tr>
           </table>
          </li>
            <li>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="tambah" value="Input Data Dosen" class="spesial"><input type="Reset" name="Cancel" value="Cancel Data Dosen" class="spesial"></li>
        </ul>
    </form>
    </li>
  <?php
    $behav = $_GET['action'];
    $NIPedit = $_GET['nip'];
    $query= "SELECT * FROM data_dosen WHERE NIP='$NIPedit'";
      $hasil_panggil = mysql_query($query);
      $baris = mysql_fetch_array($hasil_panggil);
    if ($behav == 'edit')
    {
  ?>
    <li>
    <form method="post" action="admin-spota.php?part=setdatdos">
    <h2><u>Edit Data Dosen</u></h2>
        <ul>
          <li>
          <table width="330" border="0">
            <tr>
              <td width="80">NIP</td>
            <td><input type="hidden" size="15" maxlength="9" name="NIPedit" class="biasa" value="<?php echo "$baris[NIP]" ?>"><?php echo "$baris[NIP]" ?></td>
            <tr>
                <td width="80">Nama Dosen </td>
            <td><input type="text" size="35" maxlength="60" name="nama_dosen_edit" class="biasa" value="<?php echo "$baris[nama_dosen]" ?>"></td>
            </tr>
            <tr>
              <td width="80">Email</td>
            <td><input type="text" size="25" maxlength="50" name="email_dosen_edit" class="biasa" value="<?php echo "$baris[email]" ?>"></td>
            </tr>
           </table>
          </li>
            <li>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="editpost" value="Ubah Data Dosen" class="spesial">&nbsp;&nbsp;&nbsp;&nbsp;<a href="admin-spota.php?part=setdatdos">[Close Box]</a></li>
        </ul>
    </form>
    </li>
  <?php
    }
  ?>
    </ul>
  </div>
  <?php
    if (isset($_POST['tambah']))
    {
      $NIPinsert = $_POST['NIP'];
      $namados   = $_POST['nama_dosen'];
      $emaildos  = $_POST['email_dosen'];
      $check = "SELECT NIP,nama_dosen,email FROM data_dosen where NIP='$NIPinsert' or nama_dosen='$namados' or email='$emaildos'";
        $hasil_check= mysql_query($check);
        if (mysql_num_rows($hasil_check) != 0)
        {
  ?>
          <script type="text/javascript">alert("<?php echo $NIPinsert ?> dengan Nama : <?php echo $namados ?> dan E-mail : <?php echo $emaildos ?> sudah ada!!!")</script>
            <meta http-equiv="refresh" content="1;URL=admin-spota.php?part=setdatdos">

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
            $nama = strtoupper($namados);
			$now=date("Y-m-d H:i:s");
			$ip=$_SERVER['REMOTE_ADDR'];
            $query = "INSERT INTO data_dosen(NIP, nama_dosen, email) values ('$NIPinsert','$nama','$emaildos')";
            $query1 = "INSERT INTO log_dos(NIP, pw, pwdosen) values ('$NIPinsert','$rand',md5('$rand'))";
			$query2 = "INSERT INTO online_user(id,ip,tm,sta) values ('$NIPinsert','$ip','$now','0')";
			
            if (!empty($NIPinsert) and !empty($namados) and  valemail($emaildos))
            {
              $kirim = mysql_query($query);
              $kirim1 = mysql_query($query1);
			  $kirim2 = mysql_query($query2);
              if ($kirim)
              {
  ?>
              <script type="text/javascript">alert("Data Dosen Berhasil Dimasukkan")</script>
                <meta http-equiv="refresh" content="1;URL=admin-spota.php?part=setdatdos">
  <?php
              }
            }
            else
            {
  ?>
              <script type="text/javascript">alert("Data Dosen Tidak Lengkap ataupun Email Tidak Valid")</script>
                <meta http-equiv="refresh" content="1;URL=admin-spota.php?part=setdatdos">
  <?php
            }
        }
    }

    if (isset($_POST['editpost']))
    {
      $NIPedit = $_POST['NIPedit'];
      $namados   = $_POST['nama_dosen_edit'];
      $emaildos  = $_POST['email_dosen_edit'];
      function valemail($str)
        {
          return (ereg('^[^@]+@([a-z\-]+\.)+[a-z]{2,4}$',$str));
        }

      $nama = strtoupper($namados);
      $query = "UPDATE data_dosen SET nama_dosen= '$nama', email='$emaildos' where NIP='$NIPedit'";
      if (!empty($namados) and  valemail($emaildos))
      {
      $kirim = mysql_query($query);
      if ($kirim)
      {
  ?>
          <script type="text/javascript">alert("Data Dosen Berhasil Diubah")</script>
          <meta http-equiv="refresh" content="1;URL=admin-spota.php?part=setdatdos&&action=edit&&nip=<?php echo "$NIPedit";?>">
  <?php
      }
      }
      else
      {
  ?>
          <script type="text/javascript">alert("Data Dosen Tidak Lengkap ataupun Email Tidak Valid")</script>
          <meta http-equiv="refresh" content="1;URL=admin-spota.php?part=setdatdos&&action=edit&&nip=<?php echo "$NIPedit";?>">
  <?php
      }

    }

  ?>
</div>

</body>
</html>