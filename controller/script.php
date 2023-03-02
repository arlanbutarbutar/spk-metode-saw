
<?php
error_reporting(~E_NOTICE & ~E_DEPRECATED);
if (!isset($_SESSION[""])) {
  session_start();
}
require_once("db_connect.php");
require_once("time.php");
require_once("functions.php");
if (isset($_SESSION["time-message"])) {
  if ((time() - $_SESSION["time-message"]) > 2) {
    if (isset($_SESSION["message-success"])) {
      unset($_SESSION["message-success"]);
    }
    if (isset($_SESSION["message-info"])) {
      unset($_SESSION["message-info"]);
    }
    if (isset($_SESSION["message-warning"])) {
      unset($_SESSION["message-warning"]);
    }
    if (isset($_SESSION["message-danger"])) {
      unset($_SESSION["message-danger"]);
    }
    if (isset($_SESSION["message-dark"])) {
      unset($_SESSION["message-dark"]);
    }
    unset($_SESSION["time-alert"]);
  }
}

$baseURL = "http://$_SERVER[HTTP_HOST]/apps/spk-metode-saw/";

if (!isset($_SESSION["data-user"])) {
  if (isset($_POST["masuk"])) {
    if (masuk($_POST) > 0) {
      header("Location: ../views/");
      exit();
    }
  }
}

if (isset($_SESSION["data-user"])) {
  $idUser = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION["data-user"]["id"]))));

  $profile = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$idUser'");
  if (isset($_POST["ubah-profile"])) {
    if (edit_profile($_POST) > 0) {
      $_SESSION["message-success"] = "Profil akun anda berhasil di ubah.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }

  // Pengguna
  $users = mysqli_query($conn, "SELECT * FROM users WHERE id_user!='$idUser' ORDER BY id_user DESC");
  if (isset($_POST["tambah-user"])) {
    if (add_user($_POST) > 0) {
      $_SESSION["message-success"] = "Pengguna " . $_POST["username"] . " berhasil ditambahkan.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["ubah-user"])) {
    if (edit_user($_POST) > 0) {
      $_SESSION["message-success"] = "Pengguna " . $_POST["usernameOld"] . " berhasil diubah.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["hapus-user"])) {
    if (delete_user($_POST) > 0) {
      $_SESSION["message-success"] = "Pengguna " . $_POST["username"] . " berhasil dihapus.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }

  // Kriteria
  $kriteria = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id_kriteria DESC");
  if (isset($_POST["tambah-kriteria"])) {
    if (tambah_kriteria($_POST) > 0) {
      $_SESSION["message-success"] = "Data berhasil ditambahkan.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["ubah-kriteria"])) {
    if (ubah_kriteria($_POST) > 0) {
      $_SESSION["message-success"] = "Data berhasil diubah.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["hapus-kriteria"])) {
    if (hapus_kriteria($_POST) > 0) {
      $_SESSION["message-success"] = "Data berhasil dihapus.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }

  // Sub Kriteria
  $sub_kriteria = mysqli_query($conn, "SELECT sub_kriteria.*, kriteria.kriteria FROM sub_kriteria JOIN kriteria ON sub_kriteria.id_kriteria=kriteria.id_kriteria");
  if (isset($_POST["tambah-sub-kriteria"])) {
    if (tambah_sub_kriteria($_POST) > 0) {
      $_SESSION["message-success"] = "Data berhasil ditambahkan.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["ubah-sub-kriteria"])) {
    if (ubah_sub_kriteria($_POST) > 0) {
      $_SESSION["message-success"] = "Data berhasil diubah.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["hapus-sub-kriteria"])) {
    if (hapus_sub_kriteria($_POST) > 0) {
      $_SESSION["message-success"] = "Data berhasil dihapus.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }

  // Warga
  $warga=mysqli_query($conn, "SELECT * FROM warga");
  if (isset($_POST["tambah-warga"])) {
    if (tambah_warga($_POST) > 0) {
      $_SESSION["message-success"] = "Data berhasil ditambahkan.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["ubah-warga"])) {
    if (ubah_warga($_POST) > 0) {
      $_SESSION["message-success"] = "Data berhasil diubah.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["hapus-warga"])) {
    if (hapus_warga($_POST) > 0) {
      $_SESSION["message-success"] = "Data berhasil dihapus.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
}
