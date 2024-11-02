<aside class="app-sidebar bg-success-subtle shadow" data-bs-theme="light">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <!--begin::Brand Link--> <a href="/OperatorPanel" class="brand-link"> <span class="fw-light text-body">Aqila Tani
        Pelanggan Panel</span>
      <!--end::Brand Text-->
    </a>
    <!--end::Brand Link-->
  </div>
  <!--end::Sidebar Brand-->
  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <!--begin::Sidebar Menu-->
      <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
        <li class="nav-item"> <a href="/UserPanel/Home" class="nav-link"> <i class="nav-icon bi bi-cart"></i>
            <p>Transaksi <span class="nav-badge badge text-bg-success"><?= session('totalTransaksiAktifCust'); ?></span>
            </p>
          </a> </li>
        <li class="nav-item"> <a href="/UserPanel/Home" class="nav-link"> <i class="nav-icon bi bi-clock-history"></i>
            <p>Transaksi History</p>
          </a> </li>
        <li class="nav-item"> <a href="/UserPanel/Review" class="nav-link"> <i class="nav-icon bi bi-chat"></i>
            <p>Review</p>
          </a> </li>
        <li class="nav-item"> <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#informasi"> <i
              class="nav-icon bi bi-pencil-square"></i>
            <p>Edit Informasi Akun</p>
          </a> </li>

        <li class="nav-item"> <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#passwordModal"> <i
              class="nav-icon bi bi-key"></i>
            <p>Ganti Password</p>
          </a> </li>

        <li class="nav-item"> <a href="/Katalog" class="nav-link"> <i class="nav-icon bi bi-box"></i>
            <p>Katalog Barang</p>
          </a> </li>

        <li class="nav-item"> <a href="https://wa.me/6285158109999" class="nav-link bg-success text-white"> <i
              class="nav-icon bi bi-whatsapp"></i>
            <p>Hubungi Kami</p>
          </a> </li>

        <!-- <li class="nav-item"> <a href="#!" class="nav-link"> <i class="nav-icon bi bi-envelope"></i>
            <p>
              Arsip Persuratan
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"> <a href="/OperatorPanel/SuratMasuk" class="nav-link"> <i
                  class="nav-icon bi bi-circle"></i>
                <p>Surat Masuk</p>
              </a> </li>
            <li class="nav-item"> <a href="/OperatorPanel/SuratKeluar" class="nav-link"> <i
                  class="nav-icon bi bi-circle"></i>
                <p>Surat Keluar</p>
              </a> </li>
          </ul>
        </li> -->
      </ul>
      <!--end::Sidebar Menu-->
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>