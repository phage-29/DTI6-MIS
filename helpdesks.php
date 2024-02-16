<?php $page = "ICT Helpdesks" ?>
<?php $protected = true ?>
<?php require_once "assets/components/templates/header.php"; ?>
<?php require_once "assets/components/templates/topbar.php"; ?>
<?php require_once "assets/components/templates/sidebar.php"; ?>
<main id="main" class="main">
  <?php
  switch ($_SESSION['role']) {
    case 'Admin':
      ?>
      <section class="section">
        <div class="row">

          <div class="col-lg-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">ICT Request Form</h5>
                <form id="requesthelpdesks" class="row g-3 enctype-validation" enctype="multipart/form-data" novalidate>

                  <div class="mb-1">
                    <label for="date_requested">Request date</label>
                    <input name="date_requested" type="date" class="form-control form-control-sm" id="date_requested"
                      value="<?= date('Y-m-d') ?>" required />
                  </div>

                  <div class="mb-1">
                    <label for="requested_by">Requestor</label>
                    <select name="requested_by" class="form-select form-select-sm" id="requested_by">
                      <option value="" selected disabled>--</option>
                      <?php
                      $query = $conn->query("SELECT * FROM users WHERE role_id = 4");
                      while ($row = $query->fetch_object()) {
                        ?>
                        <option value="<?= $row->id ?>">
                          <?= $row->first_name ?>
                          <?= $row->last_name ?>
                        </option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>

                  <div class="mb-1">
                    <label for="request_type_id">Request type</label>
                    <select name="request_type_id" class="form-select form-select-sm" id="request_type_id" required>
                      <option value="" selected disabled>--</option>
                      <?php
                      $query = $conn->query("SELECT * FROM request_types");
                      while ($row = $query->fetch_object()) {
                        ?>
                        <option value="<?= $row->id ?>">
                          <?= $row->request_type ?>
                        </option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>

                  <div class="mb-1">
                    <label for="category_id">Category</label>
                    <select name="category_id" class="form-select form-select-sm" id="category_id" required>
                      <option value="" selected disabled>--</option>
                      <?php
                      $query = $conn->query("SELECT * FROM categories");
                      while ($row = $query->fetch_object()) {
                        ?>
                        <option data-reqtype="<?= $row->request_type_id ?>" value="<?= $row->id ?>">
                          <?= $row->category ?>
                        </option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>

                  <div class="mb-1">
                    <label for="sub_category_id">Sub category</label>
                    <select name="sub_category_id" class="form-select form-select-sm" id="sub_category_id" required>
                      <option value="" selected disabled>--</option>
                      <?php
                      $query = $conn->query("SELECT * FROM sub_categories");
                      while ($row = $query->fetch_object()) {
                        ?>
                        <option data-cat="<?= $row->category_id ?>" value="<?= $row->id ?>">
                          <?= $row->sub_category ?>
                        </option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>

                  <script>
                    $(document).ready(function () {

                      function filterOptions(selectElement, filterKey, filterValue) {
                        $(selectElement + ' option').each(function () {
                          if ($(this).data(filterKey) == filterValue || filterValue == "") {
                            $(this).show();
                          } else {
                            $(this).hide();
                          }
                        });
                        $(selectElement).val('');
                      }

                      $('#requesthelpdesks #request_type_id').change(function () {
                        filterOptions('#requesthelpdesks #category_id', 'reqtype', $(this).val());
                        $('#requesthelpdesks #sub_category_id').val('');
                      }).trigger('change');

                      $('#requesthelpdesks #category_id').change(function () {
                        filterOptions('#requesthelpdesks #sub_category_id', 'cat', $(this).val());
                      }).trigger('change');

                    });
                  </script>

                  <div class="mb-1">
                    <label for="complaint">Defect, complaint, or request.</label>
                    <div class="text-end">
                      <textarea name="complaint" class="form-control form-control-sm" id="complaint" maxlength="150"
                        required></textarea>
                    </div>
                  </div>

                  <div class="mb-1">
                    <label for="datetime_preferred">Preffered date of schedule</label>
                    <input name="datetime_preferred" type="datetime-local" class="form-control form-control-sm"
                      id="datetime_preferred" value="<?= date('Y-m-d H:i') ?>" required />
                  </div>

                  <div class="mb-1 d-none">
                    <label for="files">Additional files(Optional)</label>
                    <input name="files[]" type="file" class="form-control form-control-sm" id="files"
                      accept=".pdf,.doc,.docx,.txt,image/*" multiple />
                  </div>
                  <a class="text-end btn-link" data-bs-toggle="collapse" href="#collapseExample" id="ShowFields"
                    onclick="ShowFields.style.display = 'none';HideFields.style.display = ''">
                    Show other fields
                  </a>
                  <a class="text-end btn-link" data-bs-toggle="collapse" href="#collapseExample" id="HideFields"
                    onclick="HideFields.style.display = 'none';ShowFields.style.display = ''" style="display: none;">
                    Hide other fields
                  </a>
                  <div class="collapse" id="collapseExample">
                    <div class="mb-1">
                      <label for="status_id">Curent status</label>
                      <select name="status_id" class="form-select form-select-sm" id="status_id">
                        <?php
                        $query = $conn->query("SELECT * FROM helpdesks_statuses where id != 6");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->status ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="mb-1">
                      <label for="property_number">Property number/ Serial number</label>
                      <input name="property_number" type="text" class="form-control form-control-sm" id="property_number" />
                    </div>
                    <div class="mb-1">
                      <label for="priority_level_id">Priority level</label>
                      <select name="priority_level_id" class="form-select form-select-sm" id="priority_level_id">
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM priority_levels");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->priority_level ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="mb-1">
                      <label for="repair_type_id">Repair type</label>
                      <select name="repair_type_id" class="form-select form-select-sm" id="repair_type_id">
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM repair_types");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->repair_type ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="mb-1">
                      <label for="repair_class_id">Repair classification</label>
                      <select name="repair_class_id" class="form-select form-select-sm" id="repair_class_id">
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM repair_classes");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->repair_class ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="mb-1">
                      <label for="medium_id">Medium of request</label>
                      <select name="medium_id" class="form-select form-select-sm" id="medium_id">
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM mediums");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->medium ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="mb-1">
                      <label for="datetime_start">Date and time started</label>
                      <input name="datetime_start" type="datetime-local" class="form-control form-control-sm"
                        id="datetime_start" />
                    </div>
                    <div class="mb-1">
                      <label for="datetime_end">Date and time ended</label>
                      <input name="datetime_end" type="datetime-local" class="form-control form-control-sm"
                        id="datetime_end" />
                    </div>
                    <div class="mb-1">
                      <label for="diagnosis">Diagnosis and/or action taken</label>
                      <textarea name="diagnosis" type="date" class="form-control form-control-sm" id="diagnosis"></textarea>
                    </div>
                    <div class="mb-1">
                      <label for="remarks">Remarks and/or reccomendation</label>
                      <textarea name="remarks" type="date" class="form-control form-control-sm" id="remarks"></textarea>
                    </div>
                    <div class="mb-1">
                      <label for="assigned_to">Assigned to</label>
                      <select name="assigned_to" class="form-select form-select-sm" id="assigned_to">
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM users WHERE role_id != 4");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->first_name ?>
                            <?= $row->last_name ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="mb-1">
                      <label for="serviced_by">Serviced by</label>
                      <select name="serviced_by" class="form-select form-select-sm" id="serviced_by">
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM users WHERE role_id != 4");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->first_name ?>
                            <?= $row->last_name ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="mb-1">
                      <label for="approved_by">Approved by</label>
                      <select name="approved_by" class="form-select form-select-sm" id="approved_by">
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM users WHERE role_id = 1");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->first_name ?>
                            <?= $row->last_name ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div hidden>
                    <input name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>" />
                    <input class="captcha-token" name="captcha-token" />
                    <input name="request_helpdesk" />
                  </div>
                  <div class="text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="col-lg-8">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">ICT Request List</h5>
                <table id="admintblhelpdesks" class="display" style="width:100%;display:none;">
                  <thead>
                    <tr>
                      <th>Request No</th>
                      <th>Status</th>
                      <th>Requestor</th>
                      <th>Request Type</th>
                      <th>Category</th>
                      <th>Sub Category</th>
                      <th>Action</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>

          <!-- view Modal -->
          <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="viewModalLabel">view</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form id="requesthelpdesks" class="row g-3 enctype-validation" enctype="multipart/form-data" novalidate>

                    <div class="mb-1">
                      <label for="date_requested">Request date</label>
                      <input name="date_requested" type="date" class="form-control form-control-sm" id="date_requested"
                        value="<?= date('Y-m-d') ?>" disabled />
                    </div>

                    <div class="mb-1">
                      <label for="requested_by">Requestor</label>
                      <select name="requested_by" class="form-select form-select-sm" id="requested_by" disabled>
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM users WHERE role_id = 4");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->first_name ?>
                            <?= $row->last_name ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>

                    <div class="mb-1">
                      <label for="request_type_id">Request type</label>
                      <select name="request_type_id" class="form-select form-select-sm" id="request_type_id" disabled>
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM request_types");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->request_type ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>

                    <div class="mb-1">
                      <label for="category_id">Category</label>
                      <select name="category_id" class="form-select form-select-sm" id="category_id" disabled>
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM categories");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option data-reqtype="<?= $row->request_type_id ?>" value="<?= $row->id ?>">
                            <?= $row->category ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>

                    <div class="mb-1">
                      <label for="sub_category_id">Sub category</label>
                      <select name="sub_category_id" class="form-select form-select-sm" id="sub_category_id" disabled>
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM sub_categories");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option data-cat="<?= $row->category_id ?>" value="<?= $row->id ?>">
                            <?= $row->sub_category ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>

                    <script>
                      $(document).ready(function () {

                        function filterOptions(selectElement, filterKey, filterValue) {
                          $(selectElement + ' option').each(function () {
                            if ($(this).data(filterKey) == filterValue || filterValue == "") {
                              $(this).show();
                            } else {
                              $(this).hide();
                            }
                          });
                          $(selectElement).val('');
                        }

                        $('#requesthelpdesks #request_type_id').change(function () {
                          filterOptions('#requesthelpdesks #category_id', 'reqtype', $(this).val());
                          $('#requesthelpdesks #sub_category_id').val('');
                        }).trigger('change');

                        $('#requesthelpdesks #category_id').change(function () {
                          filterOptions('#requesthelpdesks #sub_category_id', 'cat', $(this).val());
                        }).trigger('change');

                      });
                    </script>

                    <div class="mb-1">
                      <label for="complaint">Defect, complaint, or request.</label>
                      <div class="text-end">
                        <textarea name="complaint" class="form-control form-control-sm" id="complaint" maxlength="150"
                          disabled></textarea>
                      </div>
                    </div>

                    <div class="mb-1">
                      <label for="datetime_preferred">Preffered date of schedule</label>
                      <input name="datetime_preferred" type="datetime-local" class="form-control form-control-sm"
                        id="datetime_preferred" value="<?= date('Y-m-d H:i') ?>" disabled />
                    </div>

                    <div class="mb-1 d-none">
                      <label for="files">Additional files(Optional)</label>
                      <input name="files[]" type="file" class="form-control form-control-sm" id="files"
                        accept=".pdf,.doc,.docx,.txt,image/*" multiple />
                    </div>
                    <hr>
                    <div class="mb-1">
                      <label for="status_id">Curent status</label>
                      <select name="status_id" class="form-select form-select-sm" id="status_id" disabled>
                        <?php
                        $query = $conn->query("SELECT * FROM helpdesks_statuses where id != 6");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->status ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="mb-1">
                      <label for="property_number">Property number/ Serial number</label>
                      <input name="property_number" type="text" class="form-control form-control-sm" id="property_number"
                        disabled />
                    </div>
                    <div class="mb-1">
                      <label for="priority_level_id">Priority level</label>
                      <select name="priority_level_id" class="form-select form-select-sm" id="priority_level_id" disabled>
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM priority_levels");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->priority_level ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="mb-1">
                      <label for="repair_type_id">Repair type</label>
                      <select name="repair_type_id" class="form-select form-select-sm" id="repair_type_id" disabled>
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM repair_types");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->repair_type ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="mb-1">
                      <label for="repair_class_id">Repair classification</label>
                      <select name="repair_class_id" class="form-select form-select-sm" id="repair_class_id" disabled>
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM repair_classes");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->repair_class ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="mb-1">
                      <label for="medium_id">Medium of request</label>
                      <select name="medium_id" class="form-select form-select-sm" id="medium_id" disabled>
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM mediums");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->medium ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="mb-1">
                      <label for="datetime_start">Date and time started</label>
                      <input name="datetime_start" type="datetime-local" class="form-control form-control-sm"
                        id="datetime_start" disabled />
                    </div>
                    <div class="mb-1">
                      <label for="datetime_end">Date and time ended</label>
                      <input name="datetime_end" type="datetime-local" class="form-control form-control-sm"
                        id="datetime_end" disabled />
                    </div>
                    <div class="mb-1">
                      <label for="diagnosis">Diagnosis and/or action taken</label>
                      <textarea name="diagnosis" type="date" class="form-control form-control-sm" id="diagnosis"
                        disabled></textarea>
                    </div>
                    <div class="mb-1">
                      <label for="remarks">Remarks and/or reccomendation</label>
                      <textarea name="remarks" type="date" class="form-control form-control-sm" id="remarks"
                        disabled></textarea>
                    </div>
                    <div class="mb-1">
                      <label for="assigned_to">Assigned to</label>
                      <select name="assigned_to" class="form-select form-select-sm" id="assigned_to" disabled>
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM users WHERE role_id != 4");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->first_name ?>
                            <?= $row->last_name ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="mb-1">
                      <label for="serviced_by">Serviced by</label>
                      <select name="serviced_by" class="form-select form-select-sm" id="serviced_by" disabled>
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM users WHERE role_id != 4");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->first_name ?>
                            <?= $row->last_name ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="mb-1">
                      <label for="approved_by">Approved by</label>
                      <select name="approved_by" class="form-select form-select-sm" id="approved_by" disabled>
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM users WHERE role_id = 1");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->first_name ?>
                            <?= $row->last_name ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

          <!-- edit Modal -->
          <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="editModalLabel">edit</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>

                    <div class="mb-1">
                      <label for="date_requested">Request date</label>
                      <input name="date_requested" type="date" class="form-control form-control-sm" id="date_requested"
                        value="<?= date('Y-m-d') ?>" required />
                    </div>

                    <div class="mb-1">
                      <label for="requested_by">Requestor</label>
                      <select name="requested_by" class="form-select form-select-sm" id="requested_by">
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM users WHERE role_id = 4");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->first_name ?>
                            <?= $row->last_name ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>

                    <div class="mb-1">
                      <label for="request_type_id">Request type</label>
                      <select name="request_type_id" class="form-select form-select-sm" id="request_type_id" required>
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM request_types");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->request_type ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>

                    <div class="mb-1">
                      <label for="category_id">Category</label>
                      <select name="category_id" class="form-select form-select-sm" id="category_id" required>
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM categories");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option data-reqtype="<?= $row->request_type_id ?>" value="<?= $row->id ?>">
                            <?= $row->category ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>

                    <div class="mb-1">
                      <label for="sub_category_id">Sub category</label>
                      <select name="sub_category_id" class="form-select form-select-sm" id="sub_category_id" required>
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM sub_categories");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option data-cat="<?= $row->category_id ?>" value="<?= $row->id ?>">
                            <?= $row->sub_category ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>

                    <script>
                      $(document).ready(function () {

                        function filterOptions(selectElement, filterKey, filterValue) {
                          $(selectElement + ' option').each(function () {
                            if ($(this).data(filterKey) == filterValue || filterValue == "") {
                              $(this).show();
                            } else {
                              $(this).hide();
                            }
                          });
                          $(selectElement).val('');
                        }

                        $('#requesthelpdesks #request_type_id').change(function () {
                          filterOptions('#requesthelpdesks #category_id', 'reqtype', $(this).val());
                          $('#requesthelpdesks #sub_category_id').val('');
                        }).trigger('change');

                        $('#requesthelpdesks #category_id').change(function () {
                          filterOptions('#requesthelpdesks #sub_category_id', 'cat', $(this).val());
                        }).trigger('change');

                      });
                    </script>

                    <div class="mb-1">
                      <label for="complaint">Defect, complaint, or request.</label>
                      <div class="text-end">
                        <textarea name="complaint" class="form-control form-control-sm" id="complaint" maxlength="150"
                          required></textarea>
                      </div>
                    </div>

                    <div class="mb-1">
                      <label for="datetime_preferred">Preffered date of schedule</label>
                      <input name="datetime_preferred" type="datetime-local" class="form-control form-control-sm"
                        id="datetime_preferred" value="<?= date('Y-m-d H:i') ?>" required />
                    </div>

                    <div class="mb-1">
                      <label for="status_id">Curent status</label>
                      <select name="status_id" class="form-select form-select-sm" id="status_id">
                        <?php
                        $query = $conn->query("SELECT * FROM helpdesks_statuses where id != 6");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->status ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>

                    <div class="mb-1">
                      <label for="property_number">Property number/ Serial number</label>
                      <input name="property_number" type="text" class="form-control form-control-sm" id="property_number" />
                    </div>

                    <div class="mb-1">
                      <label for="priority_level_id">Priority level</label>
                      <select name="priority_level_id" class="form-select form-select-sm" id="priority_level_id">
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM priority_levels");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->priority_level ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>

                    <div class="mb-1">
                      <label for="repair_type_id">Repair type</label>
                      <select name="repair_type_id" class="form-select form-select-sm" id="repair_type_id">
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM repair_types");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->repair_type ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>

                    <div class="mb-1">
                      <label for="repair_class_id">Repair classification</label>
                      <select name="repair_class_id" class="form-select form-select-sm" id="repair_class_id">
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM repair_classes");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->repair_class ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>

                    <div class="mb-1">
                      <label for="medium_id">Medium of request</label>
                      <select name="medium_id" class="form-select form-select-sm" id="medium_id">
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM mediums");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->medium ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>

                    <div class="mb-1">
                      <label for="datetime_start">Date and time started</label>
                      <input name="datetime_start" type="datetime-local" class="form-control form-control-sm"
                        id="datetime_start" />
                    </div>

                    <div class="mb-1">
                      <label for="datetime_end">Date and time ended</label>
                      <input name="datetime_end" type="datetime-local" class="form-control form-control-sm"
                        id="datetime_end" />
                    </div>

                    <div class="mb-1">
                      <label for="diagnosis">Diagnosis and/or action taken</label>
                      <textarea name="diagnosis" type="date" class="form-control form-control-sm" id="diagnosis"></textarea>
                    </div>

                    <div class="mb-1">
                      <label for="remarks">Remarks and/or reccomendation</label>
                      <textarea name="remarks" type="date" class="form-control form-control-sm" id="remarks"></textarea>
                    </div>

                    <div class="mb-1">
                      <label for="assigned_to">Assigned to</label>
                      <select name="assigned_to" class="form-select form-select-sm" id="assigned_to">
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM users WHERE role_id != 4");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->first_name ?>
                            <?= $row->last_name ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>

                    <div class="mb-1">
                      <label for="serviced_by">Serviced by</label>
                      <select name="serviced_by" class="form-select form-select-sm" id="serviced_by">
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM users WHERE role_id != 4");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->first_name ?>
                            <?= $row->last_name ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>

                    <div class="mb-1">
                      <label for="approved_by">Approved by</label>
                      <select name="approved_by" class="form-select form-select-sm" id="approved_by">
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM users WHERE role_id = 1");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->first_name ?>
                            <?= $row->last_name ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>

                    <div hidden>
                      <input name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>" />
                      <input class="captcha-token" name="captcha-token" />
                      <input name="id" id="id" />
                      <input name="edit_helpdesk" />
                      <button type="submit" id="editModalSubmit"></button>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" onclick="editModalSubmit.click()">Save changes</button>
                </div>
              </div>
            </div>
          </div>

          <!-- csf Modal -->
          <div class="modal fade" id="csfModal" tabindex="-1" aria-labelledby="csfModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="csfModalLabel">csf</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="needs-validation">
                    <p class="small"><strong class="small">PART I. Our office is committed to continually improve our
                        services to our external clients. Please answer this Form for us to know your feedback on the
                        different aspects of our services. Your feedback and impressions will help us in improving our
                        services in order to better serve our clients. Rest assured all information you will provide shall
                        be treated with strict confidentiality. </strong></p>

                    <hr>

                    <div class="row mb-2 crit1">
                      <div class="col-lg-6 col-md-12 col-sm-12 small">
                        <p><strong>RESPONSIVENESS, ASSURANCE, AND INTEGRITY</strong></p>
                        <p>Delivery of services are on time, friendly, courteous, fair and in a professional manner.</p>
                      </div>
                      <div class="col-lg-6 col-md-12 col-sm-12 row">
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="4" id="crit1-4"
                            onclick="updateRating('crit1', 4, this)" title="Excellent">
                            <i class="fs-3 bi bi-emoji-laughing"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="3" id="crit1-3"
                            onclick="updateRating('crit1', 3, this)" title="Good">
                            <i class="fs-3 bi bi-emoji-smile"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="2" id="crit1-2"
                            onclick="updateRating('crit1', 2, this)" title="Average">
                            <i class="fs-3 bi bi-emoji-frown"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="1" id="crit1-1"
                            onclick="updateRating('crit1', 1, this)" title="Poor">
                            <i class="fs-3 bi bi-emoji-angry"></i>
                          </button>
                        </div>
                      </div>
                      <input type="hidden" name="crit1" id="crit1" />
                    </div>

                    <div class="row mb-2 crit2">
                      <div class="col-lg-6 col-md-12 col-sm-12 small">
                        <p><strong>RELIABILITY AND OUTCOME</strong></p>
                        <p>Actual services are acted upon immediately. Delivery of service are complete, accurate and
                          corresponds to requirement.</p>
                      </div>
                      <div class="col-lg-6 col-md-12 col-sm-12 row">
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="4" id="crit2-4"
                            onclick="updateRating('crit2', 4, this)" title="Excellent">
                            <i class="fs-3 bi bi-emoji-laughing"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="3" id="crit2-3"
                            onclick="updateRating('crit2', 3, this)" title="Good">
                            <i class="fs-3 bi bi-emoji-smile"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="2" id="crit2-2"
                            onclick="updateRating('crit2', 2, this)" title="Average">
                            <i class="fs-3 bi bi-emoji-frown"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="1" id="crit2-1"
                            onclick="updateRating('crit2', 1, this)" title="Poor">
                            <i class="fs-3 bi bi-emoji-angry"></i>
                          </button>
                        </div>
                      </div>
                      <input type="hidden" name="crit2" id="crit2" />
                    </div>

                    <div class="row mb-2 crit3">
                      <div class="col-lg-6 col-md-12 col-sm-12 small">
                        <p><strong>ACCESS AND FACILITIES</strong></p>
                        <p>Computer and Technology facilities and services are sustainable and available when needed.</p>
                      </div>
                      <div class="col-lg-6 col-md-12 col-sm-12 row">
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="4" id="crit3-4"
                            onclick="updateRating('crit3', 4, this)" title="Excellent">
                            <i class="fs-3 bi bi-emoji-laughing"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="3" id="crit3-3"
                            onclick="updateRating('crit3', 3, this)" title="Good">
                            <i class="fs-3 bi bi-emoji-smile"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="2" id="crit3-2"
                            onclick="updateRating('crit3', 2, this)" title="Average">
                            <i class="fs-3 bi bi-emoji-frown"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="1" id="crit3-1"
                            onclick="updateRating('crit3', 1, this)" title="Poor">
                            <i class="fs-3 bi bi-emoji-angry"></i>
                          </button>
                        </div>
                      </div>
                      <input type="hidden" name="crit3" id="crit3" />
                    </div>

                    <div class="row mb-2 crit4">
                      <div class="col-lg-6 col-md-12 col-sm-12 small">
                        <p><strong>COMMUNICATION</strong></p>
                        <p>The requirements and process for the service requests system is properly communicated.</p>
                      </div>
                      <div class="col-lg-6 col-md-12 col-sm-12 row">
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="4" id="crit4-4"
                            onclick="updateRating('crit4', 4, this)" title="Excellent">
                            <i class="fs-3 bi bi-emoji-laughing"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="3" id="crit4-3"
                            onclick="updateRating('crit4', 3, this)" title="Good">
                            <i class="fs-3 bi bi-emoji-smile"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="2" id="crit4-2"
                            onclick="updateRating('crit4', 2, this)" title="Average">
                            <i class="fs-3 bi bi-emoji-frown"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="1" id="crit4-1"
                            onclick="updateRating('crit4', 1, this)" title="Poor">
                            <i class="fs-3 bi bi-emoji-angry"></i>
                          </button>
                        </div>
                      </div>
                      <input type="hidden" name="crit4" id="crit4" />
                    </div>

                    <hr>

                    <div class="row mb-2 overall">
                      <div class="col-lg-6 col-md-12 col-sm-12 small">
                        <p><strong>OVERALL SATISFACTION RATING</strong></p>
                        <p>Overall, how satisfied are you with the technology facilities and services available?</p>
                      </div>
                      <div class="col-lg-6 col-md-12 col-sm-12 row">
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="4" id="overall-4"
                            onclick="updateRating('overall', 4, this)" title="Excellent">
                            <i class="fs-3 bi bi-emoji-laughing"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="3" id="overall-3"
                            onclick="updateRating('overall', 3, this)" title="Good">
                            <i class="fs-3 bi bi-emoji-smile"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="2" id="overall-2"
                            onclick="updateRating('overall', 2, this)" title="Average">
                            <i class="fs-3 bi bi-emoji-frown"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="1" id="overall-1"
                            onclick="updateRating('overall', 1, this)" title="Poor">
                            <i class="fs-3 bi bi-emoji-angry"></i>
                          </button>
                        </div>
                      </div>
                      <input type="hidden" name="overall" id="overall" />
                    </div>

                    <script>
                      function updateRating(elementId, value, button) {
                        $('#' + elementId).val(value);
                        // Remove the 'selected' class from all buttons
                        $('.' + elementId + ' .rating-button').removeClass('text-warning');
                        // Add the 'selected' class to the clicked button
                        $(button).addClass('text-warning');
                      }
                    </script>

                    <hr>
                    <hr>

                    <p class="small"><strong>PART II. COMMENTS AND SUGGESTIONS</strong></p>

                    <hr>

                    <div class="mb-2">
                      <label for="reasons" class="small">Please write in the space below your reason/s for your
                        "DISSATISFIED" or "VERY DISSATISFIED" rating so that we will know in which area/s we need to
                        improve.</label>
                      <textarea name="reasons" class="form-control form-control-sm" id="reasons" maxlength="150"></textarea>
                    </div>

                    <div class="mb-2">
                      <label for="comments" class="small">Please give comments/suggestions to help us improve our
                        service/s:</label>
                      <textarea name="comments" class="form-control form-control-sm" id="comments"
                        maxlength="150"></textarea>
                    </div>
                    <hr>
                    <hr>
                    <p class="m-0 p-0 text-center"><strong>THANK YOU!!!</strong></p>

                    <div hidden>
                      <input name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>" />
                      <input class="captcha-token" name="captcha-token" />
                      <input name="helpdesks_id" id="helpdesks_id" />
                      <input name="id" id="id" />
                      <input name="add_csf" id="add_csf" disabled />
                      <input name="edit_csf" id="edit_csf" disabled />
                      <button type="submit" id="csfbtn"></button>
                    </div>

                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" onclick="csfbtn.click();">Save Changes</button>
                </div>
              </div>
            </div>
          </div>

          <script>
            jQuery(document).ready(function () {
              var admintblhelpdesks = $('#admintblhelpdesks').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "ajax": "assets/components/includes/datatables.php?helpdesks1",
                "columnDefs": [{
                  "className": "dt-nowrap",
                  "targets": [0, 1, 2, 3, 4, 5, 6, 7]
                }, {
                  "target": 8,
                  "visible": false,
                  "searchable": false
                }],
                "order": [
                  [8, 'asc'],
                  [0, 'desc']
                ],
                "initComplete": function (settings, json) {
                  $('#admintblhelpdesks').show();
                }
              });
              setInterval(function () {
                admintblhelpdesks.ajax.reload()
              }, 30000);

            });

            function useraction(action, id) {
              switch (action) {
                case 'cancel':
                  Swal.fire({
                    title: "Are you sure?",
                    text: "This request will be cancelled!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, cancel",
                  }).then((result) => {
                    if (result.isConfirmed) {
                      Swal.fire({
                        title: "Loading",
                        html: "Please wait...",
                        allowOutsideClick: false,
                        didOpen: function () {
                          Swal.showLoading();
                        },
                      });
                      $.ajax({
                        type: "POST",
                        url: "assets/components/includes/process.php",
                        data: {
                          'cancel_helpdesk': '',
                          'id': id
                        },
                        dataType: "json",
                        success: function (response) {
                          setTimeout(function () {
                            Swal.fire({
                              icon: response.status,
                              title: response.message,
                              showConfirmButton: false,
                              timer: 1000,
                            }).then(function () {
                              if (response.redirect) {
                                window.location.href = response.redirect;
                              } else {
                                location.reload();
                              }
                            });
                          }, 1000);
                        },
                      });
                    }
                  });
                  break;
                case 'view':
                  $.ajax({
                    type: "POST",
                    url: "assets/components/includes/fetch.php",
                    data: {
                      'edit_helpdesk': '',
                      'id': id
                    },
                    dataType: 'json',
                    success: function (response) {
                      console.log(response);
                      $('#viewModal #id').val(response.id);
                      $('#viewModal #requested_by').val(response.requested_by);
                      $('#viewModal #date_requested').val(response.date_requested);
                      $('#viewModal #request_type_id').val(response.request_type_id);
                      $('#viewModal #category_id').val(response.category_id);
                      $('#viewModal #sub_category_id').val(response.sub_category_id);
                      $('#viewModal #complaint').html(response.complaint);
                      $('#viewModal #datetime_preferred').val(response.datetime_preferred);
                      $('#viewModal #status_id').val(response.status_id);
                      $('#viewModal #property_number').val(response.property_number);
                      $('#viewModal #priority_level_id').val(response.priority_level_id);
                      $('#viewModal #repair_type_id').val(response.repair_type_id);
                      $('#viewModal #repair_class_id').val(response.repair_class_id);
                      $('#viewModal #medium_id').val(response.medium_id);
                      $('#viewModal #assigned_to').val(response.assigned_to);
                      $('#viewModal #serviced_by').val(response.serviced_by);
                      $('#viewModal #approved_by').val(response.approved_by);
                      $('#viewModal #datetime_start').val(response.datetime_start);
                      $('#viewModal #datetime_end').val(response.datetime_end);
                      $('#viewModal #diagnosis').html(response.diagnosis);
                      $('#viewModal #remarks').html(response.remarks);
                      $('#viewModalLabel').html(response.request_number + ' (<span class="text-' + response.color + '">' + response.status + '</span>)');
                    }
                  });
                  $('#viewModal').modal('show');
                  break;
                case 'edit':
                  $.ajax({
                    type: "POST",
                    url: "assets/components/includes/fetch.php",
                    data: {
                      'edit_helpdesk': '',
                      'id': id
                    },
                    dataType: 'json',
                    success: function (response) {
                      console.log(response);
                      $('#editModal #id').val(response.id);
                      $('#editModal #requested_by').val(response.requested_by);
                      $('#editModal #date_requested').val(response.date_requested);
                      $('#editModal #request_type_id').val(response.request_type_id);
                      $('#editModal #category_id').val(response.category_id);
                      $('#editModal #sub_category_id').val(response.sub_category_id);
                      $('#editModal #complaint').html(response.complaint);
                      $('#editModal #datetime_preferred').val(response.datetime_preferred);
                      $('#editModal #status_id').val(response.status_id);
                      $('#editModal #property_number').val(response.property_number);
                      $('#editModal #priority_level_id').val(response.priority_level_id);
                      $('#editModal #repair_type_id').val(response.repair_type_id);
                      $('#editModal #repair_class_id').val(response.repair_class_id);
                      $('#editModal #medium_id').val(response.medium_id);
                      $('#editModal #assigned_to').val(response.assigned_to);
                      $('#editModal #serviced_by').val(response.serviced_by);
                      $('#editModal #approved_by').val(response.approved_by);
                      $('#editModal #datetime_start').val(response.datetime_start);
                      $('#editModal #datetime_end').val(response.datetime_end);
                      $('#editModal #diagnosis').html(response.diagnosis);
                      $('#editModal #remarks').html(response.remarks);
                      $('#editModalLabel').html(response.request_number + ' (<span class="text-' + response.color + '">' + response.status + '</span>)');
                    }
                  });
                  $('#editModal').modal('show');
                  break;
                case 'csf':
                  $.ajax({
                    type: "POST",
                    url: "assets/components/includes/fetch.php",
                    data: {
                      'edit_helpdesk': '',
                      'id': id
                    },
                    dataType: 'json',
                    success: function (response) {
                      console.log(response);
                      $('#csfModalLabel').html(response.request_number + ' (<span class="text-' + response.color + '">' + response.status + '</span>)');
                      $('#helpdesks_id').val(response.id);

                      if (response.csf_id) {
                        $('#crit1').val(response.crit1);
                        $('#crit1-' + response.crit1).addClass('text-warning');
                        $('#crit2').val(response.crit2);
                        $('#crit2-' + response.crit2).addClass('text-warning');
                        $('#crit3').val(response.crit3);
                        $('#crit3-' + response.crit3).addClass('text-warning');
                        $('#crit4').val(response.crit4);
                        $('#crit4-' + response.crit4).addClass('text-warning');
                        $('#overall').val(response.overall);
                        $('#overall-' + response.overall).addClass('text-warning');
                        $('#reasons').html(response.reasons);
                        $('#comments').html(response.comments);
                        $('#edit_csf').prop('disabled', false);
                        $('#add_csf').prop('disabled', true);
                      } else {
                        $('#crit1').val('');
                        $('.rating-button').removeClass('text-warning');
                        $('#reasons').html('');
                        $('#comments').html('');
                        $('#edit_csf').prop('disabled', true);
                        $('#add_csf').prop('disabled', false);
                      }
                    }
                  });
                  $('#csfModal').modal('show');
                  break;
                case 'print':
                  $.ajax({
                    type: 'POST',
                    url: 'print.php',
                    data: { 'id': id },
                    success: function (response) {
                      var iframe = $('<iframe>');
                      $('body').append(iframe);
                      var doc = iframe[0].contentDocument || iframe[0].contentWindow.document;
                      doc.write(response);
                      doc.close();
                      iframe[0].contentWindow.print();
                      iframe.remove();
                    }
                  });
                  break;

                case 'print2':
                  $.ajax({
                    type: 'POST',
                    url: 'print2.php',
                    data: { 'id': id },
                    success: function (response) {
                      var iframe = $('<iframe>');
                      $('body').append(iframe);
                      var doc = iframe[0].contentDocument || iframe[0].contentWindow.document;
                      doc.write(response);
                      doc.close();
                      iframe[0].contentWindow.print();
                      iframe.remove();
                    }
                  });
                  break;
              }
            }
          </script>
        </div>
      </section>
      <?php
      break;
    case 'Employee':
      ?>
      <section class="section">
        <div class="row">

          <div class="col-lg-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">ICT Request Form</h5>
                <form id="requesthelpdesks" class="row g-3 enctype-validation" enctype="multipart/form-data" novalidate>

                  <div class="mb-1">
                    <label for="request_type_id">Request type</label>
                    <select name="request_type_id" class="form-select form-select-sm" id="request_type_id" required>
                      <option value="" selected disabled>--</option>
                      <?php
                      $query = $conn->query("SELECT * FROM request_types");
                      while ($row = $query->fetch_object()) {
                        ?>
                        <option value="<?= $row->id ?>">
                          <?= $row->request_type ?>
                        </option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>

                  <div class="mb-1">
                    <label for="category_id">Category</label>
                    <select name="category_id" class="form-select form-select-sm" id="category_id" required>
                      <option value="" selected disabled>--</option>
                      <?php
                      $query = $conn->query("SELECT * FROM categories");
                      while ($row = $query->fetch_object()) {
                        ?>
                        <option data-reqtype="<?= $row->request_type_id ?>" value="<?= $row->id ?>">
                          <?= $row->category ?>
                        </option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>

                  <div class="mb-1">
                    <label for="sub_category_id">Sub category</label>
                    <select name="sub_category_id" class="form-select form-select-sm" id="sub_category_id" required>
                      <option value="" selected disabled>--</option>
                      <?php
                      $query = $conn->query("SELECT * FROM sub_categories");
                      while ($row = $query->fetch_object()) {
                        ?>
                        <option data-cat="<?= $row->category_id ?>" value="<?= $row->id ?>">
                          <?= $row->sub_category ?>
                        </option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>

                  <script>
                    $(document).ready(function () {

                      function filterOptions(selectElement, filterKey, filterValue) {
                        $(selectElement + ' option').each(function () {
                          if ($(this).data(filterKey) == filterValue || filterValue == "") {
                            $(this).show();
                          } else {
                            $(this).hide();
                          }
                        });
                        $(selectElement).val('');
                      }

                      $('#requesthelpdesks #request_type_id').change(function () {
                        filterOptions('#requesthelpdesks #category_id', 'reqtype', $(this).val());
                        $('#requesthelpdesks #sub_category_id').val('');
                      }).trigger('change');

                      $('#requesthelpdesks #category_id').change(function () {
                        filterOptions('#requesthelpdesks #sub_category_id', 'cat', $(this).val());
                      }).trigger('change');

                    });
                  </script>

                  <div class="mb-1">
                    <label for="complaint">Defect, complaint, or request.</label>
                    <div class="text-end">
                      <textarea name="complaint" class="form-control form-control-sm" id="complaint" maxlength="150"
                        required></textarea>
                      <div id="the-count">
                        <span id="current">0</span>
                        <span id="maximum">/ 150</span>
                      </div>

                      <script>
                        $(document).ready(function () {
                          $('#requesthelpdesks #complaint').on('keyup', function () {
                            var currentLength = $(this).val().length;
                            $('#requesthelpdesks #current').text(currentLength);
                          });
                        });
                      </script>
                    </div>
                  </div>

                  <div class="mb-1">
                    <label for="datetime_preferred">Preffered date of schedule</label>
                    <input name="datetime_preferred" type="datetime-local" class="form-control form-control-sm"
                      id="datetime_preferred" value="<?= date('Y-m-d H:i') ?>" required />
                  </div>

                  <div class="mb-1 d-none">
                    <label for="files">Additional files(Optional)</label>
                    <input name="files[]" type="file" class="form-control form-control-sm" id="files"
                      accept=".pdf,.doc,.docx,.txt,image/*" multiple />
                  </div>
                  <div hidden>
                    <input name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>" />
                    <input class="captcha-token" name="captcha-token" />
                    <input name="date_requested" value="<?= date('Y-m-d') ?>" />
                    <input name="status_id" value="1" />
                    <input name="request_helpdesk" />
                  </div>
                  <div class="text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>


          <div class="col-lg-8">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">ICT Request List</h5>
                <table id="admintblhelpdesks" class="display" style="width:100%;display:none;">
                  <thead>
                    <tr>
                      <th>Request No</th>
                      <th>Status</th>
                      <th>Request Type</th>
                      <th>Category</th>
                      <th>Sub Category</th>
                      <th>Action</th>
                      <th>Status ID</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>

          <!-- view Modal -->
          <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="viewModalLabel">view</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="row g-3 enctype-validation" enctype="multipart/form-data" novalidate>

                    <div class="mb-1">
                      <label for="request_type_id">Request type</label>
                      <select name="request_type_id" class="form-select form-select-sm" id="request_type_id" required>
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM request_types");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->request_type ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>

                    <div class="mb-1">
                      <label for="category_id">Category</label>
                      <select name="category_id" class="form-select form-select-sm" id="category_id" required>
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM categories");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option data-reqtype="<?= $row->request_type_id ?>" value="<?= $row->id ?>">
                            <?= $row->category ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>

                    <div class="mb-1">
                      <label for="sub_category_id">Sub category</label>
                      <select name="sub_category_id" class="form-select form-select-sm" id="sub_category_id" required>
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM sub_categories");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option data-cat="<?= $row->category_id ?>" value="<?= $row->id ?>">
                            <?= $row->sub_category ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>

                    <script>
                      $(document).ready(function () {

                        function filterOptions(selectElement, filterKey, filterValue) {
                          $(selectElement + ' option').each(function () {
                            if ($(this).data(filterKey) == filterValue || filterValue == "") {
                              $(this).show();
                            } else {
                              $(this).hide();
                            }
                          });
                          $(selectElement).val('');
                        }

                        $('#requesthelpdesks #request_type_id').change(function () {
                          filterOptions('#requesthelpdesks #category_id', 'reqtype', $(this).val());
                          $('#requesthelpdesks #sub_category_id').val('');
                        }).trigger('change');

                        $('#requesthelpdesks #category_id').change(function () {
                          filterOptions('#requesthelpdesks #sub_category_id', 'cat', $(this).val());
                        }).trigger('change');

                      });
                    </script>

                    <div class="mb-1">
                      <label for="complaint">Defect, complaint, or request.</label>
                      <div class="text-end">
                        <textarea name="complaint" class="form-control form-control-sm" id="complaint" maxlength="150"
                          required></textarea>
                        <div id="the-count">
                          <span id="current">0</span>
                          <span id="maximum">/ 150</span>
                        </div>

                        <script>
                          $(document).ready(function () {
                            $('#requesthelpdesks #complaint').on('keyup', function () {
                              var currentLength = $(this).val().length;
                              $('#requesthelpdesks #current').text(currentLength);
                            });
                          });
                        </script>
                      </div>
                    </div>

                    <div class="mb-1">
                      <label for="datetime_preferred">Preffered date of schedule</label>
                      <input name="datetime_preferred" type="datetime-local" class="form-control form-control-sm"
                        id="datetime_preferred" value="<?= date('Y-m-d H:i') ?>" required />
                    </div>

                    <div class="mb-1 d-none">
                      <label for="files">Additional files(Optional)</label>
                      <input name="files[]" type="file" class="form-control form-control-sm" id="files"
                        accept=".pdf,.doc,.docx,.txt,image/*" multiple />
                    </div>

                    <div class="text-end">
                      <input name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>" />
                      <input class="captcha-token" name="captcha-token" />
                      <input name="date_requested" value="<?= date('Y-m-d') ?>" />
                      <input name="status_id" value="2" />
                      <input name="request_helpdesk" />
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

          <!-- edit Modal -->
          <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="editModalLabel">edit</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="row g-3 enctype-validation" enctype="multipart/form-data" novalidate>

                    <div class="mb-1">
                      <label for="request_type_id">Request type</label>
                      <select name="request_type_id" class="form-select form-select-sm" id="request_type_id" required>
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM request_types");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option value="<?= $row->id ?>">
                            <?= $row->request_type ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>

                    <div class="mb-1">
                      <label for="category_id">Category</label>
                      <select name="category_id" class="form-select form-select-sm" id="category_id" required>
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM categories");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option data-reqtype="<?= $row->request_type_id ?>" value="<?= $row->id ?>">
                            <?= $row->category ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>

                    <div class="mb-1">
                      <label for="sub_category_id">Sub category</label>
                      <select name="sub_category_id" class="form-select form-select-sm" id="sub_category_id" required>
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM sub_categories");
                        while ($row = $query->fetch_object()) {
                          ?>
                          <option data-cat="<?= $row->category_id ?>" value="<?= $row->id ?>">
                            <?= $row->sub_category ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>

                    <script>
                      $(document).ready(function () {

                        function filterOptions(selectElement, filterKey, filterValue) {
                          $(selectElement + ' option').each(function () {
                            if ($(this).data(filterKey) == filterValue || filterValue == "") {
                              $(this).show();
                            } else {
                              $(this).hide();
                            }
                          });
                          $(selectElement).val('');
                        }

                        $('#requesthelpdesks #request_type_id').change(function () {
                          filterOptions('#requesthelpdesks #category_id', 'reqtype', $(this).val());
                          $('#requesthelpdesks #sub_category_id').val('');
                        }).trigger('change');

                        $('#requesthelpdesks #category_id').change(function () {
                          filterOptions('#requesthelpdesks #sub_category_id', 'cat', $(this).val());
                        }).trigger('change');

                      });
                    </script>

                    <div class="mb-1">
                      <label for="complaint">Defect, complaint, or request.</label>
                      <div class="text-end">
                        <textarea name="complaint" class="form-control form-control-sm" id="complaint" maxlength="150"
                          required></textarea>
                        <div id="the-count">
                          <span id="current">0</span>
                          <span id="maximum">/ 150</span>
                        </div>

                        <script>
                          $(document).ready(function () {
                            $('#requesthelpdesks #complaint').on('keyup', function () {
                              var currentLength = $(this).val().length;
                              $('#requesthelpdesks #current').text(currentLength);
                            });
                          });
                        </script>
                      </div>
                    </div>

                    <div class="mb-1">
                      <label for="datetime_preferred">Preffered date of schedule</label>
                      <input name="datetime_preferred" type="datetime-local" class="form-control form-control-sm"
                        id="datetime_preferred" value="<?= date('Y-m-d H:i') ?>" required />
                    </div>

                    <div class="mb-1 d-none">
                      <label for="files">Additional files(Optional)</label>
                      <input name="files[]" type="file" class="form-control form-control-sm" id="files"
                        accept=".pdf,.doc,.docx,.txt,image/*" multiple />
                    </div>

                    <div class="text-end">
                      <input name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>" />
                      <input class="captcha-token" name="captcha-token" />
                      <input name="date_requested" value="<?= date('Y-m-d') ?>" />
                      <input name="status_id" value="2" />
                      <input name="request_helpdesk" />
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
                </div>
              </div>
            </div>
          </div>

          <!-- csf Modal -->
          <div class="modal fade" id="csfModal" tabindex="-1" aria-labelledby="csfModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="csfModalLabel">csf</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="csfModalBody">
                  <form class="needs-validation">
                    <p class="small"><strong class="small">PART I. Our office is committed to continually improve our
                        services to our external clients. Please answer this Form for us to know your feedback on the
                        different aspects of our services. Your feedback and impressions will help us in improving our
                        services in order to better serve our clients. Rest assured all information you will provide shall
                        be treated with strict confidentiality. </strong></p>
                    <hr>
                    <div class="row mb-2 crit1">
                      <div class="col-lg-6 col-md-12 col-sm-12 small">
                        <p><strong>RESPONSIVENESS, ASSURANCE, AND INTEGRITY</strong></p>
                        <p>Delivery of services are on time, friendly, courteous, fair and in a professional manner.</p>
                      </div>
                      <div class="col-lg-6 col-md-12 col-sm-12 row">
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="4" id="crit1-4"
                            onclick="updateRating('crit1', 4, this)" title="Excellent">
                            <i class="fs-3 bi bi-emoji-laughing"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="3" id="crit1-3"
                            onclick="updateRating('crit1', 3, this)" title="Good">
                            <i class="fs-3 bi bi-emoji-smile"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="2" id="crit1-2"
                            onclick="updateRating('crit1', 2, this)" title="Average">
                            <i class="fs-3 bi bi-emoji-frown"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="1" id="crit1-1"
                            onclick="updateRating('crit1', 1, this)" title="Poor">
                            <i class="fs-3 bi bi-emoji-angry"></i>
                          </button>
                        </div>
                      </div>
                      <input type="hidden" name="crit1" id="crit1" />
                    </div>
                    <div class="row mb-2 crit2">
                      <div class="col-lg-6 col-md-12 col-sm-12 small">
                        <p><strong>RELIABILITY AND OUTCOME</strong></p>
                        <p>Actual services are acted upon immediately. Delivery of service are complete, accurate and
                          corresponds to requirement.</p>
                      </div>
                      <div class="col-lg-6 col-md-12 col-sm-12 row">
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="4" id="crit2-4"
                            onclick="updateRating('crit2', 4, this)" title="Excellent">
                            <i class="fs-3 bi bi-emoji-laughing"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="3" id="crit2-3"
                            onclick="updateRating('crit2', 3, this)" title="Good">
                            <i class="fs-3 bi bi-emoji-smile"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="2" id="crit2-2"
                            onclick="updateRating('crit2', 2, this)" title="Average">
                            <i class="fs-3 bi bi-emoji-frown"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="1" id="crit2-1"
                            onclick="updateRating('crit2', 1, this)" title="Poor">
                            <i class="fs-3 bi bi-emoji-angry"></i>
                          </button>
                        </div>
                      </div>
                      <input type="hidden" name="crit2" id="crit2" />
                    </div>
                    <div class="row mb-2 crit3">
                      <div class="col-lg-6 col-md-12 col-sm-12 small">
                        <p><strong>ACCESS AND FACILITIES</strong></p>
                        <p>Computer and Technology facilities and services are sustainable and available when needed.</p>
                      </div>
                      <div class="col-lg-6 col-md-12 col-sm-12 row">
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="4" id="crit3-4"
                            onclick="updateRating('crit3', 4, this)" title="Excellent">
                            <i class="fs-3 bi bi-emoji-laughing"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="3" id="crit3-3"
                            onclick="updateRating('crit3', 3, this)" title="Good">
                            <i class="fs-3 bi bi-emoji-smile"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="2" id="crit3-2"
                            onclick="updateRating('crit3', 2, this)" title="Average">
                            <i class="fs-3 bi bi-emoji-frown"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="1" id="crit3-1"
                            onclick="updateRating('crit3', 1, this)" title="Poor">
                            <i class="fs-3 bi bi-emoji-angry"></i>
                          </button>
                        </div>
                      </div>
                      <input type="hidden" name="crit3" id="crit3" />
                    </div>
                    <div class="row mb-2 crit4">
                      <div class="col-lg-6 col-md-12 col-sm-12 small">
                        <p><strong>COMMUNICATION</strong></p>
                        <p>The requirements and process for the service requests system is properly communicated.</p>
                      </div>
                      <div class="col-lg-6 col-md-12 col-sm-12 row">
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="4" id="crit4-4"
                            onclick="updateRating('crit4', 4, this)" title="Excellent">
                            <i class="fs-3 bi bi-emoji-laughing"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="3" id="crit4-3"
                            onclick="updateRating('crit4', 3, this)" title="Good">
                            <i class="fs-3 bi bi-emoji-smile"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="2" id="crit4-2"
                            onclick="updateRating('crit4', 2, this)" title="Average">
                            <i class="fs-3 bi bi-emoji-frown"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="1" id="crit4-1"
                            onclick="updateRating('crit4', 1, this)" title="Poor">
                            <i class="fs-3 bi bi-emoji-angry"></i>
                          </button>
                        </div>
                      </div>
                      <input type="hidden" name="crit4" id="crit4" />
                    </div>
                    <hr>
                    <div class="row mb-2 overall">
                      <div class="col-lg-6 col-md-12 col-sm-12 small">
                        <p><strong>OVERALL SATISFACTION RATING</strong></p>
                        <p>Overall, how satisfied are you with the technology facilities and services available?</p>
                      </div>
                      <div class="col-lg-6 col-md-12 col-sm-12 row">
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="4" id="overall-4"
                            onclick="updateRating('overall', 4, this)" title="Excellent">
                            <i class="fs-3 bi bi-emoji-laughing"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="3" id="overall-3"
                            onclick="updateRating('overall', 3, this)" title="Good">
                            <i class="fs-3 bi bi-emoji-smile"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="2" id="overall-2"
                            onclick="updateRating('overall', 2, this)" title="Average">
                            <i class="fs-3 bi bi-emoji-frown"></i>
                          </button>
                        </div>
                        <div class="col-3 small text-center">
                          <button type="button" class="btn rating-button" data-value="1" id="overall-1"
                            onclick="updateRating('overall', 1, this)" title="Poor">
                            <i class="fs-3 bi bi-emoji-angry"></i>
                          </button>
                        </div>
                      </div>
                      <input type="hidden" name="overall" id="overall" />
                    </div>

                    <script>
                      function updateRating(elementId, value, button) {
                        $('#' + elementId).val(value);
                        // Remove the 'selected' class from all buttons
                        $('.' + elementId + ' .rating-button').removeClass('text-warning');
                        // Add the 'selected' class to the clicked button
                        $(button).addClass('text-warning');
                      }
                    </script>
                    <hr>
                    <hr>
                    <p class="small"><strong>PART II. COMMENTS AND SUGGESTIONS</strong></p>
                    <hr>
                    <div class="mb-2">
                      <label for="reasons" class="small">Please write in the space below your reason/s for your
                        "DISSATISFIED" or "VERY DISSATISFIED" rating so that we will know in which area/s we need to
                        improve.</label>
                      <textarea name="reasons" class="form-control form-control-sm" id="reasons" maxlength="150"
                        required></textarea>
                    </div>
                    <div class="mb-2">
                      <label for="comments" class="small">Please give comments/suggestions to help us improve our
                        service/s:</label>
                      <textarea name="comments" class="form-control form-control-sm" id="comments" maxlength="150"
                        required></textarea>
                    </div>
                    <hr>
                    <hr>
                    <p class="m-0 p-0 text-center"><strong>THANK YOU!!!</strong></p>

                    <div hidden>
                      <input name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>" />
                      <input class="captcha-token" name="captcha-token" />
                      <input name="helpdesks_id" id="helpdesks_id" />
                      <input name="id" id="id" />
                      <input name="add_csf" id="add_csf" disabled />
                      <input name="edit_csf" id="edit_csf" disabled />
                      <button type="submit" id="csfbtn"></button>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" id="savebtn" onclick="csfbtn.click();">Save Changes</button>
                </div>
              </div>
            </div>
          </div>

          <script>
            jQuery(document).ready(function () {
              var admintblhelpdesks = $('#admintblhelpdesks').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "ajax": "assets/components/includes/datatables.php?helpdesks4",
                "columnDefs": [{
                  "className": "dt-nowrap",
                  "targets": [0, 1, 2, 3, 4, 5]
                }, {
                  "target": 6,
                  "visible": false,
                  "searchable": false
                }],
                "order": [
                  [6, 'asc'],
                  [1, 'asc']
                ],
                "initComplete": function (settings, json) {
                  $('#admintblhelpdesks').show();
                }
              });
              setInterval(function () {
                admintblhelpdesks.ajax.reload()
              }, 60000);
            });

            function useraction(action, id) {
              switch (action) {
                case 'cancel':
                  Swal.fire({
                    title: "Are you sure?",
                    text: "This request will be cancelled!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, cancel",
                  }).then((result) => {
                    if (result.isConfirmed) {
                      Swal.fire({
                        title: "Loading",
                        html: "Please wait...",
                        allowOutsideClick: false,
                        didOpen: function () {
                          Swal.showLoading();
                        },
                      });
                      $.ajax({
                        type: "POST",
                        url: "assets/components/includes/process.php",
                        data: {
                          'cancel_helpdesk': '',
                          'id': id
                        },
                        dataType: "json",
                        success: function (response) {
                          setTimeout(function () {
                            Swal.fire({
                              icon: response.status,
                              title: response.message,
                              showConfirmButton: false,
                              timer: 1000,
                            }).then(function () {
                              if (response.redirect) {
                                window.location.href = response.redirect;
                              } else {
                                location.reload();
                              }
                            });
                          }, 1000);
                        },
                      });
                    }
                  });
                  break;
                case 'view':
                  $('#viewModal').modal('show');
                  break;
                case 'edit':
                  $('#editModal').modal('show');
                  break;
                case 'csf':
                  $.ajax({
                    type: "POST",
                    url: "assets/components/includes/fetch.php",
                    data: {
                      'edit_helpdesk': '',
                      'id': id
                    },
                    dataType: 'json',
                    success: function (response) {
                      console.log(response);
                      $('#csfModalLabel').html(response.request_number + ' (<span class="text-' + response.color + '">' + response.status + '</span>)');
                      $('#helpdesks_id').val(response.id);

                      if (response.csf_id) {
                        $('#crit1').val(response.crit1);
                        $('#crit1-' + response.crit1).addClass('text-warning');
                        $('#crit2').val(response.crit2);
                        $('#crit2-' + response.crit2).addClass('text-warning');
                        $('#crit3').val(response.crit3);
                        $('#crit3-' + response.crit3).addClass('text-warning');
                        $('#crit4').val(response.crit4);
                        $('#crit4-' + response.crit4).addClass('text-warning');
                        $('#overall').val(response.overall);
                        $('#overall-' + response.overall).addClass('text-warning');
                        $('#reasons').html(response.reasons);
                        $('#comments').html(response.comments);
                        $('#edit_csf').prop('disabled', false);
                        $('#csfModalBody button').prop('disabled', true);
                        $('#csfModalBody textarea').prop('disabled', true);
                        $('#savebtn').attr('hidden', true);
                      } else {
                        $('#add_csf').prop('disabled', false);
                      }
                    }
                  });
                  $('#csfModal').modal('show');
                  break;
              }


            }
          </script>
        </div>
      </section>
      <?php
      break;
    default:
      ?>
      <section class="section">
        <div class="row">
          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Restricted Page</h5>
                <p>This page is restricted due to insufficient access.</p>
              </div>
            </div>

          </div>
        </div>
      </section>
    <?php
  }
  ?>
</main><!-- End #main -->
<?php require_once "assets/components/templates/footer.php"; ?>