<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Portal Turismo y Ocio - Panel de Administración </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="/assets/css/pto-admin/vendor.css">
    <!-- Theme initialization -->
    <script>
        var themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
            {};
        var themeName = themeSettings.themeName || '';
        if (themeName)
        {
            document.write('<link rel="stylesheet" id="theme-style" href="/assets/css/pto-admin/app-' + themeName + '.css">');
        }
        else
        {
            document.write('<link rel="stylesheet" id="theme-style" href="/assets/css/pto-admin/app.css">');
        }
    </script>
    <link rel="stylesheet" href="/assets/css/toastr.css">
    <link rel="stylesheet" href="/assets/css/pto-admin/dataTables.css">
    <?php
    if (!empty($css_to_load))
        echo "<link rel=\"stylesheet\" href=\"/assets/css/pto-admin/$css_to_load\">";
    ?>
    <link href="/assets/img/favicon.ico" rel="icon" type="image/x-icon" />
</head>
<body>
<div class="main-wrapper">
    <div class="app" id="app">
        <header class="header">
            <div class="header-block header-block-collapse d-lg-none d-xl-none">
                <button class="collapse-btn" id="sidebar-collapse-btn">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <div class="header-block header-block-nav">
                <ul class="nav-profile">
                    <li class="profile dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <?php if (!empty($user)): ?>
                            <img class="img" src="/assets/img/users/<?php echo $user->image_url; ?>">
                            <span class="name"> <?php echo $user->username; ?> </span>
                            <?php endif; ?>
                        </a>
                        <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                            <a class="dropdown-item" href="/logout">
                                <i class="fa fa-power-off icon"></i> Logout </a>
                        </div>
                    </li>
                </ul>
            </div>
        </header>
        <aside class="sidebar">
            <div class="sidebar-container">
                <div class="sidebar-header my-3">
                    <div class="brand">
                        <img src="/assets/img/logo.png" height="70" class="ml-4">
                    </div>
                </div>
                <nav class="menu">
                    <ul class="sidebar-menu metismenu" id="sidebar-menu">
                        <li class="<?php echo (!empty($active) && $active == "home") ? 'active' : '' ?>">
                            <a href="/pto-admin">
                                <i class="fa fa-home"></i> Inicio </a>
                        </li>
                        <li class="<?php echo (!empty($active) && $active == "provincias") ? 'active open' : '' ?>">
                            <a href="">
                                <i class="fa fa-globe"></i> Provincias
                                <i class="fa arrow"></i>
                            </a>
                            <ul class="sidebar-nav">
                                <li>
                                    <a href="/pto-admin/provincias"> Listado </a>
                                </li>
                                <?php if(!empty($añadir) && $añadir == 1): ?>
                                    <li>
                                        <a href="/pto-admin/provincias/new"> Nueva provincia </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <li class="<?php echo (!empty($active) && $active == "monumentos") ? 'active open' : '' ?>">
                            <a href="">
                                <i class="fa fa-map-signs"></i> Monumentos
                                <i class="fa arrow"></i>
                            </a>
                            <ul class="sidebar-nav">
                                <li>
                                    <a href="/pto-admin/monumentos"> Listado </a>
                                </li>
                                <?php if(!empty($añadir) && $añadir == 1): ?>
                                    <li>
                                        <a href="/pto-admin/monumentos/new"> Nuevo monumento </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <li class="<?php echo (!empty($active) && $active == "gastronomia") ? 'active open' : '' ?>">
                            <a href="">
                                <i class="fa fa-cutlery"></i> Gastronomía
                                <i class="fa arrow"></i>
                            </a>
                            <ul class="sidebar-nav">
                                <li>
                                    <a href="/pto-admin/gastronomia"> Listado </a>
                                </li>
                                <?php if(!empty($añadir) && $añadir == 1): ?>
                                    <li>
                                        <a href="/pto-admin/gastronomia/new"> Nueva gastronomía </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <li class="<?php echo (!empty($active) && $active == "noticias") ? 'active open' : '' ?>">
                            <a href="">
                                <i class="fa fa-newspaper-o"></i> Noticias
                                <i class="fa arrow"></i>
                            </a>
                            <ul class="sidebar-nav">
                                <li>
                                    <a href="/pto-admin/noticias"> Listado </a>
                                </li>
                                <?php if(!empty($añadir) && $añadir == 1): ?>
                                    <li>
                                        <a href="/pto-admin/noticias/new"> Nueva Noticia </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <li class="<?php echo (!empty($active) && $active == "usuarios") ? 'active open' : '' ?>">
                            <a href="">
                                <i class="fa fa-users"></i> Usuarios
                                <i class="fa arrow"></i>
                            </a>
                            <ul class="sidebar-nav">
                                <li>
                                    <a href="/pto-admin/usuarios"> Listado </a>
                                </li>
                            </ul>
                        </li>
                        <?php if(!empty($admin) && $admin == 1): ?>
                            <li class="<?php echo (!empty($active) && $active == "configuacion") ? 'active open' : '' ?>">
                                <a href="">
                                    <i class="fa fa-gear"></i> Configuración
                                    <i class="fa arrow"></i>
                                </a>
                                <ul class="sidebar-nav">
                                    <li>
                                        <a href="/pto-admin/permisos"><i class="fa fa-lock mr-1"></i> Permisos </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
            <footer class="sidebar-footer">
                <ul class="sidebar-menu metismenu" id="customize-menu">
                    <li>
                        <ul>
                            <li class="customize">
                                <div class="customize-item">
                                    <div class="row customize-header">
                                        <div class="col-4"> </div>
                                        <div class="col-4">
                                            <label class="title">fixed</label>
                                        </div>
                                        <div class="col-4">
                                            <label class="title">static</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="title">Sidebar:</label>
                                        </div>
                                        <div class="col-4">
                                            <label>
                                                <input class="radio" type="radio" name="sidebarPosition" value="sidebar-fixed">
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-4">
                                            <label>
                                                <input class="radio" type="radio" name="sidebarPosition" value="">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="title">Header:</label>
                                        </div>
                                        <div class="col-4">
                                            <label>
                                                <input class="radio" type="radio" name="headerPosition" value="header-fixed">
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-4">
                                            <label>
                                                <input class="radio" type="radio" name="headerPosition" value="">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="title">Footer:</label>
                                        </div>
                                        <div class="col-4">
                                            <label>
                                                <input class="radio" type="radio" name="footerPosition" value="footer-fixed">
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-4">
                                            <label>
                                                <input class="radio" type="radio" name="footerPosition" value="">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="customize-item">
                                    <ul class="customize-colors">
                                        <li>
                                            <span class="color-item color-red" data-theme="red"></span>
                                        </li>
                                        <li>
                                            <span class="color-item color-orange" data-theme="orange"></span>
                                        </li>
                                        <li>
                                            <span class="color-item color-green active" data-theme=""></span>
                                        </li>
                                        <li>
                                            <span class="color-item color-seagreen" data-theme="seagreen"></span>
                                        </li>
                                        <li>
                                            <span class="color-item color-blue" data-theme="blue"></span>
                                        </li>
                                        <li>
                                            <span class="color-item color-purple" data-theme="purple"></span>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <a href="">
                            <i class="fa fa-cog"></i> Customize </a>
                    </li>
                </ul>
            </footer>
        </aside>
        <div class="sidebar-overlay" id="sidebar-overlay"></div>
        <div class="sidebar-mobile-menu-handle" id="sidebar-mobile-menu-handle"></div>
        <div class="mobile-menu-handle"></div>