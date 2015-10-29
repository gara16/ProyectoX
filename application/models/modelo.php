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
		$datos=$this->db->select('idproducto,nombreprod,precio,img')->from('producto')->get()->result();
		return $datos;
	}
	function listarPorTipo($tipoProd){
		$datos=$this->db->select('idproducto,nombreprod,precio,img')
		->where('idtipoprod',$tipoProd)->from('producto')->get()->result();
		return $datos;
	}
	/*la funcion modificar tambien servirá para realizar la eliminacion lógica de un producto*/
	function modificarProducto($id,$producto){
		$this->db->where('idproducto',$id);
		if ($this->db->update('producto',$producto)) {
			return true;
		} else return false;
	}
	function listartipoprod(){
		$datos=$this->db->select('idtipoprod,tipoprod')->from('tipoproducto')->get()->result();
		return $datos;
	}

	function listarmedida(){
		$datos=$this->db->select('idmedida,medida')->from('unidadmedida')->get()->result();
		return $datos;
	}

	/*La funcion a continuacion es la que nos permitirá tener acceso al sistema dependiendo 
	del nivel de usuario con el cual cuenta*/
	function loguear($usuario,$password){
		$this->db->where('usuario',$usuario)->from('usuario');
		if ($this->db->count_all_results() === 1) {
			$logueo=$this->db->select('idtipousuario')
			->where('usuario',$usuario)->where('password',$password)
			->from('usuario')->get()->result();
			return $logueo;
		} else return false;
	}

	/*Las funciones a continuación tienen por objetivo realizar operaciones en cuento a la entidad usuario
	y otras entidades con las que se relaciona como son datos, tipousuario*/
	function agregarUsuario($usuario){
		if ($this->db->insert('usuario',$usuario)) {
			return true;
		} else return false;
	}
	function modificarUsuario($idUsuario,$usuario){
		$this->db->where('idusuario',$idUsuario);
		if ($this->db->update('usuario',$usuario)) {
			return true;
		} else return false;
	}
	function listarUsuario($tipoUser){
		$datos=$this->db->select('d.nombre','d.apellido','d.dni','d,email','d.img')
		->from('datos d')
		->join('usuario u','u.iddatos=d.iddatos')
		->join('tipousuario tuser','tuser.tipousuario=u.idtipousuario')
		->where('idtipousuario',$tipoUser)
		->get->result();
		return $datos;
	}
	
	/*Las funciones que se listan a continuación estan relacionadas con la entidad pedido
	y otras con las cuales esta relacionado como pedido*/
	function agregarPedido($pedido){
		if ($this->db->insert('pedido',$pedido)) {
			return true;
		} else return false;
	}
	function listarProveedor(){
		$datos=$this->db->select('nombre,apellidocompañia,img')
		->from('proveedor')->get()->result();
		return $datos;
	}
	function listarProveedorPorId($idProveedor){
		$datos=$this->db->select('nombre,apellido,direccion,compañia,fono,dni,ruc,img')
		->where('idproveedor',$idProveedor)->get()->result();
		return $datos;
	}
	function modificarProveedor($idProveedor){
		$this->db->where('idproveedor',$idProveedor);
		if ($this->db->update('proveedor',$idProveedor)) {
			return true;
		} else return false;
	}
}

?>