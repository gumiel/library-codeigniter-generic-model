<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	// use UsuarioRule;
	

	public function __construct()
	{
		parent::__construct();
	
		//$this->load->database();
		$this->load->model('user_model');
		$this->load->helper('url');

	}

	/**
	 * Lista todos los datos de la tabla o si envia algun parametro de login lo lista
	 * Ejm: http://localhost/codeigniter/index.php/User/index
	 * O * Ejm: http://localhost/codeigniter/index.php/User/index/nexos
	 * @return void
	 */
	public function index($login='')
	{
		$data = array();		

		if($login!='')
		{
			$data["users"] = $this->user_model->getAll(['login'=>$login]);
		}else{
			$data["users"] = $this->user_model->getAll();
		}

		$this->load->view('user/index', $data);
	}

	/**
	 * Obtiene los datos de un usuario segun su ID
	 * Ejm: http://localhost/codeigniter/index.php/User/obtenerUsuarioPorId/7
	 * @param Integer $id 
	 * @return void
	 */
	public function obtenerUsuarioPorId($id)
	{
		$data = array();		
		$data["users"] = $this->user_model->getById($id);
		
		if($data["users"]==null){
			$data["users"] = ['error'=>'No existe el usuario con id:'.$id];
		}

		$this->load->view('user/index', $data);
	}

	/**
	 * Obtiene los datos de un usuario segun los paramestros buscados.
	 * Ejm: http://localhost/codeigniter/index.php/User/obtenerUsuario/nexos/123
	 * @param String $login 
	 * @param String $password 
	 * @return void
	 */
	public function obtenerUsuario($login, $password)
	{
		$data = array();	

		$data["users"] = $this->user_model->get(['login'=>$login, 'password'=> $password]);
		
		if($data["users"]==null){
			$data["users"] = ['error'=>'No existe el usuario con login:'.$login.' y password:'.$password];
		}

		$this->load->view('user/index', $data);
	}

	/**
	 * Crea un usuario en la base de dato enviadole los parametros de login y password
	 * Ejm: http://localhost/codeigniter/index.php/User/createUsuario/nexos/123
	 * @param String $login 
	 * @param String $password 
	 * @return void
	 */
	public function createUsuario($login, $password)
	{
		$usuario = [ 'login'=> $login, 'password'=>$password ];
		$this->user_model->insert($usuario);		

		redirect('user/index');
	}

	
	/**
	 * Edita un usuario de la base de datos cuando le envia el id seguido de los parametros a modificar
	 * Ejm: http://localhost/codeigniter/index.php/User/editUsuarioPorId/7/nexos/12345
	 * @param Integer $id 
	 * @param String $login 
	 * @param String $password 
	 * @return void
	 */
	public function editUsuarioPorId($id, $login, $password)
	{		

		$usuario = ['login'=> $login, 'password'=>$password ];
		$this->user_model->updateById( $usuario, $id);

		redirect('user/index');

	}

	/**
	 * Edita un usuario de la base de datos cuando le envia el id seguido de los parametros a modificar
	 * Ejm: http://localhost/codeigniter/index.php/User/editUsuario/pirat33/nexos/12345
	 * @param Integer $id 
	 * @param String $login 
	 * @param String $password 
	 * @return void
	 */
	public function editUsuario($login_nuevo, $login, $password)
	{
		
		$usuario = ['login'=> $login_nuevo ];
		$this->user_model->update( $usuario, ['login'=> $login, 'password'=>$password ]);

		redirect('user/index');

	}


	/**
	 * Elimina un usuario de la base de datos cuando se le envia el id.
	 * Ejm: http://localhost/codeigniter/index.php/User/deleteUsuarioPorId/7
	 * @param Integer $id 
	 * @return void
	 */
	public function deleteUsuarioPorId($id)
	{

		$usuario = ['id_usuario'=>$id];
		$this->user_model->deleteById($usuario["id_usuario"]);

		redirect('user/index');
	}	


	/**
	 * Elimina un usuario de la base de datos cuando se le envia el id.
	 * Ejm: http://localhost/codeigniter/index.php/User/deleteUsuario/pirat33/12345
	 * @param Integer $id 
	 * @return void
	 */
	public function deleteUsuario($login, $password)
	{

		$usuario = ['login'=>$login, 'password'=>$password];
		$this->user_model->delete($usuario);

		redirect('user/index');
	}	


	/**
	 * Devuelve la cantidad de resultados de la tabla o si envia parametros realiza un where a la consulta
	 * Ejm: http://localhost/codeigniter/index.php/User/contadorUsuarios/nexos
	 * @param Integer $login 
	 * @return void
	 */
	public function contadorUsuarios($login='')
	{
		$data = array();	

		$data["users"] = [];

		if($login==''){
			$cantidad = $this->user_model->count();
		}else{
			$cantidad = $this->user_model->count(['login'=>$login]);
		}		
		
		if($cantidad==0)
		{
			$data["users"] = ['error'=>'No existen usuarios'];
		} else{
			$data["users"] = ['cantidad'=>'Existen '.$cantidad.' Usuarios'];
		}

		$this->load->view('user/index', $data);
	}

}

/* End of file usuario.php */
/* Location: ./application/controllers/usuario.php */