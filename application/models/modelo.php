<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class Modelo extends CI_Model{

	function __construct(){
		parent:: __construct();
		$this->load->database();
	}

	function agregarProducto($producto){
		if ($this->db->insert('producto',$producto)) {
			return true;
		} else return false;
	}

	function listarProducto(){
		$datos=$this->db->select('nombreprod,precio,img')->from('producto')->get()->result();
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