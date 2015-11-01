<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cproducto extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('modelo');
	}

	function index(){
		$this->load->view('index.html');
	}

	function capturaDatos(){
		$_POST=json_decode(file_get_contents('php://input'),TRUE);
		$nombre=$this->input->post('nombre');
		$precio=$this->input->post('precio');
		$stock=$this->input->post('stock');
		$medida=$this->input->post('idmedida');
		$tipo=$this->input->post('idtipo');
		$array= array('nombreprod'=>$nombre,'precio'=>$precio,'stock'=>$stock,'idmedida'=>$medida,'idtipoprod'=>$tipo);
		return $array;
	}
	function agregarProducto($nombre,$precio,$stock,$medida,$tipo){
		$array=$this->capturaDatos();
		$flag = $this->modelo->agregarProduct($array);
		if ($flag) {
			$mensaje['ok']="Producto registrado exitosamente";
		} else{
			$mensaje['error']="Ocurrió un error al intentar registrar el producto";
		}
		echo json_encode($mensaje);
	}
	function validaciones(){
		
	}
	function listarProducto(){
		$array = $this->modelo->listarProducto();
		if (count($array)>0) {
			$valor['lista']=$array;
		} else{
			$valor['error']="No hay Productos";
		}
		echo json_encode($valor);
	}
	function listarPorTipo($idTipo){
		$array=$this->modelo->listarPorTipo($idTipo);
		if (count($array)>0) {
			$valor['lista']=$array;
		} else{
			$valor['error']="No se han encontrado Productos";
		}
		echo json_encode($valor);
	}
	function listarTipo(){
		$array = $this->modelo->listartipoprod();
		if (count($array)>0) {
			$valor['lista']=$array;
		} else{
			$valor['error']="No hay Tipos";
		}
		echo json_encode($valor);
	}
	function listarMedida(){
		$array = $this->modelo->listarmedida();
		if (count($array)>0) {
			$valor['lista']=$array;
		} else{
			$valor['error']="No hay Medidas";
		}
		echo json_encode($valor);
	}

	function buscarProducto($id){
		$array = $this->modelo->buscarProducto($id);
		if (count($array)>0) {
			$valor['lista']=$array;
		} else{
			$valor['error']="No Existe Producto";
		}
		echo json_encode($valor);
	}
}

?>