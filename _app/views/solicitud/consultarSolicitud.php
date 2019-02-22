	<section class="sitio-main">
		<div class="col-lg-10 col-md-offset-2">
			
			<div class="col-lg-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong>Consulta de Solicitud</strong>
					</div>
					<div class="panel-body">
						<form id="frmConsultarNro" method="post" action="<?= base_url('solicitud/consultarSolicitud') ?>" mothod="POST">
				
							<div class="form-group">
								<label>Nro. Solicitud</label>
								<input type="text" class="form-control" placeholder="Nro. Solicitud" id="solicitud" name="solicitud" />
							</div>
							
							<button type="submit" class="btn btn-danger derecha" value="consultar" id="consultarNro">Consultar</button>
						</form>
					</div>
				</div>
			</div>
			
			<div class="col-lg-5">
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong>Detalle</strong>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label>Fecha</label>
							<input type="text" class="form-control" id="fecha" name="fecha" readonly />
						</div>
						<div class="form-group">
							<label>Solicitante</label>
							<input type="text" class="form-control" id="solicitante" name="solicitante" readonly />
						</div>
						
						<div class="form-group">
							<label>Sector del Solicitante</label>
							<input type="text" class="form-control" id="sector" name="sector" readonly />
						</div>
						
						<div class="form-group">
							<label>Ubicacion</label>
							<input type="text" class="form-control" id="ubicacion" name="ubicacion" readonly />
						</div>
						
						<div class="form-group">
							<label>Descripcion del Problema</label>
							<textarea type="text" class="form-control" id="descripcion" name="descripcion" readonly ></textarea>
						</div>
						
						<div class="form-group">
							<label>Estado</label>
							<input type="text" class="form-control" id="estado" name="estado" readonly />
						</div>
						
						<div class="form-group">
							<label>Resolucion</label>
							<textarea type="text" class="form-control" id="detalle" name="detalle" readonly ></textarea>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>
	