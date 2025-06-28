<div id="detail_pesanan-form"
    data-get-data-url="<?= site_url('detail_pesanan/get_data') ?>"
    data-base-url="<?= base_url() ?>">
</div>


<section class="section-py bg-body first-section-pt">
    <div class="container">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card-datatable table-responsive pt-0">
                    <table class="detail_pesanan table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Menu</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Metode pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!--/ DataTable with Buttons -->
<script src="<?= base_url('assets/vendor/libs/jquery/jquery.js') ?>"></script>
<script src="<?= base_url('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') ?>"></script>
<script src="<?= base_url('assets/js/backend/detail_pesanan.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>