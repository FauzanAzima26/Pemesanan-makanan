<div id="menu-form" data-store-url="<?= site_url('menu/store') ?>"
    data-get-data-url="<?= site_url('menu/get_data') ?>"
    data-base-url="<?= base_url() ?>">
</div>


<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-3">
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#add-new-record">
            <i class="ti ti-plus"></i> Add New
        </button>
    </div>
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="menuu table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama menu</th>
                        <th>Harga</th>
                        <th>Keterangan</th>
                        <th>Gambar</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal to add new record -->
<div class="offcanvas offcanvas-end" id="add-new-record">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="exampleModalLabel">Tambah</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body flex-grow-1">
        <form class="add-new-record pt-0 row g-2" enctype="multipart/form-data" id="form-add-new-record" onsubmit="return false">
            <input type="hidden" name="id_menu" id="id_menu">

            <!-- Nama menu -->
            <div class="col-sm-12">
                <label class="form-label" for="name">Nama menu</label>
                <input type="text" id="name" name="name" class="form-control"
                    placeholder="Menu" required />
            </div>

            <div class="col-sm-12">
                <label class="form-label" for="price">Harga</label>
                <input type="number" id="price" name="price" class="form-control"
                    placeholder="Harga" required />
            </div>

            <div class="col-sm-12">
                <label class="form-label" for="description">Keterangan</label>
                <textarea id="description" name="description" class="form-control" placeholder="Keterangan" required></textarea>
            </div>

            <div class="col-sm-12">
                <label class="form-label" for="image">Upload gambar</label>
                <input type="file" id="image" name="image" class="form-control"
                    placeholder="Gambar" required />
            </div>

            <!-- Tombol Submit -->
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary data-submit me-sm-4 me-1">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!--/ DataTable with Buttons -->
<script src="<?= base_url('assets/vendor/libs/jquery/jquery.js') ?>"></script>
<script src="<?= base_url('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') ?>"></script>
<script src="<?= base_url('assets/js/backend/menu.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>