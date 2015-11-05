<?php
class CUsuario extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->helper('security');
		$this->load->model('modelo');
		$this->load->helper('url');
	}

	function index(){
		$this->load->view('usuario.html');
		
	}

	/*function  agregarDatos(){
		$_POST=json_decode(file_get_contents('php://input'),TRUE);
		$nombre=$this->input->post('nombre');
		$apellido=$this->input->post('apellido');
		$dni=$this->input->post('dni');
		$email=$this->input->post('email');
		$telefono=$this->input->post('telefono');
		$Adatos=array('nombre'=>$nombre,'apellido'=>$apellido,'dni'=>$dni,'email'=>$email,'telefono'=>$telefono);
		$iddatos=$this->modelo->agregarDatos($Adatos);
		if ($iddatos!=null) {
			$mensaje=$iddatos;
		} else $mensaje="Error al intentar agregar el usuario";
		echo json_encode($mensaje);
	}
	
	function agregarUsuario(){
		$_POST=json_decode(file_get_contents('php://input'),TRUE);
		$user=$this->input->post('user');
		$pass=$this->input->post('pass');
		$iddato=$this->input->post('iddatos');
		if ($iddato!=null) {
			$Ausuario=array('usuario'=>$user,'password'=>$pass,'idtipousuario'=>'0','iddatos'=>$iddato);
			$valor=$this->modelo->agregarUsuario($Ausuario);
			if ($valor) {
			$mensaje="Usuario agregado correctamente";
			} else $mensaje="Error al intentar agregar el usuario";

		} else $mensaje="Error al intentar agregar el usuario";
	}
	*/

	function agregarUsuario(){
		$_POST=json_decode(file_get_contents('php://input'),TRUE);
		$nombre=$this->input->post('nombre');
		$apellido=$this->input->post('apellido');
		$dni=$this->input->post('dni');
		$email=$this->input->post('email');
		$telefono=$this->input->post('telefono');
		$usuario=$this->input->post('user');
		$password=$this->input->post('pass');

		$Adatos=array('nombre'=>$nombre,'apellido'=>$apellido,'dni'=>$dni,'email'=>$email,'telefono'=>$telefono);
		$iddatos=$this->modelo->agregarDatos($Adatos);
		if ($iddatos!=null) {
			$Ausuario=array('usuario'=>$usuario,'password'=>$password,'idtipousuario'=>'0','iddatos'=>$iddatos);
			$valor=$this->modelo->agregarUsuario($Ausuario);
			if ($valor) {
				$mensaje = "Se Agrego Usuario correctamente";
			}else $mensaje="Error a Crear Usuario";
		} else $this->modelo->eliminarDatos($dni);

		$usuario=$this->input->post('usuario');
		$password=$this->input->post('password');
		$this->validar();
		if($this->form_validation->run()!=FALSE){
			if ($this->modelo->existeUsuario($usuario)==null) {
				$Ausuario=array('usuario'=>$usuario,'password'=>$password,'idtipousuario'=>'2');
				$iduser=$this->modelo->agregarUsuario($Ausuario);
				if ($iduser!=null) {
					settype($iduser["0"], "array");
					$Adatos=array('nombre'=>$nombre,'apellido'=>$apellido,'dni'=>$dni,'email'=>$email,'idusuario'=>$iduser["0"]["idusuario"]);
					if ($this->modelo->agregarDatos($Adatos)) {
						return json_encode(array("respuesta"=>"El Usuario y los datos fue registrado con éxito"));
					} else return json_encode(array("respuesta"=>"El Usuario fue registrado pero no los datos, Por favor Actualize sus datos"));
				} else return json_encode(array("respuesta"=>"Ocurrió un error al intentar registrar el usuario"));
			} else return json_encode(array("respuesta"=>"el usuario ya esta registrado"));
		} else return json_encode(array("respuesta"=>"Los datos proporcionados son incorrectos"));

	}

	function validar(){
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[5]|max_length[20]|xss_clean');
		$this->form_validation->set_rules('apellido', 'Apellido', 'trim|required|min_length[5]|max_length[20]|xss_clean');
		$this->form_validation->set_rules('dni', 'DNI', 'trim|required|min_length[8]|max_length[8]|is_natural|xss_clean');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('usuario', 'usuario', 'trim|required|alpha_numeric|xss_clean|min_length[8]|max_length[15]');
		$this->form_validation->set_rules('password', 'usuario', 'trim|required|xss_clean|min_length[8]|max_length[20]');
	}
}
?>