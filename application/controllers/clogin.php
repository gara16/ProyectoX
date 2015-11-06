<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Clogin extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->model('modelo');
	}

	function index(){
		$this->load->view('index.html');
	}
	function validarDatosLogueo(){
		$this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|max_length[15]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[20]|xss_clean');
	}
	function loguear(){
		$_POST=json_decode(file_get_contents('php://input'),TRUE);
		$user=$this->input->post('usuario');
		$password=$this->input->post('password');
		$this->validarDatosLogueo();
		if ($this->form_validation->run()!=FALSE) {
			$this->validarLogueo($user,$password);
		} else echo json_encode(array("respuesta" => "Los datos proporcionados son erróneos"));
	}
	function validarLogueo($user,$password){
		$dato=$this->modelo->loguear($user,$password);
		settype($dato['0'],"array");
		if ($dato!=null) {
			$tipo=$dato['0']['idtipousuario'];
			$data=array('alias' => $user,'tipouser'=>$tipo);
			$this->session->set_userdata($data);
			if ($tipo==1) {
				redirect('cProducto');
			} else if ($tipo==2) {
				redirect('cCliente');
			} else echo json_encode(array("respuesta" => "Ocurrió un problema al intentar loguear"));
		} else echo json_encode(array("respuesta" => "Usuario o password no son correctas"));
	}
	function logout(){
		$this->session->sess_destroy();
		$this->index();
	}

	/*Las siguiente funciones son en el caso de que el usuario no tenga con una 
	cuenta(alias) para ingresar, en tal caso tendrá que registrarse*/
	function validarDatosUser(){
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[5]|max_length[20]|xss_clean');
		$this->form_validation->set_rules('apellido', 'Apellido', 'trim|required|min_length[5]|max_length[20]|xss_clean');
		$this->form_validation->set_rules('dni', 'DNI', 'trim|required|min_length[8]|max_length[8]|is_natural|xss_clean');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('usuario', 'usuario', 'trim|required|alpha_numeric|xss_clean|min_length[8]|max_length[15]');
		$this->form_validation->set_rules('password', 'usuario', 'trim|required|xss_clean|min_length[8]|max_length[20]');
	}
	function agregarUsuario(){
		$_POST=json_decode(file_get_contents('php://input'),TRUE);
		$nombre=$this->input->post('nombre');
		$apellido=$this->input->post('apellido');
		$dni=$this->input->post('dni');
		$email=$this->input->post('email');
		$tele=$this->input->post('telefono');
		$usuario=$this->input->post('user');
		$password=$this->input->post('pass');
		$this->validarDatosUser();
		if($this->form_validation->run()!=FALSE){
			if ($this->modelo->existeUsuario($usuario)==null) {
				$Ausuario=array('usuario'=>$usuario,'password'=>$password,'idtipousuario'=>'2');
				$iduser=$this->modelo->agregarUsuario($Ausuario);
				if ($iduser!=null) {
					settype($iduser["0"], "array");
					$Adatos=array('nombre'=>$nombre,'apellido'=>$apellido,'dni'=>$dni,'email'=>$email,'telefono'=>$tele,'idusuario'=>$iduser["0"]["idusuario"]);
					if ($this->modelo->agregarDatos($Adatos)) {
							$this->validarLogueo($usuario,$password);
						//return json_encode(array("respuesta"=>"El Usuario y los datos fue registrado con éxito"));
					} else return json_encode(array("respuesta"=>"El Usuario fue registrado pero no los datos, Por favor Actualize sus datos"));
				} else return json_encode(array("respuesta"=>"Ocurrió un error al intentar registrar el usuario"));
			} else return json_encode(array("respuesta"=>"Eliga otro usuario, el que proporciona ya se encuentra registrado"));
		} else return json_encode(array("respuesta"=>"Los datos proporcionados son incorrectos"));
	}
}	
?>