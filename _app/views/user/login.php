			<section class="sitio-main">
				<div class="container">
					<div class="col-lg-4 col-md-offset-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								<strong>Ingreso</strong>
							</div>
							<div class="panel-body">
								<form id="frmLogin" action="<?= base_url("user/login") ?>" method="POST">
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
										<input type="text" class="form-control" placeholder="Usuario" id="username" name="username" />
									</div>
									<div class="form-group">
										<label>Contrase&ntilde;a</label>
										<input type="password" class="form-control" placeholder="Contrase&ntilde;a" id="passowrd" name="password" autocomplete="off" />
									</div>
									<div class="row">
										<a href="<?= base_url('user/restablecerPassword') ?>">¿Ha olvidado la contrase&ntilde;a?</a>
										<button type="submit" class="btn btn-danger derecha" value="login">Ingresar</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>		
			</section>