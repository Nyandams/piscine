<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zone extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        // Permet de gérer les urls
        $this->load->helper('url');
        
        if (!$this->session->has_userdata('connexionOrganisateur')){
            redirect('/welcome');
        } else {
            // Récupération des données de Contact
            $this->load->library('form_validation');
            $this->load->model("Festival/FestivalFactory", "fact");
            $this->load->model("Suivi/SuiviFactory");
            $this->load->model("Editeur/EditeurFactory");
            
            $this->load->model ("ZoneReserver/ZoneReserverFactory");
        }
    }
    
    public function index() {
        $this->affichageZone();
    }
    
    public function affichageZone() {
        $data["title"] = "Reservation par zone";
        $data["page"] = $this->tabZone();
        $this->load->view("Theme/theme", $data);
    }
    
    public function tabZone() {
        $idFestival = $this->session->userdata("idFestival");
        
        $zoneReserverDAO = $this->ZoneReserverFactory->getInstance();
        $data["zoneReserverCollection"] = $zoneReserverDAO->getZoneReserverService($idFestival) ;
        print_r ($data["zoneReserverCollection"] );
        //return $this->load->view("Zone/Zone", $data, TRUE);
    }
}