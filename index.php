<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// setcookie('cookieName', 'cookieValue', [
//   'expires' => time() + (7 * 24 * 3600),
//   'path' => '/',
//   'domain' => 'example.com',
//   'samesite' => 'None',
//   'secure' => true,
//   'httponly' => true
// ]);

include('connection.php');

$mail = new PHPMailer(true);

if (isset($_POST["submit_message"])) {
  $name = $_POST['name'];
  $name = filter_var(htmlspecialchars($name));
  $email = $_POST['email'];
  $email = filter_var(htmlspecialchars($email));
  $message = $_POST['message'];
  $message = filter_var(htmlspecialchars($message));

  try {
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'luthfiban9un@gmail.com';
    $mail->Password = 'gckgbiuayjpfjpgd';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom($email, $name);
    $mail->addAddress('luthfiban9un@gmail.com');
    // $mail->addAddress('receiver2@gfg.com', 'Name');

    $mail->isHTML(true);
    $mail->Subject = 'Message From Visitors';
    $mail->Body = 'Nama: ' . $name . "<br>" . 'Alamat Email: ' . $email . "<br>" . $message;
    $mail->AltBody = 'Body in plain text for non-HTML mail clients';
    $mail->send();

    ?>
    <script type="text/javascript">

      $(document).ready(function () {

        swal({
          title: "Pesan",
          text: "Pesan berhasil dikirim, respon mungkin akan dibalas menuju alamat email anda.",
          icon: "success",
          button: "Oke",
        });
      });

    </script>
    <?php

  } catch (Exception $e) {
    ?>
    <script type="text/javascript">

      $(document).ready(function () {

        swal({
          title: "Pesan",
          text: "Tidak dapat mengirim pesan, Mailer Error: <?= "{$mail->ErrorInfo}" ?>.",
          icon: "warning",
          button: "Oke",
        });
      });

    </script>
    <?php
  }
}

?>

<?php
require("layout/header.php");
?>


