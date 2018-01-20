<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ConnexionOrganisateur extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('Organisateur/OrganisateurFactory');
        $this->load->model('Festival/FestivalFactory');
    }
    
    public function index() {
        $this->connexion();
    }

    
    public function connexion() {
        
        if (!$this->session->has_userdata('connexionOrganisateur')){
            /* Rules non utilisés pour le moment 
            //$this->form_validation->set_rules('pseudo', '"Nom d\'utilisateur"', 'trim|min_length[3]|required|max_length[52]|alpha_dash|encode_php_tags');
            //$this->form_validation->set_rules('mdp', '"Mot de passe"', 'required|min_length[3]|max_length[52]|alpha_dash|encode_php_tags');
            
            if($this->form_validation->run()) {
                $login = $this->input->post('pseudo');
                $mdp = $this->input->post('mdp');
                
                $organisateurDao = OrganisateurFactory::getInstance();
                $connexionValide = $organisateurDao->connexionOrganisateur($login, $mdp);
                
                if( $connexionValide ) {
                    $this->session->set_userdata('connexionOrganisateur', $login);

                    
                    $festivalDAO = $this->FestivalFactory->getInstance();
                    try{
                        $festivalDTO = $festivalDAO->getFestivalActuel();
                        $this->session->set_userdata('idFestival', $festivalDTO->getIdFestival());
                    }catch(Exception $e){
                    }
                    
                    redirect(site_url('/festival'));
                } else {
                    $this->load->view('Organisateur/Connexion');
                }
                
            } else {
                $this->load->view('Organisateur/Connexion');
            }
            
        } else {
            redirect(site_url('/welcome'));
        }*/
            
            $login = $this->input->post('pseudo');
            $mdp = $this->input->post('mdp');
                
            $organisateurDao = OrganisateurFactory::getInstance();
            $connexionValide = $organisateurDao->connexionOrganisateur($login, $mdp);
            
            if( $connexionValide ) {
                
                $this->session->set_userdata('connexionOrganisateur', $login);
                $festivalDAO = $this->FestivalFactory->getInstance();
                try{
                    $festivalDTO = $festivalDAO->getFestivalActuel();
                    $this->session->set_userdata('idFestival', $festivalDTO->getIdFestival());
                }catch(Exception $e){
                }
                
                redirect(site_url('/festival'));
            } else {
                $this->load->view('Organisateur/Connexion');
            }
            
        } else {
            $this->load->view('Organisateur/Connexion');
        }
    }
    
    
    public function deconnexion(){
        if (!$this->session->has_userdata('connexionOrganisateur')){
            redirect('/welcome');
        } else {
            $this->session->unset_userdata('connexionOrganisateur');
            $this->session->unset_userdata('admin');
            redirect('/connexionOrganisateur');
        }
    }
}