<?php
  include('menu.php');

  $hasil = mysqli_query($koneksi, "SELECT * FROM akun WHERE id_akun = '$id_akun' ");
  $row = mysqli_fetch_array($hasil);

  echo "<center><b>Data Diri Anda :</b><br>";
  echo "<br>NIM : ".$row['nim'];
  echo "<br>Nama : ".$row['nama'];
  echo "<br>Username : ".$row['username'];
  echo "<br>Kelas : ".$row['kelas'];
  echo "<br>Jenis Kelamin : ".$row['jenis_kelamin'];
  echo "<br>Hobi : ".$row['hobi'];
  echo "<br>Fakultas : ".$row['fakultas'];
  echo "<br>Alamat : ".$row['alamat']."</center>";

?>
