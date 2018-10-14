<?php
  include('menu.php');
?>
<center>
  <form method="post" enctype="multipart/form-data">
    Judul: <input type="text" name="judul" placeholder="judul cerita" value="<?php if(isset($_POST['s_gambar'])) echo $_POST['judul']; ?>" ><br>
    Cerita: <br>
    <textarea name="cerita" rows="20" cols="80"><?php if(isset($_POST['s_gambar'])) echo $_POST['cerita']; ?></textarea><br>
    <input type="file" name="gambar"><input type="submit" name="s_gambar" value="Pilih Gambar"><br>
    <?php
    $file_name = "";
      if (isset($_POST['s_gambar'])) {
        echo "<br>";
        $file_name = "gambar/".basename($_FILES['gambar']['name']);
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $file_name)) {
          echo "Preview: <img src='".$file_name."' alt='Gambar gagal di load' width='300px'>";
        }
      }
    ?>
    <input type="text" name="gambar2" value="<?php if(isset($_POST['s_gambar'])) echo $file_name; ?>" hidden>
    <br><br><button type="submit" name="submit" style="background-color:aqua">Posting</button>
  </form>
</center>

<?php
  if (isset($_POST['submit'])) {
    $title = $_POST['judul'];
    $cerita = $_POST['cerita'];
    $tanggal = date('d M Y');
    //echo $_POST['gambar2'];

    $cek = true;

    if (empty($title)) {
      echo "Judul harus di isi<br>";
      $cek = false;
    }

    if (empty($cerita)) {
      echo "Cerita harus di isi<br>";
      $cek = false;
    }else {
      if (str_word_count($cerita)<30) {
        echo "Banyak kata tidak boleh kurang dari 30 kata<br>";
        $cek = false;
      }
      if(strpos($cerita,"'")){
        echo "Error, tidak boleh menggunakan ' <br>";
        $cek = false;
      }
    }

    if ($cek) {
      if (!empty($_POST['gambar2'])) {
        $gambar = $_POST['gambar2'];
        $sql = "INSERT INTO posting (title, tanggal, gambar, cerita, id_akun) VALUES ('$title', '$tanggal', '$gambar' , '$cerita', '$id_akun') ";
        if (mysqli_query($koneksi, $sql)) {
          header("Location:daftarpostingan.php");
        }else {
          echo "Gagal input ".mysqli_error($koneksi);
        }
      }else { // Jika tidak melakukan preview gambar
        if (empty($_FILES['gambar']['name'])) {
          die("Harus mengunggah Gambar<br>");
        }
        $file_name = "gambar/".basename($_FILES['gambar']['name']);
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $file_name)) {
          //echo $file_name;
          $sql = "INSERT INTO posting (title, tanggal, gambar, cerita, id_akun) VALUES ('$title', '$tanggal', '$file_name' ,'$cerita', '$id_akun') ";
          if (mysqli_query($koneksi, $sql)) {
              //echo $file_name;
            header("Location:daftarpostingan.php");
          }else {
            echo "Gagal input ".mysqli_error($koneksi);
          }
        }else {
          echo "Gagal upload gambar";
          echo $file_name;
        }
      }
    }else {
      echo "isi dengan benar";
    }

  }
?>
