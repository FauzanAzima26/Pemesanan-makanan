<div class="modal fade" id="pesanModal<?= $menu->id ?>" tabindex="-1" aria-labelledby="pesanModalLabel<?= $menu->id ?>" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= site_url('order/create') ?>" method="post" class="modal-content">
      <input type="hidden" name="menu_id" value="<?= $menu->id ?>">
      <input type="hidden" name="price" value="<?= $menu->price ?>">

      <div class="modal-header">
        <h5 class="modal-title" id="pesanModalLabel<?= $menu->id ?>">Pesan: <?= $menu->name ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="qty<?= $menu->id ?>" class="form-label">Jumlah</label>
          <input type="number" name="qty" id="qty<?= $menu->id ?>" class="form-control" value="1" min="1" required>
        </div>
        <div class="mb-3">
          <label for="payment_method<?= $menu->id ?>" class="form-label">Metode Pembayaran</label>
          <select name="payment_method" id="payment_method<?= $menu->id ?>" class="form-select" required>
            <option value="">-- Pilih --</option>
            <option value="cash">Bayar di Tempat (COD)</option>
            <option value="ovo">Ovo</option>
            <option value="gopay">GoPay</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Buat Pesanan</button>
      </div>
    </form>
  </div>
</div>
