<?php
class CUsuario extends CI_Controller{
	function __construct(){
		parent:: __construct();
		$this->load->modelo('modelo');
		$this->load->helper('url');
	}

	function index(){
		$this->load->view('usuario.html');
	}

	function agregarUsuario(){
		$_POST=json_decode(file_get_contents('php://input'),TRUE);
		$nombre=$this->input->post('nombre');
		$apellido=$this->input->post('apellido');
		$dni=$this->input->post('dni');
		$email=$this->input->post('email');
		$telefono=$this->input->post('telefono');
		$usuario=$this->input->post('user');
		$password=$this->input->post('pass');
		$Adatos=array('nombre'=>$nombre,'apellido'=>$apellido,'dni'=>$dni,'email'=>$email);
		$Ausuario=array('usuario'=>$usuario,'password'=>$password);
		$datos=$this->modelo->agregarUsuario($Adatos);
		$usuario=$this->modelo->agregarDatos($Ausuario);
		if ($datos && $usuario) {
			$mensaje['ok']="Usuario agregado correctamente";
		} else $mensaje['error']="Error al intentar agregar el usuario";
	}
	function listarProducto(){
		
	}
}
?>