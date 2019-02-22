			<section class="sitio-main">
				<div class="container">
					<div class="col-lg-4 col-md-offset-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								<strong>Restablecer Contrase&ntilde;a</strong>
							</div>
							<div class="panel-body">
								<form id="frmLogin" action="<?= base_url("user/restablecerPassword") ?>" method="POST">
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
										<label>Usuario</label>
										<input type="text" class="form-control" placeholder="Usuario" id="usuario" name="usuario" />
									</div>
									<div class="form-group">
										<label>Correo electronico</label>
										<input type="text" class="form-control" placeholder="Correo electronico" id="correo" name="correo" />
									</div>
									<div class="row">
										<button type="submit" class="btn btn-danger derecha" value="login">Enviar</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>		
			</section>