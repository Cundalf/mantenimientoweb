<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mantenimiento extends CI_Controller {

	public function __construct() 
	{		
		parent::__construct();
		
		$this->load->model('mantenimiento_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		if ($this->session->userdata('login') == null) 
		{
			redirect('user/login');			
		}
		else
		{
			if ($this->session->userdata('activo') == 0) 
			{
				redirect('user/cambiarPassword');
			}
		}		
	}
	
	public function index()
	{
		if ($this->session->userdata('categoria')=="1") {
			$page['pagina'] = 'propias';
			$this->load->view('header',$page);
			$data['solicitudes'] = $this->mantenimiento_model->listaSolicitudesResponsable($this->session->userdata('user_id'));
			$this->load->view('mantenimiento/solicitudesPropias', $data);
		
		}else{
			$this->load->view('header');
			$data['solicitudes'] = $this->mantenimiento_model->listaSolicitudes($this->session->userdata('user'));
			$this->load->view('mantenimiento/solicitud', $data);
		}
		$this->load->view('footer');
	}
	
	public function pendientes()
	{
		$page['pagina'] = 'pendientes';
		$this->load->view('header',$page);
		$data['solicitudes'] = $this->mantenimiento_model->listarSolicitudes();
		$this->load->view('mantenimiento/solicitudesPendientes', $data);
		$this->load->view('footer');
	}
	
	public function guardarSolicitud()
	{
		$this->load->helper('MY_mantenimiento');
		
		$this->form_validation->set_rules('ubicacion', 'Ubicacion', 'required');
		$this->form_validation->set_rules('interno', 'Nro. de Interno', 'required');
		$this->form_validation->set_rules('descripcion', 'Descripcion', 'required');

		if ($this->form_validation->run() == false) 
		{	
			$data['solicitudes'] = $this->mantenimiento_model->listaSolicitudes($this->session->userdata('user'));
			$this->load->view('header');
			$this->load->view('mantenimiento/solicitud', $data);
			$this->load->view('footer');
		}
		else
		{			
			$usuario = $this->session->userdata('user');
			$ubicacion = $this->input->post('ubicacion');
			$interno = $this->input->post('interno');
			$descripcion = $this->input->post('descripcion');
			
			$id = $this->mantenimiento_model->guardarSolicitud($usuario, $ubicacion, $interno, $descripcion);			
			
			if(!isset($id))
			{								
				$res = 0;
			} 
			else 
			{
				$res = $id;
				//imprimirTicket($id, $usuario, $this->session->userdata('sector'), $ubicacion, $interno, $descripcion);
			}
			
			redirect("/?B=".$res);

		}
		
	}
	
	public function getSolicitudPendiente(){
		$idSol = $this->input->post('id');
		
		$datos = $this->mantenimiento_model->getSolicitud($idSol);			
			
		if(isset($datos))
		{								
			echo json_encode($datos);
		}else{
			echo '';
		}
		
	}
	
	public function modificarResponsable(){
		
		$idSol		 = $this->input->post('id');
		$responsable = $this->input->post('responsable');
		
		$error = '';
		 
		if ($idSol == '' || $responsable == ''){
			$error = 'Error al obtener los datos';
		}
		
		if ($error == ''){
			$id = $this->mantenimiento_model->modificarResponsable($idSol, $responsable);			
			
			if(!isset($id))
			{								
				$error = 'Error al grabar los cambios';
			} 
			else 
			{
				if ($id == '' || $id == 0){
					$error = 'Error al grabar los cambios';
				}
			}
		}
		
		echo $error;

	}
	
	public function verSolicitud($id)
	{
		$datos = $this->mantenimiento_model->getSolicitud($id,$this->session->userdata('matricula'));
		$users = $this->mantenimiento_model->getUsuarios();
		

		$data= array(
			'id'			=> $datos->solicitud,
			'solicitante' 	=> $datos->usuario,
			'descripcion' 	=> $datos->descripcion,
			'estado' 		=> $datos->estado,
			'detalle' 		=> $datos->detalle,
			'responsable' 	=> $datos->responsable,
			'ubicacion' 	=> $datos->ubicacion,
			'usuarios' 		=> $users,
			'idResponsable' => $datos->idResponsable
			);
		
		$this->load->view('mantenimiento/popupSolicitud',$data);
		
	}
	
	public function modificarGestion(){
		
		$idSol	 = $this->input->post('id');
		$estado	 = $this->input->post('estado');
		$detalle = $this->input->post('detalle');
		
		$error = '';
		 
		if ($idSol == '' || $estado == '' || $detalle == ''){
			$error = 'Todos los campos son obligatorios';
		}
		
		if ($error == ''){
			$id = $this->mantenimiento_model->modificarGestion($idSol, $estado, $detalle);			
			
			if(!isset($id))
			{								
				$error = 'Error al grabar los cambios';
			} 
			else 
			{
				if ($id == '' || $id == 0){
					$error = 'Error al grabar los cambios';
				}
			}
		}
		
		echo $error;
	}
}
