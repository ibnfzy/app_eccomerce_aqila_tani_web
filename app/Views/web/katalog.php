<?= $this->extend('web/base'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid pt-5">
  <div class="text-center mb-4">
    <h2 class="section-title px-5"><span class="px-2">Katalog Barang</span></h2>
  </div>
  <div class="row px-xl-5 pb-3">

    <?php foreach ($data as $item) : ?>
    <?php $gambar = unserialize($item['images']); ?>
    <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
      <div class="card product-item border-0 mb-4">
        <div
          class="card-header product-img position-relative overflow-hidden bg-transparent border border-secondary-subtle p-0">
          <img class="img-fluid w-100" src="/uploads/<?= $gambar[array_rand($gambar)] ?>" alt="">
        </div>
        <div class="card-body border border-secondary-subtle text-center p-0 pt-4 pb-3">
          <a href="#" class="text-decoration-none text-dark">
            <h6 class="text-truncate mb-3"><?= $item['nama_barang']; ?></h6>
          </a>
          <div class="d-flex justify-content-center">
            <h6>Rp. <?= number_format($item['harga'], 0, ',', '.'); ?> </h6>
          </div>
          <a href="/Katalog/<?= $item['id_barang'] ?>" class="btn btn-outline-success btn-sm mt-2">
            <i class="fa-solid fa-eye"></i> Lihat Detail
          </a>
        </div>
      </div>
    </div>
    <?php endforeach ?>

  </div>
</div>

<?= $this->endSection(); ?>