<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {


	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}
	
	public function resolve_user_login($username, $password) {
		
		$sql = "CALL SP_Login(?,?)";
		$parametros = array($username, $password);
		$consulta = $this->db->query($sql,$parametros);
		$resultado = $consulta->row();
		
		$consulta->next_result();
		$consulta->free_result();
		
		if ($resultado->login == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	public function get_user_id_from_username($dni) {
		return 0;
	}
	
	public function get_user($user) {

		$sql = "CALL SP_GetUsuario(?)";
		$parametros = array($user);
		$consulta = $this->db->query($sql,$parametros);
		$resultado = $consulta->row();
		
		$consulta->next_result();
		$consulta->free_result();
		
		return $resultado;
	
	}
	
	private function hash_password($password) {
		return md5($password);
	}

	private function verify_password_hash($password, $hash) {
		return password_verify($password, $hash);
	}
	
	public function cambioPassword($id, $password, $mail, $sector) {
		
		$sql = "CALL SP_ModificarPassword(?,?,?,?)";
		$parametros = array($id, $password, $mail, $sector);
		$consulta = $this->db->query($sql,$parametros);
	}
	
	public function comprobar_correo($documento, $correo) {
		
		$sql = "CALL SP_ComprobarCorreo(?,?)";
		$parametros = array($documento, $correo);
		$consulta = $this->db->query($sql,$parametros);
		$resultado = $consulta->row();
		
		$consulta->next_result();
		$consulta->free_result();
		
		if ($resultado->resul == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	public function renovarPassword($documento) {
		
		$sql = "CALL SP_RestablecerPassword(?)";
		$parametros = array($documento);
		$consulta = $this->db->query($sql,$parametros);
		$resultado = $consulta->row();
		
		$consulta->next_result();
		$consulta->free_result();
		
		return $resultado->pass;
		
	}
	
}
