<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facture extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
        // Permet de gérer les urls
        $this->load->helper('url');
        
        
        if (!$this->session->has_userdata('connexionOrganisateur')){
            redirect(site_url('/welcome'));
        } else {
            // Récupération des données de l'Editeur
            $this->load->model('FactureAffichage/FactureAffichageFactory');
        }        
    }
    
    public function index() {
        $this->factureFestival(); 
    }
    
    public function factureFestival(){
        $factureAffichageService = $this->FactureAffichageFactory->getInstance();
        $idFestival = $this->session->userdata('idFestival');
        $data['factureAffichageCollection'] = $factureAffichageService->getFactureByIdFestival($idFestival);
        $data['page'] = $this->load->view('Facture/tabFacture', $data, true);
        $data['title']= 'Factures';
        
        //print_r($data['factureAffichageCollection']);
        $this->load->view("Theme/theme", $data);
    }
}