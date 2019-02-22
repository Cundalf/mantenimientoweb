<section class="sitio-main">
		<div class="col-lg-10 col-md-offset-1">
			<div class="col-lg-7">
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong>Solicitudes a cargo</strong>
					</div>
					<div class="panel-body">
						<table class="table table-striped table-bordered table-hover pointer" id="solicitudPropia">
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
			<div class="col-lg-5">
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong>Gestionar Solicitud</strong>
					</div>
					<div class="panel-body">
						<form id="frmGestion" method="post" action="<?= base_url('mantenimiento/modificarGestion') ?>" mothod="POST">
							<?php if (validation_errors()) : ?>
								<div class="alert alert-danger" role="alert">
									<?= validation_errors() ?>
								</div>								
							<?php endif; ?>
							<?php if(isset($_GET['B'])) : ?>
								<?php if ($_GET['B']==0) : ?>								
									<div class="alert alert-danger" role="alert">
										<?= 'No se pudieron grabar los cambios debido a un error.'; ?>
									</div>
								<?php endif; ?>
								<?php if ($_GET['B']==1) : ?>								
									<div class="alert alert-success" role="alert">
										<?= 'Los cambios fueron guardados correctamente.'; ?>
									</div>
								<?php endif; ?>
							<?php endif; ?>
							
							<div class="form-group">
								<label>Nombre del Solicitante</label>
								<input type="text" class="form-control" id="solicitante" name="solicitante" value="" readonly />
							</div>
							
							<div class="form-group">
								<label>Ubicacion</label>
								<input type="text" class="form-control" id="ubicacion" name="ubicacion" value="" readonly />
							</div>

							<div class="form-group">
								<label>Descripcion del solicitante</label>
								<textarea type="text" class="form-control" placeholder="Descripcion del problema" id="descripcion" name="descripcion" readonly /></textarea>
							</div>
							
							<div class="form-group">
								<label>Estado</label>
								<select class="form-control" id="estado" name="estado">
									<option value="P">Pendiente</option>
									<option value="F">Finalizado</option>
									<option value="R">Rechazado</option>
								</select>
							</div>
							
							<div class="form-group">
								<label>Detalle</label>
								<textarea type="text" class="form-control" placeholder="Detalle" id="detalle" name="detalle"></textarea>
							</div>
							
							<button type="submit" class="btn btn-danger derecha" value="enviar" id="btnEnviarGestion" data-id=''>Enviar</button>
						</form>
					</div>
				</div>
			</div>	 	 
		</div>		
	</section>