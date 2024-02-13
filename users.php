<?php $page = "User Management" ?>
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
          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Users List <button class="float-end btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add New User</button></h5>
                <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-employees-tab" data-bs-toggle="tab" data-bs-target="#nav-employees" type="button" role="tab" aria-controls="nav-employees" aria-selected="true">employees</button>
                    <button class="nav-link" id="nav-staffs-tab" data-bs-toggle="tab" data-bs-target="#nav-staffs" type="button" role="tab" aria-controls="nav-staffs" aria-selected="false">staffs</button>
                    <button class="nav-link" id="nav-officers-tab" data-bs-toggle="tab" data-bs-target="#nav-officers" type="button" role="tab" aria-controls="nav-officers" aria-selected="false">officers</button>
                  </div>
                </nav>
                <div class="tab-content pt-5" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-employees" role="tabpanel" aria-labelledby="nav-employees-tab" tabindex="0">
                    <table id="users4" class="display" style="width:100%;display:none;">
                      <thead>
                        <tr>
                          <th>ID No.</th>
                          <th>Employee</th>
                          <th>Division</th>
                          <th>Email</th>
                          <th>Role</th>
                          <th>Active</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="nav-staffs" role="tabpanel" aria-labelledby="nav-staffs-tab" tabindex="0">
                    <table id="users3" class="display" style="width:100%;display:none;">
                      <thead>
                        <tr>
                          <th>ID No.</th>
                          <th>Employee</th>
                          <th>Division</th>
                          <th>Email</th>
                          <th>Role</th>
                          <th>Active</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="nav-officers" role="tabpanel" aria-labelledby="nav-officers-tab" tabindex="0">
                    <table id="users2" class="display" style="width:100%;display:none;">
                      <thead>
                        <tr>
                          <th>ID No.</th>
                          <th>Employee</th>
                          <th>Division</th>
                          <th>Email</th>
                          <th>Role</th>
                          <th>Active</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="user-edit" id="user-edit">

                      <!-- user Edit Form -->
                      <form class="row g-3 needs-validation" novalidate>
                        <div class="mb-2 col-lg-6">
                          <label for="id_number" class="form-label">id_number</label>
                          <input type="text" class="form-control form-control-sm" id="id_number" name="id_number" autocomplete="off" />
                        </div>
                        <div class="mb-2 col-lg-6">
                          <label for="first_name" class="form-label">first_name</label>
                          <input type="text" class="form-control form-control-sm" id="first_name" name="first_name" autocomplete="off" />
                        </div>
                        <div class="mb-2 col-lg-6">
                          <label for="middle_name" class="form-label">middle_name</label>
                          <input type="text" class="form-control form-control-sm" id="middle_name" name="middle_name" autocomplete="off" />
                        </div>
                        <div class="mb-2 col-lg-6">
                          <label for="last_name" class="form-label">last_name</label>
                          <input type="text" class="form-control form-control-sm" id="last_name" name="last_name" autocomplete="off" />
                        </div>
                        <div class="mb-2 col-lg-6">
                          <label for="position" class="form-label">position</label>
                          <input type="text" class="form-control form-control-sm" id="position" name="position" autocomplete="off" />
                        </div>
                        <div class="mb-2 col-lg-6">
                          <label for="division_id" class="form-label">division_id</label>
                          <select class="form-select form-select-sm" id="division_id" name="division_id">
                            <option selected disabled>--</option>
                            <?php
                            $query = $conn->execute_query("SELECT * FROM divisions");
                            while ($row = $query->fetch_object()) {
                            ?>
                              <option value="<?= $row->id ?>"><?= $row->division ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                        <div class="mb-2 col-lg-6">
                          <label for="client_type_id" class="form-label">client_type_id</label>
                          <select class="form-select form-select-sm" id="client_type_id" name="client_type_id">
                            <option selected disabled>--</option>
                            <?php
                            $query = $conn->execute_query("SELECT * FROM client_types");
                            while ($row = $query->fetch_object()) {
                            ?>
                              <option value="<?= $row->id ?>"><?= $row->client_type ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                        <div class="mb-2 col-lg-6">
                          <label for="date_birth" class="form-label">date_birth</label>
                          <input type="date" class="form-control form-control-sm" id="date_birth" name="date_birth" autocomplete="off" />
                        </div>
                        <div class="mb-2 col-lg-6">
                          <label for="phone" class="form-label">phone</label>
                          <input type="text" class="form-control form-control-sm" id="phone" name="phone" autocomplete="off" />
                        </div>
                        <div class="mb-2 col-lg-6">
                          <label for="email" class="form-label">email</label>
                          <input type="text" class="form-control form-control-sm" id="email" name="email" autocomplete="off" />
                        </div>
                        <div class="mb-2 col-lg-6">
                          <label class="form-label">sex</label>
                          <select class="form-select form-select-sm" id="sex" name="sex">
                            <option selected disabled>--</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                        </div>
                        <div class="mb-2 col-lg-6">
                          <label for="address" class="form-label">address</label>
                          <textarea type="text" class="form-control form-control-sm" id="address" name="address" autocomplete="off"></textarea>
                        </div>
                        <div class="mb-2 col-lg-12">
                          <label for="role_id" class="form-label">role_id</label>
                          <select class="form-select form-select-sm" id="role_id" name="role_id">
                            <option selected disabled>--</option>
                            <?php
                            $query = $conn->execute_query("SELECT * FROM roles ORDER BY id DESC LIMIT 4");
                            while ($row = $query->fetch_object()) {
                            ?>
                              <option value="<?= $row->id ?>"><?= $row->role ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                        <div class="mb-2 col-lg-6">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="pwd" name="pwd">
                            <label class="form-check-label" for="pwd">
                              PWD
                            </label>
                          </div>
                        </div>
                        <div class="mb-2 col-lg-6">
                          <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="active" name="active">
                            <label class="form-check-label" for="active">Active</label>
                          </div>
                        </div>
                        <input type="hidden" name="id" id="id" />
                        <input type="hidden" name="edit_user" />
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

            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel">Add User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="user-add" id="user-add">

                      <!-- user Add Form -->
                      <form class="row g-3 needs-validation" novalidate>
                        <div class="mb-2 col-lg-6">
                          <label for="id_number" class="form-label">id_number</label>
                          <input type="text" class="form-control form-control-sm" id="id_number" name="id_number" autocomplete="off" />
                        </div>
                        <div class="mb-2 col-lg-6">
                          <label for="first_name" class="form-label">first_name</label>
                          <input type="text" class="form-control form-control-sm" id="first_name" name="first_name" autocomplete="off" />
                        </div>
                        <div class="mb-2 col-lg-6">
                          <label for="middle_name" class="form-label">middle_name</label>
                          <input type="text" class="form-control form-control-sm" id="middle_name" name="middle_name" autocomplete="off" />
                        </div>
                        <div class="mb-2 col-lg-6">
                          <label for="last_name" class="form-label">last_name</label>
                          <input type="text" class="form-control form-control-sm" id="last_name" name="last_name" autocomplete="off" />
                        </div>
                        <div class="mb-2 col-lg-6">
                          <label for="position" class="form-label">position</label>
                          <input type="text" class="form-control form-control-sm" id="position" name="position" autocomplete="off" />
                        </div>
                        <div class="mb-2 col-lg-6">
                          <label for="division_id" class="form-label">division_id</label>
                          <select class="form-select form-select-sm" id="division_id" name="division_id">
                            <option selected disabled>--</option>
                            <?php
                            $query = $conn->execute_query("SELECT * FROM divisions");
                            while ($row = $query->fetch_object()) {
                            ?>
                              <option value="<?= $row->id ?>"><?= $row->division ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                        <div class="mb-2 col-lg-6">
                          <label for="client_type_id" class="form-label">client_type_id</label>
                          <select class="form-select form-select-sm" id="client_type_id" name="client_type_id">
                            <option selected disabled>--</option>
                            <?php
                            $query = $conn->execute_query("SELECT * FROM client_types");
                            while ($row = $query->fetch_object()) {
                            ?>
                              <option value="<?= $row->id ?>"><?= $row->client_type ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                        <div class="mb-2 col-lg-6">
                          <label for="date_birth" class="form-label">date_birth</label>
                          <input type="date" class="form-control form-control-sm" id="date_birth" name="date_birth" autocomplete="off" />
                        </div>
                        <div class="mb-2 col-lg-6">
                          <label for="phone" class="form-label">phone</label>
                          <input type="text" class="form-control form-control-sm" id="phone" name="phone" autocomplete="off" />
                        </div>
                        <div class="mb-2 col-lg-6">
                          <label for="email" class="form-label">email</label>
                          <input type="text" class="form-control form-control-sm" id="email" name="email" autocomplete="off" />
                        </div>
                        <div class="mb-2 col-lg-6">
                          <label class="form-label">sex</label>
                          <select class="form-select form-select-sm" id="sex" name="sex">
                            <option selected disabled>--</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                        </div>
                        <div class="mb-2 col-lg-6">
                          <label for="address" class="form-label">address</label>
                          <textarea type="text" class="form-control form-control-sm" id="address" name="address" autocomplete="off"></textarea>
                        </div>
                        <div class="mb-2 col-lg-12">
                          <label for="role_id" class="form-label">role_id</label>
                          <select class="form-select form-select-sm" id="role_id" name="role_id">
                            <option selected disabled>--</option>
                            <?php
                            $query = $conn->execute_query("SELECT * FROM roles ORDER BY id DESC LIMIT 4");
                            while ($row = $query->fetch_object()) {
                            ?>
                              <option value="<?= $row->id ?>"><?= $row->role ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                        <div class="mb-2 col-lg-6">
                          <label class="form-label">PWD</label>
                          <select class="form-select form-select-sm" id="pwd" name="pwd">
                            <option selected disabled>--</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                          </select>
                        </div>
                        <div class="mb-2 col-lg-6">
                          <label class="form-label">Active</label>
                          <select class="form-select form-select-sm" id="active" name="active">
                            <option selected disabled>--</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                          </select>
                        </div>
                        <input type="hidden" name="add_user" />
                        <button id="addform" hidden></button>
                      </form><!-- End user Add Form -->

                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addform.click()">Add User</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <script>
        jQuery(document).ready(function() {
          var users4 = $('#users4').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "ajax": "assets/components/includes/datatables.php?users4",
            "initComplete": function(settings, json) {
              $('#users4').show();

            }
          });
          var users3 = $('#users3').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "ajax": "assets/components/includes/datatables.php?users3",
            "initComplete": function(settings, json) {
              $('#users3').show();

            }
          });
          var users2 = $('#users2').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "ajax": "assets/components/includes/datatables.php?users2",
            "initComplete": function(settings, json) {
              $('#users2').show();

            }
          });
        });

        function useraction(action, id) {
          switch (action) {
            case 'edit':
              $.ajax({
                type: "POST",
                url: "assets/components/includes/fetch.php",
                data: {
                  'edit': '',
                  'id': id
                },
                dataType: 'json',
                success: function(response) {
                  console.log(response);
                  $('#user-edit #id').val(id);
                  $('#user-edit #id_number').val(response.id_number);
                  $('#user-edit #first_name').val(response.first_name);
                  $('#user-edit #middle_name').val(response.middle_name);
                  $('#user-edit #last_name').val(response.last_name);
                  $('#user-edit #position').val(response.position);
                  $('#user-edit #division_id').val(response.division_id);
                  $('#user-edit #client_type_id').val(response.client_type_id);
                  $('#user-edit #date_birth').val(response.date_birth);
                  $('#user-edit #phone').val(response.phone);
                  $('#user-edit #email').val(response.email);
                  $('#user-edit #sex').val(response.sex);
                  $('#user-edit #address').val(response.address);
                  $('#user-edit #role_id').val(response.role_id);
                  response.pwd ? $('#user-edit #pwd').attr('checked', 'true') : $('#user-edit #pwd').removeAttr('checked');
                  response.active ? $('#user-edit #active').attr('checked', 'true') : $('#user-edit #active').removeAttr('checked');
                  $('#editModal').modal('show');
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
                      'delete_user': '',
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