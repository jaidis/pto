<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$var = explode(' ',$heading);
$heading = $var[0];
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <title>Bootswatch: Flatly</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="/assets/css/vendor.css">
    <link rel="stylesheet" href="/assets/css/app-purple.css">
</head>
<body>
<div class="app blank sidebar-opened">
    <article class="content">
        <div class="error-card global">
            <div class="error-title-block">
                <h1 class="error-title"><?php echo $heading; ?></h1>
                <h2 class="error-sub-title my-4"> <?php echo $message; ?></h2>
                <a class="btn btn-primary btn-block my-4" href="/">Volver al portal</a>
            </div>
            <div>
                <h1></h1>

            </div>
        </div>
    </article>
</div>
<script src="/assets/js/vendor.js"></script>
<script src="/assets/js/app.js"></script>
</body>
</html>