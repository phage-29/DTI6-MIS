<?php require_once "assets/components/templates/header.php"; ?>
<main>
  <div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-7 d-flex flex-column align-items-center justify-content-center">

            <div class="d-flex justify-content-center py-4">
              <a href="index.html" class="logo d-flex align-items-center w-auto">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">NiceAdmin</span>
              </a>
            </div><!-- End Logo -->

            <div class="card mb-3">

              <div class="card-body">

                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                  <p class="text-center small">Enter your personal details to create account</p>
                </div>

                <form class="row g-3">

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
                      <input type="password" name="password" class="form-control" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" autocomplete="off" required />
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-check">
                      <input class="form-check-input" name="terms" type="checkbox" value="" id="terms" autocomplete="off" required />
                      <label class="form-check-label" for="terms">I agree and accept the <a href="#">terms and conditions</a></label>
                      <div class="invalid-feedback">You must agree before submitting.</div>
                    </div>
                  </div>

                  <div class="col-12">
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

  </div>
</main><!-- End #main -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>