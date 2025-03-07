<?php
require_once "assets/components/includes/session.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <title>
    <?= $website ?> |
    <?= $page ?>
  </title>
  <meta content="" name="description" />
  <meta content="" name="keywords" />

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon" />
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet" />
  <link href="assets/vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet" />
  <link href="assets/vendor/print-js/dist/print.css" rel="stylesheet" />

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <script src="assets/vendor/jquery.min.js"></script>
  <script src="assets/vendor/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="assets/vendor/fullcalendar/index.global.min.js"></script>
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/print-js/dist/print.js"></script>

  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-FX8D7BF4SZ"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());

    gtag('config', 'G-FX8D7BF4SZ');
  </script>

  <script src="https://www.google.com/recaptcha/api.js?render=<?= sitekey ?>"></script>
  <script>
    window.sitekey = "<?= sitekey ?>";
    grecaptcha.ready(function () {
      grecaptcha.execute(window.sitekey).then(function (token) {
        $(".captcha-token").val(token);
      });
    });
  </script>

</head>

<body>