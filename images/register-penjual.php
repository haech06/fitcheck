<?php
$koneksi = new mysqli("localhost", "root", "", "fitcheck");

if ($koneksi->connect_error) {
  die("Koneksi gagal: " . $koneksi->connect_error);
}

$nama       = $_POST['nama'];
$nama_toko  = $_POST['nama_toko'];
$email      = $_POST['email'];
$password   = password_hash($_POST['password'], PASSWORD_DEFAULT); // amankan password

// Cek apakah email sudah digunakan
$cek = $koneksi->prepare("SELECT id FROM penjual WHERE email = ?");
$cek->bind_param("s", $email);
$cek->execute();
$cek->store_result();

if ($cek->num_rows > 0) {
  echo "<script>alert('Email sudah terdaftar.'); window.history.back();</script>";
  exit;
}

$stmt = $koneksi->prepare("INSERT INTO penjual (nama, nama_toko, email, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nama, $nama_toko, $email, $password);

if ($stmt->execute()) {
  header("Location: dashboard-penjual.html");
  exit;
} else {
  echo "Gagal mendaftar: " . $koneksi->error;
}
?>
