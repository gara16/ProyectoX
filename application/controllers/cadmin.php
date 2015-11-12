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
				$mensaje['dato']="El producto fue registrado con éxito";
            } else $mensaje['error']="Hubo un error al registrar el producto";
		} else $mensaje['error']="Los datos proporcionados son erróneos";
		echo json_encode($mensaje);
	}
	function modificarProducto(){
		$producto=$this->capturaDatosProducto();
		$this->validarProducto();
		if($this->form_validation->run()!=FALSE){
			$id=$this->input->post('0');
			if ($this->modelo->modificarProducto($id,$producto)) {
				$mensaje['respuesta'] = "El producto fue modificado con éxito";
			} else $mensaje['respuesta'] = "Hubo un error al modificar el producto";
		} else $mensaje['respuesta'] = "Los datos proporcionados son erróneos";
		echo json_encode($mensaje);
	}
	function validarProducto(){
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[2]|max_length[30]');
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
			$valor="Exito al eliminar producto";
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
		$datos=array('nombre'=>$nombre,'apellido'=>$apellido,'direccion'=>$address,'compania'=>$compania,'fono'=>$fono,'dni'=>$dni,'ruc'=>$ruc,'estado'=>'1');
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

	/*Las funciones que vienen a continuacion nos serviran para realizar operaciones 
	con lo que respecta a la entidad usuario de tipo administrador*/
	function validarDatosUser(){
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[3]|max_length[20]|xss_clean');
		$this->form_validation->set_rules('apellido', 'Apellido', 'trim|required|min_length[3]|max_length[20]|xss_clean');
		$this->form_validation->set_rules('dni', 'DNI', 'trim|required|min_length[8]|max_length[8]|is_natural|xss_clean');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('telefono', 'Fono', 'trim|required|min_length[9]|max_length[10]|is_natural|xss_clean');
		$this->form_validation->set_rules('user', 'usuario', 'trim|required|alpha_numeric|xss_clean|min_length[6]|max_length[15]');
		$this->form_validation->set_rules('pass', 'usuario', 'trim|required|xss_clean|min_length[6]|max_length[20]');
	}
	function agregarAdministrador(){
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
				$Ausuario=array('usuario'=>$usuario,'password'=>$password,'idtipousuario'=>'1');
				$iduser=$this->modelo->agregarUsuario($Ausuario);
				if ($iduser!=null) {
					settype($iduser["0"], "array");
					$Adatos=array('nombre'=>$nombre,'apellido'=>$apellido,'dni'=>$dni,'email'=>$email,'fono'=>$fono,'idusuario'=>$iduser["0"]["idusuario"]);
					if ($this->modelo->agregarDatos($Adatos)) {
						$mensaje['data']="El Administrador fue agregado con éxito";
					} else $mensaje['error']="El Administrador fue registrado pero no los datos, Por favor Actualize sus datos";
				} else $mensaje['error']="Ocurrió un error al intentar registrar al Administrador";
			} else $mensaje['error']="Eliga otro Administrador, el que proporciona ya se encuentra registrado";
		} else $mensaje['error']="Los datos proporcionados son incorrectos";
		echo json_encode($mensaje);
	}
	function listarAdministrador(){
		$datos=$this->modelo->listarUsuario('1');
		if (count($datos)>0) $valor['lista']=$datos;
		else $valor['error']="No hay Administradores";
		echo json_encode($valor);
	}
	function ActualizarAdministrador(){
		$_POST=json_decode(file_get_contents('php://input'),TRUE);
		$nombre=$this->input->post('nombre');
		$apellido=$this->input->post('apellido');
		$dni=$this->input->post('dni');
		$email=$this->input->post('email');
		$fono=$this->input->post('telefono');
		$usuario=$this->input->post('user');
		$password=$this->input->post('pass');
		$idUsuario=$this->input->post('id');
		$this->validarDatosUser();
		if($this->form_validation->run()!=FALSE){
		$newDatos=array('nombre'=>$nombre,'apellido'=>$apellido,'dni'=>$dni,'email'=>$email,'fono'=>$fono);
			if ($this->modelo->modificarDatos($idUsuario,$newDatos)) {
				$mensaje['data']="Los datos fueron modificados con éxito";
			} else $mensaje['error']="Ocurrió un error al intentar actualizar sus datos";
		} else $mensaje['error']="Los datos proporcionados son incorrectos";
		echo json_encode($mensaje);
	}
}
?>		