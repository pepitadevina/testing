<?php
session_start();
// mendapatkan id_produk dari url
$id_produk = $_GET['id'];


// jika sudah ada produk itu di keranjang, maka jumlah +1
if(isset($_SESSION['keranjang'][$id_produk]))
{
	$_SESSION['keranjang'][$id_produk]+=1;
}
// selain itu (blm ada di keranjang), maka produk dianggap dibeli 1
else
{
	$_SESSION['keranjang'][$id_produk] = 1;
}



//echo "<pre";
//print_r($_SESSION);
//echo "</pre>";

//larikan ke keranjang
echo "<script>alert('produk telah masuk ke keranjang belanja');</script>";
echo "<script>location='keranjang.php';</script>";
?>