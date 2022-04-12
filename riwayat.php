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
	background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAARMAAAC3CAMAAAAGjUrGAAAADFBMVEX///9mzP+85v9eyv8GZtZYAAAAy0lEQVR4nO3QsQHAIAzAsED//7l7PLNJJ2gGAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACAZy7bfGxz2JyUk3JSTspJOSkn5aSclJNyUk7KSTkpJ+WknJSTclJOykk5KSflpJyUk3JSTspJOSkn5aSclJNyUk7KSTkpJ+WknJSTclJOykk5KSflpJyUk3JSTspJOSkn5aSclJNyUk7KSTkpJ+WknJSTclJOykk5KSflpJyUk3JSTspJOSkn5aSclJNyUk7KSTkpJ+WknNQP0OhmDrkmUc0AAAAASUVORK5CYII=');
	width: 100%;
	height: 100vh;
	background-size: cover;
}
</style>


<!-- <pre><?php print_r($_SESSION) ?></pre> -->
<section class="riwayat">
	<div class="container">
		<h3>Riwayat Belanja <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?></h3>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>no</th>
					<th>tanggal</th>
					<th>status</th>
					<th>total</th>
					<th>opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$nomor=1;
				// mendapat id_pelanggan yang login dr session
				$id_pelanggan = $_SESSION["pelanggan"]['id_pelanggan'];

				$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
				while($pecah = $ambil->fetch_assoc()){
				?>
				<tr>
					<td><?php echo $nomor; ?></td>
					<td><?php echo $pecah["tanggal_pembelian"] ?></td>
					<td>
						<?php echo $pecah["status_pembelian"] ?>
						<br>
						<?php if (!empty($pecah['resi_pengiriman'])): ?>
						no resi: <?php echo $pecah['resi_pengiriman']; ?>
						<?php endif ?>
					</td>
					<td>Rp. <?php echo number_format($pecah["total_pembelian"]) ?></td>
					<td>
						<a href="nota.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-info">nota</a>

						<?php if ($pecah['status_pembelian']=="pending"): ?>
						<a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-success">
							input pembayaran
						</a>
						<?php else: ?>
						<a href="lihat_pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-warning">
							lihat pembayaran
						</a>
						<?php endif ?>

					</td>
				</tr>
				<?php $nomor++; ?>
				<?php } ?>
			</tbody>
		</table>
	</div>
</section>

</body>
</html>