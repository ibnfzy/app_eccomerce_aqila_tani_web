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
              Tabel Barang
            </h3>
          </div>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-bordered datatable">
            <thead>
              <tr>
                <th>~</th>
                <th>Gambar</th>
                <th>Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data as $key => $item) : ?>
                <tr>
                  <td><?= $key + 1; ?></td>
                  <td><button class="btn btn-success" onclick="image('<?= $item['id_barang'] ?>')"><i
                        class="fa-solid fa-image"></i></button></td>
                  <td><?= $item['nama_barang']; ?></td>
                  <td>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                  <td><?= $item['stok']; ?></td>
                  <td>
                    <div class="btn-group">
                      <button class="btn btn-success"
                        onclick="edit('<?= $item['id_barang'] ?>', '<?= $item['nama_barang'] ?>', '<?= $item['harga'] ?>', '<?= $item['stok'] ?>')"><i
                          class="fa-solid fa-pen-to-square"></i></button>
                      <a href="/OperatorPanel/Barang/<?= $item['id_barang'] ?>" class="btn btn-danger"><i
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
      <form action="/OperatorPanel/Barang" method="post" enctype="multipart/form-data" id="form">
        <div class="modal-body">
          <div class="mb-4">
            <label for="nama_barang" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" data-maxlength="255" required>
            <small class="form-text"></small>
          </div>
          <div class="mb-4">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" required>
            <small class="form-text"></small>
          </div>
          <div class="mb-4">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" data-maxlength="255" required>
            <small class="form-text"></small>
          </div>
          <div class="mb-4">
            <label for="images" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="images" name="images" required>
            <small class="form-text"></small>
          </div>
          <div class="mb-4">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" required></textarea>
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

<div class="modal fade" id="gambar" tabindex="-1" aria-labelledby="editlLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editlLabel">Gambar</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row" id="imagesGrid">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="tambahGambar">Tambah Gambar</button>
      </div>
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
      <form action="/OperatorPanel/Barang/Update" method="post" enctype="multipart/form-data" id="formEdit">
        <input type="hidden" name="id_barang" id="id_barang-edit" required>
        <div class="modal-body">
          <div class="mb-4">
            <label for="nama_barang" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama_barang-edit" name="nama_barang" data-maxlength="255"
              required>
            <small class="form-text"></small>
          </div>
          <div class="mb-4">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga-edit" name="harga" required>
            <small class="form-text"></small>
          </div>
          <div class="mb-4">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stok-edit" name="stok" required>
            <small class="form-text"></small>
          </div>
          <div class="mb-4">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi-edit" class="form-control" required></textarea>
            <small class="form-text"></small>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="tambahGambar" tabindex="-1" aria-labelledby="editlLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editlLabel">Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/OperatorPanel/Barang/Gambar" method="post" enctype="multipart/form-data" id="formGambar">
        <input type="hidden" name="id_barang" id="id_barang-gambar" required>
        <div class="modal-body">
          <div class="mb-4">
            <label for="images-gambar" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="images-gambar" name="images" required>
            <small class="form-text"></small>
          </div>
        </div>
        <div class="modal-footer">
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
  const edit = (id, nama_barang, harga, stok) => {
    $('#id_barang-edit').val(id);
    $('#nama_barang-edit').val(nama_barang);
    $('#harga-edit').val(harga);
    $('#stok-edit').val(stok);
    $('#edit').modal('show');
  };

  const image = (id_barang) => {
    $.ajax({
      type: "POST",
      url: "/OperatorPanel/Barang/GetImage",
      data: {
        id_barang: id_barang
      },
      dataType: "JSON",
      success: function(response) {
        const data = response.data;
        let html = '';

        if (data.length > 0) {
          for (let item in data) {
            const fileUrl = '/uploads/' + data[item];

            html += `
            <div class="col-md-4 mb-4">
              <div class="position-relative">
                <img src="${fileUrl}" class="img-fluid img-thumbnail" alt="Image">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" onclick="deleteImage('${data[item]}', '${id_barang}')"></button>
              </div>
            </div>
            `;
          }
        } else {
          html += `
          <div class="col-md-12 mb-4">
            <div class="position-relative">
              <p class="text-center">Tidak ada gambar</p>
            </div>
          </div>
          `;
        }

        $('#imagesGrid').html(html);
        $('#tambahGambar').attr('onclick', `tambahGambar('${id_barang}')`);
        $('#gambar').modal('show');
      }
    });
  };

  const deleteImage = (fileName, id_barang) => {
    $.ajax({
      type: "POST",
      url: "/OperatorPanel/Barang/DeleteImage",
      data: {
        fileName: fileName,
        id_barang: id_barang
      },
      dataType: "JSON",
      success: function(response) {
        if (response.success) {
          Command: toastr.success(response.message);
          image(response.id_barang);
        }
        else {
          Command: toastr.error(response.message);
        }
      }
    });
  }

  const tambahGambar = (id_barang) => {
    $('#id_barang-gambar').val(id_barang);
    $('#tambahGambar').modal('show');
  };

  $('#formEdit').on('submit', function(e) {
    e.preventDefault();
    let stilErr = false;

    $('#formEdit input[data-maxlength]').each(function() {
      const maxLength = $(this).data('maxlength');
      const valLength = $(this).val().length;
      const label = $(this).closest('.mb-4').find('label').text();

      if (valLength > maxLength) {
        const error = `Maksimal ${maxLength} karakter di ${label}`;
        Command: toastr.error(error);
        stilErr = true;
      }
    });

    if (!stilErr) {
      $('#formEdit').unbind('submit').submit();
    }
  });

  $('#form').on('submit', function(e) {
    e.preventDefault();
    let stilErr = false;

    $('#form input[data-maxlength]').each(function() {
      const maxLength = $(this).data('maxlength');
      const valLength = $(this).val().length;
      const label = $(this).closest('.mb-4').find('label').text();

      if (valLength > maxLength) {
        const error = `Maksimal ${maxLength} karakter di ${label}`;
        Command: toastr.error(error);
        stilErr = true;
      }
    });

    const password = $('#password').val();
    const konfirmasi_password = $('#konfirmasi_password').val();

    if (password !== konfirmasi_password) {
      Command: toastr.error('Password tidak sama');
      stilErr = true;
    }

    if (!stilErr) {
      $('#form').unbind('submit').submit();
    }
  });
</script>

<?= $this->endSection(); ?>