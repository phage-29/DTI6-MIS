<!-- Modal -->
<div class="modal fade" id="updatePasswordModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="updatePasswordModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updatePasswordModalLabel">Update Password</h5>
      </div>
      <div class="modal-body">
        <form class="needs-validation">
          <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
              onkeyup="if(this.value != password.value) {dnm.hidden=false;upbtn.disabled=true}else {dnm.hidden=true;upbtn.disabled=false}"
              required>
            <span class="text-danger" id="dnm" hidden>do not match.</span>
          </div>
          <div hidden>
            <input id="change_temp_password" name="change_temp_password" value="" />
          </div>
          <div class="text-end">
            <button type="submit" id="upbtn" class="btn btn-primary" disabled>Update Password</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function () {
    if ('<?= $acc->temp_password ?>' != '') {
      $('#updatePasswordModal').modal('show');
    }
  });
</script>

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
  <div class="copyright">
    DTI6-MIS &copy; Copyright <strong><span>DTI Region VI</span></strong>
    <?= date('Y') ?>. All Rights Reserved
  </div>
  <div class="credits">
    Designed by <a href="#">Phage</a>
  </div>
</footer>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
    class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>