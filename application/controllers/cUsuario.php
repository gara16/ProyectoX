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
			settype($iddatos["0"], "array");
			$Ausuario=array('usuario'=>$usuario,'password'=>$password,'idtipousuario'=>'2','iddatos'=>$iddatos["0"]["iddatos"]);
			$valor=$this->modelo->agregarUsuario($Ausuario);
			if ($valor) {
				$mensaje = "Se Agrego Usuario correctamente";
			}else $mensaje="Error a Crear Usuario";
		}else{
			$this->modelo->eliminarDatos($dni);
			$mensaje="Vale Verga laVida";
		} 

		echo json_encode($mensaje);

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