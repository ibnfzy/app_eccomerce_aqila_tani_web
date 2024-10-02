<?= $this->extend('web/base'); ?>

<?= $this->section('content'); ?>

<?php
$controller = new \App\Controllers\Home;

$star = $controller->review_star($data['id_barang']);
$total_star = $controller->total_review($data['id_barang']);
$review = $controller->review($data['id_barang']);
$pbagi = count($review);
?>

<div class="container-fluid py-5">
  <div class="row px-xl-5">
    <div class="col-lg-5 pb-5">
      <div id="product-carousel" class="owl-carousel owl-theme">

        <?php foreach (unserialize($data['images']) as $item) : ?>
        <div class="item">
          <a href="/uploads/<?= $item ?>" data-fancybox="gallery">
            <img class="w-100 h-100" src="/uploads/<?= $item ?>" alt="Image">
          </a>
        </div>
        <?php endforeach ?>

      </div>
    </div>

    <div class="col-lg-7 pb-5">
      <h3 class="font-weight-semi-bold"><?= $data['nama_barang']; ?></h3>
      <div class="d-flex mb-3">
        <div class="text-primary mr-2">
          <?= $star; ?>
        </div>
        <small class="pt-1">(
          <?= $total_star; ?> )</small>
      </div>
      <h3 class="font-weight-semi-bold mb-4">Rp <?= number_format($data['harga'], 0, ',', '.'); ?></h3>
      <h5 class="font-weight-semi-bold mb-4">Stok : <?= $data['stok']; ?></h5>
      <div class="d-flex align-items-center mb-4 pt-2">
        <div class="input-group quantity mr-3" style="width: 130px;">
          <div class="input-group-btn">
            <button class="btn btn-success btn-minus">
              <i class="fa fa-minus"></i>
            </button>
          </div>
          <input type="text" class="form-control bg-light text-center quantity-input" value="1"
            data-stok="<?= $data['stok']; ?>">
          <div class="input-group-btn">
            <button class="btn btn-success btn-plus">
              <i class="fa fa-plus"></i>
            </button>
          </div>
        </div>
        <button class="btn btn-outline-success px-3 mx-2"><i class="fa fa-shopping-cart mr-1"></i> Tambah Ke
          Keranjang</button>
      </div>
    </div>
  </div>
  <div class="row px-xl-5">
    <div class="col">
      <div class="nav nav-tabs justify-content-center border-secondary mb-4">
        <a class="nav-item nav-link text-success active" data-bs-toggle="tab"
          data-bs-target="#tab-pane-1">Description</a>
        <a class="nav-item nav-link text-success" data-bs-toggle="tab" data-bs-target="#tab-pane-3">Reviews
          (<?= $total_star; ?>)</a>
      </div>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="tab-pane-1">
          <h4 class="mb-3">Deskripsi Barang</h4>
          <?= $data['deskripsi']; ?>
        </div>
        <div class="tab-pane fade" id="tab-pane-3">
          <div class="row">
            <div class="col-md-6">
              <h4 class="mb-4"><?= $total_star; ?> review untuk "<?= $data['nama_barang']; ?>"</h4>

              <?php foreach ($review as $item) : ?>
              <div class="media mb-4">
                <div class="media-body">
                  <h6><?= $item['nama']; ?><small> - <i><?= $item['created_at']; ?></i></small></h6>
                  <div class="text-primary mb-2">
                    <?php for ($i = 0; $i < $item['rating']; $i++) : ?>
                    <i class="fas fa-star text-success"></i>
                    <?php endfor; ?>
                  </div>
                  <p><?= $item['review']; ?></p>
                </div>
              </div>
              <?php endforeach ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>