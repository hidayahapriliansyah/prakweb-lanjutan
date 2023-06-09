<?php

session_start();

if (isset($_POST['login'])) {

  include "koneksi.php";
  $user1 = $_POST['user'];
  $pass1 = $_POST['pass'];
  $q_user = mysqli_query($conn, "SELECT * FROM `m_pengguna` WHERE kode_op='$user1' and pass=SHA1('$pass1');");
  $jml = mysqli_num_rows($q_user);

  if ($jml > 0) {
    $_SESSION['op'] = "ada";
    echo "<meta http-equiv=\"refresh\" content=\"1; url=" . $_SERVER['PHP_SELF'] . "\">";
  } else {
    echo "User dan atau password Salah";
    echo "<meta http-equiv=\"refresh\" content=\"2; url=" . $_SERVER['PHP_SELF'] . "\">";
  }
}

if (isset($_SESSION['op'])) {
?>

  <html>

  <head>
    <title>Adi Muhamad Firmansyah - 11210102</title>
    <script language="javascript">
      function konfirmasi(msg, url) {
        var pesan = confirm(msg);
        if (pesan == true)
          self.location = url;
        else
          return false;
      }
    </script>
  </head>

  <body>
    <?php
    //nama file : tampil_data01.php
    include "koneksi.php";

    if (isset($_POST['tombol_simpan'])) {
      $nim = $_POST['nim'];
      $nilai = $_POST['nilai'];
      $kode_mk = $_POST['kode_mk'];
      $thn_akademik = $_POST['thn_akademik'];

      mysqli_query($conn, "INSERT INTO nilai (nim, kode_mk, nilai, thn_akademik) VALUES($nim, '$kode_mk', '$nilai', '$thn_akademik')");
    }

    if (isset($_GET['aksi'])) {
      if ($_GET['aksi'] === 'hapus') {
        echo "hapus";
        $t2 = $_GET['id'];
        mysqli_query($conn, "DELETE FROM nilai WHERE id=$t2");
      } elseif ($_GET['aksi'] === 'tambah') {
        $qMhs = mysqli_query($conn, "select nim, nm_mhs from m_mahasiswa");
        $qMk = mysqli_query($conn, "select kode_mk, nama_mk from m_matakuliah");
    ?>
        <form method='POST'>
          <table width="40%" border="1" align="center">
            <thead>
              <tr>
                <td colspan="2">
                  <p align="center">TAMBAH DATA</p>
                </td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Mahasiswa</td>
                <td>
                  <select name='nim'>
                    <option>Pilih Mahasiswa</OPTION>
                    <?php
                    while ($r = mysqli_fetch_array($qMhs)) {
                      echo "<option value='$r[nim]'>$r[nim] - $r[nm_mhs]</option>";
                    }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Mata Kuliah</td>
                <td>
                  <select name='kode_mk'>
                    <option>Pilih Mata Kuliah</OPTION>
                    <?php
                    while ($r = mysqli_fetch_array($qMk)) {
                      echo "<option value='$r[kode_mk]'>$r[kode_mk] - $r[nama_mk]</option>";
                    }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Nilai</td>
                <td>
                  <select name="nilai">
                    <option value="-">Pilih Nilai</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                    <option value="T">T</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Tahun Akademik</td>
                <td>
                  <input type='text' name='thn_akademik' size='12' maxlength='9' placeholder='TAHUN AKADEMIK'>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <input type='submit' value='SIMPAN' name='tombol_simpan' style="display: block; margin: auto;">
                </td>
              </tr>
              <tr>
              </tr>
            </tbody>
          </table>
        </form>
    <?php

      }
    }

    if (isset($_POST['ubah'])) {
      $data = $_GET['id'];
      $nilai = $_POST['nilai'];
      $a1 = $_POST['nim'];
      $thnAkademik = $_POST['thn_akademik'];
      $kode_mk = $_POST['kode_mk'];
      //echo"Test $data dan $nilai";
      $q_ubah = mysqli_query($conn, "UPDATE nilai set nilai='$nilai', nim='$a1', thn_akademik='$thnAkademik', kode_mk='$kode_mk' where id=$data");
    }
    if (isset($_POST['tombol'])) {
      $nim = $_POST['cari'];
      $q = mysqli_query($conn, "select nilai.*, m_mahasiswa.nm_mhs,m_matakuliah.nama_mk from nilai inner join m_mahasiswa on nilai.nim=m_mahasiswa.nim inner join m_matakuliah on nilai.kode_mk=m_matakuliah.kode_mk where (nilai.nim='$nim' or m_mahasiswa.nm_mhs like'%$nim%' or m_matakuliah.nama_mk like'%$nim%') order by nilai.id desc");
    } else {
      $q = mysqli_query($conn, "select nilai.*, m_mahasiswa.nm_mhs,m_matakuliah.nama_mk from nilai inner join m_mahasiswa on nilai.nim=m_mahasiswa.nim inner join m_matakuliah on nilai.kode_mk=m_matakuliah.kode_mk order by nilai.id desc");
    }
    $no = 0;

    echo "<table width='60%' border='1' align='center'>";
    echo "<form method='POST' action=''>";
    echo "<tr><td colspan='2'>Pencarian</td><td colspan='7'><input type='text' name='cari' size='15'><input type='submit' name='tombol' value='CARI'>&nbsp;&nbsp;<input type=\"button\" onclick=\"location.href='" . $_SERVER['PHP_SELF'] . "?aksi=tambah';\" value=\"TAMBAH\" />&nbsp;&nbsp;<input type=\"button\" onclick=\"location.href='" . $_SERVER['PHP_SELF'] . "';\" value=\"NORMAL\" />
    
    <input type=\"button\" onclick=\"location.href='logout.php';\" value=\"KELUAR\" />
    
    </td></tr>";  //proses pencarian data berjalan dengan benar
    echo "</form>";
    echo "<tr><th>NO</th><th>NPM</th><th>NAMA</th><th>KODE MK</th><th>NAMA MK</th><th>NILAI</th><th>THN AKADEMIK</th><th colspan='2'>AKSI</th></tr>";
    while ($r = mysqli_fetch_array($q)) {
      $no = $no + 1;
      echo "<tr><td>$no</td><td>$r[nim]</td><td>$r[nm_mhs]</td><td>$r[kode_mk]</td><td>$r[nama_mk]</td><td>$r[nilai]</td><td>$r[thn_akademik]</td><td><a href=# onClick=\"konfirmasi('Menghapus Data ($r[nim]) Ini, Anda Yakin ?','" . $_SERVER['PHP_SELF'] . "?aksi=hapus&id=$r[id]')\"><img src='images/delete.png' width='16' height='16' title='HAPUS'></a></td><td> <a href='" . $_SERVER['PHP_SELF'] . "?aksi=ubah&id=$r[id]'><img src='images/edit.png' width='16' height='16' title='UBAH'></a></td></tr>";
    }
    echo "</table>";

    if (isset($_GET['aksi'])) {
      if ($_GET['aksi'] === 'ubah') {

        $data = $_GET['id'];
        //echo"testing $data";
        $q_nilai = mysqli_query($conn, "select a.*, b.nm_mhs, c.nama_mk from nilai a inner join m_mahasiswa b on a.nim=b.nim inner join m_matakuliah c on a.kode_mk=c.kode_mk where a.id=$data");
        $m = mysqli_fetch_assoc($q_nilai);
        echo "<br />";
        echo "<form method='POST' action=''>";
        echo "<table width='40%' border='1' align='center'>";
        echo "<tr><td colspan='2' style='text-align: center;'>UBAH DATA</td></tr>";
        echo "<tr><td>NIM</td><td>:";

        // echo"<input type='text' name='nim' size='6' value='$m[nim]'>";
        $q_mhs = mysqli_query($conn, "select * from m_mahasiswa where nim <> $m[nim]");
        echo "<select name='nim'>";
        echo "<option value='$m[nim]'>$m[nim] - $m[nm_mhs]</option>";
        while ($r2 = mysqli_fetch_array($q_mhs)) {
          echo "<option value='$r2[nim]'>$r2[nim] - $r2[nm_mhs]</option>";
        }
        echo "</ select>";

        echo "</td></tr>";
        // echo"<tr><td>
        // KODE MK</td><td>: <input type='text' name='kode_mk' value='$m[kode_mk]' size='6'>
        // </td></tr>";

        echo "<tr><td>Mata Kuliah</td><td>";
        $q_mk = mysqli_query($conn, "select * from m_matakuliah where kode_mk <> '$m[kode_mk]'");
        echo "<select name='kode_mk'>";
        echo "<option value='$m[kode_mk]'>$m[kode_mk] - $m[nama_mk]</option>";
        while ($r3 = mysqli_fetch_array($q_mk)) {
          echo "<option value='$r3[kode_mk]'>$r3[kode_mk] - $r3[nama_mk]</option>";
        }
        echo "</ select>";
        echo "</td></tr>";

        echo "<tr><td>NILAI</td><td>: <input type='text' name='nilai' value='$m[nilai]' size='1' required></td></tr>";
        echo "<tr><td>TAHUN AKADEMIK</td><td>: <input type='text' name='thn_akademik' value='$m[thn_akademik]' size='10'></td></tr>";
        echo "<tr><td colspan='2'><input type='submit' name='ubah' value='OK'></td></td>";
        echo "</table>";
        echo "</form>";
      }
    }
    ?>
  </body>

  </html>
<?php
} else {
?>
  <html>

  <head>
    <title>11210102 - Adi Muhamad Firmansyah</title>
    <script language="javascript">
      function konfirmasi(msg, url) {
        var pesan = confirm(msg);
        if (pesan == true)
          self.location = url;
        else
          return false;
      }
    </script>
  </head>

  <body>
    <form method='POST' action=''>
      <table width='20%' border='0' align='center' bgcolor='#8fdaeb'>
        <tr>
          <th colspan='2'>LOGIN</th>
        </tr>
        <tr>
          <td>Username</td>
          <td>: <input type='text' name='user' size='10' required></td>
        </tr>
        <tr>
          <td>Password</td>
          <td>: <input type='password' name='pass' size='10' required></td>
        </tr>
        <tr>
          <th colspan='2'><input type='submit' value='OK' name='login'></th>
        </tr>
        <tr>
          <td colspan='2'>User : admin</td>
        </tr>
        <tr>
          <td colspan='2'>Pass : 321</td>
        </tr>
      </table>
    </form>
  </body>

  </html>
<?php
}
