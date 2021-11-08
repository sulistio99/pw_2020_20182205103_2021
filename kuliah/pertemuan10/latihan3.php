<?php
require 'functions.php';
// Konek Database Dan Tampil Data

$mahasiswa = query("SELECT * FROM mahasiswa");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Nahasiswa</title>
</head>

<body>
  <h2>Daftar Mahasiswa</h2>
  <form action="">
    <table border="1" cellpadding="10" cellspacing="0">
      <tr>
        <th>#</th>
        <th>Gambar</th>
        <th>NAMA</th>
        <th>AKSI</th>
      </tr>
      <?php
      $i = 1;
      foreach ($mahasiswa as $m) : ?>
        <tr>
          <td><?= $i++; ?></td>
          <td><img src="img/<?= $m['gambar']; ?>" alt="" width="50px"></td>
          <td><?= $m['nama']; ?></td>
          <td><a href="detail.php?id=<?= $m['id']; ?>">Lihat Detail</a></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </form>
</body>

</html>