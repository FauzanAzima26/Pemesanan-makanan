<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row g-6">

    <div class="col-xxl-2 col-md-4 col-6">
      <div class="card h-100">
        <div class="card-body">
          <div class="badge p-2 bg-label-info mb-3 rounded">
            <i class="ti ti-list-details ti-28px"></i>
          </div>
          <h5 class="card-title mb-1">Jumlah Menu</h5>
          <p class="card-subtitle">Menu aktif</p>
          <p class="text-heading mb-3 mt-1"><?= $jumlah_menu_aktif ?></p>
        </div>
      </div>
    </div>

    <div class="col-xxl-2 col-md-4 col-6">
      <div class="card h-100">
        <div class="card-body">
          <div class="badge p-2 bg-label-info mb-3 rounded">
            <i class="ti ti-list-details ti-28px"></i>
          </div>
          <h5 class="card-title mb-1">Jumlah Menu</h5>
          <p class="card-subtitle">Menu tidak aktif</p>
          <p class="text-heading mb-3 mt-1"><?= $jumlah_menu_nonaktif ?></p>
        </div>
      </div>
    </div>

    <div class="col-xxl-2 col-md-4 col-6">
      <div class="card h-100">
        <div class="card-body">
          <div class="badge p-2 bg-label-success mb-3 rounded">
            <i class="ti ti-shopping-cart ti-28px"></i>
          </div>
          <h5 class="card-title mb-1">Jumlah Pesanan</h5>
          <p class="card-subtitle">Total order</p>
          <p class="text-heading mb-3 mt-1"><?= $jumlah_pesanan ?></p>
        </div>
      </div>
    </div>
  </div>
</div>