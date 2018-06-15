<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<article class="content dashboard-page" id="permisos">
	<section class="section">
		<div class="row sameheight-container">
			<div class="col col-12 history-col">
				<div class="card" data-exclude="xs" >
					<div class="card-header card-header-sm bordered">
						<div class="header-block">
							<h3 class="title">Permisos</h3>
						</div>
						<ul class="nav nav-tabs pull-right" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" href="#addUser" role="tab" data-toggle="tab">Usuarios</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#addGroup" role="tab" data-toggle="tab">Grupos</a>
							</li>
						</ul>
					</div>
					<div class="card-block">
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active fade show" id="addUser">
								<p class="title-description mb-4"> Formulario para añadir un nuevo usuario</p>
									<form role="form" id="formUser" autocomplete="off">
										<div class="form-row">
											<div class="form-group col-md-6">
											  <label for="inputEmail">Dirección de correo</label>
											  <input type="email" class="form-control underlined" name="inputEmail" placeholder="correo_del_usuario@portal_turismo_y_ocio.es">
											</div>
											<div class="form-group col-md-6" data-toggle="tooltip" data-placement="top" data-html="true" title="El nombre de usuario no podrá contener espacios en blanco">
												<label for="inputUsuario">Usuario</label>
												<input type="text" class="form-control underlined" name="inputUsuario" placeholder="UserExample">
											</div>
                                            <div class="form-group col-md-6">
                                                <label for="inputFirstName">Nombre</label>
                                                <input type="text" class="form-control underlined" name="inputFirstName" placeholder="Nombre completo del usuario">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputLastName">Apellidos</label>
                                                <input type="text" class="form-control underlined" name="inputLastName" placeholder="Apellidos del usuario">
                                            </div>
											<div class="form-group col-md-6">
												<label for="inputPassword">Contraseña</label>
												<input type="password" class="form-control underlined" name="inputPassword" placeholder="Introduzca una contraseña" id="inputPassword">
											</div>
											<div class="form-group col-md-6">
												<label for="inputPasswordDuplicate">Repetir Contraseña</label>
												<input type="password" class="form-control underlined" name="inputPasswordDuplicate" equalTo="#inputPassword" placeholder="Repita la contraseña">
											</div>
											<div class="form-group col-md-6">
												<label for="inputGroup">Grupos disponibles</label>
												<select class="form-control" name='inputGroup' id="inputGroup">
													<option></option>
													<?php foreach ($grupos as $grupo) {
														echo "<option value='$grupo->name'>$grupo->name - $grupo->definition</option>";
													} ?>
												</select>
											</div>
										</div>
										<div class="form-group mt-4 mb-0">
											<input type="hidden" name="inputNewUser" value="1">
											<button type="submit" class="btn btn-primary rounded" id="userButton"><i class="fa fa-save mr-2"></i>Guardar</button>
										</div>
									</form>
									<h3 class="title mt-5">Usuarios registrados</h3>
									<hr/>
									<p class="title-description mb-4"> Listado de usuarios registrados </p>
									<div class="table-responsive">
										<table class="table table-striped table-hover" id="tabla_usuarios">
											<tr>
												<th>Usuarios</th>
												<th>E-Mail</th>
												<th>Grupos</th>
												<th class="text-center">Revocar acceso</th>
												<th class="text-center">Opciones</th>
											</tr>
											<?php foreach($usuarios as $key => $usuario): ?>
												 <tr id="<?php echo $usuario->id; ?>">
													<th><?php echo $usuario->username; ?></th>
													<td><?php echo $usuario->email; ?></th>
													<td><?php echo substr_replace($usuarios_grupos[$key], "", -1); ?>
													<td class="text-center"><label><input class="checkbox" type="checkbox" name="ver" data-table="tabla_usuarios" <?php echo ( $usuario->banned == 1 ? "checked" : "" ); ?> <?php echo ( $usuario->username == 'Admin' ?  "disabled" : "" ); ?> ><span class="m-0 p-0"></span></label></td>
													<td class="text-center"><button type="button" name="button" class="btn btn-danger rounded" data-id="<?php echo $usuario->id ?>" data-user="<?php echo $usuario->username ?>" data-toggle="modal" data-target="#deleteUser" id="deleteUserButton" <?php echo ( $usuario->username == 'Admin' ?  "disabled" : "" ); ?>><i class="fa fa-trash ml-1 mr-2"></i>Borrar</button>	</td>
												</tr>
											<?php endforeach; ?>
										</table>
									</div>
							</div>
							<div role="tabpanel" class="tab-pane fade show" id="addGroup">
								<p class="title-description mb-4"> Formulario para añadir un nuevo grupo</p>
								<form role="form" id="formGroup" autocomplete="off">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="inputGroup">Nombre del grupo</label>
											<input type="text" class="form-control underlined" name="inputGroup" placeholder="Introduce el nombre del grupo">
										</div>
										<div class="form-group col-md-6">
											<label for="inputGroupDescription">Descripción del grupo</label>
											<input type="text" class="form-control underlined" name="inputGroupDescription" placeholder="Introduce la descripción del grupo">
										</div>
										<div class="form-group col-12">
											<table class="table table-striped table-hover" id="tablaNuevoGrupo">
												<tr class="row">
													<th class="col-12 col-md-8" id="inputGroupMirror" data-name="">Permisos que se concederán al nuevo grupo</th>
													<td class="text-center col-12 col-md-1 px-1"><label><input class="checkbox" type="checkbox" name="ver"><span class="m-0 p-0">Ver</span></label></td>
													<td class="text-center col-12 col-md-1 px-1"><label><input class="checkbox" type="checkbox" name="añadir"><span class="m-0 p-0">Añadir</span></label></td>
													<td class="text-center col-12 col-md-1 px-1"><label><input class="checkbox" type="checkbox" name="editar"><span class="m-0 p-0">Editar</span></label></td>
													<td class="text-center col-12 col-md-1 px-1"><label><input class="checkbox" type="checkbox" name="borrar"><span class="m-0 p-0">Borrar</span></label></td>
												</tr>
											</table>
										</div>
									</div>
									<div class="form-group mt-2 mb-0">
										<input type="hidden" name="inputNewGroup" value="1">
										<button type="submit" class="btn btn-primary rounded" id="groupButton"><i class="fa fa-save mr-2"></i>Guardar</button>
									</div>
								</form>
								<h3 class="title mt-5">Grupos registrados</h3>
								<hr/>
								<p class="title-description mb-4"> Listado de los grupos registrados y sus permisos </p>
								<div class="col-md-12 px-0 table-responsive" id="div_permisos">
									<table class="table table-striped table-hover" id="tabla_permisos">
										<tr>
											<th class="col-7">Grupos</th>
											<th class="col-1 text-left">Ver</th>
											<th class="col-1 text-left">Añadir</th>
											<th class="col-1 text-left">Editar</th>
											<th class="col-1 text-left">Borrar</th>
											<th class="col-1 text-center pl-5">Opciones</th>
										</tr>
										<?php foreach($grupos as $key => $grupo): ?>
										<tr id="<?php echo $grupo->name; ?>" >
											<th><?php echo $grupo->name . ' | '. $grupo->definition; ?></th>
											<td class="text-center pr-0"><label><input class="checkbox" type="checkbox" name="ver" data-table="tabla_permisos" <?php echo ( $permisos[$key]->ver == 1 ? "checked" : "" ); ?> <?php echo ( $grupo->name == 'Admin' ?  "disabled" : "" ); ?> ><span class="m-0 p-0"></span></label></td>
											<td class="text-center pr-0"><label><input class="checkbox" type="checkbox" name="añadir" data-table="tabla_permisos" <?php echo ( $permisos[$key]->añadir == 1 ? "checked" : "" ) ; ?> <?php echo ( $grupo->name == 'Admin' ?  "disabled" : "" ); ?> ><span class="m-0 p-0"></span></label></td>
											<td class="text-center pr-0"><label><input class="checkbox" type="checkbox" name="editar" data-table="tabla_permisos" <?php echo ( $permisos[$key]->editar == 1 ? "checked" : "" ) ; ?> <?php echo ( $grupo->name == 'Admin' ?  "disabled" : "" ); ?> ><span class="m-0 p-0"></span></label></td>
											<td class="text-center pr-0"><label><input class="checkbox" type="checkbox" name="borrar" data-table="tabla_permisos" <?php echo ( $permisos[$key]->borrar == 1 ? "checked" : "" ) ; ?> <?php echo ( $grupo->name == 'Admin' ?  "disabled" : "" ); ?> ><span class="m-0 p-0"></span></label></td>
											<td class="text-center pl-5"><button type="button" name="button" class="btn btn-danger rounded" data-id="<?php echo $grupo->id ?>" data-group="<?php echo $grupo->name ?>" data-toggle="modal" data-target="#deleteGroup" id="deleteGroupButton" <?php echo ( $grupo->name == 'Admin' || $grupo->name == 'Default')  ?  "disabled" : "" ; ?>><i class="fa fa-trash ml-1 mr-2"></i>Borrar</button>	</td>
										</tr>
										<?php endforeach; ?>
									</table>
									<!-- <button class="btn btn-primary rounded" type="button" name="button" id="recarga"><i class="fa fa-refresh ml-1 mr-2"></i> Recargar</button> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</article>
