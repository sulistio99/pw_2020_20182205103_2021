<?php
function koneksi()
{
  return mysqli_connect('localhost', 'root', '', 'pw_20182205103_2021');
}

function query($query)
{
  $conn = koneksi();

  $q_tampil = mysqli_query($conn, $query);

  // jika data hanya sebanyak 1
  if (mysqli_num_rows($q_tampil) == 1) {
    return mysqli_fetch_assoc($q_tampil);
  }
  // jika data banyak sekali
  $rows = [];
  while ($row = mysqli_fetch_assoc($q_tampil)) {
    $rows[] = $row;
  }
  return $rows;
}


function tambah($data)
{
  $conn = koneksi();

  $nama = $data['nama'];
  $nrp = $data['nrp'];
  $email = $data['email'];
  $jurusan = $data['jurusan'];
  $gambar = $data['gambar'];

  // pecah query insert
  $q_insert = "INSERT INTO mahasiswa VALUES
  (null, '$nama','$nrp','$email','$jurusan','$gambar')";
  mysqli_query($conn, $q_insert);

  // memunculkan error
  echo mysqli_error($conn);
  // kasih tau sql perubahan data masuk ke database berupa angka
  return mysqli_affected_rows($conn);
}
