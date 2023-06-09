<?php 
  include "koneksi.php";

  if ($_POST['tombol_simpan']) {
    $nim = $_POST['nim'];
    $nilai = $_POST['nilai'];
    $kode_mk = $_POST['kode_mk'];
    $thn_akademik = $_POST['thn_akademik'];

    mysqli_query($conn, "INSERT INTO nilai (nim, kode_mk, nilai, thn_akademik) VALUES($nim, '$kode_mk', '$nilai', '$thn_akademik')");
  }
?>