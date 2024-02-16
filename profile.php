<?php $page = "Profile" ?>
<?php $protected = true ?>
<?php require_once "assets/components/templates/header.php"; ?>
<?php require_once "assets/components/templates/topbar.php"; ?>
<?php require_once "assets/components/templates/sidebar.php"; ?>
<main id="main" class="main">
  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="assets\img\apple-touch-icon.png" alt="Profile">
            <h2>
              <?= $acc->first_name ?>
              <?= $acc->middle_name ?>
              <?= $acc->last_name ?>
            </h2>
            <h3>
              <?= $acc->position ?>
            </h3>
            <h3>
              <?= $acc->role ?>
            </h3>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">



              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Profile</button>
              </li>



              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change
                  Password</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form class="needs-validation">
                  <div class="row mb-2">
                    <label for="first_name" class="col-md-4 col-lg-3 col-form-label">First name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="first_name" type="text" class="form-control form-control-sm" id="first_name"
                        value="<?= $acc->first_name ?>">
                    </div>
                  </div>
                  <div class="row mb-2">
                    <label for="middle_name" class="col-md-4 col-lg-3 col-form-label">Middle name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="middle_name" type="text" class="form-control form-control-sm" id="middle_name"
                        value="<?= $acc->middle_name ?>">
                    </div>
                  </div>
                  <div class="row mb-2">
                    <label for="last_name" class="col-md-4 col-lg-3 col-form-label">Last name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="last_name" type="text" class="form-control form-control-sm" id="last_name"
                        value="<?= $acc->last_name ?>">
                    </div>
                  </div>

                  <div class="row mb-2">
                    <label for="sex" class="col-md-4 col-lg-3 col-form-label">Sex</label>
                    <div class="col-md-8 col-lg-9">
                      <select name="sex" type="text" class="form-select form-select-sm" id="sex">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <label for="client_type_id" class="col-md-4 col-lg-3 col-form-label">Client type</label>
                    <div class="col-md-8 col-lg-9">
                      <select name="client_type_id" type="text" class="form-select form-select-sm" id="client_type_id">
                        <?php
                        $query = $conn->query("SELECT * FROM client_types ORDER BY client_type");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>" <?= $acc->client_type_id == $row->id ? 'selected' : '' ?>>
                            <?= $row->client_type ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <label for="division_id" class="col-md-4 col-lg-3 col-form-label">Division</label>
                    <div class="col-md-8 col-lg-9">
                      <select name="division_id" type="text" class="form-select form-select-sm" id="division_id">
                        <?php
                        $query = $conn->query("SELECT * FROM divisions ORDER BY division");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>" <?= $acc->division_id == $row->id ? 'selected' : '' ?>>
                            <?= $row->division ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <label for="position" class="col-md-4 col-lg-3 col-form-label">Position</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="position" type="text" class="form-control form-control-sm" id="position"
                        value="<?= $acc->position ?>">
                    </div>
                  </div>

                  <div class="row mb-2">
                    <label for="date_birth" class="col-md-4 col-lg-3 col-form-label">Date of birth</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="date_birth" type="date" class="form-control form-control-sm" id="date_birth"
                        value="<?= $acc->date_birth ?>">
                    </div>
                  </div>

                  <div class="row mb-2">
                    <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="phone" type="text" class="form-control form-control-sm" id="phone"
                        value="<?= $acc->phone ?>">
                    </div>
                  </div>

                  <div class="row mb-2">
                    <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email" class="form-control form-control-sm" id="email"
                        value="<?= $acc->email ?>">
                    </div>
                  </div>

                  <div class="row mb-2">
                    <label for="address" class="col-md-4 col-lg-3 col-form-label">address</label>
                    <div class="col-md-8 col-lg-9">
                      <textarea name="address" class="form-control form-control-sm"
                        id="address"><?= $acc->address ?></textarea>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <label for="pwd" class="col-md-4 col-lg-3 col-form-label"></label>
                    <div class="col-md-8 col-lg-9">
                      <div class="form-check">
                        <input class="form-check-input form-check-sm" type="checkbox" value="" name="pwd" id="pwd"
                          <?= $acc->pwd ? 'checked' : '' ?> />
                        <span class="form-check-label" for="flexCheckDefault">
                          PWD
                        </span>
                      </div>
                    </div>
                  </div>
                  <div hidden>
                    <input name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>" />
                    <input class="captcha-token" name="captcha-token" />
                    <input name="update_profile" />
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

              <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form class="needs-validation">

                  <div class="row mb-2">
                    <label for="password" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password" type="password" class="form-control" id="password" required />
                    </div>
                  </div>

                  <div class="row mb-2">
                    <label for="new_password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="new_password" type="password" class="form-control" id="new_password" required />
                    </div>
                  </div>

                  <div class="row mb-2">
                    <label for="ver_password" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="ver_password" type="password" class="form-control" id="ver_password" required />
                    </div>
                  </div>
                  <div hidden>
                    <input name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>" />
                    <input class="captcha-token" name="captcha-token" />
                    <input name="change_password" />
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                  </div>
                </form><!-- End Change Password Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>
</main><!-- End #main -->
<?php require_once "assets/components/templates/footer.php"; ?>