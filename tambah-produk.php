<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['nama_toko'])) {
  echo "<script>alert('Akses ditolak. Harap login sebagai penjual.'); window.location.href='login-penjual.php';</script>";
  exit;
}

$nama_toko = $_SESSION['nama_toko'];

$nama     = $_POST['nama'];
$harga    = $_POST['harga'];
$stok     = $_POST['stok']; // Kamu bisa hapus kalau di tabel produk gak ada kolom 'stok'
$kategori = $_POST['kategori'];
$deskripsi = $_POST['deskripsi']; // Tambahin input ini di form-nya ya
$gambar   = $_FILES['gambar']['name'];
$tmp      = $_FILES['gambar']['tmp_name'];
$folder   = "images/";

if (move_uploaded_file($tmp, $folder . $gambar)) {
  $query = "INSERT INTO produk (nama_produk, harga, gambar, nama_toko, deskripsi, kategori)
            VALUES ('$nama', '$harga', '$gambar', '$nama_toko', '$deskripsi', '$kategori')";
  $result = mysqli_query($conn, $query);

  if ($result) {
    echo "<script>alert('Produk berhasil ditambahkan!'); window.location.href='dashboard-penjual.php';</script>";
  } else {
    echo "<script>alert('Gagal menyimpan produk.'); history.back();</script>";
  }
} else {
  echo "<script>alert('Gagal upload gambar.'); history.back();</script>";
}
?>
