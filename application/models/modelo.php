<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class Modelo extends CI_Model{
	function __construct(){
		parent:: __construct();
		$this->model->database();
	}

	function agregarProducto($producto){
		if ($this->db->insert('producto',$producto)) {
			return true;
		} else return false;
	}

}

?>