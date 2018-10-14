<?php
  include('menu.php');
  $sql = "SELECT id_akun,username, gambar, title, tanggal, cerita, id_post FROM akun INNER JOIN posting USING(id_akun) ORDER BY id_post DESC ";
  $hasil = mysqli_query($koneksi, $sql);
?>
<center>
<table >
  <?php
    while ($row = mysqli_fetch_array($hasil)) {
      echo "<tr>";
      echo "<td colspan=2>Username: ".$row['username']."</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td><a href='detailpostingan.php?id=".$row['id_post']."&id_akun=".$row['id_akun']."'><img src='".$row['gambar']."' width='250px'></td>";
      echo "<td>".$row['title']."<br><br>".$row['tanggal']."</td>";
      echo "</tr>";
      echo "<tr><td>&nbsp</td></tr>";
    }
  ?>
</table>
</center>
