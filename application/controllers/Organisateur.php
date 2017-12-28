<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Organisateur extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        if (!$this->session->has_userdata('connexionOrganisateur')){
            redirect('/welcome');
        } else {
            $this->load->library('form_validation');
            $this->load->model('Organisateur/OrganisateurFactory', 'fact');
            $this->load->model('Organisateur/DAO/OrganisateurDAO', 'dao');
            $this->load->model('Organisateur/DTO/OrganisateurDTO', 'dto');
            $this->load->model('Organisateur/DTO/OrganisateurCollection');
        }
    }
    
    public function index() {
        $this->interfaceOrganisateur();
    }
    
    public function interfaceOrganisateur(){
        $login = $this->session->userdata('connexionOrganisateur');
        try{
            $organisateurDTO = $this->dao->getOrganisateurByLogin($login);
            $data['organisateur'] = $organisateurDTO;
        } catch(Exception $e){
            $data['organisateur'] = new OrganisateurDTO();
        }
        $data['page'] = $this->load->view('Organisateur/interfaceOrganisateur', $data, true);
        $data['title']= 'Organisateur';
        $this->load->view("Theme/theme", $data);
    }
    
    
    public function modificationOrganisateur(){
        $this->form_validation->set_rules('mdp', '"Mot de passe"', 'max_length[52]|alpha_dash|encode_php_tags');
        $this->form_validation->set_rules('verifmdp', '"Verification mot de passe"', 'max_length[52]|alpha_dash|encode_php_tags');
        $this->form_validation->set_rules('nom', '"Nom"', 'trim|min_length[3]|required|max_length[52]|alpha_dash|encode_php_tags');
        $this->form_validation->set_rules('prenom', '"Prenom"', 'trim|required|min_length[3]|max_length[52]|alpha_dash|encode_php_tags');
        
        if($this->form_validation->run()) {
            $login = $this->session->userdata('connexionOrganisateur');
            try{
                $organisateurDTO = $this->dao->getOrganisateurByLogin($login);
                $organisateurDTO->setNomOrganisateur($this->input->post('nom'));
                $organisateurDTO->setPrenomOrganisateur($this->input->post('prenom'));
                $mdp = $this->input->post('mdp');
                $verifMdp = $this->input->post('verifmdp');
                if (strlen($mdp) > 0 && strlen($verifMdp) > 0 && $mdp == $verifMdp){
                    $organisateurDTO->setMotDePasseOrganisateur($mdp);
                }
                $this->dao->updateOrganisateur($organisateurDTO);
                
            }catch(Exception $e){
                
            }
            
        } else {
            $this->interfaceOrganisateur();
        }
        
        redirect('/organisateur');
    }
    
    
    public function ajoutOrganisateur(){
        $this->form_validation->set_rules('pseudo', '"Pseudo"', 'trim|min_length[3]|required|max_length[52]|alpha_dash|encode_php_tags');
        $this->form_validation->set_rules('mdp', '"Mot de passe"', 'min_length[3]|required|max_length[52]|alpha_dash|encode_php_tags');
        $this->form_validation->set_rules('verifmdp', '"Verification mot de passe"', 'min_length[3]|required|max_length[52]|alpha_dash|encode_php_tags');
        $this->form_validation->set_rules('nom', '"Nom"', 'trim|min_length[3]|required|max_length[52]|alpha_dash|encode_php_tags');
        
        if($this->form_validation->run()) {
            $organisateurDTO = new OrganisateurDTO();
            $organisateurDTO->setLoginOrganisateur($this->input->post('pseudo'));
            $organisateurDTO->setMotDePasseOrganisateur($this->input->post('mdp'));
            $organisateurDTO->setNomOrganisateur($this->input->post('nom'));
            $organisateurDTO->setPrenomOrganisateur($this->input->post('prenom'));
            $save = $this->dao->saveOrganisateur($organisateurDTO);
            
            
            redirect('/organisateur');
        } else {
            redirect('/organisateur');
        }
        
        
    }
    
}