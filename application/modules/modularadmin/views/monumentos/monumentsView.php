<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!empty($monumento))
    echo "<script>var configuracion = $configuracion;</script>";
?>
<article class="content forms-page">
    <div class="title-block">
        <h1 class="title"> <?php echo (!empty($monumento))? 'Editar monumento' : 'Nuevo monumento' ?> </h1>
    </div>
    <section class="section">
        <div class="row sameheight-container">
            <div class="col-12">
                <div class="card" data-exclude="xs">
                    <div class="card-block">
                        <?php if (!empty($monumento)) :?>
                            <form role="form" id="formMonumento" autocomplete="off">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputNombre">Nombre</label>
                                        <input type="text" class="form-control underlined" name="inputNombre" value="<?php echo $monumento->name ?>" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputYear">Año</label>
                                        <input type="number" class="form-control underlined" name="inputYear" value="<?php echo $monumento->year ?>" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputProvincia">Provincia</label>
                                        <select class="form-control" name='inputProvincia' id="inputProvincia" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>>
                                            <option selected></option>
                                            <?php foreach ($provincias as $provinciaItem) {
                                                echo "<option value='$provinciaItem->id'>$provinciaItem->id - $provinciaItem->name - $provinciaItem->map_code</option>";
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputCoordenadaX">Coordenada X</label>
                                        <input type="text" class="form-control underlined" name="inputCoordenadaX" value="<?php echo $monumento->coordenate_x ?>" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputCoordenadaY">Coordenada Y</label>
                                        <input type="text" class="form-control underlined" name="inputCoordenadaY" value="<?php echo $monumento->coordenate_y ?>" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputWeb">Web oficial</label>
                                        <input type="text" class="form-control underlined" name="inputWeb" value="<?php echo $monumento->web ?>" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label for="inputUrl">Url</label>
                                        <input type="text" class="form-control underlined" name="inputUrl" value="<?php echo $monumento->url ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputDate">Fecha registro</label>
                                        <input type="text" class="form-control underlined" name="inputDate" value="<?php echo $monumento->date_creation ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-8" data-toggle="tooltip" data-placement="top" data-html="true" title="Máximo 5.000 caracteres. Para separar por párrafos añadir ';' al final de la línea">
                                        <label for="inputDescription">Descripción monumento</label>
                                        <textarea rows="11" class="form-control underlined" name="inputDescription" maxlength="5000" placeholder="Escribe aquí la descripción" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>><?php echo $monumento->description ?></textarea>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="imgPreview">Imagen monumento</label>
                                        <img src="/assets/img/monuments/<?php echo (!empty($monumento->image_url)) ? $monumento->image_url : 'not-found-1920-1080.jpg' ?>" alt="" class="img-fluid" id="imgPreview">
                                    </div>
                                </div>
                                <div class="form-check p-0 my-2">
                                    <label class="form-check-label" for="active">
                                        <input class="checkbox rounded" type="checkbox" id="active" name="active" <?php echo ($monumento->active == 1) ? 'checked="checked"' : ''  ?>>
                                        <span>Activar monumento</span>
                                    </label>
                                </div>
                                <div class="form-group mt-4 mb-0">
                                    <?php if(!empty($añadir) && $añadir == 1): ?>
                                        <input type="hidden" class="form-control underlined" name="valueImage" id="valueImage" value="">
                                        <input type="hidden" class="form-control underlined" name="idUser" id="idUser" value="<?php echo $user->id ?>">
                                        <input type="hidden" class="form-control underlined" name="inputIdMonumento" id="inputIdMonumento" value="<?php echo $monumento->id ?>">
                                        <button type="submit" class="btn btn-primary rounded" id="monumentoButton"><i class="fa fa-save mr-2"></i>Guardar</button>
                                    <?php endif; ?>
                                </div>
                            </form>
                        <?php else:?>
                            <form role="form" id="formMonumento" autocomplete="off">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputNombre">Nombre</label>
                                        <input type="text" class="form-control underlined" name="inputNombre" placeholder="Alhambra" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputYear">Año</label>
                                        <input type="number" class="form-control underlined" name="inputYear" placeholder="1228" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputProvincia">Provincia</label>
                                        <select class="form-control" name='inputProvincia' id="inputProvincia" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>>
                                            <option selected></option>
                                            <?php foreach ($provincias as $provinciaItem) {
                                                echo "<option value='$provinciaItem->id'>$provinciaItem->id - $provinciaItem->name - $provinciaItem->map_code</option>";
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputCoordenadaX">Coordenada X</label>
                                        <input type="text" class="form-control underlined" name="inputCoordenadaX" placeholder="37.1764323" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputCoordenadaY">Coordenada Y</label>
                                        <input type="text" class="form-control underlined" name="inputCoordenadaY" placeholder="-3.5883435" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputWeb">Web oficial</label>
                                        <input type="text" class="form-control underlined" name="inputWeb" placeholder="https://www.portalturismoyocio.es" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>>
                                    </div>
                                    <div class="form-group col-md-8" data-toggle="tooltip" data-placement="top" data-html="true" title="Máximo 5.000 caracteres. Para separar por párrafos añadir ';' al final de la línea">
                                        <label for="inputDescription">Descripción monumento</label>
                                        <textarea rows="11" class="form-control underlined" name="inputDescription" maxlength="5000" placeholder="Escribe aquí la descripción" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>></textarea>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="imgPreview">Imagen monumento</label>
                                        <img src="/assets/img/monuments/not-found-1920-1080.jpg" alt="" class="img-fluid" id="imgPreview">
                                    </div>
                                </div>
                                <div class="form-check p-0 my-2">
                                    <label class="form-check-label" for="active">
                                        <input class="checkbox rounded" type="checkbox" id="active" name="active">
                                        <span>Activar monumento</span>
                                    </label>
                                </div>
                                <div class="form-group mt-4 mb-0">
                                    <?php if(!empty($añadir) && $añadir == 1): ?>
                                        <input type="hidden" class="form-control underlined" name="valueImage" id="valueImage" value="">
                                        <input type="hidden" class="form-control underlined" name="idUser" id="idUser" value="<?php echo $user->id ?>">
                                        <button type="submit" class="btn btn-primary rounded" id="monumentoButton"><i class="fa fa-save mr-2"></i>Guardar</button>
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