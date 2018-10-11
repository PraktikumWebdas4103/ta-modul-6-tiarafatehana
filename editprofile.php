<?php
	include 'koneksi.php';
	include 'aksi.php';

	session_start();
	$user = $_SESSION['user'];
	$pass = $_SESSION['pass'];

	$sql = "SELECT * FROM data WHERE username = '$user' AND password = '$pass'";
	$query = mysqli_query($conn, $sql);

	if (mysqli_num_rows($query) > 0) {
		while ($row = mysqli_fetch_assoc($query)) {
?>
	
<html>
<head>
	<title>FORMULIR MAHASISWA</title>
</head>
<style>
	.red {
		font-size: 10pt;
		color: lightblue;
	}
	td { vertical-align: top; padding: 5px 5px 5px 5px;}
	table {
		margin: auto;
		width: 30%;
		border-collapse: collapse;
		border: 1px solid #888;
	}
	.save {
		width: 100%;
		height: 30px;
	}
</style>
<body>
	<form action="" method="POST">
		<table>
			 	<tr>
				<td colspan="3" align="left"><h2>EDIT MAHASISWA ===============</h2></td>
			</tr>
			<tr>
				<td>Nama Lengkap</td>
				<td>:</td>
				<td>
					<input type="text" name="nama" value="<?php echo $row['nama']; ?>"><br>
					<span class="red"><?php if(isset($erNama)){ echo $erNama; } ?></span>
				</td>
			</tr>
			<tr>
				<td>NIM</td>
				<td>:</td>
				<td>
					<input type="text" name="nim" value="<?php echo $row['nim']; ?>"><br>
					<span class="red"><?php if(isset($erNim)){ echo $erNim; } ?></span>
				</td>
			</tr>
			<tr>
				<td valign="top">Kelas</td>
				<td valign="top">:</td>
				<td>
					<input type="hidden" name="kelas" checked>
					<input type="radio" name="kelas" value="D3 MI 41-01">D3 MI 41-01<br>
					<input type="radio" name="kelas" value="D3 MI 41-02">D3 MI 41-02<br>
					<input type="radio" name="kelas" value="D3 MI 41-03">D3 MI 41-03<br>
					<input type="radio" name="kelas" value="D3 MI 41-04">D3 MI 41-04<br>

				</td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>:</td>
				<td>
					<input type="hidden" name="jKel" checked>
					<input type="radio" name="jKel" value="Pria">Pria
					<input type="radio" name="jKel" value="Wanita">Wanita<br>
					
				</td>
			</tr>
			<tr>
				<td valign="top">Hobi</td>
				<td valign="top">:</td>
				<td>
					<input type="hidden" name="hobi[]" value="">
					<input type="checkbox" name="hobi[]" value="Tidur">Tidur<br>
					<input type="checkbox" name="hobi[]" value="Salto">Salto<br>
					<input type="checkbox" name="hobi[]" value="Nafas">Nafas<br>
					<input type="checkbox" name="hobi[]" value="Kayang">Kayang<br>
					<input type="checkbox" name="hobi[]" value="Tenggelam">Tenggelam<br>

				</td>
			</tr>
			<tr>
				<td>Fakultas</td>
				<td>:</td>
				<td>
					<select name="fakultas">
						<option value="">Pilih Fakultas</option>
						<option value="FIT">Fakultas Ilmu Terapan</option>
						<option value="FKB">Fakultas Komunikasi Bisnis</option>
						<option value="FEB">Fakultas Ekonomi Bisnis</option>
						<option value="FIK">Fakultas Industri Kreatif</option>
						<option value="FIF">Fakultas Informatika</option>
						<option value="FTE">Fakultas Teknik Elektri</option>
						<option value="FRI">Fakultas Rekayasa Industri</option>
					</select><br>

				</td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td>
					<input type="textarea" name="alamat" value="<?php echo $row['alamat']; ?>">
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<br>
					<input type="submit" name="update" value="UPDATE" class="save"><br>
					<span class="red"><b><u><?php if(isset($err)){ echo $err; } ?></b></u></span>
				</td>
			</tr>
		</table>
		<?php
				}
			}

			if (isset($_POST['update'])) {
				$nama		= $_POST['nama'];
				$nim		= $_POST['nim'];
				$kelas		= $_POST['kelas'];
				$jenisKel	= $_POST['jKel'];
				$hobi 		= $_POST['hobi'];
				$tmp_hobi	= implode(', ', $_POST['hobi']);
				$fakultas	= $_POST['fakultas'];
				$alamat		= $_POST['alamat'];

				$sql = "UPDATE data
					SET nama = '$nama',
					nim = '$nim',
					kelas = '$kelas',
					jeniskelamin = '$jenisKel',
					hobi = '$tmp_hobi',
					fakultas = '$fakultas',
					alamat = '$alamat'
					WHERE nim = '$nim'
				";
				$query = mysqli_query($conn, $sql);

				$update = '';
				if ($query) {
					header("Location: halamanawal.php?update='Data Berhasil Diupdate'");
				}else{
					echo 'Data Gagal Diupdate';
				}
			}
		?>
		</form>
	</body>
</html>