<div class="xcon">
  <!-- section 1 -->
  <section class="section one" id="top">
    <div class="section__content">
      <img src="assets/profile.png" alt="myphoto" class="mb-3" />
      <h1>Halo, Saya Muhamad <a class="secret-link" href="login.php" target="_blank">Luthfi</a></h1>
      <div class="animated-text">Saya&nbsp;<span></span></div>
      <div class="btn-wrapper">
        <a href="#histories" class="btn"></a>
        <a href="#skills" class="btn"></a>
        <div class="btn" id="themeSwitch-icon"></div>
        <a href="#projects" class="btn"></a>
        <a href="#contact" class="btn"></a>
      </div>
    </div>
  </section>

  <!-- section 2 -->
  <section class="section two" id="histories">
    <div class="section__content">
      <h1 class="section-title">Riwayat Saya</h1>
      <div class="history-row">
        <div class="history-col">
          <h3 class="title">Pendidikan</h3>
          <div class="edu-wrapp">
            <?php
            $select_edu_content = $conn->prepare("SELECT * FROM `educations`");
            $select_edu_content->execute();

            if ($select_edu_content->rowCount() > 0) {
              while ($fetch_edu_contents = $select_edu_content->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="edu-content">
                  <div class="content">
                    <div class="incontent">
                      <div class="year"><i class="fa-solid fa-calendar-days"></i>&nbsp;
                        <?= $fetch_edu_contents['eduyear']; ?>
                      </div>
                      <h3>
                        <?= $fetch_edu_contents['eduname']; ?>
                      </h3>
                      <p>
                        <?= $fetch_edu_contents['edudesc']; ?>
                      </p>
                    </div>
                    <a href="#" class="more"></a>
                  </div>
                </div>
                <?php
              }
            } else {
              echo "<p class='mb-3'>Tidak ada pendidikan yang ditambahkan</p>";
            }
            ?>
          </div>
        </div>
        <div class="history-col">
          <h3 class="title">Pengalaman</h3>
          <div class="exp-wrapp">
            <?php
            $select_exp_content = $conn->prepare("SELECT * FROM `experiences`");
            $select_exp_content->execute();

            if ($select_exp_content->rowCount() > 0) {
              while ($fetch_exp_contents = $select_exp_content->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="exp-content">
                  <div class="content">
                    <div class="incontent">
                      <div class="year"><i class="fa-solid fa-calendar-days"></i>&nbsp;
                        <?= $fetch_exp_contents['expyear']; ?>
                      </div>
                      <h3>
                        <?= $fetch_exp_contents['expname']; ?>
                      </h3>
                      <p>
                        <?= $fetch_exp_contents['expdesc']; ?>
                      </p>
                    </div>
                    <a href="#" class="more"></a>
                  </div>
                </div>
                <?php
              }
            } else {
              echo "<p class='mb-3'>Tidak ada pengalaman ditambahkan</p>";
            }
            ?>

          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- section 3 -->
  <section class="section three" id="skills">
    <div class="section__content">
      <h1 class="skills-title">Keterampilan Saya</h1>
      <div class="skills-row">
        <div class="skills-col">
          <h3 class="skills-col-title">Hard Skills</h3>
          <div class="skills-wrapper">
            <div class="skills-content">
              <?php
              $select_hs_content = $conn->prepare("SELECT * FROM `hardskills`");
              $select_hs_content->execute();

              if ($select_hs_content->rowCount() > 0) {
                while ($fetch_hs_contents = $select_hs_content->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <div class="progress-x">
                    <h3>
                      <?= $fetch_hs_contents['hsname']; ?><span>
                        <?= $fetch_hs_contents['hslevel']; ?>%
                      </span>
                    </h3>
                    <div class="bar"><span></span></div>
                  </div>
                  <?php
                }
              } else {
                echo "<p class='mb-3'>Belum ada keterampilan ditambahkan</p>";
              }

              ?>
            </div>
          </div>
        </div>
        <div class="skills-col">
          <h3 class="skills-col-title">Soft Skills</h3>
          <div class="skills-wrapper">
            <div class="skills-content">
              <?php
              $select_ss_content = $conn->prepare("SELECT * FROM `softskills`");
              $select_ss_content->execute();

              if ($select_ss_content->rowCount() > 0) {
                while ($fetch_ss_contents = $select_ss_content->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <div class="progress-x">
                    <h3>
                      <?= $fetch_ss_contents['ssname']; ?><span>
                        <?= $fetch_ss_contents['sslevel']; ?>%
                      </span>
                    </h3>
                    <div class="bar"><span></span></div>
                  </div>
                  <?php
                }
              } else {
                echo "<p class='mb-3'>Belum ada keterampilan ditambahkan</p>";
              }

              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- section 4 -->
  <section class="section four" id="projects">
    <div class="section__content">
      <h1 class="project-title">Projek</h1>
      <div class="grid-container container-fluid">
        <div class="grid-row row-12">
          <div class="col-sm-2 col-4">
            <a class="pro-link" href="travo_pro.php" target="_blank">
              <img src="assets/travo.png" alt="" />
            </a>
          </div>
          <div class="col-sm-2 col-4">
            <a href="sistem_pakar_pro.php" class="pro-link" target="_blank">
              <img src="assets/adm.png" alt="" />
            </a>
          </div>
          <div class="col-sm-2 col-4">
            <a href="bmdm_pro.php" class="pro-link" target="_blank">
              <img src="assets/bmdm.png" alt="" />
            </a>
          </div>
          <div class="col-sm-6 col-12">
            <a href="iot_pro.php" class="pro-link" target="_blank">
              <img src="assets/iot-p.jpg" alt="" />
            </a>
          </div>
        </div>
        <div class="grid-row row-12">
          <div class="col-sm-5 col-12">
            <a href="https://deepflares.iblogger.org/" class="pro-link" target="_blank">
              <img src="assets/dpfl.png" alt="" />
            </a>
          </div>
          <div class="col-sm-2 col-3">
            <a href="cakpel_pro.php" class="pro-link" target="_blank">
              <img src="assets/cakpel.jpg" alt="" />
            </a>
          </div>
          <div class="col-sm-5 col-9">
            <a href="sp_pro.php" class="pro-link" target="_blank">
              <img src="assets/sp.png" alt="" />
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- section 5 -->
  <section class="section five">
    <div class="section__content">
      <h1 class="creations-title">Karya Kreasi</h1>
      <a target="_parent" href="ccrossing.php" class="btn-wrapper">
        <div class="btn"></div>
      </a>
    </div>
  </section>

  <!-- section 6 -->
  <section class="section six" id="contact">
    <div class="section__content">
      <h1 class="contact-heading">Kontak Saya</h1>
      <form action="" method="POST">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" name="name" id="floatingName" placeholder="Nama" autocomplete="off" />
          <label for="floatingName">Nama Lengkap</label>
        </div>
        <div class="form-floating mb-3">
          <input type="email" class="form-control" name="email" id="floatingEmail" placeholder="Alamat Email"
            autocomplete="off" />
          <label for="floatingEmail">Alamat Email</label>
        </div>
        <div class="form-floating mb-3">
          <textarea cols="30" rows="10" class="form-control" name="message" id="floatingMessage"
            placeholder="Ketikkan pesan"></textarea>
          <label for="floatingMessage">Ketikkan Pesan</label>
        </div>
        <div class="form-floating d-flex justify-content-center">
          <input type="submit" class="form-control btn" name="submit_message" id="submitMessage" value="Kirim" />
        </div>
      </form>
    </div>
    <footer class="footer">
      <p>Media Sosial Saya:</p>
      <div class="socmed">
        <div class="item">
          <a target="_blank" href="https://github.com/luthfibg">
            <span class="ic"><i class="fa-brands fa-github"></i></span>
            <span class="icname">Github</span>
          </a>
        </div>
        <div class="item">
          <a target="_blank" href="https://www.linkedin.com/in/muhamad-luthfi-28a9621ba/">
            <span class="ic"><i class="fa-brands fa-linkedin-in"></i></span>
            <span class="icname">LinkedIn</span>
          </a>
        </div>
        <div class="item">
          <a target="_blank" href="https://www.youtube.com/channel/UCxpvymT9aBe_rglZxNpTEPw">
            <span class="ic"><i class="fa-brands fa-youtube"></i></span>
            <span class="icname">YouTube</span>
          </a>
        </div>
        <div class="item">
          <a target="_blank" href="https://deepflares.iblogger.org/">
            <span class="ic"><i class="fa-brands fa-wordpress-simple"></i></span>
            <span class="icname">My Blog</span>
          </a>
        </div>
      </div>
      <div class="footer-text">
        <p>Copyright &copy; 2023 by Muhamad Luthfi | All Rights Reserved</p>
      </div>
      <div class="footer-iconTop">
        <a href="#top">
          <i class="fa-solid fa-arrow-up"></i>
        </a>
      </div>
    </footer>
  </section>
