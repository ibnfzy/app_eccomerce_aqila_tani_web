<?= $this->extend('operator/base'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
  <!--begin::Row-->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="float-end">
            <h3>
              Pelanggan
            </h3>
          </div>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-bordered datatable">
            <thead>
              <tr>
                <th>~</th>
                <th>Nama/Username</th>
                <th>Alamat pengiriman</th>
                <th>Hubungi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data as $key => $item) : ?>
                <tr>
                  <td><?= $key + 1; ?></td>
                  <td><?= $item['nama'] . '/' . $item['username'] ?></td>
                  <td><?= htmlspecialchars($item['alamat_pengiriman']) ?></td>
                  <td>
                    <a class="btn btn-success col-12" href="https://wa.me/<?= $item['nomor_wa']; ?>"><i
                        class="bi bi-whatsapp"></i>
                      <?= preg_replace_callback(
                        "/^(\d{2})(\d{3})(\d{3})(\d+)$/",
                        function ($matches) {
                          return "($matches[1]) $matches[2]-$matches[3]-$matches[4]";
                        },
                        $item['nomor_wa']
                      ); ?></a>
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