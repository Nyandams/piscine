<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jeu extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Permet de gérer les urls
		$this->load->helper('url');

		//Permet de gérer les formulaires
		 $this->load->helper('form');
		
		if (!$this->session->has_userdata('connexionOrganisateur')){
		    redirect('/welcome');
		} else {
		    // Récupération des données de Contact
		    $this->load->model("Jeu/JeuFactory", "fact");
		    $this->load->model("Jeu/DTO/JeuDTO", "dto");
		    $this->load->model("Jeu/DTO/JeuCollection");
		    $this->load->model("Jeu/DAO/JeuDAO", "dao");

		    // Récupération des éditeurs
		    $this->load->model("Editeur/EditeurFactory", "factEditeur");
		    $this->load->model("Editeur/DTO/EditeurDTO", "dtoEditeur");
		    $this->load->model("Editeur/DTO/EditeurCollection");
		    $this->load->model("Editeur/DAO/EditeurDAO", "daoEditeur");


		    // Rècupération des types du jeu
		    $this->load->model("TypeJeu/TypeJeuFactory", "factTypeJeu");
		    $this->load->model("TypeJeu/DTO/TypeJeuDTO", "dtoTypeJeu");
		    $this->load->model("TypeJeu/DTO/TypeJeuCollection");
		    $this->load->model("TypeJeu/DAO/TypeJeuDAO", "daoTypeJeu");

		    //Recupération des données de l'éditeur
		    $this->load->model("Editeur/DAO/EditeurDAO");
		}
	}

	public function index() {
	    $this->JeuListe();
	    
	}

	//affiche le tableau des jeux
	public function JeuListe() {
		$data['page'] = $this->tableauJeu();
		$data['title']= 'Jeux';
		$this->load->view("Theme/theme", $data);	
	}



	// @return tableau des jeux .
	public function tableauJeu () {
		$instanceDao = $this->fact->getInstance();
		$data['jeuDto'] = $instanceDao->getJeu();
		return $this->load->view("Jeu/tabJeu", $data, true);
	}


	/* Modifie un jeu via une requete
	@param : idJeu : int
	*/
	public function modifierJeu($id) {

	}



	// Ajoute un jeu via une méthode post 
	public function ajouterJeu() {
		// création du dto qu'on va envoyer
		$dto = new JeuDTO();
		$dto->setIdJeu(null);
		$dto->setLibelleJeu($this->input->post('libelleJeu'));
		$dto->setnbMinJoueurJeu($this->input->post('nbMinJoueurJeu'));
		$dto->setnbMaxJoueurJeu($this->input->post('nbMaxJoueurJeu'));
		$dto->setnoticeJeu($this->input->post('noticeJeu'));
		$dto->setIdEditeur(12); 
		$dto->setIdTypeJeu(11);

		//je pense que c'est possible de récupérer une valeur pour idEditeur et idTpyeJeu

		// Envoie du dto
		$instanceDao = $this->fact->getInstance();
		$instanceDao->saveJeu($dto);
		redirect('/Jeu/JeuListe');

	}








