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
              Tabel Jenis Barang
            </h3>
          </div>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-bordered datatable">
            <thead>
              <tr>
                <th>~</th>
                <th>Jenis</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data as $key => $item) : ?>
                <tr>
                  <td><?= $key + 1; ?></td>
                  <td><?= $item['nama']; ?></td>
                  <td>
                    <div class="btn-group">
                      <button class="btn btn-success"
                        onclick="edit('<?= $item['id_jenis_barang'] ?>', '<?= $item['nama'] ?>')"><i
                          class="fa-solid fa-pen-to-square"></i></button>
                      <a href="/OperatorPanel/JenisBarang/<?= $item['id_jenis_barang'] ?>" class="btn btn-danger"><i
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
      <form action="/OperatorPanel/JenisBarang" method="post" enctype="multipart/form-data" id="form">
        <div class="modal-body">
          <div class="mb-4">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" data-maxlength="255" required>
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

<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editlLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editlLabel">Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/OperatorPanel/JenisBarang/Update" method="post" enctype="multipart/form-data" id="formEdit">
        <input type="hidden" name="id_jenis_barang" id="id_jenis_barang">
        <div class="modal-body">
          <div class="mb-4">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama-edit" name="nama" data-maxlength="255" required>
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

<?= $this->section('script'); ?>

<script>
  const edit = (id_jenis_barang, nama) => {
    $('#id_jenis_barang').val(id_jenis_barang);
    $('#nama-edit').val(nama);
    $('#edit').modal('show')
  };
</script>

<?= $this->endSection(); ?>