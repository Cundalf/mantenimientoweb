<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mantenimiento_model extends CI_Model {


	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}
	
	public function guardarSolicitud($usuario, $ubicacion, $interno, $descripcion)
	{
		
		$sql = "CALL SP_SetSolicitud(?,?,?,?)";
		$parametros = array($usuario, $ubicacion, $interno, $descripcion);
		$consulta = $this->db->query($sql,$parametros);
		$resultado = $consulta->row();
		
		$consulta->next_result();
		$consulta->free_result();
		
		return $resultado->id;
	}
	
	public function listaSolicitudes($usuario)
	{
		$sql = "CALL SP_SelectSolicitudesxUsuario(?)";
		$parametros = array($usuario);
		$consulta = $this->db->query($sql,$parametros);
		$resultado = $consulta->result();
		
		$consulta->next_result();
		$consulta->free_result();
		
		return $resultado;
	}
	
	public function listarSolicitudes()
	{
		$sql = "CALL SP_GetSolicitudes()";
		$consulta = $this->db->query($sql);
		$resultado = $consulta->result();
		
		$consulta->next_result();
		$consulta->free_result();
		
		return $resultado;
	}
	
	public function listaSolicitudesResponsable($usuario)
	{
		$sql = "CALL SP_GetSolicitudesxResponsable(?)";
		$parametros = array($usuario);
		$consulta = $this->db->query($sql,$parametros);
		$resultado = $consulta->result();
		
		$consulta->next_result();
		$consulta->free_result();
		
		return $resultado;
	}
	
	public function getSolicitud($id)
	{
		$sql = "CALL SP_GetSolicitudxID(?)";
		$parametros = array($id);
		$consulta = $this->db->query($sql,$parametros);
		$resultado = $consulta->row();
		
		$consulta->next_result();
		$consulta->free_result();
		
		
		return $resultado;
	}
	
	public function getUsuarios(){
		
		$sql = "CALL SP_GetUsuarios()";
		$consulta = $this->db->query($sql);
		$resultado = $consulta->result();
		
		$consulta->next_result();
		$consulta->free_result();
		
		return $resultado;
	}
	
	public function modificarResponsable($id,$responsable){
		
		$sql = "CALL SP_InsertResponsable(?,?)";
		$parametros = array($id, $responsable);
		$consulta = $this->db->query($sql,$parametros);
		$resultado = $consulta->row();
		
		$consulta->next_result();
		$consulta->free_result();
		
		return $resultado->id;
	}
	
	public function modificarGestion($id,$estado,$detalle){
		
		$sql = "CALL SP_ModificarGestion(?,?,?)";
		$parametros = array($id, $estado, $detalle);
		$consulta = $this->db->query($sql,$parametros);
		$resultado = $consulta->row();
		
		$consulta->next_result();
		$consulta->free_result();
		
		return $resultado->id;
	}
	
}
