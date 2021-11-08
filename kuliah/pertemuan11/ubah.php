<?php
require 'functions.php';
// cek url id
if (!isset($_GET['id'])) {
  header("location: index.php");
  exit;
}

$id = $_GET['id'];

$m = query("SELECT * FROM mahasiswa WHERE id = $id");

// cek nilai data sql
if (isset($_POST['ubah'])) {
  if (ubah($_POST) > 0) {
    echo "<script>
    alert('Data Berhasil Diubah');
    document.location.href='index.php';
    </script>";
  } else {
    echo "<script>
    alert('Data Gagal Diubah');
    
    </script>";
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ubahh Data Mahasiswa</title>
</head>

<body>
  <h3>Form ubah data mahasiswa :</h3>
  <form action="" method="POST">
    <table>
      <tr>
        <td>
          <input type="hidden" name="id" value="<?= $m['id']; ?>">
          <label>
            Nama
            <input type="text" name="nama" autofocus value="<?= $m['nama']; ?>">
          </label>
        </td>
      </tr>
      <tr>
        <td>
          <label>
            nrp
            <input type="text" name="nrp" value="<?= $m['nrp']; ?>">
          </label>
        </td>
      </tr>
      <tr>
        <td>
          <label>
            Email
            <input type="text" name="email" value="<?= $m['email']; ?>">
          </label>
        </td>
      </tr>
      <tr>
        <td>
          <label>
            Jurusan
            <input type="text" name="jurusan" value="<?= $m['jurusan']; ?>">
          </label>
        </td>
      </tr>
      <tr>
        <td>
          <label>
            Gambar
            <input type="file" name="gambar" value="<?= $m['gambar']; ?>">
          </label>
        </td>
      </tr>
      <tr>
        <td>
          <button type="submit" name="ubah">Ubah</button>
          <button type="reset">Reset</button>
        </td>
      </tr>
    </table>
  </form>
</body>

</html>