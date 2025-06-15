<?php
header('Content-Type: application/json');
$koneksi = new mysqli("localhost", "root", "", "fitcheck");

if ($koneksi->connect_error) {
  echo json_encode([]);
  exit;
}

$sql = "SELECT 
          pesanan.id,
          produk.nama_produk,
          produk.gambar,
          pesanan.jumlah,
          pesanan.total_harga,
          pesanan.alamat
        FROM pesanan
        JOIN produk ON pesanan.id_produk = produk.id
        ORDER BY pesanan.id DESC";

$result = $koneksi->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
  $data[] = $row;
}

echo json_encode($data);
?>