</div>
<style type="text/css">
  .skills-col:nth-child(1) .skills-content .progress-x:nth-child(1) .bar span {
    width: 70%;
  }

  .skills-col:nth-child(1) .skills-content .progress-x:nth-child(2) .bar span {
    width: 30%;
  }

  .skills-col:nth-child(1) .skills-content .progress-x:nth-child(3) .bar span {
    width: 50%;
  }

  .skills-col:nth-child(1) .skills-content .progress-x:nth-child(4) .bar span {
    width: 60%;
  }

  .skills-col:nth-child(1) .skills-content .progress-x:nth-child(5) .bar span {
    width: 30%;
  }

  .skills-col:nth-child(2) .skills-content .progress-x:nth-child(1) .bar span {
    width: 70%;
  }

  .skills-col:nth-child(2) .skills-content .progress-x:nth-child(2) .bar span {
    width: 80%;
  }

  .skills-col:nth-child(2) .skills-content .progress-x:nth-child(3) .bar span {
    width: 90%;
  }

  .skills-col:nth-child(2) .skills-content .progress-x:nth-child(4) .bar span {
    width: 70%;
  }

  .skills-col:nth-child(2) .skills-content .progress-x:nth-child(5) .bar span {
    width: 60%;
  }
</style>


<?php
require("layout/footer.php");
?>