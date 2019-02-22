$('document').ready(function(){
	
	$('#solicitudes tbody tr').on('click', function() {
		var id = $(this).data('id');
	
		$.ajax({
			url: "verSolicitud/" + id,
			method: "POST",
			dataType: "html"
		}).done(function(data){
			$('#myModalLabel').html("Detalle de Solicitud Nro. " + id);
			$("#myModal .modal-content .modal-body").html(data);	
			$('#myModal').modal();
			$('#guardarPopUp').unbind('click');
			$('#guardarPopUp').bind('click',guardarPop);
		});
	});
	
	function guardarPop() {
		var id = $('#guardarPopUp').data('id');
		
		$.ajax({
			url: "modificarResponsable",
			method: "POST",
			dataType: "html",
			data : {
				'id' : id,
				'responsable' : $('#responsable').val()
			}
		}).done(function(data){
			if(data == ""){
				alert("Se asigno el responsable correctamente.");
			}else{
				alert(data);
			}
		});
		return false;
	}
	
	$('#solicitudPropia tbody tr').on('click', function() {
		var id = $(this).data('id');
	
		$.ajax({
			url: "mantenimiento/getSolicitudPendiente",
			method: "POST",
			dataType: "json",
			data : { 'id' : id }
		}).done(function(data){
			$('#solicitante').val(data['usuario']);
			$('#ubicacion').val(data['ubicacion']);
			$('#descripcion').val(data['descripcion']);
			$('#detalle').val(data['detalle']);
			//$('#estado option[value='+ data['estado'].substring(0, 1) +']').attr('selected','selected');
			$("#estado option[value='" + data["estado"].substring(0, 1) + "']").attr("selected",true);
			$('#btnEnviarGestion').attr('data-id',id);
			
		});
	});
	
	$('#frmGestion').submit(function(e) {
		e.preventDefault();
		
		var id = $('#btnEnviarGestion').data('id');
		
		$.ajax({
			url: "mantenimiento/modificarGestion",
			method: "POST",
			dataType: "html",
			data : { 
				'id' 	  : id,
				'estado'  : $('#estado').val(),
				'detalle' : $('#detalle').val()}
				
		}).done(function(data){
			if(data == ""){
				alert("Los cambios han sidos guardados.");
			}else{
				alert(data);
			}
			
		});
		return false;
	});
	
	$('#frmConsultarNro').submit(function(e) {
		e.preventDefault();
		var id = $('#solicitud').val();

		if(id == '' || $.isNumeric(id)==false ){
			alert('Debe ingresar un numero de solicitud correcto.');
		}else{
			$.ajax({
				url: "consultarSolicitud",
				method: "POST",
				dataType: "json",
				data : { 'id' : id }
			}).done(function(data){
				
				if(data['status'] == true){
					$('#fecha').val(data['data']['fecha']);
					$('#solicitante').val(data['data']['usuario']);
					$('#sector').val(data['data']['sector']);
					$('#ubicacion').val(data['data']['ubicacion']);
					$('#descripcion').val(data['data']['descripcion']);
					$('#estado').val(data['data']['estado']);
					$('#detalle').val(data['data']['detalle']);		
				}else{
					alert("No se encontro la solicitud deseada.");
				}
				
			});
		}
		return false;
	});
	
	$('#myModal').on('show.bs.modal', function () {
		$('.modal .modal-body').css('overflow-y', 'auto'); 
		$('.modal .modal-body').css('max-height', $(window).height() * 0.9);
	});
	
	$(function(){
		$("#solicitudes").tablesorter();
		$("#solicitudesPropias").tablesorter();
		$("#solicitudPropia").tablesorter();
	});
	
});