<section class="sitio-main">
	<div class="col-lg-12">
		<form id="frm" method="post" action="<?= base_url('mantenimiento/modificarResponsable') ?>" mothod="POST">
			<?php if (validation_errors()) : ?>
				<div class="alert alert-danger" role="alert">
					<?= validation_errors() ?>
				</div>								
			<?php endif; ?>
			
			<div class="form-group">
				<label>Nombre del Solicitante</label>
				<input type="text" class="form-control" id="solicitante" name="solicitante" value="<?= isset($solicitante) ? $solicitante : "" ?>" readonly />
			</div>
			
			<div class="form-group">
				<label>Ubicacion</label>
				<input type="text" class="form-control" id="sector" name="sector" value="<?= isset($ubicacion) ? $ubicacion : "" ?>" readonly />
			</div>

			<div class="form-group">
				<label>Descripcion del solicitante</label>
				<textarea type="text" class="form-control" placeholder="Descripcion del problema" id="descripcion" name="descripcion" readonly ><?= isset($descripcion) ? $descripcion : "" ?></textarea>
			</div>
			
			<div class="form-group">
				<label>Estado</label>
				<input type="text" class="form-control" id="estado" name="estado" value="<?= isset($estado) ? $estado : "" ?>" readonly />
			</div>
			
			<?php if (isset($estado)) : ?>
				<?php if (substr($estado,0,1) != "P") : ?>
					<div class="form-group">
						<label>Detalle</label>
						<textarea type="text" class="form-control" placeholder="Detalle" id="detalle" name="detalle" readonly ></textarea>
					</div>
				<?php endif; ?>
			
				<?php if (substr($estado,0,1) != "F" && substr($estado,0,1) != "R") : ?>
					<div class="form-group">
						<label>Opciones</label>
						<hr class="separador" />
					</div>

					<!--<div class="form-group">
						<label>Asignar a</label>
						<input type="text" class="form-control" id="estado" name="estado" placeholder="Usuario" />
					</div>-->
					
					<div class="form-group">
						<label>Asignar A</label>
						<?php if (!empty($usuarios)): ?>
							<select class="form-control" id="responsable" name="responsable">
								<?php foreach ($usuarios as $item): ?>
									<option value="<?= $item->id ?>" <?= ($idResponsable==$item->id) ? "selected" : "" ?> ><?= $item->usuario ?></option>
								<?php endforeach; ?>
							</select>
						<?php endif; ?>
					</div>
					
					<button type="submit" class="btn btn-danger derecha" value="enviar" id="guardarPopUp" data-id="<?= isset($id) ? $id : "" ?>">Guardar</button>
					
					<div id="mensajes">

					</div>
					
				<?php endif; ?>
				
			<?php endif; ?>
			
		</form>
	</div>	 	 		
</section>