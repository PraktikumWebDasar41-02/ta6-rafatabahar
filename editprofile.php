<?php
  include('menu.php');

	$tampil = mysqli_query($koneksi, "SELECT * FROM akun WHERE id_akun='$id_akun' ");
	$row = mysqli_fetch_array($tampil);
?>

<center>
<form method="post">
	NIM: <input type="text" name="nim" value="<?php echo $row['nim'];  ?>"><br>
	Nama: <input type="text" name="nama" value="<?php echo $row['nama'];  ?>"><br>
  Username: <input type="text" name="username" value="<?php echo $row['username']; ?>"><br>
	<!-- Password: <input type="text" name="password" value="<?php echo $row['password'];  ?>"><br> -->
	Kelas: D3MI-41-01<input type="radio" name="kelas" value="D3MI-41-01" <?php if($row['kelas']=="D3MI-41-01") echo "checked"; ?> >
	D3MI-41-02<input type="radio" name="kelas" value="D3MI-41-02" <?php if($row['kelas']=="D3MI-41-02") echo "checked"; ?>>
	D3MI-41-03<input type="radio" name="kelas" value="D3MI-41-03" <?php if($row['kelas']=="D3MI-41-03") echo "checked"; ?>>
	D3MI-41-04<input type="radio" name="kelas" value="D3MI-41-04" <?php if($row['kelas']=="D3MI-41-04") echo "checked"; ?>><br>

	Jenis Kelamin: Laki-laki<input type="radio" name="jk" value="laki-laki" <?php if($row['jenis_kelamin']=="laki-laki") echo "checked"; ?>>
	Perempuan<input type="radio" name="jk" value="Perempuan"  <?php if($row['jenis_kelamin']=="Perempuan") echo "checked"; ?>><br>

	<b>Hobi:</b><br>
	Sepak bola<input type="checkbox" name="hobi[]"  value="Sepak Bola" <?php if(strpos(" ".$row['hobi'],"Sepak Bola")) echo "Checked"; ?>><br>
	Basket<input type="checkbox" name="hobi[]" value="Basket" <?php if(strpos(" ".$row['hobi'],"Basket")) echo "Checked"; ?>><br>
	Bulutangkis<input type="checkbox" name="hobi[]" value="Bulutangkis" <?php if(strpos(" ".$row['hobi'],"Bulutangkis")) echo "Checked"; ?>><br>
	Main Game<input type="checkbox" name="hobi[]" value="Main Game" <?php if(strpos(" ".$row['hobi'],"Game")) echo "Checked"; ?>><br>
	Berenang<input type="checkbox" name="hobi[]" value="Berenang" <?php if(strpos(" ".$row['hobi'],"Berenang")) echo "Checked"; ?>><br>

	Fakultas: <select name="fakultas">
			<option value="pilih">====Pilih Fakultas======</option>
			<option value="Fakultas Ilmu Terapan" <?php if($row['fakultas']=="Fakultas Ilmu Terapan") echo "Selected"; ?>>Fakultas Ilmu Terapan</option>
			<option value="Fakultas Komunikasi dan Bisnis" <?php if($row['fakultas']=="Fakultas Komunikasi dan Bisnis") echo "selected"; ?>>Fakultas Komunikasi dan Bisnis</option>
			<option value="Fakultas Rekayasa Industri" <?php if($row['fakultas']=="Fakultas Rekayasa Industri") echo "selected"; ?>>Fakultas Rekayasa Industri</option>
		</select><br>
	Alamat: <textarea name="alamat"><?php echo $row['alamat'];  ?></textarea><br>
	<input type="submit" name="submit">
</form>

<?php

	if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];
		$nama = $_POST['nama'];
		$username = $_POST['username'];
		// $password = $_POST['password'];
		// $kpassword = $_POST['kpassword'];
		$kelas;
		$jenis_kelamin;
		$arrhobi = $_POST['hobi'];
		$fakultas = $_POST['fakultas'];
		$alamat = $_POST['alamat'];
		$hobi = "";

		if (!empty($arrhobi)) {
			foreach ($arrhobi as $value) {
				$hobi .= $value.", ";
			}
		}else {
			echo "Harus memilih hobi<br>";
			$cek = false;
		}

		$cek = true;

		if (isset($_POST['kelas'])) {
			$kelas = $_POST['kelas'];
		}

		if (isset($_POST['jk'])) {
			$jenis_kelamin = $_POST['jk'];
		}

		if (empty($nim)) {
			echo "NIM tidak boleh kosong<br>";
			$cek = false;
		}else{
			if (strlen($nim)!=10 || !is_numeric($nim)) {
				echo "NIM Harus 10 digit dan angka<br>";
				$cek = false;
			}

		}

		if (empty($nama)) {
			echo "Nama tidak boleh kosong<br>";
			$cek = false;
		}else{
			if (strlen($nama)>35) {
				echo "Maksimal panjang nama 35 huruf<br>";
				$cek = false;
			}
		}

		if (empty($username)) {
			echo "Username tidak boleh kosong<br>";
			$cek = false;
		}

		// if (empty($password)) {
		// 	echo "Password tidak boleh kosong<br>";
		// 	$cek = false;
		// }else {
		// 	if ($password!=$kpassword) {
		// 		echo "Konfirmasi pasword anda<br>";
		// 		$cek = false;
		// 	}else {
    //     $password = md5($password);
    //   }
		// }

		if (empty($kelas)) {
			echo "Harus memilih kelas<br>";
			$cek = false;
		}

		if (empty($jenis_kelamin)) {
			echo "Harus memilih jenis kelamin<br>";
			$cek = false;
		}


		if ($fakultas=="pilih") {
			echo "Harus memilih faultas<br>";
			$cek = false;
		}

		if (empty($alamat)) {
			echo "Alamat tidak boleh kosong<br>";
			$cek = false;
		}

		if($cek) {
			$sql = "UPDATE akun SET nim = '$nim', nama = '$nama', username = '$username' , kelas = '$kelas', jenis_kelamin = '$jenis_kelamin', hobi = '$hobi', fakultas = '$fakultas', alamat = '$alamat'  WHERE id_akun = '$id_akun' ";
			if (mysqli_query($koneksi, $sql)) {
				header("Location:halamanawal.php");
			}else {
				echo "Gagal input ".mysqli_error($koneksi);
			}
		}else {
			echo "Isi data dengan benar";
		}

	}
?>
</center>
