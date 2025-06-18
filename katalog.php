<?php
header('Content-Type: application/json');
include 'koneksi.php';

$produk = [];

if (isset($_GET['id'])) {
  // Ambil satu produk berdasarkan ID
  $id = intval($_GET['id']);
  $sql = "SELECT * FROM produk WHERE id = $id";
} elseif (isset($_GET['kategori'])) {
  // Ambil produk berdasarkan kategori (pastikan nama kategori sesuai database)
  $kategori = $conn->real_escape_string($_GET['kategori']);
  $sql = "SELECT * FROM produk WHERE kategori = '$kategori'";
} else {
  // Ambil semua produk
  $sql = "SELECT * FROM produk";
}

$result = $conn->query($sql);

// Jika hasil ditemukan
if ($result && $result->num_rows > 0) {
  if (isset($_GET['id'])) {
    // Jika hanya 1 produk (by ID)
    $produk = $result->fetch_assoc();
  } else {
    // Jika banyak produk (all atau filter kategori)
    while ($row = $result->fetch_assoc()) {
      $produk[] = $row;
    }
  }
}

$conn->close();

// Keluarkan dalam format JSON
echo json_encode($produk);
?>
