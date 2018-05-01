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
            <p class="p-0 m-0"><a href="index.html" class="text-white"><i class="fa fa-home fa-fw mr-1 icon-left"></i>Inicio</a></p>
            <p class="p-0 m-0"><a href="carta.html" class="text-white"><i class="fa fa-cutlery fa-fw mr-1 icon-left"></i>Carta</a></p>
            <p class="p-0 m-0"><a href="reserva.html" class="text-white"><i class="fa fa-calendar-plus-o fa-fw mr-1 icon-left"></i>Reserva</a></p>
            <p class="p-0 m-0"><a href="contacto.html" class="text-white"><i class="fa fa-info fa-fw mr-1 icon-left"></i>Contacto</a></p>
<!--            <p class="p-0 m-0"><a href="comentarios.html" class="text-white"><i class="fa fa-star fa-fw mr-1 icon-left"></i>Reseñas</a></p>-->
<!--            <p class="p-0 m-0"><a href="galeria.html" class="text-white"><i class="fa fa-picture-o fa-fw mr-1 icon-left"></i>Galeria</a></p>-->
        </div>
        <div class="col-12 col-md-4 footer-col footer-center">
            <div class="row justify-content-center row-special">
                <a href="index.html" class="text-white"><i class="fa fa-facebook-official fa-3x px-2"></i></a>
                <a href="index.html" class="text-white"><i class="fa fa-twitter-square fa-3x px-2"></i></a>
                <a href="index.html" class="text-white"><i class="fa fa-whatsapp fa-3x px-2"></i></a>
                <a href="index.html" class="text-white"><i class="fa fa-instagram fa-3x px-2"></i></a>
            </div>
        </div>
        <div class="col-12 col-md-4 footer-col footer-right">
            <p class="p-0 m-0">Calle Lanjarón, 8</p>
            <p class="p-0 m-0">Albolote</p>
            <p class="p-0 m-0">CP:18220</p>
            <p class="p-0 m-0"><strong>E-mail</strong> <em>info@lacasona.es</em></p>
<!--            <p class="p-0 m-0"><strong>Teléfono</strong> <em>958 49 00 00</em></p>-->
<!--            <p class="p-0 m-0"><strong>Horario</strong> <em>L-V 07:00-20:00</em></p>-->
        </div>
    </div>
</footer>
<p class="text-center bg-primary text-white m-0 p-0">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
<script src="/assets/js/jquery-3.3.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/assets/js/popper-1.14.0.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/assets/js/bootstrap-4-1.0.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/assets/js/jquery.waypoints-4.0.0.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/assets/js/main.js" type="text/javascript" charset="utf-8"></script>
<?php
if (!empty($js_to_load))
    echo "<script src='/assets/js/$js_to_load'></script>";
?>
</body>
</html>
