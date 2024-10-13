<?= $this->extend('user/base'); ?>

<?= $this->section('content'); ?>
<?php helper('badge'); ?>

<div class="container-fluid">
  <!--begin::Row-->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">

          <div class="float-end">
            <h3>
              Transaksi
            </h3>
          </div>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-bordered datatable">
            <thead>
              <tr>
                <th>~</th>
                <th>Status</th>
                <th>Total Barang</th>
                <th>Total Harga</th>
                <th>Total Bayar</th>
                <th>Tanggal Transaksi</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data as $key => $item) : ?>
              <tr>
                <td><?= $key + 1; ?></td>
                <td><?= status($item['status_transaksi']); ?></td>
                <td><?= $item['total_kuantitas']; ?></td>
                <td>Rp<?= number_format($item['total_harga'], 0, ',', '.'); ?></td>
                <td>Rp<?= number_format($item['total_bayar'], 0, ',', '.'); ?></td>
                <td><?= date('d F Y - H:i:s', strtotime($item['created_at'])); ?></td>
                <td>
                  <div class="btn-group">
                    <a href="/UserPanel/Invoice/<?= $item['id_transaksi'] ?>" class="btn btn-success"><i
                        class="fa-solid fa-eye"></i></a>

                    <?php if ($item['status_transaksi'] == 'Dikirim') : ?>
                    <a href="/UserPanel/Acc/<?= $item['id_transaksi'] ?>" class="btn btn-success"><i
                        class="fa-solid fa-check"></i> Konfirmasi Pesanan Diterima</a>
                    <?php endif ?>
                  </div>
                </td>
              </tr>
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