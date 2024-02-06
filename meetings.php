<?php $page = "Zoom Meetings" ?>
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
                <h5 class="card-title">Zoom Request Form</h5>
                <form id="addmeeting" class="row g-3 enctype-validation" enctype="multipart/form-data" novalidate>

                  <div class="mb-1">
                    <label for="date_requested">Date requested</label>
                    <input name="date_requested" type="date" class="form-control form-control-sm" id="date_requested" value="<?= date('Y-m-d') ?>" required />
                  </div>

                  <div class="mb-1">
                    <label for="topic">Meeting topic or title</label>
                    <div class="text-end">
                      <textarea name="topic" class="form-control form-control-sm" id="topic" maxlength="150" required></textarea>
                      <div id="the-count">
                        <span id="current">0</span>
                        <span id="maximum">/ 150</span>
                      </div>

                      <script>
                        $(document).ready(function() {
                          $('#addmeeting #topic').on('keyup', function() {
                            var currentLength = $(this).val().length;
                            $('#addmeeting #current').text(currentLength);
                          });
                        });
                      </script>
                    </div>
                  </div>

                  <div class="mb-1">
                    <label for="date_scheduled">Date of schedule</label>
                    <input name="date_scheduled" type="date" class="form-control form-control-sm" id="date_scheduled" value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>" required />
                  </div>

                  <div class="mb-1">
                    <label for="time_start">Time of schedule starts</label>
                    <input name="time_start" type="time" class="form-control form-control-sm" id="time_start" value="<?= date('H:i') ?>" required />
                  </div>

                  <div class="mb-1">
                    <label for="time_end">Time of schedule ends</label>
                    <input name="time_end" type="time" class="form-control form-control-sm" id="time_end" value="<?= date('H:i') ?>" required />
                  </div>

                  <a class="text-end btn-link" data-bs-toggle="collapse" href="#collapseExample2" id="ShowFields" onclick="ShowFields.style.display = 'none';HideFields.style.display = ''">
                    Show other fields
                  </a>
                  <a class="text-end btn-link" data-bs-toggle="collapse" href="#collapseExample2" id="HideFields" onclick="HideFields.style.display = 'none';ShowFields.style.display = ''" style="display: none;">
                    Hide other fields
                  </a>
                  <div class="collapse" id="collapseExample2">
                    <div class="mb-1">
                      <label for="status_id">Meeting status</label>
                      <select name="status_id" class="form-select form-select-sm" id="status_id">
                        <?php
                        $query = $conn->query("SELECT * FROM meetings_statuses");
                        while ($row = $query->fetch_object()) {
                        ?>
                          <option value="<?= $row->id ?>"><?= $row->status ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>

                    <div class="mb-1">
                      <label for="host_id">Hosted by</label>
                      <select name="host_id" class="form-select form-select-sm" id="host_id">
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM hosts");
                        while ($row = $query->fetch_object()) {
                        ?>
                          <option value="<?= $row->id ?>"><?= $row->host_name ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>

                    <div class="mb-1">
                      <label for="meetingid">Meeting ID</label>
                      <input name="meetingid" type="text" class="form-control form-control-sm" id="meetingid" />
                    </div>

                    <div class="mb-1">
                      <label for="passcode">Passcode</label>
                      <input name="passcode" type="text" class="form-control form-control-sm" id="passcode" />
                    </div>

                    <div class="mb-1">
                      <label for="join_link">Join link</label>
                      <textarea name="join_link" class="form-control form-control-sm" id="join_link"></textarea>
                    </div>

                    <div class="mb-1">
                      <label for="start_link">Start link</label>
                      <textarea name="start_link" class="form-control form-control-sm" id="start_link"></textarea>
                    </div>

                    <div class="mb-1">
                      <label for="remarks">Remarks</label>
                      <textarea name="remarks" class="form-control form-control-sm" id="remarks"></textarea>
                    </div>

                    <!-- <div class="mb-1">
                      <label for="generated_by">Generated by</label>
                      <select name="generated_by" class="form-select form-select-sm" id="generated_by">
                        <option value="" selected disabled>--</option>
                        <?php
                        $query = $conn->query("SELECT * FROM users WHERE role_id != 4");
                        while ($row = $query->fetch_object()) {
                        ?>
                          <option value="<?= $row->id ?>"><?= $row->first_name ?> <?= $row->last_name ?></option>
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
                          <option value="<?= $row->id ?>"><?= $row->first_name ?> <?= $row->last_name ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div> -->
                  </div>
                  <div class="text-end">
                    <input type="hidden" name="request_meeting" />
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="col-lg-8">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Zoom Request List</h5>
                <div id='zoom-calendar'></div>
              </div>
            </div>
          </div>
          <!-- Modal -->
          <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="editModalLabel"></h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="user-edit">

                    <form id="editmeeting" class="row g-3 enctype-validation" enctype="multipart/form-data" novalidate>

                      <div class="mb-1">
                        <label for="date_requested">Date Requested</label>
                        <input name="date_requested" type="date" class="form-control form-control-sm" id="date_requested" value="<?= date('Y-m-d') ?>" required />
                      </div>

                      <div class="mb-1">
                        <label for="topic">Meeting topic or title</label>
                        <div class="text-end">
                          <textarea name="topic" class="form-control form-control-sm" id="topic" maxlength="150" required></textarea>
                          <div id="the-count">
                            <span id="current">0</span>
                            <span id="maximum">/ 150</span>
                          </div>

                          <script>
                            $(document).ready(function() {
                              $('#editmeeting #topic').on('keyup', function() {
                                var currentLength = $(this).val().length;
                                $('#editmeeting #current').text(currentLength);
                              });
                            });
                          </script>
                        </div>
                      </div>

                      <div class="mb-1">
                        <label for="date_scheduled">Date of schedule</label>
                        <input name="date_scheduled" type="date" class="form-control form-control-sm" id="date_scheduled" value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>" required />
                      </div>

                      <div class="mb-1">
                        <label for="time_start">Time of schedule starts</label>
                        <input name="time_start" type="time" class="form-control form-control-sm" id="time_start" value="<?= date('H:i') ?>" required />
                      </div>

                      <div class="mb-1">
                        <label for="time_end">Time of schedule ends</label>
                        <input name="time_end" type="time" class="form-control form-control-sm" id="time_end" value="<?= date('H:i') ?>" required />
                      </div>

                      <a class="text-end btn-link" data-bs-toggle="collapse" href="#collapseExample" id="ShowFields" onclick="ShowFields.style.display = 'none';HideFields.style.display = ''">
                        Show other fields
                      </a>
                      <a class="text-end btn-link" data-bs-toggle="collapse" href="#collapseExample" id="HideFields" onclick="HideFields.style.display = 'none';ShowFields.style.display = ''" style="display: none;">
                        Hide other fields
                      </a>
                      <div class="collapse" id="collapseExample">
                        <div class="mb-1">
                          <label for="status_id">Meeting status</label>
                          <select name="status_id" class="form-select form-select-sm" id="status_id">
                            <?php
                            $query = $conn->query("SELECT * FROM meetings_statuses");
                            while ($row = $query->fetch_object()) {
                            ?>
                              <option value="<?= $row->id ?>"><?= $row->status ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>

                        <div class="mb-1">
                          <label for="host_id">Hosted by</label>
                          <select name="host_id" class="form-select form-select-sm" id="host_id">
                            <option value="" selected disabled>--</option>
                            <?php
                            $query = $conn->query("SELECT * FROM hosts");
                            while ($row = $query->fetch_object()) {
                            ?>
                              <option value="<?= $row->id ?>"><?= $row->host_name ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>

                        <div class="mb-1">
                          <label for="meetingid">Meeting ID</label>
                          <input name="meetingid" type="text" class="form-control form-control-sm" id="meetingid" />
                        </div>

                        <div class="mb-1">
                          <label for="passcode">Passcode</label>
                          <input name="passcode" type="text" class="form-control form-control-sm" id="passcode" />
                        </div>

                        <div class="mb-1">
                          <label for="join_link">Join link</label>
                          <textarea name="join_link" class="form-control form-control-sm" id="join_link"></textarea>
                        </div>

                        <div class="mb-1">
                          <label for="start_link">Start link</label>
                          <textarea name="start_link" class="form-control form-control-sm" id="start_link"></textarea>
                        </div>

                        <div class="mb-1">
                          <label for="remarks">Remarks</label>
                          <textarea name="remarks" class="form-control form-control-sm" id="remarks"></textarea>
                        </div>

                        <!-- <div class="mb-1">
                          <label for="generated_by">Generated by</label>
                          <select name="generated_by" class="form-select form-select-sm" id="generated_by">
                            <option value="" selected disabled>--</option>
                            <?php
                            $query = $conn->query("SELECT * FROM users WHERE role_id != 4");
                            while ($row = $query->fetch_object()) {
                            ?>
                              <option value="<?= $row->id ?>"><?= $row->first_name ?> <?= $row->last_name ?></option>
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
                              <option value="<?= $row->id ?>"><?= $row->first_name ?> <?= $row->last_name ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div> -->
                      </div>
                      <div class="text-end">
                        <input type="hidden" name="id" id="id" />
                        <input type="hidden" name="edit_meeting" />
                        <input type="submit" id="editform" hidden />
                      </div>
                    </form>

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
              var calendarEl = $("#zoom-calendar")[0];

              var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: "dayGridMonth",
                events: 'assets/components/includes/calendars/meetings.php',
                dayMaxEventRows: 1,
                eventTimeFormat: {
                  hour: '2-digit',
                  minute: '2-digit',
                  hour12: true
                },
                displayEventEnd: true,
                eventClick: function(info) {
                  console.log(info);
                  $('#editmeeting #date_requested').val(info.event.extendedProps.date_requested);
                  $('#editmeeting #topic').val(info.event.extendedProps.topic);
                  $('#editmeeting #date_scheduled').val(info.event.extendedProps.date_scheduled);
                  $('#editmeeting #time_start').val(info.event.extendedProps.time_start);
                  $('#editmeeting #status_id').val(info.event.extendedProps.status_id);
                  $('#editmeeting #host_id').val(info.event.extendedProps.host_id);
                  $('#editmeeting #meetingid').val(info.event.extendedProps.meetingid);
                  $('#editmeeting #passcode').val(info.event.extendedProps.passcode);
                  $('#editmeeting #join_link').val(info.event.extendedProps.join_link);
                  $('#editmeeting #start_link').val(info.event.extendedProps.start_link);
                  $('#editmeeting #remarks').val(info.event.extendedProps.remarks);
                  $('#editmeeting #id').val(info.event.extendedProps.id);
                  $('#editModal').modal('show');
                  $('.fc-popover-close').click();
                }
              });

              calendar.render();
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
                      $('#editModal #status_id').val(response.status_id);
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
                      $('#editModal #editModalLabel').html(response.request_number + ' (<span class="text-' + response.color + '">' + response.status + '</span>)');
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