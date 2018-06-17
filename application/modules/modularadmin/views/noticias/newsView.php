<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!empty($noticia))
    echo "<script>var configuracion = $configuracion;</script>";
?>
<article class="content forms-page">
    <div class="title-block">
        <h1 class="title"> <?php echo (!empty($noticia))? 'Editar noticia' : 'Nueva noticia' ?> </h1>
    </div>
    <section class="section">
        <div class="row sameheight-container">
            <div class="col-12">
                <div class="card" data-exclude="xs">
                    <div class="card-block">
                        <?php if (!empty($noticia)) :?>
                            <form role="form" id="formNoticia" autocomplete="off">
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputTitle">Título de la noticia</label>
                                        <input type="text" class="form-control underlined" name="inputTitle" maxlength="255" value="<?php echo $noticia->title ?>" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>>
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
                                    <div class="form-group col-md-12" data-toggle="tooltip" data-placement="top" data-html="true" title="Máximo 400 caracteres">
                                        <label for="inputSubtitle">Subtítulo de la noticia</label>
                                        <input type="text" class="form-control underlined" name="inputSubtitle" maxlength="400" value="<?php echo $noticia->subtitle ?>" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label for="inputUrl">Url</label>
                                        <input type="text" class="form-control underlined" name="inputUrl" value="<?php echo $noticia->url ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputDate">Fecha registro</label>
                                        <input type="text" class="form-control underlined" name="inputDate" value="<?php echo $noticia->date_creation ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-8" data-toggle="tooltip" data-placement="top" data-html="true" title="Máximo 5.000 caracteres. Para separar por párrafos añadir ';' al final de la línea">
                                        <label for="inputDescription">Descripción de la noticia</label>
                                        <textarea rows="11" class="form-control underlined" name="inputDescription" maxlength="5000" placeholder="Escribe aquí la descripción de la noticia" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>><?php echo $noticia->description ?></textarea>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="imgPreview">Imagen noticia</label>
                                        <img src="/assets/img/news/<?php echo (!empty($noticia->image_url)) ? $noticia->image_url : 'not-found-1920-1080.jpg' ?>" alt="" class="img-fluid" id="imgPreview">
                                    </div>
                                </div>
                                <div class="form-check p-0 my-2">
                                    <label class="form-check-label" for="active">
                                        <input class="checkbox rounded" type="checkbox" id="active" name="active" <?php echo ($noticia->active == 1) ? 'checked="checked"' : ''  ?>>
                                        <span>Activar noticia</span>
                                    </label>
                                </div>
                                <div class="form-group mt-4 mb-0">
                                    <?php if(!empty($añadir) && $añadir == 1): ?>
                                        <input type="hidden" class="form-control underlined" name="valueImage" id="valueImage" value="">
                                        <input type="hidden" class="form-control underlined" name="idUser" id="idUser" value="<?php echo $user->id ?>">
                                        <input type="hidden" class="form-control underlined" name="inputIdNoticia" id="inputIdNoticia" value="<?php echo $noticia->id ?>">
                                        <button type="submit" class="btn btn-primary rounded" id="noticiaButton"><i class="fa fa-save mr-2"></i>Guardar</button>
                                    <?php endif; ?>
                                </div>
                            </form>
                        <?php else:?>
                            <form role="form" id="formNoticia" autocomplete="off">
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputTitle">Título de la noticia</label>
                                        <input type="text" class="form-control underlined" name="inputTitle" maxlength="255" placeholder="Titular de la noticia" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>>
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
                                    <div class="form-group col-md-12" data-toggle="tooltip" data-placement="top" data-html="true" title="Máximo 400 caracteres">
                                        <label for="inputSubtitle">Subtítulo de la noticia</label>
                                        <input type="text" class="form-control underlined" name="inputSubtitle" maxlength="400" placeholder="Subtítular de la noticia" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>>
                                    </div>
                                    <div class="form-group col-md-8" data-toggle="tooltip" data-placement="top" data-html="true" title="Máximo 5.000 caracteres. Para separar por párrafos añadir ';' al final de la línea">
                                        <label for="inputDescription">Descripción de la noticia</label>
                                        <textarea rows="11" class="form-control underlined" name="inputDescription" maxlength="5000" placeholder="Escribe aquí la descripción de la noticia" <?php if(!empty($ver) && $ver == 1 && empty($añadir) && empty($editar) && empty($borrar)) echo 'readonly' ?>></textarea>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="imgPreview">Imagen noticia</label>
                                        <img src="/assets/img/news/not-found-1920-1080.jpg" alt="" class="img-fluid" id="imgPreview">
                                    </div>
                                </div>
                                <div class="form-check p-0 my-2">
                                    <label class="form-check-label" for="active">
                                        <input class="checkbox rounded" type="checkbox" id="active" name="active">
                                        <span>Activar noticia</span>
                                    </label>
                                </div>
                                <div class="form-group mt-4 mb-0">
                                    <?php if(!empty($añadir) && $añadir == 1): ?>
                                        <input type="hidden" class="form-control underlined" name="valueImage" id="valueImage" value="">
                                        <input type="hidden" class="form-control underlined" name="idUser" id="idUser" value="<?php echo $user->id ?>">
                                        <button type="submit" class="btn btn-primary rounded" id="noticiaButton"><i class="fa fa-save mr-2"></i>Guardar</button>
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

                        <div id="comentario_section">
                            <?php if(!empty($borrar) && $borrar == 1 && !empty($comentarios)): ?>
                                <hr class="my-5"/>
                                <h1 class="title mb-4"> Lista de comentarios </h1>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover text-center" id="tablaComentarios">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Autor</th>
                                            <th>Mensaje</th>
                                            <th>Fecha mensaje</th>
                                            <th>IP cliente</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($comentarios as $comentario):?>
                                            <tr>
                                                <td><?php echo $comentario->nc_id ?></td>
                                                <td><?php echo $comentario->username ?></td>
                                                <td><?php echo $comentario->message ?></td>
                                                <td><?php echo $comentario->date_creation ?></td>
                                                <td><?php echo $comentario->ip_address ?></td>
                                                <td>
                                                    <button type="button" class="btn rounded btn-danger btn-block" data-id="<?php echo $comentario->nc_id ?>" data-title="<?php echo $comentario->message ?>" data-toggle="modal" data-target="#deleteComentario" id="deleteComentarioButton"><i class="fa fa-trash ml-1 mr-2"></i>Borrar</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>
<article>
    <section>
        <div class="modal fade" id="deleteComentario" tabindex="-1" role="dialog" aria-labelledby="deleteComentario" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteComentarioLabel">Eliminar comentario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Está seguro de borrar a <strong id="infoComentario">comentario</strong> de la base de datos? No es posible deshacer este cambio.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn rounded btn-secondary" data-dismiss="modal" id="closeModal">Cerrar</button>
                        <form role="form" id="formDeleteComentario">
                            <input type="hidden" name="idComment" value="" id="idComment">
                            <button type="submit" class="btn rounded btn-danger"><i class="fa fa-trash ml-1 mr-2"></i>Borrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>