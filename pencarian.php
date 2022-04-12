<?php include 'koneksi.php'; ?>
<?php
$keyword = $_GET["keyword"];

$semuadata=array();
$ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%'
	OR deskripsi_produk LIKE '%$keyword%'");
while($pecah = $ambil->fetch_assoc())
{
	$semuadata[]=$pecah;
}

// echo "<pre>";
// print_r ($semuadata);
// echo "</pre>";
?>


<!DOCTYPE html>
<html>
<head>
	<title>Pencarian</title>
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
		<h3>Hasil Pencarian : <?php echo $keyword ?></h3>

		<?php if (empty($semuadata)): ?>
			<div class="alert alert-danger">maaf, kami tidak menjual <strong><?php echo $keyword ?></strong> :(</div>
		<?php endif ?>

		<div class="row">


			<?php foreach ($semuadata as $key => $value): ?>

			<div class="col-md-3">
				<div class="thumbnail">
					<img src="foto_produk/<?php echo $value["foto_produk"] ?>" alt="" class="img-responsive">
					<div class="caption">
						<h3><?php echo $value["nama_produk"] ?></h3>
						<h5>Rp. <?php echo number_format($value['harga_produk']) ?></h5>
						<a href="beli.php?id=<?php echo $value["id_produk"]; ?>" class="btn btn-primary">beli</a>
						<a href="detail.php?id=<?php echo $value["id_produk"]; ?>" class="btn btn-default">detail</a>
					</div>
				</div>
			</div>

			<?php endforeach ?>


		</div>
	</div>

</body>
</html>