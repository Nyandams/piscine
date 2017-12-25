<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

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
		    $this->load->model("Contact/ContactFactory", "fact");
		    $this->load->model("Contact/DTO/ContactDTO", "dto");
		    $this->load->model("Contact/DTO/ContactCollection");
		    $this->load->model("Contact/DAO/ContactDAO", "dao");

		    // Récupération des données pour l'editeur associé au contact
		    $this->load->model("EditeurContact/EditeurContactFactory");
		    $this->load->model("EditeurContact/DTO/EditeurContactDTO");
		    $this->load->model("EditeurContact/DTO/EditeurContactCollection");

		    //Recupération des données de l'éditeur
		    $this->load->model("Editeur/DAO/EditeurDAO");
		}
	}
	
	public function index() {
	    $this->ContactListe();
	    
	}
	
	//affiche le tableau des contacts
	public function ContactListe() {
		$data['page'] = $this->tableauContact();
		$data['title']= 'Contacts';
		$this->load->view("Theme/theme", $data);	
	}


	// @return tableau des contacts et de l'éditeur associé prêt à être affiché dans une page.
	public function tableauContact () {
		// Récupération du service
		$editContactDAO = $this->EditeurContactFactory->getInstance();
		// Récupération de tout les contacts et éditeur associés
		$data['ContactsEditeursDto'] = $editContactDAO->getEditeurContact();
		return $this->load->view("Contact/tabContact", $data, true);
	}

	/* Modifie un contact via une requete
	@param : idContact : int
	*/
	public function modifierContact() {

	}

	/* Supprime un contact via une requete
	@param : idContact : int
	*/
	public function supprimerContact() {
		$idContact = $this->input->get("idContact");
		$instanceDao = $this->fact->getInstance();
		$supp = $instanceDao->getContactById($idContact);
		$instanceDao->deleteContact($supp);
		redirect('/Contact/Contactliste');
	}

	// Ajoute un contact via une méthode post 
	public function ajouterContact() {
		// Récupération des valeurs
		$nomContact = $this->input->post('nomContact');

		// création du dto qu'on va envoyer
		$dto = new ContactDTO();
		$dto->setIdContact(null);
		$dto->setLibelleContact($nomContact);

		// Envoie du dto
		$instanceDao = $this->fact->getInstance();
		$instanceDao->saveContact($dto);
		redirect('/Contact/Contactliste');

	}
}