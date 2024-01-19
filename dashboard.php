<?php require_once "assets/components/templates/header.php"; ?>
<?php require_once "assets/components/templates/topbar.php"; ?>
<?php require_once "assets/components/templates/sidebar.php"; ?>
<main id="main" class="main">

  <section class="section dashboard">

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
                <h6>145</h6>

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
                <h6>$3,264</h6>

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
                <h6>1244</h6>

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
              document.addEventListener("DOMContentLoaded", () => {
                new ApexCharts(document.querySelector("#barChart"), {
                  series: [{
                    data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
                  }],
                  chart: {
                    type: 'bar',
                    height: 350
                  },
                  plotOptions: {
                    bar: {
                      borderRadius: 4,
                      distributed: true,
                      horizontal: true,
                    }
                  },
                  colors: ["#182015", "#0e1355", "#233b76", "#2e56b6", "#3961d7", "#457ced", "#5182f1", "#5c8dfa", "#6798ff", "#729ee3"],
                  dataLabels: {
                    enabled: true
                  },
                  xaxis: {
                    categories: ['South Korea', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France', 'Japan',
                      'United States', 'China', 'Germany'
                    ],
                  }
                }).render();
              });
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
              document.addEventListener("DOMContentLoaded", () => {
                new ApexCharts(document.querySelector("#donutChart"), {
                  series: [44, 55, 13, 43, 22],
                  chart: {
                    height: 350,
                    type: 'donut',
                    toolbar: {
                      show: true
                    }
                  },
                  colors: ["#182015", "#0e1355", "#233b76", "#2e56b6", "#3961d7", "#457ced", "#5182f1", "#5c8dfa", "#6798ff", "#729ee3"],
                  labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
                }).render();
              });
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
              document.addEventListener("DOMContentLoaded", () => {
                new ApexCharts(document.querySelector("#pieChart"), {
                  series: [13, 55],
                  chart: {
                    height: 350,
                    type: 'pie',
                    toolbar: {
                      show: true
                    }
                  },
                  colors: ["#182015", "#0e1355", "#233b76", "#2e56b6", "#3961d7", "#457ced", "#5182f1", "#5c8dfa", "#6798ff", "#729ee3"],
                  labels: ['Male', 'Female']
                }).render();
              });
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
              document.addEventListener("DOMContentLoaded", () => {
                new ApexCharts(document.querySelector("#lineChart"), {
                  series: [{
                    name: "Desktops",
                    data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
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
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                  }
                }).render();
              });
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

</main><!-- End #main -->
<?php require_once "assets/components/templates/footer.php"; ?>