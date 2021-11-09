<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';
if (isset($_POST['tambah'])) {
  // cek nilai data sql
  if (tambah($_POST) > 0) {
    echo "<script>
    alert('Data Berhasil Ditambahkan');
    document.location.href='index.php';
    </script>";
  } else {
    echo "<script>
    alert('Data Gagal Ditambahkan');
    </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Mahasiswa</title>
</head>

<body>
  <h3>Form isi data mahasiswa :</h3>
  <form action="" method="POST" enctype="multipart/form-data">
    <table>
      <tr>
        <td>
          <label>
            Nama
            <input type="text" name="nama" autofocus>
          </label>
        </td>
      </tr>
      <tr>
        <td>
          <label>
            nrp
            <input type="text" name="nrp">
          </label>
        </td>
      </tr>
      <tr>
        <td>
          <label>
            Email
            <input type="text" name="email">
          </label>
        </td>
      </tr>
      <tr>
        <td>
          <label>
            Jurusan
            <input type="text" name="jurusan">
          </label>
        </td>
      </tr>
      <tr>
        <td>
          <label>
            Gambar
            <input type="file" name="gambar" class="gambar" onchange="previewImage()">
          </label>
          <img src="img/nophoto.png" alt="" width="120" style="display:block;" class="img-preview">
        </td>
      </tr>
      <tr>
        <td>
          <button type="submit" name="tambah">Tambah</button>
          <button type="reset">Reset</button>
        </td>
      </tr>
    </table>
  </form>
  <script src="js/script.js"></script>
</body>

</html>