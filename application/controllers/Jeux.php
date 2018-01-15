<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Jeux extends CI_Controller {
	public function __construct() {
		parent::__construct();
		// Permet de gérer les urls
		$this->load->helper('url');
		//Permet de gérer les formulaires
		 $this->load->helper('form');
		
		if (!$this->session->has_userdata('connexionOrganisateur')){
		    redirect('/welcome');
		} else {
		    // Récupération des données de Jeu
		    $this->load->model("Jeu/JeuFactory", "fact");
		    $this->load->model("Jeu/DTO/JeuDTO", "dto");
		    $this->load->model("Jeu/DTO/JeuCollection");
		    $this->load->model("Jeu/DAO/JeuDAO", "dao");
		    // Récupération des éditeurs
		    $this->load->model("Editeur/EditeurFactory", "factEditeur");
		    $this->load->model("Editeur/DTO/EditeurDTO", "dtoEditeur");
		    $this->load->model("Editeur/DTO/EditeurCollection");
		    $this->load->model("Editeur/DAO/EditeurDAO", "daoEditeur");

		    //Recupération des données de l'éditeur
		    $this->load->model("Editeur/DAO/EditeurDAO");
		}
	}
	

	public function index() {
	    $this->ListeJeu();
	    
	}
	
	//affiche le tableau des jeux
	public function ListeJeu() {
		$data['page'] = $this->tableauJeu();
		$data['title']= 'Jeux';
		$this->load->view("Theme/theme", $data);
	}
	// @return tableau des jeux et de l'éditeur associé prêt à être affiché dans une page.
	public function tableauJeu() {
		// Récupération du service
		$jeuDAO = $this->fact->getInstance();
		// Récupération du dao Editeur
		$editDAO = $this->factEditeur->getInstance();
		// Récupération de tout les jeux et éditeur associés
		$data['JeuxEditeursDto'] = $jeuDAO->getJeux();
		$data['EditeurDto'] = $editDAO->getEditeurs();

		return $this->load->view("Jeux/tabJeux", $data, true);
	}

	// Récupère un jeu envoyé par methode post et renvoie un dto
	private function recuperationJeu() {
	    // création du dto qu'on va envoyer
	    $dto = new JeuDTO();

            $dto->setIdJeu($this->input-get('idJeu'));
            $dto->setLibelleJeu($this->get('libelleJeu'));
/*            $dto->setIdZone($this->get('idZone'));*/
            $dto->setNbMinJoueurJeu($this->get('nbMinJoueurJeur'));
            $dto->setNbMaxJoueurJeu($this->get('nbMaxJoueurJeur'));
	    $dto->setNoticeJeu($this->get('noticeJeu'));
	    $dto->setIdEditeur($this->input->get('idFicheEditeur')); // Récupération dans l'url

	    return $dto;
	}



	// Ajoute un jeu via une méthode post 
	public function ajouterJeu() {
		// création du dto qu'on va envoyer
		$dto = new JeuDTO();
		$dto->setIdJeu(null);
        $dto->setLibelleJeu($this->input->post('nomJeu'));
/*		$dto->setIdZone($this->input->post('idZone'));*/
        $dto->setNbMinJoueurJeu($this->input->post('nbMinJoueurJeu'));
        $dto->setNbMaxJoueurJeu($this->input->post('nbMaxJoueurJeu'));
        $dto->setNoticeJeu($this->input->post('noticeJeu'));
        
        $dto->setIdEditeur($this->input->post('selectEditeur'));
        $dto->setIdTypeJeu(0);
		// Envoie du dto
		$instanceDao = $this->fact->getInstance();
		$instanceDao->saveJeu($dto);
		redirect(site_url('/Jeux'));
	}
	
	/* Supprime un jeu via une requete
	 @param : idContact : int
	 */
	public function supprimerJeu() {
	    $idJeu = $this->input->get('idJeu');
	    $instanceDao = $this->fact->getInstance();
	    try{
	        $supp = $instanceDao->getJeuById($idJeu);
	        $instanceDao->deleteJeu($supp);
	    }catch(Exception $e){
	        
	    }
	   
	    redirect(site_url('Jeux'));
	}


}
