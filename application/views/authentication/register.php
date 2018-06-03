<?php
/**
 * Created by PhpStorm.
 * User: jaidis
 * Date: 01/06/18
 * Time: 12:00
 */
?>
<div class="container p-0">

    <div class="col-login col-11 col-md-6">
        <div class="card card-login p-4">
            <!--<h3 class="mt-3 mb-4 text-center">Nuevo registro</h3>-->
            <img id="profile-img" class="profile-img-card-2 mx-auto" src="/assets/img/pto.png"/>
            <hr class="mb-3"/>
            <form role="form" id="loginRegister" autocomplete="off">
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="inputNombre">Nombre</label>
                        <input type="text" class="form-control" name="inputNombre" id="inputNombre"
                               placeholder="Introduzca el nombre">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="inputApellidos">Apellidos</label>
                        <input type="text" class="form-control" name="inputApellidos" id="inputApellidos"
                               placeholder="Introduzca los apellidos">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="inputEmailRegistro">Correo electrónico</label>
                        <input type="email" class="form-control" id="inputEmailRegistro"
                               name="inputEmailRegistro"
                               placeholder="Introduzca el correo electrónico">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="inputUser">Usuario</label>
                        <input type="text" class="form-control" id="inputUser"
                               name="inputUser"
                               placeholder="Introduzca el usuario"
                               data-toggle="tooltip" data-placement="bottom" data-html="true"
                               title="El nombre de usuario no podrá contener espacios en blanco">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="inputPasswordRegistro">Contraseña</label>
                        <input type="password" class="form-control" id="inputPasswordRegistro"
                               name="inputPasswordRegistro"
                               placeholder="Introduzca la contraseña"
                               data-toggle="tooltip" data-placement="bottom" data-html="true"
                               title="La contraseña tendrá como mínimo 5 caracteres y como máximo 13 caracteres">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="inputPasswordDuplicateRegistro">Repetir Contraseña</label>
                        <input type="password" class="form-control" id="inputPasswordDuplicateRegistro"
                               name="inputPasswordDuplicateRegistro"
                               equalTo="#inputPasswordRegistro"
                               placeholder="Introduzca de nuevo la contraseña">
                    </div>
                    <div class="form-group col-md-12 mb-0">
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="accepted" name="accepted">
                            <label for="accepted" class="custom-control-label">
                                He leído la <a href="#" style="text-decoration: none;">política de privacidad</a>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="registerButton"><i
                                class="fa fa-check mr-1"></i>
                        Registrarse
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


