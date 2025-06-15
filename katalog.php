<?php
header('Content-Type: application/json');
include 'koneksi.php';

$produk = [];

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);  // amankan input
  $sql = "SELECT * FROM produk WHERE id = $id";
  $result = $conn->query($sql);

  if ($result && $result->num_rows > 0) {
    $produk = $result->fetch_assoc(); // 1 produk
  }
} else {
  $sql = "SELECT * FROM produk";
  $result = $conn->query($sql);

  if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $produk[] = $row;
    }
  }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($produk);
?>
