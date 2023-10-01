<?php
include('connection.php');
require('layout/header.php');

session_start();

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:login.php');
}


if (isset($_POST['submit_add_edu'])) {
    $edu_name = $_POST['eduname'];
    $edu_name = filter_var(htmlspecialchars($edu_name));
    $edu_year = $_POST['eduyear'];
    $edu_year = filter_var(htmlspecialchars($edu_year));
    $edu_desc = $_POST['edudesc'];
    $edu_desc = filter_var(htmlspecialchars($edu_desc));

    $select_edu = $conn->prepare("SELECT * FROM `educations` WHERE eduname = ?");
    $select_edu->execute([$edu_name]);

    if ($select_edu->rowCount() > 0) {
        $message[] = 'Data pendidikan sudah tersedia';
    } else {

        $insert_edu = $conn->prepare("INSERT INTO `educations`(eduname, eduyear, edudesc) VALUES (?,?,?)");
        $insert_edu->execute([$edu_name, $edu_year, $edu_desc]);

        $message[] = 'Data pendidikan baru berhasil di simpan';
        header('location:admin_controls.php');
    }
}

if (isset($_POST['submit_add_exp'])) {
    $exp_name = $_POST['expname'];
    $exp_name = filter_var(htmlspecialchars($exp_name));
    $exp_year = $_POST['expyear'];
    $exp_year = filter_var(htmlspecialchars($exp_year));
    $exp_desc = $_POST['expdesc'];
    $exp_desc = filter_var(htmlspecialchars($exp_desc));

    $select_exp = $conn->prepare("SELECT * FROM `experiences` WHERE expname = ?");
    $select_exp->execute([$exp_name]);

    if ($select_exp->rowCount() > 0) {
        $message[] = 'Data pengalaman sudah tersedia';
    } else {

        $insert_exp = $conn->prepare("INSERT INTO `experiences`(expname, expyear, expdesc) VALUES (?,?,?)");
        $insert_exp->execute([$exp_name, $exp_year, $exp_desc]);

        $message[] = 'Data pengalaman baru berhasil di simpan';
        header('location:admin_controls.php');
    }
}

if (isset($_GET['delete_edu'])) {
    $delete_id = $_GET['delete_edu'];
    $delete_edu = $conn->prepare("DELETE FROM `educations` WHERE eduid = ?");
    $delete_edu->execute([$delete_id]);

    header('location:admin_controls.php');
}
if (isset($_GET['delete_exp'])) {
    $delete_id = $_GET['delete_exp'];
    $delete_exp = $conn->prepare("DELETE FROM `experiences` WHERE expid = ?");
    $delete_exp->execute([$delete_id]);

    header('location:admin_controls.php');
}
if (isset($_POST['submit_add_hs'])) {
    $hsname = $_POST['hsname'];
    $hsname = filter_var(htmlspecialchars($hsname));
    $hslevel = $_POST['hslevel'];
    $hslevel = filter_var(htmlspecialchars($hslevel));

    $select_hs = $conn->prepare("SELECT * FROM `hardskills` WHERE hsname = ?");
    $select_hs->execute([$hsname]);

    if ($select_hs->rowCount() > 0) {
        $message[] = 'Data hardskill sudah tersedia';
    } else {

        $insert_hs = $conn->prepare("INSERT INTO `hardskills`(hsname, hslevel) VALUES (?,?)");
        $insert_hs->execute([$hsname, $hslevel]);

        $message[] = 'Data hardskill baru berhasil di simpan';
        header('location:admin_controls.php');
    }
}
if (isset($_GET['delete_hs'])) {
    $delete_id = $_GET['delete_hs'];
    $delete_hs = $conn->prepare("DELETE FROM `hardskills` WHERE hsid = ?");
    $delete_hs->execute([$delete_id]);

    header('location:admin_controls.php');
}
if (isset($_POST['submit_add_ss'])) {
    $ssname = $_POST['ssname'];
    $ssname = filter_var(htmlspecialchars($ssname));
    $sslevel = $_POST['sslevel'];
    $sslevel = filter_var(htmlspecialchars($sslevel));

    $select_ss = $conn->prepare("SELECT * FROM `softskills` WHERE ssname = ?");
    $select_ss->execute([$ssname]);

    if ($select_ss->rowCount() > 0) {
        $message[] = 'Data softskill sudah tersedia';
    } else {

        $insert_ss = $conn->prepare("INSERT INTO `softskills`(ssname, sslevel) VALUES (?,?)");
        $insert_ss->execute([$ssname, $sslevel]);

        $message[] = 'Data softskill baru berhasil di simpan';
        header('location:admin_controls.php');
    }
}
if (isset($_GET['delete_ss'])) {
    $delete_id = $_GET['delete_ss'];
    $delete_ss = $conn->prepare("DELETE FROM `softskills` WHERE ssid = ?");
    $delete_ss->execute([$delete_id]);

    header('location:admin_controls.php');
}

