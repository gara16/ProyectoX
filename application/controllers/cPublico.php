<?php
class CPublico extends CI_Controller{
	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		$this->load->modelo('modelo');
	}

	function index(){
		$this->load->view('');
	}
}
?>