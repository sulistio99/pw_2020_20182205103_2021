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

function upload()
{
  $nama_file =  $_FILES['gambar']['name'];
  $type_file =  $_FILES['gambar']['type'];
  $ukuran_file =  $_FILES['gambar']['size'];
  $error =  $_FILES['gambar']['error'];
  $tmp_file =  $_FILES['gambar']['tmp_name'];

  // ketika tidak ada gambar dipilih
  // default foto
  if ($error == 4) {
    // echo "<script>
    // alert('pilih gambar terlebih dahulu!');
    // </script>";
    return 'nophoto.png';
  }

  // cek ekstensi file
  $daftar_gambar = ['jpg', 'jpeg', 'png'];
  $ekstensi_file = explode('.', $nama_file);
  $ekstensi_file = strtolower(end($ekstensi_file));
  if (!in_array($ekstensi_file, $daftar_gambar)) {
    echo "<script>
    alert('yang anda pilih bukan gambar');
    </script>";
    return false;
  }

  // cek type file
  if ($type_file != 'image/jpeg' && $type_file != 'image/png') {
    echo "<script>
    alert('yang anda pilih bukan gambar');
    </script>";
    return false;
  }

  // cek ukuran file
  // maksimal 5mb
  if ($ukuran_file > 5000000) {
    echo "<script>
    alert('ukuran gambar terlalu besar');
    </script>";
    return false;
  }

  // lolos pengekecekan sipa upload file
  // generate nama file
  $nama_file_baru = uniqid();
  $nama_file_baru .= '.';
  $nama_file_baru .= $ekstensi_file;
  move_uploaded_file($tmp_file, 'img/' . $nama_file_baru);
  return $nama_file_baru;
}

function tambah($data)
{
  $conn = koneksi();

  $nama = htmlspecialchars($data['nama']);
  $nrp = htmlspecialchars($data['nrp']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  // $gambar = htmlspecialchars($data['gambar']);

  $gambar = upload();
  if (!$gambar) {
    return false;
  }


  // pecah query insert
  $q_insert = "INSERT INTO mahasiswa VALUES
  (null, '$nama','$nrp','$email','$jurusan','$gambar')";
  mysqli_query($conn, $q_insert);

  // memunculkan error
  echo mysqli_error($conn);
  // kasih tau sql perubahan data masuk ke database berupa angka
  return mysqli_affected_rows($conn);
}

function hapus($id)
{
  $conn = koneksi();

  // menghapus gambar difolder
  $mhs = query("SELECT * FROM mahasiswa WHERE id = $id");
  if ($mhs['gambar'] != 'nophoto.png') {
    unlink('img/' . $mhs['gambar']);
  }
  mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id") or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function ubah($data)
{
  $conn = koneksi();

  $id = $data['id'];
  $nama = htmlspecialchars($data['nama']);
  $nrp = htmlspecialchars($data['nrp']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  $gambar_lama = htmlspecialchars($data['gambar_lama']);

  $gambar = upload();
  if (!$gambar) {
    return false;
  }

  if ($gambar == 'nophoto.png') {
    $gambar = $gambar_lama;
  }

  // pecah query insert
  $q_update = "UPDATE mahasiswa SET
  nama = '$nama', nrp = '$nrp', email = '$email', jurusan = '$jurusan', gambar = '$gambar' WHERE id = $id";
  mysqli_query($conn, $q_update);

  // memunculkan error
  echo mysqli_error($conn);
  // kasih tau sql perubahan data masuk ke database berupa angka
  return mysqli_affected_rows($conn);
}

function cari($keyword)
{
  $conn = koneksi();

  $query = "SELECT * FROM mahasiswa
  WHERE nama LIKE '%$keyword%' OR nrp LIKE '%$keyword%'
  ";
  $q_tampil = mysqli_query($conn, $query);

  // jika data banyak sekali
  $rows = [];
  while ($row = mysqli_fetch_assoc($q_tampil)) {
    $rows[] = $row;
  }
  return $rows;
}

function login($data)
{
  $conn = koneksi();

  $username = htmlspecialchars($data['username']);
  $password = htmlspecialchars($data['password']);
  // cek username dlu
  if ($user = query("SELECT * FROM user WHERE username = '$username' ")) {
    // cek password
    if (password_verify($password, $user['password'])) {
      $_SESSION['login'] = true;
      header("Location: index.php");
      exit;
    } else {
      return [
        'error' => true,
        'pesan' => 'username/password salah!'
      ];
    }
  }
}

function registrasi($data)
{
  $conn = koneksi();

  $username = htmlspecialchars($data['username']);
  $password1 = mysqli_real_escape_string($conn, $data['password1']);
  $password2 = mysqli_real_escape_string($conn, $data['password2']);

  // jika data disi kosong
  if ($username == "" || $password1 == "" || $password2 == "") {
    echo "<script>
    alert('username / password tidak boleh kosong');
    document.location.href='registrasi.php';
    </script>";
    return false;
  }

  // cek apakah username sudah terdaftar
  if (query("SELECT * FROM user WHERE username = '$username'")) {
    echo "<script>
    alert('Username telah terdaftar!');  
    document.location.href='registrasi.php';
    </script>";
    return false;
  }

  // cek password tidak sesuai
  if ($password1 !== $password2) {
    echo "<script>
    alert('konfirmasi password tidak sesuai');  
    document.location.href='registrasi.php';
    </script>";
    return false;
  }

  // cek panjang password
  if (strlen($password1) < 5) {
    echo "<script>
    alert('password terlalu pendek!');  
    document.location.href='registrasi.php';
    </script>";
    return false;
  }

  // jika username dan password sudah sesuai
  // enktripsi password
  $password_baru = password_hash($password1, PASSWORD_DEFAULT);
  // insert ke tabel
  $query = "INSERT INTO user VALUES
  (null, '$username', '$password_baru')";
  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}
