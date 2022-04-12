<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>daftar</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
	<?php include 'menu.php'; ?>
	<style type="text/css">
	body{
		background: url('https://i.pinimg.com/originals/b0/1d/04/b01d0485fd34a3eb3d6ce850f0a5383b.jpg');
		width: 100%;
		height: 100vh;
		background-size: cover;
	}
	</style>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Daftar Pelanggan</h3>
					</div>
					<div class="panel-body">
						<form method="post" class="form-horizontal">
							<div class="form-group">
								<label class="control-label col-md-3">Nama</label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="nama" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Email</label>
								<div class="col-md-7">
									<input type="email" class="form-control" name="email" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Password</label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="password" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Alamat</label>
								<div class="col-md-7">
									<textarea class="form-control" name="alamat" required></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Telp/HP</label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="telepon" required>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-7 col-md-offset-3">
									<button class="btn btn-success" name="daftar">Daftar</button>
								</div>
							</div>
						</form>
						<?php
						// jika tombol daftar ditekan
						if (isset($_POST['daftar']))
						{
							// mengambil nama email pw alamat telepon
							$nama = $_POST["nama"];
							$email = $_POST["email"];
							$password = $_POST["password"];

							$alamat = $_POST["alamat"];
							$telepon = $_POST["telepon"];

							// mengecek apakah email sudah digunakan
							$ambil = $koneksi->query("SELECT * FROM pelanggan
								WHERE email_pelanggan='$email'");
							$yangcocok = $ambil->num_rows;
							if ($yangcocok==1)
							{
								echo "<script>alert('email telah digunakan, silahkan masukkan email yang lain :('); </script>";
								echo "<script>location='daftar.php'; </script>";
							}
							else
							{
								// query insert ke tabel pelanggan
								$koneksi->query("INSERT INTO pelanggan
									(email_pelanggan,password_pelanggan,nama_pelanggan,
									notelp_pelanggan,alamat_pelanggan)
									VALUES('$email',md5('$password'),'$nama','$telepon','$alamat') ");
								echo "<script>alert('pendaftaran sukses :D'); </script>";
								echo "<script>location='login.php'; </script>";
							}

						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>


</body>
</html>