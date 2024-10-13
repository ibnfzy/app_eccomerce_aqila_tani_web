<aside class="app-sidebar bg-success-subtle shadow" data-bs-theme="light">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <!--begin::Brand Link--> <a href="/OperatorPanel" class="brand-link"> <span class="fw-light text-body">Aqila Tani
        Operator Panel</span>
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
        <li class="nav-item"> <a href="/OperatorPanel/" class="nav-link"> <i class="nav-icon bi bi-person-circle"></i>
            <p>Operator</p>
          </a> </li>
        <li class="nav-item"> <a href="/OperatorPanel/Barang" class="nav-link"> <i class="nav-icon bi bi-box"></i>
            <p>Barang</p>
          </a> </li>
        <li class="nav-item"> <a href="/OperatorPanel/JenisBarang" class="nav-link"> <i class="nav-icon bi bi-tags"></i>
            <p>Jenis Barang</p>
          </a> </li>
        <li class="nav-item"> <a href="/OperatorPanel/Pelanggan" class="nav-link"> <i
              class="nav-icon bi bi-people-fill"></i>
            <p>Pelanggan</p>
          </a> </li>
        <li class="nav-item"> <a href="/OperatorPanel/Review" class="nav-link"> <i class="nav-icon bi bi-chat-dots"></i>
            <p>Review Pelanggan</p>
          </a> </li>
        <li class="nav-item"> <a href="/OperatorPanel/Transaksi" class="nav-link"> <i class="nav-icon bi bi-cart"></i>
            <p>Transaksi Aktif <span
                class="nav-badge badge text-bg-success"><?= session('totalTransaksiAktif') ;?></span></p>
          </a> </li>
        <li class="nav-item"> <a href="/OperatorPanel/HistoryTransaksi" class="nav-link"> <i
              class="nav-icon bi bi-clock-history"></i>
            <p>History Transaksi</p>
          </a> </li>
        <li class="nav-item"> <a href="/OperatorPanel/LaporanPenjualan" class="nav-link"> <i
              class="nav-icon bi bi-printer"></i>
            <p>Laporan Penjualan</p>
          </a> </li>
        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-pencil-square"></i>
            <p>Edit Informasi Toko</p>
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