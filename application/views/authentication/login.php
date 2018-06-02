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
            <img id="profile-img" class="profile-img-card mx-auto mb-4"
                 src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMAAAADACAAAAAB3tzPbAAACOUlEQVR4Ae3aCQrrIBRG4e5/Tz+CBAlIkIAECUjoSt48z/GZeAvnrMCvc6/38XzxAAAAYC4AAAAAAAAAAAAAAAAAAAAAAAAAAAAMCAAAAAAAAAAAAAAAAPsagz4V4rq/FmCLTj/k4vYqgCN5/TKfjlcAJKff5pJ5QPH6Y77YBiz6a4thQJ30D03VKmB3+qfcbhOwO+l+waP/+VsEBgDV6USumgNMOtVkDbDoZIstQNHpiimA1+m8JUBSQ8kO4HBqyB1mAElNJTMAr6a8FcCmxjYjgKjGohGAU2POBmBXc7sJwKrmVhOAqOaiCUBQc8EEQO0JwPMB4ADASwhAe3yR8VPiP3/M8XOaPzQd/lLyp56xSuvnUGK0yHC313idCw6umNov+bhm5aK7fdWAZQ/WbdoXnlg5Y+mvfe2SxVdWj20FAAAAAAAAAAAAwFQAAJSS0hwmfVMIc0qlmAfsOQWvP+RDyrtNQM1L0D8WllxNAWqOXifzMVcbgG3xaswv22jAFp3a6zFteYw8fQ9DM6Amr275VG8GlFmdm8uNgDzpgqZ8EyB7XZTPNwDKpAubysWAOuvi5nolYHW6PLdeBjiCbikc1wCK0025cgUg68Zyf0DUrcXegKibi30Bq25v7QnYNKCtH+BwGpA7ugFmDWnuBSgaVOkECBpU6AOoGlbtAlg1rLULIGhYoQvAaViuC0AD6wE4Xh1QAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADA194CuqC6onikxXwAAAAASUVORK5CYII="/>
            <form role="form" id="loginForm" autocomplete="off">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputEmail">Correo electrónico</label>
                        <input type="email" class="form-control" name="inputEmail" id="inputEmail"
                               placeholder="Introduzca el correo electrónico" value="admin@example.com">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputPassword">Contraseña</label>
                        <input type="password" class="form-control" name="inputPassword" id="inputPassword"
                               placeholder="Introduzca la contraseña" value="admin">
                    </div>
                    <div class="form-group col-md-12 mb-0">
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                            <label class="custom-control-label" for="remember">Recordar</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-sign-in mr-1"></i>
                        Acceder
                    </button>
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


