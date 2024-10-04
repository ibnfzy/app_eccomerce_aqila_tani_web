<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css'
    integrity='sha512-6S2HWzVFxruDlZxI3sXOZZ4/eJ8AcxkQH1+JjSe/ONCEqR9L4Ysq5JdT5ipqtzU7WHalNwzwBv+iE51gNHJNqQ=='
    crossorigin='anonymous' />
  <style>
  body {
    background-color: #f5f5f5;
    /* Warna abu-abu pada latar body */
  }

  .invoice-container {
    background-color: #ffffff;
    /* Warna putih untuk container */
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    /* Efek bayangan agar terlihat seperti kertas */
  }
  </style>
</head>

<body>

  <div class="container my-5">
    <div class="invoice-container">
      <h2 class="mb-4">Invoice</h2>

      <!-- Shipping Information -->
      <div class="row">
        <div class="col-md-6">
          <h5>Pengiriman Dari:</h5>
          <p>
            Nama Toko<br>
            Alamat: Jl. Contoh No.1<br>
            Kota: Jakarta<br>
            Telepon: 08123456789
          </p>
        </div>
        <div class="col-md-6 text-md-end">
          <h5>Pengiriman Ke:</h5>
          <p>
            Nama Pembeli<br>
            Alamat: Jl. Contoh No.2<br>
            Kota: Bandung<br>
            Telepon: 08987654321
          </p>
        </div>
      </div>

      <!-- Purchased Items Table -->
      <table class="table table-bordered mt-4">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Kuantitas</th>
            <th>Harga Satuan</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Barang A</td>
            <td>2</td>
            <td>Rp50.000</td>
            <td>Rp100.000</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Barang B</td>
            <td>1</td>
            <td>Rp75.000</td>
            <td>Rp75.000</td>
          </tr>
          <!-- Add more rows as needed -->
        </tbody>
        <tfoot>
          <tr>
            <th colspan="4" class="text-end">Total Harga</th>
            <th>Rp175.000</th>
          </tr>
          <tr>
            <th colspan="4" class="text-end">Ongkos Kirim</th>
            <th>Rp25.000</th>
          </tr>
          <tr>
            <th colspan="4" class="text-end">Total Bayar</th>
            <th>Rp200.000</th>
          </tr>
        </tfoot>
      </table>

      <!-- Bank Information -->
      <div class="mt-4">
        <h5>Informasi Pembayaran:</h5>
        <p>Silakan transfer ke nomor rekening berikut:</p>
        <p><strong>BANK ABC</strong><br>No. Rekening: 1234567890<br>Atas Nama: Nama Toko</p>
      </div>

      <!-- Upload Proof of Payment Button -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
        Upload Bukti Pembayaran
      </button>

      <!-- Modal for Uploading Proof of Payment -->
      <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="uploadModalLabel">Upload Bukti Pembayaran</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form>
                <div class="mb-3">
                  <label for="uploadFile" class="form-label">Pilih file bukti pembayaran:</label>
                  <input type="file" class="form-control" id="uploadFile">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Upload</button>
            </div>
          </div>
        </div>
      </div>

    </div>

    <p class="text-center mt-4">Terima kasih telah membeli di toko kami!<br>
      Kembali ke <a href="/UserPanel">Panel</a></p>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js'
    integrity='sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=='
    crossorigin='anonymous'></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js'
    integrity='sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ=='
    crossorigin='anonymous'></script>

  <script>
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