<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css'
    integrity='sha512-6S2HWzVFxruDlZxI3sXOZZ4/eJ8AcxkQH1+JjSe/ONCEqR9L4Ysq5JdT5ipqtzU7WHalNwzwBv+iE51gNHJNqQ=='
    crossorigin='anonymous' />
  <style>
  /* Background gradient animated (blue and white) */
  body {
    height: 100vh;
    background: linear-gradient(45deg, #b3cde0, #ffffff, #6497b1, #ffffff, #005b96);
    background-size: 400% 400%;
    animation: gradientAnimation 15s ease infinite;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  @keyframes gradientAnimation {
    0% {
      background-position: 0% 50%;
    }

    50% {
      background-position: 100% 50%;
    }

    100% {
      background-position: 0% 50%;
    }
  }

  /* Container form styling */
  .login-container {
    background-color: #ffffff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
  }

  /* Form fields styling */
  .form-control {
    border-radius: 5px;
  }

  /* Submit button */
  .btn-primary {
    width: 100%;
    border-radius: 5px;
  }

  /* Centering form */
  .form-group {
    margin-bottom: 20px;
  }
  </style>
</head>

<body>

  <div class="login-container">
    <h3 class="text-center mb-4">Daftar</h3>

    <form id="form" method="post" enctype="application/x-www-form-urlencoded" action="/Auth/User/Daftar">
      <div class="form-group mb-3">
        <label for="nama" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" id="nama" name="nama">
      </div>

      <div class="form-group mb-3">
        <label for="username" class="form-label">username</label>
        <input type="text" class="form-control" id="username" name="username">
      </div>

      <div class="form-group mb-3">
        <label for="username" class="form-label">username</label>
        <input type="number" class="form-control" name="nomor_wa" id="nomor_wa">
      </div>

      <div class="form-group mb-4">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
      </div>

      <div class="form-group mb-4">
        <label for="password" class="form-label">Konfirmasi Password</label>
        <input type="password" class="form-control" id="konfirmasi_password" placeholder="Password"
          nama="konfirmasi_password" required>
      </div>

      <div class="form-group mb-4">
        <label for="alamat_pengiriman">Alamat Pengiriman</label>
        <textarea name="alamat_pengiriman" id="alamat_pengiriman" class="form-control"></textarea>
      </div>

      <button type="submit" class="btn btn-outline-success col-12">Daftar</button>
    </form>

    <p class="text-center mt-3">Sudah punya akun? <a href="/Auth/User/Login">Login</a> | Kembali <a href="/">kehalaman
        depan</a></p>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js'
    integrity='sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=='
    crossorigin='anonymous'></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js'
    integrity='sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ=='
    crossorigin='anonymous'></script>

  <script>
  $('#form').on('submit', function(e) {
    e.preventDefault();
    let stilErr = false;

    const password = $('#password').val();
    const konfirmasi_password = $('#konfirmasi_password').val();

    if (password !== konfirmasi_password) {
      Command: toastr.error('Password tidak sama');
      stilErr = true;
    }

    const no_wa = $('#nomor_wa').val();

    if (!/^62/.test(no_wa)) {
      Command: toastr.error('Nomor Whatsapp harus diawali dengan 62');
      stilErr = true;
    }

    if (!stilErr) {
      $('#form').unbind('submit').submit();
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

</html>