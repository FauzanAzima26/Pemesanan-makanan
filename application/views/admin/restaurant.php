<div id="restaurant-data" data-get-data-url="<?= site_url('restaurant/get_data') ?>"></div>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-3">
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#add-new-record">
            <i class="ti ti-plus"></i> Add New
        </button>
    </div>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <!-- Tambahkan ID pada tabel -->
            <table id="restaurant-table" class="restaurant table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Owner</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Offcanvas Add New Record sudah ada -->
</div>

<script src="<?= base_url('assets/vendor/libs/jquery/jquery.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') ?>"></script>
<script src="<?= base_url('assets/js/backend/restaurant.js') ?>"></script>