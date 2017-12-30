<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FicheEditeur extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Permet de gérer les urls
		$this->load->helper('url');

		//Permet de gérer les formulaires
		 $this->load->helper('form');
		
		if (!$this->session->has_userdata('connexionOrganisateur')){
		    redirect('/welcome');
		} else {
		    // Récupération des données de l'Editeur
		    $this->load->model("Editeur/EditeurFactory", "fact");
		    $this->load->model("Editeur/DTO/EditeurDTO", "dto");
		    $this->load->model("Editeur/DTO/EditeurCollection");
		    $this->load->model("Editeur/DAO/EditeurDAO", "dao");

		    // Récupération des données pour l'editeur associé au contact
		    $this->load->model("EditeurContact/EditeurContactFactory");
		    $this->load->model("EditeurContact/DTO/EditeurContactDTO");
		    $this->load->model("EditeurContact/DTO/EditeurContactCollection");

		    // Récupération des données pour les réservations de l'éditeur
		    $this->load->model("Reservation/ReservationFactory");
		    $this->load->model("EditeurContact/DTO/EditeurContactDTO");
		    $this->load->model("EditeurContact/DTO/EditeurContactCollection");

		    // Récupération des données pour les jeux de l'éditeur
		    $this->load->model("Jeu/JeuFactory");
		    $this->load->model("Jeu/DTO/JeuDTO");
		    $this->load->model("Jeu/DAO/JeuDAO");
		    $this->load->model("Jeu/DTO/JeuCollection");

		}
	}
	
	// 
	public function index() {
		$data['page'] = $this->creationPage();
	    $this->load->view("Theme/theme", $data);
	}


	// Renvoie toute la fiche d'un éditeur
	public function creationPage() {
		$data["tabContact"] = $this->tabContact();
		$data["tabJeu"] = $this->tabJeu();
		

		return $this->load->view("FicheEditeur/fiche", $data,  true);

	}
	
	// Renvoie le tableau des contacts
	public function tabContact() {
		// Récupération du service
		$editContactDAO = $this->EditeurContactFactory->getInstance();
	
		// Récupération de tout les contacts et éditeur associés
		$data['ContactsEditeursDto'] = $editContactDAO->getEditeurContact();
		
		return $this->load->view("FicheEditeur/tabContact", $data, true);
	}

	// Renvoie la tableau des réservations
	public function tabReservation () {
		// Récupération du service
		$editContactDAO = $this->EditeurContactFactory->getInstance();
	
		// Récupération de tout les contacts et éditeur associés
		$data['ContactsEditeursDto'] = $editContactDAO->getEditeurContact();
		
		return $this->load->view("FicheEditeur/tabContact", $data, true);

	}

	// Renvoie la tableau des réservations
	public function tabJeu () {
		$jeuDAO = $this->JeuFactory->getInstance();
		$data['jeux'] = $jeuDAO->getJeux();
		
		return $this->load->view("Jeu/tabJeu", $data, true);
	}
	

	public function supprimerContact () {

	}

	public function modifierContact () {

	}
}