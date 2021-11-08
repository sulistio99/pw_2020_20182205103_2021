<?php
require 'functions.php';
$id = $_GET['id'];
$m = query("SELECT * FROM mahasiswa WHERE id = $id");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Mahasiswa</title>
</head>

<body>
  <h3>Detail Mahasiswa</h3>
  <td><a href="latihan3.php">Home</a></td>
  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>NAMA</th>
      <th>NRP</th>
      <th>EMAIL</th>
      <th>JURUSAN</th>
      <th>AKSI</th>
    </tr>
    <tr>
      <td><?= $m['nama']; ?></td>
      <td><?= $m['nrp']; ?></td>
      <td><?= $m['email']; ?></td>
      <td><?= $m['jurusan']; ?></td>
      <td><a href="">Edit</a> | <a href="">Hapus</a></td>
    </tr>
  </table>
</body>

</html>