if (isset($_POST['submit_update_edu'])) {
    $edu_id = $_POST['eduid'];
    $edu_id = filter_var(htmlspecialchars($edu_id));
    $edu_name = $_POST['eduname'];
    $edu_name = filter_var(htmlspecialchars($edu_name));
    $edu_year = $_POST['eduyear'];
    $edu_year = filter_var(htmlspecialchars($edu_year));
    $edu_desc = $_POST['edudesc'];
    $edu_desc = filter_var(htmlspecialchars($edu_desc));

    $update_edu = $conn->prepare("UPDATE `educations` SET eduname = ?, eduyear = ?, edudesc = ? WHERE eduid = ?");
    $update_edu->execute([$edu_name, $edu_year, $edu_desc, $edu_id]);

    $message[] = 'Pendidikan berhasil di edit';
    header('admin_controls.php');

}

if (isset($_POST['submit_update_exp'])) {
    $exp_id = $_POST['expid'];
    $exp_id = filter_var(htmlspecialchars($exp_id));
    $exp_name = $_POST['expname'];
    $exp_name = filter_var(htmlspecialchars($exp_name));
    $exp_year = $_POST['expyear'];
    $exp_year = filter_var(htmlspecialchars($exp_year));
    $exp_desc = $_POST['expdesc'];
    $exp_desc = filter_var(htmlspecialchars($exp_desc));

    $update_exp = $conn->prepare("UPDATE `experiences` SET expname = ?, expyear = ?, expdesc = ? WHERE expid = ?");
    $update_exp->execute([$exp_name, $exp_year, $exp_desc, $exp_id]);

    $message[] = 'Pengalaman berhasil di edit';
    header('admin_controls.php');

}

if (isset($_POST['submit_update_hs'])) {
    $hs_id = $_POST['hsid'];
    $hs_id = filter_var(htmlspecialchars($hs_id));
    $hs_name = $_POST['hsname'];
    $hs_name = filter_var(htmlspecialchars($hs_name));
    $hs_level = $_POST['hslevel'];
    $hs_level = filter_var(htmlspecialchars($hs_level));

    $update_hs = $conn->prepare("UPDATE `hardskills` SET hsname = ?, hslevel = ? WHERE hsid = ?");
    $update_hs->execute([$hs_name, $hs_level, $hs_id]);

    $message[] = 'Hardskill berhasil di edit';
    header('admin_controls.php');

}

if (isset($_POST['submit_update_ss'])) {
    $ss_id = $_POST['ssid'];
    $ss_id = filter_var(htmlspecialchars($ss_id));
    $ss_name = $_POST['ssname'];
    $ss_name = filter_var(htmlspecialchars($ss_name));
    $ss_level = $_POST['sslevel'];
    $ss_level = filter_var(htmlspecialchars($ss_level));

    $update_ss = $conn->prepare("UPDATE `softskills` SET ssname = ?, sslevel = ? WHERE ssid = ?");
    $update_ss->execute([$ss_name, $ss_level, $ss_id]);

    $message[] = 'Softskill berhasil di edit';
    header('admin_controls.php');

}


?>


