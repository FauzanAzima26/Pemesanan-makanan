<div
    id="restaurant-data"
    data-get-data-url="<?= site_url('restaurant/get_data') ?>"
    data-store-url="<?= site_url('restaurant/store') ?>">
</div>


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
</div>

<!-- Modal to add new record -->
<div class="offcanvas offcanvas-end" id="add-new-record">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="exampleModalLabel">New Record</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body flex-grow-1">
        <!-- Form input data -->
        <form class="add-new-record pt-0 row g-2" id="restaurant-form" onsubmit="return false">
            <input type="hidden" name="id_restaurant" id="id_restaurant">

            <div class="col-sm-12">
                <label class="form-label">Owner</label>
                <input type="text" id="owner" name="owner" class="form-control" required />
            </div>
            <div class="col-sm-12">
                <label class="form-label">Nama</label>
                <input type="text" id="name" name="name" class="form-control" required />
            </div>
            <div class="col-sm-12">
                <label class="form-label">Alamat</label>
                <input type="text" id="address" name="address" class="form-control" required />
            </div>
            <div class="col-sm-12">
                <label class="form-label">Status</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="open">Open</option>
                    <option value="close">Close</option>
                </select>
            </div>
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script src="<?= base_url('assets/vendor/libs/jquery/jquery.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') ?>"></script>
<script src="<?= base_url('assets/js/backend/restaurant.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>