<?php
session_start();
//koneksi ke database
include 'koneksi.php';

//jika blm login
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
{
	echo "<script>alert('silahkan login terlebih dahulu'); </script>";
	echo "<script>location='login.php'; </script>";
	exit();
}



//mendapat id_pembelian dari url
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

//mendapat id_pelanggan yg beli
$id_pelanggan_beli = $detpem["id_pelanggan"];

//mendapat id_pelanggan yg login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if ($id_pelanggan_login !== $id_pelanggan_beli)
{
	echo "<script>alert('maaf, anda tidak bisa mengakses halaman ini :('); </script>";
	echo "<script>location='riwayat.php'; </script>";
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pembayaran</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

	<?php include 'menu.php'; ?>
	<style type="text/css">
	body{
		background: url('https://www.solidbackgrounds.com/images/950x350/950x350-sky-blue-solid-color-background.jpg');
		width: 100%;
		height: 100vh;
		background-size: cover;
	}
	</style>

	<div class="container">
		<h2>Konfirmasi Pembayaran</h2>
		<p>kirim bukti pembayaran Anda disini</p>
		<div class="alert alert-info">total tagihan Anda sebesar <strong>Rp. <?php echo number_format($detpem["total_pembelian"]) ?></strong></div>
		

		<form method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama Penyetor</label>
				<input type="text" class="form-control" name="nama">
			</div>
			<div class="form-group">
				<label>Bank</label>
				<input type="text" class="form-control" name="bank">
			</div>
			<div class="form-group">
				<label>Jumlah</label>
				<input type="number" class="form-control" name="jumlah" min="1">
			</div>
			<div class="form-group">
				<label>Foto Bukti</label>
				<input type="file" class="form-control" name="bukti">
				<p class="text-danger">resolusi foto bukti maksimal 2 MB</p>
			</div>
			<button class="btn btn-success" name="kirim">kirim</button>
		</form>
	</div>

<?php
// jika tombol kirim ditekan
if (isset($_POST["kirim"]))
{
	// upload foto bukti
	$namabukti = $_FILES["bukti"]["name"];
	$lokasibukti = $_FILES["bukti"]["tmp_name"];
	$namafiks = date("YmdHis").$namabukti;
	move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

	$nama = $_POST["nama"];
	$bank = $_POST["bank"];
	$jumlah = $_POST["jumlah"];
	$tanggal = date("Y-m-d");

	// simpan pembayaran
	$koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti)
		VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks') ");

	// update status pembelian
	$koneksi->query("UPDATE pembelian SET status_pembelian='menunggu konfirmasi pembayaran'
		WHERE id_pembelian='$idpem'");

	echo "<script>alert('pembayaran anda akan segera dikonfirmasi'); </script>";
	echo "<script>location='riwayat.php'; </script>";
}
?>

</body>
</html>