<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Clogin extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		$this->load->model('modelo');
	}

	function index(){
		$this->load->view('logueo.html');
	}

	function loguear(){
		$_POST=json_decode(file_get_contents('php://input'),TRUE);
		$user=$this->input->post('usuario');
		$password=$this->input->post('password');
		$dato=$this->modelo->loguear($user,$password);
		settype($dato['0'],"array");
		if ($dato!=null) {
			$tipo=$dato['0']['idtipousuario'];
			if ($tipo==1) {
				redirect('cProducto');
			} else if ($tipo==2) {
				redirect('cCliente');
			} else redirect('cPublico');
		} else $mensaje['notLogueo']="Usuario o password no son correctas";
	}
}	
?>