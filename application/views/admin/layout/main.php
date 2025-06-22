  <body>
      <!-- Layout wrapper -->
      <div class="layout-wrapper layout-content-navbar">
          <div class="layout-container">
              <!-- Menu -->
              <?php $this->load->view('admin/layout/sidebar') ?>
              <!-- / Menu -->

              <!-- Layout container -->
              <div class="layout-page">
                  <!-- Navbar -->
                  <?php $this->load->view('admin/layout/navbar') ?>
                  <!-- / Navbar -->

                  <!-- Content wrapper -->
                  <div class="content-wrapper">
                      <!-- Content -->
                      <?php $this->load->view($content) ?>
                      <!-- / Content -->

                      <!-- Footer -->
                      <?php $this->load->view('admin/layout/footer') ?>
                      <!-- / Footer -->

                      <div class="content-backdrop fade"></div>
                  </div>
                  <!-- Content wrapper -->
              </div>
              <!-- / Layout page -->
          </div>

          <!-- Overlay -->
          <div class="layout-overlay layout-menu-toggle"></div>

          <!-- Drag Target Area To SlideIn Menu On Small Screens -->
          <div class="drag-target"></div>
      </div>
      <!-- / Layout wrapper -->
      <?php $this->load->view('admin/layout/script') ?>
  </body>

  </html>