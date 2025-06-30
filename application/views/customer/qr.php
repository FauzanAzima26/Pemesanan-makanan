<div id="detail_pesanan-form" data-get-data-url="<?= site_url('customer/order/get_detail') ?>" data-base-url="<?= base_url() ?>"></div>

<div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="qrModalLabel">Detail Pesanan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center" id="qrModalBody">
        <div class="d-flex justify-content-center mb-3">
          <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Memuat...</span>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-center">
        <p class="mb-0 text-muted">ID: <span id="orderIdDisplay"></span></p>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url('assets/vendor/libs/jquery/jquery.js') ?>"></script>
<script src="<?= base_url('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') ?>"></script>
<script src="<?= base_url('assets/js/backend/detail_pesanan.js') ?>"></script>
