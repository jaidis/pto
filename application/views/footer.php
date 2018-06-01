<?php
/**
 * Created by PhpStorm.
 * User: jaidis
 * Date: 29/04/18
 * Time: 17:44
 */

defined('BASEPATH') OR exit('No direct script access allowed');
?>
<footer class="footer bg-primary text-white">
    <div class="row text-center mx-0">
        <div class="col-12 col-md-4 footer-col footer-left">
            <p class="p-0 m-0"><a href="/" class="text-white"><i class="fa fa-home fa-fw mr-1 icon-left"></i>Inicio</a></p>
            <p class="p-0 m-0"><a href="/provincias" class="text-white"><i class="fa fa-globe fa-fw mr-1 icon-left"></i>Provincias</a></p>
            <p class="p-0 m-0"><a href="/monumentos" class="text-white"><i class="fa fa-map-signs fa-fw mr-1 icon-left"></i>Monumentos</a></p>
            <p class="p-0 m-0"><a href="/contacto" class="text-white"><i class="fa fa-cutlery fa-fw mr-1 icon-left"></i>Gastronomía</a></p>
            <p class="p-0 m-0"><a href="/noticias" class="text-white"><i class="fa fa-newspaper-o fa-fw mr-1 icon-left"></i>Noticias</a></p>
            <p class="p-0 m-0"><a href="/contacto" class="text-white"><i class="fa fa-info fa-fw mr-1 icon-left"></i>Contacto</a></p>
        </div>
        <div class="col-12 col-md-4 footer-col footer-center">
            <div class="row justify-content-center row-special">
                <a href="/" class="facebook px-2"><i class="fa fa-facebook-official fa-3x"></i></a>
                <a href="/" class="twitter px-2"><i class="fa fa-twitter-square fa-3x"></i></a>
                <a href="/" class="whatsapp px-2"><i class="fa fa-whatsapp fa-3x"></i></a>
                <a href="/" class="instagram px-2"><i class="fa fa-instagram fa-3x"></i></a>
            </div>
        </div>
        <div class="col-12 col-md-4 footer-col footer-right">
            <p class="p-0 m-0"><a href="/cuenta" class="text-white">Cuenta<i class="fa fa-user fa-fw ml-1 icon-left"></i></a></p>
            <p class="p-0 m-0"><a href="/login" class="text-white">Login<i class="fa fa-key fa-fw ml-1 icon-left"></i></a></p>
            <p class="p-0 m-0"><a href="/registro" class="text-white">Regitro<i class="fa fa-user-plus fa-fw ml-1 icon-left"></i></a></p>
            <p class="p-0 m-0"><a href="/recuperar-cuenta" class="text-white">Recuperar cuenta<i class="fa fa-refresh fa-fw ml-1 icon-left"></i></a></p>
        </div>
    </div>
</footer>
<p class="text-center bg-primary text-white m-0 p-0">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
<script src="/assets/js/jquery-3.3.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/assets/js/popper-1.14.0.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/assets/js/bootstrap-4-1.0.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/assets/js/toastr.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/assets/js/jquery.waypoints-4.0.0.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/assets/js/jquery-jvectormap-2.0.3.min.js" charset="utf-8"></script>
<script src="/assets/js/jquery-jvectormap-es-merc.min.js" charset="utf-8"></script>
<script src="/assets/js/jquery.gridder.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/assets/js/main.js" type="text/javascript" charset="utf-8"></script>

<?php
if (!empty($js_to_load))
    echo "<script src='/assets/js/$js_to_load'></script>";
?>
</body>
</html>
