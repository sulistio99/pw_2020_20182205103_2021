<?php
// Konek Database Dan Tampil Data
$conn = mysqli_connect('localhost', 'root', '', 'pw_20182205103_2021');

$result = mysqli_query($conn, "SELECT * FROM mahasiswa");

$rows = [];
while ($row = mysqli_fetch_assoc($result)) {
  $rows[] = $row;
}

$mahasiswa = $rows;
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
        <th>NRP</th>
        <th>NAMA</th>
        <th>EMAIL</th>
        <th>JURUSAN</th>
        <th>AKSI</th>
      </tr>
      <?php
      $i = 1;
      foreach ($mahasiswa as $m) : ?>
        <tr>
          <td><?= $i++; ?></td>
          <td><img src="img/<?= $m['gambar']; ?>" alt="" width="50px"></td>
          <td><?= $m['nrp']; ?></td>
          <td><?= $m['nama']; ?></td>
          <td><?= $m['email']; ?></td>
          <td><?= $m['jurusan']; ?></td>
          <td><a href="">Edit</a> | <a href="">Hapus</a></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </form>
</body>

</html>