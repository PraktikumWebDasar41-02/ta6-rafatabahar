<?php
  include('menu.php');

  $id_post = $_GET['id'];

  $hasil = mysqli_query($koneksi, "SELECT * FROM posting WHERE id_post='$id_post' ");
  $row = mysqli_fetch_array($hasil);
?>
<center>
  <form method="post" enctype="multipart/form-data">
    Judul: <input type="text" name="judul" value="<?php echo $row['title']; ?>" ><br>
    Cerita: <br>
    <textarea name="cerita" rows="20" cols="80"><?php echo $row['cerita']; ?></textarea><br>
    <?php
      echo "Priview : <br>";
      echo "<img src='".$row['gambar']."' width='200px'>";
    ?>
    <br>
    <input type="file" name="gambar"><br>
    <br><br><button type="submit" name="submit" style="background-color:aqua">Posting</button>
  </form>
</center>

<?php
  if (isset($_POST['submit'])) {
    $title = $_POST['judul'];
    $cerita = $_POST['cerita'];
    $tanggal = "Diedit pada: ".date('d M Y');
    //echo $_POST['gambar2'];


      if (!empty($_FILES['gambar']['name'])) {
        $file_name = "gambar/".basename($_FILES['gambar']['name']);
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $file_name)) {
          //echo $file_name;
          $sql = "UPDATE posting SET title = '$title', cerita = '$cerita', gambar = '$file_name', tanggal = '$tanggal' WHERE id_post = '$id_post' ";
          if (mysqli_query($koneksi, $sql)) {
              //echo $file_name;
            header("Location:daftarposting.php");
          }else {
            echo "Gagal input ".mysqli_error($koneksi);
          }
        }else {
          echo "Gagal upload gambar a";
          echo $file_name;
          echo $_FILES['gambar']['name'];
        }
      }else {
        $sql = "UPDATE posting SET title = '$title', cerita = '$cerita', tanggal = '$tanggal' WHERE id_post = '$id_post' ";
        if (mysqli_query($koneksi, $sql)) {
            //echo $file_name;
          header("Location:daftarposting.php");
        }else {
          echo "Gagal input ".mysqli_error($koneksi);
        }
      }



  }
?>
