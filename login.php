<?php
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Pelanggan</title>
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
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Login Pelanggan</h3>
				</div>
				<div class="panel-body">
					<form method="post">
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password">
						</div>
						<button class="btn btn-success" name="login">login</button>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>

<?php
// jika ada tombol login (ditekan)
if (isset($_POST["login"]))
{

	$email = $_POST["email"];
	$password = $_POST["password"];
	// lakukan query cek akun tabel pelanggan di db
	$ambil = $koneksi->query("SELECT * FROM pelanggan
		WHERE email_pelanggan='$email' AND password_pelanggan=md5('$password')");

	// menghitung akun yg terambil
	$akunyangcocok = $ambil->num_rows;

	// jika 1 akun yg cocok, maka login berhasil
	if ($akunyangcocok==1)
	{
		// anda sukses login
		// mendapat akun dalam bentuk array
		$akun = $ambil->fetch_assoc();
		// simpan di session pelanggan
		$_SESSION["pelanggan"] = $akun;
		echo "<script>alert('anda berhasil login'); </script>";

		// jika sudah belanja
		if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"]))
		{
			echo "<script>location='checkout.php'; </script>";
		}
		else
		{
			echo "<script>location='riwayat.php'; </script>";
		}
	}
	else
	{
		// anda gagal login
		echo "<script>alert('anda gagal login, periksa kembali email dan password anda'); </script>";
		echo "<script>location='login.php'; </script>";
	}
}
?>

</body>
</html>
