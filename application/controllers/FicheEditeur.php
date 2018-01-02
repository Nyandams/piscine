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
		    $this->load->model("Editeur/EditeurFactory");
		    $this->load->model("Editeur/DTO/EditeurDTO");
		    $this->load->model("Editeur/DTO/EditeurCollection");
		    $this->load->model("Editeur/DAO/EditeurDAO");

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

		    // Récupération des données pour les réservations de l'éditeur
		    $this->load->model("Reserver/ReserverFactory");
		    $this->load->model("Reserver/DTO/ReserverDTO");
		    $this->load->model("Reserver/DAO/ReserverDAO");
		    $this->load->model("Reserver/DTO/ReserverCollection");
		}
	}
	
	// 
	public function index() {
		$data['page'] = $this->creationPage();
	    $this->load->view("Theme/theme", $data);
	}


	// Renvoie toute la fiche d'un éditeur
	public function creationPage() {
	    // Récupération de l'id de l'éditeur à afficher
	    $idFicheEditeur = $this->input->get("idFicheEditeur");
	    
	    // Création de tout les morceaux de la page
	    $data["tabContact"] = $this->tabContact($idFicheEditeur);
	    $data["tabJeu"] = $this->tabJeu($idFicheEditeur);
	    $data["zoneCommentaire"] = $this->commentairePerso($idFicheEditeur);
	    $data["tabReserver"] = $this->tabReserver($idFicheEditeur);
	    $data["suiviPerso"] = $this->suiviPerso($idFicheEditeur);
		
		return $this->load->view("FicheEditeur/fiche", $data,  true);
	}
	
	// Renvoie le tableau des contacts
	public function tabContact($idFicheEditeur) {
	    // Recupération du dao
		$contactDAO = $this->ContactFactory->getInstance();
		$data['ContactDTO'] = $contactDAO->getContactByIdEditeur($idFicheEditeur);
		$data['idFicheEditeur'] = $idFicheEditeur;
		$data['ContactJson'] = $contactDAO->getJsonContactByIdEditeur($idFicheEditeur);
		
		return $this->load->view("FicheEditeur/tabContact", $data, true);
	}

	// Renvoie la tableau des réservations
	public function tabReserver ($idFicheEditeur) {
		// Récupération du service
		$reserverDAO = $this->ReserverFactory->getInstance();
	
		// Récupération de tout les contacts et éditeur associés
		$data['reservers'] = $reserverDAO->getReserver();
		
		return $this->load->view("FicheEditeur/tabReservation", $data, true);

	}

	// Renvoie la tableau des jeu
	public function tabJeu ($idFicheEditeur) {
		$jeuDAO = $this->JeuFactory->getInstance();
		$data['jeux'] = $jeuDAO->getJeuByIdEditeur($idFicheEditeur);
		
		
		// Récupération du dao Editeur pour le modal d'ajout d'un jeu
		$editDAO = $this->EditeurFactory->getInstance();
		$data['EditeurDto'] = $editDAO->getEditeurs();
		
		return $this->load->view("FicheEditeur/tabJeu", $data, true);
	}

	// Renvoie la zone de commentaire
	public function commentairePerso ($idFicheEditeur) {
		return $this->load->view("FicheEditeur/commentairePerso", "", true);
	}
	
	// Renvoie la zone de suivi
	public function suiviPerso ($idFicheEditeur) {
	    return $this->load->view("FicheEditeur/suiviPerso", "", true);
	}
	
	// Ajoute un contact via une méthode post
	public function ajouterContact() {
	    $dto = $this->recuperationContact();
	    
	    // Envoie du dto
	    $instanceDao = $this->ContactFactory->getInstance();
	    $instanceDao->saveContact($dto);
	    redirect('ficheEditeur?idFicheEditeur=' . $this->input->get('idFicheEditeur'));
	}
	
	// Récupère un contact envoyé par methode post et renvoie un dto
	private function recuperationContact() {
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
	    $dto->setIdEditeur($this->input->get('idFicheEditeur')); // Récupération dans l'url
	    $dto->setEstPrincipalContact($this->input->post('selectPrincipal'));
	    return $dto;
	}

	/* Supprime un contact via une requete GET
	 @param : idContact : int
	 */
	public function supprimerContact() {
	    $idContact = $this->input->get('idContact');
	    $instanceDao = $this->ContactFactory->getInstance();
	    $supp = $instanceDao->getContactById($idContact);
	    $instanceDao->deleteContact($supp);
	    redirect('ficheEditeur?idFicheEditeur=' . $this->input->get('idFicheEditeur'));
	}
    
	public function modifierContact () {
	    // Suppression
	    $idContact = $this->input->get('idContact');
	    $contactDao = $this->ContactFactory->getInstance();
	    $supp = $contactDao->getContactById($idContact);
	    
	    $dto = $this->recuperationContact();
	    $dto->setIdContact($idContact);
	    $contactDao->updateContact($dto);
	   
	    redirect('ficheEditeur?idFicheEditeur=' . $this->input->get('idFicheEditeur'));
	}
	
	// Ajout un jeu via la méthode post 
	public function ajouterJeu () {
	    // création du dto qu'on va envoyer
	    $dto = new JeuDTO();
	    $dto->setIdEditeur($this->input->get("idFicheEditeur"));
	    $dto->setIdJeu(null);
	    $dto->setIdTypeJeu(0);
	    $dto->setLibelleJeu($this->input->post("nomJeu"));
	    $dto->setNbMaxJoueurJeu($this->input->post("nbMaxJoueurJeu"));
	    $dto->setNbMinJoueurJeu($this->input->post("nbMinJoueurJeu"));
	    $dto->setNoticeJeu($this->input->post("noticeJeu"));
	    
	    // Envoie du dto
	    $instanceDao = $this->JeuFactory->getInstance();
	    $instanceDao->saveJeu($dto);
	    redirect('ficheEditeur?idFicheEditeur=' . $this->input->get('idFicheEditeur'));
	}
	
	// Supprimer un jeu via la méthode post
	public function supprimerJeu () {
	    $idJeu = $this->input->get('idJeu');
	    $instanceDao = $this->JeuFactory->getInstance();
	    $supp = $instanceDao->getJeuById($idJeu);
	    $instanceDao->deleteJeu($supp);
	    redirect('ficheEditeur?idFicheEditeur=' . $this->input->get('idFicheEditeur'));
	    
	}
}