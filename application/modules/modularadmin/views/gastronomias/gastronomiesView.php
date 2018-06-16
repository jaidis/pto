<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!empty($gastronomia))
    echo "<script>var configuracion = $configuracion;</script>";
?>
<article class="content forms-page">
    <div class="title-block">
        <h1 class="title"> <?php echo (!empty($gastronomia))? 'Editar gastronomía' : 'Nueva gastronomía' ?> </h1>
    </div>
    <section class="section">
        <div class="row sameheight-container">
            <div class="col-12">
                <div class="card" data-exclude="xs">
                    <div class="card-block">
                        <?php if (!empty($gastronomia)) :?>
                            <form role="form" id="formGastronomia" autocomplete="off">
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputNombre">Nombre</label>
                                        <input type="text" class="form-control underlined" name="inputNombre" value="<?php echo $gastronomia->name ?>" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputProvincia">Provincia</label>
                                        <select class="form-control" name='inputProvincia' id="inputProvincia" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>>
                                            <option selected></option>
                                            <option value='0'>0 - Sin asociar</option>
                                            <?php foreach ($provincias as $provinciaItem) {
                                                echo "<option value='$provinciaItem->id'>$provinciaItem->id - $provinciaItem->name - $provinciaItem->map_code</option>";
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3" data-toggle="tooltip" data-placement="top" data-html="true" title="Máximo 1.000 caracteres. Para separar por líneas añadir ';' al final de cada ingrediente">
                                        <label for="inputIngredientes">Ingredientes gastronomía</label>
                                        <textarea rows="11" class="form-control underlined" name="inputIngredientes" maxlength="1000" placeholder="Patatas;Huevos;Tomates" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>><?php echo $gastronomia->ingredients ?></textarea>
                                    </div>
                                    <div class="form-group col-md-5" data-toggle="tooltip" data-placement="top" data-html="true" title="Máximo 5.000 caracteres. Para separar por párrafos añadir ';' al final de la línea">
                                        <label for="inputElaboracion">Elaboración gastronomía</label>
                                        <textarea rows="11" class="form-control underlined" name="inputElaboracion" maxlength="5000" placeholder="Escribe aquí la elaboración de la gastronomía" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>><?php echo $gastronomia->elaboration ?></textarea>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="imgPreview">Imagen gastronomía</label>
                                        <img src="/assets/img/gastronomies/<?php echo (!empty($gastronomia->image_url)) ? $gastronomia->image_url : 'not-found-1920-1080.jpg' ?>" alt="" class="img-fluid" id="imgPreview">
                                    </div>
                                </div>
                                <div class="form-check p-0 my-2">
                                    <label class="form-check-label" for="active">
                                        <input class="checkbox rounded" type="checkbox" id="active" name="active" <?php echo ($gastronomia->active == 1) ? 'checked="checked"' : ''  ?>>
                                        <span>Activar gastronomía</span>
                                    </label>
                                </div>
                                <div class="form-group mt-4 mb-0">
                                    <?php if(!empty($añadir) && $añadir == 1): ?>
                                        <input type="hidden" class="form-control underlined" name="valueImage" id="valueImage" value="">
                                        <input type="hidden" class="form-control underlined" name="idUser" id="idUser" value="<?php echo $user->id ?>">
                                        <input type="hidden" class="form-control underlined" name="inputIdGastronomia" id="inputIdGastronomia" value="<?php echo $gastronomia->id ?>">
                                        <button type="submit" class="btn btn-primary rounded" id="gastronomiaButton"><i class="fa fa-save mr-2"></i>Guardar</button>
                                    <?php endif; ?>
                                </div>
                            </form>
                        <?php else:?>
                            <form role="form" id="formGastronomia" autocomplete="off">
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputNombre">Nombre</label>
                                        <input type="text" class="form-control underlined" name="inputNombre" placeholder="Nombre de la gastronomía" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputProvincia">Provincia</label>
                                        <select class="form-control" name='inputProvincia' id="inputProvincia" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>>
                                            <option selected></option>
                                            <option value='0'>0 - Sin asociar</option>
                                            <?php foreach ($provincias as $provinciaItem) {
                                                echo "<option value='$provinciaItem->id'>$provinciaItem->id - $provinciaItem->name - $provinciaItem->map_code</option>";
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3" data-toggle="tooltip" data-placement="top" data-html="true" title="Máximo 1.000 caracteres. Para separar por líneas añadir ';' al final de cada ingrediente">
                                        <label for="inputIngredientes">Ingredientes gastronomía</label>
                                        <textarea rows="11" class="form-control underlined" name="inputIngredientes" maxlength="1000" placeholder="Patatas;Huevos;Tomates" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>></textarea>
                                    </div>
                                    <div class="form-group col-md-5" data-toggle="tooltip" data-placement="top" data-html="true" title="Máximo 5.000 caracteres. Para separar por párrafos añadir ';' al final de la línea">
                                        <label for="inputElaboracion">Elaboración gastronomía</label>
                                        <textarea rows="11" class="form-control underlined" name="inputElaboracion" maxlength="5000" placeholder="Escribe aquí la elaboración de la gastronomía" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>></textarea>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="imgPreview">Imagen gastronomía</label>
                                        <img src="/assets/img/gastronomies/not-found-1920-1080.jpg" alt="" class="img-fluid" id="imgPreview">
                                    </div>
                                </div>
                                <div class="form-check p-0 my-2">
                                    <label class="form-check-label" for="active">
                                        <input class="checkbox rounded" type="checkbox" id="active" name="active">
                                        <span>Activar gastronomía</span>
                                    </label>
                                </div>
                                <div class="form-group mt-4 mb-0">
                                    <?php if(!empty($añadir) && $añadir == 1): ?>
                                        <input type="hidden" class="form-control underlined" name="valueImage" id="valueImage" value="">
                                        <input type="hidden" class="form-control underlined" name="idUser" id="idUser" value="<?php echo $user->id ?>">
                                        <button type="submit" class="btn btn-primary rounded" id="gastronomiaButton"><i class="fa fa-save mr-2"></i>Guardar</button>
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