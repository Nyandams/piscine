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
		    redirect(site_url('/welcome'));
		} else {
		    // Récupération des données de l'Editeur
		    $this->load->model("Editeur/EditeurFactory");
		    

		    // Récupération des données pour l'editeur associé au contact
		    $this->load->model("EditeurContact/EditeurContactFactory");
		  

		    // Récupération des données pour les réservations de l'éditeur
		    $this->load->model("Reservation/ReservationFactory");
		    

		    // Récupération des données pour les jeux de l'éditeur
		    $this->load->model("Jeu/JeuFactory");
		    $this->load->model("Jeu/DTO/JeuDTO");
		    

		    // Récupération des données pour les réservations de l'éditeur
		    $this->load->model("Reserver/ReserverFactory");
		    
		    
		    // Récupération des données pour les commentaires de l'éditeur
		    $this->load->model("Suivi/SuiviFactory");
		    
		    // Récupération de l'enssembleReservation de chaque editeur
		    $this->load->model("EnsembleReservation/EnsembleReserver/EnsembleReserverFactory");
		    $this->load->model("EnsembleReservation/EnsembleReserver/EnsembleReserverService");
		    $this->load->model("EnsembleReservation/EnsembleReservationService");
		    $this->load->model("EnsembleReservation/EnsembleReservationFactory");
		    
		    // pour les reserver
		    $this->load->model("Reserver/ReserverFactory");
		    $this->load->model("Reserver/DTO/ReserverDTO");
		    
		    // pour les reservations
		    $this->load->model("Reservation/ReservationFactory");
		    
		    $this->load->model("Zone/ZoneFactory");
		    $this->load->model("Zone/DTO/ZoneDTO");
		    
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
	    // Récupératio du nom de l'éditeur à afficher
	    $editeurDAO = $this->EditeurFactory->getInstance();
	    $editeurDTO= $editeurDAO->getEditeurById($idFicheEditeur);
	    $data["nomEditeur"] = $editeurDTO->getLibelleEditeur();
	    
	    // Création de tout les morceaux de la page
	    $data["tabContact"] = $this->tabContact($idFicheEditeur);
	    $data["tabJeu"] = $this->tabJeu($idFicheEditeur);
	    $data["zoneCommentaire"] = $this->commentairePerso($idFicheEditeur);
	    $data["tabReserver"] = $this->tabReserver($idFicheEditeur);
	    $data["suiviPerso"] = $this->suiviPerso($idFicheEditeur);
	    $data["title"] = "Fiche Editeur";
		
		return $this->load->view("FicheEditeur/fiche", $data,  true);
	}
	
	// Renvoie le tableau des contacts
	public function tabContact($idFicheEditeur) {
	    // Recupération du dao
		$contactDAO = $this->ContactFactory->getInstance();
		$data['ContactDTO'] = $contactDAO->getContactByIdEditeur($idFicheEditeur);
		
		$data['AllContactDTO'] = $contactDAO->getContact();
		$data['idFicheEditeur'] = $idFicheEditeur;
		
		
		return $this->load->view("FicheEditeur/tabContact", $data, true);
	}

	// Renvoie la tableau des réservations
	public function tabReserver ($idFicheEditeur) {
		// Récupération du service
		$reserverDAO = $this->EnsembleReservationFactory->getInstance();
	    $ensembleReserverDTO = $reserverDAO->getReserverByIdEditeur($this->input->get("idFicheEditeur"));
	    
	    // Recupération des jeux
	    $jeuDAO = $this->JeuFactory->getInstance();
	    $data['jeux'] = $jeuDAO->getJeuByIdEditeur($idFicheEditeur);
		
		// Récupération de tout les contacts et éditeur associés
	    $data['reservations'] = $ensembleReserverDTO;
	    
	    // Récupération du prix de la négo de réservation
	    $idFestival = $this->session->userdata("idFestival");
	    $idEditeur = $this->input->get("idFicheEditeur");
	    try {
	        $reservationDAO = $this->ReservationFactory->getInstance();
	        $data['reservationDTO'] = $reservationDAO->getReservationByIdEditeurFestival($idEditeur, $idFestival);
	    } catch (Exception $e) {
	        
	    }
	    
	    // Envoie des données pour choisir la zone d'un jeu
	    $zoneDAO = $this->ZoneFactory->getInstance();
	    $data["zones"] = $zoneDAO->getZones();
	    
	    
	    
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
	
	// Supprimer un reserver pour un jeu
	public function supprimerReserver() {
	    $idJeu = $this->input->get("idJeu");
	    
	    $reserverDAO = $this->ReserverFactory->getInstance();
	    $reserverDTO = $reserverDAO->getReserverByIdJeu($idJeu);
	    $reserverDAO->deleteReserver($reserverDTO);
	    
	    // Vérification du nombre de reserver (si 0 on supprime Reservation)
	    $reservationDAO = $this->ReservationFactory->getInstance();
	    $idFestival = $this->session->userdata("idFestival");
	    $idEditeur = $this->input->get("idFicheEditeur");
	    
	    $reservationDTO = $reservationDAO->getReservationByIdEditeurFestival($idEditeur, $idFestival);
	    $idReservation = $reservationDTO->getIdReservation();
	    $reserversDTO = $reserverDAO->getReserverByIdReservation($idReservation);
	    
	    if (count($reserversDTO) == 0) {
	        $reservationDAO->deleteReservation($reservationDTO);
	    }
	    
	    $this->redirection();
	}
	
	// Ajoute une nouvelle reserver pour un jeu
	public function ajouterReserver() {
	    $reserverDAO = $this->ReserverFactory->getInstance();
	    $idFestival = $this->session->userdata("idFestival");
	    $idEditeur = $this->input->get("idFicheEditeur");
	    
	    // Pour obtenir l'id de reservation attaché à l'éditeur 
	    $reservationDAO = $this->ReservationFactory->getInstance();
	    try{
	        $reservationDTO = $reservationDAO->getReservationByIdEditeurFestival($idEditeur, $idFestival);
	    }catch(Exception $e){
	        $reservationDTO = new ReservationDTO();
	        $reservationDTO->setIdEditeur($idEditeur);
	        $reservationDTO->setIdFestival($idFestival);
	        $reservationDTO->setPrixNegociationReservation(0);
	        $reservationDAO->saveReservation($reservationDTO);
	        
	        $reservationDTO = $reservationDAO->getReservationByIdEditeurFestival($idEditeur, $idFestival);
	    }
	    
	    $idReservation  = $reservationDTO->getIdReservation();
	    
	    // Pour obtenir l'id du jeu
	    $idJeu = $this->input->post("selectJeu");
	    $quantiteJeu = $this->input->post("selectQuantite");
	    $dotationJeu = $this->input->post("selectDotation");
	    
	    // Création du dto
	    $reserverDTO = new ReserverDTO();
	    $reserverDTO->setIdJeu($idJeu);
	    $reserverDTO->setIdReservation($idReservation);
	    $reserverDTO->setQuantiteJeuReserver($quantiteJeu);
	    $reserverDTO->setReceptionJeuReserver(0);
	    $reserverDTO->setRenvoiJeuReserver(0);
	    $reserverDTO->setDotationJeuReserver($dotationJeu);
	    
	    $reserverDAO->saveReserver($reserverDTO);
	    $this->redirection();
	}
	
	public function modifierReserver() {
	    $reserverDAO = $this->ReserverFactory->getInstance();
	    $reserverDTO = $reserverDAO->getReserverByIdJeu($this->input->get('idJeu'));
	    
	    $quantiteJeu = $this->input->post("selectQuantite");
	    $dotationJeu = $this->input->post("selectDotation");
	    
	    $reserverDTO->setQuantiteJeuReserver($quantiteJeu);
	    $reserverDTO->setDotationJeuReserver($dotationJeu);
	    
	    // Mis a jour du mini suivi du jeu
	    if (null !== $this->input->post("recuBox")){
	        $reserverDTO->setReceptionJeuReserver(1);
	    } else {
	        $reserverDTO->setReceptionJeuReserver(0);
	    }
	    
	    if (null !== $this->input->post("renvoyerBox")){
	        $reserverDTO->setRenvoiJeuReserver(1);
	    } else {
	        $reserverDTO->setRenvoiJeuReserver(0);
	    }
	    
	    // Mis à jour de la zone du jeu
	    
	    // Si on ne souhaite pas créer une zone, on met à jour la zone selectionnée
	    $nomCreerZone = $this->input->post("nomCreerZone");
	    if ($nomCreerZone == "") {
	        $idZoneSelection = $this->input->post("selectZone"); 
            
	        // Si on a choisi de pas mettre de zone
	        if ($idZoneSelection == 0) {
	            $reserverDTO->setIdZone(NULL);
	        }
	        else {
	            $reserverDTO->setIdZone($idZoneSelection);
	        }
	    } else {
	        // Création de la nouvelle zone pour l'éditeur
             $zoneDTO = new ZoneDTO();
             $zoneDTO->setIdZone(NULL);
             $zoneDTO->setNomZone($nomCreerZone);
             $zoneDTO->setIdFestival($this->session->userdata("idFestival"));
             echo ("id zone : " . $zoneDTO->getIdFestival());
             $zoneDAO = $this->ZoneFactory->getInstance();
             $zoneDAO->saveZone($zoneDTO);
             
             // Et ajout de l'id de la zone dans la reserver du jeu
             $lastZoneDTO = $zoneDAO->getLastIdZone();
             $reserverDTO->setIdZone($lastZoneDTO->getIdZone());
             
	    }
	    
	    $reserverDAO->updateReserver($reserverDTO);
	    
	    $this->redirection();
	}
	
	public function sauvegarderReservation() {
	    //L'id du festival est mis en session
	    $idFestival = $this->session->userdata("idFestival");
	    $idEditeur = $this->input->get("idFicheEditeur");
	    
	    $reservationDAO = $this->ReservationFactory->getInstance();
	    try {
	        // S'il n'y a pas de réservation pour cet éditeur il faut lui en créer une.
	        $reservationDTO = $reservationDAO->getReservationByIdEditeurFestival($idEditeur, $idFestival);
	    } catch(Exception $e) {
	        $reservationDTO = new ReservationDTO();
	        $reservationDTO->setIdFestival($idFestival);
	        $reservationDTO->setIdEditeur($idEditeur);
	    }
	    
	    $reservationDTO->setNbEmplacement($this->input->post("nbTableReservees"));
	    $reservationDTO->setPrixNegociationReservation($this->input->post("prixTotReservation"));
	    
	    $reservationDAO->updateReservation($reservationDTO);
	    $this->redirection();
	}

	

	// Renvoie la zone de commentaire
	public function commentairePerso ($idFicheEditeur) {
	    $dto = $this->getSuivi();
	    
	    $data["commentaire"] = $dto->getCommentaireSuivi();
		return $this->load->view("FicheEditeur/commentairePerso", $data, true);
	}
	
	public function sauvegarderCommentaire () {
	    $dto = $this->getSuivi();
	    $commentaire = $this->input->post ("commentaire");
	    $dto->setCommentaireSuivi($commentaire);
	    $suiviDAO = $this->SuiviFactory->getInstance();
	    $suiviDAO->updateSuivi($dto);
	    
	    
	    $this->redirection();
	}
	
	// Permet de la redirection vers cette page après un ajout ou autre.
	private function redirection() {
	    redirect(site_url('ficheEditeur?idFicheEditeur=' . $this->input->get('idFicheEditeur')));
	}
	
	// Renvoie le DTO du suivi de l'éditeur qu'on est en train de traiter
	private function getSuivi() {
	    $suiviDAO = $this->SuiviFactory->getInstance();
	    
	    //L'id du festival est mis en session
	    $idFestival = $this->session->userdata("idFestival");
	    $idEditeur = $this->input->get("idFicheEditeur");
	    $suivi = $this->SuiviDAO->getSuiviByIdEditeurFestival($idEditeur, $idFestival);
	    return $suivi;
	    
	}
	
	// Renvoie la zone de suivi
	public function suiviPerso ($idFicheEditeur) {
	    $suiviDTO = $this->getSuivi();
	    $data['suivi'] = $suiviDTO;
	    return $this->load->view("FicheEditeur/suiviPerso", $data, true);
	}
	
	
	// Sauvegarde le suivi de l'editeur qu'on est en train de traiter
	public function sauvegarderSuivi() {
	    // obtention du suivi de l'edtieur actuel
	    $suiviDAO =  $this->SuiviFactory->getInstance();
	    $suiviDTO = $this->getSuivi();
	   
	    $idFestival = $this->session->userdata("idFestival");
	    $idEditeur = $this->input->get("idFicheEditeur");
	    
	    
	    
	    // Utilise directement le dao sans passer par le dto
	    // Si on coche et que c'etait pas coché avant	    
	    if (null !== $this->input->post("presentContact")){
	        $suiviDTO->setPresenceEditeur(1);
	    } else {
	        $suiviDTO->setPresenceEditeur(0);
	    }
	    
	    if (null !== $this->input->post("hebergementContact") ){
	        $suiviDTO->setLogementSuivi(1);
	    } else {
	        $suiviDTO->setLogementSuivi(0);
	    }
	    
	    $suiviDAO->updateSuivi($suiviDTO);
	    
	    if (null !== $this->input->post("premierContact") and $suiviDTO->getPremierContact() == NULL){
	        $suiviDAO->setPremierContact($idEditeur, $idFestival);
	        // Si décoché et que c'était coché avant
	    } else if ($this->input->post("premierContact") == null and $suiviDTO->getPremierContact() !== NULL) {
	        $suiviDAO->unsetPremierContact($idEditeur, $idFestival);
	    }
	    
	    if (null !== $this->input->post("deuxiemeContact") and $suiviDTO->getSecondContact() == NULL){
	        $suiviDAO->setSecondContact($idEditeur, $idFestival);
	        // Si décoché et que c'était coché avant
	    } else if ($this->input->post("deuxiemeContact") == null and $suiviDTO->getSecondContact() !== NULL) {
	        $suiviDAO->unsetSecondContact($idEditeur, $idFestival);
	    }
	    
	    $this->redirection();
	}
	
	// Ajoute un contact via une méthode post
	public function ajouterContact() {
	    // Envoie du dto
	    $contactDAO = $this->ContactFactory->getInstance();
	    if ($this->input->post("selectContactExistant") == 0) {
	        $dto = $this->recuperationContact();
	        $contactDAO->saveContact($dto);
	    }
	    
	    else {   
	        $dto = $contactDAO->getContactById($this->input->post("selectContactExistant"));
	        $dto->setIdEditeur($this->input->get("idFicheEditeur"));
	        $contactDAO->updateContact($dto);
	    }
	    
	    
	    $this->redirection();
	}
	
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

	/* Supprime un contact via une requete GET
	 @param : idContact : int
	 */
	public function supprimerContact() {
	    $idContact = $this->input->get('idContact');
	    $instanceDao = $this->ContactFactory->getInstance();
	    $supp = $instanceDao->getContactById($idContact);
	    $instanceDao->deleteContact($supp);
	    $this->redirection();
	}
    
	public function modifierContact () {
	    $contactDao = $this->ContactFactory->getInstance();
	    $dto = $this->recuperationContact();
	    $contactDao->updateContact($dto);
	   
	    $this->redirection();
	}
	
	private function recuperationJeu() {
	    // création du dto qu'on va envoyer
	    $dto = new JeuDTO();
	    $dto->setIdEditeur($this->input->get("idFicheEditeur"));
	    $dto->setIdJeu($this->input->get("idJeu"));
	    $dto->setIdTypeJeu(0);
	    $dto->setLibelleJeu($this->input->post("nomJeu"));
	    $dto->setNbMaxJoueurJeu($this->input->post("nbMaxJoueurJeu"));
	    $dto->setNbMinJoueurJeu($this->input->post("nbMinJoueurJeu"));
	    $dto->setNoticeJeu($this->input->post("noticeJeu"));
	    return $dto;
	}
	
	// Ajout un jeu via la méthode post 
	public function ajouterJeu () {
	    $dto = $this->recuperationJeu();
	    
	    // Envoie du dto
	    $instanceDao = $this->JeuFactory->getInstance();
	    $instanceDao->saveJeu($dto);
	    
	    // On ajoute directement un reserver pour le jeu
	    $reserverDAO = $this->ReserverFactory->getInstance();
	    $idFestival = $this->session->userdata("idFestival");
	    $idEditeur = $this->input->get("idFicheEditeur");
	    
	    $reserveDTO = new ReserverDTO();
	    
	    
	    $this->redirection();
	}
	
	// Supprimer un jeu via la méthode post
	public function supprimerJeu () {
	    $idJeu = $this->input->get('idJeu');
	    $reserverDAO = $this->ReserverFactory->getInstance();
	    $jeuDAO = $this->JeuFactory->getInstance();

	    $jeuDTO = $jeuDAO->getJeuById($idJeu);
	    // Supprimer la reservation pour le jeu
	    $reserverDAO->suppReserverByIdJeu($jeuDTO->getIdJeu());
	    $jeuDAO->deleteJeu($jeuDTO);
	    $this->redirection();
	    
	}
	
	public function modifierJeu () {
	    $jeuDao = $this->JeuFactory->getInstance();
	    $dto = $this->recuperationJeu();
	    $jeuDao->updateJeu($dto);
	    $this->redirection();
	}
}