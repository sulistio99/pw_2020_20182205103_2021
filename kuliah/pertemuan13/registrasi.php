<?php
session_start();
if (isset($_SESSION['login'])) {
  header("Location: index.php");
  exit;
}

require 'functions.php';

if (isset($_POST['daftar'])) {
  if (registrasi($_POST) > 0) {
    echo "<script>
    alert('user baru telah ditambahkan');  
    document.location.href='login.php';
    </script>";
  } else {
    echo "<script>
    alert('user gagal ditambahkan');  
    document.location.href='login.php';
    </script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form registrasi</title>
</head>

<body>
  <h3>Form Registrasi</h3>
  <form action="" method="POST">
    <table>
      <tr>
        <td>
          Username
        </td>
        <td>
          :
        </td>
        <td>
          <input type="text" name="username" required autocomplete="off" autofocus>
        </td>
      </tr>
      <tr>
        <td>
          Password
        </td>
        <td>
          :
        </td>
        <td>
          <input type="password" name="password1" required>
        </td>
      </tr>
      <tr>
        <td>
          Konfirmasi Password
        </td>
        <td>
          :
        </td>
        <td>
          <input type="password" name="password2" required>
        </td>
      </tr>
      <tr>
        <td>
          <button type="submit" name="daftar">Daftar</button>
        </td>
      </tr>
    </table>
  </form>
</body>

</html>