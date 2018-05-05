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
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/fontawesome-4.7.0.css">
    <link rel="stylesheet" href="/assets/css/animate-3.6.0.min.css">
    <link rel="stylesheet" href="/assets/css/jquery-jvectormap-2.0.3.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link href="/assets/img/favicon.ico" rel="icon" type="image/x-icon" />
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="/"><img src="/assets/img/logo.png" width="50"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarPortal"
            aria-controls="navbarPortal" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarPortal">
        <ul class="navbar-nav mr-auto navbar-effect">
            <li class="nav-item <?php echo ($activo == "provincias") ? "active" : "" ?>">
                <a class="nav-link" href="/provincias">Provincias</a>
            </li>
            <li class="nav-item <?php echo ($activo == "monumentos") ? "active" : "" ?>">
                <a class="nav-link" href="/monumentos">Monumentos</a>
            </li>
            <li class="nav-item <?php echo ($activo == "gastronomia") ? "active" : "" ?>">
                <a class="nav-link" href="/gastronomia">Gastronomía</a>
            </li>
            <li class="nav-item <?php echo ($activo == "noticias") ? "active" : "" ?>">
                <a class="nav-link" href="/noticias">Noticias</a>
            </li>
            <li class="nav-item <?php echo ($activo == "contacto") ? "active" : "" ?>">
                <a class="nav-link" href="/contacto">Contacto</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto navbar-effect">
            <li class="nav-item <?php echo ($activo == "login") ? "active" : "" ?>">
                <a class="nav-link" href="/login">Login</a>
            </li>
            <li class="nav-item <?php echo ($activo == "registro") ? "active" : "" ?>">
                <a class="nav-link" href="/registro">Registro</a>
            </li>
        </ul>
    </div>
</nav>

