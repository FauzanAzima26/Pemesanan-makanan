 <?php $this->load->view('auth/template/header') ?>

 <div class="container-xxl">
     <div class="authentication-wrapper authentication-basic container-p-y">
         <div class="authentication-inner py-6">
             <!-- Forgot Password -->
             <div class="card">
                 <div class="card-body">
                     <!-- Logo -->
                     <div class="app-brand justify-content-center mb-6">
                         <a href="index.html" class="app-brand-link">
                             <span class="app-brand-logo demo">
                                 <img src="<?= base_url('assets/img/IMG_1227.JPG') ?>" alt="Logo" style="height: 32px;" />
                             </span>
                             <span class="app-brand-text demo text-heading fw-bold">Go Rasa</span>
                         </a>
                     </div>
                     <!-- /Logo -->
                     <h4 class="mb-1">Forgot Password? 🔒</h4>
                     <p class="mb-6">Enter your email and we'll send you instructions to reset your password</p>
                     <?php if ($this->session->flashdata('success')): ?>
                         <div class="alert alert-success alert-dismissible fade show" role="alert">
                             <?= $this->session->flashdata('success') ?>
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                         </div>
                     <?php endif; ?>

                     <?php if ($this->session->flashdata('error')): ?>
                         <div class="alert alert-danger alert-dismissible fade show" role="alert">
                             <?= $this->session->flashdata('error') ?>
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                         </div>
                     <?php endif; ?>
                     <form id="formAuthentication" class="mb-6" action="<?= site_url('forgot_password/send_link') ?>" method="POST">
                         <div class="mb-6">
                             <label for="email" class="form-label">Email</label>
                             <input
                                 type="text"
                                 class="form-control"
                                 id="email"
                                 name="email"
                                 placeholder="Enter your email"
                                 autofocus />
                         </div>
                         <button class="btn btn-primary d-grid w-100">Send Reset Link</button>
                     </form>
                     <div class="text-center">
                         <a href="<?= base_url('login') ?>" class="d-flex justify-content-center">
                             <i class="ti ti-chevron-left scaleX-n1-rtl me-1_5"></i>
                             Back to login
                         </a>
                     </div>
                 </div>
             </div>
             <!-- /Forgot Password -->
         </div>
     </div>
 </div>

 <!-- / Content -->
 <?php $this->load->view('auth/template/footer') ?>