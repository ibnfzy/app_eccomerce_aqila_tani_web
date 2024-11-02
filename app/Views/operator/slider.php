<?= $this->extend('operator/base'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
  <!--begin::Row-->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah"> <i class="bi bi-plus"></i>
            Tambah Data</button>

          <div class="float-end">
            <h3>
              Tabel Slider
            </h3>
          </div>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-bordered datatable">
            <thead>
              <tr>
                <th>~</th>
                <th>Gambar</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data as $key => $item) : ?>
              <tr>
                <td><?= $key + 1; ?></td>
                <td>
                  <a href="/uploads/<?= $item['file']; ?>" data-fancybox="slider">
                    <img src="/uploads/<?= $item['file']; ?>" alt="" class="img-fluid w-25">
                  </a>
                </td>
                <td>
                  <div class="btn-group">
                    <a href="/OperatorPanel/Slider/<?= $item['id_slider'] ?>" class="btn btn-danger"><i
                        class="fa-solid fa-trash"></i></a>
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

<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahlLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tambahlLabel">Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/OperatorPanel/Slider" method="post" enctype="multipart/form-data" id="form">
        <div class="modal-body">
          <div class="mb-4">
            <label for="file" class="form-label">File</label>
            <input type="file" class="form-control" id="file" name="file" required>
            <small class="form-text"></small>
          </div>
        </div>
        <div class=" modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>