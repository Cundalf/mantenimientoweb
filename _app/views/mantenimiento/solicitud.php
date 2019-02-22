	<section class="sitio-main">
		<div class="col-lg-10 col-md-offset-1">
			<div class="col-lg-5">
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong>Solicitud de Mantenimiento</strong>
					</div>
					<div class="panel-body">
						<form id="frm" method="post" action="<?= base_url('mantenimiento/guardarSolicitud') ?>" mothod="POST">
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
								<label>Nombre del Solicitante</label>
								<input type="text" class="form-control" id="solicitante" name="solicitante" value="<?= $this->session->userdata('username') ?>" readonly />
							</div>
							
							<div class="form-group">
								<label>Sector del Solicitante</label>
								<input type="text" class="form-control" id="sector" name="sector" value="<?= $this->session->userdata('sector') ?>" readonly />
							</div>
							
							<div class="form-group">
								<label>Ubicacion Fisica</label>
								<input type="text" class="form-control" placeholder="Ubicacion del problema" id="ubicacion" name="ubicacion" />
							</div>
							
							<div class="form-group">
								<label>Nro de Interno</label>
								<input type="text" class="form-control" placeholder="Nro de Interno" id="interno" name="interno" />
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
			<div class="col-lg-7">
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong>Solicitudes Anteriores</strong>
					</div>
					<div class="panel-body">
						<table class="table table-striped table-bordered table-hover pointer" id="solicitudesPropias">
							<thead>
								<tr><th>Fecha <span class="fa fa-fw fa-sort"></span></th>
								<th>Nro. Sol. <span class="fa fa-fw fa-sort"></span></th>
								<th>Detalle <span class="fa fa-fw fa-sort"></span></th>
								<th>Estado <span class="fa fa-fw fa-sort"></span></th></tr>
							</thead>
							
							<tbody>
								<?php if (!empty($solicitudes)): ?>
									<?php foreach ($solicitudes as $item): ?>
										<tr data-id="<?= $item->solicitud ?>">
											<td><?= $item->fecha ?></td>
											<td><?= $item->solicitud ?></td>
											<td><?= $item->descripcion ?></td>
											<td><?= $item->estado ?></td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>									
							</tbody>
						</table>
					</div>
				</div>
			</div>	 
		</div>		
	</section>
	