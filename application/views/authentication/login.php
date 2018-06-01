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
            <img id="profile-img" class="profile-img-card mx-auto mb-4" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <form role="form" id="loginForm" autocomplete="off">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputEmail">Correo electrónico</label>
                            <input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="Introduzca el correo electrónico">
                        </div>
                    <div class="form-group col-md-12">
                        <label for="inputPassword">Contraseña</label>
                        <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Introduzca la contraseña">
                    </div>
                    <div class="form-group col-md-12 mb-0">
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="remember" required>
                            <label class="custom-control-label" for="remember">Recordar</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-sign-in mr-1"></i> Acceder</button>
                </div>
                <div class="form-group">
                    <p class="text-center">¿Aún no te has registrado?
                        <a href="/registro">¡Registrate ahora!</a>
                    </p>
                </div>
                <hr class="my-4"/>
                <div class="form-group">
                    <p class="text-center">¿Has olvidado la contraseña?
                        <a href="/recuperar">¡Pulsa aquí para recuperar la cuenta!</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>


