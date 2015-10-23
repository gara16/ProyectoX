<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');
class CProducto extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('modelo');
	}

	public function index(){
		$this->load->view('index.html');
	}

	public function agregarProducto(){
		$_POST=json_decode(file_get_contents('php://input'),TRUE);
		$nombre=$this->input->post('nombre');
		$precio=$this->input->post('precio');
		$stock=$this->input->post('stock');
		$medida=$this->input->post('idmedida');
		$tipo=$this->input->post('idtipo');
		$array= array('nombreprod'=>$nombre,'precio'=>$precio,'stock'=>$stock,'idmedida'=>$medida,'idtipoprod'=>$tipo);
		$flag = $this->modelo->agregarProducto($array);
		if ($flag) {
			$mensaje['ok']="Producto registrado exitosamente";
		} else{
			$mensaje['error']="Ocurrió un error al intentar registrar el producto";
		}
		echo json_encode($mensaje);
	}
}

?>