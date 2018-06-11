<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	// use UsuarioRule;
	

	public function __construct()
	{
		parent::__construct();
	
		//$this->load->database();
		$this->load->model('usuario_model');

	}

	public function index()
	{
		$data = array();		
		$data["usuarios"] = $this->usuario_model->getAll();
		$this->load->view('usuario/index', $data);
	}

	public function createUsuario()
	{

		$usuario = $this->input->post("usuario");

		$this->form_validation->set_rules($this->usuario_rule->apply());
		$this->form_validation->set_rules('usuario[cuenta]', 'Cuenta', 'callback__verificar_cuenta_repetida');
		$this->form_validation->set_rules('usuario[rep_password]', 'Repetir Contraseña', 'trim|required|callback__validar_repetir_password['.$usuario["password"].']');

		if ( $this->form_validation->run() ) 
		{
			unset($usuario["rep_password"]);
			$usuario["password"] = md5($usuario["password"]);

			$this->usuario_model->insert($usuario);
			$this->session->set_flashdata('message', [ "success"=>"Se creo el usuario" ]);
			redirect('usuario/lista');
		} else
		{			
			$this->session->set_flashdata('message', [ "error"=>validation_errors() ]);
			$this->lista();
		}

	}

	

	public function editUsuario()
	{
		$usuario = $this->input->post("usuario");

		$this->form_validation->set_rules($this->usuario_rule->apply());
		$this->form_validation->set_rules('usuario[id_usuario]', 'ID', 'trim|required|callback__verificar_id_usuario');

		if ( isset($usuario["password"]) && $usuario["password"] != '')
		{
			$this->form_validation->set_rules('usuario[password]', 'Contraseña', 'trim|required');			
			$this->form_validation->set_rules('usuario[rep_password]', 'Repetir Contraseña', 'trim|required|callback__validar_repetir_password['.$usuario["password"].']');		
			$usuario["password"] = md5($usuario["password"]);
				
		} else
		{
			unset($usuario["password"]);
		}
		

		if ( $this->form_validation->run() )
		{
	
			unset($usuario["rep_password"]);			

			$this->usuario_model->updateById( $usuario, $usuario["id_usuario"]);
			$this->session->set_flashdata('message', [ "success"=>"Se edito el registro" ]);
		} else
		{
			$this->session->set_flashdata('message', [ "error"=>validation_errors() ]);

		}
		redirect('usuario/lista','refresh');

	}

	public function deleteUsuarioAjax()
	{
		$usuario = $this->input->post("usuario");
		$data = array();

		$this->form_validation->set_rules('usuario[id_usuario]', 'ID', 'trim|required|callback__verificar_id_usuario');

		if ( $this->form_validation->run() )
		{
			$this->usuario_model->deleteById($usuario["id_usuario"]);
			$this->session->set_flashdata('message', [ "success"=>"Se elimino el registro" ]);
		} else
		{
			$this->session->set_flashdata('message', [ "error"=>validation_errors() ]);
		}
		
		redirect('usuario/lista','refresh');
	}























	public function _verificar_cuenta_repetida($cuenta, $idUsuario=0)
	{
		$this->form_validation->set_message(__FUNCTION__, 'Ya existe la Cuenta');
		if ( $idUsuario==0 )
		{
			$cantidad = $this->usuario_model->count( [ 'cuenta'=>$cuenta ] );
		} else
		{
			$cantidad = $this->usuario_model->count( [ 'cuenta'=>$cuenta, 'id_usuario!='=>$idUsuario ] );
		}
		return ( $cantidad==0 );
	}

	public function _validar_repetir_password($repPassword, $password)
	{
		$this->form_validation->set_message(__FUNCTION__, 'Repetir el mismo password escrito');
		return ($repPassword == $password);		
	}

	public function _verificar_id_usuario($idUsuario)
	{
		$this->form_validation->set_message(__FUNCTION__, 'No existe el identificador del usuario');
		if ($idUsuario > 0)
		{			
			$usuario = $this->usuario_model->getById($idUsuario);			
			return ( isset($usuario) );
		} else
		{
			return FALSE;
		}
	}


	

}

/* End of file usuario.php */
/* Location: ./application/controllers/usuario.php */