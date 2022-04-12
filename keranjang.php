<?php
session_start();
include 'koneksi.php';

if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
	echo "<script>alert('keranjang kosong, silahkan belanja dulu'); </script>";
	echo "<script>location='index.php'; </script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Keranjang Belanja</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<?php include 'menu.php'; ?>
<style type="text/css">
body{
	background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAARMAAAC3CAMAAAAGjUrGAAAADFBMVEX///9mzP+85v9eyv8GZtZYAAAAy0lEQVR4nO3QsQHAIAzAsED//7l7PLNJJ2gGAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACAZy7bfGxz2JyUk3JSTspJOSkn5aSclJNyUk7KSTkpJ+WknJSTclJOykk5KSflpJyUk3JSTspJOSkn5aSclJNyUk7KSTkpJ+WknJSTclJOykk5KSflpJyUk3JSTspJOSkn5aSclJNyUk7KSTkpJ+WknJSTclJOykk5KSflpJyUk3JSTspJOSkn5aSclJNyUk7KSTkpJ+WknNQP0OhmDrkmUc0AAAAASUVORK5CYII=');
	width: 100%;
	height: 100vh;
	background-size: cover;
}
</style>

<section class="konten">
	<div class="container">
		<h1>Keranjang Belanja</h1>
		<hr> 
		<table class="table table-bordered">
			<thead>
				<tr> 
					<th>no</th>
					<th>nama produk</th>
					<th>harga</th>
					<th>jumlah</th>
					<th>subharga</th>
					<th>aksi</th>
				</tr>	
			</thead>
			<tbody>
				<?php $nomor=1; ?>
				<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
				<!-- menampilkan produk yg sedang diperulangkan bdskan id_produk -->
				<?php 
				$ambil = $koneksi->query("SELECT * FROM produk
					WHERE id_produk='$id_produk'");
				$pecah = $ambil->fetch_assoc();
				$subharga = $pecah["harga_produk"]*$jumlah;

				?>
				<tr> 
					<td><?php echo $nomor; ?></td>
					<td><?php echo $pecah["nama_produk"]; ?></td>
					<td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
					<td><?php echo $jumlah; ?></td>
					<td>Rp. <?php echo number_format($subharga); ?></td>
					<td>
						<a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs">hapus</a>
					</td>
				</tr>
				<?php $nomor++; ?>
			<?php endforeach ?>
		</table>

		<a href="index.php" class="btn btn-info">lanjut belanja</a>
		<a href="checkout.php" class="btn btn-success">checkout</a>
	</div>
</section>

</body>
</html>