<article>
	<section>
		<div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="deleteUser" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="deleteUserLabel">Eliminar Usuario</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        ¿Está seguro de borrar a <strong id="infoUsuario">usuario</strong> de la base de datos? No es posible deshacer este cambio.
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn rounded btn-secondary" data-dismiss="modal" id="closeModal">Cerrar</button>
						<form role="form" id="formDeleteUser">
							<input type="hidden" name="idUser" value="" id="idUser">
							<button type="submit" class="btn rounded btn-danger"><i class="fa fa-trash ml-1 mr-2"></i>Borrar</button>
						</form>
		      </div>
		    </div>
		  </div>
		</div>
	</section>
</article>
<article>
	<section>
		<div class="modal fade" id="deleteGroup" tabindex="-1" role="dialog" aria-labelledby="deleteGroup" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="deleteGroupLabel">Eliminar Grupo</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        ¿Está seguro de borrar a <strong id="infoGrupo">grupo</strong> de la base de datos? No es posible deshacer este cambio.
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn rounded btn-secondary" data-dismiss="modal" id="closeModalGroup">Cerrar</button>
						<form role="form" id="formDeleteGroup">
							<input type="hidden" name="idGroup" value="" id="idGroup">
							<button type="submit" class="btn rounded btn-danger"><i class="fa fa-trash ml-1 mr-2"></i>Borrar</button>
						</form>
		      </div>
		    </div>
		  </div>
		</div>
	</section>
</article>
