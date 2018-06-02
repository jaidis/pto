<?php
/**
 * Created by PhpStorm.
 * User: jaidis
 * Date: 29/04/18
 * Time: 17:44
 */

defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script src="/assets/js/jquery-3.3.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/assets/js/popper-1.14.0.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/assets/js/bootstrap-4-1.0.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/assets/js/toastr.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/assets/js/jquery.waypoints-4.0.0.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/assets/js/jquery-jvectormap-2.0.3.min.js" charset="utf-8"></script>
<script src="/assets/js/jquery-jvectormap-es-merc.min.js" charset="utf-8"></script>
<script src="/assets/js/jquery.gridder.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/assets/js/jquery.validate.bundle.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/assets/js/main.js" type="text/javascript" charset="utf-8"></script>

<?php
if (!empty($js_to_load))
    echo "<script src='/assets/js/$js_to_load'></script>";
?>
</body>
</html>
