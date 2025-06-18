<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Penjual - FitCheck</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    .navbar-brand {
      font-weight: bold;
      color: #28a745;
    }
    .card img {
      object-fit: cover;
      height: 150px;
    }
    .card:hover {
      transform: scale(1.01);
    }
    .table th, .table td {
      vertical-align: middle;
    }
  </style>
</head>
<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand" href="#">FitCheck Penjual</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="tambah-produk.html"><i class="bi bi-plus-circle"></i> Tambah Produk</a></li>
        <li class="nav-item"><a class="nav-link" href="pesanan-masuk.html"><i class="bi bi-box-seam"></i> Pesanan Masuk</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php"><i class="bi bi-box-arrow-right"></i> Keluar</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- CONTENT -->
<div class="container py-5">
  <h3 class="mb-4 fw-bold text-success text-center">Dashboard Toko Kamu</h3>

  <!-- Info toko -->
  <div class="alert alert-success text-center" role="alert">
    Selamat datang di toko kamu! Berikut daftar produk yang kamu jual.
  </div>

  <!-- Tabel Produk -->
  <div class="card shadow-sm rounded-4">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="card-title mb-0">Produk Toko Kamu</h5>
        <a href="tambah-produk.html" class="btn btn-success btn-sm"><i class="bi bi-plus-circle"></i> Tambah Produk</a>
      </div>

      <div class="table-responsive">
        <table class="table table-striped align-middle">
          <thead class="table-success">
            <tr>
              <th>Gambar</th>
              <th>Nama Produk</th>
              <th>Harga</th>
              <th>Stok</th>
              <th>Kategori</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="daftar-produk">
            <!-- Diisi lewat JavaScript -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- JS Produk -->
<script>
  fetch('produk-penjual.php')
    .then(res => res.json())
    .then(data => {
      const tbody = document.getElementById('daftar-produk');
      if (data.length === 0) {
        tbody.innerHTML = `<tr><td colspan="6" class="text-center text-muted">Belum ada produk.</td></tr>`;
        return;
      }

      data.forEach(p => {
        tbody.innerHTML += `
          <tr>
            <td><img src="images/${p.gambar}" alt="${p.nama_produk}" width="80" class="rounded"></td>
            <td>${p.nama_produk}</td>
            <td>Rp${parseInt(p.harga).toLocaleString('id-ID')}</td>
            <td>${p.stok}</td>
            <td>${p.kategori}</td>
            <td>
              <a href="edit-produk.php?id=${p.id}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
              <a href="hapus-produk.php?id=${p.id}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus produk ini?')"><i class="bi bi-trash"></i></a>
            </td>
          </tr>`;
      });
    })
    .catch(err => {
      console.error(err);
      document.getElementById('daftar-produk').innerHTML = `<tr><td colspan="6" class="text-danger text-center">Gagal memuat produk.</td></tr>`;
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
