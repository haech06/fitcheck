<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Cek apakah username ada di tabel penjual
  $cek = mysqli_query($conn, "SELECT * FROM penjual WHERE username='$username'");
  if (mysqli_num_rows($cek) > 0) {
    $data = mysqli_fetch_assoc($cek);

    // Verifikasi password
    if (password_verify($password, $data['password'])) {
      // Set session
      $_SESSION['id'] = $data['user_id'];
      $_SESSION['nama_toko'] = $data['nama_toko'];

      header('Location: dashboard-penjual.php');
      exit;
    } else {
      echo "<script>alert('Password salah.'); history.back();</script>";
    }
  } else {
    echo "<script>alert('Penjual tidak ditemukan.'); history.back();</script>";
  }
}
?>

