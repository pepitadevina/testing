<?php session_start(); ?>
<?php include 'koneksi.php'; ?>
<?php
// mendapatkan id_produk dari url
$id_produk = $_GET["id"];


// query mengambil data
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();

//echo "<pre>";
//print_r($detail);
//echo "</pre>";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Detail Produk</title>
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

<section class="konten">
	<div class="kontainer">
		<div class="row"></div>
			<div class="col-md-6">
				<img src="foto_produk/<?php echo $detail["foto_produk"]; ?>" alt="" class="img-responsive">
			</div>
			<div class="col-md-6">
				<h2><?php echo $detail["nama_produk"] ?></h2>
				<h4>Rp. <?php echo number_format($detail["harga_produk"]); ?></h4>

				<h5>Stok: <?php echo $detail['stok_produk'] ?></h5>

				<form method="post">
					<div class="form-group">
						<div class="input-group">
							<input type="number" min="1" class="form-control" name="jumlah" max="<?php echo $detail['stok_produk'] ?>">
							<div class="input-group-btn">
								<button class="btn btn-primary" name ="beli">beli</button>
							</div>
						</div>
					</div>
				</form>

				<?php
				// jika ada tombol beli
				if (isset($_POST["beli"]))
				{
					// mendapat jumlah produk yg diinput
					$jumlah = $_POST["jumlah"];
					// masukkan ke keranjang
					$_SESSION["keranjang"]["$id_produk"] = $jumlah;

					echo "<script>alert('produk telah masuk ke dalam keranjang');</script>";
					echo "<script>location='keranjang.php';</script>";
					
				}
				?>

				<p><?php echo $detail["deskripsi_produk"]; ?></p>
			</div>
	</div>
</section>	

</body>
</html>
