<?php
class CUsuario extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('cart');
		date_default_timezone_set('America/Bogota');
		$this->load->model('modelo');
	}

	function index(){
		if($this->session->userdata('tipouser') != '2') redirect('clogin');
		else $this->load->view('index.html');
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

	/*Las funciones que continuan son parte del carrito de compras que se usara
	para ir registrando cada una de los productos que el cliente desea*/
	function agregarProducto(){
		$_POST=json_decode(file_get_contents('php://input'),TRUE);
		$id=$this->input->post('idproducto');
		$cant=$this->input->post('cantidad');
		$this->validarCarrito();
		if ($this->form_validation->run()!=FALSE) {
			$producto=$this->modelo->buscarProducId($id);
			if ($producto!=null) {
				foreach ($this->cart->contents() as $item) {
		            if ($item['id'] == $id) $cant = $cant + $item['qty'];
	        	}
	        	settype($producto["0"], "array");
	        	$array=array('id'=>$id,'qty'=>$cant,'price'=>$producto["0"]["precio"],'name'=>$producto["0"]["nombreprod"]);
	        	if ($this->cart->insert($array)) $mensaje['dato']="Producto agregado con éxito al carrito";
	        	else $mensaje['error']="Error al intentar agregar el producto al carrito";
			} else $mensaje['error']="No se encontro el producto";
		} else $mensaje['error']="Los datos proporcionados son incorrectos";
		echo json_encode($mensaje);
	}
	function validarCarrito(){
		$this->form_validation->set_rules('idproducto', 'ID', 'trim|required|is_natural|xss_clean');
		$this->form_validation->set_rules('cantidad', 'Cantidad', 'trim|required|is_natural|xss_clean');
	}
	function eliminarProducto($rowid){
        $producto=array('rowid'=>$rowid,'qty'=>0);
        if ($this->cart->update($producto)) {
        	$mensaje['dato']="Producto eliminado del carrito";
        } else $mensaje['error']="Error al intentar eliminar el producto del carrito";
        echo json_encode($mensaje);
    }
    function mostrarCarrito(){
    	$array=array();
    	if ($this->cart->contents()) {
    		foreach ($this->cart->contents() as $item) {
		        $arrayProduc=array('idProducto'=>$item['id'],'precio'=>$item['price'],
		        	'nombre'=>$item['name'],'cantidad'=>$item['qty'],'idcarro'=>$item['rowid']);
		        array_push($array,$arrayProduc);
	        }
    	} else $mensaje['error']="Su carrito de compras esta vacio";
    	echo json_encode($array);
    }
    function eliminarCarrito() {
        $this->cart->destroy();
        $mensaje['dato']="Carrito de compras eliminado exitosamente";
        echo json_encode($mensaje);
    }
    function crearBoleta(){
    	if ($this->cart->contents()) {
	    	$array=array('fecha'=>date('Y-m-d'),'hora'=>date("H:i:s"),'idusuario'=>$this->session->userdata('idUser'),
	    		'preciototal'=>$this->cart->total(),'estado'=>'0');
	    	if ($this->modelo->crearBoleta($array)) {
	    		$idBoleta=$this->estadoBoleta();
	    		if ($idBoleta!=null) {
	    			foreach ($this->cart->contents() as $item) {
				        $detalle=array('idboleta'=>$idBoleta,'idproducto'=>$item['id'],
				        	'cantidad'=>$item['qty'],'preciounit'=>$item['price']);
				        $this->modelo->agregarDetalleBol($detalle);
		        	}
		        	$this->cart->destroy();
		        	$estado=array('estado'=>'1');
		        	if ($this->modelo->cambiarEstadoBol($idBoleta,$estado)) {
		        		$mensaje['dato']="La compra ha sido realizada con exito";
		        	} else $mensaje['error']="Ocurrio un error al momento de realizar la compra";
	    		} else $mensaje['error']="Ocurrio un error al momento de realizar la compra";
	    	} else $mensaje['error']="No se pudo realizar la compra";
    	} else $mensaje['error']="El carro de compras esta vacio";
    	echo json_encode($mensaje);
    }
    function estadoBoleta(){
    	$id=$this->modelo->buscaIdBoleta($this->session->userdata('idUser'));
    	if ($id!=null) {
    		settype($id["0"],"array");
    		return $mensaje=$id["0"]["idboleta"];
    	} else return null;
    }
}
?>