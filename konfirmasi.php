<?php
header('Content-Type: application/json');

// Koneksi ke database (edit sesuai config kamu)
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "fitcheck";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Koneksi gagal"]);
    exit;
}

// Ambil data dari POST
$id_produk = $_POST['id_produk'] ?? '';
$nama_produk = $_POST['nama_produk'] ?? '';
$jumlah = $_POST['jumlah'] ?? 0;
$total_harga = $_POST['total_harga'] ?? 0;
$alamat = $_POST['alamat'] ?? '';

if (!$id_produk || !$nama_produk || !$jumlah || !$total_harga || !$alamat) {
    echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]);
    exit;
}

// Simpan ke database (asumsi kamu punya tabel pesanan)
$stmt = $conn->prepare("INSERT INTO pesanan (id_produk, nama_produk, jumlah, total_harga, alamat, status) VALUES (?, ?, ?, ?, ?, 'Menunggu Konfirmasi')");
$stmt->bind_param("ssids", $id_produk, $nama_produk, $jumlah, $total_harga, $alamat);

if ($stmt->execute()) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "Gagal menyimpan ke database"]);
}

$stmt->close();
$conn->close();
?>
