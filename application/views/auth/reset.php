 <!-- Content -->
 <?php $this->load->view('auth/template/header') ?>
 <div class="container-xxl">
     <div class="authentication-wrapper authentication-basic container-p-y">
         <div class="authentication-inner py-6">
             <!-- Reset Password -->
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
                     <h4 class="mb-1">Reset Password 🔒</h4>
                     <p class="mb-6">
                         <span class="fw-medium">Your new password must be different from previously used passwords</span>
                     </p>
                     <?php if ($this->session->flashdata('error')): ?>
                         <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
                     <?php elseif ($this->session->flashdata('success')): ?>
                         <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
                     <?php endif; ?>
                     <form action="<?= site_url('forgot_password/update_password') ?>" method="POST">
                         <input type="hidden" name="token" value="<?= $token ?>">
                         <div class="mb-6 form-password-toggle">
                             <label class="form-label" for="password">New Password</label>
                             <div class="input-group input-group-merge">
                                 <input
                                     type="password"
                                     id="password"
                                     class="form-control"
                                     name="password"
                                     placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                     aria-describedby="password" />
                                 <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                             </div>
                         </div>
                         <div class="mb-6 form-password-toggle">
                             <label class="form-label" for="confirm-password">Confirm Password</label>
                             <div class="input-group input-group-merge">
                                 <input
                                     type="password"
                                     id="confirm-password"
                                     class="form-control"
                                     name="confirm_password"
                                     placeholder="••••••••••••"
                                     aria-describedby="password" />
                                 <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                             </div>
                         </div>
                         <button class="btn btn-primary d-grid w-100 mb-6">Set new password</button>
                         <div class="text-center">
                             <a href="auth-login-basic.html">
                                 <i class="ti ti-chevron-left scaleX-n1-rtl me-1_5"></i>
                                 Back to login
                             </a>
                         </div>
                     </form>
                 </div>
             </div>
             <!-- /Reset Password -->
         </div>
     </div>
 </div>
 <?php $this->load->view('auth/template/footer') ?>
 <!-- / Content -->