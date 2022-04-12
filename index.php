<?php
session_start();
//koneksi ke database
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>COLORSPACE</title>
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




<!-- konten -->
<section class="konten">
	<div class="container">
		<h1>Produk Terbaru</h1>
		
		<div class="row">
		
			<?php $ambil = $koneksi->query("SELECT * FROM produk "); ?>
			<?php while($perproduk = $ambil->fetch_assoc()){ ?>
			<div class="col-md-3">
				<div class="thumbnail">
					<img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt="">
					<div class="caption">
						<h3><?php echo $perproduk['nama_produk']; ?></h3>
						<h5>Rp. <?php echo number_format($perproduk['harga_produk']); ?></h5>
						<a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-success">beli</a>
						<a href="detail.php?id=<?php echo $perproduk["id_produk"]; ?>" class="btn btn-info">detail</a>
					</div>
				</div>
			</div>	
			<?php } ?>
				
				
		</div>
	</div>
</section>

</body>
</html>