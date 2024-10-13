<?= $this->extend('web/base'); ?>

<?= $this->section('content'); ?>

<?php
$total = 0;
?>

<h2 class="position-relative text-uppercase mx-xl-5 mb-4 text-success">
  Keranjang
</h2>

<div class="container-fluid pt-5" style="height: 60vh;">
  <form action="/Cart/Update" method="post">
    <div class="row px-xl-5">
      <div class="col-lg-8 table-responsive mb-5">
        <table class="table table-bordered border-success-subtle text-center mb-0">
          <thead class="text-dark">
            <tr>
              <th class="bg-success-subtle">Barang</th>
              <th class="bg-success-subtle">Harga Satuan</th>
              <th class="bg-success-subtle">Stok Tersedia</th>
              <th class="bg-success-subtle">Kuantitas</th>
              <th class="bg-success-subtle">Subtotal</th>
              <th class="bg-success-subtle">Hapus</th>
            </tr>
          </thead>
          <tbody class="align-middle">

            <?php if (empty($data)) : ?>
            <tr>
              <td colspan="6" class="text-center">Keranjang Kosong</td>
            </tr>
            <?php endif; ?>

            <?php foreach ($data as $key => $item) : ?>
            <input type="hidden" name="rowid[<?= $item['rowid'] ?>]" value="<?= $item['rowid'] ?>">
            <input type="hidden" name="stok[<?= $item['rowid'] ?>]" value="<?= $item['stok'] ?>">
            <input type="hidden" name="qtybutton[<?= $item['rowid'] ?>]" value="<?= $item['qty'] ?>">

            <tr>
              <td class="align-middle">
                <?= $item['name']; ?>
              </td>
              <td class="align-middle">Rp <?= number_format($item['price'], 0, ',', '.'); ?></td>
              <td class="align-middle"><?= $item['stok']; ?></td>
              <td class="align-middle">
                <div class="input-group quantity mx-auto" style="width: 100px;">
                  <div class="input-group-btn">
                    <button type="button" class="btn btn-sm btn-outline-success btn-minus">
                      <i class="fa fa-minus"></i>
                    </button>
                  </div>
                  <input type="text" class="form-control form-control-sm bg-light text-center qty quantity-input"
                    name="qtybutton[<?= $key ?>]" value="<?= $item['qty']; ?>" data-stok="<?= $item['stok']; ?>"
                    data-old-value="<?= $item['qty'] ?>">
                  <div class="input-group-btn">
                    <button type="button" class="btn btn-sm btn-outline-success btn-plus">
                      <i class="fa fa-plus"></i>
                    </button>
                  </div>
                </div>
              </td>
              <td class="align-middle">Rp <?= number_format($item['price'] * $item['qty'], 0, ',', '.'); ?>
              </td>
              <td class="align-middle"><a href="/Cart/Delete/<?= $item['rowid']; ?>" class="btn btn-sm btn-danger"><i
                    class="fa fa-times"></i></a></td>
            </tr>

            <?php $total += ($item['price'] * $item['qty']); ?>
            <?php endforeach ?>

          </tbody>
        </table>
      </div>
      <div class="col-lg-4">
        <button type="submit" id="btnUpdateCart" class="btn btn-outline-success w-100 mb-4" hidden>Update
          Keranjang</button>
        <div class="card border-success-subtle mb-5">
          <div class="card-header bg-success-subtle border-0">
            <h4 class="font-weight-semi-bold m-0">Keranjang Detail</h4>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between mb-3 pt-1">
              <h6 class="font-weight-medium">Subtotal</h6>
              <h6 class="font-weight-medium">Rp <?= number_format($total, 0, ',', '.'); ?></h6>
            </div>
            <div class="d-flex justify-content-between">
              <h6 class="font-weight-medium">Ongkir</h6>
              <h6 class="font-weight-medium">Rp 10.000</h6>
            </div>
          </div>
          <div class="card-footer border-success-subtle bg-transparent">
            <div class="d-flex justify-content-between mt-2">
              <h5 class="font-weight-bold">Total</h5>
              <h5 class="font-weight-bold">Rp <?= number_format($total + 10000, 0, ',', '.'); ?></h5>
            </div>
            <a href="/UserPanel/Checkout" id="btnCheckout" class="btn btn-block btn-outline-success my-3 py-3">Proceed
              To Checkout</a>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<?= $this->endSection(); ?>