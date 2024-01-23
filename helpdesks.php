<?php $page = "ICT Helpdesks" ?>
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
                    <label for="date_requested">Date</label>
                    <input name="date_requested" type="date" class="form-control form-control-sm" id="date_requested" value="<?= date('Y-m-d') ?>" required />
                  </div>

                  <div class="mb-1">
                    <label for="request_type_id">RequestType</label>
                    <select name="request_type_id" class="form-select form-select-sm" id="request_type_id" required>
                      <option value="" selected disabled>--</option>
                      <?php
                      $query = $conn->query("SELECT * FROM request_types");
                      while ($row = $query->fetch_object()) {
                      ?>
                        <option value="<?= $row->id ?>"><?= $row->request_type ?></option>
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
                        <option data-reqtype="<?= $row->request_type_id ?>" value="<?= $row->id ?>"><?= $row->category ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>

                  <div class="mb-1">
                    <label for="sub_category_id">Sub Category</label>
                    <select name="sub_category_id" class="form-select form-select-sm" id="sub_category_id" required>
                      <option value="" selected disabled>--</option>
                      <?php
                      $query = $conn->query("SELECT * FROM sub_categories");
                      while ($row = $query->fetch_object()) {
                      ?>
                        <option data-cat="<?= $row->category_id ?>" value="<?= $row->id ?>"><?= $row->sub_category ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>

                  <script>
                    $(document).ready(function() {

                      function filterOptions(selectElement, filterKey, filterValue) {
                        $(selectElement + ' option').each(function() {
                          if ($(this).data(filterKey) == filterValue || filterValue == "") {
                            $(this).show();
                          } else {
                            $(this).hide();
                          }
                        });
                        $(selectElement).val('');
                      }

                      $('#requesthelpdesks #request_type_id').change(function() {
                        filterOptions('#requesthelpdesks #category_id', 'reqtype', $(this).val());
                        $('#requesthelpdesks #sub_category_id').val('');
                      }).trigger('change');

                      $('#requesthelpdesks #category_id').change(function() {
                        filterOptions('#requesthelpdesks #sub_category_id', 'cat', $(this).val());
                      }).trigger('change');

                    });
                  </script>

                  <div class="mb-1">
                    <label for="complaint">Defect/complaint</label>
                    <div class="text-end">
                      <textarea name="complaint" class="form-control form-control-sm" id="complaint" maxlength="150" required></textarea>
                      <div id="the-count">
                        <span id="current">0</span>
                        <span id="maximum">/ 150</span>
                      </div>

                      <script>
                        $(document).ready(function() {
                          $('#requesthelpdesks #complaint').on('keyup', function() {
                            var currentLength = $(this).val().length;
                            $('#requesthelpdesks #current').text(currentLength);
                          });
                        });
                      </script>
                    </div>
                  </div>

                  <div class="mb-1">
                    <label for="datetime_preferred">Preffered Schedule</label>
                    <input name="datetime_preferred" type="datetime-local" class="form-control form-control-sm" id="datetime_preferred" value="<?= date('Y-m-d H:i') ?>" required />
                  </div>

                  <div class="mb-1 d-none">
                    <label for="files">Additional files(Optional)</label>
                    <input name="files[]" type="file" class="form-control form-control-sm" id="files" accept=".pdf,.doc,.docx,.txt,image/*" multiple />
                  </div>

                  <div class="text-end">
                    <input type="hidden" name="request_helpdesk" />
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
                      <th>Date</th>
                      <th>Request No</th>
                      <th>Repair Type</th>
                      <th>Category</th>
                      <th>Sub Category</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                </table>
                <!-- Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel">Edit User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="user-edit">

                          <!-- user Edit Form -->
                          <form id="edithelpdesks" class="row g-3 needs-validation" novalidate>
                            <div class="mb-1">
                              <label for="date_requested">Date</label>
                              <input name="date_requested" type="date" class="form-control form-control-sm" id="date_requested" value="<?= date('Y-m-d') ?>" required />
                            </div>

                            <div class="mb-1">
                              <label for="request_type_id">RequestType</label>
                              <select name="request_type_id" class="form-select form-select-sm" id="request_type_id" required>
                                <option value="" selected disabled>--</option>
                                <?php
                                $query = $conn->query("SELECT * FROM request_types");
                                while ($row = $query->fetch_object()) {
                                ?>
                                  <option value="<?= $row->id ?>"><?= $row->request_type ?></option>
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
                                  <option data-reqtype="<?= $row->request_type_id ?>" value="<?= $row->id ?>"><?= $row->category ?></option>
                                <?php
                                }
                                ?>
                              </select>
                            </div>

                            <div class="mb-1">
                              <label for="sub_category_id">Sub Category</label>
                              <select name="sub_category_id" class="form-select form-select-sm" id="sub_category_id" required>
                                <option value="" selected disabled>--</option>
                                <?php
                                $query = $conn->query("SELECT * FROM sub_categories");
                                while ($row = $query->fetch_object()) {
                                ?>
                                  <option data-cat="<?= $row->category_id ?>" value="<?= $row->id ?>"><?= $row->sub_category ?></option>
                                <?php
                                }
                                ?>
                              </select>
                            </div>

                            <script>
                              $(document).ready(function() {

                                function filterOptions(selectElement, filterKey, filterValue) {
                                  $(selectElement + ' option').each(function() {
                                    if ($(this).data(filterKey) == filterValue || filterValue == "") {
                                      $(this).show();
                                    } else {
                                      $(this).hide();
                                    }
                                  });
                                  $(selectElement).val('');
                                }

                                $('#edithelpdesks #request_type_id').change(function() {
                                  filterOptions('#edithelpdesks #category_id', 'reqtype', $(this).val());
                                  $('#edithelpdesks #sub_category_id').val('');
                                }).trigger('change');
                                $('#edithelpdesks #request_type_id').trigger('change');

                                $('#edithelpdesks #category_id').change(function() {
                                  filterOptions('#edithelpdesks #sub_category_id', 'cat', $(this).val());
                                }).trigger('change');

                              });
                            </script>

                            <div class="mb-1">
                              <label for="complaint">Defect/complaint</label>
                              <div class="text-end">
                                <textarea name="complaint" class="form-control form-control-sm" id="complaint" maxlength="150" required></textarea>
                                <div id="the-count">
                                  <span id="current">0</span>
                                  <span id="maximum">/ 150</span>
                                </div>

                                <script>
                                  $(document).ready(function() {
                                    $('#edithelpdesks #complaint').on('keyup', function() {
                                      var currentLength = $(this).val().length;
                                      $('#edithelpdesks #current').text(currentLength);
                                    });
                                  });
                                </script>
                              </div>
                            </div>

                            <div class="mb-1">
                              <label for="datetime_preferred">Preffered Schedule</label>
                              <input name="datetime_preferred" type="datetime-local" class="form-control form-control-sm" id="datetime_preferred" value="<?= date('Y-m-d H:i') ?>" required />
                            </div>
                            <input type="hidden" name="id" id="id" />
                            <input type="hidden" name="edit_helpdesk" />
                            <button id="editform" hidden></button>
                          </form><!-- End user Edit Form -->

                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="editform.click()">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>
                <script>
                  jQuery(document).ready(function() {
                    var admintblhelpdesks = $('#admintblhelpdesks').DataTable({
                      "processing": true,
                      "serverSide": true,
                      "responsive": true,
                      "ajax": "assets/components/includes/datatables/tblhelpdesks.php",
                      "initComplete": function(settings, json) {
                        $('#admintblhelpdesks').show();

                      }
                    });
                    // setInterval(function(){
                    //   admintblhelpdesks.ajax.reload()
                    // }, 5000);
                  });

                  function useraction(action, id) {
                    switch (action) {
                      case 'edit':
                        $.ajax({
                          type: "POST",
                          url: "assets/components/includes/fetch.php",
                          data: {
                            'edit_helpdesks': '',
                            'id': id
                          },
                          dataType: 'json',
                          success: function(response) {
                            console.log(response);
                            $('#editModal #id').val(response.id);
                            $('#editModal #date_requested').val(response.date_requested);
                            $('#editModal #request_type_id').val(response.request_type_id);
                            $('#editModal #category_id').val(response.category_id);
                            $('#editModal #sub_category_id').val(response.sub_category_id);
                            $('#editModal #complaint').html(response.complaint);
                            $('#editModal #datetime_preferred').val(response.datetime_preferred);
                          }
                        });
                        break;
                      case 'reset':
                        break;
                      case 'delete':
                        Swal.fire({
                          title: "Are you sure?",
                          text: "This user will be permanently deleted!",
                          icon: "warning",
                          showCancelButton: true,
                          confirmButtonColor: "#3085d6",
                          cancelButtonColor: "#d33",
                          confirmButtonText: "Yes, delete",
                        }).then((result) => {
                          if (result.isConfirmed) {
                            Swal.fire({
                              title: "Loading",
                              html: "Please wait...",
                              allowOutsideClick: false,
                              didOpen: function() {
                                Swal.showLoading();
                              },
                            });
                            $.ajax({
                              type: "POST",
                              url: "assets/components/includes/process.php",
                              data: {
                                'delete_helpdesk': '',
                                'id': id
                              },
                              dataType: "json",
                              success: function(response) {
                                setTimeout(function() {
                                  Swal.fire({
                                    icon: response.status,
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: 1000,
                                  }).then(function() {
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
                    }


                  }
                </script>
              </div>
            </div>
          </div>

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