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
			$mensaje=$this->validarLogueo($user,$password);
		} else $mensaje['error']="Los datos proporcionados son erroneos";
		echo json_encode($mensaje);
	}
	function validarLogueo($user,$password){
		$dato=$this->modelo->loguear($user,$password);
		if ($dato!=null) {
			settype($dato['0'],"array");
			$data=array('alias'=>$user,'tipouser'=>$dato['0']['idtipousuario'],'idUser'=>$dato['0']['idusuario']);
			$this->session->set_userdata($data);
			$mensaje['dato']=$dato['0']['idtipousuario'];
		} else $mensaje['error']="Usuario o password no son correctas";
		return $mensaje;
	}

	function obtenerSession(){
		if($this->session->userdata('alias')){
			$dato=array('estado'=>TRUE,'id'=>$this->session->userdata('idUser'),'user'=>$this->session->userdata('alias'),'tipouser'=>$this->session->userdata('tipouser'));
		}else{
			$dato=array('estado'=>FALSE);
		}
		echo json_encode($dato);
	}

	function logout(){
		$this->session->sess_destroy();
	}

	/*Las siguiente funciones son en el caso de que el usuario no tenga con una 
	cuenta(alias) para ingresar, en tal caso tendrá que registrarse*/
	function validarDatosUser(){
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[3]|max_length[20]|xss_clean');
		$this->form_validation->set_rules('apellido', 'Apellido', 'trim|required|min_length[3]|max_length[20]|xss_clean');
		$this->form_validation->set_rules('dni', 'DNI', 'trim|required|min_length[8]|max_length[8]|is_natural|xss_clean');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('telefono', 'Fono', 'trim|required|min_length[9]|max_length[10]|is_natural|xss_clean');
		$this->form_validation->set_rules('user', 'usuario', 'trim|required|alpha_numeric|xss_clean|min_length[6]|max_length[15]');
		$this->form_validation->set_rules('pass', 'usuario', 'trim|required|xss_clean|min_length[6]|max_length[20]');
	}
	function agregarUsuario(){
		$_POST=json_decode(file_get_contents('php://input'),TRUE);
		$nombre=$this->input->post('nombre');
		$apellido=$this->input->post('apellido');
		$dni=$this->input->post('dni');
		$email=$this->input->post('email');
		$fono=$this->input->post('telefono');
		$usuario=$this->input->post('user');
		$password=$this->input->post('pass');
		$this->validarDatosUser();
		if($this->form_validation->run()!=FALSE){
			if ($this->modelo->existeUsuario($usuario)==null) {
				$Ausuario=array('usuario'=>$usuario,'password'=>$password,'idtipousuario'=>'2');
				$iduser=$this->modelo->agregarUsuario($Ausuario);
				if ($iduser!=null) {
					settype($iduser["0"], "array");
					$Adatos=array('nombre'=>$nombre,'apellido'=>$apellido,'dni'=>$dni,'email'=>$email,'fono'=>$fono,'idusuario'=>$iduser["0"]["idusuario"]);
					if ($this->modelo->agregarDatos($Adatos)) {
						$mensaje=$this->validarLogueo($usuario,$password);
					} else $mensaje['error']="El Usuario fue registrado pero no los datos, Por favor Actualize sus datos";
				} else $mensaje['error']="Ocurrió un error al intentar registrar el usuario";
			} else $mensaje['error']="Eliga otro usuario, el que proporciona ya se encuentra registrado";
		} else $mensaje['error']="Los datos proporcionados son incorrectos";
		echo json_encode($mensaje);
	}
}	
?>