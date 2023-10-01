<?php
require('layout/header.php');
include('connection.php');

session_start();

if (isset($_POST['submit_regist'])) {

    $new_username = $_POST['new_username'];
    $new_username = filter_var(htmlspecialchars($new_username));
    $new_password = sha1($_POST['new_password']);
    $new_password = filter_var(htmlspecialchars($new_password));
    $confirm_password = sha1($_POST['confirm_password']);
    $confirm_password = filter_var(htmlspecialchars($confirm_password));

    $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE admin_name = ?");
    $select_admin->execute([$new_username]);

    if ($select_admin->rowCount() > 0) {
        $message[] = 'Admin sudah ada!';
        header('login.php');
    } else {
        if ($new_username == '' || $new_username == null) {
            $message[] = 'Nama Pengguna dan Password harus diisi!';
        } elseif ($new_password == '' || $new_password == null) {
            $message[] = 'Nama Pengguna dan Password harus diisi!';
        } else {
            if ($new_password != $confirm_password) {
                $message[] = 'Password Tidak Sama, Silahkan Diulang!';
            } else {
                $insert_admin = $conn->prepare("INSERT INTO `admins` (admin_name, admin_password) VALUES (?,?)");
                $insert_admin->execute([$new_username, $confirm_password]);
                header('location:admin_controls.php');
                $message[] = 'Admin baru berhasil terdaftar';
            }
        }
    }
}
?>

<div class="container container-auth">
    <div class="row row-auth">
        <div class="col-12 col-auth flex-column">
            <h1 class="auth-title mb-5">Registrasi Admin</h1>
            <form action="" method="POST">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="new_username" id="floatingNewUsername"
                        placeholder="Nama Pengguna Baru" autocomplete="off" />
                    <label for="floatingNewUsername">Nama Pengguna Baru</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="new_password" id="floatingNewPassword"
                        placeholder="Password Baru" autocomplete="off" />
                    <label for="floatingNewPassword">Password Baru</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="confirm_password" id="floatingConfirmPassword"
                        placeholder="Konfirmasi Password" autocomplete="off" />
                    <label for="floatingConfirmPassword">Konfirmasi Password</label>
                </div>
                <div class="form-floating d-flex justify-content-center">
                    <input type="submit" class="form-control btn" name="submit_regist" id="submitRegist"
                        value="Simpan" />
                </div>
            </form>
        </div>
    </div>
</div>

<?php


require('layout/footer.php');
?>