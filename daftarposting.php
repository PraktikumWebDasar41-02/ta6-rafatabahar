<?php
  include('menu.php');
  $hasil = mysqli_query($koneksi, "SELECT * FROM posting WHERE id_akun='$id_akun' ");

?>
<center>
<table border="1">
  <?php
    while ($row = mysqli_fetch_array($hasil)) {
      echo "<tr>";
      echo "<td><a href='detailpostingan.php?id=".$row['id_post']." '><img src='".$row['gambar']."' width='200px'></a></td>";
      echo "<td>".$row['title']."<br><br>".$row['tanggal']."</td>";
      echo "<td><a href='editpostingan.php?id=".$row['id_post']." '>Edit</a>
      <br><br><a href='detailpostingan.php?id=".$row['id_post']." '>Detail</a></td>";
      echo "</tr>";
    }
  ?>
</table>
</center>
