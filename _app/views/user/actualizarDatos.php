			<section class="sitio-main">
				<div class="container">
					<div class="col-lg-4 col-md-offset-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								<strong>Cambio de Contrase&ntilde;a</strong>
							</div>
							<div class="panel-body">
								<form id="frmLogin" action="<?= base_url("user/actualizarDatos") ?>" method="POST">
									<?php if (validation_errors()) : ?>
										<div class="alert alert-danger" role="alert">
											<?= validation_errors() ?>
										</div>								
									<?php endif; ?>
									<?php if (isset($error)) : ?>								
										<div class="alert alert-danger" role="alert">
											<?= $error ?>
										</div>
									<?php endif; ?>
									<div class="form-group">
										<label>Contrase&ntilde;a Actual</label>
										<input type="password" class="form-control" placeholder="Actual Contrase&ntilde;a" id="oldPassowrd" name="oldPassword" />
										<span class="help-block">Debe ingresar la Contrase&ntilde;a para poder realizar cualquier accion.</span>
									</div>
									<div class="form-group">
										<label>Nueva Contrase&ntilde;a</label>
										<input type="password" class="form-control" placeholder="Nueva Contrase&ntilde;a" id="newPassowrd" name="newPassword" />
									</div>
									<div class="form-group">
										<label>Repetir Contrase&ntilde;a</label>
										<input type="password" class="form-control" placeholder="Repetir Contrase&ntilde;a" id="new2Passowrd" name="new2Password" />
									</div>
									<div class="form-group">
										<label>Sector</label>
										<input type="text" class="form-control" placeholder="Sector" id="sector" name="sector" value="<?= $_SESSION['sector'] ?>" />
									</div>
									<div class="form-group">
										<label>Correo Electronico</label>
										<input type="text" class="form-control" placeholder="Correo electronico" id="correo" name="correo" value="<?= $_SESSION['mail'] ?>" />
									</div>
									<button type="submit" class="btn btn-danger derecha" value="actualizar">Actualizar</button>
								</form>
							</div>
						</div>
					</div>
				</div>		
			</section>