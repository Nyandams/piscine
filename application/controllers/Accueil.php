<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accueil extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Permet de gérer les urls
		$this->load->helper('url');
	
	}
	
	public function accueilSimple() {
		$data['page'] = $this->load->view("tabTest", '', true);
		$this->load->view("accueilSimple/index", $data);
	}
}