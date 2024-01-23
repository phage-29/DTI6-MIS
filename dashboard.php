<?php $page = "Dashboard" ?>
<?php require_once "assets/components/templates/header.php"; ?>
<?php require_once "assets/components/templates/topbar.php"; ?>
<?php require_once "assets/components/templates/sidebar.php"; ?>
<main id="main" class="main">
  <?php
  switch ($_SESSION['role']) {
    case 'Admin':
  ?>
      <section class="section dashboard">
        <div class="text-end mb-3 btn">
          <select class="form-select" onchange="location='?year='+this.value">
            <?php
            $getyear = $_GET['year'] ?? date('Y');
            $currentYear = date('Y');

            for ($i = 0; $i < 10; $i++) {
              $year = $currentYear - $i;
            ?>
              <option value="<?= $year ?>" <?= $getyear == $year ? 'selected' : '' ?>><?= $year ?></option>
            <?php
            }
            ?>
          </select>
        </div>
        <div class="row">

          <div class="col-xxl-4 col-md-6">
            <div class="card info-card">

              <div class="card-body">
                <h5 class="card-title">Meetings</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center text-light" style="background: #11235A">
                    <i class="bi bi-person-video2"></i>
                  </div>
                  <div class="ps-3">
                    <h6 id="count_meetings"></h6>
                    <script>
                      $.ajax({
                        type: "GET",
                        url: "assets/components/includes/fetch.php",
                        data: {
                          'count_meetings': '',
                          'year': '<?= $_GET['year'] ?? date('Y') ?>'
                        },
                        dataType: 'json',
                        success: function(response) {
                          console.log(response);
                          $('#count_meetings').html(response.counts);
                        }
                      });
                    </script>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="col-xxl-4 col-md-6">
            <div class="card info-card">

              <div class="card-body">
                <h5 class="card-title">Assistances</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center text-light" style="background: #11235A">
                    <i class="bi bi-person-check"></i>
                  </div>
                  <div class="ps-3">
                    <h6 id="count_helpdesks"></h6>
                    <script>
                      $.ajax({
                        type: "GET",
                        url: "assets/components/includes/fetch.php",
                        data: {
                          'count_helpdesks': '',
                          'year': '<?= $_GET['year'] ?? date('Y') ?>'
                        },
                        dataType: 'json',
                        success: function(response) {
                          console.log(response);
                          $('#count_helpdesks').html(response.counts);
                        }
                      });
                    </script>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="col-xxl-4 col-xl-12">

            <div class="card info-card">

              <div class="card-body">
                <h5 class="card-title">Equipment</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center text-light" style="background: #11235A">
                    <i class="bi bi-pc-display"></i>
                  </div>
                  <div class="ps-3">
                    <h6 id="count_equipment"></h6>
                    <script>
                      $.ajax({
                        type: "GET",
                        url: "assets/components/includes/fetch.php",
                        data: {
                          'count_equipment': '',
                          'year': '<?= $_GET['year'] ?? date('Y') ?>'
                        },
                        dataType: 'json',
                        success: function(response) {
                          console.log(response);
                          $('#count_equipment').html(response.counts);
                        }
                      });
                    </script>

                  </div>
                </div>

              </div>
            </div>

          </div>

          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Assistances by category</h5>

                <!-- Bar Chart -->
                <div id="barChart"></div>

                <script>
                  $(document).ready(function() {
                    $.ajax({
                      url: 'assets/components/includes/charts/barChart.php',
                      data: {
                        'year': '<?= $_GET['year'] ?? date('Y') ?>'
                      },
                      type: 'GET',
                      dataType: 'json',
                      success: function(data) {
                        barChart(data);
                      }
                    });
                  });

                  function barChart(data) {

                    var barChart = new ApexCharts(document.querySelector("#barChart"), {
                      series: [{
                        name: 'Assistances',
                        data: data.map(item => item.count_helpdesks)
                      }],
                      chart: {
                        type: 'bar',
                        height: 350
                      },
                      plotOptions: {
                        bar: {
                          distributed: true,
                          horizontal: true,
                          dataLabels: {
                            position: 'bottom'
                          },
                        }
                      },
                      colors: ["#182015", "#0e1355", "#233b76", "#2e56b6", "#3961d7", "#457ced", "#5182f1", "#5c8dfa", "#6798ff", "#729ee3"],
                      dataLabels: {
                        enabled: true,
                        textAnchor: 'start',
                        style: {
                          colors: ['#fff']
                        },
                        formatter: function(val, opt) {
                          return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
                        },
                        offsetX: 0,
                        dropShadow: {
                          enabled: true
                        }
                      },
                      stroke: {
                        width: 1,
                        colors: ['#fff']
                      },
                      xaxis: {
                        categories: data.map(item => item.category),
                      },
                      yaxis: {
                        labels: {
                          show: false
                        }
                      }
                    }).render();
                  }
                </script>
                <!-- End Bar Chart -->

              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Assistances by Division</h5>

                <!-- Donut Chart -->
                <div id="donutChart"></div>
                <script>
                  $(document).ready(function() {
                    $.ajax({
                      url: 'assets/components/includes/charts/donutChart.php',
                      data: {
                        'year': '<?= $_GET['year'] ?? date('Y') ?>'
                      },
                      type: 'GET',
                      dataType: 'json',
                      success: function(data) {
                        donutChart(data);
                      }
                    });
                  });

                  function donutChart(data) {

                    var donutChart = new ApexCharts(document.querySelector("#donutChart"), {
                      series: data.map(item => item.count_helpdesks),
                      chart: {
                        height: 350,
                        type: 'donut',
                        toolbar: {
                          show: true
                        }
                      },
                      colors: ["#182015", "#0e1355", "#233b76", "#2e56b6", "#3961d7", "#457ced", "#5182f1", "#5c8dfa", "#6798ff", "#729ee3"],
                      labels: data.map(item => item.division),
                    }).render();
                  }
                </script>
                <!-- End Donut Chart -->

              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Assistances by Sex</h5>

                <!-- Pie Chart -->
                <div id="pieChart"></div>

                <script>
                  $(document).ready(function() {
                    $.ajax({
                      url: 'assets/components/includes/charts/pieChart.php',
                      data: {
                        'year': '<?= $_GET['year'] ?? date('Y') ?>'
                      },
                      type: 'GET',
                      dataType: 'json',
                      success: function(data) {
                        pieChart(data);
                      }
                    });
                  });

                  function pieChart(data) {

                    var pieChart = new ApexCharts(document.querySelector("#pieChart"), {
                      series: data.map(item => item.count_helpdesks),
                      chart: {
                        height: 350,
                        type: 'pie',
                        toolbar: {
                          show: true
                        }
                      },
                      colors: ["#182015", "#0e1355", "#233b76", "#2e56b6", "#3961d7", "#457ced", "#5182f1", "#5c8dfa", "#6798ff", "#729ee3"],
                      labels: data.map(item => item.sex)
                    }).render();
                  }
                </script>
                <!-- End Pie Chart -->

              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Number of Assistances</h5>

                <!-- Line Chart -->
                <div id="lineChart"></div>
                <script>
                  $(document).ready(function() {
                    $.ajax({
                      url: 'assets/components/includes/charts/lineChart.php',
                      data: {
                        'year': '<?= $_GET['year'] ?? date('Y') ?>'
                      },
                      type: 'GET',
                      dataType: 'json',
                      success: function(data) {
                        lineChart(data);
                      }
                    });
                  });

                  function lineChart(data) {

                    var lineChart = new ApexCharts(document.querySelector("#lineChart"), {
                      series: [{
                        name: "Assistances",
                        data: data.map(item => item.count_helpdesks)
                      }],
                      chart: {
                        height: 350,
                        type: 'line',
                        zoom: {
                          enabled: false
                        }
                      },
                      colors: ["#182015", "#0e1355", "#233b76", "#2e56b6", "#3961d7", "#457ced", "#5182f1", "#5c8dfa", "#6798ff", "#729ee3"],
                      dataLabels: {
                        enabled: false
                      },
                      stroke: {
                        curve: 'straight'
                      },
                      grid: {
                        row: {
                          colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                          opacity: 0.5
                        },
                      },
                      xaxis: {
                        categories: data.map(item => item.months),
                      }
                    }).render();
                  }
                </script>
                <!-- End Line Chart -->

              </div>
            </div>
          </div>

          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Zoom Calendar</h5>
                <script>
                  document.addEventListener('DOMContentLoaded', function() {
                    var calendarEl = document.getElementById('zoom-calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                      initialView: 'dayGridMonth'
                    });
                    calendar.render();
                  });
                </script>

                <div id='zoom-calendar'></div>

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