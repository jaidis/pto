<?php
/**
 * Created by PhpStorm.
 * User: jaidis
 * Date: 29/04/18
 * Time: 17:54
 */
?>
<div class="container-fluid p-0">
    <div class="row bg-main m-0 p-0">
        <div class="col-12 p-0 offset-md-1 col-md-10 offset-xl-2 col-xl-8 my-5">
            <h1 class="center-titles special-title">Contacto</h1>
            <h4 class="mt-5">Si tienes alguna duda o sugerencia y necesitas ponerte en contacto con nosotros puedes rellenar el siguiente formulario, contactaremos contigo en un breve periodo de tiempo.</h4>
        </div>
        <div class="col-12 offset-xl-2 col-xl-8 px-0 mb-5">
            <div class="jumbotron jumbotron-contact">
            <form role="form" id="formContact" autocomplete="off">
                <div class="row">
                    <div class="col-md-4 multi-horizontal">
                        <div class="form-group">
                            <label class="form-control-label" for="contactName">Nombre y apellidos</label>
                            <input type="text" class="form-control" name="contactName" id="contactName">
                        </div>
                    </div>
                    <div class="col-md-4 multi-horizontal">
                        <div class="form-group">
                            <label class="form-control-label" for="contactMail">Email</label>
                            <input type="email" class="form-control" name="contactMail" id="contactMail">
                        </div>
                    </div>
                    <div class="col-md-4 multi-horizontal">
                        <div class="form-group">
                            <label class="form-control-label" for="contactPhone">Teléfono</label>
                            <input type="tel" class="form-control" name="contactPhone" id="contactPhone">
                        </div>
                    </div>
                </div>
                <div class="form-group" data-for="message">
                    <label class="form-control-label" for="contactMessage">Mensaje</label>
                    <textarea type="text" class="form-control" name="contactMessage" rows="5" id="contactMessage" data-toggle="tooltip" data-placement="top" data-html="true" title="El mensaje no podrá superar los 1000 caracteres"></textarea>
                </div>

                <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary btn-lg" id="buttonContact">Enviar formulario</button>
                </span>
            </form>
            </div>
        </div>
    </div>
</div>


