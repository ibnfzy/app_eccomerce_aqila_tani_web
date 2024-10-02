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