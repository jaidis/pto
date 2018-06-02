<?php
/**
 * Created by PhpStorm.
 * User: jaidis
 * Date: 01/06/18
 * Time: 12:00
 */
?>
<div class="container p-0">
    <div class="col-login col-11 col-md-6 col-xl-4">
        <div class="card card-login p-4">
<!--            <h3 class="mt-3 mb-4 text-center">Nueva contraseña</h3>-->
            <img id="profile-img" class="profile-img-card-2 mx-auto" src="/assets/img/pto.png" />
            <hr class="mb-3" />
            <form role="form" id="loginForm" autocomplete="off">
                <div class="form-row mb-3">
                    <div class="form-group col-md-12">
                        <label for="inputPassword">Contraseña</label>
                        <input type="password" class="form-control" id="inputPassword"
                               name="inputPassword"
                               placeholder="Introduzca la contraseña">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputPassword">Repetir Contraseña</label>
                        <input type="password" class="form-control" id="inputPasswordDuplicate"
                               name="inputPasswordDuplicate"
                               placeholder="Introduzca de nuevo la contraseña">
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-check mr-1"></i>
                        Cambiar contraseña
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


