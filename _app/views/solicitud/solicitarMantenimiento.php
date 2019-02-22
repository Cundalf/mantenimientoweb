	<section class="sitio-main">
		<div class="col-lg-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Solicitud de Mantenimiento</strong>
				</div>
				<div class="panel-body">
					<form id="frm" method="post" action="<?= base_url('solicitud/guardarSolicitud') ?>" mothod="POST">
						<?php if (validation_errors()) : ?>
							<div class="alert alert-danger" role="alert">
								<?= validation_errors() ?>
							</div>								
						<?php endif; ?>
						<?php if(isset($_GET['B'])) : ?>
							<?php if ($_GET['B']==0) : ?>								
								<div class="alert alert-danger" role="alert">
									<?= 'No se pudo grabar la solicitud debido a un error.'; ?>
								</div>
							<?php endif; ?>
							<?php if ($_GET['B']>0) : ?>								
								<div class="alert alert-success" role="alert">
									<?= 'La solicitud con numero '.$_GET['B'].'. Fue guardada correctamente.'; ?>
								</div>
							<?php endif; ?>
						<?php endif; ?>
						<div class="form-group">
							<label>Solicitante</label>
							<input type="text" class="form-control" placeholder="Solicitante" id="solicitante" name="solicitante" />
						</div>
						
						<div class="form-group">
							<label>Sector del Solicitante</label>
							<input type="text" class="form-control" placeholder="Sector" id="sector" name="sector" />
						</div>
						
						<div class="form-group">
							<label>Ubicacion Fisica</label>
							<input type="text" class="form-control" placeholder="Ubicacion del problema" id="ubicacion" name="ubicacion" />
						</div>
						
						<div class="form-group">
							<label>Nro de Interno</label>
							<input type="text" class="form-control" placeholder="Nro de Interno o Contacto" id="interno" name="interno" />
						</div>
						
						<div class="form-group">
							<label>Descripcion</label>
							<textarea type="text" class="form-control" placeholder="Descripcion del problema" id="descripcion" name="descripcion" ></textarea>
						</div>
						
						<button type="submit" class="btn btn-danger derecha" value="enviar">Enviar</button>
					</form>
				</div>
			</div>
		</div>	 	
	</section>
	