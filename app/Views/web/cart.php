<?= $this->extend('web/base'); ?>

<?= $this->section('content'); ?>

<h2 class="position-relative text-uppercase mx-xl-5 mb-4 text-success">
  Keranjang
</h2>

<div class="container-fluid pt-5" style="height: 60vh;">
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
          <tr>
            <td class="align-middle"><img src="/web_assets/img/product-1.jpg" alt="" style="width: 50px;"> Colorful
              Stylish Shirt
            </td>
            <td class="align-middle">$150</td>
            <td class="align-middle">2</td>
            <td class="align-middle">
              <div class="input-group quantity mx-auto" style="width: 100px;">
                <div class="input-group-btn">
                  <button class="btn btn-sm btn-outline-success btn-minus">
                    <i class="fa fa-minus"></i>
                  </button>
                </div>
                <input type="text" class="form-control form-control-sm bg-light text-center" value="1">
                <div class="input-group-btn">
                  <button class="btn btn-sm btn-outline-success btn-plus">
                    <i class="fa fa-plus"></i>
                  </button>
                </div>
              </div>
            </td>
            <td class="align-middle">$150</td>
            <td class="align-middle"><button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-lg-4">
      <div class="card border-success-subtle mb-5">
        <div class="card-header bg-success-subtle border-0">
          <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-between mb-3 pt-1">
            <h6 class="font-weight-medium">Subtotal</h6>
            <h6 class="font-weight-medium">$150</h6>
          </div>
          <div class="d-flex justify-content-between">
            <h6 class="font-weight-medium">Shipping</h6>
            <h6 class="font-weight-medium">$10</h6>
          </div>
        </div>
        <div class="card-footer border-success-subtle bg-transparent">
          <div class="d-flex justify-content-between mt-2">
            <h5 class="font-weight-bold">Total</h5>
            <h5 class="font-weight-bold">$160</h5>
          </div>
          <button class="btn btn-block btn-outline-success my-3 py-3">Proceed To Checkout</button>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>