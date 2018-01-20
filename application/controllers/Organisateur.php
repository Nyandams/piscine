<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Organisateur extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        if (!$this->session->has_userdata('connexionOrganisateur')|| $this->session->userdata('admin') != 1){
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
            $organisateurCollection = $this->dao->getOrganisateurs($login);
            $data['organisateurCollection'] = $organisateurCollection;
        } catch(Exception $e){
            $data['$organisateurCollection'] = new OrganisateurDTO();
        }
        $data['page'] = $this->load->view('Organisateur/interfaceOrganisateur', $data, true);
        $data['title']= 'Organisateur';
        $this->load->view("Theme/theme", $data);
    }
    
    
    public function modificationOrganisateur(){
        $this->form_validation->set_rules('nom', '"Nom"', 'encode_php_tags');
        $this->form_validation->set_rules('prenom', '"Prenom"', 'encode_php_tags');
        
        if($this->form_validation->run()) {
            $login = $this->input->get('login');
            try{
                $organisateurDTO = $this->dao->getOrganisateurByLogin($login);
                $organisateurDTO->setLoginOrganisateur($this->input->post('pseudo'));
                $organisateurDTO->setNomOrganisateur($this->input->post('nom'));
                $organisateurDTO->setPrenomOrganisateur($this->input->post('prenom'));
                $organisateurDTO->setAdmin($this->input->post('selectEstAdmin'));
                $mdp = $this->input->post('mdp');
                $verifMdp = $this->input->post('verifmdp');
                
                if (strlen($mdp) > 0 && strlen($verifMdp) > 0 && $mdp == $verifMdp){
                    $organisateurDTO->setMotDePasseOrganisateur(md5($mdp));
                }
                
                $this->dao->updateOrganisateur($organisateurDTO);
                
                
                
            }catch(Exception $e){
                
            }
            
        } else {
            $this->interfaceOrganisateur();
        }
        
        redirect(site_url('/organisateur'));
    }
    
    
    public function supprimerOrganisateur(){
        $login = $this->input->post('idSuppEditeur');
        try{
            $dto = $this->dao->getOrganisateurByLogin($login);
            $this->dao->deleteOrganisateur($dto);
        }catch(Exception $e){
            
        }
        redirect(site_url('/organisateur'));
    }
    
    public function ajoutOrganisateur(){
       
            $organisateurDTO = new OrganisateurDTO();
            $organisateurDTO->setLoginOrganisateur($this->input->post('pseudo'));
            $organisateurDTO->setMotDePasseOrganisateur($this->input->post('mdp'));
            $organisateurDTO->setNomOrganisateur($this->input->post('nom'));
            $organisateurDTO->setPrenomOrganisateur($this->input->post('prenom'));
            $organisateurDTO->setAdmin($this->input->post('selectEstAdmin'));
            $save = $this->dao->saveOrganisateur($organisateurDTO);
            
            
            redirect('/organisateur');
        
        
    }
    
}