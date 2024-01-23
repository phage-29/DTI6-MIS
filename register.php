<?php $page = "Register" ?>
<?php require_once "assets/components/templates/header.php"; ?>
<main>
  <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7 d-flex flex-column align-items-center justify-content-center">

          <div class="d-flex justify-content-center py-4">
            <a href="index.html" class="logo d-flex align-items-center w-auto">
              <img src="assets/img/logo.png" alt="">
              <span class="d-none d-lg-block"><?= $website ?></span>
            </a>
          </div><!-- End Logo -->

          <div class="card mb-3">

            <div class="card-body">

              <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                <p class="text-center small">Enter your personal details to create account</p>
              </div>

              <form class="row g-3 needs-validation" novalidate>

                <div class="col-12">
                  <label for="first_name" class="form-label">First Name</label>
                  <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person-lines-fill"></i></span>
                    <input type="text" name="first_name" class="form-control" id="first_name" autocomplete="off" required />
                  </div>
                </div>

                <div class="col-12">
                  <label for="middle_name" class="form-label">Middle Name</label>
                  <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person-lines-fill"></i></span>
                    <input type="text" name="middle_name" class="form-control" id="middle_name" autocomplete="off" required />
                  </div>
                </div>

                <div class="col-12">
                  <label for="last_name" class="form-label">Last Name</label>
                  <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person-lines-fill"></i></span>
                    <input type="text" name="last_name" class="form-control" id="last_name" autocomplete="off" required />
                  </div>
                </div>

                <div class="col-12">
                  <label for="email" class="form-label">Email</label>
                  <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-envelope-at"></i></span>
                    <input type="email" name="email" class="form-control" id="email" autocomplete="off" required />
                  </div>
                </div>

                <div class="col-12">
                  <label for="username" class="form-label">Username</label>
                  <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person"></i></span>
                    <input type="text" name="username" class="form-control" id="username" autocomplete="off" required />
                  </div>
                </div>

                <div class="col-12">
                  <label for="password" class="form-label">Password</label>
                  <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-shield-lock"></i></span>
                    <input type="password" name="password" class="form-control" id="password" pattern="{8,}" title="Must contain at least 8 or more characters" autocomplete="off" required />
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" name="terms" type="checkbox" value="" id="terms" autocomplete="off" required />
                    <label class="form-check-label" for="terms">I agree and accept the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">terms and conditions</a></label>
                    <div class="invalid-feedback">You must agree before submitting.</div>
                  </div>
                </div>

                <!-- Terms and condition -->
                <!-- Modal -->
                <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="termsModalLabel">DTIR6-MIS Website Terms and Conditions</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <p><strong>DTIR6-MIS Website Terms and Conditions</strong></p>
                        <p><strong>Last Updated: [Date]</strong></p>
                        <p>Welcome to DTIR6-MIS! These Terms and Conditions ("Terms") govern your use of the DTIR6-MIS website (the "Site"). By accessing or using the Site, you agree to comply with and be bound by these Terms. If you do not agree with these Terms, please refrain from using the Site.</p>
                        <p><strong>1. User Accounts:</strong></p>
                        <p>1.1 You may be required to create a user account to access certain features of the Site.</p>
                        <p>1.2 You agree to provide accurate, current, and complete information during the registration process and to update such information to keep it accurate, current, and complete.</p>
                        <p>1.3 You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account.</p>
                        <p><strong>2. Employee Requests:</strong></p>
                        <p>2.1 The Site provides functionality for employees to request Zoom schedules, request ICT services, and gather general information about employees.</p>
                        <p>2.2 All requests made through the Site are subject to approval by the designated administrators.</p>
                        <p><strong>3. Data Security:</strong></p>
                        <p>3.1 The administrators of DTIR6-MIS are committed to ensuring the security and confidentiality of the information collected on the Site.</p>
                        <p>3.2 All information submitted by employees is stored securely and is accessible only to authorized personnel.</p>
                        <p>3.3 The administrators will take reasonable steps to safeguard the information from unauthorized access, disclosure, alteration, and destruction.</p>
                        <p><strong>4. Purpose of the System:</strong></p>
                        <p>4.1 DTIR6-MIS is designed solely for the purpose of recording and managing employee-related data in accordance with agency standards.</p>
                        <p>4.2 The system is not to be used for any unlawful, unauthorized, or inappropriate purposes.</p>
                        <p><strong>5. Compliance with Laws:</strong></p>
                        <p>5.1 Users of the Site must comply with all applicable laws and regulations, including but not limited to privacy laws and data protection regulations.</p>
                        <p>5.2 Any misuse of the Site or violation of these Terms may result in the suspension or termination of user accounts.</p>
                        <p><strong>6. Modification of Terms:</strong></p>
                        <p>6.1 These Terms may be updated from time to time without prior notice.</p>
                        <p>6.2 It is your responsibility to review these Terms periodically for any changes. Continued use of the Site after any modifications implies acceptance of the updated Terms.</p>
                        <p><strong>7. Limitation of Liability:</strong></p>
                        <p>7.1 The administrators of DTIR6-MIS shall not be liable for any direct, indirect, incidental, special, or consequential damages resulting from the use or inability to use the Site.</p>
                        <p>7.2 In no event shall the administrators be liable for any loss or damage arising out of or in connection with the use of the Site.</p>
                        <p><strong>8. Governing Law:</strong></p>
                        <p>8.1 These Terms shall be governed by and construed in accordance with the laws of [Your Jurisdiction].</p>
                        <p><strong>Contact Information:</strong></p>
                        <p>If you have any questions or concerns regarding these Terms, please contact us at [Your Contact Information].</p>
                        <p>Thank you for using DTIR6-MIS!</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <input type="hidden" name="register" />
                  <button class="btn btn-primary w-100" type="submit"><i class="bi bi-person-plus"></i> Create Account</button>
                </div>

                <div class="col-12">
                  <p class="small mb-0">Already have an account? <a href="login.php">Log in</a></p>
                </div>
              </form>
            </div>
          </div>

          <div class="credits">
            Designed by <a href="#">Someone</a>
          </div>

        </div>
      </div>
    </div>

  </section>
</main><!-- End #main -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>