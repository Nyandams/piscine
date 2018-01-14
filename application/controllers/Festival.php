<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Festival extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        // Permet de gérer les urls
        $this->load->helper('url');
        $this->load->library('session');
        
        
        if (!$this->session->has_userdata('connexionOrganisateur')){
            redirect('/welcome');
        } else {
            // Récupération des données de Contact
            $this->load->library('form_validation');
            $this->load->model("Festival/FestivalFactory", "fact");
            $this->load->model("Suivi/SuiviFactory");
            $this->load->model("Editeur/EditeurFactory");
            $this->load->model("Reservation/ReservationFactory");
            
            $this->load->model('Zone/ZoneFactory');
        }
    }
    
    
    public function index(){
        $this->affichageFestival();
    }
    
    public function affichageFestival(){
        $reservationDao = $this->ReservationFactory->getInstance();
        $data['title'] = "Festivals";
        $dao = $this->fact->getInstance();
        $festivalCollection = $dao->getFestivals();
        foreach ($festivalCollection as $festivalDto){
            $reservationCollection = $reservationDao->getReservationByIdFestival($festivalDto->getIdFestival());
            $nbEmplacementOccupe = 0;
            foreach ($reservationCollection as $reservationDto){
                $nbEmplacementOccupe += $reservationDto->getNbEmplacement();
            }
            $festivalDto->setNbEmplacementsRestant($festivalDto->getNbEmplacementTotal() - $nbEmplacementOccupe);
        }
        $data['festivalCollection'] = $festivalCollection;
        $data['page']               = $this->load->view('Festival/festival', $data, true);
        $this->load->view("Theme/theme", $data);
    }
    
    public function ajoutFestival(){
        $dao = $this->fact->getInstance();
        $this->form_validation->set_rules('annee', '"Année"', 'trim|min_length[3]|required|max_length[52]|alpha_dash|encode_php_tags');
        $this->form_validation->set_rules('nbEmplacement', '"Nombre d\'emplacement"', 'required|max_length[52]|alpha_dash|encode_php_tags');
        $this->form_validation->set_rules('prix', '"prix"', 'required|max_length[52]|encode_php_tags');
        if($this->form_validation->run()) {
            $festivalDTO = new FestivalDTO();
                $festivalDTO->setAnneeFestival($this->input->post('annee'));
                $festivalDTO->setNbEmplacementTotal($this->input->post('nbEmplacement'));
                $festivalDTO->setPrixEmplacementFestival($this->input->post('prix'));
                $save = $dao->saveFestival($festivalDTO);
                
                // génération des suivis pour chaque éditeur
                $suiviDao   = $this->SuiviFactory->getInstance();
                $editeurDao = $this->EditeurFactory->getInstance();
                
                $editeurCollection = $editeurDao->getEditeurs();
                foreach ($editeurCollection as $editeurDto){
                    $suiviDto = new SuiviDTO();
                    $suiviDto->setIdEditeur($editeurDto->getIdEditeur());
                    $suiviDto->setPresenceEditeur(0);
                    $suiviDto->setLogementSuivi(0);
                    try{
                        $suiviDto->setIdFestival($dao->getLastFestivalId()->getIdFestival());
                    }catch(Exception $e){                        
                    }
                    $suiviDao->saveSuivi($suiviDto);
                }
                
                //mise en session du festival le plus récent
                try{
                    $festivalDTO = $dao->getFestivalActuel();
                    $this->session->set_userdata('idFestival', $festivalDTO->getIdFestival());
                    
                    $zoneDAO = $this->ZoneFactory->getInstance();
                    $zoneFamille = new ZoneDTO();
                    $zoneFamille->setIdFestival($festivalDTO->getIdFestival());
                    $zoneFamille->setNomZone("Famille");
                    $zoneDAO->saveZone($zoneFamille);
                    
                    $zoneAmbiance = new ZoneDTO();
                    $zoneAmbiance->setIdFestival($festivalDTO->getIdFestival());
                    $zoneAmbiance->setNomZone("Ambiance");
                    $zoneDAO->saveZone($zoneAmbiance);
                    
                    $zoneExpert = new ZoneDTO();
                    $zoneExpert->setIdFestival($festivalDTO->getIdFestival());
                    $zoneExpert->setNomZone("Expert");
                    $zoneDAO->saveZone($zoneExpert);
                    
                    $zoneEnfant = new ZoneDTO();
                    $zoneEnfant->setIdFestival($festivalDTO->getIdFestival());
                    $zoneEnfant->setNomZone("Enfant");
                    $zoneDAO->saveZone($zoneEnfant);
                    
                }catch(Exception $e){
                }
            redirect('/festival');
        } else {
            redirect('/festival');
        }
    
    
    }
    
    public function changerFestival() {
       $this->session->set_userdata("idFestival", $this->input->get("idFestival"));
       redirect(site_url("Festival"));
    }
    
    
    
    
}