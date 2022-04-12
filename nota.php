<?php
session_start();
include 'koneksi.php'; ?>


<!DOCTYPE html>
<html>
<head>
	<title>Nota Pembelian</title> 
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


	<!-- nota -->
	<h2>Detail Pembelian</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
	ON pembelian.id_pelanggan=pelanggan.id_pelanggan
	WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>



<!-- jika pelanggan beli tdk sama dgn yg login maka dilarikan ke riwayat.php -->
<?php
// mendapatkan id_pelanggan yg beli
$idpelangganyangbeli = $detail["id_pelanggan"];

// mendapatkan id_pelanggan yg login
$idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

if ($idpelangganyangbeli!==$idpelangganyanglogin)
{
	echo "<script>alert('maaf, anda tidak bisa mengakses nota ini :('); </script>";
	echo "<script>location='riwayat.php'; </script>";
	exit();
}
?>


<div class="row">
	<div class="col-md-4">
		<h3>Pembelian</h3>
		<strong>No. Pembelian: <?php echo $detail['id_pembelian'] ?></strong><br>
		Tanggal: <?php echo $detail['tanggal_pembelian']?>; <br>
		Total: Rp. <?php echo number_format($detail['total_pembelian']) ?>
	</div>
	<div class="col-md-4">
		<h3>Pelanggan</h3>
		<strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
		<p> 
			<?php echo $detail['notelp_pelanggan']; ?> <br> 
			<?php echo $detail['email_pelanggan']; ?>
		</p>
	</div>
	<div class="col-md-4">
		<h3>Pengiriman</h3>
		<strong><?php echo $detail['nama_kota'] ?></strong><br>
		Ongkos Kirim: Rp. <?php echo number_format($detail['tarif']); ?> <br>
		Alamat: <?php echo $detail['alamat_pengiriman']; ?>
	</div>
</div>

<table class="table table-bordered"> 
	<thead> 
		<tr> 
			<th>no</th>
			<th>nama produk</th>
			<th>harga</th>
			<th>jumlah</th>
			<th>subtotal</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
		<?php while($pecah=$ambil->fetch_assoc()){ ?> 
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama']; ?></td>
			<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>


<div class="row">
	<div class="col-md-7">
		<div class="alert alert-info">
			<p>
				silahkan melakukan pembayaran sebesar Rp. <?php echo number_format($detail['total_pembelian']); ?> ke <br>
				<strong>BANK BCA 5920173847 AN. Pepita Devina Septhin</strong>
			</p>
</div>



	</div>
</section>

</body>
</html>
