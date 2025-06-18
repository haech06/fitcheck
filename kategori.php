<?php
header('Content-Type: application/json');
include 'koneksi.php';

$kategori = [];

$sql = "SELECT DISTINCT kategori FROM produk"; // atau dari tabel khusus kategori kalau ada
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $kategori[] = $row['kategori'];
  }
}

$conn->close();
echo json_encode($kategori);



?>
