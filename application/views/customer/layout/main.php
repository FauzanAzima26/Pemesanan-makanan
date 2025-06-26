<body>
    <script src="<?= base_url('assets/vendor/js/dropdown-hover.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/js/mega-dropdown.js') ?>"></script>

    <!-- Navbar: Start -->
    <?php $this->load->view('customer/layout/navbar') ?>
    <!-- Navbar: End -->

    <!-- Sections:Start -->
    <?php $this->load->view($content) ?>  
    <!-- / Sections:End -->

    <!-- Footer: Start -->
    <?php $this->load->view('customer/layout/footer') ?>
    <!-- Footer: End -->

    <?php $this->load->view('customer/layout/script') ?>
</body>

</html>