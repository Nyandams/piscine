<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Permet de gérer les urls
		$this->load->helper('url');

		//Permet de gérer les formulaires
		 $this->load->helper('form');
		
		 if (!$this->session->has_userdata('connexionOrganisateur') || $this->session->userdata('connexionOrganisateur') != 1){
		    redirect('/welcome');
		} else {
		    // Récupération des données de Contact
		    $this->load->model("Contact/ContactFactory", "fact");
		    $this->load->model("Contact/DTO/ContactDTO", "dto");
		    $this->load->model("Contact/DTO/ContactCollection");
		    $this->load->model("Contact/DAO/ContactDAO", "dao");

		    // Récupération des éditeurs
		    $this->load->model("Editeur/EditeurFactory", "factEditeur");
		    $this->load->model("Editeur/DTO/EditeurDTO", "dtoEditeur");
		    $this->load->model("Editeur/DTO/EditeurCollection");
		    $this->load->model("Editeur/DAO/EditeurDAO", "daoEditeur");

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
		// Récupération du dao Editeur
		$editDAO = $this->factEditeur->getInstance();

		// Récupération de tout les contacts et éditeur associés
		$data['ContactsEditeursDto'] = $editContactDAO->getEditeurContact();
		$data['EditeurDto'] = $editDAO->getEditeurs();
		return $this->load->view("Contact/tabContact", $data, true);
	}

	/* Modifie un contact via une requete
	@param : idContact : int
	*/
	
	// Récupère un contact envoyé par methode post et renvoie un dto
	private function recuperationContact() {
	    // création du dto qu'on va envoyer
	    $dto = new ContactDTO();
	    $dto->setIdContact($this->input->get('idContact'));
	    $dto->setEstPrincipalContact(0);
	    $dto->setNomContact($this->input->post('nomContact'));
	    $dto->setPrenomContact($this->input->post('prenomContact'));
	    $dto->setTelephoneContact($this->input->post('numTelephone'));
	    $dto->setMailContact($this->input->post('adresseMail'));
	    $dto->setRueContact($this->input->post('adresse'));
	    $dto->setVilleContact($this->input->post('ville'));
	    $dto->setCpContact($this->input->post('codePostal'));
	    $dto->setIdEditeur($this->input->get('idFicheEditeur')); // Récupération dans l'url
	    $dto->setEstPrincipalContact($this->input->post('selectPrincipal'));
	    return $dto;
	}
	
	public function modifierContact() {
	    $contactDao = $this->ContactFactory->getInstance();
	    $dto = $this->recuperationContact();
	    $contactDao->updateContact($dto);
	    
	    redirect(site_url('Contact'));
	}

	/* Supprime un contact via une requete
	@param : idContact : int
	*/
	public function supprimerContact() {
		$idContact = $this->input->get('idContact');
		$instanceDao = $this->fact->getInstance();
		$supp = $instanceDao->getContactById($idContact);
		$instanceDao->deleteContact($supp);
		redirect('/Contact/Contactliste');
	}

	// Ajoute un contact via une méthode post 
	public function ajouterContact() {
		// création du dto qu'on va envoyer
		$dto = new ContactDTO();
		$dto->setIdContact(null);
		$dto->setEstPrincipalContact(0);
		$dto->setNomContact($this->input->post('nomContact'));
		$dto->setPrenomContact($this->input->post('prenomContact'));
		$dto->setTelephoneContact($this->input->post('numTelephone'));
		$dto->setMailContact($this->input->post('adresseMail'));
		$dto->setRueContact($this->input->post('adresse'));
		$dto->setVilleContact($this->input->post('ville'));
		$dto->setCpContact($this->input->post('codePostal'));
		$dto->setIdEditeur($this->input->post('selectEditeur'));
      
        
		// Envoie du dto
		$instanceDao = $this->fact->getInstance();
		$instanceDao->saveContact($dto);
		redirect('/Contact/ContactListe');

	}
}