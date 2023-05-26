<html>
<head>
<title>Adi Muhamad Firmansyah - 11210102</title>
</head>
<body>
<?php
//nama file : tampil_data01.php
include"koneksi.php";

if(ISSET($_POST['ubah'])){
    $kode = $_GET['id'];
    $nilaii = $_POST['nilai'];
    $q = mysqli_query($conn, "update nilai set nilai='$nilaii' where id='$kode'");
}

if(ISSET($_POST['tombol'])){
	$nim = $_POST['cari'];
	$q = mysqli_query($conn, "select nilai.*, m_mahasiswa.nm_mhs,m_matakuliah.nama_mk from nilai inner join m_mahasiswa on nilai.nim=m_mahasiswa.nim inner join m_matakuliah on nilai.kode_mk=m_matakuliah.kode_mk where (nilai.nim='$nim' or m_mahasiswa.nm_mhs like'%$nim%' or m_matakuliah.nama_mk like'%$nim%') order by nilai.nim asc");
} else {
	$q = mysqli_query($conn, "select nilai.*, m_mahasiswa.nm_mhs,m_matakuliah.nama_mk from nilai inner join m_mahasiswa on nilai.nim=m_mahasiswa.nim inner join m_matakuliah on nilai.kode_mk=m_matakuliah.kode_mk order by nilai.nim asc");
}
$no = 0;

echo"<table width='60%' border='1' align='center'>";
echo"<form method='POST' action=''>";
echo"<tr><td colspan='2'>Pencarian</td><td colspan='7'><input type='text' name='cari' size='15'><input type='submit' name='tombol' value='CARI'></td></tr>";  //proses pencarian data berjalan dengan benar
echo"</form>";
echo"<tr><th>NO</th><th>NPM</th><th>NAMA</th><th>KODE MK</th><th>NAMA MK</th><th>NILAI</th><th>THN AKADEMIK</th><th colspan='2'>AKSI</th></tr>";
while($r = mysqli_fetch_array($q)){
	$no = $no + 1;
	echo"<tr><td>$no</td><td>$r[nim]</td><td>$r[nm_mhs]</td><td>$r[kode_mk]</td><td>$r[nama_mk]</td><td>$r[nilai]</td><td>$r[thn_akademik]</td><td><a href='" . $_SERVER['PHP_SELF'] . "?id=$r[id]'><img src='images/edit.png' width='16' height='16' /></a></td><td><a href='" . $_SERVER['PHP_SELF'] . "?id=$r[id]'><img src='images/delete.png' width='16' height='16' /></a></td></tr>";
}
echo"</table>";

echo"<br />";
echo"<br />";

echo"<table width='60%' border='1' align='center'>";
echo"<tr><td>1.1</td><td>1.1</td></td>";
echo"<tr><td>1.1</td><td>1.1</td></td>";
echo"<tr><td>1.1</td><td>1.1</td></td>";
echo"<tr><td>1.1</td><td>1.1</td></td>";
echo"<tr><td>1.1</td><td>1.1</td></td>";
echo"</table>";

if(isset($_GET['id'])) {
    $data = $_GET['id'];
    $q6 = mysqli_query($conn, "SELECT * FROM nilai WHERE id=$data");
    $m = mysqlI_fetch_assoc($q6);

    echo "
        <div style='margin-top: 2rem; display: flex; justify-content: center;'>
            <form method='POST' action=''>
                <input type='text' name='nim' value='$m[nim]' class='readonly' readonly></input>
                <input type='text' name='kode_mk' value='$m[kode_mk]' class='readonly' readonly></input>
                <input type='text' name='nilai' value='$m[nilai]' size='1' maxlength='1'></input>
                <input type='text' name='thn_akademik' value='$m[thn_akademik]' class='readonly' readonly></input>
                <input type='submit' value='OK' name='ubah'></input>
            </form>
        </div>
    ";
}
?>
</body>
</html>