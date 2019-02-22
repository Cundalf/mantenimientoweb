<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitud extends CI_Controller {

	public function __construct() 
	{		
		parent::__construct();
		
		$this->load->model('solicitud_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		
	}
	
	public function index()
	{
		$page['pagina'] = 'solicitud';
		$this->load->view('solicitud/header',$page);
		$this->load->view('solicitud/solicitarMantenimiento');
		$this->load->view('footer');
	}
	
	public function consulta()
	{
		$page['pagina'] = 'consulta';
		$this->load->view('solicitud/header',$page);
		$this->load->view('solicitud/consultarSolicitud');
		$this->load->view('footer');
	}

	public function guardarSolicitud()
	{
		$this->load->helper('MY_mantenimiento');
		
		$this->form_validation->set_rules('solicitante', 'Solicitante', 'required');
		$this->form_validation->set_rules('sector', 'Sector', 'required');
		$this->form_validation->set_rules('ubicacion', 'Ubicacion', 'required');
		$this->form_validation->set_rules('interno', 'Nro. de Interno', 'required');
		$this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
	
		if ($this->form_validation->run() == false) 
		{	
			$page['pagina'] = 'solicitud';
			$this->load->view('header',$page);
			$this->load->view('solicitud/solicitarMantenimiento');
			$this->load->view('footer');
		}
		else
		{			
			$usuario =  $this->input->post('solicitante');
			$sector = $this->input->post('sector');
			$ubicacion = $this->input->post('ubicacion');
			$interno = $this->input->post('interno');
			$descripcion = $this->input->post('descripcion');
			
			$id = $this->solicitud_model->guardarSolicitud($usuario, $sector, $ubicacion, $interno, $descripcion);			
			
			if(!isset($id))
			{								
				$res = 0;
			} 
			else 
			{
				$res = $id;
				imprimirTicket($id, $usuario, $sector, $ubicacion, $interno, $descripcion);
			}
			
			redirect("/solicitud/?B=".$res);

		}
		
	}
	
	public function consultarSolicitud(){
		$idSol = $this->input->post('id');
		
		$datos = $this->solicitud_model->getSolicitudxID($idSol);			
			
		if(isset($datos))
		{								
			echo json_encode(array('status' => true,'data' => $datos));
		}else{
			echo json_encode(array('status' => false,'data' => ''));
		}
		
	}
}
