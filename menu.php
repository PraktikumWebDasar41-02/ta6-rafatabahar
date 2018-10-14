<?php
  session_start();
  $koneksi = mysqli_connect('localhost','root','','aplikasi_album');
  $id_akun = $_SESSION['id'];
?>
<center>
<table width="900px">
  <tr>
    <td>
      <?php echo "Selamat datang <b>".$_SESSION['nama']."&nbsp"; ?>
      <a href='index.php'><button type='button' name='button' style='background-color:red'>Log Out</button></a>
    </td>
    <td></td>
    <td><a href="halamanawal.php">Halaman Awal</a></td>
    <td><a href="editprofile.php">Edit Profile</a></td>
    <td><a href="posting.php">Posting</a></td>
    <td><a href="daftarposting.php">Lihat Postingan</a></td>
    <td><a href="semuapostingan.php">Semua Postingan</a></td>
  </tr>
</table>
</center>
<br>
