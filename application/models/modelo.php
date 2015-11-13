<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class Modelo extends CI_Model{

	function __construct(){
		parent:: __construct();
		$this->load->database();
	}

	/*Las siguientes funciones de este modelo están echas para realizar operaciones con respecto a la entidad producto 
	y sus relaciones con otras entidades como tipoproducto, unidadMedida*/
	function agregarProduct($producto){
		if ($this->db->insert('producto',$producto)) {
			return true;
		} else return false;
	}
	function listarProducto(){
		$datos=$this->db->select('idproducto,nombreprod,precio,stock,img')
			->from('producto')->where('estado','1')->get()->result();
		return $datos;
	}
	function listarProductoC(){
		$datos=$this->db->select('idproducto,nombreprod,precio,img')
			->from('producto')->where('estado','1')->get()->result();
		return $datos;
	}
	function listarPorTipo($tipoProd){
		$datos=$this->db->select('idproducto,nombreprod,precio,img')
		->where('idtipoprod',$tipoProd)->from('producto')->get()->result();
		return $datos;
	}
	function listarPorTipoC($tipoProd){
		$datos=$this->db->select('idproducto,nombreprod,precio,img')
		->where('idtipoprod',$tipoProd)->from('producto')->get()->result();
		return $datos;
	}
	/*la funcion modificar tambien servirá para realizar la eliminacion lógica de un producto*/
	function buscarProducto($id){
		$datos=$this->db->select('nombreprod as nombre,precio,stock,idmedida,idtipoprod as idtipo')
			->where('idproducto',$id)->from('producto')->get()->result();
		return $datos;
	}
	/*solo trae como resultado el nombre y el precio del producto*/
	function buscarProducId($id){
		$dato=$this->db->select('nombreprod,precio')->where('idproducto',$id)
		->where('estado','1')->from('producto')->get()->result();
		return $dato;
	}
	function modificarProducto($id,$producto){
		$this->db->where('idproducto',$id);
		if ($this->db->update('producto',$producto)) {
			return true;
		} else return false;
	}

	function listartipoprod(){
		$datos=$this->db->select('idtipoprod,tipoprod')->where('estado','1')
		->from('tipoproducto')->get()->result();
		return $datos;
	}

	function listarmedida(){
		$datos=$this->db->select('idmedida,medida')->where('estado','1')
		->from('unidadmedida')->get()->result();
		return $datos;
	}

	/*La funcion a continuacion es la que nos permitirá tener acceso al sistema dependiendo 
	del nivel de usuario con el cual cuenta*/
	function loguear($usuario,$password){
		$this->db->where('usuario',$usuario)->from('usuario');
		if ($this->db->count_all_results() === 1) {
			$logueo=$this->db->select('idusuario,idtipousuario')
			->where('usuario',$usuario)->where('password',$password)->where('estado','1')
			->from('usuario')->get()->result();
			return $logueo;
		} else return false;
	}

	/*Las funciones a continuación tienen por objetivo realizar operaciones en cuento a la entidad usuario
	y otras entidades con las que se relaciona como son datos, tipousuario*/
	function existeUsuario($usuario){
		$dato=$this->db->select('idusuario')->where('usuario',$usuario)
			->from('usuario')->get()->result();
		return $dato;
	}
	function agregarUsuario($usuario){
		if ($this->db->insert('usuario',$usuario)) {
			return $this->existeUsuario($usuario['usuario']);
		} else return null;
	}
	function agregarDatos($datos){
		if ($this->db->insert('datos',$datos)) {
			return true;
		} else return false;
	}
	function modificarUsuario($idUsuario,$usuario){
		$this->db->where('idusuario',$idUsuario);
		if ($this->db->update('usuario',$usuario)) {
			return true;
		} else return false;
	}

	function modificarDatos($idUsuario,$newDatos){
		$this->db->where('idusuario',$idUsuario);
		if ($this->db->update('datos',$newDatos)) {
			return true;
		} else return false;
	}

	function listarUsuario($tipoUser){
		$datos=$this->db->select('d.nombre,d.apellido,d.dni,d.email,d.img')
		->from('datos d')
		->join('usuario u','u.idusuario=d.idusuario')
		->join('tipousuario tuser','tuser.tipousuario=u.idtipousuario')
		->where('u.idtipousuario',$tipoUser)->where('u.estado','1')
		->get()->result();
		return $datos;
	}
	
	/*Las funciones que se listan a continuación estan relacionadas con la entidad pedido
	y otras con las cuales esta relacionado como pedido*/
	function agregarPedido($pedido){
		if ($this->db->insert('pedido',$pedido)) {
			return true;
		} else return false;
	}
	function agregarProveedor($proveedor){
		if ($this->db->insert('proveedor',$proveedor)) {
			return true;
		} else return false;
	}
	function listarProveedor(){
		$datos=$this->db->select('idproveedor,nombre,apellido,direccion,compania,fono,dni,ruc')
		->where('estado','1')->from('proveedor')->get()->result();
		return $datos;
	}
	function buscarProveedor($idProveedor){
		$dato=$this->db->select('nombre,apellido,direccion,compania,fono,dni,ruc')
		->from('proveedor')->where('idproveedor',$idProveedor)->where('estado','1')->get()->result();
		return $dato;
	}
	function modificarProveedor($idProveedor,$proveedor){
		$this->db->where('idproveedor',$idProveedor);
		if ($this->db->update('proveedor',$proveedor)) {
			return true;
		} else return false;
	}

	/*Las siguientes funciones estan relacionadas a operaciones con la boleta*/
	function crearBoleta($pedido){
		if ($this->db->insert('boleta',$pedido)) {
			return true;
		} else return false;
	}
	function agregarDetalleBol($detalle){
		if ($this->db->insert('detalleboleta',$detalle)) {
			return true;
		} else return false;
	}
	function buscaIdBoleta($idusuario){
		$dato=$this->db->select('idboleta')->from('boleta')->where('idusuario',$idusuario)
		->where('estado','0')->get()->result();
		return $dato;
	}
	function cambiarEstadoBol($idboleta,$estado){
		$this->db->where('idboleta',$idboleta);
		if ($this->db->update('boleta',$estado)) {
			return true;
		} else return false;
	}
}

?>