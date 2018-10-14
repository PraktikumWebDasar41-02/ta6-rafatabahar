<?php
  include('menu.php');

  $hasil = mysqli_query($koneksi, "SELECT * FROM posting WHERE id_post='".$_GET['id']."' ");

?>
<center>
<table border="1">
  <thead>
    <td>Photo</td>
    <td width="150px">Judul & tanggal Postingan</td>
    <td>Cerita</td>
  </thead>
  <?php
    while ($row = mysqli_fetch_array($hasil)) {
      echo "<tr>";
      echo "<td><img src='".$row['gambar']."' width='200px'></td>";
      echo "<td>".$row['title']."<br><br>".$row['tanggal']."</td>";
      echo "<td>".$row['cerita']."</td>";
      echo "</tr>";
    }
    echo "</table><br>";

    if (isset($_GET['id_akun'])) {
      if ($_GET['id_akun']==$id_akun) {
        echo "<a href='editpostingan.php?id=".$_GET['id']."''>Edit</a>&nbsp&nbsp";
      }
      echo "<a href='semuapostingan.php'>Back</a>";
    }else {
      echo "<a href='editpostingan.php?id=".$_GET['id']."''>Edit</a>&nbsp&nbsp";
      echo "<a href='daftarposting.php'>Back</a>";
    }
  ?>



</center>
