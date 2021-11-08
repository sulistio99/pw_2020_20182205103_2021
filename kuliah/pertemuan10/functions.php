<?php
function koneksi()
{
  return mysqli_connect('localhost', 'root', '', 'pw_20182205103_2021');
}

function query($query)
{
  $conn = koneksi();

  $q_tampil = mysqli_query($conn, $query);

  if (mysqli_num_rows($q_tampil) == 1) {
    return mysqli_fetch_assoc($q_tampil);
  }

  $rows = [];
  while ($row = mysqli_fetch_assoc($q_tampil)) {
    $rows[] = $row;
  }
  return $rows;
}
