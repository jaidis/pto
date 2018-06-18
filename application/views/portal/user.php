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
        <div class="col-12 offset-md-1 col-md-10 offset-xl-2 col-xl-8 my-5">
            <h1 class="center-titles special-title">Datos de usuario</h1>
            <h4 class="mt-5">Aquí puedes consultar tus datos de usuario y modificarlos en caso de necesidad, además te invitamos a cambiar tu foto de perfil para que puedan conocerte mejor el resto de usuarios.</h4>
        </div>
        <div class="col-12 offset-xl-2 col-xl-8 mb-5">
            <div class="jumbotron jumbotron-contact">
                <img id="imgPreview" class="profile-img-card mx-auto mb-4" src="/assets/img/users/<?php echo (!empty($user->image_url)) ? $user->image_url : 'user.png' ?>">
            <form role="form" id="formUser" autocomplete="off">
                <div class="row">
                    <div class="col-md-6 multi-horizontal">
                        <div class="form-group">
                            <label class="form-control-label" for="inputFirstName">Nombre</label>
                            <input type="text" class="form-control" value="<?php echo $user->first_name ?>"  maxlength="100" name="inputFirstName" id="inputFirstName">
                        </div>
                    </div>
                    <div class="col-md-6 multi-horizontal">
                        <div class="form-group">
                            <label class="form-control-label" for="inputLastName">Apellidos</label>
                            <input type="text" class="form-control" value="<?php echo $user->last_name ?>"  maxlength="100" name="inputLastName" id="inputLastName">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 multi-horizontal">
                        <div class="form-group">
                            <label class="form-control-label" for="inputUserName">Nombre de usuario</label>
                            <input type="text" class="form-control" value="<?php echo $user->username ?>"  name="inputUserName" id="inputUserName" readonly>
                        </div>
                    </div>
                    <div class="col-md-4 multi-horizontal">
                        <div class="form-group">
                            <label class="form-control-label" for="inputEmail">Email</label>
                            <input type="email" class="form-control"  value="<?php echo $user->email ?>" name="inputEmail" id="inputEmail" readonly>
                        </div>
                    </div>
                    <div class="col-md-4 multi-horizontal">
                        <div class="form-group">
                            <label class="form-control-label" for="inputLastLogin">Último acceso</label>
                            <input type="text" class="form-control"  value="<?php echo $user->last_login ?>" name="inputLastLogin" id="inputLastLogin" readonly>
                        </div>
                    </div>
                </div>
                <span class="input-group-btn">
                    <input type="hidden" class="form-control underlined" name="valueImage" id="valueImage" value="">
                    <input type="hidden" class="form-control underlined" name="idUser" id="idUser" value="<?php echo $user->id ?>">
                    <button type="submit" class="btn btn-primary btn-lg mt-3" id="userButton"><i class="fa fa-save mr-2"></i>Actualizar datos</button>
                </span>
            </form>
                <hr class="my-5"/>
                <form role="form" id="formUpload" autocomplete="off" class="mb-2">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputImage">Imagen (Límite: 360x360 píxeles, Tamaño máximo: 120KB)</label>
                            <input type="file" class="files-image form-control-file underlined" name="inputImage" id="inputImage">
                            <button type="submit" class="btn btn-primary btn-lg rounded mt-4" id="uploadButton"><i class="fa fa-upload mr-2"></i>Subir imagen</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


