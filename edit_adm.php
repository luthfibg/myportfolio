<?php
include('connection.php');
require('layout/header.php');


if (isset($_POST['submit_update_admin'])) {
    $admin_id = $_POST['admin_id'];
    $admin_id = filter_var(htmlspecialchars($admin_id));
    $admin_name = $_POST['admin_name'];
    $admin_name = filter_var(htmlspecialchars($admin_name));
    $admin_password = sha1($_POST['new_password']);
    $admin_password = filter_var(htmlspecialchars($admin_password));

    $update_admin = $conn->prepare("UPDATE `admins` SET admin_name = ?, admin_password = ? WHERE admin_id = ?");
    $update_admin->execute([$admin_name, $admin_password, $admin_id]);

    $message[] = 'Admin berhasil di edit';
    header('edit_adm.php');

}

if (isset($_GET['delete_admin'])) {
    $delete_id = $_GET['delete_admin'];
    $delete_admin = $conn->prepare("DELETE FROM `admins` WHERE admin_id = ?");
    $delete_admin->execute([$delete_id]);

    header('location:edit_adm.php');
}


?>

<div class="container h-100 container-edm">
    <div class="table-wrapper table-responsive">
        <table class="table table-bordered border-danger-subtle caption-top table-striped">
            <caption>Daftar Admin</caption>
            <thead>
                <tr>
                    <th scope="col" class="text-center">id</th>
                    <th scope="col" class="text-center">Nama Admin</th>
                    <th scope="col" class="text-center">Password</th>
                    <th scope="col" class="text-center">Operasi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $select_admin = $conn->prepare("SELECT * FROM `admins`");
                $select_admin->execute();

                if ($select_admin->rowCount() > 0) {
                    $id_col = 1;

                    while ($fetch_admin = $select_admin->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                            <th scope="row">
                                <?= $id_col++ ?>
                            </th>
                            <td>
                                <?= $fetch_admin['admin_name']; ?>
                            </td>
                            <td>
                                <?= $fetch_admin['admin_password']; ?>
                            </td>
                            <td class="op text-center">
                                <!-- Edit Admin Modal -->

                                <div class="modal fade" id="edit-admin-modal-<?= $fetch_admin['admin_id']; ?>" tabindex="-1"
                                    aria-labelledby="edit-admin-modallabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Admin
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="" method="POST">
                                                <input type="hidden" name="admin_id" value="<?= $fetch_admin['admin_id']; ?>">
                                                <div class="modal-body">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="admin_name"
                                                            id="floatingAdminName" placeholder="Nama Admin" autocomplete="off"
                                                            value="<?= $fetch_admin['admin_name']; ?>" required />
                                                        <label for="floatingAdminName">Nama Admin</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="password" class="form-control" name="new_password"
                                                            id="floatingNewPass" placeholder="Password Baru" autocomplete="off"
                                                            required />
                                                        <label for="floatingEduyear">Password Baru</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" class="form-control btn" name="submit_update_admin"
                                                        id="submitUpdateAdm" value="Update" />
                                                    <button type="button" class="form-control btn btn-secondary close-modal-acc"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <a href="" role="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                                    data-bs-target="#edit-admin-modal-<?= $fetch_admin['admin_id']; ?>">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="edit_adm.php?delete_admin=<?= $fetch_admin['admin_id']; ?>" role="button"
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
    </div>
</div>

<?php
require('layout/footer.php');
?>