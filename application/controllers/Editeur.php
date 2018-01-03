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
		    redirect('/welcome');
		} else {
		    // Récupération des données de l'Editeur
		    $this->load->model("EditeurContact/EditeurContactFactory", "fact");
		    $this->load->model("Editeur/EditeurFactory");
		    $this->load->model("EditeurContact/DTO/EditeurContactDTO", "dto");
		    $this->load->model("EditeurContact/DTO/EditeurContactCollection");
		    $this->load->model("EditeurContact/EditeurContactService", "dao");
		    $this->load->model("Suivi/SuiviFactory");
		    $this->load->model("Festival/FestivalFactory");
		    
		    // Récupération des données de l'Editeur
		    $this->load->model("Editeur/EditeurFactory");
		    $this->load->model("Editeur/DTO/EditeurDTO");
		    $this->load->model("Editeur/DTO/EditeurCollection");
		    $this->load->model("Editeur/DAO/EditeurDAO");
		}
	}
	
	public function index() {
	    $this->editeurListe();
	}
	
	//affiche le tableau des éditeurs
	public function editeurListe() {
		$data['page'] = $this->tableauEditeur();
		$data['title']= 'Editeurs';
		
		$this->load->view("Theme/theme", $data);	
	}


	// @return tableau des éditeurs prêt à être affiché dans une page.
	public function tableauEditeur () {
		$instanceDao = $this->fact->getInstance();
		$data['editeursDTO'] = $instanceDao->getEditeurContactPrincipal();
		return $this->load->view("Editeur/tabEditeur", $data, true);
		
	}

	/* Supprime un éditeur via une requete
	@param : idEditeur : int
	*/
	public function supprimerEditeur() {
		$idEditeur = $this->input->get("idEditeur");
		$instanceDao = $this->EditeurFactory->getInstance();
		try{
		    $supp = $instanceDao->getEditeurById($idEditeur);
		    $instanceDao->deleteEditeur($supp);
		} catch(Exception $e){
		    
		}
		
		redirect('/editeur/editeurliste');
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
}