<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<article class="content dashboard-page">
    <div class="title-block">
        <h1 class="title"> Listado de gastronomias </h1>
    </div>
    <section class="section">
        <div class="row sameheight-container">
            <div class="col-12">
                <div class="card" data-exclude="xs">
                    <div class="card-block">
                        <div class="title-block">
                            <section class="example" id="gastronomia_section">
                                <?php if (!empty($gastronomias)): ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover text-center" id="tablaGastronomias">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Provincia</th>
                                                <th>Autor</th>
                                                <th>Fecha de registro</th>
                                                <th>Activo</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($gastronomias as $gastronomia):?>
                                                <tr>
                                                    <td><?php echo $gastronomia->id ?></td>
                                                    <td><?php echo $gastronomia->name ?></td>
                                                    <td><?php echo $gastronomia->province_name ?></td>
                                                    <td><?php echo $gastronomia->user_name ?></td>
                                                    <td><?php echo $gastronomia->date_creation ?></td>
                                                    <td><?php echo $gastronomia->active == 1 ? 'Si' : '<strong class="text-danger"> No </strong>' ?></td>
                                                    <td>
                                                        <?php if(!empty($ver) && $ver == 1 && empty($editar) && empty($borrar)): ?>
                                                            <a href="/pto-admin/gastronomias/edit/<?php echo $gastronomia->id ?>" style="text-decoration:none;"><button type="button" class="btn rounded btn-primary btn-block text-white"><i class="fa fa-info-circle ml-1 mr-2"></i>Info</button></a>
                                                        <?php elseif(!empty($editar) && $editar == 1 && empty($borrar)): ?>
                                                            <a href="/pto-admin/gastronomias/edit/<?php echo $gastronomia->id ?>" style="text-decoration:none;"><button type="button" class="btn rounded btn-warning btn-block text-white"><i class="fa fa-pencil-square-o ml-1 mr-2"></i>Editar</button></a>
                                                        <?php elseif(!empty($borrar) && $borrar == 1): ?>
                                                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                                <div class="btn-group" role="group">
                                                                    <button id="btnGroupDrop1" type="button" class="btn dropdown-toggle btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fa fa-cog ml-1 mr-2"></i>Opciones
                                                                    </button>
                                                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                                        <a href="/pto-admin/gastronomias/edit/<?php echo $gastronomia->id ?>" style="text-decoration:none;"><button type="button" class="btn rounded btn-warning btn-block text-white"><i class="fa fa-pencil-square-o ml-1 mr-2"></i>Editar</button></a>
                                                                        <button type="button" class="btn rounded btn-danger btn-block" data-id="<?php echo $gastronomia->id ?>" data-name="<?php echo $gastronomia->name ?>" data-toggle="modal" data-target="#deleteGastronomia" id="deleteGastronomiaButton"><i class="fa fa-trash ml-1 mr-2"></i>Borrar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php
                                            endforeach;
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else: ?>
                                    <div class="col-12 p-0">
                                        <h3 class="my-3"><em>No existen registros</em></h3>
                                    </div>
                                <?php endif; ?>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>
<article>
    <section>
        <div class="modal fade" id="deleteGastronomia" tabindex="-1" role="dialog" aria-labelledby="deleteGastronomia" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteGastronomiaLabel">Eliminar gastronomía</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Está seguro de borrar a <strong id="infoGastronomia">gastronomia</strong> de la base de datos? No es posible deshacer este cambio.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn rounded btn-secondary" data-dismiss="modal" id="closeModal">Cerrar</button>
                        <form role="form" id="formDeleteGastronomia">
                            <input type="hidden" name="idGastronomy" value="" id="idGastronomy">
                            <button type="submit" class="btn rounded btn-danger"><i class="fa fa-trash ml-1 mr-2"></i>Borrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>