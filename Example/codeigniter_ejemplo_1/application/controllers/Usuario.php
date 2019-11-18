<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	// use UsuarioRule;
	

	public function __construct()
	{
		parent::__construct();
	
		//$this->load->database();
		$this->load->model('usuario_model');
		$this->load->helper('url');

	}

	/**
	 * Lista todos los datos de la tabla o si envia algun parametro de login lo lista
	 * Ejm: http://localhost/codeigniter/index.php/Usuario/index
	 * O * Ejm: http://localhost/codeigniter/index.php/Usuario/index/nexos
	 * @return void
	 */
	public function index($login='')
	{
		$data = array();		

		if($login!='')
		{
			$data["usuarios"] = $this->usuario_model->getAll(['login'=>$login]);
		}else{
			$data["usuarios"] = $this->usuario_model->getAll();
		}

		$this->load->view('usuario/index', $data);
	}

	/**
	 * Obtiene los datos de un usuario segun su ID
	 * Ejm: http://localhost/codeigniter/index.php/Usuario/obtenerUsuarioPorId/7
	 * @param Integer $id 
	 * @return void
	 */
	public function obtenerUsuarioPorId($id)
	{
		$data = array();		
		$data["usuarios"] = $this->usuario_model->getById($id);
		
		if($data["usuarios"]==null){
			$data["usuarios"] = ['error'=>'No existe el usuario con id:'.$id];
		}

		$this->load->view('usuario/index', $data);
	}

	/**
	 * Obtiene los datos de un usuario segun los paramestros buscados.
	 * Ejm: http://localhost/codeigniter/index.php/Usuario/obtenerUsuario/nexos/123
	 * @param String $login 
	 * @param String $password 
	 * @return void
	 */
	public function obtenerUsuario($login, $password)
	{
		$data = array();	

		$data["usuarios"] = $this->usuario_model->get(['login'=>$login, 'password'=> $password]);
		
		if($data["usuarios"]==null){
			$data["usuarios"] = ['error'=>'No existe el usuario con login:'.$login.' y password:'.$password];
		}

		$this->load->view('usuario/index', $data);
	}

	/**
	 * Crea un usuario en la base de dato enviadole los parametros de login y password
	 * Ejm: http://localhost/codeigniter/index.php/Usuario/createUsuario/nexos/123
	 * @param String $login 
	 * @param String $password 
	 * @return void
	 */
	public function createUsuario($login, $password)
	{
		$usuario = [ 'login'=> $login, 'password'=>$password ];
		$this->usuario_model->insert($usuario);		

		redirect('Usuario/index');
	}

	
	/**
	 * Edita un usuario de la base de datos cuando le envia el id seguido de los parametros a modificar
	 * Ejm: http://localhost/codeigniter/index.php/Usuario/editUsuarioPorId/7/nexos/12345
	 * @param Integer $id 
	 * @param String $login 
	 * @param String $password 
	 * @return void
	 */
	public function editUsuarioPorId($id, $login, $password)
	{		

		$usuario = ['login'=> $login, 'password'=>$password ];
		$this->usuario_model->updateById( $usuario, $id);

		redirect('Usuario/index');

	}

	/**
	 * Edita un usuario de la base de datos cuando le envia el id seguido de los parametros a modificar
	 * Ejm: http://localhost/codeigniter/index.php/Usuario/editUsuario/pirat33/nexos/12345
	 * @param Integer $id 
	 * @param String $login 
	 * @param String $password 
	 * @return void
	 */
	public function editUsuario($login_nuevo, $login, $password)
	{
		
		$usuario = ['login'=> $login_nuevo ];
		$this->usuario_model->update( $usuario, ['login'=> $login, 'password'=>$password ]);

		redirect('Usuario/index');

	}


	/**
	 * Elimina un usuario de la base de datos cuando se le envia el id.
	 * Ejm: http://localhost/codeigniter/index.php/Usuario/deleteUsuarioPorId/7
	 * @param Integer $id 
	 * @return void
	 */
	public function deleteUsuarioPorId($id)
	{

		$usuario = ['id_usuario'=>$id];
		$this->usuario_model->deleteById($usuario["id_usuario"]);

		redirect('Usuario/index');
	}	


	/**
	 * Elimina un usuario de la base de datos cuando se le envia el id.
	 * Ejm: http://localhost/codeigniter/index.php/Usuario/deleteUsuario/pirat33/12345
	 * @param Integer $id 
	 * @return void
	 */
	public function deleteUsuario($login, $password)
	{

		$usuario = ['login'=>$login, 'password'=>$password];
		$this->usuario_model->delete($usuario);

		redirect('Usuario/index');
	}	


	/**
	 * Devuelve la cantidad de resultados de la tabla o si envia parametros realiza un where a la consulta
	 * Ejm: http://localhost/codeigniter/index.php/Usuario/contadorUsuarios/nexos
	 * @param Integer $login 
	 * @return void
	 */
	public function contadorUsuarios($login='')
	{
		$data = array();	

		$data["usuarios"] = [];

		if($login==''){
			$cantidad = $this->usuario_model->count();
		}else{
			$cantidad = $this->usuario_model->count(['login'=>$login]);
		}		
		
		if($cantidad==0)
		{
			$data["usuarios"] = ['error'=>'No existen usuarios'];
		} else{
			$data["usuarios"] = ['cantidad'=>'Existen '.$cantidad.' Usuarios'];
		}

		$this->load->view('usuario/index', $data);
	}

}

/* End of file usuario.php */
/* Location: ./application/controllers/usuario.php */