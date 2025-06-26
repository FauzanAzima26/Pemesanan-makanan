 <section class="section-py bg-body first-section-pt">
     <div class="container">
         <!--/ Checkout Wizard -->
         <!-- Checkout Wizard -->
         <div id="wizard-checkout" class="bs-stepper wizard-icons wizard-icons-example">
             <div class="bs-stepper-header m-lg-auto border-0">
                 <div class="step" data-target="#checkout-cart">
                     <button type="button" class="step-trigger">
                         <span class="bs-stepper-icon">
                             <svg viewBox="0 0 60 60">
                                 <use xlink:href="../../assets/svg/icons/wizard-checkout-cart.svg#wizardCart"></use>
                             </svg>
                         </span>
                         <span class="bs-stepper-label">Cart</span>
                     </button>
                 </div>
                 <div class="line">
                     <i class="ti ti-chevron-right"></i>
                 </div>
                 <div class="step" data-target="#checkout-address">
                     <button type="button" class="step-trigger">
                         <span class="bs-stepper-icon">
                             <svg viewBox="0 0 60 60">
                                 <use xlink:href="../../assets/svg/icons/wizard-checkout-address.svg#wizardCheckoutAddress"></use>
                             </svg>
                         </span>
                         <span class="bs-stepper-label">Address</span>
                     </button>
                 </div>
                 <div class="line">
                     <i class="ti ti-chevron-right"></i>
                 </div>
                 <div class="step" data-target="#checkout-payment">
                     <button type="button" class="step-trigger">
                         <span class="bs-stepper-icon">
                             <svg viewBox="0 0 60 60">
                                 <use xlink:href="../../assets/svg/icons/wizard-checkout-payment.svg#wizardPayment"></use>
                             </svg>
                         </span>
                         <span class="bs-stepper-label">Payment</span>
                     </button>
                 </div>
                 <div class="line">
                     <i class="ti ti-chevron-right"></i>
                 </div>
                 <div class="step" data-target="#checkout-confirmation">
                     <button type="button" class="step-trigger">
                         <span class="bs-stepper-icon">
                             <svg viewBox="0 0 60 60">
                                 <use xlink:href="../../assets/svg/icons/wizard-checkout-confirmation.svg#wizardConfirm"></use>
                             </svg>
                         </span>
                         <span class="bs-stepper-label">Confirmation</span>
                     </button>
                 </div>
             </div>
             <div class="bs-stepper-content border-top">
                 <form id="wizard-checkout-form" onSubmit="return false">
                     <!-- Cart -->
                     <div id="checkout-cart" class="content">
                         <div class="row">
                             <!-- Cart left -->
                             <div class="col-xl-8 mb-6 mb-xl-0">
                                 <!-- Shopping bag -->
                                 <h5>Keranjang</h5>
                                 <ul class="list-group mb-4">
                                     <?php if (!empty($items)): ?>
                                         <?php foreach ($items as $item): ?>
                                             <li class="list-group-item p-6">
                                                 <div class="d-flex gap-4">
                                                     <div class="flex-shrink-0 d-flex align-items-center">
                                                         <img src="<?= base_url($item->image ?? 'assets/img/no-image.png') ?>" alt="<?= $item->name ?>" class="w-px-100" />
                                                     </div>
                                                     <div class="flex-grow-1">
                                                         <div class="row">
                                                             <div class="col-md-8">
                                                                 <p class="me-3 mb-2">
                                                                     <a href="javascript:void(0)" class="fw-medium">
                                                                         <span class="text-heading"><?= $item->name ?></span>
                                                                     </a>
                                                                 </p>
                                                                 <input type="number"
                                                                     class="form-control qty-input"
                                                                     data-id="<?= $item->cart_id ?>"
                                                                     data-price="<?= $item->price ?>"
                                                                     data-url="<?= site_url('cart/update') ?>"
                                                                     value="<?= $item->qty ?>"
                                                                     min="1" />
                                                             </div>
                                                             <div class="col-md-4">
                                                                 <div class="text-md-end">
                                                                     <form action="<?= site_url('cart/remove/' . $item->cart_id) ?>" method="post">
                                                                         <button type="submit" class="btn-close btn-pinned" aria-label="Hapus"></button>
                                                                     </form>
                                                                     <div class="my-2 mt-md-6 mb-md-4">
                                                                         <span id="subtotal-<?= $item->cart_id ?>" class="text-primary">
                                                                             Rp<?= number_format($item->price * $item->qty, 0, ',', '.') ?>
                                                                         </span>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </li>
                                         <?php endforeach; ?>
                                     <?php else: ?>
                                         <li class="list-group-item text-center">Keranjang masih kosong.</li>
                                     <?php endif; ?>
                                 </ul>
                             </div>

                             <!-- Cart right -->
                             <div class="col-xl-4">
                                 <div class="border rounded p-6 mb-4">
                                     <!-- Price Details -->
                                     <h6>Price Details</h6>
                                     <dl class="row mb-0 text-heading">
                                         <?php $total = 0; ?>
                                         <?php foreach ($items as $item): ?>
                                             <?php $subtotal = $item->qty * $item->price; ?>
                                             <dt class="col-6 fw-normal"><?= $item->name ?> (<?= $item->qty ?>x)</dt>
                                             <dd class="col-6 text-end">Rp<?= number_format($subtotal, 0, ',', '.') ?></dd>
                                             <?php $total += $subtotal; ?>
                                         <?php endforeach; ?>
                                     </dl>

                                     <hr class="mx-n6 my-6" />
                                     <dl class="row mb-0">
                                         <dt class="col-6 text-heading">Total</dt>
                                         <dd class="col-6 fw-medium text-end text-heading mb-0" id="total-semua">Rp<?= number_format($total, 0, ',', '.') ?></dd>
                                     </dl>
                                 </div>
                                 <div class="d-grid">
                                     <button class="btn btn-primary btn-next">Place Order</button>
                                 </div>
                             </div>
                         </div>
                     </div>

                     <!-- Address -->
                     <div id="checkout-address" class="content">
                         <div class="row">
                             <!-- Address left -->
                             <div class="col-xl-8 mb-6 mb-xl-0">
                                 <!-- Select address -->
                                 <p class="fw-medium text-heading">Select your preferable address</p>
                                 <div class="row mb-6 g-6">
                                     <div class="col-md">
                                         <div class="form-check custom-option custom-option-basic checked">
                                             <label class="form-check-label custom-option-content" for="customRadioAddress1">
                                                 <input
                                                     name="customRadioTemp"
                                                     class="form-check-input"
                                                     type="radio"
                                                     value=""
                                                     id="customRadioAddress1"
                                                     checked="" />
                                                 <span class="custom-option-header mb-2">
                                                     <span class="fw-medium text-heading mb-0">John Doe (Default)</span>
                                                     <span class="badge bg-label-primary">Home</span>
                                                 </span>
                                                 <span class="custom-option-body">
                                                     <small>4135 Parkway Street, Los Angeles, CA, 90017.<br />
                                                         Mobile : 1234567890 Card / Cash on delivery available</small>
                                                     <span class="my-3 border-bottom d-block"></span>
                                                     <span class="d-flex">
                                                         <a class="me-4" href="javascript:void(0)">Edit</a>
                                                         <a href="javascript:void(0)">Remove</a>
                                                     </span>
                                                 </span>
                                             </label>
                                         </div>
                                     </div>
                                     <div class="col-md">
                                         <div class="form-check custom-option custom-option-basic">
                                             <label class="form-check-label custom-option-content" for="customRadioAddress2">
                                                 <input
                                                     name="customRadioTemp"
                                                     class="form-check-input"
                                                     type="radio"
                                                     value=""
                                                     id="customRadioAddress2" />
                                                 <span class="custom-option-header mb-2">
                                                     <span class="fw-medium text-heading mb-0">ACME Inc.</span>
                                                     <span class="badge bg-label-success">Office</span>
                                                 </span>
                                                 <span class="custom-option-body">
                                                     <small>87 Hoffman Avenue, New York, NY, 10016.<br />Mobile : 1234567890 Card / Cash on
                                                         delivery available</small>
                                                     <span class="my-3 border-bottom d-block"></span>
                                                     <span class="d-flex">
                                                         <a class="me-4" href="javascript:void(0)">Edit</a>
                                                         <a href="javascript:void(0)">Remove</a>
                                                     </span>
                                                 </span>
                                             </label>
                                         </div>
                                     </div>
                                 </div>
                                 <button
                                     type="button"
                                     class="btn btn-label-primary mb-6"
                                     data-bs-toggle="modal"
                                     data-bs-target="#addNewAddress">
                                     Add new address
                                 </button>

                                 <!-- Choose Delivery -->
                                 <p class="fw-medium text-heading">Choose Delivery Speed</p>
                                 <div class="row mt-2">
                                     <div class="col-md mb-md-0 mb-2">
                                         <div class="form-check custom-option custom-option-icon position-relative checked">
                                             <label class="form-check-label custom-option-content" for="customRadioDelivery1">
                                                 <span class="custom-option-body">
                                                     <i class="ti ti-user ti-lg"></i>
                                                     <span class="custom-option-title mb-2">Standard</span>
                                                     <span class="badge bg-label-success btn-pinned">FREE</span>
                                                     <small>Get your product in 1 Week.</small>
                                                 </span>
                                                 <input
                                                     name="customRadioIcon"
                                                     class="form-check-input"
                                                     type="radio"
                                                     value=""
                                                     id="customRadioDelivery1"
                                                     checked="" />
                                             </label>
                                         </div>
                                     </div>
                                     <div class="col-md mb-md-0 mb-2">
                                         <div class="form-check custom-option custom-option-icon position-relative">
                                             <label class="form-check-label custom-option-content" for="customRadioDelivery2">
                                                 <span class="custom-option-body">
                                                     <i class="ti ti-star ti-lg"></i>
                                                     <span class="custom-option-title mb-2">Express</span>
                                                     <span class="badge bg-label-secondary btn-pinned">$10</span>
                                                     <small>Get your product in 3-4 days.</small>
                                                 </span>
                                                 <input
                                                     name="customRadioIcon"
                                                     class="form-check-input"
                                                     type="radio"
                                                     value=""
                                                     id="customRadioDelivery2" />
                                             </label>
                                         </div>
                                     </div>
                                     <div class="col-md">
                                         <div class="form-check custom-option custom-option-icon position-relative">
                                             <label class="form-check-label custom-option-content" for="customRadioDelivery3">
                                                 <span class="custom-option-body">
                                                     <i class="ti ti-crown ti-lg"></i>
                                                     <span class="custom-option-title mb-2">Overnight</span>
                                                     <span class="badge bg-label-secondary btn-pinned">$15</span>
                                                     <small>Get your product in 0-1 days.</small>
                                                 </span>
                                                 <input
                                                     name="customRadioIcon"
                                                     class="form-check-input"
                                                     type="radio"
                                                     value=""
                                                     id="customRadioDelivery3" />
                                             </label>
                                         </div>
                                     </div>
                                 </div>
                             </div>

                             <!-- Address right -->
                             <div class="col-xl-4">
                                 <div class="border rounded p-6 mb-4">
                                     <!-- Estimated Delivery -->
                                     <h6>Estimated Delivery Date</h6>
                                     <ul class="list-unstyled">
                                         <li class="d-flex gap-4 align-items-center py-2 mb-4">
                                             <div class="flex-shrink-0">
                                                 <img src="../../assets/img/products/1.png" alt="google home" class="w-px-50" />
                                             </div>
                                             <div class="flex-grow-1">
                                                 <p class="mb-0">
                                                     <a class="text-body" href="javascript:void(0)">Google - Google Home - White</a>
                                                 </p>
                                                 <p class="fw-medium mb-0">18th Nov 2021</p>
                                             </div>
                                         </li>
                                         <li class="d-flex gap-4 align-items-center py-2">
                                             <div class="flex-shrink-0">
                                                 <img src="../../assets/img/products/2.png" alt="google home" class="w-px-50" />
                                             </div>
                                             <div class="flex-grow-1">
                                                 <p class="mb-0">
                                                     <a class="text-body" href="javascript:void(0)">Apple iPhone 11 (64GB, Black)</a>
                                                 </p>
                                                 <p class="fw-medium mb-0">20th Nov 2021</p>
                                             </div>
                                         </li>
                                     </ul>

                                     <hr class="mx-n6 my-6" />

                                     <!-- Price Details -->
                                     <h6>Price Details</h6>
                                     <dl class="row mb-0 text-heading">
                                         <dt class="col-6 fw-normal">Order Total</dt>
                                         <dd class="col-6 text-end">$1198.00</dd>

                                         <dt class="col-6 fw-normal">Delivery Charges</dt>
                                         <dd class="col-6 text-end">
                                             <s class="text-muted">$5.00</s> <span class="badge bg-label-success ms-2">Free</span>
                                         </dd>
                                     </dl>
                                     <hr class="mx-n6 my-6" />
                                     <dl class="row mb-0">
                                         <dt class="col-6 text-heading">Total</dt>
                                         <dd class="col-6 fw-medium text-end text-heading mb-0">$1198.00</dd>
                                     </dl>
                                 </div>
                                 <div class="d-grid">
                                     <button class="btn btn-primary btn-next">Place Order</button>
                                 </div>
                             </div>
                         </div>
                     </div>

                     <!-- Payment -->
                     <div id="checkout-payment" class="content">
                         <div class="row">
                             <!-- Payment left -->
                             <div class="col-xl-8 mb-6 mb-xl-0">
                                 <!-- Offer alert -->
                                 <div class="alert alert-success mb-6" role="alert">
                                     <div class="d-flex gap-4">
                                         <div class="alert-icon flex-shrink-0 rounded me-0">
                                             <i class="ti ti-percentage"></i>
                                         </div>
                                         <div class="flex-grow-1">
                                             <h5 class="alert-heading mb-1">Available Offers</h5>
                                             <ul class="list-unstyled mb-0">
                                                 <li>- 10% Instant Discount on Bank of America Corp Bank Debit and Credit cards</li>
                                                 <li>- 25% Cashback Voucher of up to $60 on first ever PayPal transaction. TCA</li>
                                             </ul>
                                         </div>
                                     </div>
                                     <button
                                         type="button"
                                         class="btn-close btn-pinned"
                                         data-bs-dismiss="alert"
                                         aria-label="Close"></button>
                                 </div>

                                 <!-- Payment Tabs -->
                                 <div class="col-xxl-6 col-lg-8">
                                     <div class="nav-align-top">
                                         <ul class="nav nav-pills card-header-pills row-gap-2" id="paymentTabs" role="tablist">
                                             <li class="nav-item" role="presentation">
                                                 <button
                                                     class="nav-link active"
                                                     id="pills-cc-tab"
                                                     data-bs-toggle="pill"
                                                     data-bs-target="#pills-cc"
                                                     type="button"
                                                     role="tab"
                                                     aria-controls="pills-cc"
                                                     aria-selected="true">
                                                     Card
                                                 </button>
                                             </li>
                                             <li class="nav-item" role="presentation">
                                                 <button
                                                     class="nav-link"
                                                     id="pills-cod-tab"
                                                     data-bs-toggle="pill"
                                                     data-bs-target="#pills-cod"
                                                     type="button"
                                                     role="tab"
                                                     aria-controls="pills-cod"
                                                     aria-selected="false">
                                                     Cash On Delivery
                                                 </button>
                                             </li>
                                             <li class="nav-item" role="presentation">
                                                 <button
                                                     class="nav-link"
                                                     id="pills-gift-card-tab"
                                                     data-bs-toggle="pill"
                                                     data-bs-target="#pills-gift-card"
                                                     type="button"
                                                     role="tab"
                                                     aria-controls="pills-gift-card"
                                                     aria-selected="false">
                                                     Gift Card
                                                 </button>
                                             </li>
                                         </ul>
                                     </div>
                                     <div class="tab-content px-0 pb-0" id="paymentTabsContent">
                                         <!-- Credit card -->
                                         <div
                                             class="tab-pane fade show active"
                                             id="pills-cc"
                                             role="tabpanel"
                                             aria-labelledby="pills-cc-tab">
                                             <div class="row g-6">
                                                 <div class="col-12">
                                                     <label class="form-label w-100" for="paymentCard">Card Number</label>
                                                     <div class="input-group input-group-merge">
                                                         <input
                                                             id="paymentCard"
                                                             name="paymentCard"
                                                             class="form-control credit-card-mask"
                                                             type="text"
                                                             placeholder="1356 3215 6548 7898"
                                                             aria-describedby="paymentCard2" />
                                                         <span class="input-group-text cursor-pointer p-1" id="paymentCard2"><span class="card-type"></span></span>
                                                     </div>
                                                 </div>
                                                 <div class="col-12 col-md-6">
                                                     <label class="form-label" for="paymentCardName">Name</label>
                                                     <input type="text" id="paymentCardName" class="form-control" placeholder="John Doe" />
                                                 </div>
                                                 <div class="col-6 col-md-3">
                                                     <label class="form-label" for="paymentCardExpiryDate">Exp. Date</label>
                                                     <input
                                                         type="text"
                                                         id="paymentCardExpiryDate"
                                                         class="form-control expiry-date-mask"
                                                         placeholder="MM/YY" />
                                                 </div>
                                                 <div class="col-6 col-md-3">
                                                     <label class="form-label" for="paymentCardCvv">CVV Code</label>
                                                     <div class="input-group input-group-merge">
                                                         <input
                                                             type="text"
                                                             id="paymentCardCvv"
                                                             class="form-control cvv-code-mask"
                                                             maxlength="3"
                                                             placeholder="654" />
                                                         <span class="input-group-text cursor-pointer" id="paymentCardCvv2"><i
                                                                 class="ti ti-help text-muted"
                                                                 data-bs-toggle="tooltip"
                                                                 data-bs-placement="top"
                                                                 title="Card Verification Value"></i></span>
                                                     </div>
                                                 </div>
                                                 <div class="col-12">
                                                     <div class="form-check form-switch mt-2">
                                                         <input type="checkbox" class="form-check-input" id="cardFutureBilling" />
                                                         <label for="cardFutureBilling" class="form-check-label">Save card for future billing?</label>
                                                     </div>
                                                 </div>
                                                 <div class="col-12">
                                                     <button type="button" class="btn btn-primary btn-next me-3">Save Changes</button>
                                                     <button type="reset" class="btn btn-label-secondary">Reset</button>
                                                 </div>
                                             </div>
                                         </div>

                                         <!-- COD -->
                                         <div class="tab-pane fade" id="pills-cod" role="tabpanel" aria-labelledby="pills-cod-tab">
                                             <p>
                                                 Cash on Delivery is a type of payment method where the recipient make payment for the order
                                                 at the time of delivery rather than in advance.
                                             </p>
                                             <button type="button" class="btn btn-primary btn-next">Pay On Delivery</button>
                                         </div>

                                         <!-- Gift card -->
                                         <div
                                             class="tab-pane fade"
                                             id="pills-gift-card"
                                             role="tabpanel"
                                             aria-labelledby="pills-gift-card-tab">
                                             <h6>Enter Gift Card Details</h6>
                                             <div class="row g-5">
                                                 <div class="col-12">
                                                     <label for="giftCardNumber" class="form-label">Gift card number</label>
                                                     <input
                                                         type="number"
                                                         class="form-control"
                                                         id="giftCardNumber"
                                                         placeholder="Gift card number" />
                                                 </div>
                                                 <div class="col-12">
                                                     <label for="giftCardPin" class="form-label">Gift card pin</label>
                                                     <input type="number" class="form-control" id="giftCardPin" placeholder="Gift card pin" />
                                                 </div>
                                                 <div class="col-12">
                                                     <button type="button" class="btn btn-primary btn-next">Redeem Gift Card</button>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <!-- Address right -->
                             <div class="col-xl-4">
                                 <div class="border rounded p-6">
                                     <!-- Price Details -->
                                     <h6>Price Details</h6>
                                     <dl class="row text-heading">
                                         <dt class="col-6 fw-normal">Order Total</dt>
                                         <dd class="col-6 text-end">$1198.00</dd>

                                         <dt class="col-6 fw-normal">Delivery Charges</dt>
                                         <dd class="col-6 text-end">
                                             <s class="text-muted">$5.00</s> <span class="badge bg-label-success ms-1">Free</span>
                                         </dd>
                                     </dl>
                                     <hr class="mx-n6 my-6" />
                                     <dl class="row">
                                         <dt class="col-6 text-heading mb-3">Total</dt>
                                         <dd class="col-6 fw-medium text-end text-heading mb-0">$1198.00</dd>

                                         <dt class="col-6 fw-medium text-heading">Deliver to:</dt>
                                         <dd class="col-6 fw-medium text-end mb-0"><span class="badge bg-label-primary">Home</span></dd>
                                     </dl>
                                     <!-- Address Details -->
                                     <address>
                                         <span class="text-heading fw-medium"> John Doe (Default),</span><br />
                                         4135 Parkway Street, <br />
                                         Los Angeles, CA, 90017. <br />
                                         Mobile : +1 906 568 2332
                                     </address>
                                     <a href="javascript:void(0)" class="fw-medium">Change address</a>
                                 </div>
                             </div>
                         </div>
                     </div>

                     <!-- Confirmation -->
                     <div id="checkout-confirmation" class="content">
                         <div class="row mb-6">
                             <div class="col-12 col-lg-8 mx-auto text-center mb-2">
                                 <h4>Thank You! 😇</h4>
                                 <p>
                                     Your order <a href="javascript:void(0)" class="text-heading fw-medium">#1536548131</a> has been
                                     placed!
                                 </p>
                                 <p>
                                     We sent an email to
                                     <a href="mailto:john.doe@example.com" class="text-heading fw-medium">john.doe@example.com</a> with
                                     your order confirmation and receipt. If the email hasn't arrived within two minutes, please check
                                     your spam folder to see if the email was routed there.
                                 </p>
                                 <p>
                                     <span><i class="ti ti-clock me-1 text-heading"></i> Time placed:&nbsp;</span> 25/05/2020 13:35pm
                                 </p>
                             </div>
                             <!-- Confirmation details -->
                             <div class="col-12">
                                 <ul class="list-group list-group-horizontal-md">
                                     <li class="list-group-item flex-fill p-6 text-body">
                                         <h6 class="d-flex align-items-center gap-2"><i class="ti ti-map-pin"></i> Shipping</h6>
                                         <address class="mb-0">
                                             John Doe <br />
                                             4135 Parkway Street,<br />
                                             Los Angeles, CA 90017,<br />
                                             USA
                                         </address>
                                         <p class="mb-0 mt-4">+123456789</p>
                                     </li>
                                     <li class="list-group-item flex-fill p-6 text-body">
                                         <h6 class="d-flex align-items-center gap-2">
                                             <i class="ti ti-credit-card"></i> Billing Address
                                         </h6>
                                         <address class="mb-0">
                                             John Doe <br />
                                             4135 Parkway Street,<br />
                                             Los Angeles, CA 90017,<br />
                                             USA
                                         </address>
                                         <p class="mb-0 mt-4">+123456789</p>
                                     </li>
                                     <li class="list-group-item flex-fill p-6 text-body">
                                         <h6 class="d-flex align-items-center gap-2"><i class="ti ti-ship"></i> Shipping Method</h6>
                                         <p class="fw-medium mb-4">Preferred Method:</p>
                                         Standard Delivery<br />
                                         (Normally 3-4 business days)
                                     </li>
                                 </ul>
                             </div>
                         </div>

                         <div class="row">
                             <!-- Confirmation items -->
                             <div class="col-xl-9 mb-6 mb-xl-0">
                                 <ul class="list-group">
                                     <li class="list-group-item p-6">
                                         <div class="d-flex gap-4">
                                             <div class="flex-shrink-0">
                                                 <img src="../../assets/img/products/1.png" alt="google home" class="w-px-75" />
                                             </div>
                                             <div class="flex-grow-1">
                                                 <div class="row">
                                                     <div class="col-md-8">
                                                         <a href="javascript:void(0)">
                                                             <h6 class="mb-2">Google - Google Home - White</h6>
                                                         </a>
                                                         <div class="text-body mb-2 d-flex flex-wrap">
                                                             <span class="me-1">Sold by:</span>
                                                             <a href="javascript:void(0)" class="me-3">Google</a>
                                                             <span class="badge bg-label-success">In Stock</span>
                                                         </div>
                                                     </div>
                                                     <div class="col-md-4">
                                                         <div class="text-md-end">
                                                             <div class="my-2 my-lg-6">
                                                                 <span class="text-primary">$299/</span><s class="text-muted">$359</s>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </li>
                                     <li class="list-group-item p-6">
                                         <div class="d-flex gap-4">
                                             <div class="flex-shrink-0">
                                                 <img src="../../assets/img/products/2.png" alt="google home" class="w-px-75" />
                                             </div>
                                             <div class="flex-grow-1">
                                                 <div class="row">
                                                     <div class="col-md-8">
                                                         <a href="javascript:void(0)">
                                                             <h6 class="mb-2">Apple iPhone 11 (64GB, Black)</h6>
                                                         </a>
                                                         <div class="text-body mb-2 d-flex flex-wrap">
                                                             <span class="me-1">Sold by:</span> <a href="javascript:void(0)">Apple</a>
                                                         </div>
                                                     </div>
                                                     <div class="col-md-4">
                                                         <div class="text-md-end">
                                                             <div class="my-2 my-lg-6">
                                                                 <span class="text-primary">$299/</span><s class="text-muted">$359</s>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </li>
                                 </ul>
                             </div>
                             <!-- Confirmation total -->
                             <div class="col-xl-3">
                                 <div class="border rounded p-6">
                                     <!-- Price Details -->
                                     <h6>Price Details</h6>
                                     <dl class="row mb-0 text-heading">
                                         <dt class="col-6 fw-normal">Order Total</dt>
                                         <dd class="col-6 text-end">$1198.00</dd>

                                         <dt class="col-sm-6 text-heading fw-normal">Delivery Charges</dt>
                                         <dd class="col-sm-6 text-end">
                                             <s class="text-muted">$5.00</s> <span class="badge bg-label-success ms-1">Free</span>
                                         </dd>
                                     </dl>
                                     <hr class="mx-n6 mb-6" />
                                     <dl class="row mb-0">
                                         <dt class="col-6 text-heading">Total</dt>
                                         <dd class="col-6 fw-medium text-end text-heading mb-0">$1198.00</dd>
                                     </dl>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
         <!--/ Checkout Wizard -->

         <!-- Add new address modal -->
         <!-- Add New Address Modal -->
         <div class="modal fade" id="addNewAddress" tabindex="-1" aria-hidden="true">
             <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
                 <div class="modal-content">
                     <div class="modal-body">
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         <div class="text-center mb-6">
                             <h4 class="address-title mb-2">Add New Address</h4>
                             <p class="address-subtitle">Add new address for express delivery</p>
                         </div>
                         <form id="addNewAddressForm" class="row g-6" onsubmit="return false">
                             <div class="col-12">
                                 <div class="row">
                                     <div class="col-md mb-md-0 mb-4">
                                         <div class="form-check custom-option custom-option-icon">
                                             <label class="form-check-label custom-option-content" for="customRadioHome">
                                                 <span class="custom-option-body">
                                                     <svg
                                                         width="28"
                                                         height="28"
                                                         viewBox="0 0 28 28"
                                                         fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                         <path
                                                             opacity="0.2"
                                                             d="M16.625 23.625V16.625H11.375V23.625H4.37501V12.6328C4.37437 12.5113 4.39937 12.391 4.44837 12.2798C4.49737 12.1686 4.56928 12.069 4.65939 11.9875L13.4094 4.03592C13.5689 3.88911 13.7778 3.80762 13.9945 3.80762C14.2113 3.80762 14.4202 3.88911 14.5797 4.03592L23.3406 11.9875C23.4287 12.0706 23.4992 12.1706 23.548 12.2814C23.5969 12.3922 23.6231 12.5117 23.625 12.6328V23.625H16.625Z" />
                                                         <path
                                                             d="M23.625 23.625V12.6328C23.623 12.5117 23.5969 12.3922 23.548 12.2814C23.4992 12.1706 23.4287 12.0706 23.3406 11.9875L14.5797 4.03592C14.4202 3.88911 14.2113 3.80762 13.9945 3.80762C13.7777 3.80762 13.5689 3.88911 13.4094 4.03592L4.65937 11.9875C4.56926 12.069 4.49736 12.1686 4.44836 12.2798C4.39936 12.391 4.37436 12.5113 4.375 12.6328V23.625M1.75 23.625H26.25M16.625 23.625V17.5C16.625 17.2679 16.5328 17.0454 16.3687 16.8813C16.2046 16.7172 15.9821 16.625 15.75 16.625H12.25C12.0179 16.625 11.7954 16.7172 11.6313 16.8813C11.4672 17.0454 11.375 17.2679 11.375 17.5V23.625"
                                                             stroke-width="2"
                                                             stroke-linecap="round"
                                                             stroke-linejoin="round" />
                                                     </svg>
                                                     <span class="custom-option-title">Home</span>
                                                     <small> Delivery time (9am – 9pm) </small>
                                                 </span>
                                                 <input
                                                     name="customRadioIcon"
                                                     class="form-check-input"
                                                     type="radio"
                                                     value=""
                                                     id="customRadioHome"
                                                     checked />
                                             </label>
                                         </div>
                                     </div>
                                     <div class="col-md mb-md-0 mb-4">
                                         <div class="form-check custom-option custom-option-icon">
                                             <label class="form-check-label custom-option-content" for="customRadioOffice">
                                                 <span class="custom-option-body">
                                                     <svg
                                                         width="28"
                                                         height="28"
                                                         viewBox="0 0 28 28"
                                                         fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                         <path
                                                             opacity="0.2"
                                                             d="M15.75 23.625V4.375C15.75 4.14294 15.6578 3.92038 15.4937 3.75628C15.3296 3.59219 15.1071 3.5 14.875 3.5H4.375C4.14294 3.5 3.92038 3.59219 3.75628 3.75628C3.59219 3.92038 3.5 4.14294 3.5 4.375V23.625" />
                                                         <path
                                                             d="M1.75 23.625H26.25M15.75 23.625V4.375C15.75 4.14294 15.6578 3.92038 15.4937 3.75628C15.3296 3.59219 15.1071 3.5 14.875 3.5H4.375C4.14294 3.5 3.92038 3.59219 3.75628 3.75628C3.59219 3.92038 3.5 4.14294 3.5 4.375V23.625M24.5 23.625V11.375C24.5 11.1429 24.4078 10.9204 24.2437 10.7563C24.0796 10.5922 23.8571 10.5 23.625 10.5H15.75M7 7.875H10.5M8.75 14.875H12.25M7 19.25H10.5M19.25 19.25H21M19.25 14.875H21"
                                                             stroke-opacity="0.9"
                                                             stroke-width="2"
                                                             stroke-linecap="round"
                                                             stroke-linejoin="round" />
                                                     </svg>
                                                     <span class="custom-option-title"> Office </span>
                                                     <small> Delivery time (9am – 5pm) </small>
                                                 </span>
                                                 <input
                                                     name="customRadioIcon"
                                                     class="form-check-input"
                                                     type="radio"
                                                     value=""
                                                     id="customRadioOffice" />
                                             </label>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-12 col-md-6">
                                 <label class="form-label" for="modalAddressFirstName">First Name</label>
                                 <input
                                     type="text"
                                     id="modalAddressFirstName"
                                     name="modalAddressFirstName"
                                     class="form-control"
                                     placeholder="John" />
                             </div>
                             <div class="col-12 col-md-6">
                                 <label class="form-label" for="modalAddressLastName">Last Name</label>
                                 <input
                                     type="text"
                                     id="modalAddressLastName"
                                     name="modalAddressLastName"
                                     class="form-control"
                                     placeholder="Doe" />
                             </div>
                             <div class="col-12">
                                 <label class="form-label" for="modalAddressCountry">Country</label>
                                 <select
                                     id="modalAddressCountry"
                                     name="modalAddressCountry"
                                     class="select2 form-select"
                                     data-allow-clear="true">
                                     <option value="">Select</option>
                                     <option value="Australia">Australia</option>
                                     <option value="Bangladesh">Bangladesh</option>
                                     <option value="Belarus">Belarus</option>
                                     <option value="Brazil">Brazil</option>
                                     <option value="Canada">Canada</option>
                                     <option value="China">China</option>
                                     <option value="France">France</option>
                                     <option value="Germany">Germany</option>
                                     <option value="India">India</option>
                                     <option value="Indonesia">Indonesia</option>
                                     <option value="Israel">Israel</option>
                                     <option value="Italy">Italy</option>
                                     <option value="Japan">Japan</option>
                                     <option value="Korea">Korea, Republic of</option>
                                     <option value="Mexico">Mexico</option>
                                     <option value="Philippines">Philippines</option>
                                     <option value="Russia">Russian Federation</option>
                                     <option value="South Africa">South Africa</option>
                                     <option value="Thailand">Thailand</option>
                                     <option value="Turkey">Turkey</option>
                                     <option value="Ukraine">Ukraine</option>
                                     <option value="United Arab Emirates">United Arab Emirates</option>
                                     <option value="United Kingdom">United Kingdom</option>
                                     <option value="United States">United States</option>
                                 </select>
                             </div>
                             <div class="col-12">
                                 <label class="form-label" for="modalAddressAddress1">Address Line 1</label>
                                 <input
                                     type="text"
                                     id="modalAddressAddress1"
                                     name="modalAddressAddress1"
                                     class="form-control"
                                     placeholder="12, Business Park" />
                             </div>
                             <div class="col-12">
                                 <label class="form-label" for="modalAddressAddress2">Address Line 2</label>
                                 <input
                                     type="text"
                                     id="modalAddressAddress2"
                                     name="modalAddressAddress2"
                                     class="form-control"
                                     placeholder="Mall Road" />
                             </div>
                             <div class="col-12 col-md-6">
                                 <label class="form-label" for="modalAddressLandmark">Landmark</label>
                                 <input
                                     type="text"
                                     id="modalAddressLandmark"
                                     name="modalAddressLandmark"
                                     class="form-control"
                                     placeholder="Nr. Hard Rock Cafe" />
                             </div>
                             <div class="col-12 col-md-6">
                                 <label class="form-label" for="modalAddressCity">City</label>
                                 <input
                                     type="text"
                                     id="modalAddressCity"
                                     name="modalAddressCity"
                                     class="form-control"
                                     placeholder="Los Angeles" />
                             </div>
                             <div class="col-12 col-md-6">
                                 <label class="form-label" for="modalAddressLandmark">State</label>
                                 <input
                                     type="text"
                                     id="modalAddressState"
                                     name="modalAddressState"
                                     class="form-control"
                                     placeholder="California" />
                             </div>
                             <div class="col-12 col-md-6">
                                 <label class="form-label" for="modalAddressZipCode">Zip Code</label>
                                 <input
                                     type="text"
                                     id="modalAddressZipCode"
                                     name="modalAddressZipCode"
                                     class="form-control"
                                     placeholder="99950" />
                             </div>
                             <div class="col-12">
                                 <div class="form-check form-switch">
                                     <input type="checkbox" class="form-check-input" id="billingAddress" />
                                     <label for="billingAddress" class="form-label">Use as a billing address?</label>
                                 </div>
                             </div>
                             <div class="col-12 text-center">
                                 <button type="submit" class="btn btn-primary me-3">Submit</button>
                                 <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                                     Cancel
                                 </button>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
         <!--/ Add New Address Modal -->
     </div>
 </section>

 <!-- / Sections:End -->

 <script src="<?= base_url('assets/vendor/libs/jquery/jquery.js') ?>"></script>
 <script src="<?= base_url('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') ?>"></script>
 <script src="<?= base_url('assets/js/backend/cart.js') ?>"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>