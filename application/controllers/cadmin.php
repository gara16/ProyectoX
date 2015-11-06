<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cadmin extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('modelo');
	}

	function index(){
		if($this->session->userdata('tipouser') != '1') redirect('clogin');
		else $this->load->view('index.html');
	}

	function capturaDatosProducto(){
		$_POST=json_decode(file_get_contents('php://input'),TRUE);
		$nombre=$this->input->post('nombre');
		$precio=$this->input->post('precio');
		$stock=$this->input->post('stock');
		$medida=$this->input->post('idmedida');
		$tipo=$this->input->post('idtipo');
		$array= array('estado'=>'1','nombreprod'=>$nombre,'precio'=>$precio,'stock'=>$stock,'idmedida'=>$medida,'idtipoprod'=>$tipo);
		return $array;
	}
	function agregarProducto(){
		$array=$this->capturaDatosProducto();
		$this->validarProducto();
		if($this->form_validation->run()!=FALSE){
			if ($this->modelo->agregarProduct($array)){
				echo json_encode(array("respuesta" => "El producto fue registrado con éxito"));
            } else echo json_encode(array("respuesta" => "Hubo un error al registrar el producto"));
		} else echo json_encode(array("respuesta" => "Los datos proporcionados son erróneos"));
	}
	function modificarProducto(){
		$producto=$this->capturaDatosProducto();
		$this->validarProducto();
		if($this->form_validation->run()!=FALSE){
			$id=$this->input->post('0');
			if ($this->modelo->modificarProducto($id,$producto)) {
				echo json_encode(array("respuesta" => "El producto fue modificado con éxito"));
			} else echo json_encode(array("respuesta" => "Hubo un error al modificar el producto"));
		} else echo json_encode(array("respuesta" => "Los datos proporcionados son erróneos"));
	}
	function validarProducto(){
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('precio', 'Precio', 'trim|required|decimal');
		$this->form_validation->set_rules('stock', 'Stock', 'trim|required|is_natural');
		$this->form_validation->set_rules('idmedida', 'IdMedida', 'trim|required|is_natural');
		$this->form_validation->set_rules('idtipo', 'IdTipo', 'trim|required|is_natural');
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
	function eliminarProducto(){
		$_POST=json_decode(file_get_contents('php://input'),TRUE);
		$id=$this->input->post('idproducto');
		$producto=array('estado'=>'0');
		if ($this->modelo->modificarProducto($id,$producto)) {
			$valor="Producto eliminado";
		} else $valor="Ocurrio un error al eliminar producto";
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

	/*Las funciones a continuación servien para permitir al administrador agregar
	a proveedores quienes seran los encargados de abastecer de productos a la empresa*/
	function capturaDatosProv(){
		$_POST=json_decode(file_get_contents('php://input'),TRUE);
		$nombre=$this->input->post('nombre');
		$apellido=$this->input->post('apellido');
		$address=$this->input->post('address');
		$compania=$this->input->post('compania');
		$fono=$this->input->post('fono');
		$dni=$this->input->post('dni');
		$ruc=$this->input->post('ruc');
		$datos=array('nombre'=>$nombre,'apellido'=>$apellido,'direccion'=>$address,'compañia'=>$compania,'fono'=>$fono,'dni'=>$dni,'ruc'=>$ruc,'estado'=>'1');
		return $array;
	}
	function validarDatosProv(){
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[3]|max_length[25]|xss_clean');
		$this->form_validation->set_rules('apellido', 'Apellido', 'trim|required|min_length[3]|max_length[25]|xss_clean');
		$this->form_validation->set_rules('address', 'Direccion', 'trim|required|min_length[5]|max_length[40]|xss_clean');
		$this->form_validation->set_rules('compania', 'Compañia', 'trim|required|min_length[5]|max_length[20]|xss_clean');
		$this->form_validation->set_rules('fono', 'Fono', 'trim|required|is_natural|xss_clean|max_length[9]');
		$this->form_validation->set_rules('dni', 'DNI', 'trim|required|min_length[8]|max_length[8]|is_natural|xss_clean');
		$this->form_validation->set_rules('ruc', 'RUC', 'trim|required|xss_clean|min_length[11]|max_length[11]|is_natural');
	}
	function agregarProveedor(){
		$array=$this->capturaDatosProv();
		$this->validarDatosProv();
		if($this->form_validation->run()!=FALSE){
			if ($this->modelo->agregarProveedor($array)){
				echo json_encode(array("respuesta" => "El proveedor fue registrado con éxito"));
            } else echo json_encode(array("respuesta" => "Hubo un error al registrar el proveedor"));
		} else echo json_encode(array("respuesta" => "Los datos proporcionados son erróneos"));
	}
	function listarProveedor(){
		$array = $this->modelo->listarProveedor();
		if (count($array)>0) $valor['lista']=$array;
		else $valor['error']="No hay Proveedores";
		echo json_encode($valor);
	}
	function modificarProveedor(){
		$array=$this->capturaDatosProv();
		$this->validarDatosProv();
		if($this->form_validation->run()!=FALSE){
			$id=$this->input->post('0');
			if ($this->modelo->modificarProveedor($id,$array)) {
				echo json_encode(array("respuesta" => "El proveedor fue modificado con éxito"));
			} else echo json_encode(array("respuesta" => "Hubo un error al modificar el proveedor"));
		} else echo json_encode(array("respuesta" => "Los datos proporcionados son erróneos"));
	}
	function eliminarProveedor(){
		$_POST=json_decode(file_get_contents('php://input'),TRUE);
		$id=$this->input->post('idproveedor');
		$proveedor=array('estado'=>'0');
		if ($this->modelo->modificarProducto($id,$proveedor)) {
			$valor="Proovedor eliminado";
		} else $valor="Ocurrio un error al eliminar Proovedor";
		echo json_encode($valor);
	}
	function buscarProveedor(){
		$_POST=json_decode(file_get_contents('php://input'),TRUE);
		$id=$this->input->post('idproveedor');
		$array = $this->modelo->buscarProveedor($id);
		$valor['id']=$id;
		if (count($array)>0) $valor['lista']=$array;
		else $valor['error']="No Existe Proveedor";
		echo json_encode($valor);
	}
}
?>		