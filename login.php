<?php
require('layout/header.php');
include('connection.php');

session_start();

if (isset($_POST['submit_login'])) {

    $username = $_POST['username'];
    $username = filter_var(htmlspecialchars($username));
    $pass = sha1($_POST['password']);
    $pass = filter_var(htmlspecialchars($pass));

    $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE admin_name = ? AND admin_password = ?");
    $select_admin->execute([$username, $pass]);

    if ($select_admin->rowCount() > 0) {
        $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
        $_SESSION['admin_id'] = $fetch_admin_id['admin_id'];
        // $message[] = "you are logged in!";
        header('location:admin_controls.php');
    } else {
        $message[] = "incorrect username or password!";
    }
}
?>

<div class="container container-auth">
    <div class="row row-auth">
        <div class="col-12 col-auth flex-column">
            <h1 class="auth-title mb-5">Login Admin</h1>
            <form action="" method="POST">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="username" id="floatingUsername"
                        placeholder="Nama Pengguna" autocomplete="off" />
                    <label for="floatingUsername">Nama Pengguna</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="password" id="floatingPassword"
                        placeholder="Password" autocomplete="off" />
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="form-floating d-flex justify-content-center">
                    <input type="submit" class="form-control btn" name="submit_login" id="submitLogin" value="Masuk" />
                </div>
            </form>
        </div>
    </div>
</div>

<?php


require('layout/footer.php');
?>