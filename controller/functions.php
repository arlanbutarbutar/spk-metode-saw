<?php
if (!isset($_SESSION["data-user"])) {
  function masuk($data)
  {
    global $conn;
    $email = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["email"]))));
    $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["password"]))));

    // check account
    $checkAccount = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($checkAccount) == 0) {
      $_SESSION["message-danger"] = "Maaf, akun yang anda masukan belum terdaftar.";
      $_SESSION["time-message"] = time();
      return false;
    } else if (mysqli_num_rows($checkAccount) > 0) {
      $row = mysqli_fetch_assoc($checkAccount);
      if (password_verify($password, $row["password"])) {
        $_SESSION["data-user"] = [
          "id" => $row["id_user"],
          "role" => $row["id_role"],
          "email" => $row["email"],
          "username" => $row["username"],
        ];
      } else {
        $_SESSION["message-danger"] = "Maaf, kata sandi yang anda masukan salah.";
        $_SESSION["time-message"] = time();
        return false;
      }
    }
  }
}
if (isset($_SESSION["data-user"])) {
  function edit_profile($data)
  {
    global $conn, $idUser;
    $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["username"]))));
    $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["password"]))));
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "UPDATE users SET username='$username', password='$password' WHERE id_user='$idUser'");
    return mysqli_affected_rows($conn);
  }
  function add_user($data)
  {
    global $conn;
    $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["username"]))));
    $email = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["email"]))));
    $checkEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($checkEmail) > 0) {
      $_SESSION["message-danger"] = "Maaf, email yang anda masukan sudah terdaftar.";
      $_SESSION["time-message"] = time();
      return false;
    }
    $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["password"]))));
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users(username,email,password) VALUES('$username','$email','$password')");
    return mysqli_affected_rows($conn);
  }
  function edit_user($data)
  {
    global $conn, $time;
    $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["id-user"]))));
    $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["username"]))));
    $email = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["email"]))));
    $emailOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["emailOld"]))));
    if ($email != $emailOld) {
      $checkEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
      if (mysqli_num_rows($checkEmail) > 0) {
        $_SESSION["message-danger"] = "Maaf, email yang anda masukan sudah terdaftar.";
        $_SESSION["time-message"] = time();
        return false;
      }
    }
    mysqli_query($conn, "UPDATE users SET username='$username', email='$email', updated_at=CURRENT_TIMESTAMP WHERE id_user='$id_user'");
    return mysqli_affected_rows($conn);
  }
  function delete_user($data)
  {
    global $conn;
    $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["id-user"]))));
    mysqli_query($conn, "DELETE FROM users WHERE id_user='$id_user'");
    return mysqli_affected_rows($conn);
  }
  function tambah_kriteria($data)
  {
    global $conn;
    $kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kriteria']))));
    $kriteria = strtoupper($kriteria);
    $checkKode = mysqli_query($conn, "SELECT * FROM kriteria WHERE kriteria LIKE '%$kriteria%'");
    if (mysqli_num_rows($checkKode) > 0) {
      $_SESSION["message-danger"] = "Maaf, kriteria sudah ada.";
      $_SESSION["time-message"] = time();
      return false;
    }
    $type = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['type']))));
    $bobot = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['bobot']))));
    mysqli_query($conn, "INSERT INTO kriteria(kriteria,bobot,type) VALUES('$kriteria','$bobot','$type')");
    return mysqli_affected_rows($conn);
  }
  function ubah_kriteria($data)
  {
    global $conn;
    $id_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-kriteria']))));
    $kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kriteria']))));
    $kriteria = strtoupper($kriteria);
    $kriteriaOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kriteriaOld']))));
    if ($kriteria != $kriteriaOld) {
      $checkKode = mysqli_query($conn, "SELECT * FROM kriteria WHERE kode_kriteria LIKE '%$kriteria%'");
      if (mysqli_num_rows($checkKode) > 0) {
        $_SESSION["message-danger"] = "Maaf, kode kriteria sudah ada.";
        $_SESSION["time-message"] = time();
        return false;
      }
    }
    $type = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['type']))));
    $bobot = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['bobot']))));
    mysqli_query($conn, "UPDATE kriteria SET kriteria='$kriteria', bobot='$bobot', type='$type' WHERE id_kriteria='$id_kriteria'");
    return mysqli_affected_rows($conn);
  }
  function hapus_kriteria($data)
  {
    global $conn;
    $id_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-kriteria']))));
    mysqli_query($conn, "DELETE FROM kriteria WHERE id_kriteria='$id_kriteria'");
    return mysqli_affected_rows($conn);
  }
  function tambah_sub_kriteria($data)
  {
    global $conn;
    $id_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-kriteria']))));
    $sub_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['sub-kriteria']))));
    $nilai_sub = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nilai-sub']))));
    mysqli_query($conn, "INSERT INTO sub_kriteria(id_kriteria,sub_kriteria,nilai_sub) VALUES('$id_kriteria','$sub_kriteria','$nilai_sub')");
    return mysqli_affected_rows($conn);
  }
  function ubah_sub_kriteria($data)
  {
    global $conn;
    $id_sub_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-sub-kriteria']))));
    $id_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-kriteria']))));
    $sub_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['sub-kriteria']))));
    $nilai_sub = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nilai-sub']))));
    mysqli_query($conn, "UPDATE sub_kriteria SET id_kriteria='$id_kriteria', sub_kriteria='$sub_kriteria', nilai_sub='$nilai_sub' WHERE id_sub_kriteria='$id_sub_kriteria'");
    return mysqli_affected_rows($conn);
  }
  function hapus_sub_kriteria($data)
  {
    global $conn;
    $id_sub_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-sub-kriteria']))));
    mysqli_query($conn, "DELETE FROM sub_kriteria WHERE id_sub_kriteria='$id_sub_kriteria'");
    return mysqli_affected_rows($conn);
  }
  function tambah_warga($data)
  {
    global $conn;
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $jk = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jk']))));
    $tgl = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tgl']))));
    $alamat = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['alamat']))));
    mysqli_query($conn, "INSERT INTO warga(nama,jenis_kelamin, tanggal_lahir, alamat) VALUES('$nama','$jk','$tgl','$alamat')");
    return mysqli_affected_rows($conn);
  }
  function ubah_warga($data)
  {
    global $conn;
    $id_warga = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-warga']))));
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $jk = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jk']))));
    $tgl = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tgl']))));
    $alamat = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['alamat']))));
    mysqli_query($conn, "UPDATE warga SET nama='$nama', jenis_kelamin='$jk', tanggal_lahir='$tgl', alamat='$alamat', updated_at=CURRENT_TIMESTAMP WHERE id_warga='$id_warga'");
    return mysqli_affected_rows($conn);
  }
  function hapus_warga($data)
  {
    global $conn;
    $id_warga = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-warga']))));
    mysqli_query($conn, "DELETE FROM hasil_keputusan WHERE id_warga='$id_warga'");
    mysqli_query($conn, "DELETE FROM warga WHERE id_warga='$id_warga'");
    return mysqli_affected_rows($conn);
  }
}
