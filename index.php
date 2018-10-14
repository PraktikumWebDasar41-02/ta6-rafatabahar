<?php session_start(); session_destroy(); ?>
<b>Form Login</b><br>
<form method="post">
  Username: <input type="text" name="username"><br>
  Password: <input type="password" name="pass"><br>
  <input type="submit" name="submit"><br>
</form>

<a href="registrasi.php">Registrasi</a><br>

<?php
  $koneksi = mysqli_connect('localhost','root','','aplikasi_album');
  //if (!$koneksi) die("Connection failed: " . mysqli_connect_error());

  if (isset($_POST['submit'])) {
    $usernm = $_POST['username'];
    $pass = md5($_POST['pass']);

    if (empty($usernm)||empty($pass)) {
      die("Kolom tidak boleh kosong, harus di isi !!!<br>");
    }

    $result = mysqli_query($koneksi, "SELECT * FROM akun WHERE username = '$usernm' AND password = '$pass' ");

    while ($row=mysqli_fetch_row($result)) {
        session_start();
        $_SESSION['nama'] = $row['2'];
        $_SESSION['id'] = $row['0'];
        header("Location: halamanawal.php");
    }
    echo "<br><br><b>Username atau Password tidak sesuai</b>";
  }
?>
