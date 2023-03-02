<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Kriteria";
$_SESSION["page-url"] = "kriteria";
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
                  <h2>Kriteria</h2>
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
                                  <label for="kriteria" class="form-label">Kriteria</label>
                                  <input type="text" name="kriteria" value="<?php if (isset($_POST['kriteria'])) {
                                                                              echo $_POST['kriteria'];
                                                                            } ?>" class="form-control" id="kriteria" placeholder="Kriteria" required>
                                </div>
                                <div class="mb-3">
                                  <label for="bobot" class="form-label">Bobot <span class="nilaiBobot">0</span></label>
                                  <input type="range" name="bobot" value="<?php if (isset($_POST['bobot'])) {
                                                                            echo $_POST['bobot'];
                                                                          } else {
                                                                            echo 0;
                                                                          } ?>" class="form-range" id="mySlider" placeholder="Bobot" min="0" max="10" step="0.001" required>
                                </div>
                                <div class="mb-3">
                                  <label for="type" class="form-label">Tipe</label>
                                  <select name="type" class="form-select" aria-label="Default select example" required>
                                    <option selected value="">Pilih Tipe</option>
                                    <option value="Benefit">Benefit</option>
                                    <option value="Cost">Cost</option>
                                  </select>
                                </div>
                              </div>
                              <div class="modal-footer border-top-0 justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" name="tambah-kriteria" class="btn btn-primary text-white">Tambah</button>
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
                          <th class="text-center">Kriteria</th>
                          <th class="text-center">Tipe</th>
                          <th class="text-center">Bobot</th>
                          <th class="text-center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (mysqli_num_rows($kriteria) > 0) {
                          while ($row = mysqli_fetch_assoc($kriteria)) { ?>
                            <tr>
                              <td><?= $row['kriteria'] ?></td>
                              <td><?= $row['bobot'] ?></td>
                              <td><?= $row['type'] ?></td>
                              <td class="text-center">
                                <a class="btn btn-warning p-2 text-white" class="btn btn-danger p-2 text-white" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_kriteria'] ?>"><i class="bi bi-pencil-square"></i> Ubah</a>
                                <div class="modal fade" id="ubah<?= $row['id_kriteria'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel"><?= $row['kriteria'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="" method="post">
                                        <input type="hidden" name="id-kriteria" value="<?= $row['id_kriteria'] ?>">
                                        <div class="modal-body">
                                          <div class="mb-3">
                                            <label for="kriteria" class="form-label">Kriteria</label>
                                            <input type="text" name="kriteria" value="<?php if (isset($_POST['kriteria'])) {
                                                                                        echo $_POST['kriteria'];
                                                                                      } else {
                                                                                        echo $row['kriteria'];
                                                                                      } ?>" class="form-control" id="kriteria" placeholder="Nama Lengkap" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="bobot" class="form-label">Bobot <span class="nilaiBobot<?= $row['id_kriteria'] ?>"><?= $row['bobot'] ?></span></label><br>
                                            <input type="range" name="bobot" value="<?php if (isset($_POST['bobot'])) {
                                                                                      echo $_POST['bobot'];
                                                                                    } else {
                                                                                      echo $row['bobot'];
                                                                                    } ?>" class="form-range" id="mySlider<?= $row['id_kriteria'] ?>" placeholder="Bobot" min="0" max="10" step="0.001" required>
                                            <script>
                                              const slider<?= $row['id_kriteria'] ?> = document.getElementById("mySlider<?= $row['id_kriteria'] ?>");
                                              const output<?= $row['id_kriteria'] ?> = document.querySelector(".nilaiBobot<?= $row['id_kriteria'] ?>");
                                              output<?= $row['id_kriteria'] ?>.innerHTML = slider<?= $row['id_kriteria'] ?>.value;

                                              slider<?= $row['id_kriteria'] ?>.oninput = function() {
                                                output<?= $row['id_kriteria'] ?>.innerHTML = this.value;
                                              }
                                            </script>
                                          </div>
                                          <div class="mb-3">
                                            <label for="type" class="form-label">Tipe</label>
                                            <select name="type" class="form-select" aria-label="Default select example" required>
                                              <?php if ($row['type'] == "Benefit") { ?>
                                                <option value="Benefit">Benefit</option>
                                              <?php } else { ?>
                                                <option value="Cost">Cost</option>
                                              <?php }
                                              if ($row['type'] == "Cost") { ?>
                                                <option value="Benefit">Benefit</option>
                                              <?php } else { ?>
                                                <option value="Cost">Cost</option>
                                              <?php } ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                          <button type="button" class="btn btn-secondary p-2" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" name="ubah-kriteria" class="btn btn-warning p-2 text-white">Ubah</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                <a class="btn btn-danger p-2 text-white" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_kriteria'] ?>"><i class="bi bi-trash3"></i> Hapus</a>
                                <div class="modal fade" id="hapus<?= $row['id_kriteria'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel"><?= $row['kriteria'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="" method="post">
                                        <input type="hidden" name="id-kriteria" value="<?= $row['id_kriteria'] ?>">
                                        <div class="modal-body">
                                          <p>Anda yakin ingin menghapus kriteria ini?</p>
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                          <button type="button" class="btn btn-secondary p-2" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" name="hapus-kriteria" class="btn btn-danger p-2 text-white">Hapus</button>
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
        <script>
          const slider = document.getElementById("mySlider");
          const output = document.querySelector(".nilaiBobot");
          output.innerHTML = slider.value;

          slider.oninput = function() {
            output.innerHTML = this.value;
          }
        </script>
</body>

</html>