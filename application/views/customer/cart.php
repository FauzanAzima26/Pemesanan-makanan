 <section class="section-py bg-body first-section-pt">
     <div class="container">
         <div class="checkout-form">
             <div class="row">
                 <!-- Left Column - Cart Items -->
                 <div class="col-lg-8 mb-4">
                     <div class="card">
                         <div class="card-header bg-light">
                             <h5 class="mb-0">Keranjang Belanja</h5>
                         </div>
                         <div class="card-body">
                             <ul class="list-group mb-3">
                                 <?php if (!empty($items)): ?>
                                     <?php foreach ($items as $item): ?>
                                         <li class="list-group-item">
                                             <div class="d-flex align-items-center gap-3">
                                                 <img src="<?= base_url($item->image ?? 'assets/img/no-image.png') ?>"
                                                     alt="<?= $item->name ?>"
                                                     class="img-thumbnail" style="width: 80px;">
                                                 <div class="flex-grow-1">
                                                     <h6 class="mb-1"><?= $item->name ?></h6>
                                                     <div class="d-flex justify-content-between align-items-center">
                                                         <div class="input-group" style="width: 120px;">
                                                             <input type="number"
                                                                 class="form-control form-control-sm qty-input"
                                                                 data-id="<?= $item->cart_id ?>"
                                                                 data-price="<?= $item->price ?>"
                                                                 data-url="<?= site_url('cart/update') ?>"
                                                                 value="<?= $item->qty ?>"
                                                                 min="1">
                                                         </div>
                                                         <span class="text-primary fw-bold" id="subtotal-<?= $item->cart_id ?>">
                                                             Rp<?= number_format($item->price * $item->qty, 0, ',', '.') ?>
                                                         </span>
                                                     </div>
                                                 </div>
                                                 <form action="<?= site_url('cart/remove/' . $item->cart_id) ?>" method="post">
                                                     <button type="button"
                                                         class="btn btn-sm btn-outline-danger btn-remove-item"
                                                         data-id="<?= $item->cart_id ?>"
                                                         data-url="<?= site_url('customer/cart/remove') ?>">
                                                         <i class="ti ti-x"></i>
                                                     </button>
                                                 </form>
                                             </div>
                                         </li>
                                     <?php endforeach; ?>
                                 <?php else: ?>
                                     <li class="list-group-item text-center py-4">Keranjang masih kosong.</li>
                                 <?php endif; ?>
                             </ul>
                         </div>
                     </div>
                 </div>

                 <!-- Right Column - Order Summary -->
                 <div class="col-lg-4">
                     <div class="card sticky-top" style="top: 20px;">
                         <div class="card-header bg-light">
                             <h5 class="mb-0">Ringkasan Pesanan</h5>
                         </div>
                         <div class="card-body">
                             <dl class="row mb-3">
                                 <?php $total = 0; ?>
                                 <?php foreach ($items as $item): ?>
                                     <?php $subtotal = $item->qty * $item->price; ?>
                                     <?php $total += $subtotal; ?>
                                     <dt class="col-6 fw-normal">
                                         <?= $item->name ?> (<span id="detail-qty-<?= $item->cart_id ?>"><?= $item->qty ?></span>x)
                                     </dt>
                                     <dd class="col-6 text-end">
                                         <span id="detail-subtotal-<?= $item->cart_id ?>">Rp<?= number_format($subtotal, 0, ',', '.') ?></span>
                                     </dd>
                                 <?php endforeach; ?>
                             </dl>
                             <hr>
                             <dl class="row mb-4">
                                 <dt class="col-6 fw-bold">Total</dt>
                                 <dd class="col-6 fw-bold text-end" id="total-semua">
                                     Rp<?= number_format($total, 0, ',', '.') ?>
                                 </dd>
                             </dl>

                             <!-- Payment Method -->
                             <div class="mb-4">
                                 <h6>Metode Pembayaran</h6>
                                 <div class="form-check mb-2">
                                     <input class="form-check-input" type="radio" name="paymentMethod" id="bankTransfer" checked>
                                     <label class="form-check-label" for="bankTransfer">
                                         Transfer Bank
                                     </label>
                                 </div>
                                 <div class="form-check mb-2">
                                     <input class="form-check-input" type="radio" name="paymentMethod" id="cod">
                                     <label class="form-check-label" for="cod">
                                         COD (Bayar di Tempat)
                                     </label>
                                 </div>
                             </div>

                             <!-- Submit Button -->
                             <button class="btn btn-primary w-100" id="btn-pay">
                                 <i class="ti ti-shopping-cart-check me-2"></i> Pesan Sekarang
                             </button>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>

 <!-- / Sections:End -->

 <script src="<?= base_url('assets/vendor/libs/jquery/jquery.js') ?>"></script>
 <script src="<?= base_url('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') ?>"></script>
 <script src="<?= base_url('assets/js/backend/cart.js') ?>"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="Mid-client-YQr0oq96i8DRRmVa"></script>
 <script>
     $('#btn-pay').on('click', function() {
         $.ajax({
             url: "<?= base_url('customer/checkout/token') ?>",
             method: 'POST',
             data: {
                 amount: 200000
             },
             dataType: 'json',
             success: function(response) {
                 if (response.snapToken) {
                     snap.pay(response.snapToken, {
                         onSuccess: function(result) {
                             Swal.fire('Sukses', 'Pembayaran berhasil!', 'success');
                             console.log(result);
                         },
                         onPending: function(result) {
                             Swal.fire('Menunggu', 'Selesaikan pembayaran.', 'info');
                             console.log(result);
                         },
                         onError: function(result) {
                             Swal.fire('Gagal', 'Pembayaran gagal.', 'error');
                             console.log(result);
                         }
                     });
                 } else {
                     Swal.fire('Error', 'Token kosong.', 'error');
                     console.error('Respon kosong:', response);
                 }
             },
             error: function(xhr, status, error) {
                 Swal.fire('Error', 'Gagal menghubungi server.', 'error');
                 console.error(xhr.responseText);
             }
         });
     });
 </script>