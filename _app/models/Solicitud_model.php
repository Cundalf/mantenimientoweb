<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitud_model extends CI_Model {


	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}
	
	public function guardarSolicitud($usuario, $sector, $ubicacion, $interno, $descripcion)
	{
		
		$ip = $this->input->ip_address();
		$maquina = gethostbyaddr($ip);
		
		$sql = "CALL SP_SetSolicitudSinUser(?,?,?,?,?,?,?)";
		$parametros = array($usuario, $sector, $ubicacion, $interno, $descripcion, $ip, $maquina);
		$consulta = $this->db->query($sql,$parametros);
		$resultado = $consulta->row();
		
		$consulta->next_result();
		$consulta->free_result();
		
		return $resultado->id;
	}
	
	public function getSolicitudxID($id)
	{
		$sql = "CALL SP_GetSolicitudxID(?)";
		$parametros = array($id);
		$consulta = $this->db->query($sql,$parametros);
		$resultado = $consulta->row();
		
		$consulta->next_result();
		$consulta->free_result();
		
		
		return $resultado;
	}
	
}
