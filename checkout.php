<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;
$jumlah = isset($_GET['jumlah']) ? (int)$_GET['jumlah'] : 1;
$ongkir = 6500;

$produk = null;

if ($id) {
  // Ambil data produk dari katalog.php sebagai API JSON
  $response = file_get_contents("http://localhost/fitcheck/katalog.php?id=$id");
  $produk = json_decode($response, true);
}
?>