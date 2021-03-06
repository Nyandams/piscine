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
            $this->load->model("EnsembleReservation/EnsembleReservationFactory");
            $this->load->model('Zone/ZoneFactory');
            $this->load->model('Reservation/ReservationFactory');
            $this->load->model('Festival/FestivalFactory');
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
                    $idFestival = $dao->getLastFestivalId()->getIdFestival();
                    $this->session->set_userdata('idFestival', $idFestival);
                    
                    $zoneDAO = $this->ZoneFactory->getInstance();
                    $zoneFamille = new ZoneDTO();
                    $zoneFamille->setIdFestival($idFestival);
                    $zoneFamille->setNomZone("Famille");
                    $zoneDAO->saveZone($zoneFamille);
                    
                    $zoneAmbiance = new ZoneDTO();
                    $zoneAmbiance->setIdFestival($idFestival);
                    $zoneAmbiance->setNomZone("Ambiance");
                    $zoneDAO->saveZone($zoneAmbiance);
                    
                    $zoneExpert = new ZoneDTO();
                    $zoneExpert->setIdFestival($idFestival);
                    $zoneExpert->setNomZone("Expert");
                    $zoneDAO->saveZone($zoneExpert);
                    
                    $zoneEnfant = new ZoneDTO();
                    $zoneEnfant->setIdFestival($idFestival);
                    $zoneEnfant->setNomZone("Enfant");
                    $zoneDAO->saveZone($zoneEnfant);
                    
                }catch(Exception $e){
                }
            redirect('/festival');
        } else {
            redirect('/festival');
        }
    }
    
    
    //supprime un festival et tout ce qui est lié
    public function supprimerFestival(){
        $reservationDao = $this->ReservationFactory->getInstance();
        $ensembleReservationDAO = $this->EnsembleReservationFactory->getInstance();
        $idFestival = $this->input->post('idFestival');
        
        //suppression des réservations
        $reservationCollection = $reservationDao->getReservationByIdFestival($idFestival);
        foreach($reservationCollection as $reservationDto){
            $ensembleReservationDAO->supprimerReservation($reservationDto->getIdReservation());
        }
        
        //suppression des zones
        $zoneDao = $this->ZoneFactory->getInstance();
        $zoneCollection = $zoneDao->getZonesByIdFestival($idFestival);
        foreach ($zoneCollection as $zoneDto){
            $zoneDao->deleteZone($zoneDto);
        }
        
        //suppression des suivis
        $suiviDao = $this->SuiviFactory->getInstance();
        $suiviCollection = $suiviDao->getSuiviByIdFestival($idFestival);
        foreach ($suiviCollection as $suiviDto){
            $suiviDao->deleteSuivi($suiviDto);
        }
        
        //suppression du festival
        $festivalDao = $this->FestivalFactory->getInstance();
        try{
            $festivalDto = $festivalDao->getFestivalById($idFestival);
            $festivalDao->deleteFestival($festivalDto);
        }catch(Exception $e){
        }
        redirect(site_url("Festival"));
    }
    
    public function changerFestival() {
       $this->session->set_userdata("idFestival", $this->input->get("idFestival"));
       redirect(site_url("Festival"));
    }
    
    
    
    
}