<div class="container flex-column pb-5">
    <h3 class="acc-title my-5">Admin Controls Center</h3>

    <section class="section-table table-responsive">
        <table class="table table-bordered border-danger-subtle caption-top table-striped">
            <caption>Daftar Pendidikan</caption>
            <div class="row-action w-100 py-2">
                <!-- Add edu Modal -->

                <div class="modal fade" id="add-edu-modal" tabindex="-1" aria-labelledby="add-edu-modal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambahkan Data Pendidikan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="" method="POST">
                                <div class="modal-body">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="eduname" id="floatingEduname"
                                            placeholder="Pendidikan" autocomplete="off" />
                                        <label for="floatingEduname">Pendidikan</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="eduyear" id="floatingEduyear"
                                            placeholder="Jangka Tahun" autocomplete="off" />
                                        <label for="floatingEduyear">Jangka Tahun</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" name="edudesc" placeholder="Leave a comment here"
                                            id="floatingTextarea"></textarea>
                                        <label for="floatingTextarea">Deskripsi</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="form-control btn" name="submit_add_edu" id="submitEdu"
                                        value="Upload" />
                                    <button type="button" class="form-control btn btn-secondary close-modal-acc"
                                        data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <a href="" role="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-edu-modal">
                    <i class="fa-solid fa-plus"></i>&nbsp;Tambahkan
                </a>
            </div>
            <thead>
                <tr>
                    <th scope="col" class="text-center">id</th>
                    <th scope="col" class="text-center">Tahun</th>
                    <th scope="col" class="text-center">Pendidikan</th>
                    <th scope="col" class="text-center">Deskripsi</th>
                    <th scope="col" class="text-center">Operasi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $select_edu = $conn->prepare("SELECT * FROM `educations`");
                $select_edu->execute();

                if ($select_edu->rowCount() > 0) {
                    $id_col = 1;

                    while ($fetch_edu = $select_edu->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                            <th scope="row">
                                <?= $id_col++ ?>
                            </th>
                            <td>
                                <?= $fetch_edu['eduyear']; ?>
                            </td>
                            <td>
                                <?= $fetch_edu['eduname']; ?>
                            </td>
                            <td>
                                <?= $fetch_edu['edudesc']; ?>
                            </td>
                            <td class="op text-center">
                                <!-- Edit edu Modal -->

                                <div class="modal fade" id="edit-edu-modal-<?= $fetch_edu['eduid']; ?>" tabindex="-1"
                                    aria-labelledby="edit-edu-modallabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Pendidikan
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="" method="POST">
                                                <input type="hidden" name="eduid" value="<?= $fetch_edu['eduid']; ?>">
                                                <div class="modal-body">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="eduname"
                                                            id="floatingEduname" placeholder="Pendidikan" autocomplete="off"
                                                            value="<?= $fetch_edu['eduname']; ?>" required />
                                                        <label for="floatingEduname">Pendidikan</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="eduyear"
                                                            id="floatingEduyear" placeholder="Jangka Tahun" autocomplete="off"
                                                            value="<?= $fetch_edu['eduyear']; ?>" required />
                                                        <label for="floatingEduyear">Jangka Tahun</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" name="edudesc"
                                                            placeholder="Leave a comment here" id="floatingTextarea"
                                                            required><?= $fetch_edu['edudesc']; ?></textarea>
                                                        <label for="floatingTextarea">Deskripsi</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" class="form-control btn" name="submit_update_edu"
                                                        id="submitUpdateEdu" value="Update" />
                                                    <button type="button" class="form-control btn btn-secondary close-modal-acc"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <a href="" role="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                                    data-bs-target="#edit-edu-modal-<?= $fetch_edu['eduid']; ?>">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="admin_controls.php?delete_edu=<?= $fetch_edu['eduid']; ?>" role="button"
                                    class="btn btn-danger mb-2" onclick="return confirm('Apakah anda yakin?')">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<p class='mb-3'>Kamu belum menambahkan daftar pendidikan</p>";
                }

                ?>
            </tbody>
        </table>
    </section>
    <section class="section-table table-responsive">
        <table class="table table-bordered border-danger-subtle caption-top table-striped">
            <caption>Daftar Pengalaman</caption>
            <div class="row-action w-100 py-2">
                <!-- Add exp Modal -->

                <div class="modal fade" id="add-exp-modal" tabindex="-1" aria-labelledby="add-exp-modal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambahkan Data Pengalaman</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="" method="POST">
                                <div class="modal-body">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="expname" id="floatingExpname"
                                            placeholder="Pengalaman" autocomplete="off" />
                                        <label for="floatingExpname">Pengalaman</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="expyear" id="floatingExpyear"
                                            placeholder="Jangka Tahun" autocomplete="off" />
                                        <label for="floatingExpyear">Jangka Tahun</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" name="expdesc" placeholder="Leave a comment here"
                                            id="floatingTextarea"></textarea>
                                        <label for="floatingTextarea">Deskripsi</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="form-control btn" name="submit_add_exp" id="submitExp"
                                        value="Upload" />
                                    <button type="button" class="form-control btn btn-secondary close-modal-acc"
                                        data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <a href="" role="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-exp-modal">
                    <i class="fa-solid fa-plus"></i>&nbsp;Tambahkan
                </a>
            </div>
            <thead>
                <tr>
                    <th scope="col" class="text-center">id</th>
                    <th scope="col" class="text-center">Tahun</th>
                    <th scope="col" class="text-center">Pengalaman</th>
                    <th scope="col" class="text-center">Deskripsi</th>
                    <th scope="col" class="text-center">Operasi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $select_exp = $conn->prepare("SELECT * FROM `experiences`");
                $select_exp->execute();

                if ($select_exp->rowCount() > 0) {
                    $id_col = 1;

                    while ($fetch_exp = $select_exp->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                            <th scope="row">
                                <?= $id_col++ ?>
                            </th>
                            <td>
                                <?= $fetch_exp['expyear']; ?>
                            </td>
                            <td>
                                <?= $fetch_exp['expname']; ?>
                            </td>
                            <td>
                                <?= $fetch_exp['expdesc']; ?>
                            </td>
                            <td class="op text-center">
                                <!-- Edit exp Modal -->

                                <div class="modal fade" id="edit-exp-modal-<?= $fetch_exp['expid']; ?>" tabindex="-1"
                                    aria-labelledby="edit-exp-modal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Pengalaman
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="" method="POST">
                                                <input type="hidden" name="expid" value="<?= $fetch_exp['expid']; ?>">
                                                <div class="modal-body">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="expname"
                                                            id="floatingExpname" placeholder="Pengalaman" autocomplete="off"
                                                            value="<?= $fetch_exp['expname']; ?>" required />
                                                        <label for="floatingExpname">Pengalaman</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="expyear"
                                                            id="floatingExpyear" placeholder="Jangka Tahun" autocomplete="off"
                                                            value="<?= $fetch_exp['expyear']; ?>" required />
                                                        <label for="floatingExpyear">Jangka Tahun</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" name="expdesc"
                                                            placeholder="Leave a comment here" id="floatingTextarea"
                                                            required><?= $fetch_exp['expdesc']; ?></textarea>
                                                        <label for="floatingTextarea">Deskripsi</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" class="form-control btn" name="submit_update_exp"
                                                        id="submitExp" value="Upload" />
                                                    <button type="button" class="form-control btn btn-secondary close-modal-acc"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <a href="" role="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                                    data-bs-target="#edit-exp-modal-<?= $fetch_exp['expid']; ?>">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="admin_controls.php?delete_exp=<?= $fetch_exp['expid']; ?>" role="button"
                                    class="btn btn-danger mb-2" onclick="return confirm('Apakah anda yakin?')">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<p class='mb-3'>Kamu belum menambahkan daftar pengalaman</p>";
                }

                ?>
            </tbody>
        </table>
    </section>
    <section class="section-table table-responsive">
        <table class="table table-bordered border-danger-subtle caption-top table-striped">
            <caption>Daftar Hardskills</caption>
            <div class="row-action w-100 py-2">
                <!-- Add HS Modal -->

                <div class="modal fade" id="addHSModal" tabindex="-1" aria-labelledby="add-hs-modal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambahkan Hardskills</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="" method="POST">
                                <div class="modal-body">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="hsname" id="floatingHsname"
                                            placeholder="Hardskill" autocomplete="off" />
                                        <label for="floatingHsname">Hardskill</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" name="hslevel" id="floatingHslevel"
                                            placeholder="Persentase Level" autocomplete="off" min="0" max="100" />
                                        <label for="floatingHslevel">% Level</label>
                                    </div>
                                    <div class="form-floating d-flex justify-content-center">
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="form-control btn" name="submit_add_hs" id="submitHs"
                                        value="Upload" />
                                    <button type="button" class="form-control btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <a href="" role="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addHSModal">
                    <i class="fa-solid fa-plus"></i>&nbsp;Tambahkan
                </a>
            </div>
            <thead>
                <tr>
                    <th scope="col" class="text-center">id</th>
                    <th scope="col" class="text-center">Parametri</th>
                    <th scope="col" class="text-center">Level</th>
                    <th scope="col" class="text-center">Operasi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $select_hs = $conn->prepare("SELECT * FROM `hardskills`");
                $select_hs->execute();

                if ($select_hs->rowCount() > 0) {
                    $id_col = 1;
                    while ($fetch_hs = $select_hs->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                            <th scope="row">
                                <?= $id_col++ ?>
                            </th>
                            <td>
                                <?= $fetch_hs['hsname']; ?>
                            </td>
                            <td>
                                <?= $fetch_hs['hslevel']; ?>%
                            </td>
                            <td class="op text-center">
                                <!-- Edit HS Modal -->

                                <div class="modal fade" id="editHSModal-<?= $fetch_hs['hsid']; ?>" tabindex="-1"
                                    aria-labelledby="edit-hs-modal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Hardskills</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="" method="POST">
                                                <input type="hidden" name="hsid" value="<?= $fetch_hs['hsid']; ?>">
                                                <div class="modal-body">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="hsname"
                                                            id="floatingHsname" placeholder="Hardskill" autocomplete="off"
                                                            value="<?= $fetch_hs['hsname']; ?>" required />
                                                        <label for="floatingHsname">Hardskill</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="number" class="form-control" name="hslevel"
                                                            id="floatingHslevel" placeholder="Persentase Level"
                                                            autocomplete="off" min="0" max="100"
                                                            value="<?= $fetch_hs['hslevel']; ?>" required />
                                                        <label for="floatingHslevel">% Level</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" class="form-control btn" name="submit_update_hs"
                                                        id="submitHs" value="Update" />
                                                    <button type="button" class="form-control btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <a href="" role="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                                    data-bs-target="#editHSModal-<?= $fetch_hs['hsid']; ?>">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="admin_controls.php?delete_hs=<?= $fetch_hs['hsid']; ?>" role="button"
                                    class="btn btn-danger mb-2" onclick="return confirm('Apakah anda yakin?')">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<p class='mb-3'>Kamu belum menambahkan daftar hardskills</p>";
                }

                ?>
            </tbody>
        </table>
    </section>
    <section class="section-table table-responsive">
        <table class="table table-bordered border-danger-subtle caption-top table-striped">
            <caption>Daftar Softskill</caption>
            <div class="row-action w-100 py-2">
                <!-- Add SS Modal -->

                <div class="modal fade" id="addSSModal" tabindex="-1" aria-labelledby="add-Ss-modal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambahkan Softskills</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="" method="POST">
                                <div class="modal-body">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="ssname" id="floatingSsname"
                                            placeholder="Softskill" autocomplete="off" />
                                        <label for="floatingSsname">Softskill</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" name="sslevel" id="floatingSslevel"
                                            placeholder="Persentase Level" autocomplete="off" min="0" max="100" />
                                        <label for="floatingSslevel">% Level</label>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="form-control btn" name="submit_add_ss" id="submitSs"
                                        value="Upload" />
                                    <button type="button" class="form-control btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <a href="" role="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSSModal">
                    <i class="fa-solid fa-plus"></i>&nbsp;Tambahkan
                </a>
            </div>
            <thead>
                <tr>
                    <th scope="col" class="text-center">id</th>
                    <th scope="col" class="text-center">Parametri</th>
                    <th scope="col" class="text-center">Level</th>
                    <th scope="col" class="text-center">Operasi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $select_ss = $conn->prepare("SELECT * FROM `softskills`");
                $select_ss->execute();

                if ($select_ss->rowCount() > 0) {
                    $id_col = 1;
                    while ($fetch_ss = $select_ss->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                            <th scope="row">
                                <?= $id_col++ ?>
                            </th>
                            <td>
                                <?= $fetch_ss['ssname']; ?>
                            </td>
                            <td>
                                <?= $fetch_ss['sslevel']; ?>%
                            </td>
                            <td class="op text-center">
                                <!-- Edit SS Modal -->

                                <div class="modal fade" id="editSSModal-<?= $fetch_ss['ssid']; ?>" tabindex="-1"
                                    aria-labelledby="edit-ss-modal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editSSModalLabel">Edit Softskills</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="" method="POST">
                                                <input type="hidden" name="ssid" value="<?= $fetch_ss['ssid']; ?>">
                                                <div class="modal-body">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="ssname"
                                                            id="floatingSsname" placeholder="Softskill" autocomplete="off"
                                                            value="<?= $fetch_ss['ssname']; ?>" required />
                                                        <label for="floatingSsname">Softskill</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="number" class="form-control" name="sslevel"
                                                            id="floatingSslevel" placeholder="Persentase Level"
                                                            autocomplete="off" min="0" max="100"
                                                            value="<?= $fetch_ss['sslevel']; ?>" required />
                                                        <label for="floatingSslevel">% Level</label>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" class="form-control btn" name="submit_update_ss"
                                                        id="submitSs" value="Update" />
                                                    <button type="button" class="form-control btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <a href="" role="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                                    data-bs-target="#editSSModal-<?= $fetch_ss['ssid']; ?>">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="admin_controls.php?delete_ss=<?= $fetch_ss['ssid']; ?>" role="button"
                                    class="btn btn-danger mb-2" onclick="return confirm('Apakah anda yakin?')">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<p class='mb-3'>Kamu belum menambahkan daftar pendidikan</p>";
                }

                ?>
            </tbody>
        </table>
    </section>
</div>

<?php
require('layout/footer.php');
?>