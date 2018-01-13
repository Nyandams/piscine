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
		    $this->load->model("Editeur/EditeurFactory");
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
		$data['ensembleSuiviCollection'] = $instanceDAO->getEnsembleSuiviDTOByIdFestival($this->session->userdata("idFestival"));
		return $this->load->view("Editeur/tabEditeur", $data, true);
		
	}

	/* Supprime un éditeur via une requete
	@param : idEditeur : int
	*/
	public function supprimerEditeur() {
	    // il faut aussi supprimer le suivi qui va avec
		$idEditeur = $this->input->get("idEditeur");
		$ensembleSuiviService = $this->EnsembleSuiviFactory->getInstance();
		$ensembleSuiviService->supprimerEditeur($idEditeur);
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
	    $ensembleSuiviService = $this->EnsembleSuiviFactory->getInstance();
		// Récupération des valeurs
		$nomEditeur = $this->input->post('nomEditeur');

		// création du dto qu'on va envoyer
		$dto = new EditeurDTO();
		$dto->setIdEditeur(null);
		$dto->setLibelleEditeur($nomEditeur);
        
		// Envoie du dto dans ensembleSuiviService
		$ensembleSuiviService->ajouterEditeur($dto);
		
		redirect(site_url('/editeur'));

	}


	/*
choixFiltre peut etre appelé d 2 facons : soit par défaut on on affiche donc tous les editeus, soit par le choix du filtre et on affiche les editeurs en fct du filtre.
	*/
	public function choixFiltre(){

		$idFestival = $this->session->userdata('idFestival');
		$ensembleSuiviService=$this->EnsembleSuiviFactory->getInstance();
		
		$numFiltre = $this->input->post('selectFiltre'); 
		echo ("Num du filtre : " . $numFiltre);
		
		if (!isset($numFiltre)){
		    $data['ensembleSuiviCollection'] = $ensembleSuiviService->getEnsembleSuiviDTOByIdFestival($idFestival);
			return $this->load->view("Editeur/tabEditeur", $data, true);
		}

		else {
		    $data['title']= 'Editeurs';

			if ($numFiltre==1){
			    $data['ensembleSuiviCollection'] = $ensembleSuiviService->getSuiviNonContacteDTOByIdFestival($idFestival);
			}
			if ($numFiltre==2){
			    $data['ensembleSuiviCollection'] = $ensembleSuiviService->getSuivi1erContactSansReponseDTOByIdFestival($idFestival);
			}
			if ($numFiltre==3){
			    $data['ensembleSuiviCollection'] = $ensembleSuiviService->getSuivi2emeContactSansReponseDTOByIdFestival($idFestival);
			}
			if ($numFiltre==4){
			    $data['ensembleSuiviCollection'] = $ensembleSuiviService->getSuiviReponseOuiDTOByIdFestival($idFestival);
			}
			if ($numFiltre==5){
			    $data['ensembleSuiviCollection'] = $ensembleSuiviService->getSuiviReponsePeutEtreDTOByIdFestival($idFestival);
			}
			if ($numFiltre==6){
			    $data['ensembleSuiviCollection'] = $ensembleSuiviService->getSuiviReponseNonDTOByIdFestival($idFestival);
			}
			if ($numFiltre==7) {
			    $data['ensembleSuiviCollection'] = $ensembleSuiviService->getEnsembleSuiviDTOByIdFestival($idFestival);
			}
			
			$data["page"] = $this->load->view("Editeur/tabEditeur", $data, TRUE);
			$this->load->view("Theme/theme", $data);
		}
	}
}
