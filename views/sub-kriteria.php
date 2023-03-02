<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Sub Kriteria";
$_SESSION["page-url"] = "sub-kriteria";
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
                  <h2>Sub Kriteria</h2>
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
                                  <select name="id-kriteria" class="form-select" aria-label="Default select example" required>
                                    <option selected value="">Pilih Kriteria</option>
                                    <?php foreach ($kriteria as $data_k) : ?>
                                      <option value="<?= $data_k['id_kriteria'] ?>"><?= $data_k['kriteria'] ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                                <div class="mb-3">
                                  <label for="sub-kriteria" class="form-label">Sub Kriteria</label>
                                  <input type="text" name="sub-kriteria" value="<?php if (isset($_POST['sub-kriteria'])) {
                                                                                  echo $_POST['sub-kriteria'];
                                                                                } ?>" class="form-control" id="sub-kriteria" placeholder="Sub Kriteria" required>
                                </div>
                                <div class="mb-3">
                                  <label for="nilai-sub" class="form-label">Nilai Sub <span class="nilaiSub">0</span></label>
                                  <input type="range" name="nilai-sub" value="<?php if (isset($_POST['nilai-sub'])) {
                                                                                echo $_POST['nilai-sub'];
                                                                              } else {
                                                                                echo 0;
                                                                              } ?>" class="form-range" id="mySlider" placeholder="Bobot" min="0" max="100" required>
                                </div>
                              </div>
                              <div class="modal-footer border-top-0 justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" name="tambah-sub-kriteria" class="btn btn-primary text-white">Tambah</button>
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
                          <th class="text-center">Sub Kriteria</th>
                          <th class="text-center">Nilai Sub</th>
                          <th class="text-center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (mysqli_num_rows($sub_kriteria) > 0) {
                          while ($row = mysqli_fetch_assoc($sub_kriteria)) { ?>
                            <tr>
                              <td><?= $row['kriteria'] ?></td>
                              <td><?= $row['sub_kriteria'] ?></td>
                              <td><?= $row['nilai_sub'] ?></td>
                              <td class="text-center">
                                <a class="btn btn-warning p-2 text-white" class="btn btn-danger p-2 text-white" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_sub_kriteria'] ?>"><i class="bi bi-pencil-square"></i> Ubah</a>
                                <div class="modal fade" id="ubah<?= $row['id_sub_kriteria'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel"><?= $row['sub_kriteria'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="" method="post">
                                        <input type="hidden" name="id-sub-kriteria" value="<?= $row['id_sub_kriteria'] ?>">
                                        <div class="modal-body">
                                          <div class="mb-3">
                                            <label for="kriteria" class="form-label">Kriteria</label>
                                            <select name="id-kriteria" class="form-select" aria-label="Default select example" required>
                                              <option selected value="<?= $row['id_kriteria'] ?>"><?= $row['kriteria'] ?></option>
                                              <?php $id_kriteria = $row['id_kriteria'];
                                              $takeKriteria = mysqli_query($conn, "SELECT * FROM kriteria WHERE id_kriteria!='$id_kriteria'");
                                              foreach ($takeKriteria as $data_k) : ?>
                                                <option value="<?= $data_k['id_kriteria'] ?>"><?= $data_k['kriteria'] ?></option>
                                              <?php endforeach; ?>
                                            </select>
                                          </div>
                                          <div class="mb-3">
                                            <label for="sub-kriteria" class="form-label">Sub Kriteria</label>
                                            <input type="text" name="sub-kriteria" value="<?php if (isset($_POST['sub-kriteria'])) {
                                                                                            echo $_POST['sub-kriteria'];
                                                                                          } else {
                                                                                            echo $row['sub_kriteria'];
                                                                                          } ?>" class="form-control" id="sub-kriteria" placeholder="Sub Kriteria" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="nilai-sub" class="form-label">Nilai Sub <span class="nilaiSub<?= $row['id_sub_kriteria']?>"><?= $row['nilai_sub'] ?></span></label><br>
                                            <input type="range" name="nilai-sub" value="<?php if (isset($_POST['nilai-sub'])) {
                                                                                          echo $_POST['nilai-sub'];
                                                                                        } else {
                                                                                          echo $row['nilai_sub'];
                                                                                        } ?>" class="form-range" id="mySlider<?= $row['id_sub_kriteria']?>" placeholder="Bobot" min="0" max="100" required>
                                            <script>
                                              const slider<?= $row['id_sub_kriteria']?> = document.getElementById("mySlider<?= $row['id_sub_kriteria']?>");
                                              const output<?= $row['id_sub_kriteria']?> = document.querySelector(".nilaiSub<?= $row['id_sub_kriteria']?>");
                                              output<?= $row['id_sub_kriteria']?>.innerHTML = slider<?= $row['id_sub_kriteria']?>.value;

                                              slider<?= $row['id_sub_kriteria']?>.oninput = function() {
                                                output<?= $row['id_sub_kriteria']?>.innerHTML = this.value;
                                              }
                                            </script>
                                          </div>
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                          <button type="button" class="btn btn-secondary p-2" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" name="ubah-sub-kriteria" class="btn btn-warning p-2 text-white">Ubah</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                <a class="btn btn-danger p-2 text-white" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_sub_kriteria'] ?>"><i class="bi bi-trash3"></i> Hapus</a>
                                <div class="modal fade" id="hapus<?= $row['id_sub_kriteria'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel"><?= $row['sub_kriteria'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="" method="post">
                                        <input type="hidden" name="id-sub-kriteria" value="<?= $row['id_sub_kriteria'] ?>">
                                        <div class="modal-body">
                                          <p>Anda yakin ingin menghapus sub kriteria ini?</p>
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                          <button type="button" class="btn btn-secondary p-2" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" name="hapus-sub-kriteria" class="btn btn-danger p-2 text-white">Hapus</button>
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
          const output = document.querySelector(".nilaiSub");
          output.innerHTML = slider.value;

          slider.oninput = function() {
            output.innerHTML = this.value;
          }
        </script>
</body>

</html>