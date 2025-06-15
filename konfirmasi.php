<?php
header('Content-Type: application/json');

include 'koneksi.php';

$id_produk = $_GET['id_produk'] ?? '';
$nama_produk = $_GET['nama_produk'] ?? '';
$jumlah = $_GET['jumlah'] ?? 1;
$total_harga = $_GET['total_harga'] ?? 0;
$alamat = $_POST['alamat'] ?? '';
$metode_pembayaran = "QRIS";
$status = "Menunggu Konfirmasi";
$waktu_checkout = date("Y-m-d H:i:s");

// Validasi dasar
if (!$id_produk || !$nama_produk || !$alamat) {
  echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]);
  exit;
}

// Simpan ke database
$stmt = $koneksi->prepare("INSERT INTO checkout (id_produk, nama_produk, jumlah, total_harga, alamat, metode_pembayaran, status, waktu_checkout) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssisssss", $id_produk, $nama_produk, $jumlah, $total_harga, $alamat, $metode_pembayaran, $status, $waktu_checkout);

if ($stmt->execute()) {
  echo json_encode(["status" => "success"]);
} else {
  echo json_encode(["status" => "error", "message" => "Gagal menyimpan data"]);
}

$stmt->close();
$koneksi->close();
?> 
