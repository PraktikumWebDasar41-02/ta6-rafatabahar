<form method="post">
	NIM: <input type="text" name="nim"><br>
	Nama: <input type="text" name="nama"><br>
	Username: <input type="text" name="username"><br>
	Password: <input type="Password" name="password"><br>
	Konfirmasi Password: <input type="Password" name="kpassword"><br>
	Kelas: D3MI-41-01<input type="radio" name="kelas" value="D3MI-41-01"> D3MI-41-02<input type="radio" name="kelas" value="D3MI-41-02"> D3MI-41-03<input type="radio" name="kelas" value="D3MI-41-03"> D3MI-41-04<input type="radio" name="kelas" value="D3MI-41-04"><br>
	Jenis Kelamin: Laki-laki<input type="radio" name="jk" value="laki-laki"> Perempuan<input type="radio" name="jk" value="Perempuan"><br>
	Hobi:<br>
	Sepak bola<input type="checkbox" name="hobi[]" value="Sepak Bola"><br>
	Basket<input type="checkbox" name="hobi[]" value="Basket"><br>
	Bulutangkis<input type="checkbox" name="hobi[]" value="Bulutangkis"><br>
	Main Game<input type="checkbox" name="hobi[]" value="main Game"><br>
	Berenang<input type="checkbox" name="hobi[]" value="Berenang"><br>

	Fakultas: <select name="fakultas">
			<option value="pilih">====Pilih Fakultas======</option>
			<option value="Fakultas Ilmu Terapan">Fakultas Ilmu Terapan</option>
			<option value="Fakultas Industri Kreatif">Fakultas Komunikasi dan Bisnis</option>
			<option value="Fakultas Rekayasa Industri">Fakultas Rekayasa Industri</option>
		</select><br>

	Alamat: <textarea name="alamat"></textarea><br>
	<input type="submit" name="submit"><br><br>
</form>
<a href="index.php">Back</a>

<?php

	if (isset($_POST['submit'])) {
		$nim = $_POST['nim'];
		$nama = $_POST['nama'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$kpassword = $_POST['kpassword'];
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

		if (empty($password)) {
			echo "Password tidak boleh kosong<br>";
			$cek = false;
		}else {
			if ($password!=$kpassword) {
				echo "Konfirmasi pasword anda<br>";
				$cek = false;
			}else {
        $password = md5($password);
      }
		}

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


		if ($cek) {
			$koneksi = mysqli_connect('localhost','root','','aplikasi_album');

			//menggunakan cara panjang karena id_akun auto increament
			$sql = "INSERT INTO akun (nim, nama, username, password, kelas, jenis_kelamin, hobi, fakultas, alamat) values ('$nim','$nama','$username','$password','$kelas','$jenis_kelamin','$hobi','$fakultas','$alamat')";

			if (mysqli_query($koneksi, $sql)) {
				header("Location:index.php");
			}else {
				echo "Gagal input ".mysqli_error($koneksi);
			}
		}else {
			echo "Isi data dengan benar";
		}

	}
?>
