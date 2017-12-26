<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Organisateur extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('Organisateur/OrganisateurFactory', 'fact');
        $this->load->model('Organisateur/DAO/OrganisateurDAO', 'dao');
        $this->load->model('Organisateur/DTO/OrganisateurDTO', 'dto');
        $this->load->model('Organisateur/DTO/OrganisateurCollection');
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
        $data['page'] = $this->load->view('Organisateur/interfaceOrganisateur', '', true);
        $data['title']= 'Organisateur';
        $this->load->view("Theme/theme", $data);
    }
    
}