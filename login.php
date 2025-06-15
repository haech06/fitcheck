<?php
session_start();
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {
      // Set session
      $_SESSION['username'] = $row['username'];
      $_SESSION['role'] = $row['role'];
      $_SESSION['nama'] = $row['nama'];

      // Redirect
      if ($row['role'] == 'penjual') {
        header("Location: dashboard-penjual.php");
      } else {
        header("Location: dashboard-pembeli.html");
      }
      exit;
    }
  }

  echo "<script>alert('Login gagal!'); window.location='login.html';</script>";
}
?>
