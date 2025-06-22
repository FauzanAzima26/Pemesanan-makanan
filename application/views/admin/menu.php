<div
    id="menu-data"
    data-get-data-url="<?= site_url('menu/get_data') ?>"
    data-store-url="<?= site_url('menu/store') ?>"
    data-restaurant-url="<?= site_url('menu/restaurant_list') ?>">
</div>


<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-3">
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#add-new-record">
            <i class="ti ti-plus"></i> Tambah Menu
        </button>
    </div>

    <!-- DataTable -->
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table id="menu-table" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Restoran</th>
                        <th>Menu</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Offcanvas Form Tambah/Update -->
<div class="offcanvas offcanvas-end" id="add-new-record">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title">Form Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form id="menu-form" class="row g-3" enctype="multipart/form-data">
            <input type="hidden" id="id_menu" name="id_menu">

            <div class="col-12">
                <label for="restaurant_id" class="form-label">Restoran</label>
                <select id="restaurant_id" name="restaurant_id" class="form-control" required>
                    <option value="">-- Pilih Restoran --</option>
                    <!-- Opsi akan ditambahkan secara dinamis -->
                </select>
            </div>

            <div class="col-12">
                <label for="name" class="form-label">Nama Menu</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="col-12">
                <label for="price" class="form-label">Harga</label>
                <input type="number" id="price" name="price" class="form-control" required>
            </div>

            <div class="col-12">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea id="description" name="description" rows="3" class="form-control" required></textarea>
            </div>

            <div class="col-12">
                <label for="image" class="form-label">Gambar</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
            </div>

            <div class="col-12 d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- JS -->
<script src="<?= base_url('assets/vendor/libs/jquery/jquery.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'); ?>"></script>
<script src="<?= base_url('assets/js/backend/menu.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
