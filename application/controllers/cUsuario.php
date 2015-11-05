<?php
class CUsuario extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->model('modelo');
	}

	function index(){
		if($this->session->userdata('tipouser') != '2') redirect('clogin');
		else $this->load->view('usuario.html');
	}

	function listarProducto(){
		$array = $this->modelo->listarProducto();
		if (count($array)>0) $valor['lista']=$array;
		else $valor['error']="No hay Productos";
		echo json_encode($valor);
	}
	function listarPorTipo($idTipo){
		$array=$this->modelo->listarPorTipo($idTipo);
		if (count($array)>0) $valor['lista']=$array;
		else $valor['error']="No se han encontrado Productos";
		echo json_encode($valor);
	}
	function listarTipo(){
		$array = $this->modelo->listartipoprod();
		if (count($array)>0) $valor['lista']=$array;
		else $valor['error']="No hay Tipos"; 
		echo json_encode($valor);
	}
	function listarMedida(){
		$array = $this->modelo->listarmedida();
		if (count($array)>0) $valor['lista']=$array;
		else $valor['error']="No hay Medidas"; 
		echo json_encode($valor);
	}
	function buscarProducto(){
		$_POST=json_decode(file_get_contents('php://input'),TRUE);
		$id=$this->input->post('idproducto');
		$array = $this->modelo->buscarProducto($id);
		$valor['id']=$id;
		if (count($array)>0) $valor['lista']=$array;
		else $valor['error']="No Existe Producto";
		echo json_encode($valor);
	}

}
?>