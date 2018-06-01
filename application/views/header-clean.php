<?php
/**
 * Created by PhpStorm.
 * User: jaidis
 * Date: 29/04/18
 * Time: 17:44
 */

defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portal Turismo y Ocio</title>
    <link rel="stylesheet" href="/assets/css/normalize.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/fontawesome-4.7.0.css">
    <link rel="stylesheet" href="/assets/css/animate-3.6.0.min.css">
    <link rel="stylesheet" href="/assets/css/jquery-jvectormap-2.0.3.css">
    <link rel="stylesheet" href="/assets/css/toastr.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <?php
    if (!empty($css_to_load))
        echo "<link rel=\"stylesheet\" href=\"/assets/css/$css_to_load\">";
    ?>
    <link href="/assets/img/favicon.ico" rel="icon" type="image/x-icon" />
</head>
<body>

