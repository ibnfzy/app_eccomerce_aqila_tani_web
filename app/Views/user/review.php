<?= $this->extend('user/base'); ?>

<?= $this->section('content'); ?>

<?php helper('star'); ?>

<div class="container-fluid">
  <!--begin::Row-->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">

          <div class="float-end">
            <h3>
              Review
            </h3>
          </div>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-bordered datatable">
            <thead>
              <tr>
                <th>Tanggal Review</th>
                <th>Nama Barang</th>
                <th>Rating</th>
                <th>Review</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data as $key => $item) : ?>
                <tr>
                  <td><?= date('d F Y - H:i:s', strtotime($item['created_at'])); ?></td>
                  <td><?= $item['nama_barang']; ?></td>
                  <td><?= star($item['rating']); ?></td>
                  <td><?= number_format($item['review'], 0, ',', '.'); ?></td>
                <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div><!-- /.col-md-6 -->
  </div>
  <!--end::Row-->
</div>

<?= $this->endSection(); ?>