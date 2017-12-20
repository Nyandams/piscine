<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accueil extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Permet de gérer les urls
		$this->load->helper('url');


		// Récupération des données de l'Editeur
		$this->load->model("Editeur/EditeurFactory", "fact");
		$this->load->model("Editeur/DTO/EditeurDTO", "dto");
		$this->load->model("Editeur/DTO/EditeurCollection");
	
	}
	
	public function accueilSimple() {
		$data['page'] = $this->tableauEditeur();
		$this->load->view("accueilSimple/index", $data);
	}


	// @return tableau des éditeurs prêt à être affiché dans une page.
	public function tableauEditeur () {
		$dao = $this->fact->getInstance();
		$data['editeursDto'] = $dao->getEditeurs();
		return $this->load->view("tabEditeur", $data, true);
		
	}
}