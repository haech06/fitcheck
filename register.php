<?php
session_start();
require 'koneksi.php'; // file koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Role default = pembeli
    $role = 'pembeli';

    // Cek apakah username sudah dipakai
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Username sudah terpakai!'); window.location='register.html';</script>";
    } else {
        // Simpan ke database
        $query = "INSERT INTO users (nama, email, username, password, role) 
                  VALUES ('$nama', '$email', '$username', '$hashed_password', '$role')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location='login.html';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat mendaftar!'); window.location='register.html';</script>";
        }
    }
} else {
    header("Location: register.html");
    exit;
}
?>
