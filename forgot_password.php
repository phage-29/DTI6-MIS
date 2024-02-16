<?php $page = "Login" ?>
<?php $protected = false ?>
<?php require_once "assets/components/templates/header.php"; ?>
<main>
  <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

          <div class="d-flex justify-content-center py-4">
            <a href="#DTI6-MIS" class="logo d-flex align-items-center w-auto">
              <img src="assets/img/logo.png" alt="">
              <span class="d-block">
                <?= $website ?>
              </span>
            </a>
          </div><!-- End Logo -->

          <div class="card mb-3">

            <div class="card-body">

              <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">Forgot Password</h5>
                <p class="text-center small">Enter your email to receive temporary password.</p>
              </div>

              <form class="row g-3 needs-validation" novalidate>

                <div class="col-12">
                  <label for="email" class="form-label">Email</label>
                  <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-envelope"></i></span>
                    <input type="text" name="email" class="form-control" id="email" autocomplete="off" required />
                  </div>
                </div>
                
                <div class="col-12">
                  <input type="hidden" name="forgot_password" />
                  <button class="btn btn-primary w-100" type="submit">
                    Forgot password</button>
                </div>
                <div class="col-12">
                  <p class="mb-0 text-center"><a href="login.php">Return to login</a></p>
                </div>
              </form>


            </div>
          </div>

          <div class="credits">
            Designed by <a href="#">Phage</a>
          </div>

        </div>
      </div>
    </div>

  </section>
</main><!-- End #main -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
    class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>