<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ConnexionOrganisateur extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('Organisateur/OrganisateurFactory', 'fact');
        $this->load->model('Organisateur/DAO/OrganisateurDAO', 'dao');
        $this->load->model('Organisateur/DAO/OrganisateurDTO', 'dto');
        $this->load->model('Organisateur/DAO/OrganisateurCollection');
    }
    
}