<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrganisateurFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Organisateur/DAO/OrganisateurDAO');
    }
    
    static public function getInstance() {
        return new OrganisateurDAO();
    }
}