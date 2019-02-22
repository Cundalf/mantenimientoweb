<section class="sitio-main">
		<div class="col-lg-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Registro de Solicitudes</strong>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-bordered table-hover pointer" id="solicitudes">
						<thead>
							<tr><th>Fecha <span class="fa fa-fw fa-sort"></span></th>
							<th>Nro. Sol. <span class="fa fa-fw fa-sort"></span></th>
							<th>Detalle <span class="fa fa-fw fa-sort"></span></th>
							<th>Responsable <span class="fa fa-fw fa-sort"></span></th>
							<th>Estado <span class="fa fa-fw fa-sort"></span></th></tr>
						</thead>
						
						<tbody>
							<?php if (!empty($solicitudes)): ?>
								<?php foreach ($solicitudes as $item): ?>
									<tr data-id="<?= $item->solicitud ?>">
										<td><?= $item->fecha ?></td>
										<td><?= $item->solicitud ?></td>
										<td><?= $item->descripcion ?></td>
										<td><?= $item->responsable ?></td>
										<td><?= $item->estado ?></td>
									</tr>
								<?php 	endforeach; ?>
							<?php endif; ?>									
						</tbody>                             
					</table>
				</div>
			</div>
		</div>	
		
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">					
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myModalLabel"></h4>
					</div>
					<div class="modal-body">
						
						
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</section>