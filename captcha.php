<?php
define("SITE_KEY", "6Lc_KXIpAAAAAJquXM-qgJ4H7jKPFsCDz3S5joEe");
define("SECRET_KEY", "6Lc_KXIpAAAAAMYDDuq15u75kawnYE7dVVzhLlkP");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://www.google.com/recaptcha/api.js?render=<?= SITE_KEY ?>"></script>
</head>

<body>
    <form action="/" method="POST">
        <input type="text" name="name" />
        <input type="text" name="g-recaptcha-response" id="g-recaptcha-response" />
        <input type="submit" value="Submit"/>
    </form>
    <script>
            grecaptcha.ready(function () {
                grecaptcha.execute('<?= SITE_KEY ?>', { action: 'submit' }).then(function (token) {
                    console.log(token);
                });
            });
    </script>
</body>

</html>