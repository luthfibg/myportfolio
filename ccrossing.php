<?php
require('layout/header.php');
?>
<div class="container container-cro flex-column align-items-center">
  <div class="row row-gap-3 card-wrapper dflex">
    <h1 class="text cc-heading my-2"></h1>
    <div class="subheading text-center mb-3">Pilih jalanmu untuk <a class="regist-link" href="regist.php">lanjut</a>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-3">
      <a class="d-block" href="memories.php">
        <div class="card">
          <h5 class="card-header">Memorynatia</h5>
          <div class="card-body">
            <div class="iconfaw my-3">
              <i class="fa-solid fa-snowflake fa-3x"></i>
            </div>
            <h5 class="card-title">Berkunjung itu bagus, tetapi tidak untuk ditinggali.</h5>
            <p class="card-text">Belajar dari mereka untuk menjadi lebih baik di masa depan. Masa lalu memiliki efek
              menimbulkan reaksi emosional tertentu.</p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-3">
      <a class="d-block" href="presentunis.php">
        <div class="card">
          <h5 class="card-header">Presentunis</h5>
          <div class="card-body">
            <div class="iconfaw my-3">
              <i class="fa-solid fa-life-ring fa-3x"></i>
            </div>
            <h5 class="card-title">Ada apa hari ini? Kuharap peningkatan</h5>
            <p class="card-text">Hari yang baik, merupakan hari yang memiliki kemajuan dari pada hari sebelumnya.</p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-3">
      <a class="d-block" href="causal_gate.php">
        <div class="card">
          <h5 class="card-header">Fruxyath</h5>
          <div class="card-body">
            <div class="iconfaw my-3">
              <i class="fa-brands fa-galactic-republic fa-spin fa-spin-reverse fa-3x"></i>
            </div>
            <h5 class="card-title">Mimpi, awal dari keberhasilan besar.</h5>
            <p class="card-text">Jika kamu ingin pencapaian luarbiasa, ingatlah kebelakang, perjuangan harus
              luarbiasa!</p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-3">
      <a class="d-block" href="causal_gate.php">
        <div class="card">
          <h5 class="card-header">Raccosylphaea</h5>
          <div class="card-body">
            <div class="iconfaw my-3">
              <i class="fa-solid fa-hurricane fa-spin fa-3x"></i>
            </div>
            <h5 class="card-title">Kejadian Acak</h5>
            <p class="card-text">Kegagalan adalah bagian dari perjuangan. Kadang hal diluar kendali menjadi bagian.
              Mereka memberikan pelajaran berharga.</p>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>
<script src="scramble.js"></script>
<script>
  const phrases = ['Selamat Datang Di', 'Persimpangan Eritus'];
  const el = document.querySelector('.text');
  const fx = new TextScramble(el);
  let counter = 0;

  const next = () => {
    fx.setText(phrases[counter]).then(() => {
      setTimeout(next, 800);
    });
    counter = (counter + 1) % phrases.length;
  };

  next();
</script>
<?php
require('layout/footer.php');
?>