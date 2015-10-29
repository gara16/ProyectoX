<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class Modelo extends CI_Model{

	function __construct(){
		parent:: __construct();
		$this->load->database();
	}

	function agregarProduct($producto){
		if ($this->db->insert('producto',$producto)) {
			return true;
		} else {
			return false;
		}
	
	}

	function listarProducto(){
		$datos=$this->db->select('idproducto,nombreprod,precio,img')->from('producto')->get()->result();
		return $datos;
	}

	function listartipoprod(){
		$datos=$this->db->select('idtipoprod,tipoprod,descripcion')->from('tipoproducto')->get()->result();
		return $datos;
	}

	function listarmedida(){
		$datos=$this->db->select('idmedida,medida,descripcion')->from('unidadmedida')->get()->result();
		return $datos;
	}

	function modificarProducto($id,$producto){
		$this->db->where('idproducto',$id);
		if ($this->db->update('producto',$producto)) {
			return true;
		} else return false;
	}

}

?>