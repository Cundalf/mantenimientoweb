<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
	public function __construct() 
	{
		parent::__construct();

		$this->load->model('user_model');
	}
	
	public function index() 
	{
		redirect('/');
	}
		
	public function login() 
	{		
		if ($this->session->userdata('login') != null) 
		{
			redirect('/');	
		}
		
		$data = new stdClass();
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('username', 'Usuario', 'required|alpha_numeric');
		$this->form_validation->set_rules('password', 'Contraseña', 'required');
		
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('header');
			$this->load->view('user/login');
			$this->load->view('footer');
		} 
		else 
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			if ($this->user_model->resolve_user_login($username, $password)) 
			{
				$user = $this->user_model->get_user($username);
				
				$sessionNueva = array(
					'login' 	=> 1, 
					'username' 	=> $user->nombre,
					'sector' 	=> $user->sector,					
					'user_id' 	=> $user->id,
					'user' 		=> strtolower($user->usuario),
					'mail' 		=> $user->email,
					'activo' 	=> $user->activo,
					'categoria' => $user->categoria);	

				$this->session->set_userdata($sessionNueva);

				redirect('/');
			} 
			else 
			{
				$data->error = 'Usuario o Contraseña Incorrectos.';
				
				$this->load->view('header');
				$this->load->view('user/login', $data);
				$this->load->view('footer');
			}
		}
	}
	
	public function cambiarPassword() 
	{
		if ($this->session->userdata('login') == null) 
		{
			redirect('user/login');			
		}
		else
		{
			if ($this->session->userdata('activo') == 0) 
			{				
				$data = new stdClass();
				
				$this->load->helper('form');
				$this->load->library('form_validation');
				
				$this->form_validation->set_rules('oldPassword', 'Contraseña Actual', 'required');
				$this->form_validation->set_rules('newPassword', 'Nueva Contraseña', 'required');
				$this->form_validation->set_rules('new2Password', 'Repetir Contraseña', 'required');
				
				if ($this->form_validation->run() == false) 
				{
					$this->load->view('header');
					$this->load->view('user/cambioPassword');
					$this->load->view('footer');
				}
				else
				{
					$oldPassword = $this->input->post('oldPassword');
					$newPassword = $this->input->post('newPassword');
					$new2password = $this->input->post('new2Password');
					$correo = $this->input->post('correo');
					
					$data->error = "";
					
					if (!($this->user_model->resolve_user_login($this->session->userdata('user'), $oldPassword)))
					{
						$data->error = 'La actual contraseña es incorrecta.';
					}
					
					if ($oldPassword == "" || $newPassword == "" || $new2password == "") 
					{
						$data->error = 'Todos los campos de contraseña son obligatorios.';	
					} 
					
					if (strlen($newPassword) < 8)
					{
						$data->error = 'La contraseña nueva debe tener al menos 8 caracteres.';
					}
					
					if ($newPassword != $new2password) 
					{
						$data->error = 'Las contraseñas no coinciden.';	
					} 
						
					if ($data->error == "") 
					{
						$this->user_model->cambioPassword($this->session->userdata('user_id'), $newPassword, $correo, '');
						
						$this->logout(false);
						
						$this->load->view('header');
						$this->load->view('user/password_correcto', $data);
						$this->load->view('footer');
					}
					else 
					{
						$this->load->view('header');
						$this->load->view('user/cambioPassword', $data);
						$this->load->view('footer');
					}
				}
			}
			else
			{
				redirect('/');
			}
		}
	}
	
	public function logout($redirect = true) 
	{
		
		if ($this->session->userdata('login') != null)
		{
			$this->session->sess_destroy();
		}
		
		if ($redirect)
		{
			redirect("/");
		}
	}
	
	public function restablecerPassword() 
	{		
		if ($this->session->userdata('login') != null) 
		{
			redirect('/');	
		}
		else
		{
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('usuario', 'Usuario', 'required');
			$this->form_validation->set_rules('correo', 'Correo Electronico', 'required');
			
			if ($this->form_validation->run() == false) 
			{
				$this->load->view('header');
				$this->load->view('user/restablecerPassword');
				$this->load->view('footer');
			}
			else
			{
				$data = new stdClass();
				
				$usuario = $this->input->post('usuario');
				$correo = $this->input->post('correo');
				
				$data->error = "";
					
				if (!($this->user_model->comprobar_correo($usuario, $correo)))
				{
					$data->error = 'El correo ingresado no corresponde con el asociado al usuario.';
				}
				
				if ($data->error == "") 
				{
					
					$pass = $this->user_model->renovarPassword($usuario);
					$user = $this->user_model->get_user($usuario);
					
					$this->enviarPassword($user->email, $pass, $user->nombre);
					
					$this->load->view('header');
					$this->load->view('user/passwordEnviado');
					$this->load->view('footer');
				}
				else 
				{
					$this->load->view('header');
					$this->load->view('user/restablecerPassword', $data);
					$this->load->view('footer');
				}
				
			}
			
		}
		
	}
	
	private function enviarPassword($destino, $pass, $nombre){

		$this->load->library('email');
		
		$data = array('password' => $pass,'nombre' => $nombre);
		
		$mensaje = $this->load->view('user/mailPassword',$data,true);
		
		$this->email->clear();
		
		$this->email->to($destino);
		$this->email->bcc('sistemas@laslomas.com.ar');
		$this->email->from('info@laslomas.com.ar');
		$this->email->subject('Contraseña Restablecida');
		$this->email->message($mensaje);
		$this->email->send();
		
		
		echo '<!--' . print_r($this->email->print_debugger(), true) . '-->'; 
	}
	
	public function actualizarDatos() 
	{
		if ($this->session->userdata('login') == null) 
		{
			redirect('user/login');			
		}
		else
		{
			
			$data = new stdClass();
			
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('oldPassword', 'Contraseña Actual', 'required');
			$this->form_validation->set_rules('correo', 'Correo Electronico', 'required');
			$this->form_validation->set_rules('sector', 'Sector', 'required');
			
			if ($this->form_validation->run() == false) 
			{
				$this->load->view('header');
				$this->load->view('user/actualizarDatos');
				$this->load->view('footer');
			}
			else
			{
				$passNueva = False;
				
				$oldPassword = $this->input->post('oldPassword');
				$newPassword = $this->input->post('newPassword');
				$new2password = $this->input->post('new2Password');
				$correo = $this->input->post('correo');
				$sector = $this->input->post('sector');
				
				$data->error = "";
				
				if (!($this->user_model->resolve_user_login($this->session->userdata('user'), $oldPassword)))
				{
					$data->error = 'La actual contraseña es incorrecta.';
				}
				
				if ($newPassword != "")
				{
					
					if (strlen($newPassword) < 8)
					{
						$data->error = 'La contraseña nueva debe tener al menos 8 caracteres.';
					}
					
					if ($newPassword != $new2password) 
					{
						$data->error = 'Las contraseñas no coinciden.';	
					} 
					
				}
				else
				{
					$newPassword = $oldPassword;
				}

				
				if ($data->error == "") 
				{
					$this->user_model->cambioPassword($this->session->userdata('user_id'), $newPassword, $correo, $sector);
					
					$this->logout(false);
					
					$this->load->view('header');
					$this->load->view('user/password_correcto');
					$this->load->view('footer');
					
				}
				else 
				{
					$this->load->view('header');
					$this->load->view('user/actualizarDatos', $data);
					$this->load->view('footer');
				}
			}
		}
	}
	
}
