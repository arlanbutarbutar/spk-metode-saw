<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Warga";
$_SESSION["page-url"] = "warga";
?>

<!DOCTYPE html>
<html lang="en">

<head><?php require_once("../resources/dash-header.php") ?></head>

<body>
  <?php if (isset($_SESSION["message-success"])) { ?>
    <div class="message-success" data-message-success="<?= $_SESSION["message-success"] ?>"></div>
  <?php }
  if (isset($_SESSION["message-info"])) { ?>
    <div class="message-info" data-message-info="<?= $_SESSION["message-info"] ?>"></div>
  <?php }
  if (isset($_SESSION["message-warning"])) { ?>
    <div class="message-warning" data-message-warning="<?= $_SESSION["message-warning"] ?>"></div>
  <?php }
  if (isset($_SESSION["message-danger"])) { ?>
    <div class="message-danger" data-message-danger="<?= $_SESSION["message-danger"] ?>"></div>
  <?php } ?>
  <div class="container-scroller">
    <?php require_once("../resources/dash-topbar.php") ?>
    <div class="container-fluid page-body-wrapper">
      <?php require_once("../resources/dash-sidebar.php") ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <h2>Warga</h2>
                  <div>
                    <div class="btn-wrapper">
                      <a href="#" class="btn btn-primary text-white me-0" data-bs-toggle="modal" data-bs-target="#tambah"><i class="bi bi-plus-lg"></i> Tambah</a>
                      <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header border-bottom-0 shadow">
                              <h5 class="modal-title" id="exampleModalLabel">Tambah Kriteria</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="post">
                              <div class="modal-body">
                                <div class="mb-3">
                                  <label for="nama" class="form-label">Nama</label>
                                  <input type="text" name="nama" value="<?php if (isset($_POST['nama'])) {
                                                                          echo $_POST['nama'];
                                                                        } ?>" class="form-control" id="nama" placeholder="Nama" required>
                                </div>
                                <div class="mb-3">
                                  <label for="jk" class="form-label">Jenis Kelamin</label>
                                  <select name="jk" class="form-select" id="jk" required>
                                    <option selected value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                  </select>
                                </div>
                                <div class="mb-3">
                                  <label for="tgl" class="form-label">Tanggal Lahir</label>
                                  <input type="date" name="tgl" value="<?php if (isset($_POST['tgl'])) {
                                                                          echo $_POST['tgl'];
                                                                        } ?>" class="form-control" id="tgl" placeholder="Tanggal Lahir" required>
                                </div>
                                <div class="mb-3">
                                  <label for="alamat" class="form-label">Alamat</label>
                                  <input type="text" name="alamat" value="<?php if (isset($_POST['alamat'])) {
                                                                            echo $_POST['alamat'];
                                                                          } ?>" class="form-control" id="alamat" placeholder="Alamat" required>
                                </div>
                              </div>
                              <div class="modal-footer border-top-0 justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" name="tambah-warga" class="btn btn-primary text-white">Tambah</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="data-main">
                  <div class="table-responsive mt-3">
                    <table class="display table table-bordered table-striped table-sm" id="datatable">
                      <thead>
                        <tr>
                          <th class="text-center">Nama</th>
                          <th class="text-center">Jenis Kelamin</th>
                          <th class="text-center">Tanggal Lahir</th>
                          <th class="text-center">Alamat</th>
                          <th class="text-center">Tgl Buat</th>
                          <th class="text-center">Tgl Ubah</th>
                          <th class="text-center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (mysqli_num_rows($warga) > 0) {
                          while ($row = mysqli_fetch_assoc($warga)) { ?>
                            <tr>
                              <td><?= $row['nama'] ?></td>
                              <td><?= $row['jenis_kelamin'] ?></td>
                              <td>
                                <?php $dateCreate = date_create($row["tanggal_lahir"]);
                                echo date_format($dateCreate, "d M Y"); ?>
                              </td>
                              <td><?= $row['alamat'] ?></td>
                              <td>
                                <div class="badge badge-opacity-success">
                                  <?php $dateCreate = date_create($row["created_at"]);
                                  echo date_format($dateCreate, "l, d M Y h:i a"); ?>
                                </div>
                              </td>
                              <td>
                                <div class="badge badge-opacity-warning">
                                  <?php $dateUpdate = date_create($row["updated_at"]);
                                  echo date_format($dateUpdate, "l, d M Y h:i a"); ?>
                                </div>
                              </td>
                              <td class="text-center">
                                <a class="btn btn-warning p-2 text-white" class="btn btn-danger p-2 text-white" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_warga'] ?>"><i class="bi bi-pencil-square"></i> Ubah</a>
                                <div class="modal fade" id="ubah<?= $row['id_warga'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel"><?= $row['nama'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="" method="post">
                                        <input type="hidden" name="id-warga" value="<?= $row['id_warga'] ?>">
                                        <div class="modal-body">
                                          <div class="mb-3">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="text" name="nama" value="<?php if (isset($_POST['nama'])) {
                                                                                    echo $_POST['nama'];
                                                                                  } else {
                                                                                    echo $row['nama'];
                                                                                  } ?>" class="form-control" id="nama" placeholder="Nama" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="jk" class="form-label">Jenis Kelamin</label>
                                            <select name="jk" class="form-select" id="jk" required>
                                              <?php if ($row['jenis_kelamin'] == "L") { ?>
                                                <option value="L">Laki-Laki</option>
                                              <?php } else { ?>
                                                <option value="P">Perempuan</option>
                                              <?php }
                                              if ($row['jenis_kelamin'] == "P") { ?>
                                                <option value="L">Laki-Laki</option>
                                              <?php } else { ?>
                                                <option value="P">Perempuan</option>
                                              <?php } ?>
                                            </select>
                                          </div>
                                          <div class="mb-3">
                                            <label for="tgl" class="form-label">Tanggal Lahir</label>
                                            <input type="date" name="tgl" value="<?php if (isset($_POST['tgl'])) {
                                                                                    echo $_POST['tgl'];
                                                                                  } else {
                                                                                    echo $row['tanggal_lahir'];
                                                                                  } ?>" class="form-control" id="tgl" placeholder="Tanggal Lahir" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <input type="text" name="alamat" value="<?php if (isset($_POST['alamat'])) {
                                                                                      echo $_POST['alamat'];
                                                                                    } else {
                                                                                      echo $row['alamat'];
                                                                                    } ?>" class="form-control" id="alamat" placeholder="Alamat" required>
                                          </div>
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                          <button type="button" class="btn btn-secondary p-2" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" name="ubah-warga" class="btn btn-warning p-2 text-white">Ubah</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                <a class="btn btn-danger p-2 text-white" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_warga'] ?>"><i class="bi bi-trash3"></i> Hapus</a>
                                <div class="modal fade" id="hapus<?= $row['id_warga'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel"><?= $row['warga'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="" method="post">
                                        <input type="hidden" name="id-warga" value="<?= $row['id_warga'] ?>">
                                        <div class="modal-body">
                                          <p>Anda yakin ingin menghapus warga ini?</p>
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                          <button type="button" class="btn btn-secondary p-2" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" name="hapus-warga" class="btn btn-danger p-2 text-white">Hapus</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </td>
                            </tr>
                        <?php }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>