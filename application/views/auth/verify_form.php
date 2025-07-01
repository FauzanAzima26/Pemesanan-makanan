<?php $this->load->view('auth/template/header') ?>

<!-- Content -->
<div class="authentication-wrapper authentication-basic px-6">
    <div class="authentication-inner py-6">
        <!--  Two Steps Verification -->
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
                <h4 class="mb-1">Two Step Verification</h4>
                <p class="text-start mb-6">
                    We sent a verification code to your mobile. Enter the code from the email in the field below.
                </p>
                <p class="mb-0">Type your 6 digit security code</p>
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                        <?= $this->session->flashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <form id="twoStepsForm" action="<?= site_url('regist/verify') ?>" method="POST">
                    <div class="mb-6">
                        <div class="auth-input-wrapper d-flex align-items-center justify-content-between numeral-mask-wrapper">
                            <input
                                type="text"
                                class="form-control auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2"
                                maxlength="1"
                                autofocus />
                            <input
                                type="text"
                                class="form-control auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2"
                                maxlength="1" />
                            <input
                                type="text"
                                class="form-control auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2"
                                maxlength="1" />
                            <input
                                type="text"
                                class="form-control auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2"
                                maxlength="1" />
                            <input
                                type="text"
                                class="form-control auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2"
                                maxlength="1" />
                            <input
                                type="text"
                                class="form-control auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2"
                                maxlength="1" />
                        </div>
                        <!-- Create a hidden field which is combined by 3 fields above -->
                        <input type="hidden" name="otp" />
                    </div>
                    <button class="btn btn-primary d-grid w-100 mb-6">Verify my account</button>
                    <div class="text-center">
                        Didn't get the code?
                        <a href="javascript:void(0);"> Resend </a>
                    </div>
                </form>
            </div>
        </div>
        <!-- / Two Steps Verification -->
    </div>
</div>
<!-- / Content -->
<?php $this->load->view('auth/template/footer') ?>

<script>
    const otpInputs = document.querySelectorAll('.auth-input');
    const hiddenInput = document.querySelector('input[name="otp"]');

    otpInputs.forEach((input, index) => {
        input.addEventListener('input', () => {
            // Pindah ke input selanjutnya jika karakter sudah diisi
            if (input.value.length === 1 && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }

            // Gabungkan nilai dari semua input
            hiddenInput.value = Array.from(otpInputs).map(i => i.value).join('');
        });
    });
</script>