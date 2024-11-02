<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Penjualan</title>
  <style>
  @page {
    size: A4;
    margin: 15mm 10mm 15mm 10mm;

    @bottom-right {
      content: "Halaman "counter(page) " dari "counter(pages);
    }
  }

  body {
    font-family: Arial, sans-serif;
    font-size: 12px;
    line-height: 1.4;
    color: #333;
    margin: 0;
    padding: 0;
  }

  .container {
    max-width: 100%;
    margin: 0 auto;
    padding: 20px;
  }

  .title {
    text-align: center;
    margin-bottom: 20px;
  }

  .title h2 {
    margin: 0;
    color: #444;
  }

  .title h5 {
    margin: 5px 0;
    color: #666;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
  }

  th,
  td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
  }

  th {
    background-color: #f2f2f2;
    font-weight: bold;
    text-transform: uppercase;
  }

  tr:nth-child(even) {
    background-color: #f9f9f9;
  }

  .text-right {
    text-align: right;
  }

  .text-center {
    text-align: center;
  }

  .summary {
    margin-top: 20px;
  }

  .summary p {
    margin: 5px 0;
  }

  @media print {

    html,
    body {
      width: 210mm;
      height: 297mm;
    }

    .container {
      width: 100%;
      max-width: none;
    }

    thead {
      display: table-header-group;
    }

    tfoot {
      display: table-footer-group;
    }

    button {
      display: none;
    }

    body {
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }

    #debug-icon {
      display: none;
    }
  }

  @media screen {
    .container {
      max-width: 900px;
    }
  }

  /* kop */
  /* kop */
  .header {
    display: flex;
    margin-bottom: 15px;
    border-bottom: 2px solid #000;
    padding-bottom: 30px;
    justify-content: center;
  }

  .logo-container {
    flex: 0 0 23%;
    padding-left: 80px;
  }

  .logo {
    width: 100%;
    max-width: 90px;
    height: auto;
    float: right;
  }

  .company-info {
    flex: 0 0 75%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 90px;
    align-items: center;
    margin-right: 20em;
  }

  .company-name {
    font-size: 18pt;
    font-weight: bold;
    margin-bottom: 5px;
    text-align: center;
  }

  .company-address {
    font-size: 10pt;
    line-height: 1.3;
    text-align: center;
  }

  .document-title {
    font-size: 16pt;
    font-weight: bold;
    margin-top: 15px;
    text-align: center;
    clear: both;
  }
  </style>



</head>

<body>
  <div class="container">
    <?php
    $total = 0;

    function rupiah($angka)
    {
      return "Rp " . number_format($angka, 0, ',', '.');
    }
    ?>
    <div class="header">
      <div class="logo-container">
        <!-- <img src="{{asset('/cust/images/emot-batu.png')}}" alt="Batu Keriting Logo" class="logo"> -->
      </div>
      <div class="company-info">
        <div class="company-name">Toko Aqila Tani</div>
        <div class="company-address">
          <?= session('data_toko')['alamat']; ?><br>
          Telp: <?= session('data_toko')['kontak_wa']; ?>
        </div>
      </div>
    </div>


    <div class="title">
      <h2>Laporan Penjualan</h2>
      <h5>Periode <?= $date; ?></h5>
    </div>

    <?php if (count($data) == 0) : ?>
    <h3 style="color: red; text-align: center;">Tidak Ada Data</h3>
    <?php endif ?>

    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>Nama Customer</th>
          <th>Kuantitas</th>
          <th>Total Harga</th>
          <th>Jenis Pembayaran</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data as $key => $item) : ?>
        <tr>
          <td class="text-center"><?= $key + 1; ?></td>
          <td><?= date('d F Y', strtotime($item['created_at'])); ?></td>
          <td><?= $item['nama_user']; ?></td>
          <td><?= $item['total_kuantitas']; ?></td>
          <td><?= rupiah($item['total_harga']); ?></td>
          <td><?= $item['jenis_bayar']; ?></td>
        </tr>

        <?php $total += $item['total_harga']; ?>
        <?php endforeach ?>
      </tbody>
    </table>

    <div class="summary">
      <p class="text-right">Total Pendapatan: <strong><?= rupiah($total); ?></strong></p>
      <p class="text-right">Nama Admin: <strong><?= session('data_operator')['name']; ?></strong></p>
    </div>
  </div>

  <button onclick="printFullScreen()"
    style="position: fixed; bottom: 20px; right: 20px; padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">
    Print Laporan
  </button>

  <script>
  function printFullScreen() {
    window.print();
  }

  window.onbeforeprint = function() {
    // Menyembunyikan tombol print sebelum mencetak
    document.querySelector('button').style.display = 'none';
  };

  window.onafterprint = function() {
    // Menampilkan kembali tombol print setelah mencetak
    document.querySelector('button').style.display = 'block';
  };
  </script>
</body>

</html>