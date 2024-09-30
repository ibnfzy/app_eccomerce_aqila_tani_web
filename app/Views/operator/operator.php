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
              Tabel Operator
            </h3>
          </div>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-bordered datatable">
            <thead>
              <tr>
                <th>~</th>
                <th>Username</th>
                <th>Nama Lengkap</th>
                <th>Roles</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data as $key => $item) : ?>
              <tr>
                <td><?= $key + 1; ?></td>
                <td><?= $item['username']; ?></td>
                <td><?= $item['name']; ?></td>
                <td><?= $item['role']; ?></td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-success"
                      onclick="edit('<?= $item['id_operator'] ?>', '<?= $item['username'] ?>', '<?= $item['name'] ?>', '<?= $item['role'] ?>')"><i
                        class="fa-solid fa-pen-to-square"></i></button>
                    <button class="btn btn-primary" onclick="password('<?= $item['id_operator'] ?>')"><i
                        class="fa-solid fa-key"></i></button>
                    <a href="/OperatorPanel/Operator/<?= $item['id_operator'] ?>" class="btn btn-danger"><i
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
      <form action="/OperatorPanel/Operator" method="post" enctype="application/x-www-form-urlencoded" id="form">
        <div class="modal-body">
          <div class="mb-4">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" data-maxlength="255" required>
            <small class="form-text"></small>
          </div>
          <div class="mb-4">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-control" required>
              <option value="admin">Admin</option>
              <option value="pemilik">Pemilik</option>
            </select>
            <small class="form-text"></small>
          </div>
          <div class="mb-4">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" data-maxlength="20" required>
            <small class="form-text"></small>
          </div>
          <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="mb-4">
            <label for="konfirmasi_password" class="form-label">Konfirmasi Password</label>
            <input type="konfirmasi_password" class="form-control" id="konfirmasi_password" required>
            <small id="konfirmasi_password-error" class="form-text text-danger"></small>
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

<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="editlLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editlLabel">Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/OperatorPanel/Operator/Password" method="post" enctype="application/x-www-form-urlencoded"
        id="formPassword">
        <input type="hidden" id="id_operator-password" name="id_operator">
        <div class="modal-body">
          <div class="mb-4">
            <label for="password-baru" class="form-label">Password Baru</label>
            <input type="password" class="form-control" id="password-baru" name="password" required>
          </div>
          <div class="mb-4">
            <label for="konfirmasi_password-baru" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" id="konfirmasi_password-baru" required>
            <small id="konfirmasi_password-baru-error" class="form-text text-danger"></small>
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

<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editlLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editlLabel">Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/OperatorPanel/Operator/Update" method="post" enctype="application/x-www-form-urlencoded"
        id="formEdit">
        <input type="hidden" name="id_operator" id="id_operator-edit" required>
        <div class="modal-body">
          <div class="mb-4">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name-edit" name="name" data-maxlength="255" required>
            <small class="form-text"></small>
          </div>
          <div class="mb-4">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role-edit" class="form-control" required>
              <option value="admin">Admin</option>
              <option value="pemilik">Pemilik</option>
            </select>
            <small class="form-text"></small>
          </div>
          <div class="mb-4">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username-edit" name="username" data-maxlength="20" required>
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
const edit = (id, username, name, role) => {
  $('#id_operator-edit').val(id);
  $('#name-edit').val(name);
  $('#role-edit option[value="' + role + '"]').prop('selected', true);
  $('#username-edit').val(username);
  $('#edit').modal('show');
};

const password = (id) => {
  $('#id_operator-password').val(id);
  $('#passwordModal').modal('show');
};

$('#formPassword').on('submit', function(e) {
  e.preventDefault();

  const password = $('#password-baru').val();
  const konfirmasi_password = $('#konfirmasi_password-baru').val();

  if (password !== konfirmasi_password) {
    $('#konfirmasi_password-baru-error').text('Password tidak sama');
    return;
  } else {
    $('#formPassword').unbind('submit').submit();
  }
});

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