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

    .rating {
      direction: rtl;
      font-size: 2em;
      display: flex;
      justify-content: center;
      gap: 10px;
    }

    .rating input {
      display: none;
    }

    .rating label {
      color: #ccc;
      cursor: pointer;
    }

    .rating input:checked~label {
      color: #f5b301;
    }

    .rating label:hover,
    .rating label:hover~label {
      color: #f5b301;
    }
  </style>
</head>

<?php
$subtotal = 0;
?>

<body>

  <?php
  helper('badge');
  $controller = new \App\Controllers\UserPanel;
  ?>

  <div class="container my-5">
    <div class="invoice-container">
      <div class="row">
        <div class="col-md-6">
          <h2 class="mb-4">Invoice</h2>
        </div>
        <div class="col-md-6 text-md-end">
          <div>
            Status :
            <?= status($data['status_transaksi']); ?>
          </div>
        </div>
      </div>

      <!-- Shipping Information -->
      <div class="row">
        <div class="col-md-6">
          <h5>Pengiriman Dari:</h5>
          <p>
            <?= $dataToko['nama_toko']; ?><br>
            Alamat: <?= $dataToko['alamat']; ?><br>
            Telepon: <?= $dataToko['kontak_wa']; ?>
          </p>
        </div>
        <div class="col-md-6 text-md-end">
          <h5>Pengiriman Ke:</h5>
          <p>
            <?= $dataCustomer['nama']; ?><br>
            Alamat: <?= $dataCustomer['alamat_pengiriman']; ?><br>
            Telepon: <?= $dataCustomer['nomor_wa']; ?>
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
          <?php foreach ($dataDetail as $key => $item) : ?>
            <tr>
              <td><?= $key + 1; ?></td>
              <td>
                <?= $item['nama_barang']; ?>

                <?php if ($data['status_transaksi'] == 'Selesai' && session('user_logged_in')) : ?>

                  <?php if (!$controller->checkIfReviewExist($data['id_transaksi'], $item['id_barang'])) : ?><button
                      class="btn btn-primary float-end"
                      onclick="review('<?= $data['id_transaksi'] ?>', '<?= $item['id_barang'] ?>')">Berikan Review</button>
                  <?php endif ?>
                <?php endif ?>
              </td>
              <td><?= $item['qty']; ?></td>
              <td>Rp<?= number_format($item['harga'], 0, ',', '.') ?></td>
              <td>Rp<?= number_format($item['harga'] * $item['qty'], 0, ',', '.') ?></td>
            </tr>
            <?php $subtotal += $item['harga'] * $item['qty']; ?>
          <?php endforeach ?>
          <!-- Add more rows as needed -->
        </tbody>
        <tfoot>
          <tr>
            <th colspan="4" class="text-end">Total Harga</th>
            <th>Rp<?= number_format($subtotal, 0, ',', '.') ?></th>
          </tr>
          <tr>
            <th colspan="4" class="text-end">Ongkos Kirim</th>
            <th>Rp10.000</th>
          </tr>
          <tr>
            <th colspan="4" class="text-end">Total Bayar</th>
            <th>Rp<?= number_format($subtotal + 10000, 0, ',', '.') ?></th>
          </tr>
        </tfoot>
      </table>

      <!-- Bank Information -->
      <div class="mt-4">
        <h5>Informasi Pembayaran:</h5>
        <p>Silakan transfer ke nomor rekening berikut:</p>
        <p><?= $dataToko['rekening_toko']; ?></p>
      </div>

      <!-- Upload Proof of Payment Button -->
      <?php if ($data['status_transaksi'] == 'Menunggu Pembayaran' && session('user_logged_in')) : ?>
        <!-- TRUE -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
          Upload Bukti Pembayaran
        </button>
      <?php endif ?>

      <!-- Modal for Uploading Proof of Payment -->
      <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="uploadModalLabel">Upload Bukti Pembayaran</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/UserPanel/Bayar" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id_transaksi" value="<?= $data['id_transaksi'] ?>">
              <div class="modal-body">
                <div class="mb-3 modal-text" id="info">
                  <h5>Informasi Pembayaran:</h5>
                  <p>Silakan transfer ke nomor rekening berikut:</p>
                  <p><?= $dataToko['rekening_toko']; ?></p>
                </div>
                <div class="mb-3">
                  <label for="jenis_bayar">Jenis Pembayaran</label>
                  <select name="jenis_bayar" id="jenis_bayar" class="form-select">
                    <option value="Transfer">Transfer</option>
                    <option value="COD">COD</option>
                  </select>
                </div>
                <div class="mb-3" id="bukti_bayar_group">
                  <label for="uploadFile" class="form-label">Pilih file bukti pembayaran:</label>
                  <input type="file" class="form-control" id="bukti_bayar" name="bukti_bayar"
                    accept="image/jpg, image/png, image/jpeg" required>
                  <small class="text-muted">Total yang harus dibayar : <span
                      class="badge text-bg-primary">Rp<?= number_format($subtotal + 10000, 0, ',', '.') ?></span></small>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Upload</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="reviewModalLabel">Review Barang</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/UserPanel/Review" method="post">
              <input type="hidden" name="id_transaksi" id="id_transaksi">
              <input type="hidden" name="id_barang" id="id_barang">
              <div class="modal-body">
                <div class="mb-3">
                  <div class="rating">
                    <input type="radio" name="rating" id="star5" value="5"><label for="star5">&#9733;</label>
                    <input type="radio" name="rating" id="star4" value="4"><label for="star4">&#9733;</label>
                    <input type="radio" name="rating" id="star3" value="3"><label for="star3">&#9733;</label>
                    <input type="radio" name="rating" id="star2" value="2"><label for="star2">&#9733;</label>
                    <input type="radio" name="rating" id="star1" value="1"><label for="star1">&#9733;</label>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="review" class="form-label">Review</label>
                  <input type="text" id="review" name="review" class="form-control">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>

    <div class="container py-2 text-center align-bottom">
      <p class="text-muted">Checkout pada tanggal <?= $data['created_at']; ?> (System)</p>
    </div>

    <p class="text-center mt-4">Terima kasih telah membeli di toko kami!<br>
      Kembali ke <a href="<?= session('user_logged_in') ? '/UserPanel' : '/OperatorPanel' ?>">Panel</a></p>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js'
    integrity='sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=='
    crossorigin='anonymous'></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js'
    integrity='sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ=='
    crossorigin='anonymous'></script>

  <script>
    $('#jenis_bayar').on('change', function() {
      $('#bukti_bayar_group').removeAttr('hidden');
      $('#info').removeAttr('hidden');
      $('#bukti_bayar').attr('required', 'required');

      if ($('#jenis_bayar').val() == 'COD') {
        $('#bukti_bayar_group').attr('hidden', 'hidden');
        $('#info').attr('hidden', 'hidden');
        $('#bukti_bayar').removeAttr('required');
      }
    });

    const review = (id_transaksi, id_barang) => {
      $('#id_transaksi').val(id_transaksi);
      $('#id_barang').val(id_barang);
      $('#reviewModal').modal('show')
    };

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