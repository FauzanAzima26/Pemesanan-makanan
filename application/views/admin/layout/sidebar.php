<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bold">Go Rasa</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Page -->
        <li class="menu-item <?= ($this->router->fetch_class() == 'dashboard') ? 'active' : '' ?>">
            <a href="<?= site_url('dashboard') ?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Page 1">Dashboard</div>
            </a>
        </li>
        <li class="menu-item <?= ($this->router->fetch_class() == 'menu') ? 'active' : '' ?>">
            <a href="<?= site_url('menu') ?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-list-details"></i>
                <div data-i18n="Menu">Menu</div>
            </a>
        </li>
        <li class="menu-item <?= ($this->router->fetch_class() == 'order') ? 'active' : '' ?>">
            <a href="<?= site_url('order') ?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-receipt-2"></i>
                <div data-i18n="Pesanan">Pesanan</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?= site_url('logout') ?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-logout"></i>
                <div data-i18n="Logout">Logout</div>
            </a>
        </li>

    </ul>
</aside>