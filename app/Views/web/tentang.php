<?= $this->extend('web/base'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid pt-5" style="height: 70vh;">
  <div class="row px-xl-5">
    <div class="col-lg-5 mb-5">
      <h2 class="font-weight-semi-bold mb-3">Tentang Toko Aqila Tani</h2>
      <p>Justo sed diam ut sed amet duo amet lorem amet stet sea ipsum, sed duo amet et. Est elitr dolor elitr
        erat sit sit. Dolor diam et erat clita ipsum justo sed.</p>
      <div class="d-flex flex-column mb-3">
        <h5 class="font-weight-semi-bold mb-3">Informasi Toko</h5>
        <p class="mb-2"><i class="fa fa-map-marker-alt text-success mx-3"></i>123 Street, New York, USA</p>
        <p class="mb-2"><i class="fa fa-envelope text-success mx-3"></i>info@example.com</p>
        <p class="mb-2"><i class="fa fa-phone-alt text-success mx-3"></i>+012 345 67890</p>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>