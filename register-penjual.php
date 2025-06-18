<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $nama_toko = $_POST['nama_toko'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Cek apakah username & email ada di tabel users
  $cekUser = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND email='$email'");
  if (mysqli_num_rows($cekUser) > 0) {
    $dataUser = mysqli_fetch_assoc($cekUser);
    $user_id = $dataUser['id'];

    // Cek apakah user ini udah pernah daftar jadi penjual
    $cekPenjual = mysqli_query($conn, "SELECT * FROM penjual WHERE user_id='$user_id'");
    if (mysqli_num_rows($cekPenjual) > 0) {
      echo "<script>alert('Akun ini sudah terdaftar sebagai penjual.'); window.location.href='dashboard-penjual.php';</script>";
      exit;
    }

    // Simpan ke tabel penjual
    $insert = mysqli_query($conn, "INSERT INTO penjual (user_id, username, email, nama_toko, password)
                                   VALUES ('$user_id', '$username', '$email', '$nama_toko', '$hashed_password')");

    // Update role di tabel users
    $updateRole = mysqli_query($conn, "UPDATE users SET role='penjual' WHERE id='$user_id'");

  if ($insert && $updateRole) {
  // Ambil ID penjual yang baru dimasukkan
  $getPenjual = mysqli_query($conn, "SELECT * FROM penjual WHERE user_id='$user_id'");
  $dataPenjual = mysqli_fetch_assoc($getPenjual);

  $_SESSION['id_penjual'] = $dataPenjual['id_penjual'];
  $_SESSION['nama_toko'] = $dataPenjual['nama_toko'];

  echo "<script>alert('Berhasil mendaftar sebagai penjual!'); window.location.href='dashboard-penjual.php';</script>";
}

  }
}

?>
