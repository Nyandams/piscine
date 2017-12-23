<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editeur extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Permet de gérer les urls
		$this->load->helper('url');


		// Récupération des données de l'Editeur
		$this->load->model("Editeur/EditeurFactory", "fact");
		$this->load->model("Editeur/DTO/EditeurDTO", "dto");
		$this->load->model("Editeur/DTO/EditeurCollection");
		$this->load->model("Editeur/DAO/EditeurDAO", "dao");

	
	}
	
	//affiche le tableau des éditeurs
	public function accueilSimple() {
		$data['page'] = $this->tableauEditeur();
		$this->load->view("Theme/theme", $data);

		
	}


	// @return tableau des éditeurs prêt à être affiché dans une page.
	public function tableauEditeur () {
		$instanceDao = $this->fact->getInstance();
		$data['editeursDto'] = $instanceDao->getEditeurs();
		return $this->load->view("Editeur/tabEditeur", $data, true);
		
	}

	/* Modifie un éditeur via une requete
	@param : idEditeur : int
	*/
	public function modifierEditeur() {

	}

	/* Supprime un éditeur via une requete
	@param : idEditeur : int
	*/
	public function supprimerEditeur() {
		$idEditeur = $this->input->get("idEditeur");
		$instanceDao = $this->fact->getInstance();
		$supp = $instanceDao->getEditeurById($idEditeur);
		$instanceDao->deleteEditeur($supp);
		redirect('/editeur/accueilsimple', 'refresh');
	}
}