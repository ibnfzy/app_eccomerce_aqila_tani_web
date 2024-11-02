<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Panel Toko Aqila Tani</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="title" content="Aqila Tani">
  <?= $this->include('assets_panel/css'); ?>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  <div class="app-wrapper">
    <?= $this->include('user/layouts/navbar'); ?>

    <?= $this->include('user/layouts/sidebar'); ?>

    <main class="app-main">
      <div class="app-content mt-4">
        <?= $this->renderSection('content'); ?>
      </div>
    </main>

    <div class="modal fade" id="informasi" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5">Ubah Informasi Akun</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="/UserPanel/Informasi" method="post" id="formInformasi">
            <div class="modal-body">
              <div class="mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username"
                  value="<?= session('data_user')['username']; ?>">
              </div>
              <div class="mb-4">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama" id="nama"
                  value="<?= session('data_user')['nama']; ?>">
              </div>
              <div class="mb-4">
                <label for="alamat_pengiriman" class="form-label">Alamat Pengiriman</label>
                <input type="text" class="form-control" name="alamat_pengiriman" id="alamat_pengiriman"
                  value="<?= session('data_user')['alamat_pengiriman']; ?>">
              </div>
              <div class="mb-4">
                <label for="nomor_wa" class="form-label">Nomor Whatapp</label>
                <input type="number" class="form-control" name="nomor_wa" id="nomor_wa_i"
                  value="<?= session('data_user')['nomor_wa']; ?>">
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

    <div class="modal fade" id="passwordModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5">Ubah Password</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="/UserPanel/Password" method="post" id="formPassword">
            <div class="modal-body">
              <div class="mb-4">
                <label for="password" class="form-label">Password Baru</label>
                <input type="password" class="form-control" name="password" id="password">
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
  </div>
  <?= $this->include('assets_panel/script'); ?>

  <script>
    $('.select2').select2({
      dropdownParent: $('#tambah') || $('#edit')
    });

    $('.select2').attr('style', 'width: 100% !important; display: block !important;');

    new DataTable('.datatable', {
      responsive: true,
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/id.json'
      }
    });

    $('.summernote').summernote({
      placeholder: '1. ',
      tabsize: 2,
      height: 120,
      toolbar: [
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol']],
      ]
    });

    $('#formInformasi').on('submit', function(e) {
      e.preventDefault();
      let stilErr = false;

      $('#formInformasi input[data-maxlength]').each(function() {
        const maxLength = $(this).data('maxlength');
        const valLength = $(this).val().length;
        const label = $(this).closest('.mb-4').find('label').text();

        if (valLength > maxLength) {
          const error = `Maksimal ${maxLength} karakter di ${label}`;
          Command: toastr.error(error);
          stilErr = true;
        }
      });

      const no_wa = $('#kontak_wa_i').val();

      if (!/^62/.test(no_wa)) {
        Command: toastr.error('Nomor Whatsapp harus diawali dengan 62');
        stilErr = true;
      }

      if (!stilErr) {
        $('#formInformasi').unbind('submit').submit();
      }
    });

    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": true,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
  </script>

  <?= $this->renderSection('script'); ?>

  <?php
  if (session()->getFlashdata('dataMessage')) {
    foreach (session()->getFlashdata('dataMessage') as $item) {
      echo '<script>toastr["' .
        session()->getFlashdata('type-status') . '"]("' . $item . '")</script>';
    }
  }
  if (session()->getFlashdata('message')) {
    echo '<script>toastr["' .
      session()->getFlashdata('type-status') . '"]("' . session()->getFlashdata('message') . '")</script>';
  }
  ?>
</body>
<!--end::Body-->

</html>