<html>
<head>
<title>Adi Muhamad Firmansyah - 11210102</title>
</head>
<body>
<?php
//nama file : tampil_data01.php
include"koneksi.php";
if(ISSET($_POST['ubah'])){
	$data = $_GET['id'];
	$nilai = $_POST['nilai'];
  $a1 = $_POST['nim'];
  $thnAkademik = $_POST['thn_akademik'];
	//echo"Test $data dan $nilai";
	$q_ubah = mysqli_query($conn,"UPDATE nilai set nilai='$nilai', nim='$a1', thn_akademik='$thnAkademik' where id=$data");

}
if(ISSET($_POST['tombol'])){
	$nim = $_POST['cari'];
	$q = mysqli_query($conn, "select nilai.*, m_mahasiswa.nm_mhs,m_matakuliah.nama_mk from nilai inner join m_mahasiswa on nilai.nim=m_mahasiswa.nim inner join m_matakuliah on nilai.kode_mk=m_matakuliah.kode_mk where (nilai.nim='$nim' or m_mahasiswa.nm_mhs like'%$nim%' or m_matakuliah.nama_mk like'%$nim%') order by nilai.nim desc");
} else {
	$q = mysqli_query($conn, "select nilai.*, m_mahasiswa.nm_mhs,m_matakuliah.nama_mk from nilai inner join m_mahasiswa on nilai.nim=m_mahasiswa.nim inner join m_matakuliah on nilai.kode_mk=m_matakuliah.kode_mk order by nilai.nim desc");
}
$no = 0;

echo"<table width='60%' border='1' align='center'>";
echo"<form method='POST' action=''>";
echo"<tr><td colspan='2'>Pencarian</td><td colspan='7'><input type='text' name='cari' size='15'><input type='submit' name='tombol' value='CARI'></td></tr>";  //proses pencarian data berjalan dengan benar
echo"</form>";
echo"<tr><th>NO</th><th>NPM</th><th>NAMA</th><th>KODE MK</th><th>NAMA MK</th><th>NILAI</th><th>THN AKADEMIK</th><th colspan='2'>AKSI</th></tr>";
while($r = mysqli_fetch_array($q)){
	$no = $no + 1;
	echo"<tr><td>$no</td><td>$r[nim]</td><td>$r[nm_mhs]</td><td>$r[kode_mk]</td><td>$r[nama_mk]</td><td>$r[nilai]</td><td>$r[thn_akademik]</td><td><img src='images/delete.png' width='16' height='16'></td><td> <a href='".$_SERVER['PHP_SELF']."?id=$r[id]'><img src='images/edit.png' width='16' height='16'></a></td></tr>";
}
echo"</table>";

if(ISSET($_GET['id'])){
	$data = $_GET['id'];
	//echo"testing $data";
	$q_nilai = mysqli_query($conn, "select a.*, b.nm_mhs, c.nama_mk from nilai a inner join m_mahasiswa b on a.nim=b.nim inner join m_matakuliah c on a.kode_mk=c.kode_mk where a.id=$data");
	$m = mysqli_fetch_assoc($q_nilai);
  echo"<br />";
  echo"<form method='POST' action=''>";
  echo"<table width='40%' border='1' align='center'>";
  echo"<tr><td colspan='2' style='text-align: center;'>UBAH DATA</td></tr>";
  echo"<tr><td>NIM</td><td>:";

  // echo"<input type='text' name='nim' size='6' value='$m[nim]'>";
  $q_mhs = mysqli_query($conn, "select * from m_mahasiswa where nim <> $m[nim]");
  echo"<select name='nim'>";
  echo"<option value='$m[nim]'>$m[nim] - $m[nm_mhs]</option>";
  while($r2 = mysqli_fetch_array($q_mhs)){
    echo"<option value='$r2[nim]'>$r2[nim] - $r2[nm_mhs]</option>";
  }
  echo"</ select>";
  
  echo"</td></tr>";
  // echo"<tr><td>
  // KODE MK</td><td>: <input type='text' name='kode_mk' value='$m[kode_mk]' size='6'>
  // </td></tr>";
  
  echo"<tr><td>Mata Kuliah</td><td>";
  $q_mk = mysqli_query($conn, "select * from m_matakuliah where kode_mk <> '$m[kode_mk]'");
  echo"<select name='kode_mk'>";
  echo"<option value='$m[kode_mk]'>$m[kode_mk] - $m[nama_mk]</option>";
  while($r3 = mysqli_fetch_array($q_mk)){
    echo"<option value='$r3[kode_mk]'>$r3[kode_mk] - $r3[nama_mk]</option>";
  }
  echo"</ select>";
  echo"</td></tr>";
  
  echo"<tr><td>NILAI</td><td>: <input type='text' name='nilai' value='$m[nilai]' size='1' required></td></tr>";
  echo"<tr><td>TAHUN AKADEMIK</td><td>: <input type='text' name='thn_akademik' value='$m[thn_akademik]' size='10'></td></tr>";
  echo"<tr><td colspan='2'><input type='submit' name='ubah' value='OK'></td></td>";
  echo"</table>";
  echo"</form>";
}

?>
</body>
</html>