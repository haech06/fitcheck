<?php
include 'koneksi.php';

$sql = "SELECT * FROM produk";
$result = $conn->query($sql);

$produk = [];

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $produk[] = $row;
  }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($produk);
?>
