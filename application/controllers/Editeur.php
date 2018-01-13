<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editeur extends CI_Controller {

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
		    $this->load->model("EditeurContact/EditeurContactFactory", "fact");
		    $this->load->model("Editeur/EditeurFactory");
		    $this->load->model("EditeurContact/EditeurContactService", "dao");
		    $this->load->model("Suivi/SuiviFactory");
		    $this->load->model("Festival/FestivalFactory");
		    
		    // Récupération des données de l'Editeur
		    $this->load->model("Editeur/EditeurFactory");
            $this->load->model("Reservation/ReservationFactory");
            
            // Récupération de l'éditeur et de son suivi
            $this->load->model ("EnsembleSuivi/EnsembleSuiviFactory");
            
            $this->load->model ("Jeu/JeuFactory");
            
            $this->load->model("Reserver/ReserverFactory");
		}
	}
	
	public function index() {
	    $this->editeurListe();
	}
	
	//affiche le tableau des éditeurs
	public function editeurListe() {
		$data['page'] = $this->choixFiltre();
		$data['title']= 'Editeurs';

		$this->load->view("Theme/theme", $data);	
	}


	// @return tableau des éditeurs prêt à être affiché dans une page.
	public function tableauEditeur () {
		$instanceDAO = $this->EnsembleSuiviFactory->getInstance();
		$data['ensemblesSuiviDTO'] = $instanceDAO->getEnsembleSuiviDTOByIdFestival($this->session->userdata("idFestival"));
		return $this->load->view("Editeur/tabEditeur", $data, true);
		
	}

	/* Supprime un éditeur via une requete
	@param : idEditeur : int
	*/
	public function supprimerEditeur() {
	    // il faut aussi supprimer le suivi qui va avec
		$idEditeur = $this->input->get("idEditeur");
		$instanceDao = $this->EditeurFactory->getInstance();
		
		$idFestival = $this->session->userdata("idFestival");
		
		try {
		    // Suppression du suivi pour cet éditeur
		    $suiviDAO = $this->SuiviFactory->getInstance();
		    $suiviDTO = $suiviDAO->getSuiviByIdEditeurFestival($idEditeur,$idFestival);
		    $suiviDAO->deleteSuivi($suiviDTO);
		    
		    // Suppression de ses jeux (Leur reserver est supprimé aussi
		    $jeuDAO = $this->JeuFactory->getInstance();
		    $jeuDTOCollection = $jeuDAO->getJeuByIdEditeur($idEditeur);
		    
		    $reserverDAO = $this->ReserverFactory->getInstance();
		    foreach ($jeuDTOCollection as $key => $jeuDTO) {
		        $reserverDAO->suppReserverByIdJeu($jeuDTO->getIdJeu());
		        $jeuDAO->deleteJeu($jeuDTO);
		    }  
		} catch (Exception $e) {
		    
		}
		
		try{
		    $supp = $instanceDao->getEditeurById($idEditeur);
		    $instanceDao->deleteEditeur($supp);
		} catch(Exception $e){
		    
		}
		redirect('/editeur/editeurliste');
	}
	
	// Sauvegarde le suivi rapide d'un éditeur
	public function sauvegardeSuiviRapideEditeur() {
	    $idEditeur = $this->input->get("idEditeur");
	    $idFestival = $this->session->userdata("idFestival");
	    
	    $suiviDAO = $this->SuiviFactory->getInstance();
	    $suiviDTO = $suiviDAO->getSuiviByIdEditeurFestival($idEditeur,$idFestival);
	    
	    $reponseEditeur = $this->input->post('selectReponse');
	    $suiviDTO->setReponseEditeur($reponseEditeur);
	    
	    $suiviDAO->updateSuivi($suiviDTO);
	    
	    if (null !== $this->input->post("contactFait") and is_null($suiviDTO->getPremierContact())){
	        $suiviDAO->setPremierContact($idEditeur, $idFestival);
	        // Si décoché et que c'était coché avant
	    } else if ($this->input->post("contactFait") == null and $suiviDTO->getPremierContact() !== NULL) {
	        $suiviDAO->unsetPremierContact($idEditeur, $idFestival);
	    }
	    
	    
	 
	    redirect(site_url('Editeur/'));
	   
	}

	// Ajoute un éditeur via une méthode post 
	public function ajouterEditeur() {
		// Récupération des valeurs
		$nomEditeur = $this->input->post('nomEditeur');

		// création du dto qu'on va envoyer
		$dto = new EditeurDTO();
		$dto->setIdEditeur(null);
		$dto->setLibelleEditeur($nomEditeur);

		// Envoie du dto
		$instanceDao = $this->EditeurFactory->getInstance();
		$instanceDao->saveEditeur($dto);
		
		
		$suiviDao    = $this->SuiviFactory->getInstance();
		$festivalDao = $this->FestivalFactory->getInstance();
		try{
		    $editeurDto = $instanceDao->getLastIdEditeur();
		    $suiviDto = new SuiviDTO();
		    $suiviDto->setIdEditeur($editeurDto->getIdEditeur());
		    $suiviDto->setPresenceEditeur(0);
		    $suiviDto->setLogementSuivi(0);
		    
		    $festivalCollection = $festivalDao->getFestivals();
		    foreach ($festivalCollection as $festivalDto){
		        $suiviDto->setIdFestival($festivalDto->getIdFestival());
		        $suiviDao->saveSuivi($suiviDto);
		    }
		}catch(Exception $e){
		    
		}
		
		redirect(site_url('/editeur'));

	}


	/*
choixFiltre peut etre appelé d 2 facons : soit par défaut on on affiche donc tous les editeus, soit par le choix du filtre et on affiche les editeurs en fct du filtre.
	*/
	public function choixFiltre(){

		$idFestival = $this->session->userdata('idFestival');
		$ensembleSuiviDAO=$this->EnsembleSuiviFactory->getInstance();

		$numFiltre = $this->input->post('idFiltre'); 
        echo("hey" . $numFiltre);
		if (!isset($numFiltre)){

			$data['ensemblesSuiviDTO'] = $ensembleSuiviDAO->getEnsembleSuiviDTOByIdFestival($idFestival);
			return $this->load->view("Editeur/tabEditeur", $data, true);
		}

		else {

			if ($numFiltre==-1){
                echo ("page");
				$data['ensemblesSuiviDTO'] =$ensembleSuiviDAO->getSuiviNonContacteDTOByIdFestival($idFestival);
				$data['title']= 'Editeurs';

				$this->load->view("Theme/theme", $data);
			}

		}
	}
}
