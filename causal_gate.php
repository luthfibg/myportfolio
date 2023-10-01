<?php
require('layout/header.php');
?>

<div class="container h-100 container-cg d-flex flex-column justify-content-center align-items-center">
    <div class="row w-100">
        <div class="col-4">
            <a href="edit_adm.php" style="color: white;">Pergi</a>
        </div>
    </div>
    <form action="" method="POST">
        <div class="form-floating mb-3">
            <input type="password" class="form-control" name="code" id="floatingCode" placeholder="Kode"
                autocomplete="off" />
            <label for="floatingCode">Kode</label>
        </div>
        <div class="form-floating d-flex justify-content-center" style="visibility: hidden;">
            <input type="submit" class="form-control btn" name="submit_login" id="submitLogin" value="Masuk" />
        </div>
    </form>

</div>

<?php
require('layout/footer.php');
?>