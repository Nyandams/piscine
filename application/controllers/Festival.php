<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Festival extends CI_Controller {
    
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
        }
    }
    
    
    public function index(){
        $this->affichageFestival();
    }
    
    public function affichageFestival(){
        $data['title'] = "Festivals";
        $dao = $this->fact->getInstance();
        
        $data['festivalCollection'] = $dao->getFestivals();
        $data['page']               = $this->load->view('Festival/festival', $data, true);
        $this->load->view("Theme/theme", $data);
    }
    
    public function ajoutFestival(){
        $dao = $this->fact->getInstance();
        $this->form_validation->set_rules('annee', '"Année"', 'trim|min_length[3]|required|max_length[52]|alpha_dash|encode_php_tags');
        $this->form_validation->set_rules('nbEmplacement', '"Nombre d\'emplacement"', 'required|max_length[52]|alpha_dash|encode_php_tags');
        $this->form_validation->set_rules('prix', '"prix"', 'required|max_length[52]|alpha_dash|encode_php_tags');
        if($this->form_validation->run()) {
            $festivalDTO = new FestivalDTO();
                $festivalDTO->setAnneeFestival($this->input->post('annee'));
                $festivalDTO->setNbEmplacementTotal($this->input->post('nbEmplacement'));
                $festivalDTO->setPrixEmplacementFestival($this->input->post('prix'));
                $save = $dao->saveFestival($festivalDTO);
                try{
                    $festivalDTO = $this->dao->getFestivalActuel();
                    $this->session->set_userdata('idFestival', $festivalDTO->getIdFestival());
                }catch(Exception $e){
                }
            redirect('/festival');
        } else {
            redirect('/festival');
        }
    
    
    }
    
    
    
    
}