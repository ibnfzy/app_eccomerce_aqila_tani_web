<?= $this->extend('user/base'); ?>

<?= $this->section('content'); ?>

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
                <td><?= $item['total_barang']; ?></td>
                <td><?= $item['total_harga']; ?></td>
                <td><?= $item['total_bayar']; ?></td>
                <td><?= $item['created_at']; ?></td>
                <td>
                  <div class="btn-group">
                    <a href="/UserPanel/Transaksi/<?= $item['id_transaksi'] ?>" class="btn btn-success"><i
                        class="fa-solid fa-eye"></i></a>
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