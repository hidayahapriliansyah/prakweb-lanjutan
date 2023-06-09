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
  echo "Hasil : " . $_SESSION['op'] . " <a href='logout.php'>LOGOUT</a>";
} else {
  echo "<form method='POST' action=''>";
  echo "<table width='30%' border='1' align='center'>";
  echo "<tr><th colspan='2'>LOGIN</th></tr>";
  echo "<tr><td>Username</td><td>: <input type='text' name='user' size='10' required></td></tr>";
  echo "<tr><td>Password</td><td>: <input type='password' name='pass' size='10' required></td></tr>";
  echo "<tr><th colspan='2'><input type='submit' value='OK' name='login'></th></tr>";
  echo "</table>";
  echo "</form>";
}
