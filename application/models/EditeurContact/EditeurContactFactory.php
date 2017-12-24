<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EditeurContactFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('EditeurContact/EditeurContactService');
        $this->load->model('Editeur/EditeurFactory');
        $this->load->model('Contact/ContactFactory');
        $this->load->model('Editeur/DAO/EditeurDAO');
        $this->load->model('Contact/DAO/ContactDAO');
    }
    
    static public function getInstance() {
        $editeurDAO = EditeurFactory::getInstance();
        $contactDAO = ContactFactory::getInstance();
        
        return new EditeurContactService($editeurDAO, $contactDAO);
    }
}