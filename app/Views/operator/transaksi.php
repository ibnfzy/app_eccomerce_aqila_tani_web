<?= $this->extend('operator/base'); ?>

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
              Transaksi Aktif
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
                    <a href="/OperatorPanel/Invoice/<?= $item['id_transaksi'] ?>" class="btn btn-success"
                      target="_blank"><i class="fa-solid fa-eye"></i></a>

                    <?php if ($item['status_transaksi'] == 'Menunggu Konfirmasi COD') : ?>
                    <a href="/OperatorPanel/Acc/<?= $item['id_transaksi'] ?>" class="btn btn-success"><i
                        class="fa-solid fa-check"></i> Terima permintaan COD</a>
                    <?php endif ?>

                    <?php if ($item['status_transaksi'] == 'Menunggu Konfirmasi Pembayaran') : ?>
                    <button class="btn btn-success"
                      onclick="bukti_bayar('<?= $item['id_transaksi'] ?>', '<?= $item['bukti_bayar'] ?>')"><i
                        class="fa-solid fa-receipt"></i> Lihat bukti
                      bayar</button>
                    <?php endif ?>

                    <?php if ($item['status_transaksi'] == 'Menunggu Konfirmasi COD' || $item['status_transaksi'] == 'Menunggu Konfirmasi Pembayaran') : ?>
                    <a href="/OperatorPanel/Denied/<?= $item['id_transaksi'] ?>" class="btn btn-danger"><i
                        class="fa-solid fa-times"></i> Tolak</a>
                    <?php endif ?>

                    <?php if ($item['status_transaksi'] == 'Diproses') : ?>
                    <a href="/OperatorPanel/Kirim/<?= $item['id_transaksi'] ?>" class="btn btn-success"><i
                        class="fa-solid fa-truck"></i> Kirim Pesanan</a>
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

<div class="modal fade" id="buktiBayarModal" tabindex="-1" aria-labelledby="buktiBayarModallLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="buktiBayarModallLabel">Bukti Bayar</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-4">
          <a href="#" data-fancybox="bukti_bayar" id="bukti_bayar_a">
            <img src="#" id="bukti_bayar" class="img-fluid">
          </a>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
        <a href="#" id="accBtn" class="btn btn-success">Terima</a>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
const bukti_bayar = (id, bukti_bayar) => {
  $('#bukti_bayar').attr('src', '/uploads/' + bukti_bayar);
  $('#bukti_bayar_a').attr('href', '/uploads/' + bukti_bayar);
  $('#accBtn').attr('href', '/OperatorPanel/Acc/' + id);
  $('#buktiBayarModal').modal('show')
};
</script>
<?= $this->endSection(); ?>