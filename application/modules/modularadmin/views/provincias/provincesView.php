<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<article class="content forms-page">
    <div class="title-block">
        <h1 class="title"> <?php echo (!empty($provincia))? 'Editar provincia' : 'Nueva provincia' ?> </h1>
    </div>
    <section class="section">
        <div class="row sameheight-container">
            <div class="col-12">
                <div class="card" data-exclude="xs">
                    <div class="card-block">
                        <?php if (!empty($provincia)) :?>
                            <form role="form" id="formProvincia" autocomplete="off">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputNombre">Nombre</label>
                                        <input type="text" class="form-control underlined" name="inputNombre" value="<?php echo $provincia->name ?>" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputMapCode">Código mapa</label>
                                        <input type="text" class="form-control underlined" name="inputMapCode" value="<?php echo $provincia->map_code ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputDate">Fecha registro</label>
                                        <input type="text" class="form-control underlined" name="inputDate" value="<?php echo $provincia->date_creation ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-8" data-toggle="tooltip" data-placement="top" data-html="true" title="Máximo 5.000 caracteres. Para separar por párrafos añadir ';' al final de la línea">
                                        <label for="inputDescription">Descripción provincia</label>
                                        <textarea rows="11" class="form-control underlined" name="inputDescription" maxlength="5000" placeholder="Escribe aquí la descripción" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>><?php echo $provincia->description ?></textarea>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="imgPreview">Imagen provincia</label>
                                        <img src="/assets/img/province/<?php echo (!empty($provincia->image_url)) ? $provincia->image_url : 'not-found-1920-1080.jpg' ?>" alt="" class="img-fluid" id="imgPreview">
                                    </div>
                                </div>
                                <div class="form-check p-0 my-2">
                                    <label class="form-check-label" for="active" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>>
                                        <input class="checkbox rounded" type="checkbox" id="active" name="active" <?php echo ($provincia->active == 1) ? 'checked="checked"' : ''  ?>>
                                        <span>Activar provincia</span>
                                    </label>
                                </div>
                                <div class="form-group mt-4 mb-0">
                                    <?php if(!empty($añadir) && $añadir == 1): ?>
                                        <input type="hidden" class="form-control underlined" name="valueImage" id="valueImage" value="">
                                        <input type="hidden" class="form-control underlined" name="inputIdProvincia" id="inputIdProvincia" value="<?php echo $provincia->id ?>">
                                        <button type="submit" class="btn btn-primary rounded" id="provinciaButton"><i class="fa fa-save mr-2"></i>Guardar</button>
                                    <?php endif; ?>
                                </div>
                            </form>
                        <?php else:?>
                            <form role="form" id="formProvincia" autocomplete="off">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputNombre">Nombre</label>
                                        <input type="text" class="form-control underlined" name="inputNombre" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputMapCode">Código mapa</label>
                                        <input type="text" class="form-control underlined" name="inputMapCode" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>>
                                    </div>
                                    <div class="form-group col-md-8" data-toggle="tooltip" data-placement="top" data-html="true" title="Máximo 5.000 caracteres. Para separar por párrafos añadir ';' al final de la línea">
                                        <label for="inputDescription">Descripción provincia</label>
                                        <textarea rows="11" class="form-control underlined" name="inputDescription" maxlength="5000" placeholder="Escribe aquí la descripción" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>></textarea>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputProvince">Imagen provincia</label>
                                        <img src="/assets/img/province/not-found-1920-1080.jpg" alt="" class="img-fluid" id="imgPreview">
                                    </div>
                                </div>
                                <div class="form-check p-0 my-2">
                                    <label class="form-check-label" for="active">
                                        <input class="checkbox rounded" type="checkbox" id="active" name="active">
                                        <span>Activar provincia</span>
                                    </label>
                                </div>
                                <div class="form-group mt-4 mb-0">
                                    <?php if(!empty($añadir) && $añadir == 1): ?>
                                        <input type="hidden" class="form-control underlined" name="valueImage" id="valueImage" value="">
                                        <button type="submit" class="btn btn-primary rounded" id="provinciaButton"><i class="fa fa-save mr-2"></i>Guardar</button>
                                    <?php endif; ?>
                                </div>
                            </form>
                        <?php endif;?>

                        <?php if(!empty($añadir) && $añadir == 1): ?>
                            <hr class="my-5"/>
                            <form role="form" id="formUpload" autocomplete="off" class="mb-2">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputImage">Imagen (Límite: 2500x2500 píxeles, Tamaño: 5MB)</label>
                                        <input type="file" class="files-image form-control-file underlined" name="inputImage" id="inputImage">
                                        <button type="submit" class="btn btn-primary rounded mt-4" id="uploadButton"><i class="fa fa-upload mr-2"></i>Subir imagen</button>
                                    </div>
                                </div>
                            </form>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>